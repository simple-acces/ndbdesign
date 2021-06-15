<?php 

function ebor_search_bar_shortcode( $atts, $content = null ) {
	return get_search_form(false);
}
add_shortcode( 'stack_search_bar', 'ebor_search_bar_shortcode' );

if(!( function_exists('ebor_pagination') )){
	function ebor_pagination($pages = '', $range = 2){
		$showitems = ($range * 2)+1;
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}
		
		$output = '';
			
		if(1 != $pages){
			
			$output .= "<a href='".get_pagenum_link(1)."' class='pagination__prev'>«</a><ol>";
			
			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					$output .= ($paged == $i)? "<li class='pagination__current'>".$i."</li> ":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li> ";
				}
			}
		
			$output .= "</ol><a class='pagination__next' href='".get_pagenum_link($pages)."'>»</a>";
			
		}
		
		return $output;
	}
}

if(!( function_exists('ebor_breadcrumb_section') )){
	function ebor_breadcrumb_section( $title = false, $description = false, $image = false ){
		
		if( 'no' == get_option('stack_show_breadcrumb_section', 'yes') ){
			return false;	
		}
		
		$class = ($image) ? 'imagebg' : false;
		$imageHTML = ($image) ? '<div class="background-image-holder"><img src="'. esc_url($image) .'" alt="'. get_the_title() .'" /></div>' : false;
		$hr = ($image) ? false : '<hr>';
		
		if( $description ){
			
			$output = '
				<section class="'. $class.' space--sm unpad--bottom breadcrumb--section">
					'. $imageHTML .'
				    <div class="container">
				        <div class="row">
				            <div class="col-sm-12">
				            	<h1 class="h2">'. wp_kses_post($title) .'</h1>
				            	<span><em>'. wp_kses_post($description) .'</em></span>
				            	'. ebor_breadcrumbs() .'
				                '. $hr .'
				            </div>
				        </div><!--end of row-->
				    </div><!--end of container-->
				</section>
			';
			
		} else {
			
			$output = '
				<section class="'. $class .' space--sm breadcrumb--section">
					'. $imageHTML .'
				    <div class="container">
				        <div class="row">
				            <div class="col-sm-12">
				            	<h1 class="team-title">'. wp_kses_post($title) .'</h1>
				                '. ebor_breadcrumbs() .'
				                '. $hr .'
				            </div>
				        </div><!--end of row-->
				    </div><!--end of container-->
				</section>
			';
		
		}
		
		return $output;
			
	}
}

if(!( function_exists('ebor_get_blog_layouts') )){
	function ebor_get_blog_layouts(){
		$options = array(
			'Simple List'                                       => 'list',
			'Simple List & Sidebar'                             => 'list-sidebar',
			'Grid'                                              => 'cards',
			'Grid & Sidebar'                                    => 'cards-sidebar',
			'Magazine (Use 7 for "Show how many posts" option)' => 'magazine',
			'Magazine With No CTA'                              => 'magazine-simple',
			'Carousel'                                          => 'carousel',
			'Row'                                               => 'row',
			'Row Detailed'                                      => 'row-detailed',
			'Grid Detailed'                                     => 'cards-detailed',
			'Grid Detailed & Sidebar'                           => 'cards-sidebar-detailed',
			'Portfolio Style'                                   => 'portfolio',
		);
		
		if( has_filter('ebor_add_blog_layouts') ) {
			$options = apply_filters('ebor_add_blog_layouts', $options);
		}
		
		return $options;
	}
}

if(!( function_exists('ebor_get_shop_layouts') )){
	function ebor_get_shop_layouts(){
		$options = array(
			'Standard 2 Columns' => 'column-2',
			'Standard 3 Columns' => 'column-3',
			'Standard 4 Columns' => 'column-4',
			'Standard & Sidebar' => 'column-sidebar',
			'Tiles 2 Columns'    => 'column-tiles-2',
			'Tiles 3 Columns'    => 'column-tiles-3',
			'Tiles 4 Columns'    => 'column-tiles-4',
			'Tiles & Sidebar'    => 'column-tiles-sidebar',
			'Carousel'           => 'carousel'
		);
		
		if( has_filter('ebor_add_shop_layouts') ) {
			$options = apply_filters('ebor_add_shop_layouts', $options);
		}
		
		return $options;
	}
}

if(!( function_exists('ebor_get_team_layouts') )){
	function ebor_get_team_layouts(){
		$options = array(
			'3 Columns' => 'grid-3',
			'2 Columns' => 'grid-2',
			'1 Column'  => 'grid-1',
			'Carousel'  => 'carousel'
		);
		
		if( has_filter('ebor_add_team_layouts') ) {
			$options = apply_filters('ebor_add_team_layouts', $options);
		}
		
		return $options;
	}
}

if(!( function_exists('ebor_get_portfolio_layouts') )){
	function ebor_get_portfolio_layouts(){
		$options = array(
			'Portfolio Carousel 1'                          => 'carousel-1',
			'Portfolio Carousel 2'                          => 'carousel-2',
			'Titles Outside 1 Column'                       => 'titles-outside-1',
			'Titles Outside 2 Columns'                      => 'titles-outside-2',
			'Titles Outside 3 Columns'                      => 'titles-outside-3',
			'Titles Inside 1 Column'                        => 'titles-inside-1',
			'Titles Inside 2 Columns'                       => 'titles-inside-2',
			'Titles Inside 3 Columns'                       => 'titles-inside-3',
			'Titles Inside on Hover 1 Column'               => 'titles-hover-1',
			'Titles Inside on Hover 2 Columns'              => 'titles-hover-2',
			'Titles Inside on Hover 3 Columns'              => 'titles-hover-3',
			'Tiles'                                         => 'tiles',
			'Squares'                                       => 'squares',
			'Fullscreen Slider'                             => 'fullscreen',
			'Fullwidth (gapless) Titles on Hover 2 Columns' => 'fullwidth-2',
			'Fullwidth (gapless) Titles on Hover 3 Columns' => 'fullwidth-3',
			'Studio'                                        => 'studio'
		);
		
		if( has_filter('ebor_add_portfolio_layouts') ) {
			$options = apply_filters('ebor_add_portfolio_layouts', $options);
		}
		
		return $options;
	}
}

/**
 * Returns an array of all available header layouts
 * 
 * @val array
 * @since 1.0.0
 * @package Foundry
 * @author TommusRhodus
 */
if(!( function_exists('ebor_get_header_options') )){
	function ebor_get_header_options(){
		$options = array(
			'blank'                              => 'No Navigation',
			'sidebar'                            => 'Sidebar Offscreen',
			'sidebar-transparent'                => 'Sidebar Offscreen (Transparent)',
			'fullscreen'                         => 'Fullscreen Modal',
			'fullscreen-transparent'             => 'Fullscreen Modal (Transparent)',
			'minimal-static'                     => 'Logo & Buttons',
			'minimal'                            => 'Logo & Buttons (Transparent)',
			'super-minimal-static'               => 'Logo Only',
			'super-minimal'                      => 'Logo Only (Transparent)',
			'standard'                           => 'Standard Bar & Top Bar',
			'standard-no-top'                    => 'Standard Bar',
			'overlay'                            => 'Standard Bar (Transparent)',
			'overlay-with-top'                   => 'Standard & Top Bar (Transparent)',
			'overlay-dark'                       => 'Standard Bar (Transparent)(Dark Text)',
			'overlay-with-top-dark'              => 'Standard & Top Bar (Transparent)(Dark Text)',
			'centered'                           => 'Centered Bar',
			'centered-transparent'               => 'Centered Bar (Transparent)',
			'centered-transparent-dark'          => 'Centered Bar (Transparent)(Dark Text)',
			'centered-with-top'                  => 'Centered Bar & Top Bar',
			'centered-transparent-with-top'      => 'Centered Bar & Top Bar (Transparent)',
			'centered-transparent-dark-with-top' => 'Centered Bar & Top Bar (Transparent)(Dark Text)',
			'centered-large'                     => 'Stacked Bar',
			'search'                             => 'Search Bar',
			'vertical'                           => 'Sidebar'
		);
		
		if( has_filter('ebor_add_header_layouts') ) {
			$options = apply_filters('ebor_add_header_layouts', $options);
		}
		
		return $options;	
	}
}

if(!( function_exists('ebor_get_footer_options') )){
	function ebor_get_footer_options(){
		$options = array(
			'blank'                     => 'No Footer',
			'subscribe'                 => 'Subscription Form (White Background)',
			'subscribe-bg-secondary'    => 'Subscription Form (Grey Background)',
			'subscribe-bg-dark'         => 'Subscription Form (Dark Background)',
			'subscribe-bg-primary'      => 'Subscription Form (Primary Background)',
			'subscribe-bg-image'        => 'Subscription Form (Image Background)',
			'centered'                  => 'Centered Content (White Background)',
			'centered-bg-secondary'     => 'Centered Content (Grey Background)',
			'centered-bg-dark'          => 'Centered Content (Dark Background)',
			'centered-bg-primary'       => 'Centered Content (Primary Background)',
			'centered-bg-image'         => 'Centered Content (Image Background)',
			'short-1'                   => 'Links, Social Icons (White Background)',
			'short-1-bg-secondary'      => 'Links, Social Icons (Grey Background)',
			'short-1-bg-dark'           => 'Links, Social Icons (Dark Background)',
			'short-1-bg-primary'        => 'Links, Social Icons (Primary Background)',
			'short-1-bg-image'          => 'Links, Social Icons (Image Background)',
			'short-2'                   => 'Links, Social Icons, CTA (White Background)',
			'short-2-bg-secondary'      => 'Links, Social Icons, CTA (Grey Background)',
			'short-2-bg-dark'           => 'Links, Social Icons, CTA (Dark Background)',
			'short-2-bg-primary'        => 'Links, Social Icons, CTA (Primary Background)',
			'short-2-bg-image'          => 'Links, Social Icons, CTA (Image Background)',
			'short-3'                   => 'Logo, Social Icons (White Background)',
			'short-3-bg-secondary'      => 'Logo, Social Icons (Grey Background)',
			'short-3-bg-dark'           => 'Logo, Social Icons (Black Background)',
			'short-3-bg-primary'        => 'Logo, Social Icons (Primary Background)',
			'short-3-bg-image'          => 'Logo, Social Icons (Image Background)',
			'widgets-1'                 => 'Widget Columns (White Background)',
			'widgets-1-bg-secondary'    => 'Widget Columns (Grey Background)',
			'widgets-1-bg-dark'         => 'Widget Columns (Dark Background)',
			'widgets-1-bg-primary'      => 'Widget Columns (Primary Background)',
			'widgets-1-bg-image'        => 'Widget Columns (Image Background)',
			'widgets-2'                 => 'Widget Columns & Sub Footer (White Background)',
			'widgets-2-bg-secondary'    => 'Widget Columns & Sub Footer (Grey Background)',
			'widgets-2-bg-dark'         => 'Widget Columns & Sub Footer (Dark Background)',
			'widgets-2-bg-primary'      => 'Widget Columns & Sub Footer (Primary Background)',
			'widgets-2-bg-image'        => 'Widget Columns & Sub Footer (Image Background)',
			'short-5'                   => 'Text, Social Icons (White Background)',
			'short-5-bg-secondary'      => 'Text, Social Icons (Grey Background)',
			'short-5-bg-dark'           => 'Text, Social Icons (Dark Background)',
			'short-5-bg-primary'        => 'Text, Social Icons (Primary Background)',
			'short-5-bg-image'          => 'Text, Social Icons (Image Background)',
		);
		
		if( has_filter('ebor_add_footer_layouts') ) {
			$options = apply_filters('ebor_add_footer_layouts', $options);
		}
		
		return $options;	
	}
}

/**
 * Init theme options
 * Certain theme options need to be written to the database as soon as the theme is installed.
 * This is either for the enqueues in ebor-framework, or to override the default image sizes in WooCommerce.
 * Either way this function is only called when the theme is first activated, de-activating and re-activating the theme will result in these options returning to defaults.
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_init_theme_options') )){
	
	/**
	 * Hook in on activation
	 */
	global $pagenow;
	
	/**
	 * Define image sizes
	 */
	function ebor_init_theme_options() {
		
		//Set all options to zero before initialising options for this theme
		$existing_options = get_option('ebor_framework_options');
		if( is_array($existing_options) ){
			foreach ($existing_options as $key => $value) {
				$existing_options[$key] = '0';
			}
			update_option('ebor_framework_options', $existing_options);
		}
		
		//Ebor Framework
		$framework_args = array(
			'portfolio_post_type'   => '1',
			'team_post_type'        => '1',
			'client_post_type'      => '0',
			'testimonial_post_type' => '1',
			'case_study_post_type'  => '0',
			'service_post_type'     => '0',
			'career_post_type'      => '1',
			'mega_menu'             => '1',
			'aq_resizer'            => '0',
			'page_builder'          => '0',
			'likes'                 => '0',
			'options'               => '1',
			'metaboxes'             => '0',
			'pivot_shortcodes'      => '0',
			'foundry_shortcodes'    => '0',
			'foundry_widgets'       => '0',
			'pillar_vc_shortcodes'  => '0',
			'stack_vc_shortcodes'   => '1'
		);
		update_option('ebor_framework_options', $framework_args);
		
	}
	
	/**
	 * Only call this action when we first activate the theme.
	 */
	if ( 
		is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ||
		is_admin() && isset( $_GET['theme'] ) && $pagenow == 'customize.php'
	){
		add_action( 'after_setup_theme', 'ebor_init_theme_options', 1 );
	}
	
}

