<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! function_exists( 'sq_name' ) ) {
	/**
	 * Format the name
	 *
	 * @param string $name
	 * @return string
	 */

	function sq_name( string $name ): string
	{
		return strtolower( SQ_PREFIX . '_' . $name );
	}
}
if( ! function_exists( 'sq_setting' ) )
{
	/**
	 * Get setting
	 *
	 * @param string $name
	 * @param mixed|null $default
	 * @return mixed
	 */
	function sq_setting( string $name, mixed $default = null ): mixed
	{
		$settings = get_option( SQ_OPTION_SLUG );

		return $settings[ $name ] ?? $default;
	}
}
if( ! function_exists('sq_validate_fields' )) {
	/**
	 * Validate fields
	 *
	 * @param array $fields
	 * @return array
	 */
	function sq_validate_fields( array $fields ): array
	{
		return array_filter($fields, function( $field) {
			return $field->enabled ?? false;
		});
	}
}


if( ! function_exists( 'sq_enqueue_scripts' ) )
{
	/**
	 * Enqueue scripts
	 *
	 * @return void
	 */
	function sq_enqueue_scripts(): void
	{
		wp_enqueue_style( 'sq-admin-css', SQ_URL . '/assets/css/admin.css', array(), '1.0', 'all' );

		$required = array(  );
		if( wp_script_is( 'color-picker-js', 'enqueued' ) ) {
			$required[] = 'color-picker-js';
		}
		wp_enqueue_script( 'sq-admin-js', SQ_URL . '/assets/js/admin.min.js', $required, '1.0', true );
		wp_localize_script( 'sq-admin-js', 'tk', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'sq' ),
		) );
	}
}
add_action( 'admin_enqueue_scripts', 'sq_enqueue_scripts' );

