<h1>User</h1>
<table>
    <tr>
        <th>Id</th>
        <th>name</th>
    </tr>
 
    <?php foreach ($user as $item): ?>
    <tr>
        <td><?= $item->id ?></td>
        <td><?= $item->name ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

    <?php
        //createでフォームを宣言
        echo $this->Form->create('User',array(
            'type' => 'post', //type属性を指定
            'url' => 'user/add' //POST先のURL
        ));

        //下記パラメータの数だけ列挙
        echo $this->Form->input('id',array(
            'div' => false,
            'label' => 'ユーザーID'
        ));

        echo $this->Form->input('name',array(
            'div' => false,
            'label' => 'ユーザー名'
        ));

        //submitボタン作成。引数を入れるとその文言をボタンに出してくれる
        echo $this->Form->submit("登録");
        echo $this -> Form -> end ();
    ?>
    
    <?php
        //削除フォーム
        //createでフォームを宣言
        echo $this->Form->create('deleteUser',array(
            'type' => 'post', //type属性を指定
            'url' => 'user/delete' //POST先のURL
        ));

        //下記パラメータの数だけ列挙
        echo $this->Form->input('id',array(
            'label' => '削除したいユーザーID'
        ));

        //submitボタン作成。引数を入れるとその文言をボタンに出してくれる
        echo $this->Form->submit("削除");
        echo $this -> Form -> end ();
    ?>
</table>