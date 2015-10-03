<?php/* Template Name: FB Step 2 Choose Card & Box */get_header('steps'); session_unset();?><?php	$editScript = '';?><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><main id="main" role="main">	<div class="container">		<div class="heading">			<h1><?php the_field('page_title'); ?></h1>		</div>		<ul id="status-bar">			<li class="active">Create It</li>			<li>Personalize It</li>			<li>Invite Flatterers</li>			<li>Write the First One!</li>			<li>Next Steps</li>		</ul>				<?php the_content(); ?>				<?php				$type = 'box_types';				$args=array(					'post_type' => $type,					'post_status' => 'publish',					'orderby' => 'menu_order',					'order' => 'ASC',					'posts_per_page' => -1,					'caller_get_posts'=> 1				);				$my_query = new WP_Query($args);				$i = 1;				if( $my_query->have_posts() ) {				while ($my_query->have_posts()) : $my_query->the_post(); ?>				<div class="box">					<h2 class="selection"><?php the_title(); ?></h2>					<div class="mask"></div>					<div class="box-image" style="background-image: url('<?php the_field('thumbnail_image'); ?>');">						<?php							// check if the repeater field has rows of data							if( have_rows('color_selections') ): ?>							<div class="box-color-selections">								<h3>Box Color</h3>								<?php while ( have_rows('color_selections') ) : the_row();									?>								<div class="box-color" id="box-color-<?php echo $i; ?>" onclick="selectboxcolor(this,'<?php the_sub_field('color_name'); ?>');">									<img src="<?php the_sub_field('color_thumbnail_image'); ?>">								</div>									<?php									//echo '-'.$_SESSION['boxtype'].'-=-'.get_the_title().'-<br/>';									//echo '-'.$_SESSION['boxcolor'].'-=-'.the_sub_field('color_name').'-<br/>';									//echo '-'.get_sub_field('color_name').'-';									if ( ( isset($_SESSION['boxtype']) && $_SESSION['boxtype'] == get_the_title() ) 											&& ( isset($_SESSION['boxcolor']) && $_SESSION['boxcolor'] == get_sub_field('color_name') ) ) :										$editScript .= 'selectboxcolor("#box-color-'.$i.'","'.get_sub_field("color_name").'");';									endif;								$i++;								endwhile; ?>							</div>							<?php else :								// no rows found							endif;						?>					</div>					<div class="box-cards">						<h2>Card Color</h2>						<div class="card-preview"></div>						<?php							$i = 1;							// check if the repeater field has rows of data							if( have_rows('card_colors') ):								// loop through the rows of data								while ( have_rows('card_colors') ) : the_row();									?>								<div class="single-card-color" id="card-color-<?php echo $i; ?>" onclick="selectcardcolor(this,'<?php the_sub_field('color_description'); ?>');">									<img src="<?php the_sub_field('color_image'); ?>" width="22" height="22">								</div>									<?php								$i++;								endwhile;							else :								// no rows found							endif;						?>					</div>					<div class="number">						<h2>Number of Cards</h2>						<?php							$i = 1;							// check if the repeater field has rows of data							if( have_rows('quantities_&_prices') ):								// loop through the rows of data								while ( have_rows('quantities_&_prices') ) : the_row();									?>								<div class="card-quantity-radio-container">																		<input type="radio" id="card-quantity-<?php the_ID(); ?>-<?php echo $i ?>" name="card-quantity-<?php the_ID(); ?>" value="<?php the_sub_field('quantity_number'); ?>" onclick="selectcardquantity(<?php the_sub_field('quantity_number'); ?>,<?php the_sub_field('quantity_price'); ?>);" />									<label for="card-quantity-<?php the_ID(); ?>-<?php echo $i ?>">Up to <?php the_sub_field('quantity_number'); ?> Cards | $<?php the_sub_field('quantity_price'); ?></label>																	</div>									<?php								$i++;								endwhile;							else :								// no rows found							endif;						?>					</div>				</div><!-- end box -->				<?php				  endwhile;				}				wp_reset_query();  // Restore global post data stomped by the_post().				?>				<?php if (false) : ?>				<br/>				<h2>Box Style</h2>				<div style="height:auto;overflow:auto;margin-bottom:55px;">				<?php				$type = 'box_types';				$args=array(				  'post_type' => $type,				  'post_status' => 'publish',				  'orderby' => 'menu_order',				  'order' => 'ASC',				  'posts_per_page' => -1,				  'caller_get_posts'=> 1);				$my_query = new WP_Query($args);				$i = 1;				if( $my_query->have_posts() ) {				  while ($my_query->have_posts()) : $my_query->the_post(); ?>				    					<div class="box-type">				  						<div class="box-type-col-1">													<div class="box-type-container">								<div class="box-type-image"><img src="<?php the_field('thumbnail_image'); ?>" style="width:150px;" /></div>								<h3><?php the_title(); ?> <strong>$<?php the_field('price'); ?></strong></h3>								<input type="hidden" class="hiddenprice" value="<?php the_field('price'); ?>" />								<input type="hidden" class="hiddenlabel" value="<?php the_title(); ?>" />								</div>							<div class="box-color-container" id="<?php the_title(); ?>">								<?php								// check if the repeater field has rows of data								if( have_rows('color_selections') ):									// loop through the rows of data									while ( have_rows('color_selections') ) : the_row();										?>									<div class="box-color" id="box-color-<?php echo $i; ?>" onclick="selectboxcolor(this,'<?php the_sub_field('color_name'); ?>');">										<img src="<?php the_sub_field('color_thumbnail_image'); ?>">									</div>										<?php										//echo '-'.$_SESSION['boxtype'].'-=-'.get_the_title().'-<br/>';										//echo '-'.$_SESSION['boxcolor'].'-=-'.the_sub_field('color_name').'-<br/>';										//echo '-'.get_sub_field('color_name').'-';										if ( ( isset($_SESSION['boxtype']) && $_SESSION['boxtype'] == get_the_title() ) 												&& ( isset($_SESSION['boxcolor']) && $_SESSION['boxcolor'] == get_sub_field('color_name') ) ) :											$editScript .= 'selectboxcolor("#box-color-'.$i.'","'.get_sub_field("color_name").'");';										endif;									$i++;									endwhile;								else :									// no rows found								endif;								?>							</div>						</div>				   						<div class="box-type-col-2">							<h3>Card Color</h3>							<div class="card-colors">								<?php								$i = 1;								// check if the repeater field has rows of data								if( have_rows('card_colors') ):									// loop through the rows of data									while ( have_rows('card_colors') ) : the_row();										?>									<div class="single-card-color" id="card-color-<?php echo $i; ?>" onclick="selectcardcolor(this,'<?php the_sub_field('color_description'); ?>');">										<img src="<?php the_sub_field('color_image'); ?>" width="25" height="25">									</div>										<?php									$i++;									endwhile;								else :									// no rows found								endif;								?>														</div>						</div>												<div class="box-type-col-3">													<h3>Select Card Quantity</h3>							<div>								<?php								$i = 1;								// check if the repeater field has rows of data								if( have_rows('quantities_&_prices') ):									// loop through the rows of data									while ( have_rows('quantities_&_prices') ) : the_row();										?>									<div class="card-quantity-radio-container">																				<input type="radio" id="card-quantity-<?php the_ID(); ?>-<?php echo $i ?>" name="card-quantity-<?php the_ID(); ?>" value="<?php the_sub_field('quantity_number'); ?>" onclick="selectcardquantity(<?php the_sub_field('quantity_number'); ?>,<?php the_sub_field('quantity_price'); ?>);" />										<label for="card-quantity-<?php the_ID(); ?>-<?php echo $i ?>"><?php the_sub_field('quantity_number'); ?> Cards</label>																			</div>										<?php									$i++;									endwhile;								else :									// no rows found								endif;								?>														</div>												</div>																					   </div>					<?php				  endwhile;				}				wp_reset_query();  // Restore global post data stomped by the_post().				?>			<?php endif; ?>			<input type="hidden" name="hiddenboxtype" id="hiddenboxtype" />			<input type="hidden" name="hiddenboxtypeimg" id="hiddenboxtypeimg" />			<input type="hidden" name="hiddenboxcolor" id="hiddenboxcolor" />			<input type="hidden" name="hiddenboxprice" id="hiddenboxprice" />			<input type="hidden" name="hiddencardcolor" id="hiddencardcolor" />			<input type="hidden" name="hiddencardcolorimg" id="hiddencardcolorimg" />			<input type="hidden" name="hiddencardquantity" id="hiddencardquantity" />			<input type="hidden" name="hiddencardprice" id="hiddencardprice" />			<input type="hidden" name="hiddentotalprice" id="hiddentotalprice" />								</div>		<div class="control-bar bottom">			<a href="javascript:;" class="btn save" onclick="goToStep3();">Next</a>			<?php if (get_field('next_step_instructional_message')) : ?>			<div class="bottom-message">				<?php the_field('next_step_instructional_message'); ?>			</div>			<?php endif; ?>		</div>	</div></main><?php endwhile; endif; ?><?php 	get_footer(); 	$loggedIn = is_user_logged_in();?><script>/*	function addToCart(p_id,qty,variationid) {            jQuery.ajax({              type: 'POST',              url: '<?php echo do_shortcode('[site_url]'); ?>/shop/?post_type=product&add-to-cart='+p_id,              data: { 'product_id':  p_id,              'quantity': qty,              'variation_id': variationid          	},              success: function(response, textStatus, jqXHR){                    location.reload(true);                }            });     }    */    <?php if (false) :     /* <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>&variation_id=261&attribute_stock-colors=1">Add to Cart</a> */ endif; ?>	jQuery('.box').click(function(e) {    	if (!jQuery(this).children('.selection').hasClass("active")) {	    			   		jQuery('.box > .selection').removeClass('active');	   		jQuery('.box-image').removeClass('selectedBoxImage');	   		jQuery(this).children('.selection').addClass('active');	   		jQuery(this).children('.box-image').addClass('selectedBoxImage');	   		jQuery('.box > .mask').hide();	   		jQuery(this).siblings('.box').children('.mask').fadeIn('fast');	   		jQuery("#hiddenboxtype").val(jQuery(".selection.active").html());						jQuery("#hiddenboxtypeimg").val(jQuery(".selectedBoxImage").css('background-image').replace('url(','').replace(')',''));    	}    });	function selectboxcolor(selectedcolor,selectedcolorlabel) {		jQuery(".box-color").removeClass("selected-box-color");		jQuery("#boxcolor").html("No Color");		jQuery(selectedcolor).addClass("selected-box-color");		jQuery("#boxcolor").html(selectedcolorlabel);		jQuery(".box-type-image").parent().parent().removeClass("selected-box");		jQuery(selectedcolor).parents(".box-color-container").parent().addClass("selected-box");		jQuery("#boxprice").html(jQuery(selectedcolor).siblings(".hiddenprice").val());		jQuery("#boxlabel").html(jQuery(selectedcolor).siblings(".hiddenlabel").val());		//jQuery("#hiddenboxtypeimg").val(jQuery(".selectedBoxImage").css('background-image').replace('url(','').replace(')',''));		//alert(jQuery(".selectedBoxImage").attr("style"));		jQuery("#hiddenboxprice").val(jQuery(".selected-box .hiddenprice").val());		jQuery("#hiddenboxcolor").val(selectedcolorlabel);		jQuery(selectedcolor).parent().parent().attr('id', selectedcolorlabel);	}	function selectcardcolor(selectedcolor,selectedcolorlabel) {		jQuery(".single-card-color").removeClass("selected-card-color");		jQuery("#hiddencardcolor").html("No Color");		jQuery(selectedcolor).addClass("selected-card-color");		var str = selectedcolorlabel.replace(/\s+/g, '');		jQuery(selectedcolor).siblings('.card-preview').attr('id', str);		jQuery("#hiddencardcolor").val(selectedcolorlabel);		jQuery("#hiddencardcolorimg").val(jQuery(".selected-card-color img").attr("src"));	}		function selectcardquantity(cardnumber,cardprice) {		jQuery("#hiddencardquantity").val(cardnumber);		jQuery("#hiddencardprice").val(cardprice);	}	function selectBoxButton(selectBtn) {		event.preventDefault();		jQuery(".product-price-content .btn.save").removeClass("selected");		jQuery(".product-price-content .btn.save").html("select");		jQuery(selectBtn).addClass("selected");		jQuery(selectBtn).html("selected");	}	// Set Value of redirect	<?php if (empty($loggedIn) || !$loggedIn) : $_SESSION["returnURL"] = curPageURL(); endif ?>	function goToStep3()	{		if (<?php if (empty($loggedIn) || !$loggedIn) : echo 'true'; else : echo 'false'; endif; ?>) {			// Set Lightbox visible			jQuery("#redirect-step2").val('<?php echo do_shortcode('[site_url]'); ?>/flatterbox-options/?boxtype=' + jQuery("#hiddenboxtype").val() + '&boxprice=' + jQuery("#hiddenboxprice").val() + '&boxcolor=' + jQuery("#hiddenboxcolor").val() + '&cardcolor=' + jQuery("#hiddencardcolor").val() + '&cardquantity=' + jQuery("#hiddencardquantity").val() + '&cardquantityprice=' + jQuery("#hiddencardprice").val() + '&totalprice=' + jQuery("#hiddentotalprice").val() + '&cardcolorimg=' + jQuery("#hiddencardcolorimg").val() + '&boxtypeimg=' + jQuery("#hiddenboxtypeimg").val());			jQuery( ".lightbox-step2.login-step2" ).fadeToggle("fast");			jQuery('html, body').animate({scrollTop : 0},800);		} else {			var totalprice = 0;			totalprice = Number(jQuery("#hiddenboxprice").val()) + Number(jQuery("#hiddencardprice").val());			jQuery("#hiddentotalprice").val(totalprice);					document.location='<?php echo do_shortcode('[site_url]'); ?>/flatterbox-options/?boxtype=' + jQuery("#hiddenboxtype").val() + '&boxprice=' + jQuery("#hiddenboxprice").val() + '&boxcolor=' + jQuery("#hiddenboxcolor").val() + '&cardcolor=' + jQuery("#hiddencardcolor").val() + '&cardquantity=' + jQuery("#hiddencardquantity").val() + '&cardquantityprice=' + jQuery("#hiddencardprice").val() + '&totalprice=' + jQuery("#hiddentotalprice").val() + '&cardcolorimg=' + jQuery("#hiddencardcolorimg").val() + '&boxtypeimg=' + jQuery("#hiddenboxtypeimg").val();		}	}	/*	jQuery("#addToCartBTN").click(function(e) {		e.preventDefault();		var productID = <?php echo $_REQUEST['productid']; ?>;		var variationID = "";		var boxtype = jQuery("#hiddenboxtype").val();		var boxcolor = jQuery("#hiddenboxcolor").val();		var cardcolor = jQuery("#hiddencardcolor").val();		var cardquantity = jQuery("#hiddencardquantity").val();		if (cardquantity == 50) {			variationID = <?php echo $_REQUEST['variation1']; ?>;		} else if (cardquantity == 100) {			variationID = <?php echo $_REQUEST['variation2']; ?>;		} else if (cardquantity == 150) {			variationID = <?php echo $_REQUEST['variation3']; ?>;		} else if (cardquantity == 200) {			variationID = <?php echo $_REQUEST['variation4']; ?>;		}		window.location.href = "<?php echo do_shortcode('[site_url]'); ?>/cart/?add-to-cart="+productID+"&variation_id="+variationID+"&attribute_pa_boxtype="+boxtype+"&attribute_pa_boxcolor="+boxcolor+"&attribute_pa_cardcolor="+cardcolor+"&attribute_pa_cardquantity="+cardquantity+"";		return false;	});	function addToCart(p_id,qty,variationid) {		jQuery.ajax({              type: 'POST',              url: '<?php echo do_shortcode('[site_url]'); ?>/shop/?post_type=product&add-to-cart='+p_id+'&variation_id=668&attribute_boxtype=acrylic$attribute_boxcolor=Clear&attribute_cardcolor=Navy&attribute_cardquantity=200',              data: { 'product_id':  p_id,              'quantity': qty,              'variation_id': variationid          	},              success: function(response, textStatus, jqXHR){                    console.log('Product Added');                }            }); 	}	*/</script><?php echo '<script type="text/javascript">'.$editScript.'</script>'; ?>