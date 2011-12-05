<?php
/*
Plugin Name: Gemius for WordPress
Description: Integrates Gemius tracking on your blog.
Version: 0.1.1
Author: TLA Media
Author URI: http://www.tlamedia.dk/
Plugin URI: http://wpplugins.tlamedia.dk/gemius-for-wordpress/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define( 'GEMIUSWP_VERSION', '0.1.1' );


if ( is_admin() && ! class_exists( 'TLA_GemiusWP_Admin' ) ) {

	class TLA_GemiusWP_Admin {

		function gemiuswp_options_page() {
			?>
			<div class="wrap">
				<div id="icon-options-general" class="icon32"><br /></div>
				<h2><?php _e('Gemius for WordPress', 'gemiuswp'); ?></h2>
				<p><?php _e('All you need to do to setup Gemius for WordPress is enter the Gemius Identifier and you are good to go.', 'gemiuswp'); ?></p><br />
				<form action="options.php" method="post">
					<?php settings_fields('gemiuswp_options'); ?>
					<?php do_settings_sections('gemiuswp'); ?>
					<br /><br />
					<input id="submit" class="button-primary" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes', 'gemiuswp'); ?>" />
				</form>
			</div>
			<?php
		}

		function gemiuswp_section_text() {
			echo '<p>' . _e('Log in to Gemius. Find the Gemius Identifier and enter it below.', 'gemiuswp') . '</p>';
		}

		function gemiuswp_setting_string() {
			$options = get_option('gemiuswp_options');
			echo "<input id='gemiuswp_text_string' name='gemiuswp_options[gemius_identifier]' size='40' type='text' value='{$options['gemius_identifier']}' />";
		}

		function gemiuswp_admin_init() {
			register_setting( 'gemiuswp_options', 'gemiuswp_options' );
			add_settings_section('gemiuswp_main', __('Settings'), array($this,'gemiuswp_section_text'), 'gemiuswp' );
			add_settings_field('gemiuswp_text_string', 'Gemius Identifier', array($this,'gemiuswp_setting_string'), 'gemiuswp', 'gemiuswp_main');
			load_plugin_textdomain( 'gemiuswp', false, '/gemius-for-wordpress/languages' );
		}

		function gemiuswp_admin_add_page() {
			add_options_page( 'Gemius Options', 'Gemius', 'manage_options', 'gemiuswp', array($this,'gemiuswp_options_page') );
		}

		function gemius_warning() {
			echo "<div id='gemius_warning' class='updated fade'><p><strong>";
			_e('Gemius is not configured!', 'gemiuswp');
			echo "</strong>";
			printf (__('You must %1$s enter your Gemius Identifier%2$s.', 'gemiuswp'), "<a href='options-general.php?page=gemiuswp'>", "</a>");
			echo "</p></div>";
			echo "<script type=\"text/javascript\">setTimeout(function(){jQuery('#gemius_warning').hide('slow');}, 10000);</script>";
		}

		static function gemiuswp_get_options() {
			$options = get_option('gemiuswp_options');
			return $options;
		}

		function __construct() {
			add_action( 'admin_init', array($this,'gemiuswp_admin_init') );
			add_action( 'admin_menu', array($this,'gemiuswp_admin_add_page') );
			$options = get_option('gemiuswp_options');
			if ( !$options['gemius_identifier'] || empty($options['gemius_identifier']) )
				add_action('admin_notices', array($this,'gemius_warning') );
		}

	}
	new TLA_GemiusWP_Admin();
}


function tla_gemiuswp_trackingscript() {
	$options = get_option('gemiuswp_options');
?>
<!-- Gemius for WordPress by TLA Media - http://www.tlamedia.dk/ -->
<script type="text/javascript">
<!--//--><![CDATA[//><!--
var pp_gemius_identifier = new String('<?php echo $options['gemius_identifier']; ?>');
//--><!]]>
</script>
<script type="text/javascript" src="<?php echo plugins_url( 'xgemius.js' , __FILE__ ); ?>"></script>
<!-- End Gemius for WordPress -->
<?php
}

add_action('wp_footer','tla_gemiuswp_trackingscript');
