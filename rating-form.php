<?php 
global $wpdb;
if(session_id() == '')
     session_start();

add_action('wp_enqueue_scripts', 'wedding_callback_for_setting_up_scripts');
function wedding_callback_for_setting_up_scripts() {
    wp_register_style( 'prefix-style', plugins_url('style-admin.css', __FILE__) );
    wp_enqueue_style( 'prefix-style' );
    
    
    

if(isset($_POST['insert'])) 
{ 
     
    
        $brand = $_POST["brandH"];
		$rating = $_POST["rating"];
		$custom_service = $_POST["custom_service"];
		$custom_pricing = $_POST["custom_pricing"];
		$custom_speed = $_POST["custom_speed"];
		$email = $_POST["email"];
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$zip = $_POST["zip"];
		$review = $_POST["review"];
		$last_update = date("d-m-Y");
		
        global $wpdb;
        $table_name = $wpdb->prefix . "rating";


       $successM= $wpdb->insert(
                $table_name, //table
                array('post_id' => $brand,
                      'created_date' => date('d-m-Y'),
					 'provider' => $brand,
					 'overall_rating' => $rating,
					 'service' => $custom_service,
					 'price' => $custom_pricing,
					 'speed' => $custom_speed,
					 'email' => $email,
					 'fname' => $first_name,
					 'lname' => $last_name,
					 'zip' => $zip,
					 'comments' => $review,
					 'like' => 0,
					 'dislike' => 0,
					 ), //data
                array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s') //data format			
        );
        echo '<script>alert("success")</script>';
        ?><script>window.location = window.location.href.split("#")[0];</script><?php
}    
   
}





