<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>


<div class="col2-set" id="customer_login">

	<div class="col col-1">

			<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>
			<form action="" method="post" class="login login-box">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

					<p class="form-row form-row-wide form-row-first">
						<label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="username" />
					</p>
					<p class="form-row form-row-wide form-row-last">
						<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input class="input-text" type="password" name="password" id="password" />
					</p>
					
				<?php do_action( 'woocommerce_login_form' ); ?>

					<p class="form-row buttons clearfix">
						<?php wp_nonce_field( 'woocommerce-login' ); ?>
						<span class="rememberme">
							<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
							<label for="rememberme" class="inline"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
						</span>
						<button type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>"><?php _e( 'Login', 'woocommerce' ); ?></button>
						<span class="lost_password">
							<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
						</span>
					</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>
	</div>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<div class="col col-2">

		<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="register login-box">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="form-row form-row-wide">
					<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</p>

			<?php endif; ?>

			<p class="form-row form-row-wide">
				<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
	
				<p class="form-row form-row-wide">
					<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" class="input-text" name="password" id="reg_password" />
				</p>

			<?php endif; ?>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<p class="form-row buttons clearfix">
				<?php wp_nonce_field( 'woocommerce-register' ); ?>
				<button type="submit" class="button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>"><?php _e( 'Register', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>
<?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>