/**
 * Register the required plugins for this theme.
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_register_required_plugins') )){
	function ebor_register_required_plugins() {
		$plugins = array(
			array(
			    'name'      => esc_html__('Contact Form 7', 'stack'),
			    'slug'      => 'contact-form-7',
			    'required'  => false,
			    'version' 	=> '3.7.2'
			),
			array(
			    'name'      => esc_html__('WP Less', 'stack'),
			    'slug'      => 'wp-less',
			    'required'  => false,
			    'version' 	=> '1.0.0'
			),
			array(
			    'name'      => esc_html__('Custom Metaboxes 2', 'stack'),
			    'slug'      => 'cmb2',
			    'required'  => true,
			    'version' 	=> '1.0.0'
			),
			array(
			    'name'      => esc_html__('One Click Demo Import', 'stack'),
			    'slug'      => 'one-click-demo-import',
			    'required'  => false,
			    'version' 	=> '1.0.0'
			),
			array(
			    'name'      => 'WooCommerce',
			    'slug'      => 'woocommerce',
			    'required'  => false,
			    'version' 	=> '3.0.0'
			),
			array(
				'name'     				=> esc_html__('Ebor Framework', 'stack'),
				'slug'     				=> 'Ebor-Framework-master',
				'source'   				=> 'https://github.com/tommusrhodus/ebor-framework/archive/master.zip',
				'required' 				=> true,
				'version' 				=> '1.4.4',
				'external_url' 			=> 'https://github.com/tommusrhodus/ebor-framework/archive/master.zip',
			),
			array(
				'name'     				=> esc_html__('Visual Composer', 'stack'),
				'slug'     				=> 'js_composer',
				'source'   				=> 'http://www.madeinebor.com/plugin-downloads/js_composer-latest.zip',
				'required' 				=> false,
				'external_url' 			=> 'http://www.madeinebor.com/plugin-downloads/js_composer-latest.zip',
				'version' 				=> '5.4.2',
			),
			array(
				'name'     				=> esc_html__('Variant Page Builder', 'stack'),
				'slug'     				=> 'Variant-WP-Page-Builder-master',
				'source'   				=> 'http://www.madeinebor.com/plugin-downloads/Variant-WP-Page-Builder-master.zip',
				'required' 				=> false,
				'external_url' 			=> 'http://www.madeinebor.com/plugin-downloads/Variant-WP-Page-Builder-master.zip',
				'version' 				=> '1.2.2',
			)
		);
		$config = array(
			'is_automatic' => true,
		);
		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', 'ebor_register_required_plugins' );
}

/**
 * WordPress' missing is_blog_page() function.  Determines if the currently viewed page is
 * one of the blog pages, including the blog home page, archive, category/tag, author, or single
 * post pages.
 *
 * @see http://core.trac.wordpress.org/browser/tags/3.4.1/wp-includes/query.php#L1572
 *
 * @return bool
 */
if(!( function_exists('is_blog_page') )){
	function is_blog_page() {
	    global $post;
	    return ( ( is_home() || is_archive() || is_single() ) && ('post' == get_post_type($post)) ) ? true : false ;
	}
}

if(!( function_exists('ebor_breadcrumbs') )){ 
	function ebor_breadcrumbs() {
		if ( is_front_page() || is_search() || 'no' == get_option('stack_show_breadcrumbs', 'yes') ) {
			return;
		}
		global $post;
		
		$post_type = get_post_type();
		$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
		$displays = get_option('ebor_framework_cpt_display_options');
		$before = '<ol class="breadcrumbs">';
		$after = '</ol>';
		$home = '<li><a href="' . esc_url( home_url( "/" ) ) . '" class="home-link" rel="home">' . esc_html__( 'Home', 'stack' ) . '</a></li>';
		
		if( 'portfolio' == $post_type ){
			$slug = ( $displays['portfolio_slug'] ) ? $displays['portfolio_slug'] : 'portfolio';
			$title = str_replace(array('-', '_'), ' ', $slug);
			$home .= '<li class="active"><a href="' . esc_url( home_url( "/". $slug ."/" ) ) . '">' . ucfirst($title) . '</a></li>';
		}
		
		if( 'team' == $post_type ){
			$slug = ( $displays['team_slug'] ) ? $displays['team_slug'] : 'team';
			$title = str_replace(array('-', '_'), ' ', $slug);
			$home .= '<li class="active"><a href="' . esc_url( home_url( "/". $slug ."/" ) ) . '">' . ucfirst($title) . '</a></li>';
		}
		
		if( 'career' == $post_type ){
			$slug = get_option('tommusrhodus_careers_slug', 'careers');
			$home .= '<li class="active"><a href="' . esc_url( home_url( "/". $slug ."/" ) ) . '">' . esc_html__( 'Careers', 'stack' ) . '</a></li>';
		}
		
		if( class_exists('woocommerce') ){
			if( 'product' == $post_type && !(is_shop()) ){
				$home .= '<li class="active"><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'Shop', 'stack' ) . '</a></li>';
			} elseif( 'product' == $post_type && is_archive() ) {
				$home .= '<li class="active">' . esc_html__( 'Shop', 'stack' ) . '</li>';
			}
		}
		
		$breadcrumb = '';
		if ( $ancestors ) {
			foreach ( $ancestors as $ancestor ) {
				$breadcrumb .= '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . htmlspecialchars_decode( get_the_title( $ancestor ) ) . '</a></li>';
			}
		}
		
		if( is_blog_page() && is_single() ){
			$breadcrumb .= '<li><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . htmlspecialchars_decode( get_option('stack_blog_title', 'Our Blog') ) . '</a></li><li class="active">' . htmlspecialchars_decode( get_the_title( $post->ID ) ) . '</li>';
		} elseif( is_blog_page() ){
			$breadcrumb .= '<li class="active">' . htmlspecialchars_decode( get_option('stack_blog_title','Our Blog') ) . '</li>';
		} elseif( is_post_type_archive('product') || is_archive() ){		
			$breadcrumb .= '<li>' . htmlspecialchars_decode( single_cat_title('', false) ) . '</li>';		
		} else {
			$breadcrumb .= '<li class="active">' . htmlspecialchars_decode( get_the_title( $post->ID ) ) . '</li>';
		}
		
		return $before . $home . $breadcrumb . $after;
	}
}

