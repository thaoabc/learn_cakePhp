<!DOCTYPE html>
<html>
<body>
<?php  echo $this->Form->create(null); ?>
<?php
    echo $this->Form->control('email',array('id'=>'email'));
    // echo $this->Form->input(
    //         'Send',
    //         ['type' => 'button','id'=>'submit']
    //         );
    echo $this->Form->button(__('Send'),['id'=>"submit",'type'=>'button','value'=>'1']);
    echo $this->Form->end();
?>
<div>
    <h3><?= $this->Html->link('Back',['controller'=>'Users','action'=>'login']) ?></h3>
</div>
<h1 id="clock" style="text-align:center">

</h1>
<input type="hidden" id="email_token">
<div id="form_check" style="display:none">
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
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
<!-- <?= $this->fetch('script') ?> -->
<?= $this->fetch('js') ?>
<!-- <script src="js/jquery.countdown.js"></script> -->
<script type="text/javascript">

    $('#submit').on("click",function(){
        console.log($('#submit').val());
        if($('#submit').val()==0)
        {
            return false;
        }
        document.getElementById("submit").value =0;
        console.log($('#submit').val());
        var targeturl = '<?= $this->Url->build(["controller"=>"Users","action"=>"resetPassword"]); ?>';
        var email = $("#email").val();
        if(email == ''){
          alert('Vui lòng nhập đầy đủ các trường');
          return false;
        }
        var form = new FormData();
        form.append('email', email);
		$.ajax({
		  url: targeturl,
		  type: "POST",
		  data: form,
          dataType:'text',
          contentType: false,
          processData: false,
          cache: false,
		  success : function(data){
            if(data)
            {
            document.getElementById("form_check").style.display = 'block';
            document.getElementById("email_token").value =email;
            document.getElementById("submit").value =0;
            alert("Check email để lấy key");
            countdown();
            }
          },
          error: function(error)
          {
            document.getElementById("submit").value =1;
          }
        });
    });

    function countdown()
    {
        var counter=60;
        var email_token=$("#email_token").val();
        console.log(email_token);
        var timer=setInterval(function() {
            counter--;
            if(counter>=0)
            {
                document.getElementById("clock").innerHTML=counter;
            }
            else
            {
                document.getElementById("clock").innerHTML='';
                document.getElementById("submit").value =1;
                clearInterval(timer);
                
            }
        }, 1000);
        setTimeout(function(){
            document.getElementById("form_check").style.display = 'none';
            var targeturl = '<?= $this->Url->build(["controller"=>"Users","action"=>"destroytoken"]); ?>';
            var form = new FormData();
            form.append('email_token', email_token);
            $.ajax({
                url: targeturl,
                type: "POST",
                data: form,
                dataType:'text',
                contentType: false,
                processData: false,
                cache: false,
                success : function(data){
                    if(data)
                    {
                    alert("Hết phiên làm việc");
                    }
                }
            });
        }, 60000);
    };
   

    // $( document ).ready(function() {
    //   console.log( "ready!" );
    //      // 15 days from now!
    //     var date = new Date(new Date().valueOf() + 15 * 24 * 60 * 60 * 1000);
    // $('#clock').countdown(date, function(event) {
    //     $(this).html(event.strftime('%D days %H:%M:%S'));
    // });
 //});
//   $("#clock").Countdown("2017/01/01", function(event) {
//     $(this).html(
//       event.strftime('%D days %H:%M:%S')
//     );
//   });

// $("#t").on("click", function(){
// 		// var error = $("#error");
//         var targeturl = '<?= $this->Url->build(["controller"=>"Users","action"=>"resetPassword"]); ?>';

// 		$.ajax({
// 		  url: targeturl,
// 		  type: "GET",
// 		  data: {},
//           dataType:'text',
// 		  success : function(data){
//             if(data)
//             {
//             document.getElementById("form_check").style.display = 'block';
//             alert("Check your email for your reset password link");
//             alert(data);
//             }
// 		  }
// 		});

// 	});
</script>

