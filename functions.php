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
 * Complete search results that captures headings
 */
function complete_search_results_shortcode($atts = array()) {
    if (!is_search()) {
        return '';
    }
    
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
            
            // Create smart excerpt that captures headings
            $excerpt = create_heading_aware_excerpt($post->post_content, $query);
            
            $output .= '<article class="search-result-item" style="margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #eee;">';
            
            // Title
            $output .= '<h2 style="margin: 0 0 0.5rem 0;"><a href="' . get_permalink() . '" style="text-decoration: none; color: #2563eb;">' . get_the_title() . '</a></h2>';
            
            // Excerpt with heading awareness
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
        
    } else {
        $output .= '<div class="no-results">';
        $output .= '<h2>No results found</h2>';
        $output .= '<p>Sorry, no posts matched your search criteria.</p>';
        $output .= '</div>';
    }
    
    return $output;
}
add_shortcode('search_results', 'complete_search_results_shortcode');

/**
 * Create excerpt that prioritizes headings containing search terms
 */
/**
 * Complete search results that finds exact phrase matches in headings
 */
function complete_search_results_shortcode($atts = array()) {
    if (!is_search()) {
        return '';
    }
    
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
            
            // Create smart excerpt that looks for phrase matches in headings
            $excerpt = create_phrase_aware_excerpt($post->post_content, $query);
            
            $output .= '<article class="search-result-item" style="margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #eee;">';
            
            // Title
            $output .= '<h2 style="margin: 0 0 0.5rem 0;"><a href="' . get_permalink() . '" style="text-decoration: none; color: #2563eb;">' . get_the_title() . '</a></h2>';
            
            // Excerpt (don't escape HTML since we want highlighting to show)
            $output .= '<div class="search-excerpt" style="margin-bottom: 0.5rem; color: #666; line-height: 1.6;">' . $excerpt . '</div>';
            
            // Meta info
            $output .= '<div class="search-meta" style="font-size: 0.875rem; color: #888;">';
            $output .= '<span>' . get_the_date() . '</span>';
            if (get_post_type() !== 'post') {
                $post_type_obj = get_post_type_object(get_post_type());
                if ($post_type_obj) {
                    $output .= ' • <span>' . esc_html($post_type_obj->labels->singular_name) . '</span>';
                }
            }
            $output .= ' • <a href="' . get_permalink() . '" style="color: #2563eb;">Read more</a>';
            $output .= '</div>';
            
            $output .= '</article>';
        }
        
        $output .= '</div>';
        
    } else {
        $output .= '<div class="no-results">';
        $output .= '<h2>No results found</h2>';
        $output .= '<p>Sorry, no posts matched your search criteria.</p>';
        $output .= '</div>';
    }
    
    return $output;
}
add_shortcode('search_results', 'complete_search_results_shortcode');

/**
 * Create excerpt that looks for exact phrase matches in headings first
 */
