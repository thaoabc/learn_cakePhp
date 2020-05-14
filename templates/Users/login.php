<?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'login']
]); ?>
    <!-- <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>

        <tr>
            <td>
                <input type="text" name="user_name">
            </td>
            <td>
                <input type="email" name="email">
            </td>
            <td>
                <input type="password" name="password">
            </td>
        </tr>
        <tr>
            <td><button type="submit" value="submit">Submit</button></td>
        </tr>

    </table> -->
<?php
    //echo $this->Form->create($data);
    // Hard code the user for now.
    //@csrf;
    echo $this->Form->control('email');
    echo $this->Form->control('password');
    echo $this->Form->button(__('Login'));
    echo $this->Form->end();
?>
