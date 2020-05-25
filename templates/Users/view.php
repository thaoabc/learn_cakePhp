<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<h1>Profile</h1>
<table>
    <tr>
        <th>Avatar</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    <tr>
        <td>
            <img src="<?= $this->Url->image('uploads/'.$user->image); ?>"; style="height:90px; width:80px">
        </td>
        <td>
            <p class="fas fa-heart">
                <?= $user->user_name ?>
            </p>
        </td>
        <td>
        <p class="fas fa-heart">
            <?= $user->email ?>
        </p>
        </td>
        <td>
            <?php
                if($user->position==0)
                {
                    echo"Admin";
                }
                else
                {
                    echo "User";
                }
            ?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $user->id],array('class'=>'glyphicon glyphicon-pencil')) ?>
        </td>
    </tr>

</table>