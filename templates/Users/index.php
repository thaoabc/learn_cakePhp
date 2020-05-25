<!DOCTYPE html>
<html>
<body>
<h1>Users</h1>

<?= $this->Form->create(null,['type'=>'get']) ?>
<?= $this->Form->control('key',['label'=>'Search','value'=>$this->request->getQuery('key')]) ?>
<?= $this->Form->submit() ?>
<?= $this->Form->end() ?>

<table>
    <tr>
        <th>
        <?= 
        $this->Form->input(
            'Add Member By Ajax',
            ['type' => 'button','id'=>'add']
            );
        ?>
            
        </th>
        <th>
        <?= 
        $this->Html->link(
            'Add Member By Next Page',
            ['action' => 'add']
            );
        ?>
            
        </th>
        <th>
            <p><?= $this->Html->link("Logout", ['action' => 'logout']) ?></p>
        </th>
        <th>
            <p><?= $this->Html->link("Phần gửi mail của người dùng", ['controller'=>'Mail','action' => 'sendMailToUser']) ?></p>
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
            <?= $this->Html->link('Edit', ['action' => 'edit', $data->id]) ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $data->id],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
        <!-- <td>
            <button id="view" onclick="myFunction()" type="submit" value=< //$data->id >View</button>
        </td> -->

    </tr>
<?php endforeach; ?>

</table>
<ul  class='pagination'>
    <?= $this->Paginator->prev() ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next() ?>
</ul>
<div id="error" style="color: red;"></div>
<div id="form_add" style="display:none;border: solid 1px; padding: 20px; background: #ddd;">
    <?= $this->Form->create(null, ['type' => 'file']); ?>
    <?= $this->Form->control('user_name',['id'=>'user_name']); ?>
    <?= $this->Form->control('email',['id'=>'email']); ?>
    <?= $this->Form->control('password',['id'=>'password']); ?>
    <?= $this->Form->input('position', array(
        'type'=>'select',
        'label'=>'Role',
        'options'=>['admin','user'],
        'value'=>2,
        'id' => 'position'
        )); ?>
    <?= $this->Form->control('image_file',['type'=>'file','id'=>'image']); ?>
    <a href = '#' id = 'btn_submit'>Add menmber</a>
    <!-- <? $this->Form->control(__('Add Member',['id'=>'btn_submit'])); ?> -->
    <?= $this->Form->end(); ?>
</div>
<div id='result2'>
    
</div>
<div id='demo-ajax'>
    
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">

    $("#btn_submit").on("click", function(){
		 var username = $("#username").val();
		 var email = $("#email").val();
         var password = $("#password").val();
         var position = $("#position").val();
		// var error = $("#error");
        var targeturl = '<?= $this->Url->build(["controller"=>"Users","action"=>"add"]); ?>';

		// resert thẻ div thông báo trở về rỗng mỗi khi click nút đăng nhập
		// error.html("");

		// // Kiểm tra nếu username rỗng thì báo lỗi
		// if (username == "") {
		// 	error.html("Tên người dùng không được để trống");
        //     alert("no");
		// 	return false;
		// }
		// // Kiểm tra nếu password rỗng thì báo lỗi
		// if (password == "") {
		// 	error.html("Mật khẩu không được để trống");
		// 	return false;
		// }
		
		// Chạy ajax gửi thông tin username và password về server add
		// để kiểm tra thông tin hợp lệ hay chưa
		$.ajax({
		  url: targeturl,
		  type: "GET",
		  data: { username : username,email:email,position:position, password : password },
          dataType:'json',
		  success : function(result){
            var html = '';
                        html += '<table border="1" cellspacing="0" cellpadding="10">';
                        html += '<tr>';
                           html += '<td>';
                                html += 'Username';
                                html += '</td>';
                                html += '<td>';
                                html += 'Email';
                           html += '</td>';
                        html += '<tr>';
                         
                        // Kết quả là một object json
                        // Nên ta sẽ loop result
                        $.each (result, function (key, item){
                            html +=  '<tr>';
                                html +=  '<td>';
                                    html +=  item['user_name'];
                                html +=  '</td>';
                                html +=  '<td>';
                                    html +=  item['email'];
                                html +=  '</td>';
                            html +=  '<tr>';
                        });
                         
                        html +=  '</table>';
                         
                        $('#result2').html(html);
		  }
		});

	});

    document.getElementById("add").onclick = function () {
                document.getElementById("form_add").style.display = 'block';
            };

    // $(document).ready(function(){
    // var response = '';
    // $.ajax({ type: "GET",   
    //         url: "Records.php",   
    //         async: false,
    //         success : function(text)
    //         {
    //             response = text;
    //         }
    // });

    // alert(response);
    // });

//     $(document).ready(function() {

//        $("#display").click(function() {                

//          $.ajax({    //create an ajax request to display.php
//            type: "GET",
//            url: "display.php",             
//            dataType: "html",   //expect html to be returned                
//            success: function(response){                    
//                $("#responsecontainer").html(response); 
//                //alert(response);
//            }

//        });
// });
// });
</script>

</body>
</html>