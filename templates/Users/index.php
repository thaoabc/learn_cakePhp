<!DOCTYPE html>
<html>
<body>
<h1>Users</h1>

<?= $this->Form->create(null,['type'=>'get']) ?>
<?= $this->Form->control('key',['label'=>'Search','value'=>$this->request->getQuery('key')]) ?>
<?= $this->Form->submit() ?>
<?= $this->Form->end() ?>

<div id="form_add" style="display:none;border: solid 1px; padding: 20px; background: #ddd;">
    <?= $this->Form->create(null, ['type' => 'file']); ?>
    <?= $this->Form->control('user_name',['id'=>'user_name']);
    if(isset($errors['user_name']))
    {
        foreach($errors['user_name'] as $err)
        { ?>
            <p style='color:red'><?= $err; ?></p>
        <?php }
    } ?>
    <?= $this->Form->control('email',['id'=>'email']); 
    if(isset($errors['email']))
    {
        foreach($errors['email'] as $err)
        { ?>
            <p style='color:red'><?= $err; ?></p>
        <?php }
    }?>
    <?= $this->Form->control('password',['id'=>'password']); 
    if(isset($errors['password']))
    {
        foreach($errors['password'] as $err)
        { ?>
            <p style='color:red'><?= $err; ?></p>
        <?php }
    }?>
    <?= $this->Form->input('position', array(
        'type'=>'select',
        'label'=>'Role',
        'options'=>['admin','user'],
        'value'=>2,
        'id' => 'position'
        )); ?>
    <?= $this->Form->input('image_file',['type'=>'file','id'=>'image_file']); 
    if(isset($errors['image_file']))
    {
        foreach($errors['image_file'] as $err)
        { ?>
            <p style='color:red'><?= $err; ?></p>
        <?php }
    }?>
    <!-- <a href = '#' id = 'btn_submit'>Add menmber</a> -->
    <?= $this->Form->button('Click me',array('id'=>'btn_submit','type'=>'button')); ?>
    <?= $this->Form->end(); ?>
</div>
<table>
    <tr>
        <th>
        <?= 
        $this->Form->button(
            'Add Member By Ajax',array('id'=>'add')
        );
        ?>
            
        </th>
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
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
        <!-- <th>View</th> -->
    </tr>

<?php foreach ($database as $data): ?>
    <tr>
        <td>
            <?= $this->Html->link($data->user_name, ['action' => 'view', $data->id]) ?>
        </td>
        <td>
        <img src="<?= $this->Url->image('uploads/'.$data->image); ?>"; style="height:90px; width:80px">
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
            <?= $this->Html->link("", ['action' => 'view', $data->id],array(
            'class' => 'glyphicon glyphicon-eye-open'))
            ?>
        </td>
        <td>
            <?= $this->Html->link('', ['action' => 'edit', $data->id],array(
            'class' => 'glyphicon glyphicon-pencil')) ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                '',
                ['action' => 'delete', $data->id],array('class'=>'glyphicon glyphicon-trash'),
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
        <!-- <td>
            <button id="view" onclick="myFunction()" type="submit" value=< //$data->id >View</button>
        </td> -->

    </tr>
    <tr>
        <div id="content">
            
        </div>
    </tr>
<?php endforeach; ?>

</table>
<ul  class='pagination'>
    <?= $this->Paginator->prev() ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next() ?>
</ul>
<div id="error" style="color: red;"></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script type="text/javascript">


    $("#btn_submit").on("click", function(){
		var user_name = $("#user_name").val();
		var email = $("#email").val();
        var password = $("#password").val();
        var position = $("#position").val();
        var targeturl = '<?= $this->Url->build(["controller"=>"Users","action"=>"index"]); ?>';

        var fileInput = document.getElementById('image_file');
        var filePath = fileInput.value; //lấy giá trị input theo id
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; //các tập tin cho phép
        if(user_name == ''||email==''||password==''||position==''||filePath==''){
          alert('Vui lòng nhập đầy đủ các trường');
          return false;
        }
        // Kiểm tra định dạng
        if (!allowedExtensions.exec(filePath)) {
            alert('Bạn chỉ có thể dùng ảnh dưới định dạng .jpeg/.jpg/.png/.gif extension.');
            fileInput.value = '';
            return false;
        } else {
            if (fileInput.files && fileInput.files[0]) {
                var image_file=fileInput.files[0];
                var form = new FormData();
                form.append('image_file', fileInput.files[0]);
                form.append('user_name', user_name);
                form.append('email', email);
                form.append('password', password);
                form.append('position', position);
                
                $.ajax({
                    url: targeturl,
                    type: "POST",
                    //data: { username : username,email:email,position:position, password : password,image_file:image_file },
                    data:form,
                    dataType:'text',
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data) {
                        alert("Thêm bản ghi thành công");
                        document.getElementById("form_add").style.display = 'none';
                        //$('#content').html(data);
                        window.location.reload(1);
                        // if(data.success) {
                        //     alert(data.amount);                         
                        // } else {
                        //     alert(data.data.message);
                        // }
                    },
                    error: function(errorThrown){
                        alert("errorThrown");
                    } 
                });
            }
        }
    });

    document.getElementById("add").onclick = function () {
                document.getElementById("form_add").style.display = 'block';
            };

</script>

</body>
</html>