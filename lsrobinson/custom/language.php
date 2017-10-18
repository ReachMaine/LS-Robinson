<?php
/* languages customizations
*/
	if ( !function_exists('eai_change_theme_text') ){
		function eai_change_theme_text( $translated_text, $text, $domain ) {
			 /* if ( is_singular() ) { */
			    switch ($domain) {
						case  'our-team-by-woothemes':
								switch ( $translated_text ) {
										case 'Email ' :
											$translated_text = '<i class="fa fa-envelope"></i> ';
										break;
									}

								break;/* end our-team*/
						case 'wpestate':
						switch ( $translated_text ) {
								case 'Price per night' :
									$translated_text = 'Price';
								break;
								case 'All Sizes' :
									$translated_text = "All Area Types";
								break;
							}
						break;
					} /* end switch on domain */

	    	return $translated_text;
		}
		add_filter( 'gettext', 'eai_change_theme_text', 20, 3 );
	}

?>
