<?php
spl_autoload_register(function($class) {
  if (is_file('classes/' . $class . '.class.php'))
  {
    require_once('classes/' . $class . '.class.php');
  }else
   {
     $filename = dirname(dirname(__FILE__)) . '/classes/' . $class .'.class.php';
     if(is_readable($filename))
     {
      require_once $filename;
     }
   }
});
