<?php
/**
 * Sanitize Data
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vincent_Sanitize_Data' ) ) {
	class Vincent_Sanitize_Data {

		// Parses data
		public function parse_data( $data, $type ) {
			$type = str_replace( '-', '_', $type );
			if ( method_exists( $this, $type ) ) {
				return $this->$type( $data );
			} else {
				return $data;
			}
		}

		// Boolean
		private function boolean( $data ) {
			if ( ! $data ) {
				return false;
			}
			if ( 'true' == $data || 'yes' == $data ) {
				return true;
			}
			if ( 'false' == $data || 'no' == $data ) {
				return false;
			}
		}

		// Pixels
		private function px( $data ) {
			if ( 'none' == $data ) {
				return '0';
			} else {
				return floatval( $data ) . 'px';
			}
		}

		// Font Size
		private function font_size( $data ) {
			if ( strpos( $data, 'px' ) || strpos( $data, 'em' ) ) {
				$data = esc_html( $data );
			} else {
				$data = intval( $data ) .'px';
			}
			if ( $data != '0px' && $data != '0em' ) {
				return esc_html( $data );
			}
		}

		// Font Weight
		private function font_weight( $data ) {
			if ( 'normal' == $data ) {
				return '400';
			} elseif ( 'semibold' == $data ) {
				return '600';
			} elseif ( 'bold' == $data ) {
				return '700';
			} elseif ( 'bolder' == $data ) {
				return '900';
			} else {
				return esc_html( $data );
			}
		}

		// Hex Color
		private function hex_color( $data ) {
			if ( ! $data ) {
				return null;
			} elseif ( 'none' == $data ) {
				return 'transparent';
			} elseif ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $data ) ) {
				return $data;
			} else {
				return null;
			}
		}

		// Border Radius
		private function border_radius( $data ) {
			if ( 'none' == $data ) {
				return '0';
			} elseif ( strpos( $data, 'px' ) ) {
				return $data;
			} elseif ( strpos( $data, '%' ) ) {
				if ( '50%' == $data ) {
					return $data;
				} else {
					return str_replace( '%', 'px', $data );
				}
			} else {
				return intval( $data ) .'px';
			}
		}

		// Pixel or Percent
		private function px_pct( $data ) {
			if ( 'none' == $data || '0px' == $data ) {
				return '0';
			} elseif ( strpos( $data, '%' ) ) {
				return wp_strip_all_tags( $data );
			} elseif ( $data = floatval( $data ) ) {
				return wp_strip_all_tags( $data ) .'px';
			}
		}

		// Opacity
		private function opacity( $data ) {
			if ( ! is_numeric( $data ) || $data > 1 ) {
				return;
			} else {
				return $data;
			}
		}

		// HTML
		private function html( $data ) {
			return wp_specialchars_decode( wp_kses_post( $data ) );
		}

		// Image
		private function img( $data ) {
			return wp_kses( $data, array(
				'img' => array(
					'src'    => array(),
					'alt'    => array(),
					'srcset' => array(),
					'id'     => array(),
					'class'  => array(),
					'height' => array(),
					'width'  => array(),
					'data'   => array(),
				),
			) );
		}

		// Image from setting
		private function image_src_from_mod( $data ) {
			if ( is_numeric( $data ) ) {
				$data = wp_get_attachment_image_src( $data, 'full' );
				$data = $data[0];
			} else {
				$data = esc_url( $data );
			}
			return $data;
		}

	}
}

// Helper function runs the Vincent_Sanitize_Data class
function vincent_sanitize_data( $data = '', $type = '' ) {
	if ( $data && $type ) {
		$class = new Vincent_Sanitize_Data();
		return $class->parse_data( $data, $type );
	}
}