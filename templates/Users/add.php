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
    echo "<h4>Password</h4>";
    echo $this->Form->input('password',['type'=>'password']);
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

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
$(document).ready(function(){
    $('input[type="password"]').after(' <input type="checkbox" class="check" /> Hiển thị mật khẩu');
    $('.check').change(function(){
        var prev = $(this).prev();
        var value = prev.val();
        var type = prev.attr('type');
        var name = prev.attr('name');
        var id = prev.attr('id');
        var klass = prev.attr('class');
        var new_type = (type == 'password') ? 'text' : 'password';
        prev.remove();
        $(this).before('<input type="'+new_type+'" value="' +value+ '" name="' +name+ '" value="' +value+ '"id="' +id+ '" class="' +klass+ '" />');

    });
})
</script>
