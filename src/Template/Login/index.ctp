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

<h1>ログイン</h1>

<?php
        //createでフォームを宣言
        echo $this->Form->create('Task',array(
            'type' => 'post', //type属性を指定
            'url' => "login/login" //POST先のURL
        ));

        //下記パラメータの数だけ列挙
        echo $this->Form->control('name',array(
            'div' => false,
            'label' => 'ユーザー名',
            "size" => 5,
        ));

        echo $this->Form->control('password',array(
            'div' => false,
            'label' => 'パスワード',
            "size" => 10,
        ));

        //submitボタン作成。引数を入れるとその文言をボタンに出してくれる
        echo $this->Form->submit("ログイン");
        echo $this->Form->end ();
    ?>
</div>

</html>