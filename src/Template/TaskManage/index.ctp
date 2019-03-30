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

    <style>
#conmenu{
  width:130px;
  background-color:#f0f0f0;
  border:1px solid #999999;
  display:none;
  position:fixed;
}
 
#conmenu.on{
  display:block;
}
 
#conmenu ul{
  list-style:none;
  margin:0px;
  padding:5px;
}
#area{
  width:400px;
  height:200px;
  background-color:#ddddff;
}
</style>
</head>

<body class="home">
<div style="padding: 40px;">
    <h1>This is Task Manager</h1>
    <div id="conmenu">
      <ul>
        <li><a href="https://www.google.co.jp" target="_blank">Google</a></li>
        <li><a href="https://www.yahoo.co.jp/" target="_blank">Yahoo</a></li>
        <li><a href="https://www.goo.ne.jp/" target="_blank">goo</a></li>
      </ul>
    </div>

    <?php echo $this->Html->link('ユーザー管理', "/users", array('class' => 'btn')); ?>
    <?php echo $this->Html->link('ログアウト', "/login/logout", array('class' => 'btn')); ?>
    
    <table>
        <?php
        echo $this->Form->create('Condition',array(
            'type' => 'post', //type属性を指定
            'url' => "taskManage/index/" //POST先のURL
        ));
        ?>
        <tr>
            <th>ソート条件</th>
            <th>検索条件</th>
        </tr>
 
        <tr>
            <td>
              <?php 
              echo $this->Form->control("sort",array(
                'label' => '',
                "type" => "select",
                "options" => [ 
                  [ "value" => "priority_id",
                  "text" => "優先度でソート" ],
                  [ "value" => "limit_date",
                  "text" => "期日でソート"], 
                ], 
                'default' => 1,)
              );

              echo $this->Form->control("order",array(
                'label' => '',
                "type" => "select",
                "options" => [ 
                  [ "value" => "asc",
                  "text" => "昇順" ],
                  [ "value" => "desc",
                  "text" => "降順"], 
                ], 
                'default' => 1)
              );
              ?>
            </td>
            <td>
              <?php 
              echo $this->Form->control("user_id",array(
                'label' => 'ユーザー名',
                "type" => "select",
                "options" => $user_select_box_option_list, )
              );
        
              echo $this->Form->control("limit_start_date", array(
                "label" => "期日開始",
                "type" => "datetime",
                "dateformat" => "YMD",
                "monthNames" => false,
                "separator" => "/",
                "templates" => [ 
                  "dateWidget" => '{{year}} 年 {{month}} 月 {{day}} 日 {{hour}} 時 {{minute}} 分' 
                ],
                "minYear" => date ( "Y" ) - 70,
                "maxYear" => date ( "Y" ) - 18,
                "default" => '',
                "interval" => 5,
                "empty" => [
                  "year" => "年",
                  "month" => "月",
                  "day" => "日",
                  "hour" => "時",
                  "minute" => "分"
                ]) 
              );
      
              echo $this->Form->control("limit_end_date", array(
                "label" => "期日終了",
                "type" => "datetime",
                "dateformat" => "YMD",
                "monthNames" => false,
                "separator" => "/",
                "templates" => [ 
                  "dateWidget" => '{{year}} 年 {{month}} 月 {{day}} 日 {{hour}} 時 {{minute}} 分' 
                ],
                "minYear" => date ( "Y" ) - 70,
                "maxYear" => date ( "Y" ) - 18,
                "default" => '',
                "interval" => 5,
                "empty" => [
                  "year" => "年",
                  "month" => "月",
                  "day" => "日",
                  "hour" => "時",
                  "minute" => "分"
                ] ) 
              );
              ?>
            </td>

            <td>
            <?php 
              echo $this->Form->submit("適用");
              echo $this->Form->end();
            ?>
            </td>
        </tr>
    </table>

    <?php echo $this->Html->link('タスク追加', "/task", array('class' => 'btn')); ?>
    <div style="width: 100%;">
    <div class="task-panel">
        <p class="panel-title">TODO</p>
        
        <?php foreach ($todo_task_list as $task): ?>
        <div class="card priority_<?php echo $task['priority_id']; ?>" onClick = "clickTask(<?php echo $task['id']; ?>)">
            タスク名：<?php echo $task['name']; ?></br>
            担当者ID：<?php echo $task['user_id']; ?></br>
            期日：<?php echo $task['limit_date']; ?></br>
            備考：<?php echo $task['description']; ?></br>
        </div>

        <?= $this->Form->postLink(
            '削除',
            "/task/delete/{$task->id}",
            [
                'class'    => 'btn',
                'confirm'  => "{$task->name}のタスクを削除しますか？"
            ]); 
        ?>

	    <?php endforeach; ?>
    </div>
    
    <div class="task-panel">
        <p class="panel-title">DOING</p>

        <?php foreach ($doing_task_list as $task): ?>
        <div class="card priority_<?php echo $task['priority_id']; ?>" onClick = "clickTask(<?php echo $task['id']; ?>)">
            タスク名：<?php echo $task['name']; ?></br>
            担当者ID：<?php echo $task['user_id']; ?></br>
            期日：<?php echo $task['limit_date']; ?></br>
            備考：<?php echo $task['description']; ?></br>
        </div>
        <?= $this->Form->postLink(
            '削除',
            "/task/delete/{$task->id}",
            [
                'class'    => 'btn',
                'confirm'  => "{$task->name}のタスクを削除しますか？"
            ]); 
        ?>
	    <?php endforeach; ?>
    </div>

    <div class="task-panel">
        <p class="panel-title">DONE</p>

        <?php foreach ($done_task_list as $task): ?>
        <div class="card priority_<?php echo $task['priority_id']; ?>" onClick = "clickTask(<?php echo $task['id']; ?>)">
            タスク名：<?php echo $task['name']; ?></br>
            担当者ID：<?php echo $task['user_id']; ?></br>
            期日：<?php echo $task['limit_date']; ?></br>
            備考：<?php echo $task['description']; ?></br>
        </div>

        <?= $this->Form->postLink(
            '削除',
            "/task/delete/{$task->id}",
            [
                'class'    => 'btn',
                'confirm'  => "{$task->name}のタスクを削除しますか？"
            ]); 
        ?>
	    <?php endforeach; ?>
    </div>
    </div>
</div>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
function clickTask(id){
    location.href = "/task/index/" + id;
}

var menu = document.getElementById('conmenu');  //独自コンテキストメニュー
$('#area').hover( () => {
  // 　　menu.style.left = e.pageX + 'px';
  //   menu.style.top = e.pageY + 'px';
    menu.classList.add('on');
  
  }, function() {
  
    　　if(menu.classList.contains('on')){
      menu.classList.remove('on');
    }
  
   });

window.onload = function(){
  var menu = document.getElementById('conmenu');  //独自コンテキストメニュー
  var area = document.getElementById('area');     //対象エリア
  var body = document.body;                       //bodyエリア
 
  //右クリック時に独自コンテキストメニューを表示する
  area.addEventListener('contextmenu',function(e){
    menu.style.left = e.pageX + 'px';
    menu.style.top = e.pageY + 'px';
    menu.classList.add('on');
  });
 
  //左クリック時に独自コンテキストメニューを非表示にする
  body.addEventListener('click',function(){
    if(menu.classList.contains('on')){
      menu.classList.remove('on');
    }
  });
}
</script>

</html>