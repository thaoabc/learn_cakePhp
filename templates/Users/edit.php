 
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
                <?php echo $this->Form->input('password',['value'=>$User->password,'id'=>'password']); ?>
            </td>
        </tr>

        <tr>
        <th>Image</th>
            <td>
                <?php echo $this->Form->control('image_file',['type'=>'file','id'=>'imageUpload']); ?>
            </td>
        </tr>
        <tr>
            <?php echo $this->Form->submit('Update',['class','btn-btn warning']); ?>
        </tr>

    </table>
<?php echo $this->Form->end(); ?>

<?= $this->Form->button('Demo',['id'=>'view','onclick'=>'myFunction()']); ?>

<div id="demo_name"></div>
<div id="demo_email"></div>
<div id="demo_pass"></div>
<!-- <div class="preview"> <img id="thumb" width="100px" height="100px" src="/images/icons/128px/zurb.png" /> </div> -->
<!-- <span class="wrap hotness">
<form id="newHotnessForm" action="/playground/ajax_upload">
</form>
</span> -->

<script src="/js/jquery.min.js" type="text/javascript"></script>  
<script src="/js/ajaxupload.js" type="text/javascript"></script>
<script>
function myFunction() {
  var user_name = document.getElementById("user_name").value;
  var password=document.getElementById("password").value;
  var email=document.getElementById("email").value;
  document.getElementById("demo_name").innerHTML = user_name;
  document.getElementById("demo_email").innerHTML = email;
  document.getElementById("demo_pass").innerHTML = password;
}
// $(document).ready(function(){
//     <-- Chọn vị trí ảnh thumbnail sẽ hiển thị -->
//     var thumb = $('img#thumb');
//     <-- Chọn input trong form có id là imageUpload -->
//     new AjaxUpload('imageUpload', {
//         // <-- Lấy thuộc tính action từ html -->     
//         // action: $('form#newHotnessForm').attr('action'),
//         // <-- Đặt tên để sử dụng với server side script -->
//         // name: 'image',
//         <-- Sau khi chọn file thêm class loading vào div preview -->
//         onSubmit: function(file, extension) {
//             $('div.preview').addClass('loading');
//         },
//         <-- Sau khi file upload xong bỏ class loadding và hiển thị ảnh thumbnail bằng cách thay đổi thuộc tính src -->
//         onComplete: function(file, response) {
//             thumb.load(function(){
//                 $('div.preview').removeClass('loading');
//                 thumb.unbind();
//             });
//             thumb.attr('src', response);
//         }
//     });
// });
</script>
</body>
</html>