<?php namespace WSUWP\Plugin\LastLogin;

class Last_Login {

	public static function capture_login( $user_login, $user ) {
		update_user_meta( $user->ID, 'last_login', time() );
	}

	public static function user_last_login_column( $columns ) {
		$columns['last_login'] = 'Last Login';
		return $columns;
	}

	public static function last_login_column( $output, $column_id, $user_id ) {
		if ( $column_id === 'last_login' ) {
			$last_login        = get_user_meta( $user_id, 'last_login', true );
			$date_format       = 'M j, Y';
			$hover_date_format = 'F j, Y, g:i a';

			$output = $last_login ? '<div title="Last login: ' . date( $hover_date_format, $last_login ) . '">' . human_time_diff( $last_login ) . '</div>' : 'No record';
		}

		return $output;
	}

	public static function sortable_last_login_column( $columns ) {
		return wp_parse_args(
			array(
				'last_login' => 'last_login',
			),
			$columns
		);
	}

	public static function sort_last_login_column( $query ) {
		if ( ! is_admin() ) {
			return $query;
		}

		$screen = get_current_screen();

		if ( isset( $screen->id ) && ( $screen->id !== 'users' && $screen->id !== 'users-network' ) ) {
			return $query;
		}

		if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'last_login' ) {
			$query->query_vars['meta_key'] = 'last_login';
			$query->query_vars['orderby']  = 'meta_value';
		}

		return $query;
	}


	public static function init() {

		// Record user's last login to custom meta
		add_action( 'wp_login', array( __CLASS__, 'capture_login' ), 10, 2 );

		// Register new custom column with last login time
		add_filter( 'manage_users_columns', array( __CLASS__, 'user_last_login_column' ) );
		add_filter( 'manage_users_custom_column', array( __CLASS__, 'last_login_column' ), 10, 3 );

		// Allow the last login columns to be sortable
		add_filter( 'manage_users_sortable_columns', array( __CLASS__, 'sortable_last_login_column' ) );
		add_action( 'pre_get_users', array( __CLASS__, 'sort_last_login_column' ) );

		// Network Admin | Register new custom column with last login time
		add_filter( 'manage_users-network_columns', array( __CLASS__, 'user_last_login_column' ) );

		// Network Admin | Allow the last login columns to be sortable
		add_filter( 'manage_users-network_sortable_columns', array( __CLASS__, 'sortable_last_login_column' ) );
	}

}

Last_Login::init();
