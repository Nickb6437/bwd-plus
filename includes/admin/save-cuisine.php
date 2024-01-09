<?php

 function bwd_plus_save_cuisine_meta( $term_id ) {
    if ( !isset( $_POST['bwd_plus_more_info_url'] ) ) {
        return;
    }

    update_term_meta( 
      $term_id, 
      'bwd_plus_more_info_url', 
      sanitize_url($_POST['bwd_plus_more_info_url'])
    );

 }