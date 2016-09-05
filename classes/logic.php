<?php
namespace Classes;

class Logic
{
    private $sess = null;

    public function __construct() {
        // 設定値の外出し
        $this->sess = new \Classes\Session("contact");
    }

    // 入力画面の初期化描画
    public function input_init() {
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
    public function to_input() {
        // セッションチェック
        $this->chkSession();
        $this->sess->start();

        // data
        $data['input'] = $this->sess->get('input');
        $data['error'] = $this->sess->get('error');
        $data['token'] = \Classes\CsrfValidator::generate();

        // template
        $template = $this->get_template('input.php');
        echo $template->render($data);
    }
    
    // 入力画面からsubmit
    public function input_submit() {
        // セッションチェック
        $this->chkSession();
        $this->sess->start();

        // 入力チェック & CSRFチェック
        if ($this->chkInput() && $this->chkCsrf()) {
            $this->redirect('to_confirm');
        } else {
            $this->redirect('to_input');
        }
    }

    // 確認画面の描画
    public function to_confirm() {
        // セッションチェック
        $this->chkSession();
        $this->sess->start();

        // data
        $data['input'] = $this->sess->get('input');
        $data['token'] = \Classes\CsrfValidator::generate();

        // template
        $template = $this->get_template('confirm.php');
        echo $template->render($data);
    }    

    // 確認画面からsubmit
    public function confirm_submit() {
        // セッションチェック
        $this->chkSession();
        $this->sess->start();

        // csrfチェック & メール送信
        if ($this->chkCsrf() && $this->sendMail()) {
            $this->redirect('to_complete');
        } else {
            $this->redirect('to_input');
        }
    }

    // 完了画面の描画
    public function to_complete() {
        $template = $this->get_template('complete.php');
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
        $input = $this->sess->get('input');

        $from = new \SendGrid\Email(null, $input->address);
        $subject = "お問い合わせフォーム";
//        $to = new \SendGrid\Email(null, \Classes\Items::ADMIN_ADDRESS.",".$input->address);
        $to = new \SendGrid\Email(null, \Classes\Items::ADMIN_ADDRESS);
        $content = new \SendGrid\Content("text/plain", $this->get_content($input));
        $mail = new \SendGrid\Mail($from, $subject, $to, $content);

        $to = new \SendGrid\Email(null, $input->address);
        $mail->personalization[0]->addTo($to);

        // herokuの環境変数からAPIキーを取得
        $apiKey = getenv('SENDGRID_API_KEY');
        $sg = new \SendGrid($apiKey);

        $response = $sg->client->mail()->send()->post($mail);
        echo $response->statusCode();
        echo $response->headers();
        echo $response->body();
        
        return true;
    }

    private function redirect($action = 'input') {    
        $url = 'Location: /index.php?action=' . $action;    
        header($url, true, 303);    
    }

    private function get_template($file = 'input.php') {
        $loader = new \Twig_Loader_Filesystem('./views');
        $twig = new \Twig_Environment($loader);
        return $twig->loadTemplate($file);
    }

    private function get_content($input = null) {
        $title = !empty(\Classes\Items::$title[$input->title]) ? \Classes\Items::$title[$input->title] : '';

        $content = "お問い合わせフォーム"
                 . "件名：{$title}"
                 . "お名前：{$input->name}"
                 . "メールアドレス：{$input->address}"
                 . "電話番号：{$input->tel}"
                 . "お問い合わせ内容：{$input->content}";

        return $content;
    }    
}
