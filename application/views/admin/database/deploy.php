            <div class="row">
                <div class="col-sm-12">
                   
                    <h2>Export Database</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                     <?php
                    echo $work_in_progress_section;
                    /* ?>
                    <p>You can save the database used by <i>La Petite Bakery</i> (currently: <i><?=$this->db->database?></i>) into a SQL file. The file will be saved on the server in the private folder </p>
                </div>
            </div>
            <div class="row">
                <form class="form-horizontal" id="export_database" method="post" action="submit/db_export.php" target="#export_results" loading_message="Exporting database..." success_message="The database was successfully exported.">
                    <div class="form-group-lg">
                        <label class="control-label col-sm-4 col-md-3 col-lg-2">Output file name:</label>
                        <div class="col-sm-5 col-md-5 col-lg-5">
                            <input type="text" name="db_file" class="form-control" value="<?=$this->db->database?>">
                        </div>
                        <div class="col-sm-5 col-sm-offset-4 col-md-5 col-lg-10 col-md-offset-3 col-lg-offset-2">
                            <small>The date and the SQL extension will be added at the end of the file name.</small>
                        </div>
                        <div class="container-fluid">
                            <button type="submit" class="btn btn-lg btn-primary">Export</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div id="export_results" class="break_word"></div>
                            <? */ ?>
                </div>
            </div>
            

            <!-- import -->
            <div class="row">
                <div class="col-sm-12">
                    <h2>Import Database</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p>Please use the <a href='<?=CONTROL_PANEL_MYSQL?>' target="_blank">Control Panel</a> (if available) or your <a href='<?=PHPMYADMIN . "db_import.php?db=" . $this->db->database?>' target='_blank'>PHPMyAdmin interface</a> to upload and import a local database file. </p>
                </div>
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm">
                    <a href="<?=DB_MANAGER?>" target="_blank" class="btn btn-lg btn-primary">Import</a>
                </div>
            </div>