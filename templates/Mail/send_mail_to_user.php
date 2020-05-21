<?php  
    echo $this->Form->create(null, ['type' => 'file','url' => ['controller' => 'Mail', 'action' => 'send_mail_to_user']]);
?>
    <h1>Add Article</h1>
<?php
    echo $this->Form->control('set_subject');
    echo $this->Form->control('email');
    echo $this->Form->control('content');
    echo $this->Form->button(__('Send Mail'));
    echo $this->Form->end();
?>
