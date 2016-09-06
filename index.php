<?php
require_once __DIR__ . "/vendor/autoload.php";
$logic = new \Classes\Logic();

if (!empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case "input_submit":
            // input.phpからsubmit
            $logic->input_submit();
            break;
        case "confirm_submit":
            // confirm.phpからsubmit
            $logic->confirm_submit();
            break;
        default:
            // 初期化input.phpへ遷移
            $logic->input_init();
            break;
    }
} else if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "to_confirm":
            // confirm.phpへ遷移
            $logic->to_confirm();                        
            break;
        case "to_complete":
            // complete.phpへ遷移
            $logic->to_complete();                        
            break;
        case "to_input":
            // input.phpへ遷移
            $logic->to_input();                        
            break;

        default:
            // 初期化input.phpへ遷移
            $logic->input_init();
            break;
    }
} else {
    // 初期化input.phpへ遷移
    $logic->input_init();
}
