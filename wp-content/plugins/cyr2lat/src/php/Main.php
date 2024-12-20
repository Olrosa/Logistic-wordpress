<?php
/**
 * Main class of the plugin.
 *
 * @package cyr-to-lat
 */

// phpcs:disable Generic.Commenting.DocComment.MissingShort
/** @noinspection PhpUndefinedNamespaceInspection */
/** @noinspection PhpUndefinedClassInspection */
// phpcs:enable Generic.Commenting.DocComment.MissingShort

namespace CyrToLat;

use Automattic\WooCommerce\Utilities\FeaturesUtil;
use CyrToLat\BackgroundProcesses\PostConversionProcess;
use CyrToLat\BackgroundProcesses\TermConversionProcess;
use CyrToLat\Settings\Converter as SettingsConverter;
use CyrToLat\Settings\SystemInfo as SettingsSystemInfo;
use CyrToLat\Settings\Tables as SettingsTables;
use Polylang;
use SitePress;
use WP_CLI;
use WP_Error;
use WP_Post;
use wpdb;
use Exception;
use CyrToLat\Settings\Settings;
use CyrToLat\Symfony\Polyfill\Mbstring\Mbstring;

/**
 * Class Main
 */
class Main {

	/**
	 * Request type.
	 *
	 * @var Request
	 */
	protected $request;

	/**
	 * Plugin settings.
	 *
	 * @var Settings
	 */
	protected $settings;

	/**
	 * Process posts instance.
	 *
	 * @var PostConversionProcess
	 */
	protected $process_all_posts;

	/**
	 * Process terms instance.
	 *
	 * @var TermConversionProcess
	 */
	protected $process_all_terms;

	/**
	 * Admin Notices instance.
	 *
	 * @var AdminNotices
	 */
	protected $admin_notices;

	/**
	 * Converter instance.
	 *
	 * @var Converter
	 */
	protected $converter;

	/**
	 * WP_CLI instance.
	 *
	 * @var WPCli
	 */
	protected $cli;

	/**
	 * ACF instance.
	 *
	 * @var ACF
	 */
	protected $acf;

	/**
	 * Flag showing that we are processing a term.
	 *
	 * @var bool
	 */
	private $is_term = false;

	/**
	 * Taxonomies saved in pre_insert_term or get_terms_args filter.
	 *
	 * @var string[]|null
	 */
	private $taxonomies;

	/**
	 * Polylang locale.
	 *
	 * @var string
	 */
	private $pll_locale;

	/**
	 * WPML locale.
	 *
	 * @var string|null
	 */
	protected $wpml_locale;

	/**
	 * WPML languages.
	 *
	 * @var array
	 */
	protected $wpml_languages;

	/**
	 * Current request is frontend.
	 *
	 * @var bool|null
	 */
	protected $is_frontend;

	/**
	 * Init plugin.
	 *
	 * @return void
	 */
	public function init(): void {
		add_action( 'plugins_loaded', [ $this, 'init_all' ], - PHP_INT_MAX );
	}

	/**
	 * Init all plugin stuffs.
	 *
	 * @return void
	 */
	public function init_all(): void {
		$this->load_textdomain();

		$this->init_multilingual();
		$this->init_classes();
		$this->init_cli();
		$this->init_hooks();
	}

	/**
	 * Load plugin text domain.
	 *
	 * @return void
	 */
	public function load_textdomain(): void {
		add_filter( 'doing_it_wrong_trigger_error', [ $this, 'doing_it_wrong_trigger_error' ], 10, 4 );

		load_default_textdomain();
		load_plugin_textdomain(
			'cyr2lat',
			false,
			dirname( plugin_basename( constant( 'CYR_TO_LAT_FILE' ) ) ) . '/languages/'
		);
	}

	/**
	 * Init multilingual features.
	 * It must be first in the init sequence, as we use defined filters internally in our classes.
	 *
	 * @return void
	 */
	protected function init_multilingual(): void {
		if ( class_exists( Polylang::class ) ) {
			add_filter( 'locale', [ $this, 'pll_locale_filter' ] );
		}

		if ( class_exists( SitePress::class ) ) {
			$this->wpml_locale = $this->get_wpml_locale();

			// We cannot use locale filter here
			// as WPML reverts locale at PHP_INT_MAX in \WPML\ST\MO\Hooks\LanguageSwitch::filterLocale.
			add_filter( 'ctl_locale', [ $this, 'wpml_locale_filter' ], - PHP_INT_MAX );

			add_action( 'wpml_language_has_switched', [ $this, 'wpml_language_has_switched' ], 10, 3 );
		}
	}

