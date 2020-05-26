 
<!DOCTYPE html>
<html>
<body>
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
                <?php echo $this->Form->input('user_name',['value'=>$User->user_name,'id'=>'user_name']); ?>
            </td>
        </tr>
        <tr>
        <th>Email</th>
            <td>
                <?php echo $this->Form->input('email',['value'=>$User->email,'id'=>'email']); ?>
            </td>
        </tr>
        <tr>
        <th>Password</th>
            <td>
                <?php echo $this->Form->input('password',['type'=>'password','value'=>$User->password,'id'=>'password']); ?>
            </td>
        </tr>

        <th>Position</th>
            <td>
                <?= $this->Form->input('position', array(
                    'type'=>'select',
                    'label'=>'Role',
                    'options'=>['admin','user'],
                    'value'=>2,
                    'id'=>'position'
                    )); ?>
            </td>

        <tr>
        <th>Image</th>
            <td>
                <?php echo $this->Form->control('image_file',['type'=>'file','id'=>'image','onchange'=>'showIMG()']); ?>
                <label for="" style="margin-left: 10px"> Ảnh hiển thị : </label>
                <div id="viewImg">
                    <img width="100px" src="<?= $this->Url->image('uploads/'.$User->image); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <?php echo $this->Form->submit('Update',['class','btn-btn warning']); ?>
        </tr>

    </table>
<?php echo $this->Form->end(); ?>

<?= $this->Form->button('Demo',['id'=>'view','onclick'=>'myFunction()']); ?>
<div id="demo" style="display:none">

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Position</th>
    </tr>
    <tr>
        <td>
            <?= $this->Form->input('Name',array('id'=>'demo_name')) ?>
        </td>
        <td>
            <?= $this->Form->input('Email',array('id'=>'demo_email')) ?>
        </td>
        <td>
            <?= $this->Form->input('Email',array('id'=>'demo_pass')) ?>
        </td>
        <td>
            <?= $this->Form->input('Position',array('id'=>'demo_position')) ?>
        </td>
    </tr>

</table>

</div>
<!-- <div class="preview"> <img id="thumb" width="100px" height="100px" src="/images/icons/128px/zurb.png" /> </div> -->
<!-- <span class="wrap hotness">
<form id="newHotnessForm" action="/playground/ajax_upload">
</form>
</span> -->

<script src="/js/jquery.min.js" type="text/javascript"></script>  
<script src="/js/ajaxupload.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
<!--Demo project -->
function myFunction() {
  var user_name = document.getElementById("user_name").value;
  var password=document.getElementById("password").value;
  var email=document.getElementById("email").value;
  var position=document.getElementById("position").value;

  document.getElementById("demo").style.display = 'block';
  document.getElementById("demo_name").value = user_name;
  document.getElementById("demo_email").value = email;
  document.getElementById("demo_pass").value = password;
  if(position==0)
  {
    document.getElementById("demo_position").value = "Admin";
  }
  else
  {
    document.getElementById("demo_position").value = "User";
  }
}

<!--Input hiển thị mật khẩu -->
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

<!--Hiển thị ảnh trước khi upload hình -->
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
</body>
</html>