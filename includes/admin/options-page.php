<?php 

  function bwd_plus_plugin_options_page() {
    $options = get_option('bwd_plus_options');
    ?>
      <div class="wrap">
        <h1><?php esc_html_e('Udemy Plus Settings', 'bwd-plus' ); ?></h1>

        <?php if(isset($_GET['status']) && $_GET['status'] == 1): ?>
          <div class="notice notice-success inline">
            <p><?php esc_html_e('Settings Updated', 'bwd-plus'); ?></p>
          </div>
        <?php endif; ?>

        <form 
          novalidate="novalidate" 
          method="POST"
          action="admin-post.php"
        >
          <input type="hidden" name="action" value="bwd_plus_save_options" />
          <?php wp_nonce_field('bwd_plus_options_verify'); ?>
          <table class="form-table">
            <tbody>
              <!-- Open Graph Title -->
              <tr>
                <th>
                  <label for="bwd_plus_og_title">
                    <?php esc_html_e('Open Graph Title', 'bwd-plus'); ?>
                  </label>
                </th>
                <td>
                  <input 
                    name="bwd_plus_og_title" 
                    type="text" 
                    id="bwd_plus_og_title"
                    class="regular-text"
                    value="<?= esc_attr($options['og_title']); ?>"
                  />
                </td>
              </tr>
              <!-- Open Graph Image -->
              <tr>
                <th>
                  <label for="bwd_plus_og_image">
                    <?php esc_html_e('Open Graph Image', 'bwd-plus'); ?>
                  </label>
                </th>
                <td>
                  <input 
                    type="hidden" 
                    name="bwd_plus_og_image" 
                    id="bwd_plus_og_image" 
                    value="<?= esc_attr($options['og_image']); ?>"
                  />
                  <img 
                    id="og-img-preview"
                    src="<?= esc_attr($options['og_image']); ?>"
                  >
                  <a 
                    href="#" 
                    class="button-primary" 
                    id="og-img-btn">
                    Select Image
                  </a>
                </td>
              </tr>
              <!-- Open Graph Description -->
              <tr>
                <th>
                  <label for="bwd_plus_og_description">
                    <?php esc_html_e('Open Graph Description', 'bwd-plus'); ?>
                  </label>
                </th>
                <td>
                  <textarea 
                    id="bwd_plus_og_description" 
                    name="bwd_plus_og_description"
                    class="large-text"
                  ><?= esc_html($options['og_description']); ?></textarea>
                </td>
              </tr>
              <!-- Enable Open Graph -->
              <tr>
                <th>
                  <?php esc_html_e('Open Graph', 'bwd-plus'); ?>
                </th>
                <td>
                <label for="bwd_plus_enable_og"> 
                  <input 
                    name="bwd_plus_enable_og" 
                    type="checkbox" 
                    id="bwd_plus_enable_og" 
                    value="1"  
                    <?php checked(1, $options['enable_og']); ?>
                  /> 
                  <span>Enable</span>
                </label>
                </td>
              </tr>
            </tbody>
          </table>
          <?php submit_button(); ?>
        </form>
      </div>
    <?php
  }