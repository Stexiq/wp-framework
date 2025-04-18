<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! function_exists( 'rd_name' ) ) {
	/**
	 * Format the name
	 *
	 * @param string $name
	 * @return string
	 */

	function rd_name( string $name ): string
	{
		return strtolower( RD_PREFIX . '_' . $name );
	}
}
if( ! function_exists( 'rd_setting' ) )
{
	/**
	 * Get setting
	 *
	 * @param string $name
	 * @param mixed|null $default
	 * @return mixed
	 */
	function rd_setting( string $name, mixed $default = null ): mixed
	{
		$settings = get_option( RD_OPTION_SLUG );

		return $settings[ $name ] ?? $default;
	}
}
if( ! function_exists('rd_validate_fields' )) {
	/**
	 * Validate fields
	 *
	 * @param array $fields
	 * @return array
	 */
	function rd_validate_fields( array $fields ): array
	{
		return array_filter($fields, function( $field) {
			return $field->enabled ?? false;
		});
	}
}


if( ! function_exists( 'rd_enqueue_scripts' ) )
{
	/**
	 * Enqueue scripts
	 *
	 * @return void
	 */
	function rd_enqueue_scripts(): void
	{
		wp_enqueue_style( 'rd-admin-css', RD_URL . '/assets/css/admin.css', array(), '1.0', 'all' );

		$required = array(  );
		if( wp_script_is( 'color-picker-js', 'enqueued' ) ) {
			$required[] = 'color-picker-js';
		}
		wp_enqueue_script( 'rd-admin-js', RD_URL . '/assets/js/admin.min.js', $required, '1.0', true );
		wp_localize_script( 'rd-admin-js', 'tk', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'rd' ),
		) );
	}
}
add_action( 'admin_enqueue_scripts', 'rd_enqueue_scripts' );

if( ! function_exists( 'rd_generate_site_id') )
{
	function rd_get_site_id(): string
	{
		$unique = array(
			'site_url' => get_site_url(),
			'auth_key' => get_current_blog_id(),
		);

		$site_id = md5( implode( '', $unique ) );

		 $site_id = substr( $site_id, 0, 16 );
		 $site_id = sprintf( '%s-%s-%s', substr( $site_id, 0, 4 ), substr( $site_id, 8, 4 ), substr( $site_id, 12, 4 ) );

		return $site_id;
	}
}

if( ! function_exists( 'rd_select' ) ) {
	/**
	 * Create a new select field
	 *
	 * @return RD_Select
	 */
	function rd_select(): RD_Select
	{
		return new RD_Select();
	}
}
if( ! function_exists( 'rd_section' ) ) {
	/**
	 * Create a new section field
	 *
	 * @return RD_Section
	 */
	function rd_section(): RD_Section
	{
		return new RD_Section();
	}
}
if( ! function_exists( 'rd_checkbox' ) ) {
	/**
	 * Create a new checkbox field
	 *
	 * @return RD_Checkbox
	 */
	function rd_checkbox(): RD_Checkbox
	{
		return new RD_Checkbox();
	}
}
if( ! function_exists( 'rd_textarea' ) ) {
	/**
	 * Create a new textarea field
	 *
	 * @return RD_Textarea
	 */
	function rd_textarea(): RD_Textarea
	{
		return new RD_Textarea();
	}
}
if( ! function_exists( 'rd_switch' ) ) {
	/**
	 * Create a new switch field
	 *
	 * @return RD_Switch
	 */
	function rd_switch(): RD_Switch
	{
		return new RD_Switch();
	}
}
if( ! function_exists( 'rd_color' ) ) {
	/**
	 * Create a new color field
	 *
	 * @return RD_Color
	 */
	function rd_color(): RD_Color
	{
		return new RD_Color();
	}
}
if( ! function_exists( 'rd_password' ) ) {
	/**
	 * Create a new password field
	 *
	 * @return RD_Password
	 */
	function rd_password(): RD_Password
	{
		return new RD_Password();
	}
}
if( ! function_exists( 'rd_text' ) ) {
	/**
	 * Create a new text field
	 *
	 * @return RD_Text
	 */
	function rd_text(): RD_Text
	{
		return new RD_Text();
	}
}
if( ! function_exists( 'rd_custom' ) ) {
	/**
	 * Create a new custom field
	 *
	 * @return RD_Custom
	 */
	function rd_custom(): RD_Custom
	{
		return new RD_Custom();
	}
}
if( ! function_exists( 'rd_tab' ) ) {
	/**
	 * Create a new tab field
	 *
	 * @return RD_Tab
	 */
	function rd_tab(): RD_Tab
	{
		return new RD_Tab();
	}
}


