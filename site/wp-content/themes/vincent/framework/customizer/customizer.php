<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Vincent_Customizer' ) ) {
	class Vincent_Customizer {
		private $panels             = array();
		public $sections            = array();
		private $settings           = array();
		private $enable_postMessage = true;

		public function __construct() {
			// Create an array of registered theme customizer panels
			$this->panels = array(
				'general' => array(
					'title' => esc_html__( 'General Options', 'vincent' ),
				),
				'topbar' => array(
					'title' => esc_html__( 'Top Bar', 'vincent' ),
				),
				'header' => array(
					'title' => esc_html__( 'Header', 'vincent' ),
				),
				'featuredtitle' => array(
					'title' => esc_html__( 'Featured Title', 'vincent' ),
				),
				'maincontent' => array(
					'title' => esc_html__( 'Main Content', 'vincent' ),
				),
				'layout' => array(
					'title' => esc_html__( 'Layout', 'vincent' ),
				),
				'blog' => array(
					'title' => esc_html__( 'Blog', 'vincent' ),
				),
				'blogsingle' => array(
					'title' => esc_html__( 'Blog Single Post', 'vincent' ),
				),
				'sidebarwidget' => array(
					'title' => esc_html__( 'Sidebar Widget', 'vincent' ),
				),
				'projects' => array(
					'title' => esc_html__( 'Project Related', 'vincent' ),
				),
				'shop' => array(
					'title' => esc_html__( 'Shop', 'vincent' ),
				),
				'footer' => array(
					'title' => esc_html__( 'Footer', 'vincent' ),
				),
				'footerwidget' => array(
					'title' => esc_html__( 'Footer Widget', 'vincent' ),
				),
				'bottombar' => array(
					'title' => esc_html__( 'Bottom Bar', 'vincent' ),
				),
			);

			// Everything else is only needed on front end of if in the customizer
			if ( ! is_admin() || is_customize_preview() ) {
				// Add sections (stores all sections in array if not already saved in DB)
				if ( ! $this->sections ) { $this->add_sections(); }

				// Custom core panels and sections
				add_action( 'customize_register', array( $this, 'custom_core_sections' ), 11 );

				// Add theme customizer sections and panels
				add_action( 'customize_register', array( $this, 'add_customizer_panels_sections' ), 40 );

				// Adds CSS for customizer custom controls
				add_action( 'customize_controls_print_styles', array( $this, 'customize_controls_print_styles' ) );

				// Load JS file for customizer
				add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );

				// CSS output
				if ( is_customize_preview() && $this->enable_postMessage ) {
					add_action( 'wp_head', array( $this, 'live_preview_styles' ), 999 );
				} else {
					add_action( 'vincent_custom_colors_css', array( $this, 'head_css' ), 999 );
				}
			}
		}

		/**
		 * Custom core panels and sections
		 *
		 * @since 3.6.8
		 */
		public static function custom_core_sections( $wp_customize ) {

			require_once( get_template_directory() .'/framework/customizer/customizer-controls.php' );
			require_once( get_template_directory() .'/framework/customizer/customizer-helpers.php' );

			// Tweak default controls
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

			// Remove core sections
			$wp_customize->remove_section( 'themes' );
			$wp_customize->remove_section( 'background_image' );

			// Remove core controls tagline
			$wp_customize->remove_control( 'blogdescription' );

			$wp_customize->remove_control( 'header_textcolor' );
			$wp_customize->remove_control( 'background_color' );
			$wp_customize->remove_control( 'background_image' );

			// Remove default settings
			$wp_customize->remove_control( 'site_icon' );
			$wp_customize->remove_setting( 'background_color' );
			$wp_customize->remove_setting( 'background_image' );
		}

		/**
		 * Get all sections
		 *
		 * @since 3.6.8
		 */
		public function add_sections() {

			// Get panels
			$panels = $this->panels;

			// Return if there aren't any panels
			if ( ! $panels ) {
				return;
			}

			// Loop through panels
			foreach( $panels as $id => $val ) {

				// These have their own sections outside the main class scope
				if ( 'typography' == $id ) {
					continue;
				}

				// Continue if condition isn't met
				if ( isset( $val['condition'] ) && ! $val['condition'] ) {
					continue;
				}

				// Section file location
				$file = isset( $val['settings'] ) ? $val['settings'] : get_template_directory() .'/framework/customizer/settings/'. $id .'.php';

				// Include file and update sections var
				if ( file_exists( $file ) ) {
					require_once( $file );
				}
			}

			// Apply filters
			$this->sections = apply_filters( 'vincent_customizer_sections', $this->sections );

		}
 
		/**
		 * Registers new controls
		 * Removes default customizer sections and settings
		 * Adds new customizer sections, settings & controls
		 *
		 * @since 3.6.8
		 */
		public function add_customizer_panels_sections( $wp_customize ) {

			// Get panels
			$all_panels = $this->panels;

			
				// Add Panels
				$priority = 140;
				foreach( $all_panels as $id => $val ) {
					$priority++;


					// Get title and check if panel or section
					$title      = isset( $val['title'] ) ? $val['title'] : $val;
					$is_section = isset( $val['is_section'] ) ? true : false;

					// Add section
					if ( $is_section ) {

						$wp_customize->add_section( 'vincent_'. $id, array(
							'priority' => $priority,
							'title'    => $title,
						) );

					}

					// Add Panel
					else {

						$wp_customize->add_panel( 'vincent_'. $id, array(
							'priority' => $priority,
							'title'    => $title,
						) );

					}

				}

				// Create the new customizer sections
				if ( ! empty( $this->sections ) ) {
					$this->create_sections( $wp_customize, $this->sections );
				}


		} // END customize_register()

		/**
		 * Creates the Sections and controls for the customizer
		 *
		 * @since 3.6.8
		 */
		public function create_sections( $wp_customize ) {

			// Loop through sections and add create the customizer sections, settings & controls
			foreach ( $this->sections as $section_id => $section ) {

				// Get section settings
				$settings = ! empty( $section['settings'] ) ? $section['settings'] : null;

				// Return if no settings are found
				if ( ! $settings ) {
					return;
				}

				// Get section description
				$description = isset( $section['desc'] ) ? $section['desc'] : '';

				// Add customizer section
				if ( isset( $section['panel'] ) ) {
					$wp_customize->add_section( $section_id, array(
						'title'       => $section['title'],
						'panel'       => $section['panel'],
						'description' => $description,
					) );
				}

				// Add settings+controls
				foreach ( $settings as $setting ) {

					// Get vals
					$id           = $setting['id']; // Required no need to check
					$transport    = isset( $setting['transport'] ) ? $setting['transport'] : 'refresh';
					$default      = isset( $setting['default'] ) ? $setting['default'] : '';
					$control_type = isset( $setting['control']['type'] ) ? $setting['control']['type'] : 'text';

					// Get sanitize callback
					if ( isset( $setting['sanitize_callback'] ) ) {
						$sanitize_callback = $setting['sanitize_callback'];
					} else {
						$sanitize_callback = false;
					}

					// Add values to control
					$setting['control']['settings'] = $setting['id'];
					$setting['control']['section'] = $section_id;

					// All heading types are postMessage
					if ( 'vincent-heading' == $control_type ) {
						$transport = 'postMessage';
					}

					// Add description
					if ( isset( $setting['control']['desc'] ) ) {
						$setting['control']['description'] = $setting['control']['desc'];
					}

					// Control object
					if ( isset( $setting['control']['object'] ) ) {
						$control_object = $setting['control']['object'];
					} elseif ( 'image' == $control_type ) {
						$control_object = 'WP_Customize_Image_Control';
					} elseif ( 'color' == $control_type ) {
						$control_object = 'WP_Customize_Color_Control';
					} elseif ( 'vincent-heading' == $control_type ) {
						$control_object = 'Vincent_Customizer_Heading_Control';
					} elseif ( 'vincent-sortable' == $control_type ) {
						$control_object = 'Vincent_Customize_Control_Sorter';
					} elseif ( 'vincent_textarea' == $control_type ) {
						$control_object = 'Vincent_Customizer_Textarea_Control';
					} else {
						$control_object = 'WP_Customize_Control';
					}

					// If $id defined add setting and control
					if ( $id ) {

						// Add setting
						$wp_customize->add_setting( $id, array(
							'type'              => 'theme_mod',
							'transport'         => $transport,
							'default'           => $default,
							'sanitize_callback' => $sanitize_callback,
						) );

						// Add control
						$wp_customize->add_control( new $control_object (
							$wp_customize,
							$id, $setting['control'] )
						);

					}
				}
			}

		} // END create_sections()

		/**
		 * Adds CSS for customizer custom controls
		 *
		 * @since 3.6.8
		 */
		public static function customize_controls_print_styles() { ?>
			 <style type="text/css">
				/* Icons */
				#accordion-panel-vincent_general > h3:before,
				#accordion-panel-vincent_typography > h3:before,
				#accordion-panel-vincent_topbar > h3:before,
				#accordion-panel-vincent_header > h3:before,
				#accordion-panel-vincent_featuredtitle > h3:before,
				#accordion-panel-vincent_maincontent > h3:before,
				#accordion-panel-vincent_layout > h3:before,
				#accordion-panel-vincent_blog > h3:before,
				#accordion-panel-vincent_blogsingle > h3:before,
				#accordion-panel-vincent_sidebarwidget > h3:before,
				#accordion-panel-vincent_projects > h3:before,
				#accordion-panel-vincent_shop > h3:before,
				#accordion-panel-vincent_footer > h3:before,
				#accordion-panel-vincent_footerwidget > h3:before,
				#accordion-panel-vincent_bottombar > h3:before { display: inline-block; width: 20px; height: 20px; font-size: 20px; font-style: normal; vertical-align: top; text-align: center;-webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; color: #0085ba; margin-right: 6px; font-family: "dashicons"; content: "\f108"; }

				#accordion-panel-vincent_typography > h3:before { content: "\f215" }
				#accordion-panel-vincent_topbar > h3:before { content: "\f480" }
				#accordion-panel-vincent_header > h3:before { content: "\f175" }
				#accordion-panel-vincent_featuredtitle > h3:before { content: "\f209" }
				#accordion-panel-vincent_maincontent > h3:before { content: "\f134" }
				#accordion-panel-vincent_layout > h3:before { content: "\f535" }
				#accordion-panel-vincent_blog > h3:before { content: "\f109" }
				#accordion-panel-vincent_blogsingle > h3:before { content: "\f109" }
				#accordion-panel-vincent_sidebarwidget > h3:before { content: "\f135" }
				#accordion-panel-vincent_projects > h3:before { content: "\f481" }
				#accordion-panel-vincent_shop > h3:before { content: "\f174" }
				#accordion-panel-vincent_footerwidget > h3:before { content: "\f209" }
				#accordion-panel-vincent_footer > h3:before { content: "\f535" }
				#accordion-panel-vincent_footer > h3:before { content: "\f535" }
				#accordion-panel-vincent_bottombar > h3:before { content: "\f138" }
				
				/* General Tweaks */
				.customize-control-select select { min-width: 100% }

				/* Slider UI */
				li.customize-control.customize-control-vincent_slider_ui input[type=text] { width: 20%; float: left; text-align: center; }
				li.customize-control.customize-control-vincent_slider_ui .ui-slider-horizontal.vincent-slider-ui { float: right; width: 75%; height: 5px; margin-top: 10px; color: #333; position: relative; border-radius: 5px; border: 1px solid #747474; border-bottom-color: #aeaeae; background-color: #cdcdcd; background: -webkit-linear-gradient(#aaaaaa, #cdcdcd); background: -o-linear-gradient(#aaaaaa, #cdcdcd); background: -moz-linear-gradient(#aaaaaa, #cdcdcd); background: linear-gradient(#aaaaaa, #cdcdcd); }
				li.customize-control.customize-control-vincent_slider_ui .ui-slider-horizontal .ui-slider-handle { position: absolute; z-index: 2; width: 17px; height: 17px; cursor: default; top: -7px; margin-left: -10px; border-radius: 50%; border: 1px solid #9e9e9e; -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.07); box-shadow: inset 0 1px 2px rgba(0,0,0,.07); cursor: pointer; background-color: #f5f5f5; background: -webkit-linear-gradient(#f8f8f8, #ededed); background: -o-linear-gradient(#f8f8f8, #ededed); background: -moz-linear-gradient(#f8f8f8, #ededed); background: linear-gradient(#f8f8f8, #ededed); box-shadow: 0 2px 2px rgba(0,0,0,0.24); }

				/* Sortable */
				.vincent-sortable ul { margin-top: 10px }
				.vincent-sortable li.vincent-sortable-li { cursor: move; background: #fff; padding: 0; padding-left: 15px; height: 40px; line-height: 40px; white-space: nowrap; border: 1px solid #dfdfdf; text-overflow: ellipsis; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; color: #222; margin-bottom: 5px; margin-top: 0; overflow: hidden; position: relative; }
				.vincent-sortable li.vincent-sortable-li:hover { border-color: #999; z-index: 10; }

				.vincent-sortable li.vincent-sortable-li .fa { display: block; position: absolute; top: 0; right: 0; width: 42px; height: 40px; line-height: 40px; margin: 0; text-align: center; font-size: 18px; }

				.vincent-sortable li.vincent-sortable-li .fa:after {
					font-family: "dashicons";
					font-size: 20px;
					position: absolute;
					left: 0;
					top: 0;
					content: "\f147";
					color: #0085ba;
					width: 100%;
					text-align: center;
				}

				.vincent-sortable li.vincent-sortable-li .fa:before {
					content: "";
					position: absolute;
					right: 6px;
					top: 6px;
					width: 26px;
					height: 26px;
					background-color: #fff;
					border: 1px solid #dfdfdf;
				}

				.vincent-sortable li.vincent-sortable-li .fa:hover:before { border-color: #0085ba; }

				.vincent-sortable li.vincent-sortable-li .vincent-hide-sortee { cursor: pointer }
				.vincent-sortable ul li:last-child { margin-bottom: 0 }
				.vincent-sortable li.vincent-hide .fa:after { color: #dfdfdf; }
				.vincent-sortable li.vincent-hide { opacity: 0.65; }

				/* Custom Heading */
				.vincent-customizer-heading { color: #23282d; display: block; padding-top: 28px; padding-bottom: 5px; border-bottom: 2px solid #ddd; font-size: 16px; font-weight: 600; }
			 </style>

		<?php }
		
		/**
		 * Loads js file for customizer preview
		 *
		 * @since 3.6.8
		 */
		public function customize_preview_init() {
			if ( $this->enable_postMessage ) {
				wp_enqueue_script( 'vincent-customize-preview',
					get_template_directory_uri() . '/framework/customizer/customize.js',
					array( 'customize-preview' ),
					'1.0.0',
					true
				);
			}
		}

		/**
		 * Generates inline CSS for styling options
		 *
		 * @since 3.6.8
		 */
		public function loop_through_inline_css( $return = 'css' ) {

			// Define vars
			$add_css           = '';
			$elements_to_alter = array();
			$preview_styles    = array();

			// Get customizer settings
			$settings = wp_list_pluck( $this->sections, 'settings' );

			// Return if there aren't any settings
			if ( empty( $settings ) ) {
				return;
			}

			// Loop through settings and find inline_css
			foreach ( $settings as $settings_array ) {

				foreach ( $settings_array as $setting ) {

					// Store setting ID and default value
					$setting_id = $setting['id']; // no need to check cause it's required

					// Get defaults & inline_css
					$inline_css = isset( $setting['inline_css'] ) ? $setting['inline_css'] : null;

					// Check condition
					$condition = isset( $inline_css['obj_condition'] ) ? $inline_css['obj_condition'] : '';

					// Get default and value
					$default    = isset ( $setting['default'] ) ? $setting['default'] : false;
					$theme_mod  = vincent_get_mod( $setting_id, $default );

					// If mod is equal to default and part of the mods let's remove it
					// This is a good place since we are looping through all settings anyway
					if ( apply_filters( 'vincent_remove_default_mods', false ) ) {
						$get_all_mods = vincent_get_mods();
						if ( $theme_mod == $default && $get_all_mods && isset( $get_all_mods[$setting_id] ) ) {
							remove_theme_mod( $setting_id );
						}
					}

					// These are required for outputting custom CSS
					if ( ! $theme_mod || ! $inline_css ) {
						continue;
					}

					// Get inline_css params
					$sanitize    = isset( $inline_css['sanitize'] ) ? $inline_css['sanitize'] : '';
					$target      = isset( $inline_css['target'] ) ? $inline_css['target'] : '';
					$alter       = isset( $inline_css['alter'] ) ? $inline_css['alter'] : '';
					$important   = isset( $inline_css['important'] ) ? '!important' : false;
					$media_query = isset( $inline_css['media_query'] ) ? $inline_css['media_query'] : false;

					// Add to preview_styles array
					if ( 'preview_styles' == $return ) {
						$preview_styles['customizer-'. $setting_id] = '';
					}

					// Target and alter vars are required, if they are empty continue onto the next setting
					if ( ! $target || ! $alter ) {
						continue;
					}

					// Sanitize data
					if ( $sanitize ) {
						$theme_mod = vincent_sanitize_data( $theme_mod, $sanitize );
					} else {
						$theme_mod = $theme_mod;
					}

					// Set to array if not
					$target = is_array( $target ) ? $target : array( $target );

					// Loop through items
					foreach( $target as $element ) {

						// Add to elements list if not already for CSS output only
						if ( 'css' == $return && ! isset( $elements_to_alter[$element] ) ) {
							$elements_to_alter[$element] = array( 'css' => '' );
						}

						// Return CSS or js
						if ( is_array( $alter ) ) {

							// Loop through elements to alter
							foreach( $alter as $alter_val ) {

								// Inline CSS
								if ( 'css' == $return ) {

									// If it has a media query it's its own thing
									if ( $media_query ) {
										$add_css .= '@media only screen and '. $media_query . '{'.$element .'{ '. $alter_val .':'. $theme_mod . $important .'; }}';
									} else {
										$elements_to_alter[$element]['css'] .= $alter_val .':'. $theme_mod . $important .';';
									}
								}

								// Live preview styles
								elseif ( 'preview_styles' == $return ) {

									// If it has a media query it's its own thing
									if ( $media_query ) {
										$preview_styles['customizer-'. $setting_id] .= '@media only screen and '. $media_query . '{'.$element .'{ '. $alter_val .':'. $theme_mod . $important .'; }}';
									}

									// Not media query
									else {
										$preview_styles['customizer-'. $setting_id] .= $element .'{ '. $alter_val .':'. $theme_mod . $important .'; }';
									}
								}
							}
						}

						// Single element to alter
						else {

							// Background image tweak
							if ( 'background-image' == $alter ) {
								$theme_mod = 'url('. esc_url( $theme_mod ) .')';
							}

							// Inline CSS
							if ( 'css' == $return ) {

								// If it has a media query it's its own thing
								if ( $media_query ) {
									$add_css .= '@media only screen and '. $media_query . '{'.$element .'{ '. $alter .':'. $theme_mod . $important .'; }}';
								}

								// Not media query
								else {
									$elements_to_alter[$element]['css'] .= $alter .':'. $theme_mod . $important .';';
								}

							}

							// Live preview styles
							elseif ( 'preview_styles' == $return ) {

								// If it has a media query it's its own thing
								if ( $media_query ) {
									$preview_styles['customizer-'. $setting_id] .= '@media only screen and '. $media_query . '{'.$element .'{ '. $alter .':'. $theme_mod . $important .'; }}';
								}

								// Not media query
								else {
									$preview_styles['customizer-'. $setting_id] .= $element .'{ '. $alter .':'. $theme_mod . $important .'; }';
								}

							}

						}

					}

				} // End settings_array

			} // End settings loop

			// Loop through elements for CSS only
			if ( 'css' == $return && $elements_to_alter ) {
				foreach( $elements_to_alter as $element => $array ) {
					if ( isset( $array['css'] ) ) {
						$add_css .= $element.'{'.$array['css'].'}';
					}
				}
			}

			// Return inline css
			if ( 'css' == $return ) {
				return $add_css;
			}

			// Return preview styles
			if ( 'preview_styles' == $return ) {
				return $preview_styles;
			}

		}

		/**
		 * Returns correct CSS to output to wp_head
		 *
		 * @since 3.6.8
		 */
		public function head_css( $output ) {
			$inline_css = $this->loop_through_inline_css( 'css' );
			if ( $inline_css ) {
				$output .= '/*CUSTOMIZER STYLING*/'. $inline_css;
			}
			return $output;
		}

		/**
		 * Returns correct CSS to output to wp_head
		 *
		 * @since 3.6.8
		 */
		public function live_preview_styles() {
			$live_preview_styles = $this->loop_through_inline_css( 'preview_styles' );
			if ( $live_preview_styles ) {
				foreach ( $live_preview_styles as $key => $val ) {
					if ( ! empty( $val ) ) {
						echo '<style class="'. $key .'"> '. $val .'</style>';
					}
				}
			}
		}

	}
}

// Start up class
new Vincent_Customizer();

