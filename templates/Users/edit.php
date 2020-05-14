 <h1>Users</h1>
<p><?= $this->Html->link("Add User", ['action' => 'add']) ?></p>
<?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'edit',$User->id,],
    'type' => 'file'
]); ?>
    <table>

        <tr>
        <th>Name</th>
            <td>
                <?php echo $this->Form->input('user_name',['value'=>$User->user_name]); ?>
            </td>
        </tr>
        <tr>
        <th>Email</th>
            <td>
                <?php echo $this->Form->input('email',['value'=>$User->email]); ?>
            </td>
        </tr>
        <tr>
        <th>Password</th>
            <td>
                <?php echo $this->Form->input('password',['value'=>$User->password]); ?>
            </td>
        </tr>

        <tr>
        <th>Image</th>
            <td>
                <?php echo $this->Form->control('image_file',['type'=>'file']); ?>
            </td>
        </tr>
        <tr>
            <?php echo $this->Form->submit('Update',['class','btn-btn warning']); ?>
        </tr>

    </table>
<?php echo $this->Form->end(); ?>