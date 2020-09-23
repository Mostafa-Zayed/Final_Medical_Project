<?php
session_start();

/**
 * This Function Set Value in Session Array
 * 
 * @param string $key
 * @param mixed $value
 * @return void
 */
function set_session(string $key, $value)
{
    $_SESSION[$key] = $value;
}

/**
 * This Function Get Value From Session Array By Key
 * 
 * @param string $key
 * @return mixed 
 */
function get_session(string $key)
{
    return $_SESSION[$key];
}

/**
 * This Function End Session
 * 
 * 
 */
function end_session()
{
    //session_start();
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 420000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

/**
 * This Function To Check Session And Not Hacking Session
 * 
 * 
 */
function check_session()
{
    if (isset($_SESSION['HTTP_USER_AGENT']) && !empty($_SESSION['HTTP_USER_AGENT'])) {
        if (get_session('HTTP_USER_AGENT') != md5($_SERVER['HTTP_USER_AGENT'])) {
            die('Error');
        }
    } else {
        $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
    }
}

?>
