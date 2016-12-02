            <!-- body -->
            <div class="row">
                <div class="col-sm-12">
                    <h2>Your Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                        <div class=product_options>
                            <div><b><?=$product_count?></b></div>
                            <div><b><?=$category_count?></b><span class=category_names hidden><?=$product_category_names?></span></div>
                            <div class=product_option_right>
                                <button id=expand_toggle script_action=show>expand all</button>
                            </div>
                        </div>
                        <div class=product_showcase>

<?php   
        // create a product box for each row
    if (is_array($products)) {
        foreach ($products as $product) {
?>
                            <div class=product_box>
                                <div class=product_header>
                                    <div class=product_title id='<?=$product['id']?>'>
                                        <input class='product_name product_feature' value='<?=$product['name']?>'>
                                        <div class=product_plural_block id='<?=$product['id']?>' hidden>
                                            <label>Plural:</label>
                                            <input class='product_plural product_feature' value='<?=$product['plural']?>'>
                                        </div>
                                        <div class=product_category_block>
                                            <label class=product_category  id='<?=$product['id']?>' hidden>Category:</label>
                                            <input class='product_category product_feature' value='<?=$product['category']?>'>
                                        </div>
                                    </div>
                                    <div class=product_image_block>
                                        <div class=product_image_wrapper>
                                            <a href='<?=$product['image_url']?>' target=_blank><img class=product_image src='<?=$product['image_url']?>'></a>
                                        </div>

                                    </div>
                                    <div class=product_image_settings id='<?=$product['id']?>' hidden>
                                            <button>update</button>
                                            <button>delete</button>
                                        </div>
                                </div>
                                    <div class=product_body id='<?=$product_id?>' hidden>
                                            <div class=product_feature_block>
                                                <label>Price:</label>
                                                <input class='product_price product_feature' value='<?=$product['price']?>'>
                                            </div>
                                            <div class=product_feature_block>
                                                <label>Min-Max Quantity/Order:</label>
                                                <input class='product_min product_feature' value='<?=$product_min?>'> to <input class='product_max product_feature' value='<?=$product['min']?>'>
                                            </div>
                                            <div class=product_feature_block>
                                                <label>Shelf life:</label>
                                                <input class='product_shelflife product_feature' value='<?=$product['shelflife']?>'>
                                            </div>
                                            <div class=product_feature_block>
                                                <label>Availability:</label>
                                                <select class='productavailability product_feature'>
                                                    <option value='always' <?php if($product['availability'] == "always") echo 'selected'?>>always</option>
                                                    <option value='seasonal' <?php if($product['availability'] == "seasonal") echo 'selected'?>>seasonal</option>
                                                    <option value='once' <?php if($product['availability'] == "once") echo 'selected'?>>once</option>
                                                    <option value='do not display' <?php if($product['availability'] == "do not display") echo 'selected'?>>do not display</option>
                                                </select>
                                            </div>
                                        <div class='seasonality_block product_feature_block' hidden>
                                            <label>Seasonality:</label>
                                            <input class='product_season_start product_feature' value='<?=$product_season_start?>'> to <input class='product_season_end product_feature' value='<?=$product_season_end?>'>
                                        </div>
                                        <div>
                                            <label class='product_description_label'>Description:</label>
                                            <textarea class='product_description product_feature'><?=$product_description?></textarea>
                                        </div>
                                    </div>
                                <div class='product_box_arrow product_box_arrow_expand' id='<?=$product_id?>'>
                                &#8693;
                                </div>                
                            </div>
<?php
// end of display product loop
            }
        }
?>

                        </div>                    
                    <div>
                        <h2>Add Product</h2>
                    </div>
                    <div>
                        <?=$work_in_progress_section?>
                    </div>
                </div>
            </div>