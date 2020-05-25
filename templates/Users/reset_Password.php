<!DOCTYPE html>
<html>
<body>
<?php  echo $this->Form->create(null); ?>
<?php
    echo $this->Form->control('email');
    // echo $this->Form->input(
    //         'Send',
    //         ['type' => 'button','id'=>'submit']
    //         );
    echo $this->Form->button(__('Send'),['id'=>"submit"]);
    echo $this->Form->end();
?>
<div id="form_check">
    <?= "Điền mã bạn nhận được trong email vào đây";?>
    <?= $this->Form->create(null,['url'=>['controller'=>'Users','action'=>'sendNewPass']]); ?>
    <?= $this->Form->control('checkkey'); ?>
    <?= $this->Form->button(__('Sendpasskey'));?>
    <?= $this->Form->end(); ?>
    <!-- <?= $this->Form->time('close_time', [
    'value' => '00:01:30'
]);?> -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">

$("#t").on("click", function(){
		// var error = $("#error");
        var targeturl = '<?= $this->Url->build(["controller"=>"Users","action"=>"resetPassword"]); ?>';

		$.ajax({
		  url: targeturl,
		  type: "GET",
		  data: {},
          dataType:'text',
		  success : function(data){
            if(data)
            {
            document.getElementById("form_check").style.display = 'block';
            alert("Check your email for your reset password link");
            alert(data);
            }
		  }
		});

	});
</script>

