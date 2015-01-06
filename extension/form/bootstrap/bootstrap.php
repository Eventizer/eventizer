<?php 

class erLhcoreClassExtensionForm  {
    
    public function run()
    {
        $this->registerAutoload();
    }
    
    public function registerAutoload()
    {
        spl_autoload_register(array($this, 'autoload'), true, false);
        erLhcoreClassEventDispatcher::getInstance()->listen('system.developer_view_extenshions_block',array($this,'developerViewExtenshionsBlock'));
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
    
    public function developerViewExtenshionsBlock($params) {
        $settings = include 'extension/form/settings/settings.ini.php';
        return  array_merge(array('array_merge'=>1), $settings);
    }
}
?>