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
    <h1>This is Task Manager</h1>
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
	    <?php endforeach; ?>
    </div>

    <div class="task-panel" style="left: 1000px;">
        <p class="panel-title">DONE</p>

        <?php foreach ($doneTaskList as $task): ?>
        <a href='task/index/{$task->id}'>
        <div class="card" onClick = "clickTask(<?php echo $task['id']; ?>)">
            タスク名：<?php echo $task['name']; ?></br>
            担当者ID：<?php echo $task['user_id']; ?></br>
            期日：<?php echo $task['limit_date']; ?></br>
            備考：<?php echo $task['description']; ?></br>
        </div>
        </a>
	    <?php endforeach; ?>
    </div>
    </div>

    <?php echo $this->Html->link('タスク追加', "/task", array('class' => 'btn')); ?>
</body>

<script type="text/javascript">
function clickTask(id){
    location.href = "http://localhost:8765/task/index/" + id;
}
</script>

</html>