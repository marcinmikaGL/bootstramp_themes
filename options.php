<?php

function optionsframework_options() {
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
    }

    $options = array();

    $options[] = array(
            'name' => __('Basic Settings', 'woordpress-bootsrap'),
            'type' => 'heading');

    return $options;
}


function optionsframework_option_name() {
    $themename = get_option( 'stylesheet' );
    $themename = preg_replace("/\W/", "_", strtolower($themename) );

    $optionsframework_settings = get_option( 'optionsframework' );
    $optionsframework_settings['id'] = $themename;
    update_option( 'optionsframework', $optionsframework_settings );
}