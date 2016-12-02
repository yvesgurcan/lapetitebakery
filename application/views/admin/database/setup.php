            <div class="row">
                <div class="col-sm-12">
                    <h2>Welcome to the setup of your <i>LPB</i> database!</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p>The script will populate tables with some test values so that you can try out <i>La Petite Bakery</i>. Please make sure that the database config file has valid credentials and that you have already created the database you intend to use. The script will create the following tables:</p>
                    <ul class="list-unstyled col-sm-offset-1">
                        <li><code>credentials</code> is where user login information are stored.</li>
                        <li><code>products_superuser</code> is where the food product data managed by the user <i>superuser</i> are stored.</li>
                        <li><code>menu_sort</code> is where the order of menu entries sorted by each user is stored.</li>
                        <li><code>menu_labels</code> is where default menu URLs are stored.</li>
                        <li><code>menu_links</code> is where default menu URLs are stored.</li>
                        <li><code>menu_glyphs</code> is where default menu icons are stored.</li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <form method="post" action="ajax/setup_database" target="#query_output" loading_message="Creating tables..." success_message="Database was populated." error_message="Oops! Something went wrong.">
                        <input name="setup_database" value="true" hidden />
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Go!</button>
                    </form>
                </div>
                <div class="col-sm-12">
                    <div id="query_output"></div>
                </div>
            </div>