function create_phrase_aware_excerpt($content, $query) {
    // Apply content filters to get the real content
    $filtered_content = apply_filters('the_content', $content);
    
    // Extract headings with their text
    preg_match_all('/<h[1-6][^>]*>(.*?)<\/h[1-6]>/i', $filtered_content, $headings);
    
    // First, look for the exact phrase in headings
    if (!empty($headings[1])) {
        foreach ($headings[1] as $heading_html) {
            $heading_text = strip_tags($heading_html);
            // Check if this heading contains the exact search phrase
            if (stripos($heading_text, $query) !== false) {
                // Found exact phrase in heading!
                $heading_pattern = '/<h[1-6][^>]*>' . preg_quote($heading_html, '/') . '<\/h[1-6]>/i';
                $split = preg_split($heading_pattern, $filtered_content, 2);
                
                if (count($split) == 2) {
                    $after_heading = strip_tags($split[1]);
                    $after_heading = preg_replace('/\s+/', ' ', trim($after_heading));
                    $context = wp_trim_words($after_heading, 25);
                    
                    // Highlight the heading and context
                    $highlighted_heading = str_ireplace($query, '<mark style="background: yellow; padding: 2px;">' . $query . '</mark>', $heading_text);
                    $highlighted_context = str_ireplace($query, '<mark style="background: yellow; padding: 2px;">' . $query . '</mark>', $context);
                    
                    return '<strong>' . $highlighted_heading . '</strong><br>' . $highlighted_context;
                }
            }
        }
        
        // If no exact phrase match, look for headings containing individual terms
        $search_terms = explode(' ', $query);
        $search_terms = array_filter($search_terms);
        
        foreach ($headings[1] as $heading_html) {
            $heading_text = strip_tags($heading_html);
            $term_count = 0;
            
            // Count how many search terms are in this heading
            foreach ($search_terms as $term) {
                if (stripos($heading_text, $term) !== false) {
                    $term_count++;
                }
            }
            
            // If this heading contains multiple search terms
            if ($term_count >= 2 || ($term_count >= 1 && count($search_terms) == 1)) {
                $heading_pattern = '/<h[1-6][^>]*>' . preg_quote($heading_html, '/') . '<\/h[1-6]>/i';
                $split = preg_split($heading_pattern, $filtered_content, 2);
                
                if (count($split) == 2) {
                    $after_heading = strip_tags($split[1]);
                    $after_heading = preg_replace('/\s+/', ' ', trim($after_heading));
                    $context = wp_trim_words($after_heading, 25);
                    
                    // Apply highlighting to heading and context
                    $highlighted_heading = $heading_text;
                    $highlighted_context = $context;
                    
                    foreach ($search_terms as $term) {
                        $highlighted_heading = str_ireplace($term, '<mark style="background: yellow; padding: 2px;">' . $term . '</mark>', $highlighted_heading);
                        $highlighted_context = str_ireplace($term, '<mark style="background: yellow; padding: 2px;">' . $term . '</mark>', $highlighted_context);
                    }
                    
                    return '<strong>' . $highlighted_heading . '</strong><br>' . $highlighted_context;
                }
            }
        }
    }
    
    // No good heading match, search content for exact phrase first
    $clean_content = strip_tags($filtered_content);
    $clean_content = preg_replace('/\s+/', ' ', trim($clean_content));
    
    $phrase_pos = stripos($clean_content, $query);
    if ($phrase_pos !== false) {
        // Found exact phrase in content
        $start = max(0, $phrase_pos - 100);
        $excerpt_text = substr($clean_content, $start, 300);
        $excerpt_text = wp_trim_words($excerpt_text, 40);
        
        if ($start > 0) {
            $excerpt_text = '...' . $excerpt_text;
        }
        
        // Highlight the exact phrase
        $excerpt_text = str_ireplace($query, '<mark style="background: yellow; padding: 2px;">' . $query . '</mark>', $excerpt_text);
        
        return $excerpt_text;
    }
    
    // Final fallback - individual terms
    $search_terms = explode(' ', $query);
    $best_position = false;
    
    foreach ($search_terms as $term) {
        $pos = stripos($clean_content, $term);
        if ($pos !== false) {
            if ($best_position === false || $pos < $best_position) {
                $best_position = $pos;
            }
        }
    }
    
    if ($best_position !== false) {
        $start = max(0, $best_position - 100);
        $excerpt_text = substr($clean_content, $start, 300);
        $excerpt_text = wp_trim_words($excerpt_text, 40);
        
        if ($start > 0) {
            $excerpt_text = '...' . $excerpt_text;
        }
        
        foreach ($search_terms as $term) {
            $excerpt_text = str_ireplace($term, '<mark style="background: yellow; padding: 2px;">' . $term . '</mark>', $excerpt_text);
        }
        
        return $excerpt_text;
    }
    
    return wp_trim_words($clean_content, 40);
}