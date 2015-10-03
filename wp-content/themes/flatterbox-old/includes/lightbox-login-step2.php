<div class="holder">
	<a href="#" class="close" id="close">close</a>
	<strong class="title">Login or Register</strong>
	<ul class="loginbox">
		<li class="outline">
			<?php if (false) : ?>
			<div class="frame">
				<form name="login" id="login" method="post" action="">
				<input type="hidden" name="option" value="afo_user_login">
				<input type="hidden" name="redirect" id="redirect-step2" value="<?php echo site_url(); ?>/flatterbox-options">
					<ul class="login_wid">
					<li>Email Address</li>
					<li><input type="text" name="user_username" required="required"></li>
					<li>Password</li>
					<li><input type="password" name="user_password" required="required"></li>
								<li><input name="login" type="submit" value="Login"></li>
					<li class="extra-links"><a href="<?php echo home_url('/forgot-password/'); ?>">Lost Password?</a></li>			</ul>
				</form>
				<?php echo do_shortcode('[divider]'); ?>
				<h2>First Time?</h2>
				<a id="createaccountlink" href="#" class="btn save" onclick="mCreate();">Create Your Account</a>
				<input type="hidden" name="createaccountlink" id="createaccountlink-step2" value="<?php echo site_url(); ?>/create-an-account/">
			</div>
			<?php endif; ?>
			<div class="frame">
				<?php login_with_ajax(); ?>
			</div>
		</li>
	</ul>
	
</div>
<script>
jQuery( ".close" ).click(function(event) {
	event.preventDefault();
  	jQuery(this).parent().parent().fadeOut("fast");
});
</script>