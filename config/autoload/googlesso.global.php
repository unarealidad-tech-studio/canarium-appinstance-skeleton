<?php


if(isset($_SERVER['HTTPS'])){
    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
} else{
    $protocol = 'http';
}

$server_host = !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';

return array(
    'googlesso' => array(
//        'auth_class_service' => 'GoogleSSO\Authentication\ConnectedAccount',
//        'use_connected_accounts' => false,
        'scope' => array(
            'https://www.googleapis.com/auth/plus.login',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile'
        ),
        'redirect_uri' => $server_host.'/oauth2callback',
    )
);
