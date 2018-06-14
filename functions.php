<?php
/**
 * Qohelet functions and definitions
 *
 * @package Qohelet
 * @since Qohelet 0.0.1
 */

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

 	
function columcille_enqueue_styles() {
 
    $parent_style = 'qohelet-style';
    $mycurtheme = wp_get_theme();
    $myparenttheme = wp_get_theme($mycurtheme->get('Template'));
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css',array(), $myparenttheme->get('Version') );
    wp_enqueue_style( 'columcille-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        $mycurtheme->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'columcille_enqueue_styles' );

function clm_mini_page_content($clmpageid) {
    
    $content_post = get_post($clmpageid);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function clm_mini_page_excerpt($clmpageid) {
    $content_post = get_post($clmpageid);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    
    return substr($content, 0, 155);
}
function clm_mini_page_title($clmpageid) {
    $content_post = get_post($clmpageid);
    $output =  apply_filters( 'the_title', $content_post->post_title );
    return $output;
}
function clm_mini_page_display($clmpageid=NULL) {
    if (($clmpageid==NULL) || (FALSE === get_post_status($clmpageid))) {
        return "<p>There is no page to show here</p>";
    } else {
        $output = '<h1><a href="'.get_permalink($clmpageid).'">'.clm_mini_page_title($clmpageid).'</a></h1>';
        $output .= clm_mini_page_excerpt($clmpageid);
        $output .= ' <a href="'.get_permalink($clmpageid).'">(Read on...)</a>';
        return $output;
    }
}

function columcille_special_options() {
    // initialize the options
    $output = '';
    $panel1 = trim(of_get_option('hp_p1'));
    $panel2 = trim(of_get_option('hp_p2'));
    $panel3 = trim(of_get_option('hp_p3'));
    $outputarray =array();
    $outputarray[1] = $panel1;
    $outputarray[2] = $panel2;
    $outputarray[3] = $panel3;
    
    return $outputarray;
    
    
    
    
} // end function columcille_special_options
	
function columcille_panels_sections( $wp_customize ) {
     /**
     * Add Panel
     */
    $ocws_panel_theme = wp_get_theme();	
    
    $wp_customize->add_panel( 'columcille_panel', array(
      'priority'    => 10,
      'title'       => __( $ocws_panel_theme->get('Name').' Special Features', 'columcille' ),
      'description' => __( 'Kirki integration for Qohelet demo', 'columcille' ),
     ) );
    
    /**
     * Add a Section for Preview Panel 1
     */
     $wp_customize->add_section( 'columcille_preview_panel_1', array(
      'title'       => __( 'Preview Panel 1', 'columcille' ),
      'priority'    => 10,
      'panel'       => 'columcille_panel',
      'description' => __( 'Section in development: this section is not yet able to make the changes shown.', 'qohelet' ),
     ) );
    
    
} // end function columcille_panels_sections

add_action( 'customize_register', 'columcille_panels_sections' );

function columcille_fields( $fields ) {
      
     
    /**
    * Add a Field to change the footer text only if checkbox is checked
    */
    $fields[] = array(
        'type'        => 'textarea',
        'setting'     => 'columcille_preview_panel_1',
        'label'       => __( 'Preview Panel 1', 'columcille' ),
        'description' => __( 'Add some text to the footer', 'columcille' ),
        'section'     => 'columcille_preview_panel_1',
        'default'     => ' Theme – Kirki Toolkit Demo',
        'priority'    => 20,
      
    );
      
      return $fields;
} // end function columcille_fields
add_filter( 'kirki/fields', 'columcille_fields' );
	
	

 
 
 ?>
