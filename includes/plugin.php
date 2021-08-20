<?php namespace WSUWP\Plugin\LastLogin;

class Plugin {

	protected static $version = '0.0.5';

	public static function get( $property ) {
		switch ( $property ) {
			case 'version':
				return self::$version;

			case 'plugin_dir':
				return plugin_dir_path( dirname( __FILE__ ) );

			case 'plugin_url':
				return plugin_dir_url( dirname( __FILE__ ) );

			case 'template_dir':
				return plugin_dir_path( dirname( __FILE__ ) ) . '/templates';

			case 'class_dir':
				return plugin_dir_path( dirname( __FILE__ ) ) . '/classes';

			default:
				return '';
		}
	}

	public static function init() {

		include_once __DIR__ . '/last-login.php';

	}

}

Plugin::init();
