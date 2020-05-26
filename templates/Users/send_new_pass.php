<?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'sendNewPass']
]); ?>
<?php
    echo $this->Form->control('password');
    if(isset($errors['password']))
    {
        foreach($errors['password'] as $err_pass)
        { ?>
            <p style='color:red'><?= $err_pass; ?></p>
        <?php }
    }
    echo $this->Form->control('confirm_password',['type'=>'password']);
    if(isset($errors['confirm_password']))
    {
        foreach($errors['confirm_password'] as $err_pass)
        { ?>
            <p style='color:red'><?= $err_pass; ?></p>
        <?php }
    }
    echo $this->Form->hidden('passkey', ['value'=>$passkey]);
    echo $this->Form->button(__('Resetpass'));
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