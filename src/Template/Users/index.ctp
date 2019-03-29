<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top</title>
 
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('home.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>

<body class="home">
    <div style="padding: 40px;">
    <h1>User</h1>

    <?php
        //createでフォームを宣言
        echo $this->Form->create('User',array(
            'type' => 'post', //type属性を指定
            'url' => 'users/add' //POST先のURL
        ));

        //下記パラメータの数だけ列挙
        echo $this->Form->control('name',array(
            'div' => false,
            'label' => 'ユーザー名'
        ));

        echo $this->Form->control('password',array(
            'div' => false,
            'label' => 'パスワード'
        ));

        //submitボタン作成。引数を入れるとその文言をボタンに出してくれる
        echo $this->Form->submit("登録");
        echo $this -> Form -> end ();
    ?>
    
    <table>
        <tr>
            <th>ID</th>
            <th>ユーザー名</th>
            <th>操作</th>
        </tr>
 
        <?php foreach ($users as $item): ?>
        <tr>
            <td><?= $item->id ?></td>
            <td><?= $item->name ?></td>
            <td>
                <?= $this->Form->postLink(
					'削除',
					"/users/delete/{$item->id}",
					[
						'class'    => 'btn',
						'confirm'  => "ユーザーを削除しますか？ (id={$item->id})"
					]
                ); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>
</body>