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
    <h1>This is Task Manager</h1>
    <div id="conmenu">
    <ul>
    <li><a href="https://www.google.co.jp" target="_blank">Google</a></li>
    <li><a href="https://www.yahoo.co.jp/" target="_blank">Yahoo</a></li>
    <li><a href="https://www.goo.ne.jp/" target="_blank">goo</a></li>
  </ul>
</div>
<div id="area">このエリア上で右クリックしてください。</div>
    <div style="width: 100%;">
    <div class="task-panel">
        <p class="panel-title">TODO</p>
        
        <?php foreach ($todoTaskList as $task): ?>
        <div class="card" onClick = "clickTask(<?php echo $task['id']; ?>)">
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
    
    <div class="task-panel" style="left: 500px;">
        <p class="panel-title">DOING</p>

        <?php foreach ($doingTaskList as $task): ?>
        <div class="card" onClick = "clickTask(<?php echo $task['id']; ?>)">
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

    <div class="task-panel" style="left: 1000px;">
        <p class="panel-title">DONE</p>

        <?php foreach ($doneTaskList as $task): ?>
        <div class="card" onClick = "clickTask(<?php echo $task['id']; ?>)">
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

    <?php echo $this->Html->link('タスク追加', "/task", array('class' => 'btn')); ?>
    <?php echo $this->Html->link('ログアウト', "/login/logout", array('class' => 'btn')); ?>
</body>

<script type="text/javascript">
function clickTask(id){
    location.href = "/task/index/" + id;
}

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