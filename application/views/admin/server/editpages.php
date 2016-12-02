<?php
echo $work_in_progress;
/*

    // this function lists all the files in a directory and its subdirectories (only 1 level deeper)
    function listFiles($directory, $subdirlevel, $basedir = null) {
        $files = scandir($directory);
        foreach($files as $file) {
            if($file != '.' && $file != '..' && $file != '.DS_Store' && $subdirlevel < 3) {     
                if(is_dir($directory.'/'.$file)) {
                    listFiles($directory.'/'.$file,$subdirlevel+1,$file . '/');
                }
                else {
                    $selected = '';
                    if ($subdirlevel == 1) {
                        // loads dashboard.php by default (if there is no dashboard file, it will select the first file by default)
                        if ($file == 'dashboard.php') {
                            $selected = "selected";
                        }
                    }
?>
                            <option value='<?=$GLOBALS['path_lpb'] . $basedir . $file?>' <?=$selected?>><?=$basedir . $file?></option>
<?php
                }
            }
        }
    }
?>
            <div class="col-sm-12">
                <small>Please note that the delete and save functionalities are a little buggy. Your browser might freeze but it should not prevent the server from saving or deleting the file.</small>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2>Edit Page</h2>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <form id="page_selector" action="submit/display_page.php" method="post" target="#page_to_edit" default_loading_message success_message="The page was loaded.">
                    <div class="col-sm-3 input-lg">
                        <label>Choose a file: </label>
                    </div>
                    <div class="col-sm-12">
                        <select  class='input-lg' name="page_to_display">
<?=listFiles($path_lpb,1)?>
                        </select>
                        <button type="submit" class="btn btn-lg btn-primary" style="margin-top: 0.15rem; margin-bottom: 0.25rem;">Display</button>
                    </div>
                    </form>
                </div>
            </div>
            <div id="page_to_edit"></div>
            <div class="row">
                <div class="col-sm-12">
                    <h2>Create/Delete Page</h2>
                </div>
            </div>
            <div class="row">
                  <div class="form-group">
                    <form id="page_creator" action="submit/create_or_delete_page.php" method="post" target="#error_feedback" default_loading_message success_message="The page was created/deleted.">
                    <div class="col-sm-12 input-lg">
                        <label>Enter a file name: </label>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-4 col-xs-8">
                        <input  class='form-control input input-lg' name="page_to_create_or_destroy">
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-1">
                        <select name="action" class='input input-lg' style="margin: 0; margin-top: 0.25rem">
                            <option value='create'>Create</option>
                            <option value='delete'>Delete</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1">
                        <button type="submit" class="btn btn-lg btn-primary">Create/Delete</button>
                    </div>
                    </form>
                </div>
            </div>
            <script>
                // submit the page selector form by default
                $(document).ready(function() {
                    $('#page_selector').submit()
                });
            </script>
<?php
*/
?>