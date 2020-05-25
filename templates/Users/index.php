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
    <!-- <? $this->Form->control(__('Add Member',array('id'=>'btn_submit'))); ?> -->
    <?= $this->Form->end(); ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">

    $("#btn_submit").on("click", function(){
		 var username = $("#user_name").val();
		 var email = $("#email").val();
         var password = $("#password").val();
         var position = $("#position").val();
        //  var image_file=$("#image").files[0];
        //  alert(image_file);
		// var error = $("#error");
        var targeturl = '<?= $this->Url->build(["controller"=>"Users","action"=>"testAdd"]); ?>';

		$.ajax({
            url: targeturl,
            type: "POST",
            data: { username : username,email:email,position:position, password : password },
            dataType:'text',
            success : function(data){
                $("#message").html(data);
                $("p").addClass("alert alert-success");
                $('#result').html(data);
                alert('yes');
                },
            error: function(err) {
            alert(err);
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