<?php

  function bwd_plus_add_cuisine_fields() {
    ?>
      <div class="form-field">
        <label 
          for="bwd_plus_more_info_url"
        >
          <?php _e( 'More Info URL', 'bwd-plus' ); ?>
        </label>
        <input 
          type="text" 
          name="bwd_plus_more_info_url" 
          id="bwd_plus_more_info_url"
        >
        <p>
          <?php _e( 'Enter a url for this cuisine, so the user can learn more about this cuisine', 'bwd-plus' ); ?>
        </p>
      </div>

    <?php
  }

  function bwd_plus_edit_cuisine_fields ($term) {
    $url = get_term_meta( 
      $term->term_id, 
      'bwd_plus_more_info_url', 
      true 
    );
    ?>

      <tr class="form-field">
        <th scope="row">
          <label 
            for="bwd_plus_more_info_url"
          >
            <?php _e( 'More Info URL', 'bwd-plus' ); ?>
          </label>
        </th>
        <td>
          <input 
            type="text" 
            name="bwd_plus_more_info_url" 
            id="bwd_plus_more_info_url"
            value="<?= $url; ?>"
          >
          <p class="description">
            <?php _e( 'Enter a url for this cuisine, so the user can learn more about this cuisine', 'bwd-plus' ); ?>
          </p>
        </td>
      </tr>

    <?php
  }