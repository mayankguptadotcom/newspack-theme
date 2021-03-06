<?php
/**
 * Newspack Scott: Color Patterns
 *
 * @package Newspack Scott
 */
/**
 * Add child theme-specific custom colours.
 */
function newspack_scott_custom_colors_css() {
	$primary_color   = newspack_get_primary_color();
	$secondary_color = newspack_get_secondary_color();

	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		$primary_color   = get_theme_mod( 'primary_color_hex', $primary_color );
		$secondary_color = get_theme_mod( 'secondary_color_hex', $secondary_color );
	}

	$primary_color_contrast   = newspack_get_color_contrast( $primary_color );
	$secondary_color_contrast = newspack_get_color_contrast( $secondary_color );

	$theme_css = '
		.accent-header:not(.widget-title):before,
		.article-section-title:before,
		.cat-links:before,
		.page-title:before {
			background-color: ' . $primary_color . ';
		}

		.wp-block-pullquote blockquote p:first-of-type:before {
			color: ' . $primary_color . ';
		}

		@media only screen and (min-width: 782px) {
			/* Header default background */
			.h-db .featured-image-beside .cat-links:before {
				background-color: ' . $primary_color_contrast . ';
			}
		}
	';

	if ( true === get_theme_mod( 'header_solid_background', false ) ) {
		$theme_css .= '
			/* Header solid background */
			.h-sb .middle-header-contain {
				background-color: ' . $primary_color . ';
			}
			.h-sb .top-header-contain {
				background-color: ' . newspack_adjust_brightness( $primary_color, -10 ) . ';
				border-bottom-color: ' . newspack_adjust_brightness( $primary_color, -15 ) . ';
			}

			/* Header solid background */
			.h-sb .site-header,
			.h-sb .site-title,
			.h-sb .site-title a:link,
			.h-sb .site-title a:visited,
			.h-sb .site-description,
			/* Header solid background; short height */
			.h-sb.h-sh .nav1 .main-menu > li,
			.h-sb.h-sh .nav1 ul.main-menu > li > a,
			.h-sb.h-sh .nav1 ul.main-menu > li > a:hover,
			.h-sb .top-header-contain,
			.h-sb .middle-header-contain,
			.nav1 .sub-menu a {
				color: ' . $primary_color_contrast . ';
			}
		';
	}

	$editor_css = '
		.block-editor-block-list__layout .block-editor-block-list__block .accent-header:not(.widget-title):before,
		.block-editor-block-list__layout .block-editor-block-list__block .article-section-title:before {
			background-color: ' . $primary_color . ';
		}
		.editor-styles-wrapper .wp-block[data-type="core/pullquote"] .wp-block-pullquote:not(.is-style-solid-color) blockquote > .editor-rich-text__editable:first-child:before {
			color: ' . $primary_color . ';
		}
	';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}
	/**
	 * Filters Newspack Theme custom colors CSS.
	 *
	 * @since Newspack Scott 1.0
	 *
	 * @param string $theme_css   Base theme colors CSS.
	 * @param int    $primary_color       The user's selected color hex.
	 */
	return apply_filters( 'newspack_scott_custom_colors_css', $theme_css, $primary_color );
}