if( ! function_exists( 'rd_get_roles') )
{
	/**
	 * Get all roles
	 *
	 * @return array
	 */
	function rd_get_roles(): array
	{
		$wp_roles = wp_roles()->roles;
		$roles = [];

		foreach( $wp_roles as $key => $role ) {
			$roles[$key] = $role['name'];
		}

		return $roles;
	}
}
if( ! function_exists( 'rd_get_users') )
{
	/**
	 * Get all users
	 *
	 * @return array
	 */
	function rd_get_users(): array
	{
		$users = get_users();
		$users_list = [];

		foreach( $users as $user ) {
			$users_list[$user->ID] = $user->display_name;
		}

		return $users_list;
	}
}

// post_types
if( ! function_exists( 'rd_get_post_types') )
{
	/**
	 * Get all post types
	 *
	 * @return array
	 */
	function rd_get_post_types(): array
	{
		$post_types = get_post_types( array( 'public' => true ), 'objects' );
		$post_types_list = [];

		foreach( $post_types as $post_type ) {
			$post_types_list[$post_type->name] = $post_type->label;
		}

		return $post_types_list;
	}
}

if( ! function_exists( 'rd_for_selectable' ) )
{
	/**
	 * Get selectable items
	 *
	 * @param array $selects
	 * @return array
	 */
	function rd_for_selectable( ...$selects ): array
	{
		$data = [];
		$source = [];
		foreach( $selects as $select ) {
			switch ( $select ) {
				case 'role':
					$source = rd_get_roles();
					break;
				case 'user':
					$source = rd_get_users();
					break;
				case 'post_type':
					$source = rd_get_post_types();
					break;
			}

			$updated = [];
			foreach( $source as $key => $value ) {
				$updated[ $select . '__' . $key] = ucfirst($select) . ': ' . $value;
			}

			$data = array_merge( $data, $updated );
		}

		// order by value
		asort( $data );

		return $data;
	}
}

if( ! function_exists( 'rd_is_allowed' ) )
{
	/**
	 * Check if user is allowed
	 *
	 * @param array $validate
	 * @return bool
	 */
	function rd_is_allowed( array $validate ): bool
	{
		$is_allowed = false;
		foreach( $validate as $item ) {
			$source = explode( '__', $item );
			$current_user = wp_get_current_user();

			$source_key = $source[0];
			$source_value = $source[1];

			switch ( $source_key ) {
				case 'role':
					$roles = $current_user->roles;
					if ( in_array( $source_value, $roles ) ) {
						$is_allowed = true;
					}
					break;
				case 'user':
					if ( $current_user->ID == $source_value ) {
						$is_allowed = true;
					}
					break;
			}
		}

		return $is_allowed;
	}
}

