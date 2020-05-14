<?php  
    echo $this->Form->create(null, ['type' => 'file','url' => ['controller' => 'Users', 'action' => 'add']]);
?>
    <h1>Add Article</h1>
<?php
    echo $this->Form->control('user_name');
    if($errors!=null)
    {
        $name_error=$errors['user_name'];
        foreach($name_error as $error)
        {
            dd($error);
        }
    }
    echo $this->Form->control('email');
    echo $this->Form->control('password');
    echo "<h4>Position<br></h4>";
    echo $this->Form->input('position', array(
        'type'=>'select',
        'label'=>'Role',
        'options'=>['admin','user'],
        'value'=>2
        ));
    echo $this->Form->control('image_file',['type'=>'file']);
    echo $this->Form->button(__('Save User'));
    echo $this->Form->end();
?>
