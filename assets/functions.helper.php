<?php

/**
 * Helper functions, they help you!
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

/**
 * Adds the slider to the home page
 * @return void
 */
if(!function_exists("skeleton_slider")) {
	function skeleton_slider() {
		global $data;
		if(is_array($data['pingu_slider']) && !empty($data["pingu_slider"][1]["url"])) {
			$slides  = $data['pingu_slider'];
			foreach($slides as $slide) {
				$slider  .= "<li>";
				if(!empty($slide["link"])) {
					$slider .= '<a href="'.$slide["link"].'">';
				}

				$slider .= '<img src="' . $slide['url'] . '">';

				if($slide["link"]) {
					$slider .= "</a>";
				}

				if(!empty($slide["description"])) {
					$slider .= '<p class="flex-caption">' . $slide["description"] . '</p>';
				}

				$slider  .= "</li>";
			}

			echo $slider;
		}

		// return false;
	}
}

/**
 * Prints the logo to the page
 * @return void
 */
if(!function_exists("skeleton_logo")) {
	function skeleton_logo() {
		global $data;
		echo '<a href="' . get_bloginfo("url") . '"><img src="' . $data["logo"] . '" alt="' . get_bloginfo('name') . '"></a>';
	}
}

/**
 * Determined whether or not the logo "exists" or not. This merely checks to see
 * if the user has set the logo inside of the theme options panel that is supplied
 * with this theme only. This does NOT check to see if the logo exists using the native
 * WordPress theme editor.
 *
 * @todo allow for users to use native WordPress theme editor
 * @return bool
 */
if(!function_exists("logo_exists")) {
	function logo_exists() {
		if(empty($data["logo"])) {
			return TRUE;
		}

		return FALSE;
	}
}

/**
 * Truncates text up to $max characters and rounds off to the nearest word.
 * This function also append any desired HTML or plain text to the end of the
 * truncated body of text as set in the $append parameter.
 *
 * @param string $text
 * @param int $max | [ $max = 280 ] optional
 * @param string $append | [ $append = '&hellip;' ] optional
 * @return string
 */
if(!function_exists("skeleton_truncate")) {
	function skeleton_truncate($text, $max = 280, $append = '&hellip;') {
		$text = strip_tags($text, "<em><b><i><u><strong><addr><ul><li><ol><dl><dd><dt><code><pre><kbd><span><h1><h2><h3><h4><h5><h6><a>");
		if(strlen($text) <= $max) {
			return $text;
		}
		$out = substr($text, 0, $max);
		if(strpos($text, ' ') === FALSE) {
			return $out . $append;
		}
		return preg_replace('/\w+$/', '', $out) . $append;
	}
}
