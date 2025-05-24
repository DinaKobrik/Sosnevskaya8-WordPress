<?php
add_action('wp_enqueue_scripts', 'sosnevskaya_styles');
add_action('wp_enqueue_scripts', 'sosnevskaya_scripts');

function sosnevskaya_styles() {
    wp_enqueue_style('sosnevskaya-style', get_stylesheet_uri());
}

function sosnevskaya_scripts() {

    $smoothScroll_script_path = get_template_directory() . '/assets/js/smoothScroll.js';
    if (file_exists($smoothScroll_script_path)) {
        wp_enqueue_script(
            'sosnevskaya-smoothScroll',
            get_template_directory_uri() . '/assets/js/smoothScroll.js',
            array(),
            null,
            true
        );
    }

    $phone_script_path = get_template_directory() . '/assets/js/modules/phone.js';
    if (file_exists($phone_script_path)) {
        wp_enqueue_script(
            'sosnevskaya-phone',
            get_template_directory_uri() . '/assets/js/modules/phone.js',
            array(),
            null,
            true
        );
    }

    $hamburger_script_path = get_template_directory() . '/assets/js/hamburger.js';
    if (file_exists($hamburger_script_path)) {
        wp_enqueue_script(
            'sosnevskaya-hamburger',
            get_template_directory_uri() . '/assets/js/hamburger.js',
            array(),
            null,
            true
        );
    }

    $preloader_script_path = get_template_directory() . '/assets/js/preloader.js';
    if (file_exists($preloader_script_path)) {
        wp_enqueue_script(
            'sosnevskaya-preloader',
            get_template_directory_uri() . '/assets/js/preloader.js',
            array(),
            null,
            true
        );
    }

    if (is_page(['home', 'progress'])) { 
        $photoscroll_script_path = get_template_directory() . '/assets/js/modules/photoScroll.js';
        if (file_exists($photoscroll_script_path)) {
            wp_enqueue_script(
                'sosnevskaya-photoscroll',
                get_template_directory_uri() . '/assets/js/modules/photoScroll.js',
                array(),
                null,
                true
            );
        }
    }

    if (is_page('home')) { 
        $slider_script_path = get_template_directory() . '/assets/js/modules/slider.js';
        if (file_exists($slider_script_path)) {
            wp_enqueue_script(
                'sosnevskaya-slider',
                get_template_directory_uri() . '/assets/js/modules/slider.js',
                array(),
                null,
                true
            );
        }
    }

    if (is_page('home')) { 
        $select_script_path = get_template_directory() . '/assets/js/modules/select.js';
        if (file_exists($select_script_path)) {
            wp_enqueue_script(
                'sosnevskaya-select',
                get_template_directory_uri() . '/assets/js/modules/select.js',
                array(),
                null,
                true
            );
        }
    }

    if (is_page('home')) { 
        $mortgage_script_path = get_template_directory() . '/assets/js/modules/mortgage.js';
        if (file_exists($mortgage_script_path)) {
            wp_enqueue_script(
                'sosnevskaya-mortgage',
                get_template_directory_uri() . '/assets/js/modules/mortgage.js',
                array(),
                null,
                true
            );
        }
    }


    if (is_page('home')) { 
        $modal_script_path = get_template_directory() . '/assets/js/modules/modal.js';
        if (file_exists($modal_script_path)) {
            wp_enqueue_script(
                'sosnevskaya-modal',
                get_template_directory_uri() . '/assets/js/modules/modal.js',
                array(),
                null,
                true
            );
        }
    }

    if (is_page('progress')) { 
        $progress_script_path = get_template_directory() . '/assets/js/progress.js';
        if (file_exists($progress_script_path)) {
            wp_enqueue_script(
                'sosnevskaya-progress',
                get_template_directory_uri() . '/assets/js/progress.js',
                array(),
                null,
                true
            );
        }
    }
    if (is_page('home')) { 
        wp_enqueue_script( 
            'sosnevskaya_scripts', 
            get_template_directory_uri() . '/assets/js/modules/validationForm.js', 
            array(), null, true 
        );
    }

    wp_localize_script('sosnevskaya_scripts', 'wpData', array(
        'ajaxUrl' => get_template_directory_uri() . '/assets/mailer/smart.php'
    ));



}

    add_theme_support('menu');

?>