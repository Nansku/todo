<h3><?= $title ?></h3>

<!--Linkki, josta pääsee lisäämään uusia tehtäviä-->
<?= anchor('todo/create', 'Add new task'); ?>
<table class="table">
    <tr>
        <th>Title</th>
        <th>User</th>
        <th>Description</th>
        <th></th>
    </tr>
<?php foreach ($todos as $todo): ?>
    <tr>
        <td><?= $todo['title'] ?></td>
        <td><?= $todo['firstname'] ?></td>
        <td><?= $todo['description'] ?></td>
        <td><?= anchor('todo/delete/' . $todo['id'], 'delete')?></td>
    </tr>
<?php endforeach ;?>
</table>