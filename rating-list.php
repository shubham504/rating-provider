<?php
function rating_provider_list() {
    //require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
    
    //require_once  plugin_dir_url( __FILE__ ) . 'table-list-class.php';
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/rating-provider/style-admin.css" rel="stylesheet" />
	<h1 style="padding:15px 15px; background: #0073aa; color: #fff;" > Rating Provider by Inventive Infosys</h1>
	<p style="padding:5px 15px;border-bottom: solid 1px rgba(70, 64, 64, 0.38);">This plugin used for Rating Provider. for more details visit: <a href="http://www.inventiveinfosys.com" target="blank">Inventive Infosys</a> or email us: info@inventiveinfosys.com    </p>
	<div class="short_code_details">
	   <p style="font-size: 18px;">Shortcode :</p>
			<input style="width:  30% !important; padding: 4px;" id="short_code_help" type="text" value="[rating_form]" disabled>
	   	
	</div>

<?php
$testListTable = new TT_Example_List_Table();
$testListTable->prepare_items();

?>

    <div class="wrap">
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>List Rating</h2>
       <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTable->display() ?>
        </form>
        
    </div>


    <?php
}

?>