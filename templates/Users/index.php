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
        <td>
            <p><?= $this->Html->link("Add User", ['action' => 'add']) ?></p>
        </td>
        <td>
            <p><?= $this->Html->link("Logout", ['action' => 'logout']) ?></p>
        </td>
        <td>
            <p><?= $this->Html->link("Phần gửi mail của người dùng", ['controller'=>'Mail','action' => 'sendMailOfUser']) ?></p>
        </td>
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
            <?= @$this->Html->image($data->image) ?>
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
<div class="result"></div>
<!-- <script>
    $(document).ready(function(){
        $('button#view').on('submit', function(e){
            var id = $('#view').val();
            e.preventDefault();
        if (name) 
        {
            $.ajax({
                url: ' $this->Url->build(['controller'=>'Users','action'=>'view',$x]) ?>',
                type: 'post',
                dataType: 'json',
                success: function(result){
                    $('.result').html(result);
                    }
            });
        }
        });
    });
</script> -->

<script type="text/javascript" src="jquery-1.3.2.js"> </script>

<script type="text/javascript">

function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "ajax_info.txt", true);
  xhttp.send();
}
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