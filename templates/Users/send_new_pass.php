<?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'sendNewPass']
]); ?>
<?php
    echo $this->Form->control('password');
    echo $this->Form->control('Confirm Password');
    echo $this->Form->hidden('passkey', ['value'=>$passkey]);
    echo $this->Form->button(__('Resetpass'));
    echo $this->Form->end();
?>
