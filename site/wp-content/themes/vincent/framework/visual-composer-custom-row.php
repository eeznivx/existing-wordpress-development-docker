<?php
if ( function_exists('vc_add_param') ) {
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Content Position: Middle', 'vincent'),
            "param_name" => "row_content_position",
            'value' => array(
                'Default' => 'Default',
                'Top' => 'top',
                'Middle' => 'middle',
                'Bottom' => 'bottom'
            ),   
        ) 
    );
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Equal Height', 'vincent'),
            "param_name" => "row_equal_height",
            "value" => array(   
                esc_html__('No', 'vincent') => 'no',  
                esc_html__('Yes', 'vincent') => 'yes',                                                                                
            ),     
        ) 
    ); 
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Fullwidth', 'vincent'),
            "param_name" => "fullwidth",
            "value" => array(   
                esc_html__('No', 'vincent') => 'no',  
                esc_html__('Yes', 'vincent') => 'yes',                                                                                
            ),
            "description" => esc_html__("Select 'Yes' to stretch row and content", 'vincent' ),      
        ) 
    );
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Spacing Between Columns', 'vincent'),
            "param_name" => "column_spacing",
            'value' => array(
                esc_html__( 'Default', 'vincent' ) => '30',
                '0px' => '0px',
                '1px' => '1',
                '5px' => '5',
                '10px' => '10',
                '12px' => '12',
                '20px' => '20',
                '22px' => '22',
                '30px' => '30',
                '32px' => '32',
                '40px' => '40',
                '42px' => '42',
                '50px' => '50',
                '60px' => '60',
                '70px' => '70',
                '80px' => '80',
                '90px' => '90',
            ),
            'dependency' => array( 'element' => 'fullwidth', 'value' => 'no' ),
        ) 
    );
    vc_add_param(
        'vc_row',
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Enable Aside Image for Row?', 'vincent' ),
            'param_name' => 'img_halfrow',
            'description' => esc_html__( 'Put a image left or right side of row', 'vincent' ),
            'value' => array( esc_html__( 'Yes', 'vincent' ) => 'yes' ),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image', 'vincent' ),
            'param_name' => 'halfrow_image',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'vincent' ),
            'dependency' => array(
                'element' => 'img_halfrow',
                'not_empty' => true,
            ),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Columns image', 'vincent' ),
            'param_name' => 'img_columns',
            'value' => array(
                esc_html__( 'Default', 'vincent' ) => '',
                esc_html__( 'Image on 3 Columns', 'vincent' ) => '3columns',
                esc_html__( 'Image on 4 Columns', 'vincent' ) => '4columns',
                esc_html__( 'Image on 5 Columns', 'vincent' ) => '5columns',
                esc_html__( 'Image on 6 Columns', 'vincent' ) => '6columns',
                esc_html__( 'Image on 7 Columns', 'vincent' ) => '7columns',
            ),
            'description' => esc_html__( 'Select columns position within row.', 'vincent' ),
            'dependency' => array(
                'element' => 'img_halfrow',
                'not_empty' => true,
            ),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Image position', 'vincent' ),
            'param_name' => 'img_position',
            'value' => array(
                esc_html__( 'Default', 'vincent' ) => '',
                esc_html__( 'Image on Left Row', 'vincent' ) => 'imgleft',
                esc_html__( 'Image on Right Row', 'vincent' ) => 'imgright',                
            ),
            'description' => esc_html__( 'Select Image position within row.', 'vincent' ),
            'dependency' => array(
                'element' => 'img_halfrow',
                'not_empty' => true,
            ),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Image Offset Top', 'vincent'),
            "param_name" => "img_offset_top",
            'value' => array(
                esc_html__( 'Default', 'vincent' ) => '',
                '50px' => '50px',
                '60px' => '60px',
                '70px' => '70px',
                '80px' => '80px',
                '90px' => '90px',
                '100px' => '100px',
                '110px' => '110px',
                '120px' => '120px',
                '130px' => '130px',
                '140px' => '140px',
                '150px' => '150px',
                '160px' => '160px',
                '170px' => '170px',
                '180px' => '180px',
                '190px' => '190px',
                '200px' => '200px',
                '210px' => '210px',
                '220px' => '220px',
                '230px' => '230px',
                '240px' => '240px',
                '250px' => '250px',
            ),
            'dependency' => array(
                'element' => 'img_halfrow',
                'not_empty' => true,
            ), 
        ) 
    );
    vc_add_param(
        'vc_row',
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Parallax X', 'vincent'),
            'param_name' => 'parallax_x',
            'description'   => esc_html__('X axis translation.', 'vincent'),
            'dependency' => array(
                'element' => 'img_halfrow',
                'not_empty' => true,
            ),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Parallax Y', 'vincent'),
            'param_name' => 'parallax_y',
            'description'   => esc_html__('Y axis translation.', 'vincent'),
            'dependency' => array(
                'element' => 'img_halfrow',
                'not_empty' => true,
            ),
        )
    );
}

if ( function_exists('vc_remove_param') ) {
    vc_remove_param( "vc_row", "full_width" );
    vc_remove_param( "vc_row", "content_placement" );
    vc_remove_param( "vc_row", "equal_height" );
    vc_remove_param( "vc_row", "full_height" );
    vc_remove_param( "vc_row", "video_bg" );
    vc_remove_param( "vc_row", "video_bg_parallax" );
    vc_remove_param( "vc_row", "video_bg_url" );
    vc_remove_param( "vc_row", "parallax_speed_bg" );
    vc_remove_param( "vc_row", "parallax_speed_video" );
    vc_remove_param( "vc_row", "columns_placement" );
    vc_remove_param( "vc_row", "gap" );
    vc_remove_param( 'vc_row_inner', 'gap' );
    vc_remove_param( 'vc_row_inner', 'equal_height' );
    vc_remove_param( 'vc_row_inner', 'content_placement' );
    vc_remove_param( "vc_column", "css_animation" ); 
}    