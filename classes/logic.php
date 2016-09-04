<?php
namespace Classes;

class Logic
{
    private $sess = null;

    public function __construct() {
        $this->sess = new \Classes\Session("contact");
    }

    // 入力画面の初期化描画
    public function init() {
        $this->sess->start();
        // csrfトークンを初期化するためにsession_idを変更する
        $this->sess->regenerate();

        // data
        $data = array('input' => null, 'error'  => null, 'token' => \Classes\CsrfValidator::generate());

        // template
        $template = $this->get_template('input.php');
        echo $template->render($data);
    }

    // 入力画面の再描画
    public function input() {
        $this->chkSession();
        $this->sess->start();

        // data
        $data['input'] = $this->sess->get('input');
        $data['error'] = $this->sess->get('error');
        $data['csrf_token'] = \Classes\CsrfValidator::generate();

        // template
        $template = $this->get_template('input.php');
        echo $template->render($data);
    }
    
    // 入力画面からsubmit
    public function submit() {
        $this->chkSession();
        $this->sess->start();

        // 入力チェック & CSRFチェック
        if ($this->chkInput() && $this->chkCsrf()) {
            $this->redirect('submit');
        } else {
            $this->redirect('input');
        }
    }

    // 確認画面描画
    public function confirm() {
        $this->chkSession();
        $this->sess->start();

        // data
        $data['input'] = $this->sess->get('input');
        $data['token'] = \Classes\CsrfValidator::generate();

        // template
        $template = $this->get_template('confirm.php');
        echo $template->render($data);
    }    

    public function complete() {
        $this->chkSession();
        $this->sess->start();

        // csrfチェック & メール送信
        if ($this->chkCsrf() && $this->sendMail()) {
            $this->redirect('complete');
        } else {
            $this->redirect('input');
        }
    }

    // 完了画面描画
    public function end() {
        $template = $this->get_template('end.php');
        echo $template->render([]);
    }

    private function chkCsrf() {
        if (!\Classes\CsrfValidator::validate(filter_input(INPUT_POST, 'token'))) {
            header('Content-Type: text/plain; charset=UTF-8', true, 400);
            die('CSRF validation failed.');
        }

        return true;
    }

    private function chkInput() {
        $input = new \stdClass;
        $error = array();

        foreach (\Classes\Items::$items as $name => $array) {
            // エスケープ未実装
            $input->$name = !empty($_POST[$name]) ? trim($_POST[$name]) : null;

            if ($array["need"]) {
                // 必須チェック    
                if (empty($input->$name)) {
                    $error[$name]= $array["name_jp"] . "を入力してください";
                    continue;
                }
            }

            // 型チェック
            switch ($array["type"]) {
                case "int":
                    if (!is_int((int)$input->$name)) {
                        $error[$name] = $array["name_jp"] . "の値の種類が正しくありません";
                        continue;
                    }
                    break;
                case "mail":
                    if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $input->$name)) {
                        $error[$name] = $array['name_jp'] . "の値の種類が正しくありません";
                        continue;
                    }
                    break;
            }

            if (!empty($array["value"])) {
                // 値チェック
                if (!in_array($input->$name, $array["value"])) {
                    $error[$name] = $array['name_jp'] . "の値が正しくありません";
                    continue;
                }
            }

        }

        $this->sess->set('input', $input);
        $this->sess->set('error', $error);
        
        return empty($error);    
    }    

    private function chkSession() {
        $exist = $this->sess->sessionExists();
        if (!$exist) {
            $this->redirect('init');
        }
    }

    private function sendMail() {

        return true;
    }

    private function redirect($action = 'input') {    
        $url = 'Location: https://contact-yyoshida.c9users.io/index.php?action=' . $action;    
        header($url, true, 303);    
    }

    private function get_template($file = 'input.php') {
        $loader = new \Twig_Loader_Filesystem('./views');
        $twig = new \Twig_Environment($loader);
        return $twig->loadTemplate($file);
    }
}
