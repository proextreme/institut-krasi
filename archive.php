<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package temp
 */

get_header();

$templateMap = [
    'is_main_cat' => '/template-archives/main-cat.php',
    'is_child_cat' => '/template-archives/child-cat.php'
];

$templateToInclude = __DIR__  . '/archive.php'; // Default template

if (is_category()) {
    $queriedObject = get_queried_object();
    
    foreach ($templateMap as $field => $template) {
        if (get_field($field, $queriedObject)) {
            $templateToInclude = __DIR__ . $template;
            break;
        }
    }
}

include_once $templateToInclude;

get_footer();