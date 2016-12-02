            <div class="row">
                <div class="col-sm-12">
                    <h2>Query the database dynamically</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <form id=query_form method=post action="ajax/dynamic_query" target='#query_results' default_loading_message success_message='Your query was sent.' database=true>
                        <small class="form-text text-muted">Type in your command below.</small>
                            <textarea class="form-control input-lg" name=db_query id="db_query" value='' placeholder="Write your query here." required></textarea>
                            <input class="form-control" name="db_save_query" id ="db_save_query" placeholder="You can save a query for later use here.">
                        <button class="btn btn-primary btn-lg">Send Query</button>
                            <button type="button" class="btn btn-info btn-lg" id="save_query">Save Query</button>
                            <button type="button" class="btn btn-info btn-lg" id="swap_query">Swap Queries</button>
                            <button type="button" class="btn btn-info btn-lg" id="delete_query">Erase Query</button>
                        </form>
                    
                    </div>
                    <!-- table presets  -->
                    <div>        
                        <label>Tables:</label><?php
        for ($i = 0; $i < sizeof($tables); $i++) {
            // display a separator to the left of each entry (except for the first one)
            if ($i > 0) {
    ?> &dash; <?php           
            }
?>

                        <a id='<?=$tables[$i]?>' class='query_table'><?=$tables[$i]?></a><?php
            $i++;
        }
?>
                    
                    </div>
                    <div>
                    <label>Presets:</label> <select id="select_query_preset" class="form-control" database=true>
                        <option value='' disabled>----- VALUES</option>
                        <option value='SELECT * FROM ' selected>Show values of a table: SELECT * FROM table</option>
                        <option value='SELECT DISTINCT * FROM '>Show values of a table (no duplicates): SELECT DISTINCT * FROM table</option>
                        <option value='UPDATE SET =&quot;&quot; WHERE =&quot;&quot; '>Update values in the table: UPDATE table SET col=val WHERE col=val </option>
                        <option value='DELETE FROM WHERE =&quot;&quot; '>Delete values: DELETE FROM table WHERE col=val </option>
                        <option value='' disabled>----- ROWS</option>
                        <option value='INSERT INTO VALUES (&quot;&quot;) '>Add a row to a table: INSERT INTO table (col) VALUES ("value")
                        </option>
                        <option value='SELECT COUNT(*) FROM '>Count rows of a table: SELECT COUNT(*) FROM table</option>
                        <option value='SELECT * FROM table1 INNER JOIN table2 ON table1.column = table2.column'>Join rows from different tables with a common column: SELECT * FROM INNER JOIN ON </option>
                        <option value='' disabled>----- COLUMNS</option>
                        <option value='ALTER TABLE ADD '>Add a column to a table: ALTER TABLE table ADD col datatype </option>
                        <option value='DESCRIBE '>Gives details on table columns: DESCRIBE table</option>
                        <option value='ALTER TABLE MODIFY COLUMN '>Modify data type of a column: ALTER TABLE table MODIFY COLUMN col datatype </option>
                        <option value='ALTER TABLE DROP COLUMN '>Delete column of a table: ALTER TABLE table DROP COLUMN col </option>
                        <option value='' disabled>----- TABLES</option>
                        <option value='CREATE TABLE  () '>Create a table: CREATE TABLE table (col datatype)</option>
                        <option value='RENAME TABLE TO '>Gives details on table columns: RENAME TABLE oldTable TO newTable</option>
                        <option value='SHOW TABLES '>Show all tables: SHOW TABLES</option>
                        <option value='SELECT * INTO FROM '>Copy columns from a table into another table: SELECT * INTO target_table FROM source_table</option>
                        <option value='DROP TABLE '>Delete a table: DROP TABLE table</option>
                        <option value='' disabled>----- Databases</option>
                        <option value='CREATE DATABASE '>Create a database: CREATE DATABASE database</option>
                        <option value='SHOW DATABASES '>Show all databases: SHOW DATABASES</option>
                        <option value='SELECT DATABASE() '>Show which database is currently in use: SELECT DATABASE()</option>
                        <option value='USE '>Change default database: USE database</option>
                        <option value='DROP DATABASE '>Delete a database: DROP DATABASE database</option>
                        
                            </select>
                        <div><button class="btn btn-info" id="copy_query_preset" database=true>Copy Query Preset</button></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id=query_results></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2>Secondary Query</h2>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <form id=query_form2 method=post action="ajax/dynamic_query" target='#query_results2' default_loading_message success_message='Your query was sent.' database=true>
                        <small class="form-text text-muted">You can send other additional queries here.</small>
                            <textarea class="form-control input-lg" name=db_query id="db_query" autocomplete="on" value='' placeholder="Write another query here." required></textarea>
                            <input class="form-control" name="db_save_query" id ="db_save_query" placeholder="You can save another query for later use here.">
                        <button class="btn btn-primary btn-lg">Send Query</button>
                        </form>
                    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id=query_results2></div>
                </div>
            </div>