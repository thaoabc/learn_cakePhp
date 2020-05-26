<?php  
    echo $this->Form->create(null, ['type' => 'file','url' => ['controller' => 'Users', 'action' => 'add']]);
?>
    <h1>Add Article</h1>
<?php
    echo $this->Form->control('user_name',array('required' => false, 'error' => true));
    if(isset($errors['user_name']))
    {
        foreach($errors['user_name'] as $err)
        { ?>
            <p style='color:red'><?= $err; ?></p>
        <?php }
    }
    echo $this->Form->control('email',array('required' => false, 'error' => true));
    if(isset($errors['email']))
    {
        foreach($errors['email'] as $err)
        { ?>
            <p style='color:red'><?= $err; ?></p>
        <?php }
    }
    echo "<h4>Password</h4>";
    echo $this->Form->input('password',['type'=>'password']);
    if(isset($errors['password']))
    {
        foreach($errors['password'] as $err)
        { ?>
            <p style='color:red'><?= $err; ?></p>
        <?php }
    }
    echo "<h4>Position<br></h4>";
    echo $this->Form->input('position', array(
        'type'=>'select',
        'label'=>'Role',
        'options'=>['admin','user'],
        'value'=>2
        ));
    echo $this->Form->control('image_file',['type'=>'file','id'=>'image','onchange'=>'showIMG()']);
    if(isset($errors['image_file']))
    {
        foreach($errors['image_file'] as $err)
        { ?>
            <p style='color:red'><?= $err; ?></p>
        <?php }
    }
    ?>
    
    <label for="" style="margin-left: 10px"> Ảnh hiển thị : </label>
    <div id="viewImg">

    </div>
<?php 
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
<script type ="text/javascript">


    function showIMG() {
        var fileInput = document.getElementById('image');
        var filePath = fileInput.value; //lấy giá trị input theo id
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; //các tập tin cho phép
        //Kiểm tra định dạng
        if (!allowedExtensions.exec(filePath)) {
            alert('Bạn chỉ có thể dùng ảnh dưới định dạng .jpeg/.jpg/.png/.gif extension.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('viewImg').innerHTML = '<img style="width:100px; height: 100px;" src="' + e.target.result + '"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

</script>
