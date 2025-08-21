<?php

/**
 * Frankel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Frankel
 * @since Frankel 1.0
 */

/**
 * Register block styles.
 */

if (! function_exists('frankel_block_styles')) :
	/**
	 * Register custom block styles
	 *
	 * @since Frankel 1.0
	 * @return void
	 */
	function frankel_block_styles()
	{

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __('Arrow icon', 'frankel'),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __('Pill', 'frankel'),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __('Checkmark', 'frankel'),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __('With arrow', 'frankel'),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __('With asterisk', 'frankel'),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action('init', 'frankel_block_styles');

/**
 * Enqueue block stylesheets.
 */

if (! function_exists('frankel_block_stylesheets')) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Frankel 1.0
	 * @return void
	 */
	function frankel_block_stylesheets()
	{
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'frankel-button-style-outline',
				'src'    => get_parent_theme_file_uri('assets/css/button-outline.css'),
				'ver'    => wp_get_theme(get_template())->get('Version'),
				'path'   => get_parent_theme_file_path('assets/css/button-outline.css'),
			)
		);
	}
endif;

add_action('init', 'frankel_block_stylesheets');

/**
 * Register pattern categories.
 */

if (! function_exists('frankel_pattern_categories')) :
	/**
	 * Register pattern categories
	 *
	 * @since Frankel 1.0
	 * @return void
	 */
	function frankel_pattern_categories()
	{

		register_block_pattern_category(
			'frankel_page',
			array(
				'label'       => _x('Pages', 'Block pattern category', 'frankel'),
				'description' => __('A collection of full page layouts.', 'frankel'),
			)
		);
	}
endif;

add_action('init', 'frankel_pattern_categories');

function mytheme_remove_color_palette()
{
	// Remove the default Gutenberg color palette
	remove_theme_support('editor-color-palette');
}
add_action('after_setup_theme', 'mytheme_remove_color_palette');

// Load scripts 
add_action('init', 'header_scripts'); // Add Custom Scripts to wp_head
function header_scripts()
{
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		wp_register_script('scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0.0'); // Custom scripts
		wp_enqueue_script('scripts'); // Enqueue it!
	}
}

// Load styles
add_action('wp_enqueue_scripts', 'header_styles'); // Add Child Theme Stylesheet
function header_styles()
{
	wp_register_style('custom', get_stylesheet_directory_uri() . '/assets/css/custom.css', array(), '1.0', 'all');
	wp_enqueue_style('custom'); // Enqueue it!

}


// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

	global $wp_version;
	if ($wp_version !== '4.7.1') {
		return $data;
	}

	$filetype = wp_check_filetype($filename, $mimes);

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4);

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
	echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action('admin_head', 'fix_svg');

// Remove default block patterns
add_action('init', function () {
	remove_theme_support('core-block-patterns');
});

add_filter( 'should_load_remote_block_patterns', '__return_false' );

// Disable Openverse image library
add_filter(
	'block_editor_settings_all',
	function ($settings) {
		$settings['enableOpenverseMediaCategory'] = false;

		return $settings;
	},
	10
);

// Add a category for patterns
if ( function_exists( 'register_block_pattern_category' ) ) {
    register_block_pattern_category(
      'content',
      array(
            'label' => __( 'Content', 'frankel' ),
            'description' => __( 'Content', 'frankel' ),
       )
   );
}

// Login page stylesheet
function login_stylesheet()
{
	wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/assets/css/login.css');
}
add_action('login_enqueue_scripts', 'login_stylesheet');

/**
 * Smart Search Excerpt Generator for Relevanssi
 * Add this to your theme's functions.php file
 */

/**
 * Generate a smart excerpt that shows highlighted search terms
 * 
 * @param int $post_id The post ID (optional, defaults to current post)
 * @param string $query The search query (optional, defaults to current search)
 * @param int $excerpt_length Length of excerpt in words (default: 30)
 * @param int $context_words Words to show around the match (default: 15)
 * @return string The highlighted excerpt
 */
