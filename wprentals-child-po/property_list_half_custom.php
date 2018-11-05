<?php
// Template Name: Properties list half custom list
// Wp Estate Pack

get_header();
if (isset($_GET['property'])) {
  $lsr_property_list = $_GET['property'];
} else {
  //Handle the case where there is no parameter
  $lsr_property_list = "";
}
$options        =   wpestate_page_details($post->ID);
$filtred        =   0;
$compare_submit =   wpestate_get_template_link('compare_listings.php');


// get curency , currency position and no of items per page
$current_user = wp_get_current_user();
$currency                   =   esc_html( wprentals_get_option('wp_estate_currency_label_main', '') );
$where_currency             =   esc_html( wprentals_get_option('wp_estate_where_currency_symbol', '') );
$prop_no                    =   intval( wprentals_get_option('wp_estate_prop_no', '') );

$show_featured_only                     = get_post_meta($post->ID, 'show_featured_only', true);
$show_filter_area                       = get_post_meta($post->ID, 'show_filter_area', true);


if ($lsr_property_list) {
  $args = array(
      'post_type'         => 'estate_property',
      'post_status'       => 'publish',
      'meta_key'          => 'property-number',
      'meta_value'        => $lsr_property_list,
      'meta_compare'      => 'IN',
  );
  $prop_selection = new WP_Query($args);
  //echo "<pre>"; var_dump($prop_selection); echo "</pre>";

  get_template_part('templates/half_map_core');
} else {
  echo "<p>No properties selected.";
}


if ( wp_script_is( 'wpestate_googlecode_regular', 'enqueued' ) ) {

    $mapargs                    =   $args;
    $max_pins                   =   intval( wprentals_get_option('wp_estate_map_max_pins') );
    $mapargs['posts_per_page']  =   $max_pins;
    $mapargs['offset']          =   ($paged-1)*$prop_no;
    $mapargs['fields']          =   'ids';



    $transient_appendix.='_maxpins'.$max_pins.'_offset_'.($paged-1)*$prop_no;
    $selected_pins  =   wpestate_listing_pins($transient_appendix,1,$mapargs,1,1);//call the new pins
    wp_localize_script('wpestate_googlecode_regular', 'googlecode_regular_vars2',
        array('markers2'          =>  $selected_pins));
}
get_footer();
?>
