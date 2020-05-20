<div class="productCategories left" style="float: left;">
    <h2>Menu</h2>
    <ol>
    <?php
    //pr($categories);
        foreach($categories as $item)
        { ?>
            <!-- <li> <?=$item ?></li> -->
            <?php
            // foreach ($all_list as $Category)
            // {
            //     if(isset($categories[$Category['parent_id']]) && $categories[$Category['parent_id']]==$item)
            //     {
            //         pr($Category['parent_id']);
            //         echo $categories[17];
            //         echo "<ul>".$categories[$Category['parent_id']]."</ul>";
            //     }
            // }
        }
    ?>
    </ol>
</div>

<!-- Modify menu tree-->
<div class="productCategories index">
    <h2>Modify | <?php echo $this->Html->link("Add new",array("controller"=>"categories","action"=>"add"));?></h2>
    <h2><?php __('Categories');?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Parent ID</th>
            <th>Published</th>            
            <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
    $i = 0;    
    foreach ($all_list as $Category){
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
    ?>
    <tr<?php echo $class;?>>
        <td><?php echo $Category['id']; ?>&nbsp;</td>
        <td><?php echo $Category['name']; ?>&nbsp;</td>
        <td><?= isset($categories[$Category['parent_id']]) ? $categories[$Category['parent_id']] : ''; ?>&nbsp;</td>
        <td><?php echo $Category['published']; ?>&nbsp;</td>
    </tr>
<?php } ?>
    </table>
</div>
<?= $this->element('test')?>
<style>
    .altrow{
        background-color: #ececec
    }
</style>