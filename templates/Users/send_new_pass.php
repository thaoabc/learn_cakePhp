<?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'sendNewPass',$passkey]
]); ?>
<?php
    echo $this->Form->control('password');
    echo $this->Form->control('Confirm Password');
    echo $this->Form->button(__('Send'));
    echo $this->Form->end();
?>
