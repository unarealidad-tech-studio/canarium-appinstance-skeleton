<?php

return array(
    'module_listener_options' => array(
        'module_paths' => array(
            './instances/'.$instance_name.'/plugins',
        ),

        'config_glob_paths' => array(
            './instances/'.$instance_name.'/config/autoload/{,*.}{global,local}.php',
        ),
    ),
);
