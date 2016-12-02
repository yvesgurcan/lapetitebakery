<h3>Results</h3>
    <div class=query_info>
        <div>Query: '<?=$dynamic_query?>'</div>
<?php
            // if there is something to show...
            if(sizeof($output) > 0) {
?>
        <div>Number of rows: <?=sizeof($output)?></div>
        <div>Number of columns: <?=sizeof($output[0])/2?></div>
        <a id=querry_array_option onclick="ToggleBlock('#query_array')">See raw data &#8594;</a>
        <div id=query_array hidden><pre><?=print_r($output)?></pre></div>
    </div>
    <a id=querry_table_option onclick="ToggleBlock('#query_table')">See table &#8594;</a>
    <div class="table-responsive query_table_wrapper">
        <table class="table table-hover table-sm" id="query_table">
            <tr scope="row" class="bg-primary">
<?php
                // if the result is a single value, do not show numbering on the left side of the table
                if (sizeof($output) == 1) {
                    $hide = 'style="display: none;"';
                }
                else {$hide = '';}
?>
                <td <?=$hide?>>#</td>
<?php
                // show column titles
                if (array_key_exists(0, $output)) {
                    foreach($output[0] as $key => $value) {
                        if (!is_numeric($key)) {
?>
                <td><?=$key?><td>
<?php
                        }
                    }
                }
?>
            </tr>
<?php           
                // inspect the results from PDO to format into a nice table
                for ($i = 0; $i < sizeof($output); $i++) {
?>
            <tr scope="row" class="bg-info">
<?php
                    if (sizeof($output) == 1) {
                        $hide = 'style="display: none;"';
                    }
                    else {$hide = '';}
?>
                <td <?=$hide?>><?=$i?></td>
<?php
                    foreach($output[$i] as $key => $value) {
                        if (!is_numeric($key)) {
?>
                <td><?=$value?><td>
<?php
                        }
                    }
?>
            </tr>
<?php
                }
?>
        </table>
    </div>
<?php
            }
            // if output is zero
            else {
?>
<p>No value were returned (0).</p>
<?php
            }
?>