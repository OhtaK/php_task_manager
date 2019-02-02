<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
 
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('home.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>

<body class="home">
    <h1>This is Task Manager</h1>
    <div class="task-panel">
        <p class="panel-title">TODO</p>
    </div>
    
    <div class="task-panel">
        <p class="panel-title">DOING</p>
    </div>

    <div class="task-panel">
        <p class="panel-title">DONE</p>
    </div>
</body>
</html>