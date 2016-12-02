            <div class="container">
                <div class="vertical-spacer"></div>
                <div class="row">
                    <!-- left spacer (no need for a right spacer) -->
                    <div class="col-md-4 col-sm-3 col-xs-2"></div>
                    <!-- login box -->
                    <div class="col-md-4 col-sm-6 col-xs-8">
                        <h1>Bonjour&nbsp;!</h1>
<?php
    // if user bounced back from login.php
    if(isset($_GET['incorrect'])) {
?>
                        <div class='alert-login alert alert-info alert-login fade in text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Incorrect login.</div>
<?php
    }
    // if user logged out
    else if(isset($_GET['logout'])) {
?>
                        <div class='alert alert-info alert-login fade in text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Thank you. You may log in again.</div>
<?php
    }
?>
                    <form method="post" action="<?=site_url('verifylogin')?>">
                        <div class="form-group">
                            <div class="text-center">
                                <small id="login-help" class="form-text text-muted">Please log in to access the dashboard.</small>
                            </div>
                        <input class="form-control input-lg" type=text name=user placeholder=username required>
                        <input class="form-control input-lg" type=password name=password placeholder=password required>
                        <button class="login btn btn-primary btn-lg btn-block" type=submit>Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="vertical-spacer"></div>
        </div>