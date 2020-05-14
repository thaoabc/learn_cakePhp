 <h1>Users</h1>
<p><?= $this->Html->link("Add User", ['action' => 'add']) ?></p>
<?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'edit',$User->id]
]); ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <tr>
            <td>
                <?php echo $this->Form->input('user_name',['value'=>$User->user_name]); ?>
            </td>
            <td>
                <?php echo $this->Form->input('email',['value'=>$User->email]); ?>
            </td>
            <td>
                <?php echo $this->Form->input('password',['value'=>$User->password]); ?>
            </td>
        </tr>
        <tr>
            <?php echo $this->Form->submit('Update',['class','btn-btn warning']); ?>
        </tr>

    </table>
<?php echo $this->Form->end(); ?>