<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task</title>
 
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('home.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>

<div style="padding: 20px;">

<h1>タスク登録</h1>

<?php
        //createでフォームを宣言
        echo $this->Form->create('Task',array(
            'type' => 'post', //type属性を指定
            'url' => "task/add/{$task->id}" //POST先のURL
        ));

        //下記パラメータの数だけ列挙
        echo $this->Form->control('name',array(
            'div' => false,
            'label' => 'タスク名',
            "size" => 5,
            "default" => $task->name,
        ));
        
        echo $this->Form->control("user_id",array(
            'label' => '担当者',
            "type" => "select",
            "options" => $userSelectBoxOptionList, 
            'default' => $task->user_id,
            "empty" => "--")
        );
        
        echo $this->Form->control( "status",array(
            'label' => 'ステータス',
            "type" => "select",
            "options" => [ 
                [ "value" => "1",
                "text" => "TODO" ],
                [ "value" => "2",
                "text" => "DOING"], 
                [ "value" => "3",
                "text" => "DONE" ]
            ], 
            'default' => $task->status,
            "empty" => "--")
        );

        echo $this->Form->control( "priority_id",array(
            'label' => '優先度',
            "type" => "select",
            "options" => [ 
                [ "value" => "1",
                "text" => "緊急"],
                [ "value" => "2",
                "text" => "ASAP"], 
                [ "value" => "3",
                "text" => "いつでも" ]
            ], 
            'default' => $task->priority_id,
            "empty" => "--")
        );

        echo $this->Form->control("limit_date", array(
            "label" => "期日",
            "type" => "datetime",
            "dateformat" => "YMD",
            "monthNames" => false,
            "separator" => "/",
            "templates" => [ 
                "dateWidget" => '{{year}} 年 {{month}} 月 {{day}} 日 {{hour}} 時 {{minute}} 分' 
            ],
            "minYear" => date ( "Y" ) - 70,
            "maxYear" => date ( "Y" ) - 18,
            "default" => $task->limit_date,
            "interval" => 5,
            "empty" => [
                "year" => "年",
                "month" => "月",
                "day" => "日",
                "hour" => "時",
                "minute" => "分"
            ] ) 
        );

        echo $this->Form->control("description",array(
            "type" => "textarea",
            "label" => "備考",
            "cols" => 10,
            "rows" => 2,
            "default" => $task->description,
            )
        );

        //submitボタン作成。引数を入れるとその文言をボタンに出してくれる
        echo $this->Form->submit("登録");
        echo $this->Form->end ();
    ?>
    
    <?php echo $this->Html->link(
        '一覧に戻る',
        "/taskManage",
        array(
            'class'    => 'btn',
        ));
    ?>
</div>


<script>
// $(document).ready(function(){
//     for(var userInfo of ){
//         $('#area').append('<option value="2" selected="selected">user2</option>');
//     }
// });
</script>

</html>