<?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'resetPassword']
]); ?>
<?php
    echo $this->Form->control('email');
    echo $this->Form->button(__('Send'));
    echo $this->Form->end();
?>