function login() {  ?>
<?php 
global $wpdb;
$table_name2 = $wpdb->prefix . "rating";
$post_id=get_the_ID();
$overall_rating=0;
$totalspeed=0; 
$totalprice=0; 
$totalservice=0;

$inoverall_rating=0;
$inspeed=0;
$inprice=0;
$inservice=0;
    $sql2 = "select * from $table_name2 where post_id=".$post_id;
    $roww = $wpdb->get_results($sql2);
    $totalrating=count($roww);
    foreach ($roww as $rowww) {	
        
        if($rowww->overall_rating!=''){
            $overall_rating=$overall_rating+$rowww->overall_rating; 
            ++$inoverall_rating;
        }
        
        if($rowww->speed!=''){
            $totalspeed= $totalspeed+$rowww->speed;
            ++$inspeed;
        }
        if($rowww->price!=''){
            $totalprice=$totalprice+$rowww->price; 
            ++$inprice;
        }
        if($rowww->service!=''){
            $totalservice=$totalprice+$rowww->service; 
            ++$inservice;
        }
             	
             
             
        
    }
?> 
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/rating.css">

<div class="row gen-padding" id="customer-reviews" data-jump-waypoint="">
	<div class="columns small-12">
            <h2><?php if($totalrating>0){ echo $totalrating."  "; } ?> <?php the_title(); ?> Customer Reviews</h2>
    </div>
		<div class="columns small-12 large-6 large-order-2 customer-breakdown">
		    <?php if($totalspeed!=0 || $totalprice!=0 || $totalservice!=0){ ?>
            <h2 class="fancy-title alt">Rating breakdown</h2>
            <div class="row">
                <div class="columns small-12 large-3">
                    <div class="circle bg-primary text-center">
                        <div><span class="font-extra-large">
                            <?php 
                             $totaloverall_rating=$overall_rating/$inoverall_rating;
                            echo bcdiv($totaloverall_rating, 1, 1); ?>
                            </span><br>Overall
                        </div>
                    </div>
                </div>
                <div class="columns small-12 large-9 breakdown">
                    
               		
                    <div class="progress-info">
                        <p><strong>Speed</strong></p>
                    </div>
                    <div class="form-stars-alt color-gray">
                                        <?php
                                            $totalRating = 5;
                                            $starRatingSP = $totalspeed/$inspeed;
                                            $starRatingSP=round($starRatingSP/.5) * .5;
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRatingSP < $i ) {
                                                    if(round($starRatingSP) == $i){ ?>
                                                       <img src="<?php echo get_template_directory_uri(); ?>/images/half.png">
                                                   <?php  }else{ ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/empty.png">
                                                   <?php  }
                                                 }else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/full.png">
                                               <?php   }
                                            }
                                        ?>
                    </div>
                    <div class="progress-info">
                        <p><strong>Price</strong></p>
                    </div>
                    <div class="form-stars-alt color-gray">
                                        <?php
                                            $totalRating = 5;
                                            $starRatingPRI = $totalprice/$inprice;
                                            $starRatingPRI=round($starRatingPRI/.5) * .5;
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRatingPRI < $i ) {
                                                    if(round($starRatingPRI) == $i){ ?>
                                                       <img src="<?php echo get_template_directory_uri(); ?>/images/half.png">
                                                   <?php  }else{ ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/empty.png">
                                                   <?php  }
                                                 }else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/full.png">
                                               <?php   }
                                            }
                                        ?>
                    </div>
                    <div class="progress-info">
                        <p><strong>Service</strong></p>
                    </div>
                    <div class="form-stars-alt color-gray">
                                        <?php
                                            $totalRating = 5;
                                            $starRatingSER = $totalservice/$inservice;
                                            $starRatingSER=round($starRatingSER/.5) * .5;
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRatingSER < $i ) {
                                                    if(round($starRatingSER) == $i){ ?>
                                                       <img src="<?php echo get_template_directory_uri(); ?>/images/half.png">
                                                   <?php  }else{ ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/empty.png">
                                                   <?php  }
                                                 }else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/full.png">
                                               <?php   }
                                            }
                                        ?>
                    </div>
				</div>	
				<?php }else{ } ?>
			</div>
			
		</div>
			
		<div class="columns small-12 large-6 large-order-1">
		    <div class="row border-bottom small-padding align-middle">
		        <button type="button" class="button large btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Write a review. <i class="fa fa-angle-right"></i></button>
            </div>
              <div class="modal fade ratingForm" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body custpopRat">
                      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" accept-charset="UTF-8" class="review-form review-form-full" novalidate="novalidate">
                          <h3>Leave a review.</h3>
                          <p class="font-small color-gray-alt"><span class="color-aqua">*</span> Required</p>
                        
                          <div class="input-container">
                            <!--<div class="awesomplete"><input type="text" name="brand" id="brand2" class="brand" value="" required="" onkeyup="fetch()"><span class="visually-hidden" role="status" aria-live="assertive" aria-relevant="additions"></span></div> -->
                            
                            <div class="awesomplete">
                                <input type="text" name="brand" id="brand2" class="brand" value="" required="" placeholder="Enter a provider" onkeyup="fetch()">
                                <input type="hidden" name="brandH" id="brand2H" class="brand" value="" required>
                                <div id="datafetch">Search results will appear here</div>
                                
                            </div>
                            
                          </div>
                        
                          <div class="input-container">
                            <div class="fake-input">
                                Your Overall Rating <span class="color-aqua">*</span>
                                <span id="overallStarsStars" class="stars orange dynamic" data-clickedon="">
                            <input type="radio" id="overallStars-star502" name="rating" value="5"><label for="overallStars-star502" title="5.0 stars"></label>
                            <input type="radio" id="overallStars-star452" name="rating" value="4.5"><label class="half" for="overallStars-star452" title="4.5 stars"></label>
                            <input type="radio" id="overallStars-star402" name="rating" value="4"><label for="overallStars-star402" title="4.0 stars"></label>
                            <input type="radio" id="overallStars-star352" name="rating" value="3.5"><label class="half" for="overallStars-star352" title="3.5 stars"></label>
                            <input type="radio" id="overallStars-star302" name="rating" value="3"><label for="overallStars-star302" title="3.0 stars"></label>
                            <input type="radio" id="overallStars-star252" name="rating" value="2.5"><label class="half" for="overallStars-star252" title="2.5 stars"></label>
                            <input type="radio" id="overallStars-star202" name="rating" value="2"><label for="overallStars-star202" title="2.0 stars"></label>
                            <input type="radio" id="overallStars-star152" name="rating" value="1.5"><label class="half" for="overallStars-star152" title="1.5 stars"></label>
                            <input type="radio" id="overallStars-star102" name="rating" value="1"><label for="overallStars-star102" title="1.0 star"></label>
                            <input type="radio" id="overallStars-star052" name="rating" value="0.5"><label class="half" for="overallStars-star052" title="0.5 stars"></label>
                          </span>      <div class="clear"></div>
                              <label class="error" for="rating"></label>
                              <hr>
                              <div class="form-stars-alt color-gray-alt">
                                  Service          <span id="serviceStarsStars" class="stars orange dynamic" data-clickedon="">
                            <input type="radio" id="serviceStars-star50" name="custom_service" value="5"><label for="serviceStars-star50" title="5.0 stars"></label>
                            <input type="radio" id="serviceStars-star45" name="custom_service" value="4.5"><label class="half" for="serviceStars-star45" title="4.5 stars"></label>
                            <input type="radio" id="serviceStars-star40" name="custom_service" value="4"><label for="serviceStars-star40" title="4.0 stars"></label>
                            <input type="radio" id="serviceStars-star35" name="custom_service" value="3.5"><label class="half" for="serviceStars-star35" title="3.5 stars"></label>
                            <input type="radio" id="serviceStars-star30" name="custom_service" value="3"><label for="serviceStars-star30" title="3.0 stars"></label>
                            <input type="radio" id="serviceStars-star25" name="custom_service" value="2.5"><label class="half" for="serviceStars-star25" title="2.5 stars"></label>
                            <input type="radio" id="serviceStars-star20" name="custom_service" value="2"><label for="serviceStars-star20" title="2.0 stars"></label>
                            <input type="radio" id="serviceStars-star15" name="custom_service" value="1.5"><label class="half" for="serviceStars-star15" title="1.5 stars"></label>
                            <input type="radio" id="serviceStars-star10" name="custom_service" value="1"><label for="serviceStars-star10" title="1.0 star"></label>
                            <input type="radio" id="serviceStars-star05" name="custom_service" value="0.5"><label class="half" for="serviceStars-star05" title="0.5 stars"></label>
                          </span>      </div>
                              <div class="form-stars-alt color-gray-alt">
                                  Pricing          <span id="pricingStarsStars" class="stars orange dynamic" data-clickedon="">
                            <input type="radio" id="pricingStars-star50" name="custom_pricing" value="5"><label for="pricingStars-star50" title="5.0 stars"></label>
                            <input type="radio" id="pricingStars-star45" name="custom_pricing" value="4.5"><label class="half" for="pricingStars-star45" title="4.5 stars"></label>
                            <input type="radio" id="pricingStars-star40" name="custom_pricing" value="4"><label for="pricingStars-star40" title="4.0 stars"></label>
                            <input type="radio" id="pricingStars-star35" name="custom_pricing" value="3.5"><label class="half" for="pricingStars-star35" title="3.5 stars"></label>
                            <input type="radio" id="pricingStars-star30" name="custom_pricing" value="3"><label for="pricingStars-star30" title="3.0 stars"></label>
                            <input type="radio" id="pricingStars-star25" name="custom_pricing" value="2.5"><label class="half" for="pricingStars-star25" title="2.5 stars"></label>
                            <input type="radio" id="pricingStars-star20" name="custom_pricing" value="2"><label for="pricingStars-star20" title="2.0 stars"></label>
                            <input type="radio" id="pricingStars-star15" name="custom_pricing" value="1.5"><label class="half" for="pricingStars-star15" title="1.5 stars"></label>
                            <input type="radio" id="pricingStars-star10" name="custom_pricing" value="1"><label for="pricingStars-star10" title="1.0 star"></label>
                            <input type="radio" id="pricingStars-star05" name="custom_pricing" value="0.5"><label class="half" for="pricingStars-star05" title="0.5 stars"></label>
                          </span>      </div>
                              <div class="form-stars-alt color-gray-alt">
                                  Speed          <span id="speedStarsStars" class="stars orange dynamic" data-clickedon="">
                            <input type="radio" id="speedStars-star50" name="custom_speed" value="5"><label for="speedStars-star50" title="5.0 stars"></label>
                            <input type="radio" id="speedStars-star45" name="custom_speed" value="4.5"><label class="half" for="speedStars-star45" title="4.5 stars"></label>
                            <input type="radio" id="speedStars-star40" name="custom_speed" value="4"><label for="speedStars-star40" title="4.0 stars"></label>
                            <input type="radio" id="speedStars-star35" name="custom_speed" value="3.5"><label class="half" for="speedStars-star35" title="3.5 stars"></label>
                            <input type="radio" id="speedStars-star30" name="custom_speed" value="3"><label for="speedStars-star30" title="3.0 stars"></label>
                            <input type="radio" id="speedStars-star25" name="custom_speed" value="2.5"><label class="half" for="speedStars-star25" title="2.5 stars"></label>
                            <input type="radio" id="speedStars-star20" name="custom_speed" value="2"><label for="speedStars-star20" title="2.0 stars"></label>
                            <input type="radio" id="speedStars-star15" name="custom_speed" value="1.5"><label class="half" for="speedStars-star15" title="1.5 stars"></label>
                            <input type="radio" id="speedStars-star10" name="custom_speed" value="1"><label for="speedStars-star10" title="1.0 star"></label>
                            <input type="radio" id="speedStars-star05" name="custom_speed" value="0.5"><label class="half" for="speedStars-star05" title="0.5 stars"></label>
                          </span>      </div>
                            </div>
                          </div>
                          <div class="input-container">
                            <input type="email" name="email" id="email2" value="" required="" placeholder="Enter your email address.">
                            <span data-tooltip="" title="" data-tooltip-class="tooltip" aria-describedby="2oxpkf-tooltip" data-yeti-box="2oxpkf-tooltip" data-toggle="2oxpkf-tooltip" data-resize="2oxpkf-tooltip" class="has-tip" data-e="0k6p0s-e" data-events="resize"><img src="https://www.highspeedinternet.com/app/themes/clwp/hsi-redrock/dist/images/svg/info.svg" alt="?" class="lazyloading" data-was-processed="true"></span>
                          </div>
                          <div class="row collapsed">
                            <div class="column small-12 medium-6">
                              <div class="input-container">
                                <input type="text" name="first_name" id="first-name" placeholder="First Name">
                              </div>
                            </div>
                            <div class="column small-12 medium-6">
                              <div class="input-container">
                                <input type="text" name="last_name" id="last-name" placeholder="Last Name">
                              </div>
                            </div>
                          </div>
                          <div class="input-container">
                            <input type="tel" name="zip" id="zip2" value="" minlength="5" maxlength="5" placeholder="Enter your ZIP code.">
                          </div>
                          <div class="input-container">
                            <textarea name="review" id="review" placeholder="Comments"></textarea>
                          </div>
                          <p>
                            <label class="font-small color-gray-alt"><input type="checkbox" name="custom_optInEmail"> Email me occasional updates on speed and pricing in my area.</label>
                          </p>
                          <input type="hidden" name="tags" id="tags" value="">
                          <input type="hidden" name="custom_detected_brand" value="Airtel Broadband">
                          <input type="hidden" name="custom_detected_zip" value="302001">
                          <input type="hidden" name="ip" value="47.187.108.45">
                          <input type="hidden" name="source" value="https://www.highspeedinternet.com/providers/att/customer-reviews" required="">
                          <input type="hidden" name="city">
                          <input type="hidden" name="state">
                          <p><input type='submit' name="insert" value='Post Review' class='button large width-full text-center'></p>
                          <div class="form-message"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
