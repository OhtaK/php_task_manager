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
<h1>Hello!</h1>
<p><?php echo $existData; ?></p>

<table>
    <tr>
        <th>Id</th>
        <th>name</th>
    </tr>
 
    <?php foreach ((array)$results as $item): ?>
    <tr>
        <td><?= $item->id ?></td>
        <td><?= $item->name ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
