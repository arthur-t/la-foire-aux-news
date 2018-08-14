<?php

class Autoload
{
    private static $_instance = null;

    public static function charger()
    {
        if (null !== self::$_instance) {
            throw new RuntimeException(sprintf('%s  is already started', __CLASS__));
        }
        self::$_instance = new self();
        if (!spl_autoload_register(array(self::$_instance, '_autoload'), false)) {
            throw RuntimeException(sprintf('%s : Could not start the autoload', __CLASS__));
        }
    }

    private static function _autoload($class)
    {
        global $rep;

        $filename = $class . '.php';
        $dir = array('modeles/', './', 'config/', 'controlers/', 'PDO/', 'metier/','parser/');
        foreach ($dir as $d) {
            $file = $rep . $d . $filename;
            //echo $file;
            if (file_exists($file)) {
                include $file;
            }
        }
    }
}