	/**
	 * Filter for _doing_it_wrong() calls.
	 *
	 * @param bool|mixed $trigger       Whether to trigger the error for _doing_it_wrong() calls. Default true.
	 * @param string     $function_name The function that was called.
	 * @param string     $message       A message explaining what has been done incorrectly.
	 * @param string     $version       The version of WordPress where the message was added.
	 *
	 * @return bool
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function doing_it_wrong_trigger_error( $trigger, string $function_name, string $message, string $version ): bool {

		if ( '_load_textdomain_just_in_time' === $function_name && false !== strpos( $message, '<code>cyr2lat</code>' ) ) {
			return false;
		}

		return (bool) $trigger;
	}

	/**
	 * Init other classes.
	 *
	 * @return void
	 */
	public function init_classes(): void {
		$this->request  = new Request();
		$this->settings = new Settings(
			[
				'Cyr To Lat' => [
					SettingsTables::class,
					SettingsConverter::class,
					SettingsSystemInfo::class,
				],
			]
		);

		$this->admin_notices = new AdminNotices();
		$requirements        = new Requirements( $this->settings, $this->admin_notices );

		if ( ! $requirements->are_requirements_met() ) {
			return;
		}

		$this->process_all_posts = new PostConversionProcess( $this );
		$this->process_all_terms = new TermConversionProcess( $this );
		$this->converter         = new Converter(
			$this,
			$this->settings,
			$this->process_all_posts,
			$this->process_all_terms,
			$this->admin_notices
		);

		$this->acf         = new ACF( $this->settings );
		$this->is_frontend = $this->request->is_frontend();
	}

	/**
	 * Init in CLI mode.
	 *
	 * @return void
	 */
	protected function init_cli(): void {
		if ( ! $this->request->is_cli() ) {
			return;
		}

		$this->cli = new WPCli( $this->converter );

		try {
			/**
			 * Method WP_CLI::add_command() accepts class as callable.
			 *
			 * @noinspection PhpParamsInspection
			 */
			WP_CLI::add_command( 'cyr2lat', $this->cli );
		} catch ( Exception $ex ) {
			return;
		}
	}

	/**
	 * Init hooks.
	 */
	protected function init_hooks(): void {
		if ( $this->is_frontend ) {
			add_action( 'woocommerce_before_template_part', [ $this, 'woocommerce_before_template_part_filter' ] );
			add_action( 'woocommerce_after_template_part', [ $this, 'woocommerce_after_template_part_filter' ] );
		}

		if ( ! $this->request->is_allowed() ) {
			return;
		}

		add_filter( 'sanitize_title', [ $this, 'sanitize_title' ], 9, 3 );
		add_filter( 'sanitize_file_name', [ $this, 'sanitize_filename' ], 10, 2 );
		add_filter( 'wp_insert_post_data', [ $this, 'sanitize_post_name' ], 10, 2 );
		add_filter( 'pre_insert_term', [ $this, 'pre_insert_term_filter' ], PHP_INT_MAX, 2 );
		add_filter( 'post_updated', [ $this, 'check_for_changed_slugs' ], 10, 3 );

		if ( ! $this->is_frontend || class_exists( SitePress::class ) ) {
			add_filter( 'get_terms_args', [ $this, 'get_terms_args_filter' ], PHP_INT_MAX, 2 );
		}

		add_action( 'before_woocommerce_init', [ $this, 'declare_wc_compatibility' ] );
	}

	/**
	 * Get Settings instance.
	 *
	 * @return Settings
	 */
	public function settings(): Settings {
		return $this->settings;
	}

