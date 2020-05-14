<h1>Users</h1>
<p><?= $this->Html->link("Add User", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <tr>
        <td>
            <?= $this->Html->link($user->user_name, ['action' => 'view', $user->id]) ?>
        </td>
        <td>
            <?= $user->email ?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $user->id]) ?>
        </td>
    </tr>

</table>