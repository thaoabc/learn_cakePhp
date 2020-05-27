<div class="productCategories form">
<?php echo $this->Form->create(null,['url'=>['controller'=>'Categories','action'=>'edit',$data->id]]);?>
    <fieldset>
         <legend><?php __('Add Category'); ?></legend>
    <?php
        echo $this->Form->control('name',['value'=>$data->name]);
        echo "<h4>Parent<br></h4>";
        echo $this->Form->input('parent_id',array('type'=>'select','options'=>$categories,'empty'=>'--Choose parent--'));        
        // echo $this->Form->control('published');       
        echo $this->Form->button('Save');
        echo $this->Form->end();
    ?>
    </fieldset>
</div>