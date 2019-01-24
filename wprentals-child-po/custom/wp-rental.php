<?php /*  custom mods for wp-rental theme */

/*  add listing number to the post  */

add_filter( 'manage_edit-estate_property_columns', 'lsr_add_property_number_column');
/**
 * Add columns to management page
 *
 * @param array $columns
 *
 * @return array
 */
function lsr_add_property_number_column( $columns ) {
  $columns['pnumber'] = __('Property Number');
  return $columns;
}

// show the property_number in the new column
add_action( 'manage_posts_custom_column' , 'lsr_property_number_columns', 10, 2 );
function lsr_property_number_columns ($column, $post_id) {
  switch ( $column ) {
		case 'pnumber':
			$prop_number = get_post_meta( $post_id, 'property-number', true );
			 if (!empty($prop_number) ){ echo $prop_number; }

			break;

	}
}
// now add the field to the quick edit
function lsr_quickedit_fields( $column_name, $post_type ) {
    ?>
    <fieldset class="inline-edit-col-right inline-edit-book">
      <div class="inline-edit-col column-<?php echo $column_name; ?>">
        <label class="inline-edit-group">
        <?php
         switch ( $column_name ) {
           case 'pnumber':
               ?><span class="title">Property Number</span><input name="property_number" /><?php
               break;
         }
        ?>
        </label>
      </div>
    </fieldset>
    <?php
}
add_action( 'quick_edit_custom_box', 'lsr_quickedit_fields', 10, 2 );

// save to DB when fill it in.
add_action( 'save_post', 'lsr_quick_edit_propertynumber' );
function lsr_quick_edit_propertynumber ($post_id) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
       return $post_id;
   }

   if ( ! current_user_can( 'edit_post', $post_id ) || 'estate_property' != $_POST['post_type'] ) {
       return $post_id;
   }
   $data = $_POST['property_number'];
   update_post_meta( $post_id, 'property-number', $data );

}
///




/* **************** */