function get_smart_search_excerpt($post_id = null, $query = null, $excerpt_length = 30, $context_words = 15) {
    // Get post ID if not provided
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    // Get search query if not provided
    if (!$query) {
        $query = get_search_query();
    }
    
    // If no search query, return regular excerpt
    if (empty($query)) {
        return get_the_excerpt($post_id);
    }
    
    // Get the full post content
    $post = get_post($post_id);
    if (!$post) {
        return '';
    }
    
    // Get content and strip tags for searching
    $content = $post->post_content;
    $title = $post->post_title;
    
    // Apply content filters to get the actual displayed content
    $content = apply_filters('the_content', $content);
    $content = strip_tags($content);
    
    // Clean up the content
    $content = wp_strip_all_tags($content);
    $content = preg_replace('/\s+/', ' ', $content); // Normalize whitespace
    $content = trim($content);
    
    // Prepare search terms
    $search_terms = explode(' ', $query);
    $search_terms = array_filter($search_terms); // Remove empty terms
    
    // First, check if terms appear in the title
    $title_match = false;
    foreach ($search_terms as $term) {
        if (stripos($title, $term) !== false) {
            $title_match = true;
            break;
        }
    }
    
    // If title matches, use beginning of content
    if ($title_match) {
        $excerpt = wp_trim_words($content, $excerpt_length);
    } else {
        // Find the first occurrence of any search term
        $best_position = false;
        $matched_term = '';
        
        foreach ($search_terms as $term) {
            $position = stripos($content, $term);
            if ($position !== false) {
                if ($best_position === false || $position < $best_position) {
                    $best_position = $position;
                    $matched_term = $term;
                }
            }
        }
        
        if ($best_position !== false) {
            // Create excerpt around the found term
            $excerpt = create_contextual_excerpt($content, $best_position, $context_words, $excerpt_length);
        } else {
            // Fallback to regular excerpt if no matches found
            $excerpt = wp_trim_words($content, $excerpt_length);
        }
    }
    
    // Apply Relevanssi highlighting
    if (function_exists('relevanssi_highlight_terms')) {
        $excerpt = relevanssi_highlight_terms($excerpt, $query, false);
    }
    
    return $excerpt;
}

/**
 * Create an excerpt with context around a specific position
 * 
 * @param string $content The full content
 * @param int $position The position of the match
 * @param int $context_words Words to show around the match
 * @param int $max_words Maximum words in excerpt
 * @return string The contextual excerpt
 */
function create_contextual_excerpt($content, $position, $context_words = 15, $max_words = 30) {
    $words = explode(' ', $content);
    $total_words = count($words);
    
    // Find the word position that contains our character position
    $char_count = 0;
    $word_position = 0;
    
    foreach ($words as $index => $word) {
        $char_count += strlen($word) + 1; // +1 for space
        if ($char_count >= $position) {
            $word_position = $index;
            break;
        }
    }
    
    // Calculate start and end positions
    $start = max(0, $word_position - $context_words);
    $end = min($total_words, $word_position + $context_words);
    
    // Ensure we don't exceed max_words
    if (($end - $start) > $max_words) {
        $end = $start + $max_words;
    }
    
    // Extract the words
    $excerpt_words = array_slice($words, $start, $end - $start);
    $excerpt = implode(' ', $excerpt_words);
    
    // Add ellipsis if we're not at the beginning/end
    if ($start > 0) {
        $excerpt = '...' . $excerpt;
    }
    if ($end < $total_words) {
        $excerpt = $excerpt . '...';
    }
    
    return $excerpt;
}

/**
 * Template function to display the smart excerpt
 * Use this in your search results template
 */
function the_smart_search_excerpt($excerpt_length = 30, $context_words = 15) {
    echo get_smart_search_excerpt(null, null, $excerpt_length, $context_words);
}

/**
 * Shortcode version for block themes
 * Usage: [smart_search_excerpt length="30" context="15"]
 */
function smart_search_excerpt_shortcode($atts) {
    $atts = shortcode_atts(array(
        'length' => 30,
        'context' => 15,
    ), $atts);
    
    return get_smart_search_excerpt(null, null, intval($atts['length']), intval($atts['context']));
}
add_shortcode('smart_search_excerpt', 'smart_search_excerpt_shortcode');

/**
 * Filter to replace the default excerpt with smart excerpt on search pages
 * This automatically enhances all excerpts on search pages
 */
function replace_excerpt_on_search($excerpt, $post) {
    if (is_search() && !empty(get_search_query())) {
        return get_smart_search_excerpt($post->ID);
    }
    return $excerpt;
}
add_filter('get_the_excerpt', 'replace_excerpt_on_search', 10, 2);

/**
 * Block pattern for search results (optional)
 * Registers a block pattern you can use in your search template
 */
function register_smart_search_result_pattern() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'mytheme/smart-search-result',
            array(
                'title'       => __('Smart Search Result with Highlighting', 'textdomain'),
                'description' => _x('A search result item with smart highlighting', 'Block pattern description', 'textdomain'),
                'content'     => '<!-- wp:group {"style":{"spacing":{"padding":"1rem","margin":{"bottom":"1.5rem"}}},"backgroundColor":"white","className":"search-result-item"} -->
<div class="wp-block-group search-result-item has-white-background-color has-background" style="margin-bottom:1.5rem;padding:1rem">
<!-- wp:post-title {"level":3,"isLink":true} /-->
<!-- wp:shortcode -->[smart_search_excerpt length="40" context="20"]<!-- /wp:shortcode -->
<!-- wp:post-date {"format":"M j, Y"} /-->
</div>
<!-- /wp:group -->',
                'categories'  => array('posts'),
            )
        );
    }
}
add_action('init', 'register_smart_search_result_pattern');