global $wpdb;
        $table_name2 = $wpdb->prefix . "rating";
 $post_id=get_the_ID();
                		$sql2 = "select * from $table_name2 where post_id=".$post_id;
                		$roww = $wpdb->get_results($sql2);
                		foreach ($roww as $rowww) {	?>
                		<?php  
                		$value = get_field( "logo", $post_id );
                		
                		?>
<div class="review-cards" data-display="10">
<div class="review-card" data-id="990ffe94-6ca8-4189-a134-659273fd55a3" data-stars="1.5" data-helpful="230" data-not-helpful="6" data-date="20181111" data-provider="att" data-helpful-rating="224">
<p><a href="/providers/att" data-component="body" data-brand="AT&amp;T" data-element="Image"><?php if($value!=''){ ?><img src="<?php echo $value; ?>" class="width-120 lazyloading" data-was-processed="true"><?php }else{ $custom_logo_id = get_theme_mod( 'custom_logo' );
						$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
						echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="">'; } ?></a></p>
<div class="review-card-stars">

    <span id="990ffe94-6ca8-4189-a134-659273fd55a3Stars" class="stars orange" data-clickedon="1.5">
                                        <?php
                                            $totalRating = 5;
                                            $starRating = $rowww->overall_rating;
                                            
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRating < $i ) {
                                                    if(round($starRating) == $i){ ?>
                                                       <img src="<?php echo get_template_directory_uri(); ?>/images/half.png">
                                                   <?php  }else{ ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/empty.png">
                                                   <?php  }
                                                 }else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/full.png">
                                               <?php   }
                                            }
                                        ?>
    </span><div class="review-stars">
            <div class="stars-overall">Overall:
                                        <?php
                                            $totalRating = 5;
                                            $starRating = $rowww->overall_rating;
                                            
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRating < $i ) {
                                                    if(round($starRating) == $i){ ?>
                                                       <img src="<?php echo get_template_directory_uri(); ?>/images/half.png">
                                                   <?php  }else{ ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/empty.png">
                                                   <?php  }
                                                 }else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/full.png">
                                               <?php   }
                                            }
                                        ?>
            </div>
            <div class="form-stars-alt color-gray">Service: 
                                        <?php
                                            $totalRating = 5;
                                            $starRating = $rowww->service;
                                            
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRating < $i ) {
                                                    if(round($starRating) == $i){ ?>
                                                       <img src="<?php echo get_template_directory_uri(); ?>/images/half.png">
                                                   <?php  }else{ ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/empty.png">
                                                   <?php  }
                                                 }else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/full.png">
                                               <?php   }
                                            }
                                        ?>
            </div>
            <div class="form-stars-alt color-gray">Pricing: 
                                        <?php
                                            $totalRating = 5;
                                            $starRating = $rowww->price;
                                            
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRating < $i ) {
                                                    if(round($starRating) == $i){ ?>
                                                       <img src="<?php echo get_template_directory_uri(); ?>/images/half.png">
                                                   <?php  }else{ ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/empty.png">
                                                   <?php  }
                                                 }else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/full.png">
                                               <?php   }
                                            }
                                        ?>
            </div>
            <div class="form-stars-alt color-gray">Speed: 
                                        <?php
                                            $totalRating = 5;
                                            $starRating = $rowww->speed;
                                            
                                            for ($i = 1; $i <= $totalRating; $i++) {
                                                 if($starRating < $i ) {
                                                    if(round($starRating) == $i){ ?>
                                                       <img src="<?php echo get_template_directory_uri(); ?>/images/half.png">
                                                   <?php  }else{ ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/empty.png">
                                                   <?php  }
                                                 }else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/full.png">
                                               <?php   }
                                            }
                                        ?>
            </div>
            </div>
  </div>
