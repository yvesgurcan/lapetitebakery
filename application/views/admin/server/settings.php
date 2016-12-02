<?php
    $dev_access_only = true;
?>

            <div class="row">
                <div class="col-sm-12">
                    <h2>Server Settings</h2>
                </div>
            </div>
            <form>
                <!-- TODO: allow developer to manually change values but also give them the option to let the script manage itself with default values; make sure that paths are Mac and Windows friendly -->
                <div class="form-group">
                    <label class="control-label">Server Name <small class="text-muted">$_SERVER['SERVER_NAME']</small></label>
                    <input class="form-control input-lg" value="<?=$_SERVER['SERVER_NAME']?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label">Server Document Root <small class="text-muted">$_SERVER['DOCUMENT_ROOT']</small></label>
                    <input class="form-control input-lg" value="<?=$_SERVER['DOCUMENT_ROOT']?>" disabled>
                </div> 
                <div class="form-group">
                    <label class="control-label">CodeIgniter URL <small class="text-muted">site_url()</small></label>
                    <input class="form-control input-lg" value="http://<?=site_url()?>" disabled>
                </div>
              
                <div class="form-group">
                    <label class="control-label">CodeIgniter Path <small class="text-muted">FCPATH</small></label>
                    <input class="form-control input-lg" value="<?= FCPATH?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label">PHPMyAdmin URL <small class="text-muted">PHPMYADMIN</small></label>
                    <input class="form-control input-lg" value="<?=PHPMYADMIN?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label">Control Panel URL <small class="text-muted">CONTROL_PANEL</small></label>
                    <input class="form-control input-lg" value="<?=CONTROL_PANEL?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label">Control Panel MySQL config URL <small class="text-muted">CONTROL_PANEL_MYSQL</small></label>
                    <input class="form-control input-lg" value="<?=CONTROL_PANEL_MYSQL?>" disabled>
                </div>
            </form>