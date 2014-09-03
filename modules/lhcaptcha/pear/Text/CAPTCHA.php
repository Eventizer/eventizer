<?php
/**
 * Text_CAPTCHA - creates a CAPTCHA for Turing tests
 *
 * Class to create a Turing test for websites by
 * creating an image, ASCII art or something else 
 * with some (obfuscated) characters 
 *
 * 
 * @package Text_CAPTCHA
 * @license PHP License, version 3.0
 * @author Christian Wenz <wenz@php.net>
 * @category Text
 */


/**
 *
 * Require PEAR class for error handling.
 *
 */
//require_once 'extension/ezcaptcha/pear/PEAR.php';

/**
 *
 * Require Text_Password class for generating the phrase.
 *
 */
require_once 'modules/lhcaptcha/pear/Text/Password.php';

/**
 * Text_CAPTCHA - creates a CAPTCHA for Turing tests
 *
 * Class to create a Turing test for websites by
 * creating an image, ASCII art or something else 
 * with some (obfuscated) characters 
 *
 * @package Text_CAPTCHA
 */
 
/*  
    // This is a simple example script

    <?php
    if (!function_exists('file_put_contents')) {
        function file_put_contents($filename, $content) {
            if (!($file = fopen($filename, 'w'))) {
                return false;
            }
            $n = fwrite($file, $content);
            fclose($file);
            return $n ? $n : false;
        }
    }

    // Start PHP session support
    session_start();

    $ok = false;

    $msg = 'Please enter the text in the image in the field below!';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['phrase']) && is_string($_SESSION['phrase']) && isset($_SESSION['phrase']) &&
            strlen($_POST['phrase']) > 0 && strlen($_SESSION['phrase']) > 0 &&
            $_POST['phrase'] == $_SESSION['phrase']) {
            $msg = 'OK!';
            $ok = true;
            unset($_SESSION['phrase']);
        } else {
            $msg = 'Please try again!';
        }

        unlink(md5(session_id()) . '.png');   

    }

    print "<p>$msg</p>";

    if (!$ok) {
    
        require_once 'Text/CAPTCHA.php';
                   
        // Set CAPTCHA image options (font must exist!)
        $imageOptions = array(
            'font_size'        => 24,
            'font_path'        => './',
            'font_file'        => 'COUR.TTF',
            'text_color'       => '#DDFF99',
            'lines_color'      => '#CCEEDD',
            'background_color' => '#555555'
        );

        // Set CAPTCHA options
        $options = array(
            'width' => 200,
            'height' => 80,
            'output' => 'png',
            'imageOptions' => $imageOptions
        );

        // Generate a new Text_CAPTCHA object, Image driver
        $c = Text_CAPTCHA::factory('Image');
        $retval = $c->init($options);
        if (PEAR::isError($retval)) {
            printf('Error initializing CAPTCHA: %s!',
                $retval->getMessage());
            exit;
        }
    
        // Get CAPTCHA secret passphrase
        $_SESSION['phrase'] = $c->getPhrase();
    
        // Get CAPTCHA image (as PNG)
        $png = $c->getCAPTCHA();
        if (PEAR::isError($png)) {
            printf('Error generating CAPTCHA: %s!',
                $png->getMessage());
            exit;
        }
        file_put_contents(md5(session_id()) . '.png', $png);
    
        echo '<form method="post">' . 
             '<img src="' . md5(session_id()) . '.png?' . time() . '" />' . 
             '<input type="text" name="phrase" />' .
             '<input type="submit" /></form>';
    }
    ?>
*/
 
class Text_CAPTCHA {

    /**
     * Version number
     *
     * @access private
     * @var string
     */
    var $_version = '0.3.1';

    /**
     * Phrase
     *
     * @access private
     * @var string
     */
    var $_phrase;

    /**
     * Create a new Text_CAPTCHA object
     *
     * @param string $driver name of driver class to initialize
     *
     * @return mixed a newly created Text_CAPTCHA object, or a PEAR
     * error object on error
     *
     * @see PEAR::isError()
     */
    function factory($driver)
    {
        if ($driver == '') {
            return PEAR::raiseError('No CAPTCHA type specified ... aborting. You must call ::factory() with one parameter, the CAPTCHA type.', true);
        }
        $driver = basename($driver);
        include_once "modules/lhcaptcha/pear/Text/CAPTCHA/Driver/$driver.php";

        $classname = "Text_CAPTCHA_Driver_$driver";
        $obj = new $classname;
        return $obj;
    }

    /**
     * Create random CAPTCHA phrase
     *
     * This method creates a random phrase, 8 characters long
     *
     * @access  private
     */
    function _createPhrase()
    {
        $len = 8;
        $this->_phrase = Text_Password::create($len);
    }

    /**
     * Return secret CAPTCHA phrase
     *
     * This method returns the CAPTCHA phrase
     *
     * @access  public
     * @return  phrase   secret phrase
     */
    function getPhrase()
    {
        return $this->_phrase;
    }

    /**
     * Sets secret CAPTCHA phrase
     *
     * This method sets the CAPTCHA phrase 
     * (use null for a random phrase)
     *
     * @access  public
     * @param   string   $phrase    the (new) phrase
     * @void 
     */
    function setPhrase($phrase = null)
    {
        if (!empty($phrase)) {
            $this->_phrase = $phrase;
        } else {
            $this->_createPhrase();
        }
    }

    /**
     * Place holder for the real init() method
     * used by extended classes to initialize CAPTCHA 
     *
     * @access private
     * @return PEAR_Error
     */
    function init() {
        return PEAR::raiseError('CAPTCHA type not selected', true);
    }

    /**
     * Place holder for the real _createCAPTCHA() method
     * used by extended classes to generate CAPTCHA from phrase
     *
     * @access private
     * @return PEAR_Error
     */
    function _createCAPTCHA() {
        return PEAR::raiseError('CAPTCHA type not selected', true);
    }

    /**
     * Place holder for the real getCAPTCHA() method
     * used by extended classes to return the generated CAPTCHA 
     * (as an image resource, as an ASCII text, ...)
     *
     * @access private
     * @return PEAR_Error
     */
    function getCAPTCHA() {
        return PEAR::raiseError('CAPTCHA type not selected', true);
    }

}
?>
