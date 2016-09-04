<?php
namespace Classes;

class Items
{
    // 管理者宛てメールアドレス
    const ADMIN_ADDRESS = "brown.toy.poodle@gmail.com";
    
    public static $title = array(
        1 => 'ご意見',
        2 => 'ご感想',
        3 => 'その他',
    );

    // フォーム項目
    public static $items = [
        'title' => [
            'name_jp' => '件名',
            'type' => 'int',
            'need' => true,
            'value' => [1, 2, 3],
        ],
        'name' => [
            'name_jp' => 'お名前',
            'type' => 'string',
            'need' => true,
        ],
        'address' => [
            'name_jp' => 'メールアドレス',
            'type' => 'address',
            'need' => true,
        ],
        'tel' => [
            'name_jp' => '電話番号',
            'type' => 'int',
            'need' => true,
        ],    
        'content' => [
            'name_jp' => 'お問い合わせ内容',
            'type' => 'string',
            'need' => true,
        ],
    ];
}
  