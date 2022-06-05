<?php

session_start();

$syscfg = require_once 'api/_config/system.php';

unset($_SESSION[$syscfg['session']]);

if (isset($_POST['username'])) {
    $db = require_once 'api/_config/db.php';
    require_once 'api/dbconn.php';
    $dbconn   = new dbconn($db);
    $username = $dbconn->escape($_POST['username']);
    $password = $dbconn->escape($_POST['password']);
    $query    = "SELECT rid FROM user WHERE username = '{$username}' AND password = MD5('{$password}')";
    $result   = $dbconn->query($query);
    if ($result->num_rows == 1) {
        $row                          = $result->fetch_row();
        $_SESSION[$syscfg['session']] = array(
            'user_rid' => $row[0],
        );
    }
}

if (!isset($_SESSION[$syscfg['session']])) {
    header('Location: login.html');
} else {
    $html = file_get_contents('index.html');
    echo $html;
}
