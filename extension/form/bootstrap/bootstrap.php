<?php 

class erLhcoreClassExtensionForm  {
    
    public function run()
    {
        $this->registerAutoload();
    }
    
    public function registerAutoload()
    {
        spl_autoload_register(array($this, 'autoload'), true, false);
    }
    
    /**
     * Extension autoload
     * */
    public function autoload($className)
    {
        $classes = array(
              // Form
            'erLhcoreClassForm'						=> 'extension/form/lib/core/lhform/lhform.php',
            'erLhcoreformClassValidation'			=> 'extension/form/lib/core/lhform/validation/formclassvalidation.php',
            'erLhcoreClassFormEmails'				=> 'extension/form/lib/core/lhform/lhcoreclassformemails.php',
        );
         
        if (key_exists($className, $classes)) {
            include_once $classes[$className];
        }
    }
}
?>