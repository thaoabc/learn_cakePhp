 <h1>Users</h1>
<table>
    <tr>
        <td>
            <p><?= $this->Html->link("Add User", ['action' => 'add']) ?></p>
        </td>
        <td>
            <p><?= $this->Html->link("Logout", ['action' => 'logout']) ?></p>
        </td>
        <td>
            <p><?= $this->Html->link("Phần gửi mail của người dùng", ['controller'=>'Mail','action' => 'sendMailOfUser']) ?></p>
        </td>
        <!-- <td>
            <p><?= $this->Html->link("Phần gửi mail của admin", ['controller'=>'Mail','action' => 'sendMailOfAdmin']) ?></p>
        </td> -->
    </tr>
    <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Email</th>
        <th>Password</th>
        <th>Roles</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

<?php foreach ($database as $data): ?>
    <tr>
        <td>
            <?= $this->Html->link($data->user_name, ['action' => 'view', $data->id]) ?>
        </td>
        <td>
            <?= @$this->Html->image($data->image) ?>
        </td>
        <td>
            <?= $data->email ?>
        </td>
        <td>
            <?= $data->password ?>
        </td>
        <td>
            <?php
                if($data->position==0)
                {
                    echo"Admin";
                }
                else
                {
                    echo "User";
                }
            ?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $data->id]) ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $data->id],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>