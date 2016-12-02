            <div class="row">
                <div class="col-sm-12">
                    <h3>Current Session</h3>
                </div>
            </div>
<?php
// unfolds the $_SESSION array
// TODO: make this form functional to add, delete, and edit $_SESSION array on the fly
foreach ($_SESSION as $variable=>$value) {
?>
                <form>
                    <div class="form-group">
                        <label class="control-label"><?=$variable?>:</label>
                        <input class="form-control input-lg" value="<?=$value?>" disabled>
                    </div>
                </form>

<?php
}
?>