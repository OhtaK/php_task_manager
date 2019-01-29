<div style="padding: 20px;">

<h1>タスク登録</h1>

<?php
        //createでフォームを宣言
        echo $this->Form->create('Task',array(
            'type' => 'post', //type属性を指定
            'url' => 'task/add' //POST先のURL
        ));

        //下記パラメータの数だけ列挙
        echo $this->Form->input('name',array(
            'div' => false,
            'label' => 'タスク名',
            "size" => 5,
        ));
        
        echo $this -> Form -> input  ( "担当者",
                                 [ "type" => "select",
                                   "options" => [ [ "value" => "1",
                                                    "text" => "ユーザー１" ,
                                                    "selected" => true ],
                                                  [ "value" => "2",
                                                    "text" => "ユーザー2"], 
                                                  [ "value" => "3",
                                                    "text" => "ユーザー3" ] ], 
                                   "empty" => "--" ] );

        echo $this -> Form -> input (
            "jp_datetime", [ "label" => "期日",
                             "type" => "datetime",
                             "dateformat" => "YMD",
                             "monthNames" => false,
                             "separator" => "/",
                             "templates" => [ "dateWidget" => '{{year}} 年 {{month}} 月 {{day}} 日 {{hour}} 時 {{minute}} 分' ],
                             "minYear" => date ( "Y" ) - 70,
                             "maxYear" => date ( "Y" ) - 18,
                             "default" => date ( "Y-m-d" ),
                             "interval" => 5,
                             "empty" => [ "year" => "年", "month" => "月", "day" => "日", "hour" => "時", "minute" => "分" ] ] );

        echo $this -> Form -> input ( "area", [ "type" => "textarea",
                                        "cols" => 10,
                                        "rows" => 2,
                                        "label" => "備考" ] );

        //submitボタン作成。引数を入れるとその文言をボタンに出してくれる
        echo $this->Form->submit("登録");
        echo $this -> Form -> end ();
    ?>
</div>