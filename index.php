<?php
require_once __DIR__ . "/vendor/autoload.php";
$logic = new \Classes\Logic();

if (!empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case "input_submit":
            // input.phpから遷移
//            $logic->submit();
            $logic->input_submit();
            break;
        case "confirm_submit":
            // confirm.phpから遷移
//            $logic->complete();
            $logic->confirm_submit();
            break;
        default:
//            $logic->input();
//            $logic->input_rerun();
            $logic->input_init();
            break;
    }
} else if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
//        case "submit":
        case "to_confirm":
            // confirm.phpへ遷移
//            $logic->confirm();                        
            $logic->to_confirm();                        
            break;
//        case "complete":
        case "to_complete":
            // end.phpへ遷移
//            $logic->end();                        
            $logic->to_end();                        
            break;
        default:
//            $logic->input();
//            $logic->input_rerun();
            $logic->to_input();
            break;
    }
} else {
    // input.phpへ遷移
//    $logic->init();
    $logic->input_init();
}
