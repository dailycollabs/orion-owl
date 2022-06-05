<?php

$GLOBALS['datetime'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

/** check POST or GET */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $par = $_POST;
} else {
    $par = $_GET;
}

/** check encrypted_data */
if (isset($par['encrypted_data'])) {
    /** implementation */
}

/** check api_user */
if (isset($par['api_user'])) {
    /** implementation */
}

/** check api_token */
if (isset($par['api_token'])) {
    /** implementation */
} else {

    session_start();

    $syscfg = require_once '_config/system.php';

    require_once 'dbconn.php';
    $GLOBALS['dbconn'] = new dbconn();

    /** unset($_SESSION[$syscfg['session']]); */
    if (!isset($_SESSION[$syscfg['session']])) {
        $_SESSION[$syscfg['session']] = array(
            'user_rid' => $syscfg['default_user_rid'],
        );
    }
    $GLOBALS['session'] = $_SESSION[$syscfg['session']];

    if (!isset($par['modul']) || $par['modul'] == '' || $par['modul'] == 'index.php') {
        $par['modul'] = $syscfg['default_modul'];
    }
    $modul = $par['modul'];
    unset($par['modul']);

    if (!isset($par['action']) || $par['action'] == '') {
        $par['action'] = $syscfg['default_action'];
    }
    $action = $par['action'];
    unset($par['action']);

    require_once '_proto/_proto.php';
    require_once '_system/_system.php';

    if ($modul != '_system') {
        if (_system::call('checkUserPrivilege', array('modul' => $modul, 'action' => $action)) || $action == 'public') {
            $file = $modul . '/modul.php';
            if (is_file($file)) {
                require_once $file;
            } else {
                require_once '_ghost/_ghost.php';
                _ghost::call('generate_eval', $modul);
                //_ghost::call('generate_file', $modul);
            }
        } else {
            $type    = 'error';
            $message = 'Access denied.';

            $res = array('type' => $type, 'message' => $message);
            header('Content-Type: application/json');
            echo json_encode($res);
            exit;
        }
    }

    $modul::call($action, $par);

}
