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
</table>