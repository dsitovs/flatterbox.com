<?php 

/* Template Name: FB Step 5 Confirm */
if ( false ) :
	$_SESSION["flatterernames"] = $_POST['flatterername'];
	$_SESSION["flattereremails"] = $_POST["flattereremail"];
else :
	$arrNames = array();
	$arrEmails = array();

	//$strings = explode(",", $_POST['flatterers']);
	$strings = preg_split( '/(\s|;|,)/', $_POST['flatterers'] );

	foreach ($strings as $value) {
		$entry = explode(" ", trim($value));
		$theemail = array_pop($entry); // removes last entry in array
		$theemail = strtolower(trim($theemail)); // Make lower case and trim white space
		$theemail = str_replace(';', '', $theemail); // from tag issues
		$theemail = str_replace('\\\'', '', $theemail); // from tag issues
		$theemail = str_replace('\'', '', $theemail); // from tag issues
		if (strpos($theemail,'<')) : $theemail = get_string_between($theemail,'<','>'); endif;// from tag issues

		$thename = trim(str_replace($theemail, '', trim($value)));
		//if (!$thename) : $thename = 'Flatterer'; endif; // Just incase only email is used, we need a name.
		if ( filter_var($theemail, FILTER_VALIDATE_EMAIL) && !in_array($theemail, $arrEmails) ) :
			array_push($arrEmails, $theemail); // adds to emails array
			array_push($arrNames, $thename); // replaces the email with empty string and adds to the names array
		endif;
	}
	$_SESSION["flatterernames"] = $arrNames;
	$_SESSION["flattereremails"] = $arrEmails;
endif;
$_SESSION["message_to_flatterers"] = $_POST["message_to_flatterers"];

if ( $_POST["redirectback"] == "1" ) :
	wp_redirect( home_url().'/flatterbox-options/' ); exit;
elseif ( false ) : // Putting the page back in process - remove the if should we need
	wp_redirect( home_url().'/title-card/?initialinvite=1' ); exit; //added as a bypass
endif;

get_header('steps'); ?>
<?php // $page_background_photo = getOccasionBGImg($_SESSION["occasion_id"]); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<main id="main" role="main">
	<div class="container">
		<div class="heading steps">
			<h1><?php the_field('page_title'); ?></h1>
		</div>
		<ul id="status-bar">
			<li class="done"><a href="<?php echo do_shortcode('[site_url]'); ?>/choose-card/?preservesession=1">Create It</a></li>
			<li class="done"><a href="<?php echo do_shortcode('[site_url]'); ?>/flatterbox-options/">Personalize It</a></li>
			<li class="active">Invite Flatterers</li>
			<li>Title Card</li>
			<li class="clearpadding">Write the First One!</li>
			<li>Complete</li>
		</ul>
		<section class="sentiment-holder">
			<div class="compose">
				<h2>Confirm Invited Flatterers.</h2>
				<?php the_content(); ?>
			</div>
			<div class="example">
				<div class="img-holder">
				
				<?php 
				// Converted to Session
				$nCount = 0;
				for ($i = 0; $i < count($_SESSION['flattereremails']); $i++)
				{
					if ($_SESSION['flattereremails'][$i] != "")
					{
						if ($nCount % 2 == 0) {
							if ($nCount == 0) {
								echo "<div class=\"list_row\">";
							} else {
								echo "</p></div><div class=\"list_row\">";
							}
							echo "<p class=\"list_left\">";

						} else {
							echo "</p><p class=\"list_right\">";
						}
						echo $_SESSION['flattereremails'][$i];
						// echo "<p>" . $_SESSION['flattereremails'][$i] . "</p>"; // Old layout -- remove rest inside the if flattereremails check
						$nCount++;
					}
				}
				echo "</p></div>" // Close it off - Remove if returning to old layout
				?>
			

				</div>
			</div>
		</section>
		<div class="control-bar bottom">
			<a href="<?php echo do_shortcode('[site_url]'); ?>/invitation/" class="btn back">Back to Invite Flatterers</a>
			<a href="<?php echo do_shortcode('[site_url]'); ?>/title-card/?initialinvite=1" class="btn save">Send Invitations</a>
		</div>
	</div>
</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>				