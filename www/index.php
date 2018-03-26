<?php
 
    require_once(realpath(dirname(__FILE__) . "/../resources/index.php"));


    /*
        Now you can handle all your php logic outside of the template
        file which makes for very clean code!
    
     
    $setInIndexDotPhp = "Hey! You Can Search in History...";
     
    // Must pass in variables (as an array) to use in template
    $variables = array(
        'setInIndexDotPhp' => $setInIndexDotPhp
    );
    */

    renderLayoutWithContentFile("default.php");
?>