if( ! function_exists( 'rd_plugin_update_htaccess' ) )
{
	/**
	 * Update htaccess
	 *
	 * @param string $block
	 * @param string $rules
	 * @return void
	 */
	function rd_plugin_update_htaccess( string $block, string $rules ): void
	{
		$filesystem = rd_plugin_get_filesystem();
		if ( null === $filesystem ) {
			return;
		}

		$htaccess_file = rd_plugin_get_writable_htaccess_path( $filesystem );
		if ( null === $htaccess_file ) {
			return;
		}

		rd_plugin_cleanup_htaccess( $block );

		$original_contents = $filesystem->get_contents( $htaccess_file );
		if ( false === $original_contents ) {
			return;
		}

		$rules = explode( PHP_EOL, $rules );
		$rules = array_map( 'trim', $rules );

		$lines = array(
			$original_contents,
			'',
			sprintf( '# BEGIN %s', $block ),
		);

		$lines = array_merge( $lines, $rules );

		$lines[] = sprintf( '# END %s', $block );
		$lines[] = '';

		$filesystem->put_contents( $htaccess_file, implode( PHP_EOL, $lines ) );
	}
}
if( ! function_exists( 'rd_plugin_cleanup_htaccess' ) )
{
	/**
	 * Cleanup htaccess
	 *
	 * @param string $block
	 * @return void
	 */
	function rd_plugin_cleanup_htaccess( string $block ): void
	{
		$filesystem = rd_plugin_get_filesystem();
		if ( null === $filesystem ) {
			return;
		}

		$htaccess_file = rd_plugin_get_writable_htaccess_path( $filesystem );
		if ( null === $htaccess_file ) {
			return;
		}

		$htaccess_contents = $filesystem->get_contents( $htaccess_file );
		if ( false === $htaccess_contents ) {
			return;
		}

		$regex             = '/# BEGIN ' . preg_quote( $block, '/' ) . '.*?# END ' . preg_quote( $block, '/' ) . '/s';
		$htaccess_contents = preg_replace( $regex, "\n\n", $htaccess_contents );

		$htaccess_contents = preg_replace( "/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $htaccess_contents );
		$filesystem->put_contents( $htaccess_file, $htaccess_contents );

		rd_plugin_flush_rewrite_rules();
	}
}
if( ! function_exists( 'rd_plugin_flush_rewrite_rules' ) )
{
	/**
	 * Flush rewrite rules
	 *
	 * @return void
	 */
	function rd_plugin_flush_rewrite_rules(): void
	{
		global $wp_rewrite;
		if ( $wp_rewrite instanceof WP_Rewrite ) {
			$wp_rewrite->flush_rules();
		}
	}
}
if( ! function_exists( 'rd_plugin_get_filesystem' ) )
{
	/**
	 * Get filesystem
	 *
	 * @return WP_Filesystem_Base|null
	 */
	function rd_plugin_get_filesystem(): ?WP_Filesystem_Base
	{
		global $wp_filesystem;

		if( true !== WP_Filesystem() ) {
			return null;
		}

		return $wp_filesystem;
	}
}
if( ! function_exists( 'rd_plugin_get_writable_htaccess_path' ) )
{
	/**
	 * Get writable htaccess path
	 *
	 * @param WP_Filesystem_Base $filesystem
	 * @return string|null
	 */
	function rd_plugin_get_writable_htaccess_path( WP_Filesystem_Base $filesystem ): ?string
	{
		$htaccess_file = get_home_path() . '.htaccess';

		if ( ! $filesystem->exists( $htaccess_file ) || ! $filesystem->is_readable( $htaccess_file ) || ! $filesystem->is_writable( $htaccess_file ) ) {
			return null;
		}

		return $htaccess_file;
	}
}



if( ! function_exists( 'rd_get_dashboard_widgets' ) )
{
	/**
	 * Get dashboard widgets
	 *
	 * @return array
	 */
	function rd_get_dashboard_widgets(): array
	{
		global $wp_meta_boxes;

		$dashboard_widgets = array();

		if ( ! isset( $wp_meta_boxes['dashboard'] ) ) {
			require_once ABSPATH . '/wp-admin/includes/dashboard.php';
			set_current_screen( 'dashboard' );
			wp_dashboard_setup();
		}

		if ( isset( $wp_meta_boxes['dashboard'] ) ) {
			foreach( $wp_meta_boxes['dashboard'] as $context => $priorities ) {
				foreach ( $priorities as $priority => $widgets ) {
					foreach( $widgets as $widget_id => $data ) {
						$widget_title = ( isset( $data['title'] ) ) ? wp_strip_all_tags( preg_replace( '/ <span.*span>/im', '', $data['title'] ) ) : str_replace( '_', ' ', ucwords($widget_id) );
						$dashboard_widgets[$widget_id] =  [
							'id'        => $widget_id,
							'title'     => $widget_title,
							'context'   => $context, // 'normal' or 'side'
							'priority'  => $priority, // 'core'
							'location'  => $data['location'] ?? 'core',
						];
					}
				}
			}
		}

		return wp_list_sort( $dashboard_widgets, 'title', 'ASC', true );
	}
}


function rd_minify( $data )
{
	return preg_replace( array( '/\s+/', '/\s*([{};:])\s*/', '/\s*([()])\s*/', ), array( ' ', '$1', '$1', ), $data );
}