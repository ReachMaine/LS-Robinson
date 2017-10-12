<?php /* custom functions for wp_rentals */
// over-write functions
if( !function_exists('wpestate_show_price') ):
function wpestate_show_price($post_id,$currency,$where_currency,$return=0){

    $price_label    =   '<span class="price_label">'.esc_html ( get_post_meta($post_id, 'property_label', true) ).'</span>';
    $property_price_before_label    =   esc_html ( get_post_meta($post_id, 'property_price_before_label', true) );
    $property_price_after_label     =   esc_html ( get_post_meta($post_id, 'property_price_after_label', true) );

    $price_label    =   '';
    $price_per_guest_from_one       =   floatval( get_post_meta($post_id, 'price_per_guest_from_one', true) );

    if($price_per_guest_from_one==1){
        $price          =   floatval( get_post_meta($post_id, 'extra_price_per_guest', true) );
    }else{
        $price          =   floatval( get_post_meta($post_id, 'property_price', true) );
    }

    $th_separator   =   get_option('wp_estate_prices_th_separator','');
    $custom_fields  =   get_option( 'wp_estate_multi_curr', true);



    if( !empty($custom_fields) && isset($_COOKIE['my_custom_curr']) &&  isset($_COOKIE['my_custom_curr_pos']) &&  isset($_COOKIE['my_custom_curr_symbol']) && $_COOKIE['my_custom_curr_pos']!=-1){
        $i              =   floatval($_COOKIE['my_custom_curr_pos']);
        $custom_fields  =   get_option( 'wp_estate_multi_curr', true);
        if ($price != 0) {
            $price      = $price * $custom_fields[$i][2];
            // $price      = westate_display_corection($price);
            $price      = number_format($price,2,'.',$th_separator);
            $price      = TrimTrailingZeroes($price);


            $currency   = $custom_fields[$i][1];

            if ($custom_fields[$i][3] == 'before') {
                $price = $currency . ' ' . $price;
            } else {
                $price = $price . ' ' . $currency;
            }

        }else{
            $price='';
        }
    }else{
        if ($price != 0) {
            //$price      = westate_display_corection($price);
            $price      = number_format($price,2,'.',$th_separator);
            $price      = TrimTrailingZeroes($price);
            if ($where_currency == 'before') {
                $price = $currency . $price; // zig took out space between currency & price
            } else {
                $price = $price . ' ' . $currency;
            }

        }else{
            $price='';
        }
    }



    if($return==0){
        print  $property_price_before_label.' '.$price.' '.$price_label.$property_price_after_label;
    }else{
        return  $property_price_before_label.' '.$price.' '.$price_label.$property_price_after_label;
    }
}
endif;


if( !function_exists('TrimTrailingZeroes') ):
function TrimTrailingZeroes($nbr) {
    if( strpos( $nbr,'.' )!==false  ){
        return  rtrim( rtrim($nbr,'0'), '.');
    }else{
        return $nbr;
    }
}
endif;
/**********************/
if( !function_exists('wpestate_show_price_booking') ):
function wpestate_show_price_booking($price,$currency,$where_currency,$return=0){



    $price_label='';


    $th_separator   =get_option('wp_estate_prices_th_separator','');
    $custom_fields = get_option( 'wp_estate_multi_curr', true);

    if( !empty($custom_fields) && isset($_COOKIE['my_custom_curr']) &&  isset($_COOKIE['my_custom_curr_pos']) &&  isset($_COOKIE['my_custom_curr_symbol']) && $_COOKIE['my_custom_curr_pos']!=-1){
        $i=intval($_COOKIE['my_custom_curr_pos']);
        $custom_fields = get_option( 'wp_estate_multi_curr', true);
        if ($price != 0) {
            $price      = $price * $custom_fields[$i][2];
            //$price      = westate_display_corection($price);
            $price      = number_format($price,2,'.',$th_separator);
            $price      = TrimTrailingZeroes($price);
            $currency   = $custom_fields[$i][1];

            if ($custom_fields[$i][3] == 'before') {
                $price = $currency .  $price; // zig
            } else {
                $price = $price . ' ' . $currency;
            }

        }else{
            $price='';
        }
    }else{
        if ($price != 0) {
            //$price      = westate_display_corection($price);
            $price      = ( number_format($price,2,'.',$th_separator) );
            $price      = TrimTrailingZeroes($price);

            if ($where_currency == 'before') {
                $price = $currency .  $price; // zig
            } else {
                $price = $price . ' ' . $currency;
            }

        }else{
            $price='';
        }
    }


    if($return==0){
        print  $price.' '.$price_label;
    }else{
         return $price.' '.$price_label;
    }
}
endif;