	/**
	 * Sanitize title.
	 *
	 * @param string|mixed $title     Sanitized title.
	 * @param string|mixed $raw_title The title prior to sanitization.
	 * @param string|mixed $context   The context for which the title is being sanitized.
	 *
	 * @return string|mixed
	 * @noinspection PhpUnusedParameterInspection
	 * @noinspection PhpMissingReturnTypeInspection
	 * @noinspection ReturnTypeCanBeDeclaredInspection
	 */
	public function sanitize_title( $title, $raw_title = '', $context = '' ) {
		global $wpdb;

		if (
			! $title ||
			// Fixed bug with `_wp_old_slug` redirect.
			'query' === $context ||
			// Transliterate on pre_term_slug with Polylang and WPML only.
			(
				doing_filter( 'pre_term_slug' ) &&
				! ( class_exists( 'Polylang' ) || class_exists( 'SitePress' ) )
			)
		) {
			return $title;
		}

		$title = urldecode( (string) $title );
		$pre   = apply_filters( 'ctl_pre_sanitize_title', false, $title );

		if ( false !== $pre ) {
			return $pre;
		}

		if ( $this->is_term ) {
			// Make sure we search in the db only once being called from wp_insert_term().
			$this->is_term = false;

			// Fix a case when showing previously created categories in cyrillic with WPML.
			if ( $this->is_frontend && class_exists( SitePress::class ) ) {
				return $title;
			}

			$sql = $wpdb->prepare(
				"SELECT slug FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt
							ON t.term_id = tt.term_id
							WHERE t.slug = %s",
				rawurlencode( $title )
			);

			if ( $this->taxonomies ) {
				$sql .= ' AND tt.taxonomy IN (' . $this->prepare_in( $this->taxonomies ) . ')';
			}

			// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery
			$term = $wpdb->get_var( $sql );
			// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared

			if ( ! empty( $term ) ) {
				return $term;
			}
		}

		return $this->is_wc_attribute( $title ) ? $title : $this->transliterate( $title );
	}

	/**
	 * WC before template part filter.
	 * Add sanitize_title filter to support transliteration of WC attributes on frontend.
	 *
	 * @return void
	 */
	public function woocommerce_before_template_part_filter(): void {
		add_filter( 'sanitize_title', [ $this, 'sanitize_title' ], 9, 3 );
	}

	/**
	 * WC after template part filter.
	 * Remove sanitize_title filter after supporting transliteration of WC attributes on frontend.
	 *
	 * @return void
	 */
	public function woocommerce_after_template_part_filter(): void {
		remove_filter( 'sanitize_title', [ $this, 'sanitize_title' ], 9 );
	}

