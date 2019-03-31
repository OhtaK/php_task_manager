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

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<link rel="stylesheet" target="_blank" href="datetimepicker/jquery.datetimepicker.css">
<script src="datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
</head>

<body class="home">
<div style="padding: 40px;">
    <h1>This is Task Manager</h1>

    <?php echo $this->Html->link('ユーザー管理', "/users", array('class' => 'btn')); ?>
    <?php echo $this->Html->link('ログアウト', "/login/logout", array('class' => 'btn')); ?>
    
    <table>
        <?php
        echo $this->Form->create('Condition',array(
            'type' => 'post', //type属性を指定
            'url' => "taskManage" //POST先のURL
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
                "options" => $user_select_box_option_list, 
                "empty" => "指定なし", )
              );
        
              echo $this->Form->control("limit_start_date", array(
                "label" => "期日開始",
                "type" => "text",
                "id"=>"datepicker_limit_start")
              );
      
              echo $this->Form->control("limit_end_date", array(
                "label" => "期日終了",
                "type" => "text",
                "id"=>"datepicker_limit_end")
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

    <?php for ($i = 1; $i < 4; $i++): ?>
    <div class="task-panel">
        <p class="panel-title"><?php echo $status_name[$i]; ?></p>

        <?php foreach ($task_list[$i] as $task): ?>
        <div class="card priority_<?php echo $task['priority_id']; ?>" onClick = "clickTask(<?php echo $task['id']; ?>)">
            タスク名：<?php echo $task['name']; ?></br>
            担当者名：
            <?php if(isset($user_select_box_option_list[$task['user_id']]['text'])): ?>
              <?php echo $user_select_box_option_list[$task['user_id']]['text']; ?>
            <?php else: ?>
              設定されていないか、削除されています
            <?php endif; ?>
            </br>
            期日：<?php echo date('Y-m-d H:i:s', strtotime($task['limit_date'])); ?></br>
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
    <?php endfor; ?>
    </div>
</div>
</div>

</body>

<script>
  $(function() {

    $.datetimepicker.setLocale('ja');
    $("#datepicker_limit_start").datetimepicker();
    $("#datepicker_limit_end").datetimepicker();
  });
</script>

<script type="text/javascript">
function clickTask(id){
    location.href = "/task/index/" + id;
}
</script>

</html>