<p class="font-medium"><?php echo $rowww->fname.' '.$rowww->lname; ?> | <?php echo $rowww->created_date; ?></p>
<p class="color-gray-alt"></p>
<p><?php echo $rowww->comments; ?></p>
<span class="color-gray-alt" id="<?php echo $rowww->id; ?>">Was this review helpful? <a  class="review_helpful" data-id="<?php echo $rowww->id; ?>" data-value="helpful" data-component="body" data-element="Image"><img src="https://www.highspeedinternet.com/app/themes/clwp/hsi-redrock/dist/images/svg/thumb-up.svg" alt="Yes" title="Yes" class="lazyloading" data-was-processed="true"> <span class="helpful-val countRH" id="<?php echo $rowww->id; ?>_h"><?php if($rowww->like){ echo $rowww->like; } ?></span></a> <a  class="review_helpful" data-id="<?php echo $rowww->id; ?>" data-value="not_helpful" data-component="body" data-element="Image"><img src="https://www.highspeedinternet.com/app/themes/clwp/hsi-redrock/dist/images/svg/thumb-down.svg" alt="No" title="No" class="lazyloading" data-was-processed="true"> <span class="not-helpful-val countRNH" id="<?php echo $rowww->id; ?>_nh"><?php if($rowww->dislike){ echo $rowww->dislike; } ?></span></a></span>
<div id="ccc"></div>
</div>
</div>
<?php } ?>
		</div>	
