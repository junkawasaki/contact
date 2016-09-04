<?php
require_once __DIR__ . "/vendor/autoload.php";
$logic = new \Classes\Logic();

if (!empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case "submit":
            // index.phpから遷移
            $logic->submit();
            break;
        case "complete":
            // confirm.phpから遷移
            $logic->complete();
            break;
        default:
            $logic->input();
            break;
    }
} else if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "submit":
            // confirm.phpへ遷移
            $logic->confirm();                        
            break;
        case "complete":
            // end.phpへ遷移
            $logic->end();                        
            break;
        default:
            $logic->input();
            break;
    }
} else {
    // input.phpへ遷移
    $logic->init();
}
