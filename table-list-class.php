<?php if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
    
}
class TT_Example_List_Table extends WP_List_Table {

 var $example_data;
 

        

	function __construct(){
	    
	    global $wpdb;
        $table_name1 = $wpdb->prefix .'rating';
		$sql1 = "select * from $table_name1";
		$rowss = $wpdb->get_results($sql1);
		//print_r($rowss);
			foreach ($rowss as $rowqq) { 
			    $this->example_data[]=json_decode(json_encode($rowqq), TRUE);
			}
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'provider',     //singular name of the listed records
            'plural'    => 'providers',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }


    function column_default($item, $column_name){
        switch($column_name){
            case 'provider':
            case 'overall_rating':
            case 'service':
            case 'price':
            case 'speed':
            case 'fname':
            case 'email':
            case 'comments':
            case 'like':
            case 'dislike':    
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }


    function column_provider($item){
        
        //Build row actions
        $actions = array(
            'delete'    => sprintf('<a href="?page=%s&action=%s&provider=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
        );
        
        //Return the title contents
        return sprintf('%1$s %2$s',
            /*$1%s*/ get_the_title($item['provider']),
            /*$3%s*/ $this->row_actions($actions)
        );
    }
    
    function column_overall_rating($item){
        
      
                                            $totalRating = 5;
                                            $starRatingSER=$item['overall_rating'];
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRatingSER < $i ) {
                                                    if(round($starRatingSER) == $i){ 
                                                      echo '<img src="'.get_template_directory_uri().'/images/half.png">';
                                                    }else{ 
                                                       echo '<img src="'.get_template_directory_uri().'/images/empty.png">';
                                                    }
                                                 }else{ 
                                                   echo '<img src="'.get_template_directory_uri().'/images/full.png">';
                                               }
                                            }
        return sprintf('<br> <span style="color:silver">%1$s</span>',
            /*$1%s*/ $item['overall_rating']
        );
                                        
    }
    
    function column_service($item){
        
      
                                            $totalRating = 5;
                                            $starRatingSER=$item['service'];
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRatingSER < $i ) {
                                                    if(round($starRatingSER) == $i){ 
                                                      echo '<img src="'.get_template_directory_uri().'/images/half.png">';
                                                    }else{ 
                                                       echo '<img src="'.get_template_directory_uri().'/images/empty.png">';
                                                    }
                                                 }else{ 
                                                   echo '<img src="'.get_template_directory_uri().'/images/full.png">';
                                               }
                                            }
        return sprintf('<br> <span style="color:silver">%1$s</span>',
            /*$1%s*/ $item['service']
        );
                                        
    }
    
    function column_price($item){
        
      
                                            $totalRating = 5;
                                            $starRatingSER=$item['price'];
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRatingSER < $i ) {
                                                    if(round($starRatingSER) == $i){ 
                                                      echo '<img src="'.get_template_directory_uri().'/images/half.png">';
                                                    }else{ 
                                                       echo '<img src="'.get_template_directory_uri().'/images/empty.png">';
                                                    }
                                                 }else{ 
                                                   echo '<img src="'.get_template_directory_uri().'/images/full.png">';
                                               }
                                            }
        return sprintf('<br> <span style="color:silver">%1$s</span>',
            /*$1%s*/ $item['price']
        );
                                        
    }
    
    function column_speed($item){
        
      
                                            $totalRating = 5;
                                            $starRatingSER=$item['speed'];
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRatingSER < $i ) {
                                                    if(round($starRatingSER) == $i){ 
                                                      echo '<img src="'.get_template_directory_uri().'/images/half.png">';
                                                    }else{ 
                                                       echo '<img src="'.get_template_directory_uri().'/images/empty.png">';
                                                    }
                                                 }else{ 
                                                   echo '<img src="'.get_template_directory_uri().'/images/full.png">';
                                               }
                                            }
        return sprintf('<br> <span style="color:silver">%1$s</span>',
            /*$1%s*/ $item['speed']
        );
                                        
    }


    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
        );
    }


    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'provider'     => 'Provider',
            'overall_rating'    => 'Overall rating',
            'service'    => 'Service rating',
            'price'    => 'Price rating',
            'speed'    => 'Speed rating',
            'fname'  => 'User',
            'email'  => 'Email',
            'comments'  => 'Comments',
            'like'  => 'Like',
            'dislike'  => 'Dislike'
            
        );
        return $columns;
    }


    function get_sortable_columns() {
        $sortable_columns = array(
            'provider'     => array('provider',false),     //true means it's already sorted
            'overall_rating'    => array('overall_rating',false),
            'fname'  => array('fname',false)
        );
        return $sortable_columns;
    }

	function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }
	function process_bulk_action() {
        
        if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) ) {

            $nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
            $action = 'bulk-' . $this->_args['plural'];

            if ( ! wp_verify_nonce( $nonce, $action ) )
                wp_die( 'Nope! Security check failed!' );

        }

        $action = $this->current_action();

        switch ( $action ) {
            case 'delete':
                global $wpdb;
                $table_name = $wpdb->prefix . 'rating';
                $ids = isset($_REQUEST['provider']) ? $_REQUEST['provider'] : array();
                    if (is_array($ids)) $ids = implode(',', $ids);
                    if (!empty($ids)) {
                        $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
                }

                wp_die( 'You have deleted this succesfully' );
                break;
            default:
                // do nothing or something else
                return;
                break;    
        }
        
        
    }


    function prepare_items() {
        global $wpdb; //This is used only if making any database queries

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = 15;
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->process_bulk_action();
        $data = $this->example_data;
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'provider'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');
        
       $action = $this->current_action();
        $current_page = $this->get_pagenum();
        
        $total_items = count($data);
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        $this->items = $data;
        
		$this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }

}


?>