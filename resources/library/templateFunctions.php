<?php

function renderLayoutWithContentFile($contentFile, $variables = array())
    {
        
        $path_info = new roter();
        $path_info->parse_path();
        //echo '<pre>'.print_r($path_info->parse_path(), true).'</pre>';
        //echo '<pre>'.print_r($path_info->path['call_parts'][0], true).'</pre>';
        //print_r($path_info['query_vars']);

        $contentFileFullPath = TEMPLATES_PATH . "/" . $contentFile;
        //if call part is set do the switch and 
        if (isset($path_info->path['call_parts'][0])){
            switch($path_info->path['call_parts'][0]){
                case "home":    $contentFileFullPath = TEMPLATES_PATH . "/default.php"; break;
                case "dashboard":     $contentFileFullPath = TEMPLATES_PATH . "/admin/admin-dashboard.php"; break;
                case "logout":     $contentFileFullPath = TEMPLATES_PATH . "/admin/logout.php"; break;
                case "register":     $contentFileFullPath = TEMPLATES_PATH . "/register.php"; break;
                
                case "admin": 
                    if (isset($path_info->path['call_parts'][1])) {
                        if ($path_info->path['call_parts'][1] !== ''){
                            $contentFileFullPath = TEMPLATES_PATH . "/error.php";
                        } else {$contentFileFullPath = TEMPLATES_PATH . "/login.php"; }
                    } elseif (isset($path_info->path['query_vars'])) {
                        $contentFileFullPath = TEMPLATES_PATH . "/error.php";
                    } else {
                        $contentFileFullPath = TEMPLATES_PATH . "/login.php"; 
                    } break;

                default:    
                    if ($path_info->path['call_parts'][0] !== ''){
                        $contentFileFullPath = TEMPLATES_PATH . "/error.php"; 
                    } break;
            } 
        }
        // making sure passed in variables are in scope of the template
        // each key in the $variables array will become a variable
        if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }
        if (isset($path_info->path['call_parts'][0])){
            switch($path_info->path['call_parts'][0]){
                case "dashboard": require_once(TEMPLATES_PATH . "/admin/header/header.php"); break;
                default: require_once(TEMPLATES_PATH . "/header/header.php"); break;
            }
        }
     
        echo "<div class=\"container\">\n";
     
        if (file_exists($contentFileFullPath)) {
            require_once($contentFileFullPath);
        } else {
            /*
                If the file isn't found the error can be handled in lots of ways.
                In this case we will just include an error template.
            */
            require_once(TEMPLATES_PATH . "/error.php");
        }

        // close container div
        echo "</div>\n";
     
        require_once(TEMPLATES_PATH . "/footer/footer.php");
    }
?>