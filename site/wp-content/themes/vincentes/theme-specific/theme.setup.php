<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0.22
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
if ( !function_exists('vincentes_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'vincentes_customizer_theme_setup1', 1 );
	function vincentes_customizer_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		vincentes_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Droid Serif',
				'family' => 'serif',
				'styles' => '400,400i,700,700i'		// Parameter 'style' used only for the Google fonts
				),
            array(
                'name'	 => 'Amatic SC',
                'family' => 'cursive',
                'styles' => '400,700'		// Parameter 'style' used only for the Google fonts
            ),
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		vincentes_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		vincentes_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'vincentes'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'vincentes'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '26px',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.7em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'vincentes'),
				'font-family'		=> 'Amatic SC, cursive',
				'font-size' 		=> '9.8em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.02em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-3.7px',
				'margin-top'		=> '6.5rem',
				'margin-bottom'		=> '3.2rem'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'vincentes'),
				'font-family'		=> 'Amatic SC, cursive',
				'font-size' 		=> '7.2em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.02em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-2.7px',
				'margin-top'		=> '6.9rem',
				'margin-bottom'		=> '2.75rem'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'vincentes'),
				'font-family'		=> 'Amatic SC, cursive',
				'font-size' 		=> '5.2em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.11em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.95px',
				'margin-top'		=> '7.1rem',
				'margin-bottom'		=> '1.55rem'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'vincentes'),
				'font-family'		=> 'Amatic SC, cursive',
				'font-size' 		=> '3.6em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.35px',
				'margin-top'		=> '7.15rem',
				'margin-bottom'		=> '1.3rem'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'vincentes'),
				'font-family'		=> 'Amatic SC, cursive',
				'font-size' 		=> '2.4em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.9px',
				'margin-top'		=> '7.45rem',
				'margin-bottom'		=> '0.9rem'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'vincentes'),
				'font-family'		=> 'Amatic SC, cursive',
				'font-size' 		=> '2em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.74px',
				'margin-top'		=> '7.5rem',
				'margin-bottom'		=> '0.9rem'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'vincentes'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'vincentes'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '2.333em',
				'font-weight'		=> '700',
				'font-style'		=> 'italic',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'vincentes'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.2px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'vincentes'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'vincentes'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'italic',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'vincentes'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'vincentes'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'italic',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'vincentes'),
				'description'		=> esc_html__('Font settings of the main menu items', 'vincentes'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'vincentes'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'vincentes'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		vincentes_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> esc_html__('Main', 'vincentes'),
							'description'	=> esc_html__('Colors of the main content area', 'vincentes')
							),
			'alter'	=> array(
							'title'			=> esc_html__('Alter', 'vincentes'),
							'description'	=> esc_html__('Colors of the alternative blocks (sidebars, etc.)', 'vincentes')
							),
			'extra'	=> array(
							'title'			=> esc_html__('Extra', 'vincentes'),
							'description'	=> esc_html__('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'vincentes')
							),
			'inverse' => array(
							'title'			=> esc_html__('Inverse', 'vincentes'),
							'description'	=> esc_html__('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'vincentes')
							),
			'input'	=> array(
							'title'			=> esc_html__('Input', 'vincentes'),
							'description'	=> esc_html__('Colors of the form fields (text field, textarea, select, etc.)', 'vincentes')
							),
			)
		);
		vincentes_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> esc_html__('Background color', 'vincentes'),
							'description'	=> esc_html__('Background color of this block in the normal state', 'vincentes')
							),
			'bg_hover'	=> array(
							'title'			=> esc_html__('Background hover', 'vincentes'),
							'description'	=> esc_html__('Background color of this block in the hovered state', 'vincentes')
							),
			'bd_color'	=> array(
							'title'			=> esc_html__('Border color', 'vincentes'),
							'description'	=> esc_html__('Border color of this block in the normal state', 'vincentes')
							),
			'bd_hover'	=>  array(
							'title'			=> esc_html__('Border hover', 'vincentes'),
							'description'	=> esc_html__('Border color of this block in the hovered state', 'vincentes')
							),
			'text'		=> array(
							'title'			=> esc_html__('Text', 'vincentes'),
							'description'	=> esc_html__('Color of the plain text inside this block', 'vincentes')
							),
			'text_dark'	=> array(
							'title'			=> esc_html__('Text dark', 'vincentes'),
							'description'	=> esc_html__('Color of the dark text (bold, header, etc.) inside this block', 'vincentes')
							),
			'text_light'=> array(
							'title'			=> esc_html__('Text light', 'vincentes'),
							'description'	=> esc_html__('Color of the light text (post meta, etc.) inside this block', 'vincentes')
							),
			'text_link'	=> array(
							'title'			=> esc_html__('Link', 'vincentes'),
							'description'	=> esc_html__('Color of the links inside this block', 'vincentes')
							),
			'text_hover'=> array(
							'title'			=> esc_html__('Link hover', 'vincentes'),
							'description'	=> esc_html__('Color of the hovered state of links inside this block', 'vincentes')
							),
			'text_link2'=> array(
							'title'			=> esc_html__('Link 2', 'vincentes'),
							'description'	=> esc_html__('Color of the accented texts (areas) inside this block', 'vincentes')
							),
			'text_hover2'=> array(
							'title'			=> esc_html__('Link 2 hover', 'vincentes'),
							'description'	=> esc_html__('Color of the hovered state of accented texts (areas) inside this block', 'vincentes')
							),
			'text_link3'=> array(
							'title'			=> esc_html__('Link 3', 'vincentes'),
							'description'	=> esc_html__('Color of the other accented texts (buttons) inside this block', 'vincentes')
							),
			'text_hover3'=> array(
							'title'			=> esc_html__('Link 3 hover', 'vincentes'),
							'description'	=> esc_html__('Color of the hovered state of other accented texts (buttons) inside this block', 'vincentes')
							)
			)
		);
		vincentes_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'vincentes'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',   //
					'bd_color'			=> '#e3ede8',   //
		
					// Text and links colors
					'text'				=> '#6a6565',   //
					'text_light'		=> '#8a8380',   //
					'text_dark'			=> '#662743',   //
					'text_link'			=> '#62997a',   //
					'text_hover'		=> '#c4875e',   //
					'text_link2'		=> '#f5dfae',   //
					'text_hover2'		=> '#662743',   //
					'text_link3'		=> '#fdf8ee',   //
					'text_hover3'		=> '#eec432',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#f4f8f7',   //
					'alter_bg_hover'	=> '#f6ecdf',   //
					'alter_bd_color'	=> '#e5e5e5',
					'alter_bd_hover'	=> '#dadada',
					'alter_text'		=> '#333333',
					'alter_light'		=> '#b7b7b7',
					'alter_dark'		=> '#5a2b44',   //
					'alter_link'		=> '#fe7259',
					'alter_hover'		=> '#72cfd5',
					'alter_link2'		=> '#80d572',
					'alter_hover2'		=> '#8be77c',
					'alter_link3'		=> '#ddb837',
					'alter_hover3'		=> '#eec432',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#bfbfbf',
					'extra_light'		=> '#afafaf',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#72cfd5',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#ffffff',
					'input_bg_hover'	=> '#ffffff',
					'input_bd_color'	=> '#c1a6b3',
					'input_bd_hover'	=> '#649a7c',
					'input_text'		=> '#bc9eac',
					'input_light'		=> '#bc9eac',
					'input_dark'		=> '#649a7c',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'vincentes'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#0e0d12',
					'bd_color'			=> '#1c1b1f',
		
					// Text and links colors
					'text'				=> '#6a6565',   //
					'text_light'		=> '#5f5f5f',
					'text_dark'			=> '#ffffff',   //
					'text_link'			=> '#62997a',   //
					'text_hover'		=> '#c4875e',   //
					'text_link2'		=> '#f5dfae',   //
					'text_hover2'		=> '#662743',   //
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#1e1d22',
					'alter_bg_hover'	=> '#28272e',
					'alter_bd_color'	=> '#313131',
					'alter_bd_hover'	=> '#3d3d3d',
					'alter_text'		=> '#a6a6a6',
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#ffaa5f',
					'alter_hover'		=> '#fe7259',
					'alter_link2'		=> '#80d572',
					'alter_hover2'		=> '#8be77c',
					'alter_link3'		=> '#ddb837',
					'alter_hover3'		=> '#eec432',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#a6a6a6',
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#ffaa5f',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#2e2d32',
					'input_bg_hover'	=> '#2e2d32',
					'input_bd_color'	=> '#2e2d32',
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('vincentes_customizer_add_theme_colors')) {
	function vincentes_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = vincentes_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = vincentes_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_05']  = vincentes_hex2rgba( $colors['bg_color'], 0.5 );
			$colors['bg_color_07']  = vincentes_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = vincentes_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = vincentes_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = vincentes_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = vincentes_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = vincentes_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = vincentes_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = vincentes_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['text_dark_05']  = vincentes_hex2rgba( $colors['text_dark'], 0.5 );
			$colors['text_dark_07']  = vincentes_hex2rgba( $colors['text_dark'], 0.7 );
            $colors['text_dark_085']  = vincentes_hex2rgba( $colors['text_dark'], 0.85 );
			$colors['text_link_02']  = vincentes_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = vincentes_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = vincentes_hsb2hex(vincentes_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = vincentes_hsb2hex(vincentes_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('vincentes_customizer_add_theme_fonts')) {
	function vincentes_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {

			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !vincentes_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !vincentes_is_inherit($font['font-size'])
														? 'font-size:' . vincentes_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !vincentes_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !vincentes_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !vincentes_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !vincentes_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !vincentes_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !vincentes_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !vincentes_is_inherit($font['margin-top'])
														? 'margin-top:' . vincentes_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !vincentes_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . vincentes_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('vincentes_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'vincentes_customizer_theme_setup' );
	function vincentes_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('vincentes_filter_add_thumb_sizes', array(
			'vincentes-thumb-huge'		=> array(1170, 658, true),
			'vincentes-thumb-big' 		=> array( 1155, 600, true),
			'vincentes-thumb-med' 		=> array( 555, 375, true),
            'vincentes-thumb-posts' 		=> array( 460, 240, true),
                'vincentes-thumb-events' 		=> array( 470, 580, true),
                'vincentes-thumb-dishes' 		=> array( 470, 470, true),
			'vincentes-thumb-tiny' 		=> array(  180,  180, true),
			'vincentes-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'vincentes-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = vincentes_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'vincentes_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('vincentes_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'vincentes_customizer_image_sizes' );
	function vincentes_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('vincentes_filter_add_thumb_sizes', array(
			'vincentes-thumb-huge'		=> esc_html__( 'Fullsize image', 'vincentes' ),
			'vincentes-thumb-big'			=> esc_html__( 'Large image', 'vincentes' ),
			'vincentes-thumb-med'			=> esc_html__( 'Medium image', 'vincentes' ),
			'vincentes-thumb-tiny'		=> esc_html__( 'Small square avatar', 'vincentes' ),
			'vincentes-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'vincentes' ),
			'vincentes-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'vincentes' ),
			)
		);
		$mult = vincentes_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'vincentes' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'vincentes_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'vincentes_customizer_trx_addons_add_thumb_sizes');
	function vincentes_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'vincentes_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'vincentes_customizer_trx_addons_get_thumb_size');
	function vincentes_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
                'trx_addons-thumb-posts',
                'trx_addons-thumb-posts-@retina',
                'trx_addons-thumb-events',
                'trx_addons-thumb-events-@retina',
                'trx_addons-thumb-dishes',
                'trx_addons-thumb-dishes-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'vincentes-thumb-huge',
							'vincentes-thumb-huge-@retina',
							'vincentes-thumb-big',
							'vincentes-thumb-big-@retina',
							'vincentes-thumb-med',
							'vincentes-thumb-med-@retina',
                                'vincentes-thumb-posts',
                                'vincentes-thumb-posts-@retina',
                                'vincentes-thumb-events',
                                'vincentes-thumb-events-@retina',
                                'vincentes-thumb-dishes',
                                'vincentes-thumb-dishes-@retina',
							'vincentes-thumb-tiny',
							'vincentes-thumb-tiny-@retina',
							'vincentes-thumb-masonry-big',
							'vincentes-thumb-masonry-big-@retina',
							'vincentes-thumb-masonry',
							'vincentes-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}
?>