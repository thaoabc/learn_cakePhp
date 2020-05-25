<?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'login']
]); ?>
<?php
    echo $this->Form->control('email');
    echo $this->Form->control('password');
    echo $this->Html->link("Bạn quên mật khẩu",['controller'=>'Users','action'=>'resetPassword']);
    echo $this->Form->button(__('Login'));
    echo $this->Form->end();
?>
