<?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'login']
]); ?>
<?php
    echo $this->Form->control('email');
    echo $this->Form->control('password');
    echo $this->Html->link("Click me if you forgot your pass.",['controller'=>'Users','action'=>'resetPassword'],array('style' => 'color:red;font-size:20px;'));
?>
    <br>
<?php
    echo $this->Form->button(__('Login'));
    echo $this->Form->end();
?>
