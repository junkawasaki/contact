<?php
namespace Classes;

// 参考書籍
// http://gihyo.jp/book/2012/978-4-7741-4972-1
class Session
{
    protected $timeout;
    
    public function __construct($sessname = null, array $params = array()) {
        if (is_string($sessname) && !empty($sessname)) {
            session_name($sessname);
        }

        $gc_maxlifetime = ini_get('session.gc_maxlifetime');
        $this->timeout = $gc_maxlifetime;
        if (is_array($params) && count($params) > 0) {
            if (isset($params['timeout']) && ($params['timeout'] > 0)) {
                if ($gc_maxlifetime < $params['timeout']) {
                    ini_set('session.gc_maxlifetime', $params['timeout']);
                }
                $this->timeout = $params['timeout'];
            }
        }
    }
    
    public function sessionExists() {
        if (isset($_COOKIE[session_name()])) {
            return true;
        }
        return false;
    }
    
    public function start() {
        session_start();
        $now = time();
        $lastreq = $this->get('lastreq', $now);
        $this->set('lastreq', $now);
        if (($lastreq + $this->timeout) <= $now) {
            return false;
        }
        return true;
    }
    
    public function regenerate() {
        session_regenerate_id(true);
    }    
    
    public function delCookie() {
        if ($this->sessionExists()) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                        $params['path'], $params['domain'],
                        $params['secure'], $params['httponly']);
        }
    }

    public function endProc() {
        $this->clear();
        $this->delCookie();
        session_destroy();
    }
    
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }    
    
    public function get($key, $default = null) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return $default;
    }    
    
    public function remove($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }    
    
    public function clear() {
        $_SESSION = array();
    }
}
