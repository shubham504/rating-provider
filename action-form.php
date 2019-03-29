<?php 

include '../../../wp-load.php';

global $wpdb;

$table_name = $wpdb->prefix . "posts";
if(isset($_POST['action'])){
    if($_POST['action']=='data_fetch'){
        
        $keword=$_POST['keyword'];
        $posttype='providers';
        
         $search_query = 'SELECT ID,post_title FROM `'.$table_name.'`
                                 WHERE post_type = "'.$posttype.'" 
                                 AND post_title LIKE %s';
        
        $like = '%'.$keword.'%';
         $results = $wpdb->get_results($wpdb->prepare($search_query, $like));
        if($keword!=''){ 
            echo '<ul>';
            foreach($results as $key){
                echo "<li data-id='".$key->ID."' data-val='".$key->post_title."'>".$key->post_title."</li>";
            }
            echo '</ul>';    
        }else{
            echo 'Search results will appear here';
        }    
    }
    
    if($_POST['action']=='review_h'){
         $table_name = $wpdb->prefix . "rating";
          $id=$_POST['id'];
          $val=$_POST['val'];
        if($val=='helpful'){
            
             $sql1 = "SELECT `like` FROM `".$table_name."` WHERE id=".$id;
		     $rowss = $wpdb->get_results($sql1);
		     foreach($rowss as $keyC){
		         $resultsC=$keyC->like;
        	 }
		     echo $resultsC=$resultsC+1;
        	 
                        $wpdb->update(
                            $table_name, //table
                            array('like' => $resultsC), //data
                            array('id' => $id), //where
                            array('%s'), //data format
                            array('%d') //where format
                        );
        	      
        	 
        }else{
             $sql1 = "SELECT `dislike` FROM `".$table_name."` WHERE id=".$id;
		     $rowss = $wpdb->get_results($sql1);
        	 foreach($rowss as $keyC){
		         $resultsC=$keyC->dislike;
        	 }
		    echo $resultsC=$resultsC+1;
                $wpdb->update(
                    $table_name, //table
                    array('dislike' => $resultsC), //data
                    array('id' => $id), //where
                    array('%s'), //data format
                    array('%d') //where format
                );
        }
        
        
    }
}
    
    
    
