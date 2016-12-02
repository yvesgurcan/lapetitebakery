<?php
$dev_access_only = true;
?>
            <div class="row">
                <div class="col-sm-12">
                    <h2>Users</h2>
                </div>
            </div>
                <form id="update_users" method="post" action="ajax/save_users" target="#error_feedback" class="form-group" loading_message="Saving user credentials..." success_message="User credentials saved" database=true>
                <table class="table table-responsive" id="user-table">
                    <tr scope="row">
                        <td class="col-xs-3">Username</td>
                        <td class="col-xs-1">Access</td>
                        <td class="col-xs-4">Email</td>
                        <td class="col-xs-4">New password</td>
                    </tr>

<?php
    $i = 0;   
    foreach ($users as $user) {
?>
        <tr>    
            <td><input class="form-control" value="<?=$user->user?>" name="user[<?=$i?>]" placeholder="Enter a username."></td>
            <td><input type="number" class="form-control" value="<?=$user->access?>" name="access[<?=$i?>]" placeholder="Enter the privilege level of the user." ></td>
            <td><input class="form-control" placeholder="Enter the email address of the user." value="<?=$user->email?>" name="email[<?=$i?>]"></td>
            <td><input type="password" name="password[<?=$i?>]" class="form-control" value="" placeholder="Enter a new password."></td>
        </tr>
        <?php // hidden input fields to keep user IDs consistant when updating the database ?>
        <input value="<?=$user->id?>" name="id[<?=$i?>]" hidden>
<?php
        $i++;
    }
?>
        <tr>    
            <td><input class="form-control" name="user[<?=$i?>]" placeholder="Enter a new username."></td>
            <td><input type="number" class="form-control" name="access[<?=$i?>]" placeholder="Enter the privilege level of the new user." ></td>
            <td><input class="form-control" placeholder="Enter the email address of the new user." name="email[<?=$i?>]"></td>
            <td><input type="password" name="password[<?=$i?>]" class="form-control" placeholder="Enter a password for the new user."></td>
        </tr>
        <input value="<?=$i+1?>" name="id[<?=$i?>]" hidden>
                    
            </table>
            <button type="submit" class="btn btn-primary btn-lg">Save User Credentials</button>
            </form>
            <div id="dump"></div>
            <div class="row">
                <div class="col-sm-12">
                    <h2>Hash Password</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form id="hash-from" action=submit/hash_password.php method=post target='#hash_password' default_loading_message succes_message="Done.">
                        <label>Password</label><input type=password name=password_to_convert class="form-control input-lg">
                        <div id=hash_password></div>
                        <button class="btn btn-primary btn-lg">Hash!</button>
                    </form>
                    
                </div>
                <div id=query_results>
                </div>
            </div>