</div>	


<script type="text/javascript">
function fetch(){
    jQuery.ajax({
        url: '<?php echo plugin_dir_url( __FILE__ ) . 'action-form.php'; ?>',
        type: 'post',
        data: { action: 'data_fetch', keyword: jQuery('#brand2').val() },
        success: function(data) {
            jQuery('#datafetch').html( data );
            jQuery("#datafetch").removeClass('hidden');
                jQuery('div#datafetch ul li').click(function(){
                   var clkid= jQuery(this).attr("data-id");
                   var clkval= jQuery(this).attr("data-val");
                    if(clkid!='' || clkval!=''){
                        jQuery("#brand2H").val(clkid);
                        jQuery("#brand2").val(clkval);
                        jQuery("#datafetch").addClass('hidden');
                    }else{
                        alert('required feild');
                    }
                });
            
        }
    });

}


jQuery('.review_helpful').click(function(){
    
    var clkid= jQuery(this).attr("data-id");
    var clkval= jQuery(this).attr("data-value");
    jQuery.ajax({
        url: '<?php echo plugin_dir_url( __FILE__ ) . 'action-form.php'; ?>',
        type: 'post',
        data: { action: 'review_h', id: clkid, val: clkval },
        success: function(data) {
            if(clkval=='helpful'){
                jQuery('#'+clkid+'_h').html( data );
            }else{
                jQuery('#'+clkid+'_nh').html( data );
            }
            
            
        }
    });
});    



</script>
<?php } 
add_shortcode( 'rating_form', 'login' );




    

?>