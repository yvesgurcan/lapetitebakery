        </div>
        <!-- reset floats -->
        <div style="clear: both;"></div>
        <!-- footer -->
        <div id="footer" class="col-sm-12"></div>
        <!-- post-load jQuery -->
        <script type=text/javascript>
            try {
<?php
    // this part of the script is not visible on the index page
    if ($current_page != 'index') {
?>

                // All-Purpose functionalities
                
                // toggle block function
                function ToggleBlock(element) {
                    $(element).slideToggle();
                }

                // jQuery UI library
                
                // sortable contained to the parent element
                $(".sortable").sortable({ containment: "parent" });
                $(".sortable").disableSelection();
                // sortables that can be picked and moved page-wide
                $(".sortable-free").sortable();
                $(".sortable-free").disableSelection();

                // Form submissions
                // displays secondary/debug feedback message when the DIV changes
                $('#error_feedback_wrapper').bind('DOMSubtreeModified',function(event) {
                    if($('#error_feedback').html() != "") {
                        $('#error_feedback').html($('#error_feedback').html().replace(/<br>/,""))
                        $(this).fadeIn();
                    }
                    else {
                        $(this).fadeOut();
                    }
                });

                // Standardized ajax form submission
                $('form').submit(function(event) {
                    // do not use ajax if form has a "classic_form" class
                    if ($(this).attr('class') != "classic_form") {
                        // prevent default form submit
                        event.preventDefault();
                        // form target
                        var form_target = ''
                        var form_no_target = false
                        // if there is a "target" attribute, use it to display output from ajax request
                        if ($(this).attr('target')) {
                            form_target = $(this).attr('target')
                        }
                        // if there is a "no-target" attribute, form_no_target = true to prevent target debug error messages
                        else if ($(this).attr('no-target')) {
                            form_no_target = true
                        }
                        // user messages
                        // loading message
                        var default_loading_message = 'Working...'
                        var form_loading_message = ''
                        var loading_message = ''
                        // if there is a form-specific loading message, use it
                        if ($(this).attr('loading_message')) {
                            form_loading_message = $(this).attr('loading_message')
                        }
                        // otherwise, use a default loading message
                        else if ($(this).attr('default_loading_message') == ''){
                            form_loading_message = loading_message
                        }
                        // success message
                        var success_message = "Done."
                        var form_success_message = ''
                        // if there is a form-specific success message, use it
                        if ($(this).attr('success_message')) {
                            form_success_message = $(this).attr('success_message')
                        }
                        // error message
                        var default_error_message = 'Sorry, an error occurred: '
                        var form_error_message = ''
                        var error_message = default_error_message
                        // if there is a form-specific error message, use it
                        if ($(this).attr('error_message')) {
                            error_message = $(this).attr('error_message')
                        }
                        // ajax submit
                        // submit config
                        $.ajax({
                            url: '<?=site_url()?>' + $(this).attr('action'),
                            type: $(this).attr('method'),
                            data: $(this).serialize(),
                            dataType: 'html',
                            // prep user message DIV: create a fade-in/fade-out bootstrap alert with a close button
                            beforeSend: function() {
                                feedback = $("<div>")
                                    .addClass("alert fade in alert-submit text-center")
                                close_button = $("<a>")
                                    .addClass("close")
                                    .attr('href',"#")
                                    .attr('data-dismiss',"alert")
                                    .attr('aria-label',"close")
                                    .html("&times;")
                                // insert and fade loading message in the feedback DIV
                                if (form_loading_message != '') {
                                    loading_message = form_loading_message
                                    $('#feedback').fadeOut(function(){
                                        feedback
                                            .removeClass("alert-success alert-warning alert-danger")
                                            .addClass("alert-info")
                                            .text(loading_message)
                                            .prepend(close_button)
                                        $('#feedback').fadeIn().html(feedback)
                                    })
                                }
                            },
                        })
                        .done(function(data){
                            // if there is a success message, show it and change class of bootstrap alert accordingly
                            if (form_success_message != '') {
                                success_message = form_success_message
                                message_class = "alert-success"
                            }
                            // request data handling
                            // if a target was specified in the form (and form lacks a 'no-target' class)...
                            if (form_target != '' && form_no_target === false) {
                                // if there is a valid target, display output
                                if ($(form_target).length) {
                                    $(form_target).html(data)
                                }
                                // if there is no target and devmode = true, send an error message with the id of the target
                                else if (devmode) {
                                    success_message = "Unable to display output ('" + form_target + "' does not exist)."
                                    message_class = "alert-danger"
                                }
                                // else (i.e., if devmode = false), send an error message without more details
                                else {
                                    success_message = error_message + " 'element does not exist'"
                                    message_class = "alert-warning"
                                }
                            }
                            // if a target was not specified (and form lacks a 'no-target' class)
                            else if (form_no_target === false) {
                                // devmode = true, show explicit message
                                if (devmode) { 
                                    success_message = "Unable to display output. No target was assigned to the form."
                                    message_class = "alert-danger"
                                }
                                // devmode = false, add a short error message
                                else {
                                success_message = error_message + " 'no element assigned'"
                                message_class = "alert-warning"
                                }
                            }
                            // update the feedback DIV
                            $('#feedback').fadeOut(function(){
                                feedback
                                    .removeClass("alert-info")
                                    .addClass(message_class)
                                    .text(success_message)
                                    .prepend(close_button)
                                $('#feedback').fadeIn().html(feedback)
                            })
                        })
                        // if the request failed, show error message + update feedback DIV
                        .fail(function(request,status,error){
                            if (error_message == default_error_message) {
                                error_message = default_error_message + " '" + error + "'";
                                message_class = "alert-warning"
                            }
                            $('#feedback').fadeOut(function(){
                                feedback
                                    .removeClass("alert-info")
                                    .addClass(message_class)
                                    .text(error_message)
                                    .prepend(close_button)
                                $('#feedback').fadeIn().html(feedback)
                            })
                        })
                    }
                })

                // Product View

                // slide down or up one product boxes
                $('.product_box_arrow').click(function() {
                    ToggleProduct($(this))
                    var count_hidden_boxes = $('.product_body:hidden').length
                    var count_boxes = count_boxes = $('.product_body').length
                    if (count_hidden_boxes == 0) {
                        $('#expand_toggle').attr('script_action','hide')
                        $('#expand_toggle').text('collapse all')
                    }
                    else {
                        if (count_boxes == count_hidden_boxes + 1) {
                            $('#expand_toggle').attr('script_action','show')
                            $('#expand_toggle').text('expand all')
                        }
                    }

                })

                // slide down or up all product boxes
                $('#expand_toggle').click(function() {
                    if ($(this).attr('script_action') == "show") {
                        $('.product_box_arrow').each(function() {
                            ToggleProduct($(this),"show")

                        })
                        $(this).attr('script_action','hide')
                        $(this).text('collapse all')
                    }
                    else {
                        $('.product_title').each(function() {
                            ToggleProduct($(this),"hide")
                        })
                        $(this).attr('script_action','show')
                        $(this).text('expand all')
                    }
                })

                // slide down or up product boxes (function)
                function ToggleProduct(element,action) {
                    if (action == "show") {
                        $('.product_body#' + $(element).attr('id')).slideDown()
                        $('.product_image_settings#' + $(element).attr('id')).fadeIn()
                        $('.product_plural_block#' + $(element).attr('id')).fadeIn()
                        $('label.product_category#' + $(element).attr('id')).fadeIn()
                        $('.product_box_arrow#' + $(element).attr('id')).addClass('product_box_arrow_collapse').removeClass('product_box_arrow_expand')
                    }
                    else if (action == "hide") {
                        $('.product_body#' + $(element).attr('id')).slideUp()
                        $('.product_image_settings#' + $(element).attr('id')).fadeOut()
                        $('.product_plural_block#' + $(element).attr('id')).fadeOut()
                        $('label.product_category#' + $(element).attr('id')).fadeOut()
                        $('.product_box_arrow#' + $(element).attr('id')).addClass('product_box_arrow_expand').removeClass('product_box_arrow_collapse')
                    }
                    else {
                        $('.product_body#' + $(element).attr('id')).slideToggle()
                        $('.product_image_settings#' + $(element).attr('id')).fadeToggle()
                        $('.product_plural_block#' + $(element).attr('id')).fadeToggle()
                        $('label.product_category#' + $(element).attr('id')).fadeToggle()
                        if($('.product_box_arrow#' + $(element).attr('id')).hasClass("product_box_arrow_collapse")) {
                            $('.product_box_arrow#' + $(element).attr('id')).addClass('product_box_arrow_expand').removeClass('product_box_arrow_collapse')
                        }
                        else {
                            $('.product_box_arrow#' + $(element).attr('id')).addClass('product_box_arrow_collapse').removeClass('product_box_arrow_expand')
                        }
                    }
                }

                // show/hide seasonality date
                $('.product_availability').change(function() {
                    ShowSeasonal($(this))
                })

                // show/hide seasonality date on page load
                $(document).ready(function() {
                    $('.product_availability').each(function() {
                        ShowSeasonal($(this))
                    })
                })

                // function to show product seasonality
                function ShowSeasonal(element) {
                    if ($(element).find('option:selected').val() == 'seasonal' || $(element).find('option:selected').val() == 'once') {
                        $('.seasonality_block').fadeIn()
                    }
                    else {
                        $('.seasonality_block').fadeOut()
                    }
                }

                // Dynamic DB Queries

                // show/hide returned array when clicked
                $('#querry_array_option').click(function() {
                    ToggleBlock('#query_array')
                })

                // copy the name of clicked table into the primary query input
                $('.query_table').click(function() {
                    var cursorPos = $('#db_query').prop('selectionStart');
                    var v = $('#db_query').val();
                    var textBefore = v.substring(0,  cursorPos);
                    var textAfter  = v.substring(cursorPos, v.length);
                    $("#db_query").val(textBefore + $(this).attr('id') + textAfter)
                })

                // copy the query preset into the primary input
                $('#copy_query_preset').click(function() {
                    if ($('#select_query_preset option:selected').val() != "") {
                        $("#db_query").val($('#select_query_preset option:selected').val())
                    }
                })

                // erase bigger query
                $('#delete_query').click(function() {
                    $("#db_query").val("")
                })

                // save query into the smaller input
                $('#save_query').click(function() {
                    $("#db_save_query").val($("#db_query").val())
                })

                // swap smaller and bigger query
                $('#swap_query').click(function() {
                    saved_query = $("#db_save_query").val()
                    $("#db_save_query").val($("#db_query").val())
                    $("#db_query").val(saved_query)
                })
                
<?php
    }
    // this part of the code is visible on all pages (including index)
    if ($current_page != db_setup_page) {
?>
                                
                // database connection
                $(document).ready(function() {
                    // if PDO failed to connect to the DB...
                    if (database_connection === false) {
                        // disable elements with the database=true attribute
                        $("[database=true] *").prop("disabled",true)
                        $("[database=true]").prop("disabled",true)
                        // display an alert
                        close_button = $("<a>")
                            .addClass("close")
                            .attr('href',"#")
                            .attr('data-dismiss',"alert")
                            .attr('aria-label',"close")
                            .html("&times;")
                        feedback = $("<div>")
                            .addClass("alert fade in alert-danger text-center")
                            .html("Warning: Could not connect to the database!")
                            .prepend(close_button)
                                $('#db_feedback').html(feedback)
                        }
                })
<?php
    }
?>
            }
            // if a critical error happens...
            catch(error) {
                // Display custom error DIV
                document.write("<div style='clear:both; background: red; position: absolute; top: 2.5rem; width: 100%;'>")
                document.write("jQuery: " + error.stack)
                document.write("</div>")
            }
        </script>
    </body>
</html>