	/**
	 * Check if title is an attribute taxonomy.
	 *
	 * @param string $title Title.
	 *
	 * @return bool
	 * @noinspection PhpUndefinedFunctionInspection
	 */
	protected function is_wc_attribute_taxonomy( string $title ): bool {
		$title = preg_replace( '/^pa_/', '', $title );

		foreach ( wc_get_attribute_taxonomies() as $attribute_taxonomy ) {
			if ( $title === $attribute_taxonomy->attribute_name ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Check if title is a product not converted attribute.
	 *
	 * @param string $title Title.
	 *
	 * @return bool
	 * @noinspection PhpUndefinedFunctionInspection
	 */
	protected function is_wc_product_not_converted_attribute( string $title ): bool {

		global $product;

		if ( ! is_a( $product, 'WC_Product' ) ) {
			return false;
		}

		// We have to get attributes from postmeta here to see the converted slug.
		$attributes = (array) get_post_meta( $product->get_id(), '_product_attributes', true );

		foreach ( $attributes as $slug => $attribute ) {
			$name = $attribute['name'] ?? '';

			if ( $name === $title && sanitize_title_with_dashes( $title ) === $slug ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Check if title is an attribute.
	 *
	 * @param string $title Title.
	 *
	 * @return bool
	 * @noinspection PhpUndefinedFunctionInspection
	 */
	protected function is_wc_attribute( string $title ): bool {
		if ( ! function_exists( 'WC' ) ) {
			return false;
		}

		return $this->is_wc_attribute_taxonomy( $title ) || $this->is_wc_product_not_converted_attribute( $title );
	}

	/**
	 * Sanitize filename.
	 *
	 * @param string|mixed $filename     Sanitized filename.
	 * @param string|mixed $filename_raw The filename prior to sanitization.
	 *
	 * @return string
	 * @noinspection PhpUnusedParameterInspection
	 * @noinspection PhpMissingReturnTypeInspection
	 * @noinspection ReturnTypeCanBeDeclaredInspection
	 */
	public function sanitize_filename( $filename, $filename_raw ) {
		$pre = apply_filters( 'ctl_pre_sanitize_filename', false, $filename );

		if ( false !== $pre ) {
			return $pre;
		}

		$filename = (string) $filename;

		if ( seems_utf8( $filename ) ) {
			$filename = (string) Mbstring::mb_strtolower( $filename );
		}

		return $this->transliterate( $filename );
	}

	/**
	 * Get min suffix.
	 *
	 * @return string
	 */
	public function min_suffix(): string {
		return defined( 'SCRIPT_DEBUG' ) && constant( 'SCRIPT_DEBUG' ) ? '' : '.min';
	}

	/**
	 * Fix string encoding on macOS.
	 *
	 * @param string $str   String.
	 * @param array  $table Conversion table.
	 *
	 * @return string
	 */
	private function fix_mac_string( string $str, array $table ): string {
		$fix_table = ConversionTables::get_fix_table_for_mac();

		$fix = [];
		foreach ( $fix_table as $key => $value ) {
			if ( isset( $table[ $key ] ) ) {
				$fix[ $value ] = $table[ $key ];
			}
		}

		return strtr( $str, $fix );
	}

	/**
	 * Split Chinese string by hyphens.
	 *
	 * @param string $str   String.
	 * @param array  $table Conversion table.
	 *
	 * @return string
	 */
	protected function split_chinese_string( string $str, array $table ): string {
		if ( ! $this->settings->is_chinese_locale() || mb_strlen( $str ) < 4 ) {
			return $str;
		}

		$chars = Mbstring::mb_str_split( $str );
		$str   = '';

		foreach ( $chars as $char ) {
			if ( isset( $table[ $char ] ) ) {
				$str .= '-' . $char . '-';
			} else {
				$str .= $char;
			}
		}

		return $str;
	}

	/**
	 * Transliterate string using a table.
	 *
	 * @param string $str String.
	 *
	 * @return string
	 */
	public function transliterate( string $str ): string {
		$table = (array) apply_filters( 'ctl_table', $this->settings->get_table() );

		$str = $this->fix_mac_string( $str, $table );
		$str = $this->split_chinese_string( $str, $table );

		return strtr( $str, $table );
	}

	/**
	 * Check if the Block Editor is active.
	 * Must only be used after plugins_loaded action is fired.
	 *
	 * @return bool
	 * @noinspection PhpUndefinedFunctionInspection
	 */
	private function is_gutenberg_editor_active(): bool {
		// Gutenberg plugin is installed and activated.
		// This filter was removed in WP 5.5.
		if ( has_filter( 'replace_editor', 'gutenberg_init' ) ) {
			return true;
		}

		// @codeCoverageIgnoreStart
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		// @codeCoverageIgnoreEnd

		if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
			return in_array( get_option( 'classic-editor-replace' ), [ 'no-replace', 'block' ], true );
		}

		if ( is_plugin_active( 'disable-gutenberg/disable-gutenberg.php' ) ) {
			return ! disable_gutenberg();
		}

		return true;
	}

	/**
	 * Gutenberg support
	 *
	 * @param array|mixed $data    An array of slashed post data.
	 * @param array|mixed $postarr An array of sanitized, but otherwise unmodified post data.
	 *
	 * @return array|mixed
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function sanitize_post_name( $data, $postarr = [] ) {
		global $current_screen;

		if ( ! $this->is_gutenberg_editor_active() ) {
			return $data;
		}

		// Run code only on post edit screen.
		if ( ! ( $current_screen && 'post' === $current_screen->base ) ) {
			return $data;
		}

		if (
			! $data['post_name'] && $data['post_title'] &&
			! in_array( $data['post_status'], [ 'auto-draft', 'revision' ], true )
		) {
			$data['post_name'] = sanitize_title( $data['post_title'] );
		}

		return $data;
	}

	/**
	 * Filters a term before it is sanitized and inserted into the database.
	 *
	 * @param string|int|WP_Error $term     The term name to add, or a WP_Error object if there's an error.
	 * @param string              $taxonomy Taxonomy slug.
	 *
	 * @return string|int|WP_Error
	 */
	public function pre_insert_term_filter( $term, string $taxonomy ) {
		if (
			0 === $term ||
			is_wp_error( $term ) ||
			'' === trim( $term )
		) {
			return $term;
		}

		$this->is_term    = true;
		$this->taxonomies = [ $taxonomy ];

		return $term;
	}

	/**
	 * Filters the terms query arguments.
	 *
	 * @param array|mixed $args       An array of get_terms() arguments.
	 * @param string[]    $taxonomies An array of taxonomy names.
	 *
	 * @return array|mixed
	 */
	public function get_terms_args_filter( $args, array $taxonomies ) {
		$this->is_term    = true;
		$this->taxonomies = $taxonomies;

		return $args;
	}

	/**
	 * Locale filter for Polylang.
	 *
	 * @param string|mixed $locale Locale.
	 *
	 * @return string|mixed
	 */
	public function pll_locale_filter( $locale ) {
		if ( $this->pll_locale ) {
			return $this->pll_locale;
		}

		$rest_locale = $this->pll_locale_filter_with_rest();

		if ( false === $rest_locale ) {
			return $locale;
		}

		if ( $rest_locale ) {
			$this->pll_locale = $rest_locale;

			return $this->pll_locale;
		}

		if ( ! is_admin() ) {
			return $locale;
		}

		if ( ! $this->request->is_post() ) {
			return $locale;
		}

		$pll_get_post_language = $this->pll_locale_filter_with_classic_editor();
		if ( $pll_get_post_language ) {
			$this->pll_locale = $pll_get_post_language;

			return $this->pll_locale;
		}

		$pll_get_term_language = $this->pll_locale_filter_with_term();
		if ( $pll_get_term_language ) {
			$this->pll_locale = $pll_get_term_language;

			return $this->pll_locale;
		}

		return $locale;
	}

	/**
	 * Locale filter for Polylang with REST request.
	 *
	 * @return false|null|string
	 */
	private function pll_locale_filter_with_rest() {
		if ( ! defined( 'REST_REQUEST' ) || ! constant( 'REST_REQUEST' ) ) {
			return null;
		}

		/**
		 * REST Server.
		 *
		 * @var WP_REST_Server $rest_server
		 */
		$rest_server = rest_get_server();
		$data        = json_decode( $rest_server::get_raw_data(), false );

		return $data->lang ?? false;
	}

	/**
	 * Locale filter for Polylang with classic editor.
	 *
	 * @return bool|string
	 * @noinspection PhpUndefinedFunctionInspection
	 */
	private function pll_locale_filter_with_classic_editor() {
		if ( ! function_exists( 'pll_get_post_language' ) ) {
			return false;
		}

		$pll_get_post_language = false;

		// phpcs:disable WordPress.Security.NonceVerification.Missing
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		if ( isset( $_POST['post_ID'] ) ) {
			$pll_get_post_language = pll_get_post_language(
				(int) filter_input( INPUT_POST, 'post_ID', FILTER_SANITIZE_FULL_SPECIAL_CHARS ),
				'locale'
			);
		}
		if ( isset( $_POST['pll_post_id'] ) ) {
			$pll_get_post_language = pll_get_post_language(
				(int) filter_input( INPUT_POST, 'pll_post_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS ),
				'locale'
			);
		}
		if ( isset( $_GET['post'] ) ) {
			$pll_get_post_language = pll_get_post_language(
				(int) filter_input( INPUT_GET, 'post', FILTER_SANITIZE_FULL_SPECIAL_CHARS ),
				'locale'
			);
		}
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
		// phpcs:enable WordPress.Security.NonceVerification.Missing

		return $pll_get_post_language;
	}

	/**
	 * Locale filter for Polylang with term.
	 *
	 * @return false|string
	 * @noinspection PhpUndefinedFunctionInspection
	 */
	private function pll_locale_filter_with_term() {
		if ( ! function_exists( 'PLL' ) ) {
			return false;
		}

		$pll_get_term_language = false;

		// phpcs:disable WordPress.Security.NonceVerification.Missing
		if ( isset( $_POST['term_lang_choice'] ) ) {
			$pll_get_language = PLL()->model->get_language(
				filter_input( INPUT_POST, 'term_lang_choice', FILTER_SANITIZE_FULL_SPECIAL_CHARS )
			);

			if ( $pll_get_language ) {
				$pll_get_term_language = $pll_get_language->locale;
			}
		}

		// phpcs:enable WordPress.Security.NonceVerification.Missing

		return $pll_get_term_language;
	}

	/**
	 * Locale filter for WPML.
	 *
	 * @param string|mixed $locale Locale.
	 *
	 * @return string|null|mixed
	 */
	public function wpml_locale_filter( $locale ) {
		if ( $this->wpml_locale ) {
			return $this->wpml_locale;
		}

		return $locale;
	}

	/**
	 * Get wpml locale.
	 *
	 * @return string|null
	 * @noinspection PhpUndefinedFunctionInspection
	 */
	protected function get_wpml_locale(): ?string {
		$language_code        = wpml_get_current_language();
		$this->wpml_languages = (array) apply_filters( 'wpml_active_languages', [] );

		return (
		isset( $this->wpml_languages[ $language_code ] ) ?
			$this->wpml_languages[ $language_code ]['default_locale'] :
			null
		);
	}

	/**
	 * Save switched locale.
	 *
	 * @param null|string $language_code     Language code to switch into.
	 * @param bool|string $cookie_lang       Optionally also switch the cookie language to the value given.
	 * @param string      $original_language Original language.
	 *
	 * @return void
	 * @noinspection PhpUnusedParameterInspection
	 * @noinspection PhpMissingParamTypeInspection
	 */
	public function wpml_language_has_switched( $language_code, $cookie_lang, string $original_language ): void {
		$language_code = (string) $language_code;

		$this->wpml_locale =
			isset( $this->wpml_languages[ $language_code ] ) ?
				$this->wpml_languages[ $language_code ]['default_locale'] :
				null;
	}

	/**
	 * Checks for changed slugs for published post objects to save the old slug.
	 *
	 * @param int     $post_id     Post ID.
	 * @param WP_Post $post        The post object.
	 * @param WP_Post $post_before The previous post object.
	 *
	 * @noinspection PhpMissingParamTypeInspection
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function check_for_changed_slugs( $post_id, $post, $post_before ): void {
		// Don't bother if it hasn't changed.
		if ( $post->post_name === $post_before->post_name ) {
			return;
		}

		// We're only concerned with published, non-hierarchical objects.
		if ( ! ( 'publish' === $post->post_status || ( 'attachment' === get_post_type( $post ) && 'inherit' === $post->post_status ) ) || is_post_type_hierarchical( $post->post_type ) ) {
			return;
		}

		// Modify $post_before->post_name when cyr2lat converted the title.
		if (
			empty( $post_before->post_name ) &&
			$post->post_title !== $post->post_name &&
			$post->post_name === $this->transliterate( $post->post_title )
		) {
			$post_before->post_name = rawurlencode( $post->post_title );
		}
	}

	/**
	 * Declare compatibility with custom order tables for WooCommerce.
	 *
	 * @return void
	 */
	public function declare_wc_compatibility(): void {
		if ( class_exists( FeaturesUtil::class ) ) {
			FeaturesUtil::declare_compatibility(
				'custom_order_tables',
				constant( 'CYR_TO_LAT_FILE' )
			);
		}
	}

	/**
	 * Changes array of items into string of items, separated by comma and sql-escaped
	 *
	 * @see https://coderwall.com/p/zepnaw
	 * @global wpdb       $wpdb
	 *
	 * @param mixed|array $items  item(s) to be joined into string.
	 * @param string      $format %s or %d.
	 *
	 * @return string Items separated by comma and sql-escaped
	 */
	public function prepare_in( $items, string $format = '%s' ): string {
		global $wpdb;

		$prepared_in = '';
		$items       = (array) $items;
		$how_many    = count( $items );

		if ( $how_many > 0 ) {
			$placeholders    = array_fill( 0, $how_many, $format );
			$prepared_format = implode( ',', $placeholders );
			// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
			$prepared_in = $wpdb->prepare( $prepared_format, $items );
		}

		return $prepared_in;
	}
}
