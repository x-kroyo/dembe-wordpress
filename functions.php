<?php

    /**
     * 
     * 
     */

    function add_css_styles() {

        wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css');

    }

        /**
     * 
     * 
     */

    function add_js_scripts() {

        wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/main.js', array(), false, true);

    }
    

    add_action('wp_enqueue_scripts', 'add_css_styles');
    add_action('wp_enqueue_scripts', 'add_js_scripts');


    add_theme_support( 'woocommerce' );


    /**
     * 
     * 
     */
    function calculate_discount_percentage ($regular, $sale) {
        return -number_format(( 1 - $sale / $regular ) * 100, 2);
    }


    function loop_columns() {
        return 3; // 5 products per row
    }
    add_filter('loop_shop_columns', 'loop_columns', 999);


    // Adding slider option customizer
    add_action('customize_register', 'slider_options_customizer');

    /**
     * Add slider options to theme customizer
     *  
     * @wp_customize
     */
    function slider_options_customizer($wp_customize) {

        $wp_customize->add_panel( 'slider_panel', array(
            'priority'       => 10,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Slider Promotions', 'mytheme'),
        ) );

        // Adding section in wordpress customizer
        $wp_customize->add_section('slider_options_section', array(
            'title' => 'Slider Options',
            'panel' => 'slider_panel'
        ));

        // Create Slider Page Settings
        $wp_customize->add_setting('slider_page', array(
            'default' => 'disabled'
        ));

        
        // Create Animation Effect Settings
        $wp_customize->add_setting('slider_animation_duration', array(
            'default' => 7
        ));

        // Create Animation Effect Settings
        $wp_customize->add_setting('slider_animation_effect', array(
            'default' => 'slide'
        ));

        $wp_customize->add_control('slider_page', array(
            'label'   => 'Enable Slider/ Promotions',
            'section' => 'slider_options_section',
            'type'    => 'select',
            'description' => 'This section includes Catalog Menu, Slider and Product Promotion',
            'choices' => array(
                'front_page' => 'Front Page',
                'entire_site' => 'Entire Site',
                'disabled' => 'Disable Slider Promotions'
            )
        ));

        $wp_customize->add_control('slider_animation_duration', array(
            'label'   => 'Animation Duration (in seconds)',
            'section' => 'slider_options_section',
            'type'    => 'text',
        ));

        $wp_customize->add_control('slider_animation_effect', array(
            'label'   => 'Animation Effect',
            'section' => 'slider_options_section',
            'type'    => 'select',
            'settings'=> 'slider_animation_effect',
            'description' => __('This section includes slides effect'),
            'choices' => array(
                'slide' => 'Slide',
                'fade' => 'Fade',
            )
        ));




        // Add products promotions section
        $wp_customize->add_section('slider_products_promotions_section', array(
            'title' => 'Products Promotions',
            'panel' => 'slider_panel'
        ));

        // Create Slider Page Settings
        $wp_customize->add_setting('slider_first_product_img', array( 'default' => '' ));
        // Create Slider Page Settings
        $wp_customize->add_setting('slider_first_product_url', array( 'default' => '' ));
        // Create Slider Page Settings
        $wp_customize->add_setting('slider_second_product_img', array( 'default' => '' ));
        // Create Slider Page Settings
        $wp_customize->add_setting('slider_second_product_url', array( 'default' => '' ));
        // Create Slider Page Settings
        $wp_customize->add_setting('slider_third_product_img', array( 'default' => '' ));
        // Create Slider Page Settings
        $wp_customize->add_setting('slider_third_product_url', array( 'default' => '' ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'slider_first_product_img', array(
            'section' => 'slider_products_promotions_section',
            'label'   => 'Upload Product Image #1',
            'description' => 'Recommended Image size ( 450 X 250 )',
            'mime_type' => 'image'
        )));

        $wp_customize->add_control('slider_first_product_url', array(
            'label' => 'Enter Product Url #1',
            'type' => 'text',
            'section' => 'slider_products_promotions_section',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'slider_second_product_img', array(
            'section' => 'slider_products_promotions_section',
            'label'   => 'Upload Product Image #2',
            'description' => 'Recommended Image size ( 450 X 250 )',
            'mime_type' => 'image'
        )));

        $wp_customize->add_control('slider_second_product_url', array(
            'label' => 'Enter Product Url #2',
            'type' => 'text',
            'section' => 'slider_products_promotions_section',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'slider_third_product_img', array(
            'section' => 'slider_products_promotions_section',
            'label'   => 'Upload Product Image #3',
            'description' => 'Recommended Image size ( 450 X 250 )',
            'mime_type' => 'image'
        )));

        $wp_customize->add_control('slider_third_product_url', array(
            'label'     => 'Enter Product Url #3',
            'type'      => 'text',
            'section'   => 'slider_products_promotions_section',
        ));

    }