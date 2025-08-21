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
 * Complete search results shortcode
 * Use [search_results] to display all search results with highlighting
 */

function complete_search_results_shortcode($atts = array()) {
    if (!is_search()) {
        return '';
    }
    
    $atts = shortcode_atts(array(
        'posts_per_page' => get_option('posts_per_page', 10),
        'excerpt_length' => 40
    ), $atts);
    
    global $wp_query;
    $query = get_search_query();
    
    if (empty($query)) {
        return '<p>Please enter a search term.</p>';
    }
    
    $output = '';
    
    // Search results header
    $output .= '<div class="search-results-header">';
    $output .= '<h1>Search Results for "' . esc_html($query) . '"</h1>';
    $output .= '<p>Found ' . $wp_query->found_posts . ' results</p>';
    $output .= '</div>';
    
    if (have_posts()) {
        $output .= '<div class="search-results-list">';
        
        while (have_posts()) {
            the_post();
            global $post;
            
            // Get clean content for searching
            $content = strip_tags(strip_shortcodes($post->post_content));
            $content = preg_replace('/\s+/', ' ', trim($content));
            
            // Create smart excerpt
            $excerpt = create_smart_excerpt($content, $query, intval($atts['excerpt_length']));
            
            $output .= '<article class="search-result-item" style="margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #eee;">';
            
            // Title
            $output .= '<h2 style="margin: 0 0 0.5rem 0;"><a href="' . get_permalink() . '" style="text-decoration: none; color: #2563eb;">' . get_the_title() . '</a></h2>';
            
            // Excerpt with highlighting
            $output .= '<div class="search-excerpt" style="margin-bottom: 0.5rem; color: #666; line-height: 1.6;">' . $excerpt . '</div>';
            
            // Meta info
            $output .= '<div class="search-meta" style="font-size: 0.875rem; color: #888;">';
            $output .= '<span>' . get_the_date() . '</span>';
            if (get_post_type() !== 'post') {
                $post_type_obj = get_post_type_object(get_post_type());
                if ($post_type_obj) {
                    $output .= ' • <span>' . $post_type_obj->labels->singular_name . '</span>';
                }
            }
            $output .= ' • <a href="' . get_permalink() . '" style="color: #2563eb;">Read more</a>';
            $output .= '</div>';
            
            $output .= '</article>';
        }
        
        $output .= '</div>';
        
        // Pagination
        $output .= '<div class="search-pagination">';
        $output .= paginate_links(array(
            'total' => $wp_query->max_num_pages,
            'current' => max(1, get_query_var('paged')),
            'prev_text' => '← Previous',
            'next_text' => 'Next →'
        ));
        $output .= '</div>';
        
    } else {
        $output .= '<div class="no-results">';
        $output .= '<h2>No results found</h2>';
        $output .= '<p>Sorry, no posts matched your search criteria. Please try again with different keywords.</p>';
        $output .= '</div>';
    }
    
    return $output;
}
add_shortcode('search_results', 'complete_search_results_shortcode');

/**
 * Create smart excerpt with highlighting around search terms
 */
function create_smart_excerpt($content, $query, $excerpt_length = 40) {
    $search_terms = explode(' ', $query);
    $search_terms = array_filter($search_terms);
    
    // Find the first occurrence of any search term
    $best_position = false;
    $matched_term = '';
    
    foreach ($search_terms as $term) {
        $pos = stripos($content, $term);
        if ($pos !== false) {
            if ($best_position === false || $pos < $best_position) {
                $best_position = $pos;
                $matched_term = $term;
            }
        }
    }
    
    if ($best_position !== false) {
        // Create excerpt around the match
        $words = explode(' ', $content);
        $total_words = count($words);
        
        // Find word position from character position
        $char_count = 0;
        $word_position = 0;
        foreach ($words as $index => $word) {
            $char_count += strlen($word) + 1;
            if ($char_count >= $best_position) {
                $word_position = $index;
                break;
            }
        }
        
        // Get context around the match (20 words before and after)
        $context_words = 20;
        $start = max(0, $word_position - $context_words);
        $end = min($total_words, $word_position + $context_words);
        
        // Limit total length
        if (($end - $start) > $excerpt_length) {
            $end = $start + $excerpt_length;
        }
        
        $excerpt_words = array_slice($words, $start, $end - $start);
        $excerpt = implode(' ', $excerpt_words);
        
        // Add ellipsis
        if ($start > 0) {
            $excerpt = '...' . $excerpt;
        }
        if ($end < $total_words) {
            $excerpt = $excerpt . '...';
        }
    } else {
        // No match found, use beginning
        $excerpt = wp_trim_words($content, $excerpt_length);
    }
    
    // Apply highlighting
    if (function_exists('relevanssi_highlight_terms')) {
        $excerpt = relevanssi_highlight_terms($excerpt, $query, false);
    } else {
        // Manual highlighting fallback
        foreach ($search_terms as $term) {
            $excerpt = preg_replace('/(' . preg_quote($term, '/') . ')/i', '<mark style="background: yellow; padding: 2px;">$1</mark>', $excerpt);
        }
    }
    
    return $excerpt;
}