if( ! function_exists( 'sq_generate_site_id') )
{
	function sq_get_site_id(): string
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

if( ! function_exists( 'sq_select' ) ) {
	/**
	 * Create a new select field
	 *
	 * @return SQ_Select
	 */
	function sq_select(): SQ_Select
	{
		return new SQ_Select();
	}
}
if( ! function_exists( 'sq_section' ) ) {
	/**
	 * Create a new section field
	 *
	 * @return SQ_Section
	 */
	function sq_section(): SQ_Section
	{
		return new SQ_Section();
	}
}
if( ! function_exists( 'sq_checkbox' ) ) {
	/**
	 * Create a new checkbox field
	 *
	 * @return SQ_Checkbox
	 */
	function sq_checkbox(): SQ_Checkbox
	{
		return new SQ_Checkbox();
	}
}
if( ! function_exists( 'sq_textarea' ) ) {
	/**
	 * Create a new textarea field
	 *
	 * @return SQ_Textarea
	 */
	function sq_textarea(): SQ_Textarea
	{
		return new SQ_Textarea();
	}
}
if( ! function_exists( 'sq_switch' ) ) {
	/**
	 * Create a new switch field
	 *
	 * @return SQ_Switch
	 */
	function sq_switch(): SQ_Switch
	{
		return new SQ_Switch();
	}
}
if( ! function_exists( 'sq_color' ) ) {
	/**
	 * Create a new color field
	 *
	 * @return SQ_Color
	 */
	function sq_color(): SQ_Color
	{
		return new SQ_Color();
	}
}
if( ! function_exists( 'sq_password' ) ) {
	/**
	 * Create a new password field
	 *
	 * @return SQ_Password
	 */
	function sq_password(): SQ_Password
	{
		return new SQ_Password();
	}
}
if( ! function_exists( 'sq_text' ) ) {
	/**
	 * Create a new text field
	 *
	 * @return SQ_Text
	 */
	function sq_text(): SQ_Text
	{
		return new SQ_Text();
	}
}
if( ! function_exists( 'sq_custom' ) ) {
	/**
	 * Create a new custom field
	 *
	 * @return SQ_Custom
	 */
	function sq_custom(): SQ_Custom
	{
		return new SQ_Custom();
	}
}
if( ! function_exists( 'sq_tab' ) ) {
	/**
	 * Create a new tab field
	 *
	 * @return SQ_Tab
	 */
	function sq_tab(): SQ_Tab
	{
		return new SQ_Tab();
	}
}


if( ! function_exists( 'sq_get_roles') )
{
	/**
	 * Get all roles
	 *
	 * @return array
	 */
	function sq_get_roles(): array
	{
		$wp_roles = wp_roles()->roles;
		$roles = [];

		foreach( $wp_roles as $key => $role ) {
			$roles[$key] = $role['name'];
		}

		return $roles;
	}
}
if( ! function_exists( 'sq_get_users') )
{
	/**
	 * Get all users
	 *
	 * @return array
	 */
	function sq_get_users(): array
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
if( ! function_exists( 'sq_get_post_types') )
{
	/**
	 * Get all post types
	 *
	 * @return array
	 */
	function sq_get_post_types(): array
	{
		$post_types = get_post_types( array( 'public' => true ), 'objects' );
		$post_types_list = [];

		foreach( $post_types as $post_type ) {
			$post_types_list[$post_type->name] = $post_type->label;
		}

		return $post_types_list;
	}
}

if( ! function_exists( 'sq_for_selectable' ) )
{
	/**
	 * Get selectable items
	 *
	 * @param array $selects
	 * @return array
	 */
	function sq_for_selectable( ...$selects ): array
	{
		$data = [];
		$source = [];
		foreach( $selects as $select ) {
			switch ( $select ) {
				case 'role':
					$source = sq_get_roles();
					break;
				case 'user':
					$source = sq_get_users();
					break;
				case 'post_type':
					$source = sq_get_post_types();
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

if( ! function_exists( 'sq_is_allowed' ) )
{
	/**
	 * Check if user is allowed
	 *
	 * @param array $validate
	 * @return bool
	 */
	function sq_is_allowed( array $validate ): bool
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

if( ! function_exists( 'sq_plugin_update_htaccess' ) )
{
	/**
	 * Update htaccess
	 *
	 * @param string $block
	 * @param string $rules
	 * @return void
	 */
	function sq_plugin_update_htaccess( string $block, string $rules ): void
	{
		$filesystem = sq_plugin_get_filesystem();
		if ( null === $filesystem ) {
			return;
		}

		$htaccess_file = sq_plugin_get_writable_htaccess_path( $filesystem );
		if ( null === $htaccess_file ) {
			return;
		}

		sq_plugin_cleanup_htaccess( $block );

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
if( ! function_exists( 'sq_plugin_cleanup_htaccess' ) )
{
	/**
	 * Cleanup htaccess
	 *
	 * @param string $block
	 * @return void
	 */
	function sq_plugin_cleanup_htaccess( string $block ): void
	{
		$filesystem = sq_plugin_get_filesystem();
		if ( null === $filesystem ) {
			return;
		}

		$htaccess_file = sq_plugin_get_writable_htaccess_path( $filesystem );
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

		sq_plugin_flush_rewrite_rules();
	}
}
if( ! function_exists( 'sq_plugin_flush_rewrite_rules' ) )
{
	/**
	 * Flush rewrite rules
	 *
	 * @return void
	 */
	function sq_plugin_flush_rewrite_rules(): void
	{
		global $wp_rewrite;
		if ( $wp_rewrite instanceof WP_Rewrite ) {
			$wp_rewrite->flush_rules();
		}
	}
}
if( ! function_exists( 'sq_plugin_get_filesystem' ) )
{
	/**
	 * Get filesystem
	 *
	 * @return WP_Filesystem_Base|null
	 */
	function sq_plugin_get_filesystem(): ?WP_Filesystem_Base
	{
		global $wp_filesystem;

		if( true !== WP_Filesystem() ) {
			return null;
		}

		return $wp_filesystem;
	}
}
if( ! function_exists( 'sq_plugin_get_writable_htaccess_path' ) )
{
	/**
	 * Get writable htaccess path
	 *
	 * @param WP_Filesystem_Base $filesystem
	 * @return string|null
	 */
	function sq_plugin_get_writable_htaccess_path( WP_Filesystem_Base $filesystem ): ?string
	{
		$htaccess_file = get_home_path() . '.htaccess';

		if ( ! $filesystem->exists( $htaccess_file ) || ! $filesystem->is_readable( $htaccess_file ) || ! $filesystem->is_writable( $htaccess_file ) ) {
			return null;
		}

		return $htaccess_file;
	}
}



if( ! function_exists( 'sq_get_dashboard_widgets' ) )
{
	/**
	 * Get dashboard widgets
	 *
	 * @return array
	 */
	function sq_get_dashboard_widgets(): array
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


function sq_minify( $data )
{
	return preg_replace( array( '/\s+/', '/\s*([{};:])\s*/', '/\s*([()])\s*/', ), array( ' ', '$1', '$1', ), $data );
}