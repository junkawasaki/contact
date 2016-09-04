<?php
namespace Classes;

class Item
{
    // 管理者宛てメールアドレス
//    const ADMIN_ADDRESS = "hoge@piyo.co.jp";
    
//    const KEY = "godzilla";

    public $name = "miya";

    public static $items = [
        'title' => [
            'name_jp' => '件名',
            'type' => 'int',
            'range' => [1, 2, 3],
            'must' => true,
            'value' => null,
        ],
        'name' => [
            'name_jp' => 'お名前',
            'type' => 'string',
            'must' => true,
            'value' => null,
        ],
        'address' => [
            'name_jp' => 'メールアドレス',
            'type' => 'address',
            'must' => true,
            'value' => null,
        ],
        'tel' => [
            'name_jp' => '電話番号',
            'type' => 'int',
            'mast' => true,
            'value' => null,
        ],    
        'content' => [
            'name_jp' => 'お問い合わせ内容',
            'type' => 'string',
            'must' => true,
            'value' => null,
        ],
    ];
}
  