/**
 * ebor_get_footer_layout
 * 
 * Use to conditionally check the page footer meta layout against the theme option for the same
 * In short, this function can override the global footer option on a post by post basis
 * Call within get_footer() for this to override the global footer choice
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_get_footer_layout') )){
	function ebor_get_footer_layout($post_id = false){
		
		if( false == $post_id ){
			
			global $post;
			
			if( isset($post->ID) ){
				$post_id = $post->ID;
			}
			
		}
		
		if(!( isset($post_id) ))
			return get_option('footer_layout', 'short-3');
			
		$footer = get_post_meta($post_id, '_ebor_footer_override', 1);
		if( '' == $footer || false == $footer || 'none' == $footer ){
			$footer = get_option('footer_layout', 'short-3');
		}
		
		return $footer;	
	}
}

/**
 * ebor_get_header_layout
 * 
 * Use to conditionally check the page header meta layout against the theme option for the same
 * In short, this function can override the global header option on a post by post basis
 * Call within get_header() for this to override the global header choice
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_get_header_layout') )){
	function ebor_get_header_layout($post_id = false){
		
		if( is_post_type_archive('post') ){
			$header = get_option('blog_header_layout', 'no');
			if(!( 'no' == $header )){
				return $header;
			}
		}
		
		if( is_search() ){
			$header = get_option('search_header_layout', 'no');
			if(!( 'no' == $header )){
				return $header;
			}
		}
		
		if( is_post_type_archive('portfolio') ){
			$header = get_option('portfolio_header_layout', 'no');
			if(!( 'no' == $header )){
				return $header;
			}
		}
		
		if( is_post_type_archive('team') ){
			$header = get_option('team_header_layout', 'no');
			if(!( 'no' == $header )){
				return $header;
			}
		}
		
		if( is_post_type_archive('career') ){
			$header = get_option('career_header_layout', 'no');
			if(!( 'no' == $header )){
				return $header;
			}
		}
		
		if( is_post_type_archive('product') ){
			$header = get_option('shop_header_layout', 'no');
			if(!( 'no' == $header )){
				return $header;
			}
		}
		
		if( false == $post_id ){
			
			global $post;
			
			if( isset($post->ID) ){
				$post_id = $post->ID;
			}
			
		}
		
		if( is_search() || !( isset($post_id) ) )
			return get_option('header_layout', 'standard');
		
		$header = get_post_meta($post_id, '_ebor_header_override', 1);
		if( '' == $header || false == $header || 'none' == $header ){
			$header = get_option('header_layout', 'standard');
		}
		
		return $header;	
	}
}

/**
 * Add additional styling options to TinyMCE
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_mce_buttons_2') )){
	function ebor_mce_buttons_2( $buttons ) {
	    array_unshift( $buttons, 'styleselect' );
	    return $buttons;
	}
	add_filter( 'mce_buttons_2', 'ebor_mce_buttons_2' );
}

/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a comma seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_the_terms') )){
	function ebor_the_terms( $cat, $sep, $value, $args = array() ) {
		
		global $post;
		
		$terms = get_the_terms($post->ID, $cat, '', $sep, '');
		
		if( is_array($terms) ) {
			foreach( $terms as $term ){
				$args[] = $value;	
			}
			$terms = array_map('ebor_simple_cb', $terms, $args);
			return implode( $sep, $terms);
		}
		
	}
}

/**
 * Term name return
 *
 * Returns the Pretty Name of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_simple_cb') )){
	function ebor_simple_cb($t, $v) { 
		if( 'slug' == $v ){
			return $t->slug;
		} elseif( 'link' == $v ){
			return '<a href="'.get_term_link( $t, 'portfolio_category' ).'">'.$t->name.'</a>';
		} else { 
			return $t->name; 
		}
	}
}

/**
 * Add additional styling options to TinyMCE
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_mce_before_init') )){
	function ebor_mce_before_init( $settings ) {
	    $style_formats = array(
	    	array(
				'title'	=> 'Button Styles',
				'items'	=> array(
			    	array(
			    		'title' => 'Button',
			    		'selector' => 'a',
			    		'classes' => 'btn',
			    	),
			    	array(
			    		'title' => 'Button Filled',
			    		'selector' => 'a',
			    		'classes' => 'btn btn--primary',
			    	)
				)
	    	),
	    	array(
	    		'title'	=> 'Margins',
	    		'items'	=> array(
	    	    	array(
	    	    		'title' => 'Zero Bottom Margin',
	    	    		'selector' => '*',
	    	    		'classes' => 'mb0',
	    	    	)
	    		)
	    	),
	    	array(
	    		'title'	=> 'List Styles',
	    		'items'	=> array(
	    	    	array(
	    	    		'title' => 'Bulleted List',
	    	    		'selector' => 'ul',
	    	    		'classes' => 'bullets',
	    	    	),
	    	    	array(
	    	    		'title' => 'Numbered List',
	    	    		'selector' => 'ol',
	    	    		'classes' => 'numbered',
	    	    	),
	    	    	array(
	    	    		'title' => 'Vertical Menu',
	    	    		'selector' => 'ul',
	    	    		'classes' => 'menu-vertical',
	    	    	)
	    		)
	    	),
	    	array(
	    		'title'	=> 'Text Styles',
	    		'items'	=> array(
	    	    	array(
	    	    		'title' => 'Uppercase Text',
	    	    		'selector' => '*',
	    	    		'classes' => 'type--uppercase',
	    	    	),
	    	    	array(
	    	    		'title' => 'Faded Text',
	    	    		'selector' => '*',
	    	    		'classes' => 'type--fade',
	    	    	),
	    	    	array(
	    	    		'title' => 'Lead Paragraph',
	    	    		'selector' => 'p',
	    	    		'classes' => 'lead',
	    	    	),
	    	    	array(
	    	    		'title' => 'Fine Print',
	    	    		'selector' => '*',
	    	    		'classes' => 'type--fine-print',
	    	    	),
	    	    	array(
	    	    		'title' => 'Left Pull Quote',
	    	    		'selector' => 'p',
	    	    		'classes' => 'pull-quote left',
	    	    	),
	    	    	array(
	    	    		'title' => 'Right Pull Quote',
	    	    		'selector' => 'p',
	    	    		'classes' => 'pull-quote right',
	    	    	),
	    		)
	    	),
	    	array(
	    		'title'	=> 'Colors',
	    		'items'	=> array(
	    			array(
	    				'title' => 'Primary',
	    				'selector' => '*',
	    				'classes' => 'color--primary',
	    			),
	    			array(
	    				'title' => 'Primary 1',
	    				'selector' => '*',
	    				'classes' => 'color--primary-1',
	    			),
	    			array(
	    				'title' => 'Primary 2',
	    				'selector' => '*',
	    				'classes' => 'color--primary-2',
	    			),
	    			array(
	    				'title' => 'Dark',
	    				'selector' => '*',
	    				'classes' => 'color--dark',
	    			),
	    			array(
	    				'title' => 'Secondary',
	    				'selector' => '*',
	    				'classes' => 'color--secondary',
	    			),
	    		)
	    	)
	    );
	    $settings['style_formats'] = json_encode( $style_formats );
	    return $settings;
	}
	add_filter( 'tiny_mce_before_init', 'ebor_mce_before_init' );
}

function ebor_get_icons(){
	return array(
		'stack-down-open-big',
		'stack-left-open-big',
		'stack-right-open-big',
		'stack-up-open-big',
		'stack-basket',
		'stack-search',
		'stack-down-dir',
		'stack-left-dir',
		'stack-right-dir',
		'stack-up-dir',
		'stack-down-open',
		'stack-left-open',
		'stack-right-open',
		'stack-up-open',
		'stack-menu',
		'stack-users',
		'stack-publish',
		'stack-trash',
		'stack-bell',
		'stack-cog',
		'stack-plus-circled',
		'stack-dot-3',
		"socicon-500px","socicon-8tracks","socicon-airbnb","socicon-alliance","socicon-amazon","socicon-amplement","socicon-android","socicon-angellist","socicon-apple","socicon-appnet","socicon-baidu","socicon-bandcamp","socicon-battlenet","socicon-beam","socicon-bebee","socicon-bebo","socicon-behance","socicon-blizzard","socicon-blogger","socicon-bloglovin","socicon-buffer","socicon-chrome","socicon-coderwall","socicon-curse","socicon-dailymotion","socicon-deezer","socicon-delicious","socicon-deviantart","socicon-diablo","socicon-digg","socicon-discord","socicon-disqus","socicon-douban","socicon-draugiem","socicon-dribbble","socicon-drupal","socicon-ebay","socicon-ello","socicon-endomodo","socicon-envato","socicon-etsy","socicon-facebook","socicon-feedburner","socicon-filmweb","socicon-firefox","socicon-flattr","socicon-flickr","socicon-formulr","socicon-forrst","socicon-foursquare","socicon-friendfeed","socicon-gamejolt","socicon-gamewisp","socicon-github","socicon-goodreads","socicon-google","socicon-googlegroups","socicon-googlephotos","socicon-googleplus","socicon-googlescholar","socicon-grooveshark","socicon-hackerrank","socicon-hearthstone","socicon-hellocoton","socicon-heroes","socicon-hitbox","socicon-horde","socicon-houzz","socicon-icq","socicon-identica","socicon-imdb","socicon-instagram","socicon-issuu","socicon-istock","socicon-itunes","socicon-keybase","socicon-lanyrd","socicon-lastfm","socicon-line","socicon-linkedin","socicon-livejournal","socicon-lyft","socicon-macos","socicon-mail","socicon-medium","socicon-meetup","socicon-mixcloud","socicon-modelmayhem","socicon-mumble","socicon-myspace","socicon-newsvine","socicon-nintendo","socicon-npm","socicon-odnoklassniki","socicon-openid","socicon-opera","socicon-outlook","socicon-overwatch","socicon-patreon","socicon-paypal","socicon-periscope","socicon-persona","socicon-pinterest","socicon-play","socicon-player","socicon-playstation","socicon-pocket","socicon-qq","socicon-quora","socicon-raidcall","socicon-ravelry","socicon-reddit","socicon-renren","socicon-researchgate","socicon-residentadvisor","socicon-reverbnation","socicon-rss","socicon-sharethis","socicon-skype","socicon-slideshare","socicon-smugmug","socicon-snapchat","socicon-songkick","socicon-soundcloud","socicon-spotify","socicon-spreadshirt","socicon-stackexchange","socicon-stackoverflow","socicon-starcraft","socicon-stayfriends","socicon-steam","socicon-storehouse","socicon-strava","socicon-streamjar","socicon-stumbleupon","socicon-swarm","socicon-teamspeak","socicon-teamviewer","socicon-technorati","socicon-telegram","socicon-trello","socicon-tripadvisor","socicon-tripit","socicon-triplej","socicon-tumblr","socicon-tunein","socicon-twitch","socicon-twitter","socicon-uber","socicon-ventrilo","socicon-viadeo","socicon-viber","socicon-viewbug","socicon-vimeo","socicon-vine","socicon-vkontakte","socicon-warcraft","socicon-wechat","socicon-weibo","socicon-whatsapp","socicon-wikipedia","socicon-windows","socicon-wordpress","socicon-wykop","socicon-xbox","socicon-xing","socicon-yahoo","socicon-yammer","socicon-yandex","socicon-yelp","socicon-younow","socicon-youtube","socicon-zapier","socicon-zerply","socicon-zomato","socicon-zynga",
		'icon-A-Z',
		'icon-Aa',
		'icon-Add-Bag',
		'icon-Add-Basket',
		'icon-Add-Cart',
		'icon-Add-File',
		'icon-Add-SpaceAfterParagraph',
		'icon-Add-SpaceBeforeParagraph',
		'icon-Add-User',
		'icon-Add-UserStar',
		'icon-Add-Window',
		'icon-Add',
		'icon-Address-Book',
		'icon-Address-Book2',
		'icon-Administrator',
		'icon-Aerobics-2',
		'icon-Aerobics-3',
		'icon-Aerobics',
		'icon-Affiliate',
		'icon-Aim',
		'icon-Air-Balloon',
		'icon-Airbrush',
		'icon-Airship',
		'icon-Alarm-Clock',
		'icon-Alarm-Clock2',
		'icon-Alarm',
		'icon-Alien-2',
		'icon-Alien',
		'icon-Aligator',
		'icon-Align-Center',
		'icon-Align-JustifyAll',
		'icon-Align-JustifyCenter',
		'icon-Align-JustifyLeft',
		'icon-Align-JustifyRight',
		'icon-Align-Left',
		'icon-Align-Right',
		'icon-Alpha',
		'icon-Ambulance',
		'icon-AMX',
		'icon-Anchor-2',
		'icon-Anchor',
		'icon-Android-Store',
		'icon-Android',
		'icon-Angel-Smiley',
		'icon-Angel',
		'icon-Angry',
		'icon-Apple-Bite',
		'icon-Apple-Store',
		'icon-Apple',
		'icon-Approved-Window',
		'icon-Aquarius-2',
		'icon-Aquarius',
		'icon-Archery-2',
		'icon-Archery',
		'icon-Argentina',
		'icon-Aries-2',
		'icon-Aries',
		'icon-Army-Key',
		'icon-Arrow-Around',
		'icon-Arrow-Back3',
		'icon-Arrow-Back',
		'icon-Arrow-Back2',
		'icon-Arrow-Barrier',
		'icon-Arrow-Circle',
		'icon-Arrow-Cross',
		'icon-Arrow-Down',
		'icon-Arrow-Down2',
		'icon-Arrow-Down3',
		'icon-Arrow-DowninCircle',
		'icon-Arrow-Fork',
		'icon-Arrow-Forward',
		'icon-Arrow-Forward2',
		'icon-Arrow-From',
		'icon-Arrow-Inside',
		'icon-Arrow-Inside45',
		'icon-Arrow-InsideGap',
		'icon-Arrow-InsideGap45',
		'icon-Arrow-Into',
		'icon-Arrow-Join',
		'icon-Arrow-Junction',
		'icon-Arrow-Left',
		'icon-Arrow-Left2',
		'icon-Arrow-LeftinCircle',
		'icon-Arrow-Loop',
		'icon-Arrow-Merge',
		'icon-Arrow-Mix',
		'icon-Arrow-Next',
		'icon-Arrow-OutLeft',
		'icon-Arrow-OutRight',
		'icon-Arrow-Outside',
		'icon-Arrow-Outside45',
		'icon-Arrow-OutsideGap',
		'icon-Arrow-OutsideGap45',
		'icon-Arrow-Over',
		'icon-Arrow-Refresh',
		'icon-Arrow-Refresh2',
		'icon-Arrow-Right',
		'icon-Arrow-Right2',
		'icon-Arrow-RightinCircle',
		'icon-Arrow-Shuffle',
		'icon-Arrow-Squiggly',
		'icon-Arrow-Through',
		'icon-Arrow-To',
		'icon-Arrow-TurnLeft',
		'icon-Arrow-TurnRight',
		'icon-Arrow-Up',
		'icon-Arrow-Up2',
		'icon-Arrow-Up3',
		'icon-Arrow-UpinCircle',
		'icon-Arrow-XLeft',
		'icon-Arrow-XRight',
		'icon-Ask',
		'icon-Assistant',
		'icon-Astronaut',
		'icon-At-Sign',
		'icon-ATM',
		'icon-Atom',
		'icon-Audio',
		'icon-Auto-Flash',
		'icon-Autumn',
		'icon-Baby-Clothes',
		'icon-Baby-Clothes2',
		'icon-Baby-Cry',
		'icon-Baby',
		'icon-Back2',
		'icon-Back-Media',
		'icon-Back-Music',
		'icon-Back',
		'icon-Background',
		'icon-Bacteria',
		'icon-Bag-Coins',
		'icon-Bag-Items',
		'icon-Bag-Quantity',
		'icon-Bag',
		'icon-Bakelite',
		'icon-Ballet-Shoes',
		'icon-Balloon',
		'icon-Banana',
		'icon-Band-Aid',
		'icon-Bank',
		'icon-Bar-Chart',
		'icon-Bar-Chart2',
		'icon-Bar-Chart3',
		'icon-Bar-Chart4',
		'icon-Bar-Chart5',
		'icon-Bar-Code',
		'icon-Barricade-2',
		'icon-Barricade',
		'icon-Baseball',
		'icon-Basket-Ball',
		'icon-Basket-Coins',
		'icon-Basket-Items',
		'icon-Basket-Quantity',
		'icon-Bat-2',
		'icon-Bat',
		'icon-Bathrobe',
		'icon-Batman-Mask',
		'icon-Battery-0',
		'icon-Battery-25',
		'icon-Battery-50',
		'icon-Battery-75',
		'icon-Battery-100',
		'icon-Battery-Charge',
		'icon-Bear',
		'icon-Beard-2',
		'icon-Beard-3',
		'icon-Beard',
		'icon-Bebo',
		'icon-Bee',
		'icon-Beer-Glass',
		'icon-Beer',
		'icon-Bell-2',
		'icon-Bell',
		'icon-Belt-2',
		'icon-Belt-3',
		'icon-Belt',
		'icon-Berlin-Tower',
		'icon-Beta',
		'icon-Betvibes',
		'icon-Bicycle-2',
		'icon-Bicycle-3',
		'icon-Bicycle',
		'icon-Big-Bang',
		'icon-Big-Data',
		'icon-Bike-Helmet',
		'icon-Bikini',
		'icon-Bilk-Bottle2',
		'icon-Billing',
		'icon-Bing',
		'icon-Binocular',
		'icon-Bio-Hazard',
		'icon-Biotech',
		'icon-Bird-DeliveringLetter',
		'icon-Bird',
		'icon-Birthday-Cake',
		'icon-Bisexual',
		'icon-Bishop',
		'icon-Bitcoin',
		'icon-Black-Cat',
		'icon-Blackboard',
		'icon-Blinklist',
		'icon-Block-Cloud',
		'icon-Block-Window',
		'icon-Blogger',
		'icon-Blood',
		'icon-Blouse',
		'icon-Blueprint',
		'icon-Board',
		'icon-Bodybuilding',
		'icon-Bold-Text',
		'icon-Bone',
		'icon-Bones',
		'icon-Book',
		'icon-Bookmark',
		'icon-Books-2',
		'icon-Books',
		'icon-Boom',
		'icon-Boot-2',
		'icon-Boot',
		'icon-Bottom-ToTop',
		'icon-Bow-2',
		'icon-Bow-3',
		'icon-Bow-4',
		'icon-Bow-5',
		'icon-Bow-6',
		'icon-Bow',
		'icon-Bowling-2',
		'icon-Bowling',
		'icon-Box2',
		'icon-Box-Close',
		'icon-Box-Full',
		'icon-Box-Open',
		'icon-Box-withFolders',
		'icon-Box',
		'icon-Boy',
		'icon-Bra',
		'icon-Brain-2',
		'icon-Brain-3',
		'icon-Brain',
		'icon-Brazil',
		'icon-Bread-2',
		'icon-Bread',
		'icon-Bridge',
		'icon-Brightkite',
		'icon-Broke-Link2',
		'icon-Broken-Link',
		'icon-Broom',
		'icon-Brush',
		'icon-Bucket',
		'icon-Bug',
		'icon-Building',
		'icon-Bulleted-List',
		'icon-Bus-2',
		'icon-Bus',
		'icon-Business-Man',
		'icon-Business-ManWoman',
		'icon-Business-Mens',
		'icon-Business-Woman',
		'icon-Butterfly',
		'icon-Button',
		'icon-Cable-Car',
		'icon-Cake',
		'icon-Calculator-2',
		'icon-Calculator-3',
		'icon-Calculator',
		'icon-Calendar-2',
		'icon-Calendar-3',
		'icon-Calendar-4',
		'icon-Calendar-Clock',
		'icon-Calendar',
		'icon-Camel',
		'icon-Camera-2',
		'icon-Camera-3',
		'icon-Camera-4',
		'icon-Camera-5',
		'icon-Camera-Back',
		'icon-Camera',
		'icon-Can-2',
		'icon-Can',
		'icon-Canada',
		'icon-Cancer-2',
		'icon-Cancer-3',
		'icon-Cancer',
		'icon-Candle',
		'icon-Candy-Cane',
		'icon-Candy',
		'icon-Cannon',
		'icon-Cap-2',
		'icon-Cap-3',
		'icon-Cap-Smiley',
		'icon-Cap',
		'icon-Capricorn-2',
		'icon-Capricorn',
		'icon-Car-2',
		'icon-Car-3',
		'icon-Car-Coins',
		'icon-Car-Items',
		'icon-Car-Wheel',
		'icon-Car',
		'icon-Cardigan',
		'icon-Cardiovascular',
		'icon-Cart-Quantity',
		'icon-Casette-Tape',
		'icon-Cash-Register',
		'icon-Cash-register2',
		'icon-Castle',
		'icon-Cat',
		'icon-Cathedral',
		'icon-Cauldron',
		'icon-CD-2',
		'icon-CD-Cover',
		'icon-CD',
		'icon-Cello',
		'icon-Celsius',
		'icon-Chacked-Flag',
		'icon-Chair',
		'icon-Charger',
		'icon-Check-2',
		'icon-Check',
		'icon-Checked-User',
		'icon-Checkmate',
		'icon-Checkout-Bag',
		'icon-Checkout-Basket',
		'icon-Checkout',
		'icon-Cheese',
		'icon-Cheetah',
		'icon-Chef-Hat',
		'icon-Chef-Hat2',
		'icon-Chef',
		'icon-Chemical-2',
		'icon-Chemical-3',
		'icon-Chemical-4',
		'icon-Chemical-5',
		'icon-Chemical',
		'icon-Chess-Board',
		'icon-Chess',
		'icon-Chicken',
		'icon-Chile',
		'icon-Chimney',
		'icon-China',
		'icon-Chinese-Temple',
		'icon-Chip',
		'icon-Chopsticks-2',
		'icon-Chopsticks',
		'icon-Christmas-Ball',
		'icon-Christmas-Bell',
		'icon-Christmas-Candle',
		'icon-Christmas-Hat',
		'icon-Christmas-Sleigh',
		'icon-Christmas-Snowman',
		'icon-Christmas-Sock',
		'icon-Christmas-Tree',
		'icon-Christmas',
		'icon-Chrome',
		'icon-Chrysler-Building',
		'icon-Cinema',
		'icon-Circular-Point',
		'icon-City-Hall',
		'icon-Clamp',
		'icon-Clapperboard-Close',
		'icon-Clapperboard-Open',
		'icon-Claps',
		'icon-Clef',
		'icon-Clinic',
		'icon-Clock-2',
		'icon-Clock-3',
		'icon-Clock-4',
		'icon-Clock-Back',
		'icon-Clock-Forward',
		'icon-Clock',
		'icon-Close-Window',
		'icon-Close',
		'icon-Clothing-Store',
		'icon-Cloud--',
		'icon-Cloud-',
		'icon-Cloud-Camera',
		'icon-Cloud-Computer',
		'icon-Cloud-Email',
		'icon-Cloud-Hail',
		'icon-Cloud-Laptop',
		'icon-Cloud-Lock',
		'icon-Cloud-Moon',
		'icon-Cloud-Music',
		'icon-Cloud-Picture',
		'icon-Cloud-Rain',
		'icon-Cloud-Remove',
		'icon-Cloud-Secure',
		'icon-Cloud-Settings',
		'icon-Cloud-Smartphone',
		'icon-Cloud-Snow',
		'icon-Cloud-Sun',
		'icon-Cloud-Tablet',
		'icon-Cloud-Video',
		'icon-Cloud-Weather',
		'icon-Cloud',
		'icon-Clouds-Weather',
		'icon-Clouds',
		'icon-Clown',
		'icon-CMYK',
		'icon-Coat',
		'icon-Cocktail',
		'icon-Coconut',
		'icon-Code-Window',
		'icon-Coding',
		'icon-Coffee-2',
		'icon-Coffee-Bean',
		'icon-Coffee-Machine',
		'icon-Coffee-toGo',
		'icon-Coffee',
		'icon-Coffin',
		'icon-Coin',
		'icon-Coins-2',
		'icon-Coins-3',
		'icon-Coins',
		'icon-Colombia',
		'icon-Colosseum',
		'icon-Column-2',
		'icon-Column-3',
		'icon-Column',
		'icon-Comb-2',
		'icon-Comb',
		'icon-Communication-Tower',
		'icon-Communication-Tower2',
		'icon-Compass-2',
		'icon-Compass-3',
		'icon-Compass-4',
		'icon-Compass-Rose',
		'icon-Compass',
		'icon-Computer-2',
		'icon-Computer-3',
		'icon-Computer-Secure',
		'icon-Computer',
		'icon-Conference',
		'icon-Confused',
		'icon-Conservation',
		'icon-Consulting',
		'icon-Contrast',
		'icon-Control-2',
		'icon-Control',
		'icon-Cookie-Man',
		'icon-Cookies',
		'icon-Cool-Guy',
		'icon-Cool',
		'icon-Copyright',
		'icon-Costume',
		'icon-Couple-Sign',
		'icon-Cow',
		'icon-CPU',
		'icon-Crane',
		'icon-Cranium',
		'icon-Credit-Card',
		'icon-Credit-Card2',
		'icon-Credit-Card3',
		'icon-Cricket',
		'icon-Criminal',
		'icon-Croissant',
		'icon-Crop-2',
		'icon-Crop-3',
		'icon-Crown-2',
		'icon-Crown',
		'icon-Crying',
		'icon-Cube-Molecule',
		'icon-Cube-Molecule2',
		'icon-Cupcake',
		'icon-Cursor-Click',
		'icon-Cursor-Click2',
		'icon-Cursor-Move',
		'icon-Cursor-Move2',
		'icon-Cursor-Select',
		'icon-Cursor',
		'icon-D-Eyeglasses',
		'icon-D-Eyeglasses2',
		'icon-Dam',
		'icon-Danemark',
		'icon-Danger-2',
		'icon-Danger',
		'icon-Dashboard',
		'icon-Data-Backup',
		'icon-Data-Block',
		'icon-Data-Center',
		'icon-Data-Clock',
		'icon-Data-Cloud',
		'icon-Data-Compress',
		'icon-Data-Copy',
		'icon-Data-Download',
		'icon-Data-Financial',
		'icon-Data-Key',
		'icon-Data-Lock',
		'icon-Data-Network',
		'icon-Data-Password',
		'icon-Data-Power',
		'icon-Data-Refresh',
		'icon-Data-Save',
		'icon-Data-Search',
		'icon-Data-Security',
		'icon-Data-Settings',
		'icon-Data-Sharing',
		'icon-Data-Shield',
		'icon-Data-Signal',
		'icon-Data-Storage',
		'icon-Data-Stream',
		'icon-Data-Transfer',
		'icon-Data-Unlock',
		'icon-Data-Upload',
		'icon-Data-Yes',
		'icon-Data',
		'icon-David-Star',
		'icon-Daylight',
		'icon-Death',
		'icon-Debian',
		'icon-Dec',
		'icon-Decrase-Inedit',
		'icon-Deer-2',
		'icon-Deer',
		'icon-Delete-File',
		'icon-Delete-Window',
		'icon-Delicious',
		'icon-Depression',
		'icon-Deviantart',
		'icon-Device-SyncwithCloud',
		'icon-Diamond',
		'icon-Dice-2',
		'icon-Dice',
		'icon-Digg',
		'icon-Digital-Drawing',
		'icon-Diigo',
		'icon-Dinosaur',
		'icon-Diploma-2',
		'icon-Diploma',
		'icon-Direction-East',
		'icon-Direction-North',
		'icon-Direction-South',
		'icon-Direction-West',
		'icon-Director',
		'icon-Disk',
		'icon-Dj',
		'icon-DNA-2',
		'icon-DNA-Helix',
		'icon-DNA',
		'icon-Doctor',
		'icon-Dog',
		'icon-Dollar-Sign',
		'icon-Dollar-Sign2',
		'icon-Dollar',
		'icon-Dolphin',
		'icon-Domino',
		'icon-Door-Hanger',
		'icon-Door',
		'icon-Doplr',
		'icon-Double-Circle',
		'icon-Double-Tap',
		'icon-Doughnut',
		'icon-Dove',
		'icon-Down-2',
		'icon-Down-3',
		'icon-Down-4',
		'icon-Down',
		'icon-Download-2',
		'icon-Download-fromCloud',
		'icon-Download-Window',
		'icon-Download',
		'icon-Downward',
		'icon-Drag-Down',
		'icon-Drag-Left',
		'icon-Drag-Right',
		'icon-Drag-Up',
		'icon-Drag',
		'icon-Dress',
		'icon-Drill-2',
		'icon-Drill',
		'icon-Drop',
		'icon-Dropbox',
		'icon-Drum',
		'icon-Dry',
		'icon-Duck',
		'icon-Dumbbell',
		'icon-Duplicate-Layer',
		'icon-Duplicate-Window',
		'icon-DVD',
		'icon-Eagle',
		'icon-Ear',
		'icon-Earphones-2',
		'icon-Earphones',
		'icon-Eci-Icon',
		'icon-Edit-Map',
		'icon-Edit',
		'icon-Eggs',
		'icon-Egypt',
		'icon-Eifel-Tower',
		'icon-eject-2',
		'icon-Eject',
		'icon-El-Castillo',
		'icon-Elbow',
		'icon-Electric-Guitar',
		'icon-Electricity',
		'icon-Elephant',
		'icon-Email',
		'icon-Embassy',
		'icon-Empire-StateBuilding',
		'icon-Empty-Box',
		'icon-End2',
		'icon-End-2',
		'icon-End',
		'icon-Endways',
		'icon-Engineering',
		'icon-Envelope-2',
		'icon-Envelope',
		'icon-Environmental-2',
		'icon-Environmental-3',
		'icon-Environmental',
		'icon-Equalizer',
		'icon-Eraser-2',
		'icon-Eraser-3',
		'icon-Eraser',
		'icon-Error-404Window',
		'icon-Euro-Sign',
		'icon-Euro-Sign2',
		'icon-Euro',
		'icon-Evernote',
		'icon-Evil',
		'icon-Explode',
		'icon-Eye-2',
		'icon-Eye-Blind',
		'icon-Eye-Invisible',
		'icon-Eye-Scan',
		'icon-Eye-Visible',
		'icon-Eye',
		'icon-Eyebrow-2',
		'icon-Eyebrow-3',
		'icon-Eyebrow',
		'icon-Eyeglasses-Smiley',
		'icon-Eyeglasses-Smiley2',
		'icon-Face-Style',
		'icon-Face-Style2',
		'icon-Face-Style3',
		'icon-Face-Style4',
		'icon-Face-Style5',
		'icon-Face-Style6',
		'icon-Facebook-2',
		'icon-Facebook',
		'icon-Factory-2',
		'icon-Factory',
		'icon-Fahrenheit',
		'icon-Family-Sign',
		'icon-Fan',
		'icon-Farmer',
		'icon-Fashion',
		'icon-Favorite-Window',
		'icon-Fax',
		'icon-Feather',
		'icon-Feedburner',
		'icon-Female-2',
		'icon-Female-Sign',
		'icon-Female',
		'icon-File-Block',
		'icon-File-Bookmark',
		'icon-File-Chart',
		'icon-File-Clipboard',
		'icon-File-ClipboardFileText',
		'icon-File-ClipboardTextImage',
		'icon-File-Cloud',
		'icon-File-Copy',
		'icon-File-Copy2',
		'icon-File-CSV',
		'icon-File-Download',
		'icon-File-Edit',
		'icon-File-Excel',
		'icon-File-Favorite',
		'icon-File-Fire',
		'icon-File-Graph',
		'icon-File-Hide',
		'icon-File-Horizontal',
		'icon-File-HorizontalText',
		'icon-File-HTML',
		'icon-File-JPG',
		'icon-File-Link',
		'icon-File-Loading',
		'icon-File-Lock',
		'icon-File-Love',
		'icon-File-Music',
		'icon-File-Network',
		'icon-File-Pictures',
		'icon-File-Pie',
		'icon-File-Presentation',
		'icon-File-Refresh',
		'icon-File-Search',
		'icon-File-Settings',
		'icon-File-Share',
		'icon-File-TextImage',
		'icon-File-Trash',
		'icon-File-TXT',
		'icon-File-Upload',
		'icon-File-Video',
		'icon-File-Word',
		'icon-File-Zip',
		'icon-File',
		'icon-Files',
		'icon-Film-Board',
		'icon-Film-Cartridge',
		'icon-Film-Strip',
		'icon-Film-Video',
		'icon-Film',
		'icon-Filter-2',
		'icon-Filter',
		'icon-Financial',
		'icon-Find-User',
		'icon-Finger-DragFourSides',
		'icon-Finger-DragTwoSides',
		'icon-Finger-Print',
		'icon-Finger',
		'icon-Fingerprint-2',
		'icon-Fingerprint',
		'icon-Fire-Flame',
		'icon-Fire-Flame2',
		'icon-Fire-Hydrant',
		'icon-Fire-Staion',
		'icon-Firefox',
		'icon-Firewall',
		'icon-First-Aid',
		'icon-First',
		'icon-Fish-Food',
		'icon-Fish',
		'icon-Fit-To',
		'icon-Fit-To2',
		'icon-Five-Fingers',
		'icon-Five-FingersDrag',
		'icon-Five-FingersDrag2',
		'icon-Five-FingersTouch',
		'icon-Flag-2',
		'icon-Flag-3',
		'icon-Flag-4',
		'icon-Flag-5',
		'icon-Flag-6',
		'icon-Flag',
		'icon-Flamingo',
		'icon-Flash-2',
		'icon-Flash-Video',
		'icon-Flash',
		'icon-Flashlight',
		'icon-Flask-2',
		'icon-Flask',
		'icon-Flick',
		'icon-Flickr',
		'icon-Flowerpot',
		'icon-Fluorescent',
		'icon-Fog-Day',
		'icon-Fog-Night',
		'icon-Folder-Add',
		'icon-Folder-Archive',
		'icon-Folder-Binder',
		'icon-Folder-Binder2',
		'icon-Folder-Block',
		'icon-Folder-Bookmark',
		'icon-Folder-Close',
		'icon-Folder-Cloud',
		'icon-Folder-Delete',
		'icon-Folder-Download',
		'icon-Folder-Edit',
		'icon-Folder-Favorite',
		'icon-Folder-Fire',
		'icon-Folder-Hide',
		'icon-Folder-Link',
		'icon-Folder-Loading',
		'icon-Folder-Lock',
		'icon-Folder-Love',
		'icon-Folder-Music',
		'icon-Folder-Network',
		'icon-Folder-Open',
		'icon-Folder-Open2',
		'icon-Folder-Organizing',
		'icon-Folder-Pictures',
		'icon-Folder-Refresh',
		'icon-Folder-Remove-',
		'icon-Folder-Search',
		'icon-Folder-Settings',
		'icon-Folder-Share',
		'icon-Folder-Trash',
		'icon-Folder-Upload',
		'icon-Folder-Video',
		'icon-Folder-WithDocument',
		'icon-Folder-Zip',
		'icon-Folder',
		'icon-Folders',
		'icon-Font-Color',
		'icon-Font-Name',
		'icon-Font-Size',
		'icon-Font-Style',
		'icon-Font-StyleSubscript',
		'icon-Font-StyleSuperscript',
		'icon-Font-Window',
		'icon-Foot-2',
		'icon-Foot',
		'icon-Football-2',
		'icon-Football',
		'icon-Footprint-2',
		'icon-Footprint-3',
		'icon-Footprint',
		'icon-Forest',
		'icon-Fork',
		'icon-Formspring',
		'icon-Formula',
		'icon-Forsquare',
		'icon-Forward',
		'icon-Fountain-Pen',
		'icon-Four-Fingers',
		'icon-Four-FingersDrag',
		'icon-Four-FingersDrag2',
		'icon-Four-FingersTouch',
		'icon-Fox',
		'icon-Frankenstein',
		'icon-French-Fries',
		'icon-Friendfeed',
		'icon-Friendster',
		'icon-Frog',
		'icon-Fruits',
		'icon-Fuel',
		'icon-Full-Bag',
		'icon-Full-Basket',
		'icon-Full-Cart',
		'icon-Full-Moon',
		'icon-Full-Screen',
		'icon-Full-Screen2',
		'icon-Full-View',
		'icon-Full-View2',
		'icon-Full-ViewWindow',
		'icon-Function',
		'icon-Funky',
		'icon-Funny-Bicycle',
		'icon-Furl',
		'icon-Gamepad-2',
		'icon-Gamepad',
		'icon-Gas-Pump',
		'icon-Gaugage-2',
		'icon-Gaugage',
		'icon-Gay',
		'icon-Gear-2',
		'icon-Gear',
		'icon-Gears-2',
		'icon-Gears',
		'icon-Geek-2',
		'icon-Geek',
		'icon-Gemini-2',
		'icon-Gemini',
		'icon-Genius',
		'icon-Gentleman',
		'icon-Geo--',
		'icon-Geo-',
		'icon-Geo-Close',
		'icon-Geo-Love',
		'icon-Geo-Number',
		'icon-Geo-Star',
		'icon-Geo',
		'icon-Geo2--',
		'icon-Geo2-',
		'icon-Geo2-Close',
		'icon-Geo2-Love',
		'icon-Geo2-Number',
		'icon-Geo2-Star',
		'icon-Geo2',
		'icon-Geo3--',
		'icon-Geo3-',
		'icon-Geo3-Close',
		'icon-Geo3-Love',
		'icon-Geo3-Number',
		'icon-Geo3-Star',
		'icon-Geo3',
		'icon-Gey',
		'icon-Gift-Box',
		'icon-Giraffe',
		'icon-Girl',
		'icon-Glass-Water',
		'icon-Glasses-2',
		'icon-Glasses-3',
		'icon-Glasses',
		'icon-Global-Position',
		'icon-Globe-2',
		'icon-Globe',
		'icon-Gloves',
		'icon-Go-Bottom',
		'icon-Go-Top',
		'icon-Goggles',
		'icon-Golf-2',
		'icon-Golf',
		'icon-Google-Buzz',
		'icon-Google-Drive',
		'icon-Google-Play',
		'icon-Google-Plus',
		'icon-Google',
		'icon-Gopro',
		'icon-Gorilla',
		'icon-Gowalla',
		'icon-Grave',
		'icon-Graveyard',
		'icon-Greece',
		'icon-Green-Energy',
		'icon-Green-House',
		'icon-Guitar',
		'icon-Gun-2',
		'icon-Gun-3',
		'icon-Gun',
		'icon-Gymnastics',
		'icon-Hair-2',
		'icon-Hair-3',
		'icon-Hair-4',
		'icon-Hair',
		'icon-Half-Moon',
		'icon-Halloween-HalfMoon',
		'icon-Halloween-Moon',
		'icon-Hamburger',
		'icon-Hammer',
		'icon-Hand-Touch',
		'icon-Hand-Touch2',
		'icon-Hand-TouchSmartphone',
		'icon-Hand',
		'icon-Hands',
		'icon-Handshake',
		'icon-Hanger',
		'icon-Happy',
		'icon-Hat-2',
		'icon-Hat',
		'icon-Haunted-House',
		'icon-HD-Video',
		'icon-HD',
		'icon-HDD',
		'icon-Headphone',
		'icon-Headphones',
		'icon-Headset',
		'icon-Heart-2',
		'icon-Heart',
		'icon-Heels-2',
		'icon-Heels',
		'icon-Height-Window',
		'icon-Helicopter-2',
		'icon-Helicopter',
		'icon-Helix-2',
		'icon-Hello',
		'icon-Helmet-2',
		'icon-Helmet-3',
		'icon-Helmet',
		'icon-Hipo',
		'icon-Hipster-Glasses',
		'icon-Hipster-Glasses2',
		'icon-Hipster-Glasses3',
		'icon-Hipster-Headphones',
		'icon-Hipster-Men',
		'icon-Hipster-Men2',
		'icon-Hipster-Men3',
		'icon-Hipster-Sunglasses',
		'icon-Hipster-Sunglasses2',
		'icon-Hipster-Sunglasses3',
		'icon-Hokey',
		'icon-Holly',
		'icon-Home-2',
		'icon-Home-3',
		'icon-Home-4',
		'icon-Home-5',
		'icon-Home-Window',
		'icon-Home',
		'icon-Homosexual',
		'icon-Honey',
		'icon-Hong-Kong',
		'icon-Hoodie',
		'icon-Horror',
		'icon-Horse',
		'icon-Hospital-2',
		'icon-Hospital',
		'icon-Host',
		'icon-Hot-Dog',
		'icon-Hotel',
		'icon-Hour',
		'icon-Hub',
		'icon-Humor',
		'icon-Hurt',
		'icon-Ice-Cream',
		'icon-ICQ',
		'icon-ID-2',
		'icon-ID-3',
		'icon-ID-Card',
		'icon-Idea-2',
		'icon-Idea-3',
		'icon-Idea-4',
		'icon-Idea-5',
		'icon-Idea',
		'icon-Identification-Badge',
		'icon-ImDB',
		'icon-Inbox-Empty',
		'icon-Inbox-Forward',
		'icon-Inbox-Full',
		'icon-Inbox-Into',
		'icon-Inbox-Out',
		'icon-Inbox-Reply',
		'icon-Inbox',
		'icon-Increase-Inedit',
		'icon-Indent-FirstLine',
		'icon-Indent-LeftMargin',
		'icon-Indent-RightMargin',
		'icon-India',
		'icon-Info-Window',
		'icon-Information',
		'icon-Inifity',
		'icon-Instagram',
		'icon-Internet-2',
		'icon-Internet-Explorer',
		'icon-Internet-Smiley',
		'icon-Internet',
		'icon-iOS-Apple',
		'icon-Israel',
		'icon-Italic-Text',
		'icon-Jacket-2',
		'icon-Jacket',
		'icon-Jamaica',
		'icon-Japan',
		'icon-Japanese-Gate',
		'icon-Jeans',
		'icon-Jeep-2',
		'icon-Jeep',
		'icon-Jet',
		'icon-Joystick',
		'icon-Juice',
		'icon-Jump-Rope',
		'icon-Kangoroo',
		'icon-Kenya',
		'icon-Key-2',
		'icon-Key-3',
		'icon-Key-Lock',
		'icon-Key',
		'icon-Keyboard',
		'icon-Keyboard3',
		'icon-Keypad',
		'icon-King-2',
		'icon-King',
		'icon-Kiss',
		'icon-Knee',
		'icon-Knife-2',
		'icon-Knife',
		'icon-Knight',
		'icon-Koala',
		'icon-Korea',
		'icon-Lamp',
		'icon-Landscape-2',
		'icon-Landscape',
		'icon-Lantern',
		'icon-Laptop-2',
		'icon-Laptop-3',
		'icon-Laptop-Phone',
		'icon-Laptop-Secure',
		'icon-Laptop-Tablet',
		'icon-Laptop',
		'icon-Laser',
		'icon-Last-FM',
		'icon-Last',
		'icon-Laughing',
		'icon-Layer-1635',
		'icon-Layer-1646',
		'icon-Layer-Backward',
		'icon-Layer-Forward',
		'icon-Leafs-2',
		'icon-Leafs',
		'icon-Leaning-Tower',
		'icon-Left--Right',
		'icon-Left--Right3',
		'icon-Left-2',
		'icon-Left-3',
		'icon-Left-4',
		'icon-Left-ToRight',
		'icon-Left',
		'icon-Leg-2',
		'icon-Leg',
		'icon-Lego',
		'icon-Lemon',
		'icon-Len-2',
		'icon-Len-3',
		'icon-Len',
		'icon-Leo-2',
		'icon-Leo',
		'icon-Leopard',
		'icon-Lesbian',
		'icon-Lesbians',
		'icon-Letter-Close',
		'icon-Letter-Open',
		'icon-Letter-Sent',
		'icon-Libra-2',
		'icon-Libra',
		'icon-Library-2',
		'icon-Library',
		'icon-Life-Jacket',
		'icon-Life-Safer',
		'icon-Light-Bulb',
		'icon-Light-Bulb2',
		'icon-Light-BulbLeaf',
		'icon-Lighthouse',
		'icon-Like-2',
		'icon-Like',
		'icon-Line-Chart',
		'icon-Line-Chart2',
		'icon-Line-Chart3',
		'icon-Line-Chart4',
		'icon-Line-Spacing',
		'icon-Line-SpacingText',
		'icon-Link-2',
		'icon-Link',
		'icon-Linkedin-2',
		'icon-Linkedin',
		'icon-Linux',
		'icon-Lion',
		'icon-Livejournal',
		'icon-Loading-2',
		'icon-Loading-3',
		'icon-Loading-Window',
		'icon-Loading',
		'icon-Location-2',
		'icon-Location',
		'icon-Lock-2',
		'icon-Lock-3',
		'icon-Lock-User',
		'icon-Lock-Window',
		'icon-Lock',
		'icon-Lollipop-2',
		'icon-Lollipop-3',
		'icon-Lollipop',
		'icon-Loop',
		'icon-Loud',
		'icon-Loudspeaker',
		'icon-Love-2',
		'icon-Love-User',
		'icon-Love-Window',
		'icon-Love',
		'icon-Lowercase-Text',
		'icon-Luggafe-Front',
		'icon-Luggage-2',
		'icon-Macro',
		'icon-Magic-Wand',
		'icon-Magnet',
		'icon-Magnifi-Glass-',
		'icon-Magnifi-Glass',
		'icon-Magnifi-Glass2',
		'icon-Mail-2',
		'icon-Mail-3',
		'icon-Mail-Add',
		'icon-Mail-Attachement',
		'icon-Mail-Block',
		'icon-Mail-Delete',
		'icon-Mail-Favorite',
		'icon-Mail-Forward',
		'icon-Mail-Gallery',
		'icon-Mail-Inbox',
		'icon-Mail-Link',
		'icon-Mail-Lock',
		'icon-Mail-Love',
		'icon-Mail-Money',
		'icon-Mail-Open',
		'icon-Mail-Outbox',
		'icon-Mail-Password',
		'icon-Mail-Photo',
		'icon-Mail-Read',
		'icon-Mail-Removex',
		'icon-Mail-Reply',
		'icon-Mail-ReplyAll',
		'icon-Mail-Search',
		'icon-Mail-Send',
		'icon-Mail-Settings',
		'icon-Mail-Unread',
		'icon-Mail-Video',
		'icon-Mail-withAtSign',
		'icon-Mail-WithCursors',
		'icon-Mail',
		'icon-Mailbox-Empty',
		'icon-Mailbox-Full',
		'icon-Male-2',
		'icon-Male-Sign',
		'icon-Male',
		'icon-MaleFemale',
		'icon-Man-Sign',
		'icon-Management',
		'icon-Mans-Underwear',
		'icon-Mans-Underwear2',
		'icon-Map-Marker',
		'icon-Map-Marker2',
		'icon-Map-Marker3',
		'icon-Map',
		'icon-Map2',
		'icon-Marker-2',
		'icon-Marker-3',
		'icon-Marker',
		'icon-Martini-Glass',
		'icon-Mask',
		'icon-Master-Card',
		'icon-Maximize-Window',
		'icon-Maximize',
		'icon-Medal-2',
		'icon-Medal-3',
		'icon-Medal',
		'icon-Medical-Sign',
		'icon-Medicine-2',
		'icon-Medicine-3',
		'icon-Medicine',
		'icon-Megaphone',
		'icon-Memory-Card',
		'icon-Memory-Card2',
		'icon-Memory-Card3',
		'icon-Men',
		'icon-Menorah',
		'icon-Mens',
		'icon-Metacafe',
		'icon-Mexico',
		'icon-Mic',
		'icon-Microphone-2',
		'icon-Microphone-3',
		'icon-Microphone-4',
		'icon-Microphone-5',
		'icon-Microphone-6',
		'icon-Microphone-7',
		'icon-Microphone',
		'icon-Microscope',
		'icon-Milk-Bottle',
		'icon-Mine',
		'icon-Minimize-Maximize-Close-Window',
		'icon-Minimize-Window',
		'icon-Minimize',
		'icon-Mirror',
		'icon-Mixer',
		'icon-Mixx',
		'icon-Money-2',
		'icon-Money-Bag',
		'icon-Money-Smiley',
		'icon-Money',
		'icon-Monitor-2',
		'icon-Monitor-3',
		'icon-Monitor-4',
		'icon-Monitor-5',
		'icon-Monitor-Analytics',
		'icon-Monitor-Laptop',
		'icon-Monitor-phone',
		'icon-Monitor-Tablet',
		'icon-Monitor-Vertical',
		'icon-Monitor',
		'icon-Monitoring',
		'icon-Monkey',
		'icon-Monster',
		'icon-Morocco',
		'icon-Motorcycle',
		'icon-Mouse-2',
		'icon-Mouse-3',
		'icon-Mouse-4',
		'icon-Mouse-Pointer',
		'icon-Mouse',
		'icon-Moustache-Smiley',
		'icon-Movie-Ticket',
		'icon-Movie',
		'icon-Mp3-File',
		'icon-Museum',
		'icon-Mushroom',
		'icon-Music-Note',
		'icon-Music-Note2',
		'icon-Music-Note3',
		'icon-Music-Note4',
		'icon-Music-Player',
		'icon-Mustache-2',
		'icon-Mustache-3',
		'icon-Mustache-4',
		'icon-Mustache-5',
		'icon-Mustache-6',
		'icon-Mustache-7',
		'icon-Mustache-8',
		'icon-Mustache',
		'icon-Mute',
		'icon-Myspace',
		'icon-Navigat-Start',
		'icon-Navigate-End',
		'icon-Navigation-LeftWindow',
		'icon-Navigation-RightWindow',
		'icon-Nepal',
		'icon-Netscape',
		'icon-Network-Window',
		'icon-Network',
		'icon-Neutron',
		'icon-New-Mail',
		'icon-New-Tab',
		'icon-Newspaper-2',
		'icon-Newspaper',
		'icon-Newsvine',
		'icon-Next2',
		'icon-Next-3',
		'icon-Next-Music',
		'icon-Next',
		'icon-No-Battery',
		'icon-No-Drop',
		'icon-No-Flash',
		'icon-No-Smoking',
		'icon-Noose',
		'icon-Normal-Text',
		'icon-Note',
		'icon-Notepad-2',
		'icon-Notepad',
		'icon-Nuclear',
		'icon-Numbering-List',
		'icon-Nurse',
		'icon-Office-Lamp',
		'icon-Office',
		'icon-Oil',
		'icon-Old-Camera',
		'icon-Old-Cassette',
		'icon-Old-Clock',
		'icon-Old-Radio',
		'icon-Old-Sticky',
		'icon-Old-Sticky2',
		'icon-Old-Telephone',
		'icon-Old-TV',
		'icon-On-Air',
		'icon-On-Off-2',
		'icon-On-Off-3',
		'icon-On-off',
		'icon-One-Finger',
		'icon-One-FingerTouch',
		'icon-One-Window',
		'icon-Open-Banana',
		'icon-Open-Book',
		'icon-Opera-House',
		'icon-Opera',
		'icon-Optimization',
		'icon-Orientation-2',
		'icon-Orientation-3',
		'icon-Orientation',
		'icon-Orkut',
		'icon-Ornament',
		'icon-Over-Time',
		'icon-Over-Time2',
		'icon-Owl',
		'icon-Pac-Man',
		'icon-Paint-Brush',
		'icon-Paint-Bucket',
		'icon-Paintbrush',
		'icon-Palette',
		'icon-Palm-Tree',
		'icon-Panda',
		'icon-Panorama',
		'icon-Pantheon',
		'icon-Pantone',
		'icon-Pants',
		'icon-Paper-Plane',
		'icon-Paper',
		'icon-Parasailing',
		'icon-Parrot',
		'icon-Password-2shopping',
		'icon-Password-Field',
		'icon-Password-shopping',
		'icon-Password',
		'icon-pause-2',
		'icon-Pause',
		'icon-Paw',
		'icon-Pawn',
		'icon-Paypal',
		'icon-Pen-2',
		'icon-Pen-3',
		'icon-Pen-4',
		'icon-Pen-5',
		'icon-Pen-6',
		'icon-Pen',
		'icon-Pencil-Ruler',
		'icon-Pencil',
		'icon-Penguin',
		'icon-Pentagon',
		'icon-People-onCloud',
		'icon-Pepper-withFire',
		'icon-Pepper',
		'icon-Petrol',
		'icon-Petronas-Tower',
		'icon-Philipines',
		'icon-Phone-2',
		'icon-Phone-3',
		'icon-Phone-3G',
		'icon-Phone-4G',
		'icon-Phone-Simcard',
		'icon-Phone-SMS',
		'icon-Phone-Wifi',
		'icon-Phone',
		'icon-Photo-2',
		'icon-Photo-3',
		'icon-Photo-Album',
		'icon-Photo-Album2',
		'icon-Photo-Album3',
		'icon-Photo',
		'icon-Photos',
		'icon-Physics',
		'icon-Pi',
		'icon-Piano',
		'icon-Picasa',
		'icon-Pie-Chart',
		'icon-Pie-Chart2',
		'icon-Pie-Chart3',
		'icon-Pilates-2',
		'icon-Pilates-3',
		'icon-Pilates',
		'icon-Pilot',
		'icon-Pinch',
		'icon-Ping-Pong',
		'icon-Pinterest',
		'icon-Pipe',
		'icon-Pipette',
		'icon-Piramids',
		'icon-Pisces-2',
		'icon-Pisces',
		'icon-Pizza-Slice',
		'icon-Pizza',
		'icon-Plane-2',
		'icon-Plane',
		'icon-Plant',
		'icon-Plasmid',
		'icon-Plaster',
		'icon-Plastic-CupPhone',
		'icon-Plastic-CupPhone2',
		'icon-Plate',
		'icon-Plates',
		'icon-Plaxo',
		'icon-Play-Music',
		'icon-Plug-In',
		'icon-Plug-In2',
		'icon-Plurk',
		'icon-Pointer',
		'icon-Poland',
		'icon-Police-Man',
		'icon-Police-Station',
		'icon-Police-Woman',
		'icon-Police',
		'icon-Polo-Shirt',
		'icon-Portrait',
		'icon-Portugal',
		'icon-Post-Mail',
		'icon-Post-Mail2',
		'icon-Post-Office',
		'icon-Post-Sign',
		'icon-Post-Sign2ways',
		'icon-Posterous',
		'icon-Pound-Sign',
		'icon-Pound-Sign2',
		'icon-Pound',
		'icon-Power-2',
		'icon-Power-3',
		'icon-Power-Cable',
		'icon-Power-Station',
		'icon-Power',
		'icon-Prater',
		'icon-Present',
		'icon-Presents',
		'icon-Press',
		'icon-Preview',
		'icon-Previous',
		'icon-Pricing',
		'icon-Printer',
		'icon-Professor',
		'icon-Profile',
		'icon-Project',
		'icon-Projector-2',
		'icon-Projector',
		'icon-Pulse',
		'icon-Pumpkin',
		'icon-Punk',
		'icon-Punker',
		'icon-Puzzle',
		'icon-QIK',
		'icon-QR-Code',
		'icon-Queen-2',
		'icon-Queen',
		'icon-Quill-2',
		'icon-Quill-3',
		'icon-Quill',
		'icon-Quotes-2',
		'icon-Quotes',
		'icon-Radio',
		'icon-Radioactive',
		'icon-Rafting',
		'icon-Rain-Drop',
		'icon-Rainbow-2',
		'icon-Rainbow',
		'icon-Ram',
		'icon-Razzor-Blade',
		'icon-Receipt-2',
		'icon-Receipt-3',
		'icon-Receipt-4',
		'icon-Receipt',
		'icon-Record2',
		'icon-Record-3',
		'icon-Record-Music',
		'icon-Record',
		'icon-Recycling-2',
		'icon-Recycling',
		'icon-Reddit',
		'icon-Redhat',
		'icon-Redirect',
		'icon-Redo',
		'icon-Reel',
		'icon-Refinery',
		'icon-Refresh-Window',
		'icon-Refresh',
		'icon-Reload-2',
		'icon-Reload-3',
		'icon-Reload',
		'icon-Remote-Controll',
		'icon-Remote-Controll2',
		'icon-Remove-Bag',
		'icon-Remove-Basket',
		'icon-Remove-Cart',
		'icon-Remove-File',
		'icon-Remove-User',
		'icon-Remove-Window',
		'icon-Remove',
		'icon-Rename',
		'icon-Repair',
		'icon-Repeat-2',
		'icon-Repeat-3',
		'icon-Repeat-4',
		'icon-Repeat-5',
		'icon-Repeat-6',
		'icon-Repeat-7',
		'icon-Repeat',
		'icon-Reset',
		'icon-Resize',
		'icon-Restore-Window',
		'icon-Retouching',
		'icon-Retro-Camera',
		'icon-Retro',
		'icon-Retweet',
		'icon-Reverbnation',
		'icon-Rewind',
		'icon-RGB',
		'icon-Ribbon-2',
		'icon-Ribbon-3',
		'icon-Ribbon',
		'icon-Right-2',
		'icon-Right-3',
		'icon-Right-4',
		'icon-Right-ToLeft',
		'icon-Right',
		'icon-Road-2',
		'icon-Road-3',
		'icon-Road',
		'icon-Robot-2',
		'icon-Robot',
		'icon-Rock-andRoll',
		'icon-Rocket',
		'icon-Roller',
		'icon-Roof',
		'icon-Rook',
		'icon-Rotate-Gesture',
		'icon-Rotate-Gesture2',
		'icon-Rotate-Gesture3',
		'icon-Rotation-390',
		'icon-Rotation',
		'icon-Router-2',
		'icon-Router',
		'icon-RSS',
		'icon-Ruler-2',
		'icon-Ruler',
		'icon-Running-Shoes',
		'icon-Running',
		'icon-Safari',
		'icon-Safe-Box',
		'icon-Safe-Box2',
		'icon-Safety-PinClose',
		'icon-Safety-PinOpen',
		'icon-Sagittarus-2',
		'icon-Sagittarus',
		'icon-Sailing-Ship',
		'icon-Sand-watch',
		'icon-Sand-watch2',
		'icon-Santa-Claus',
		'icon-Santa-Claus2',
		'icon-Santa-onSled',
		'icon-Satelite-2',
		'icon-Satelite',
		'icon-Save-Window',
		'icon-Save',
		'icon-Saw',
		'icon-Saxophone',
		'icon-Scale',
		'icon-Scarf',
		'icon-Scissor',
		'icon-Scooter-Front',
		'icon-Scooter',
		'icon-Scorpio-2',
		'icon-Scorpio',
		'icon-Scotland',
		'icon-Screwdriver',
		'icon-Scroll-Fast',
		'icon-Scroll',
		'icon-Scroller-2',
		'icon-Scroller',
		'icon-Sea-Dog',
		'icon-Search-onCloud',
		'icon-Search-People',
		'icon-secound',
		'icon-secound2',
		'icon-Security-Block',
		'icon-Security-Bug',
		'icon-Security-Camera',
		'icon-Security-Check',
		'icon-Security-Settings',
		'icon-Security-Smiley',
		'icon-Securiy-Remove',
		'icon-Seed',
		'icon-Selfie',
		'icon-Serbia',
		'icon-Server-2',
		'icon-Server',
		'icon-Servers',
		'icon-Settings-Window',
		'icon-Sewing-Machine',
		'icon-Sexual',
		'icon-Share-onCloud',
		'icon-Share-Window',
		'icon-Share',
		'icon-Sharethis',
		'icon-Shark',
		'icon-Sheep',
		'icon-Sheriff-Badge',
		'icon-Shield',
		'icon-Ship-2',
		'icon-Ship',
		'icon-Shirt',
		'icon-Shoes-2',
		'icon-Shoes-3',
		'icon-Shoes',
		'icon-Shop-2',
		'icon-Shop-3',
		'icon-Shop-4',
		'icon-Shop',
		'icon-Shopping-Bag',
		'icon-Shopping-Basket',
		'icon-Shopping-Cart',
		'icon-Short-Pants',
		'icon-Shoutwire',
		'icon-Shovel',
		'icon-Shuffle-2',
		'icon-Shuffle-3',
		'icon-Shuffle-4',
		'icon-Shuffle',
		'icon-Shutter',
		'icon-Sidebar-Window',
		'icon-Signal',
		'icon-Singapore',
		'icon-Skate-Shoes',
		'icon-Skateboard-2',
		'icon-Skateboard',
		'icon-Skeleton',
		'icon-Ski',
		'icon-Skirt',
		'icon-Skrill',
		'icon-Skull',
		'icon-Skydiving',
		'icon-Skype',
		'icon-Sled-withGifts',
		'icon-Sled',
		'icon-Sleeping',
		'icon-Sleet',
		'icon-Slippers',
		'icon-Smart',
		'icon-Smartphone-2',
		'icon-Smartphone-3',
		'icon-Smartphone-4',
		'icon-Smartphone-Secure',
		'icon-Smartphone',
		'icon-Smile',
		'icon-Smoking-Area',
		'icon-Smoking-Pipe',
		'icon-Snake',
		'icon-Snorkel',
		'icon-Snow-2',
		'icon-Snow-Dome',
		'icon-Snow-Storm',
		'icon-Snow',
		'icon-Snowflake-2',
		'icon-Snowflake-3',
		'icon-Snowflake-4',
		'icon-Snowflake',
		'icon-Snowman',
		'icon-Soccer-Ball',
		'icon-Soccer-Shoes',
		'icon-Socks',
		'icon-Solar',
		'icon-Sound-Wave',
		'icon-Sound',
		'icon-Soundcloud',
		'icon-Soup',
		'icon-South-Africa',
		'icon-Space-Needle',
		'icon-Spain',
		'icon-Spam-Mail',
		'icon-Speach-Bubble',
		'icon-Speach-Bubble2',
		'icon-Speach-Bubble3',
		'icon-Speach-Bubble4',
		'icon-Speach-Bubble5',
		'icon-Speach-Bubble6',
		'icon-Speach-Bubble7',
		'icon-Speach-Bubble8',
		'icon-Speach-Bubble9',
		'icon-Speach-Bubble10',
		'icon-Speach-Bubble11',
		'icon-Speach-Bubble12',
		'icon-Speach-Bubble13',
		'icon-Speach-BubbleAsking',
		'icon-Speach-BubbleComic',
		'icon-Speach-BubbleComic2',
		'icon-Speach-BubbleComic3',
		'icon-Speach-BubbleComic4',
		'icon-Speach-BubbleDialog',
		'icon-Speach-Bubbles',
		'icon-Speak-2',
		'icon-Speak',
		'icon-Speaker-2',
		'icon-Speaker',
		'icon-Spell-Check',
		'icon-Spell-CheckABC',
		'icon-Spermium',
		'icon-Spider',
		'icon-Spiderweb',
		'icon-Split-FourSquareWindow',
		'icon-Split-Horizontal',
		'icon-Split-Horizontal2Window',
		'icon-Split-Vertical',
		'icon-Split-Vertical2',
		'icon-Split-Window',
		'icon-Spoder',
		'icon-Spoon',
		'icon-Sport-Mode',
		'icon-Sports-Clothings1',
		'icon-Sports-Clothings2',
		'icon-Sports-Shirt',
		'icon-Spot',
		'icon-Spray',
		'icon-Spread',
		'icon-Spring',
		'icon-Spurl',
		'icon-Spy',
		'icon-Squirrel',
		'icon-SSL',
		'icon-St-BasilsCathedral',
		'icon-St-PaulsCathedral',
		'icon-Stamp-2',
		'icon-Stamp',
		'icon-Stapler',
		'icon-Star-Track',
		'icon-Star',
		'icon-Starfish',
		'icon-Start2',
		'icon-Start-3',
		'icon-Start-ways',
		'icon-Start',
		'icon-Statistic',
		'icon-Stethoscope',
		'icon-stop--2',
		'icon-Stop-Music',
		'icon-Stop',
		'icon-Stopwatch-2',
		'icon-Stopwatch',
		'icon-Storm',
		'icon-Street-View',
		'icon-Street-View2',
		'icon-Strikethrough-Text',
		'icon-Stroller',
		'icon-Structure',
		'icon-Student-Female',
		'icon-Student-Hat',
		'icon-Student-Hat2',
		'icon-Student-Male',
		'icon-Student-MaleFemale',
		'icon-Students',
		'icon-Studio-Flash',
		'icon-Studio-Lightbox',
		'icon-Stumbleupon',
		'icon-Suit',
		'icon-Suitcase',
		'icon-Sum-2',
		'icon-Sum',
		'icon-Summer',
		'icon-Sun-CloudyRain',
		'icon-Sun',
		'icon-Sunglasses-2',
		'icon-Sunglasses-3',
		'icon-Sunglasses-Smiley',
		'icon-Sunglasses-Smiley2',
		'icon-Sunglasses-W',
		'icon-Sunglasses-W2',
		'icon-Sunglasses-W3',
		'icon-Sunglasses',
		'icon-Sunrise',
		'icon-Sunset',
		'icon-Superman',
		'icon-Support',
		'icon-Surprise',
		'icon-Sushi',
		'icon-Sweden',
		'icon-Swimming-Short',
		'icon-Swimming',
		'icon-Swimmwear',
		'icon-Switch',
		'icon-Switzerland',
		'icon-Sync-Cloud',
		'icon-Sync',
		'icon-Synchronize-2',
		'icon-Synchronize',
		'icon-T-Shirt',
		'icon-Tablet-2',
		'icon-Tablet-3',
		'icon-Tablet-Orientation',
		'icon-Tablet-Phone',
		'icon-Tablet-Secure',
		'icon-Tablet-Vertical',
		'icon-Tablet',
		'icon-Tactic',
		'icon-Tag-2',
		'icon-Tag-3',
		'icon-Tag-4',
		'icon-Tag-5',
		'icon-Tag',
		'icon-Taj-Mahal',
		'icon-Talk-Man',
		'icon-Tap',
		'icon-Target-Market',
		'icon-Target',
		'icon-Taurus-2',
		'icon-Taurus',
		'icon-Taxi-2',
		'icon-Taxi-Sign',
		'icon-Taxi',
		'icon-Teacher',
		'icon-Teapot',
		'icon-Technorati',
		'icon-Teddy-Bear',
		'icon-Tee-Mug',
		'icon-Telephone-2',
		'icon-Telephone',
		'icon-Telescope',
		'icon-Temperature-2',
		'icon-Temperature-3',
		'icon-Temperature',
		'icon-Temple',
		'icon-Tennis-Ball',
		'icon-Tennis',
		'icon-Tent',
		'icon-Test-Tube',
		'icon-Test-Tube2',
		'icon-Testimonal',
		'icon-Text-Box',
		'icon-Text-Effect',
		'icon-Text-HighlightColor',
		'icon-Text-Paragraph',
		'icon-Thailand',
		'icon-The-WhiteHouse',
		'icon-This-SideUp',
		'icon-Thread',
		'icon-Three-ArrowFork',
		'icon-Three-Fingers',
		'icon-Three-FingersDrag',
		'icon-Three-FingersDrag2',
		'icon-Three-FingersTouch',
		'icon-Thumb',
		'icon-Thumbs-DownSmiley',
		'icon-Thumbs-UpSmiley',
		'icon-Thunder',
		'icon-Thunderstorm',
		'icon-Ticket',
		'icon-Tie-2',
		'icon-Tie-3',
		'icon-Tie-4',
		'icon-Tie',
		'icon-Tiger',
		'icon-Time-Backup',
		'icon-Time-Bomb',
		'icon-Time-Clock',
		'icon-Time-Fire',
		'icon-Time-Machine',
		'icon-Time-Window',
		'icon-Timer-2',
		'icon-Timer',
		'icon-To-Bottom',
		'icon-To-Bottom2',
		'icon-To-Left',
		'icon-To-Right',
		'icon-To-Top',
		'icon-To-Top2',
		'icon-Token-',
		'icon-Tomato',
		'icon-Tongue',
		'icon-Tooth-2',
		'icon-Tooth',
		'icon-Top-ToBottom',
		'icon-Touch-Window',
		'icon-Tourch',
		'icon-Tower-2',
		'icon-Tower-Bridge',
		'icon-Tower',
		'icon-Trace',
		'icon-Tractor',
		'icon-traffic-Light',
		'icon-Traffic-Light2',
		'icon-Train-2',
		'icon-Train',
		'icon-Tram',
		'icon-Transform-2',
		'icon-Transform-3',
		'icon-Transform-4',
		'icon-Transform',
		'icon-Trash-withMen',
		'icon-Tree-2',
		'icon-Tree-3',
		'icon-Tree-4',
		'icon-Tree-5',
		'icon-Tree',
		'icon-Trekking',
		'icon-Triangle-ArrowDown',
		'icon-Triangle-ArrowLeft',
		'icon-Triangle-ArrowRight',
		'icon-Triangle-ArrowUp',
		'icon-Tripod-2',
		'icon-Tripod-andVideo',
		'icon-Tripod-withCamera',
		'icon-Tripod-withGopro',
		'icon-Trophy-2',
		'icon-Trophy',
		'icon-Truck',
		'icon-Trumpet',
		'icon-Tumblr',
		'icon-Turkey',
		'icon-Turn-Down',
		'icon-Turn-Down2',
		'icon-Turn-DownFromLeft',
		'icon-Turn-DownFromRight',
		'icon-Turn-Left',
		'icon-Turn-Left3',
		'icon-Turn-Right',
		'icon-Turn-Right3',
		'icon-Turn-Up',
		'icon-Turn-Up2',
		'icon-Turtle',
		'icon-Tuxedo',
		'icon-TV',
		'icon-Twister',
		'icon-Twitter-2',
		'icon-Twitter',
		'icon-Two-Fingers',
		'icon-Two-FingersDrag',
		'icon-Two-FingersDrag2',
		'icon-Two-FingersScroll',
		'icon-Two-FingersTouch',
		'icon-Two-Windows',
		'icon-Type-Pass',
		'icon-Ukraine',
		'icon-Umbrela',
		'icon-Umbrella-2',
		'icon-Umbrella-3',
		'icon-Under-LineText',
		'icon-Undo',
		'icon-United-Kingdom',
		'icon-United-States',
		'icon-University-2',
		'icon-University',
		'icon-Unlike-2',
		'icon-Unlike',
		'icon-Unlock-2',
		'icon-Unlock-3',
		'icon-Unlock',
		'icon-Up--Down',
		'icon-Up--Down3',
		'icon-Up-2',
		'icon-Up-3',
		'icon-Up-4',
		'icon-Up',
		'icon-Upgrade',
		'icon-Upload-2',
		'icon-Upload-toCloud',
		'icon-Upload-Window',
		'icon-Upload',
		'icon-Uppercase-Text',
		'icon-Upward',
		'icon-URL-Window',
		'icon-Usb-2',
		'icon-Usb-Cable',
		'icon-Usb',
		'icon-User',
		'icon-Ustream',
		'icon-Vase',
		'icon-Vector-2',
		'icon-Vector-3',
		'icon-Vector-4',
		'icon-Vector-5',
		'icon-Vector',
		'icon-Venn-Diagram',
		'icon-Vest-2',
		'icon-Vest',
		'icon-Viddler',
		'icon-Video-2',
		'icon-Video-3',
		'icon-Video-4',
		'icon-Video-5',
		'icon-Video-6',
		'icon-Video-GameController',
		'icon-Video-Len',
		'icon-Video-Len2',
		'icon-Video-Photographer',
		'icon-Video-Tripod',
		'icon-Video',
		'icon-Vietnam',
		'icon-View-Height',
		'icon-View-Width',
		'icon-Vimeo',
		'icon-Virgo-2',
		'icon-Virgo',
		'icon-Virus-2',
		'icon-Virus-3',
		'icon-Virus',
		'icon-Visa',
		'icon-Voice',
		'icon-Voicemail',
		'icon-Volleyball',
		'icon-Volume-Down',
		'icon-Volume-Up',
		'icon-VPN',
		'icon-Wacom-Tablet',
		'icon-Waiter',
		'icon-Walkie-Talkie',
		'icon-Wallet-2',
		'icon-Wallet-3',
		'icon-Wallet',
		'icon-Warehouse',
		'icon-Warning-Window',
		'icon-Watch-2',
		'icon-Watch-3',
		'icon-Watch',
		'icon-Wave-2',
		'icon-Wave',
		'icon-Webcam',
		'icon-weight-Lift',
		'icon-Wheelbarrow',
		'icon-Wheelchair',
		'icon-Width-Window',
		'icon-Wifi-2',
		'icon-Wifi-Keyboard',
		'icon-Wifi',
		'icon-Wind-Turbine',
		'icon-Windmill',
		'icon-Window-2',
		'icon-Window',
		'icon-Windows-2',
		'icon-Windows-Microsoft',
		'icon-Windows',
		'icon-Windsock',
		'icon-Windy',
		'icon-Wine-Bottle',
		'icon-Wine-Glass',
		'icon-Wink',
		'icon-Winter-2',
		'icon-Winter',
		'icon-Wireless',
		'icon-Witch-Hat',
		'icon-Witch',
		'icon-Wizard',
		'icon-Wolf',
		'icon-Woman-Sign',
		'icon-WomanMan',
		'icon-Womans-Underwear',
		'icon-Womans-Underwear2',
		'icon-Women',
		'icon-Wonder-Woman',
		'icon-Wordpress',
		'icon-Worker-Clothes',
		'icon-Worker',
		'icon-Wrap-Text',
		'icon-Wreath',
		'icon-Wrench',
		'icon-X-Box',
		'icon-X-ray',
		'icon-Xanga',
		'icon-Xing',
		'icon-Yacht',
		'icon-Yahoo-Buzz',
		'icon-Yahoo',
		'icon-Yelp',
		'icon-Yes',
		'icon-Ying-Yang',
		'icon-Youtube',
		'icon-Z-A',
		'icon-Zebra',
		'icon-Zombie',
		'icon-Zoom-Gesture',
		'icon-Zootool'	
	);
}

function ebor_get_social_icons(){
	return array(
		"socicon-500px" => "500px","socicon-8tracks" => "8tracks","socicon-airbnb" => "Airbnb","socicon-alliance" => "Alliance","socicon-amazon" => "Amazon","socicon-amplement" => "Amplement","socicon-android" => "Android","socicon-angellist" => "Angellist","socicon-apple" => "Apple","socicon-appnet" => "Appnet","socicon-baidu" => "Baidu","socicon-bandcamp" => "Bandcamp","socicon-battlenet" => "Battlenet","socicon-beam" => "Beam","socicon-bebee" => "Bebee","socicon-bebo" => "Bebo","socicon-behance" => "Behance","socicon-blizzard" => "Blizzard","socicon-blogger" => "Blogger","socicon-bloglovin" => "Bloglovin","socicon-buffer" => "Buffer","socicon-chrome" => "Chrome","socicon-coderwall" => "Coderwall","socicon-curse" => "Curse","socicon-dailymotion" => "Dailymotion","socicon-deezer" => "Deezer","socicon-delicious" => "Delicious","socicon-deviantart" => "Deviantart","socicon-diablo" => "Diablo","socicon-digg" => "Digg","socicon-discord" => "Discord","socicon-disqus" => "Disqus","socicon-douban" => "Douban","socicon-draugiem" => "Draugiem","socicon-dribbble" => "Dribbble","socicon-drupal" => "Drupal","socicon-ebay" => "Ebay","socicon-ello" => "Ello","socicon-endomodo" => "Endomodo","socicon-envato" => "Envato","socicon-etsy" => "Etsy","socicon-facebook" => "Facebook","socicon-feedburner" => "Feedburner","socicon-filmweb" => "Filmweb","socicon-firefox" => "Firefox","socicon-flattr" => "Flattr","socicon-flickr" => "Flickr","socicon-formulr" => "Formulr","socicon-forrst" => "Forrst","socicon-foursquare" => "Foursquare","socicon-friendfeed" => "Friendfeed","socicon-gamejolt" => "Gamejolt","socicon-gamewisp" => "Gamewisp","socicon-github" => "Github","socicon-goodreads" => "Goodreads","socicon-google" => "Google","socicon-googlegroups" => "Googlegroups","socicon-googlephotos" => "Googlephotos","socicon-googleplus" => "Googleplus","socicon-googlescholar" => "Googlescholar","socicon-grooveshark" => "Grooveshark","socicon-hackerrank" => "Hackerrank","socicon-hearthstone" => "Hearthstone","socicon-hellocoton" => "Hellocoton","socicon-heroes" => "Heroes","socicon-hitbox" => "Hitbox","socicon-horde" => "Horde","socicon-houzz" => "Houzz","socicon-icq" => "Icq","socicon-identica" => "Identica","socicon-imdb" => "Imdb","socicon-instagram" => "Instagram","socicon-issuu" => "Issuu","socicon-istock" => "Istock","socicon-itunes" => "Itunes","socicon-keybase" => "Keybase","socicon-lanyrd" => "Lanyrd","socicon-lastfm" => "Lastfm","socicon-line" => "Line","socicon-linkedin" => "Linkedin","socicon-livejournal" => "Livejournal","socicon-lyft" => "Lyft","socicon-macos" => "Macos","socicon-mail" => "Mail","socicon-medium" => "Medium","socicon-meetup" => "Meetup","socicon-mixcloud" => "Mixcloud","socicon-modelmayhem" => "Modelmayhem","socicon-mumble" => "Mumble","socicon-myspace" => "Myspace","socicon-newsvine" => "Newsvine","socicon-nintendo" => "Nintendo","socicon-npm" => "Npm","socicon-odnoklassniki" => "Odnoklassniki","socicon-openid" => "Openid","socicon-opera" => "Opera","socicon-outlook" => "Outlook","socicon-overwatch" => "Overwatch","socicon-patreon" => "Patreon","socicon-paypal" => "Paypal","socicon-periscope" => "Periscope","socicon-persona" => "Persona","socicon-pinterest" => "Pinterest","socicon-play" => "Play","socicon-player" => "Player","socicon-playstation" => "Playstation","socicon-pocket" => "Pocket","socicon-qq" => "Qq","socicon-quora" => "Quora","socicon-raidcall" => "Raidcall","socicon-ravelry" => "Ravelry","socicon-reddit" => "Reddit","socicon-renren" => "Renren","socicon-researchgate" => "Researchgate","socicon-residentadvisor" => "Residentadvisor","socicon-reverbnation" => "Reverbnation","socicon-rss" => "Rss","socicon-sharethis" => "Sharethis","socicon-skype" => "Skype","socicon-slideshare" => "Slideshare","socicon-smugmug" => "Smugmug","socicon-snapchat" => "Snapchat","socicon-songkick" => "Songkick","socicon-soundcloud" => "Soundcloud","socicon-spotify" => "Spotify","socicon-spreadshirt" => "Spreadshirt","socicon-stackexchange" => "Stackexchange","socicon-stackoverflow" => "Stackoverflow","socicon-starcraft" => "Starcraft","socicon-stayfriends" => "Stayfriends","socicon-steam" => "Steam","socicon-storehouse" => "Storehouse","socicon-strava" => "Strava","socicon-streamjar" => "Streamjar","socicon-stumbleupon" => "Stumbleupon","socicon-swarm" => "Swarm","socicon-teamspeak" => "Teamspeak","socicon-teamviewer" => "Teamviewer","socicon-technorati" => "Technorati","socicon-telegram" => "Telegram","socicon-trello" => "Trello","socicon-tripadvisor" => "Tripadvisor","socicon-tripit" => "Tripit","socicon-triplej" => "Triplej","socicon-tumblr" => "Tumblr","socicon-tunein" => "Tunein","socicon-twitch" => "Twitch","socicon-twitter" => "Twitter","socicon-uber" => "Uber","socicon-ventrilo" => "Ventrilo","socicon-viadeo" => "Viadeo","socicon-viber" => "Viber","socicon-viewbug" => "Viewbug","socicon-vimeo" => "Vimeo","socicon-vine" => "Vine","socicon-vkontakte" => "Vkontakte","socicon-warcraft" => "Warcraft","socicon-wechat" => "Wechat","socicon-weibo" => "Weibo","socicon-whatsapp" => "Whatsapp","socicon-wikipedia" => "Wikipedia","socicon-windows" => "Windows","socicon-wordpress" => "Wordpress","socicon-wykop" => "Wykop","socicon-xbox" => "Xbox","socicon-xing" => "Xing","socicon-yahoo" => "Yahoo","socicon-yammer" => "Yammer","socicon-yandex" => "Yandex","socicon-yelp" => "Yelp","socicon-younow" => "Younow","socicon-youtube" => "Youtube","socicon-zapier" => "Zapier","socicon-zerply" => "Zerply","socicon-zomato" => "Zomato","socicon-zynga" => "Zynga"
	);
}

/**
 * Custom Comment Markup for Stack
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_custom_comment') )){
	function ebor_custom_comment($comment, $args, $depth) { 
		$GLOBALS['comment'] = $comment; 
	?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<div class="comment">
				<div class="comment__avatar">
					<?php echo get_avatar( $comment->comment_author_email, 52 ); ?>
				</div>
				<div class="comment__body">
					<?php printf('<h5 class="type--fine-print">%s</h5>', get_comment_author()); ?>
					<div class="comment__meta">
						<span><?php echo get_comment_date(); ?></span>
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					</div>
					<?php echo wpautop( htmlspecialchars_decode( get_comment_text() ) ); ?>
					<?php if ($comment->comment_approved == '0') : ?>
						<p><em><?php esc_html_e('Your comment is awaiting moderation.', 'stack') ?></em></p>
					<?php endif; ?>	
				</div>
			</div>
		
	<?php }
}