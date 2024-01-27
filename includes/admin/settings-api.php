<?php

use function FakerPress\register;

  function bwd_plus_setting_api() {
    register_setting('bwd_plus_options_group', 'bwd_plus_options'); // register settings group

    add_settings_section(
      'bwd_plus_options_section',
      __('BWD Plus Settings', 'bwd-plus'),
      'bwd_plus_options_section_callback',
      'bwd_plus_options_page'
    ); // add settings section

    add_settings_field(
      'og_ttile_input',
      __('Open Graph Title', 'bwd-plus'),
      'og_title_input_callback',
      'bwd_plus_options_page',
      'bwd_plus_options_section'
    ); // add settings field

    add_settings_field(
      'og_image_input',
      __('Open Graph Image', 'bwd-plus'),
      'og_image_input_callback',
      'bwd_plus_options_page',
      'bwd_plus_options_section'
    ); // add settings field

    add_settings_field(
      'og_description_input',
      __('Open Graph Description', 'bwd-plus'),
      'og_description_input_callback',
      'bwd_plus_options_page',
      'bwd_plus_options_section'
    ); // add settings field

    add_settings_field(
      'og_enable_input',
      __('Open Graph Enable', 'bwd-plus'),
      'og_enable_input_callback',
      'bwd_plus_options_page',
      'bwd_plus_options_section'
    ); // add settings field
  }

  function og_title_input_callback() {
    $options = get_option('bwd_plus_options');
    $og_title = $options['og_title'] ?? '';
    ?>
    <input 
      type="text"
      class="regular-text" 
      name="bwd_plus_options[og_title]" 
      id="bwd_plus_og_title"
      value="<?= esc_attr($og_title)?> "
    />
    <?php
  }

  function og_image_input_callback() {
    $options = get_option('bwd_plus_options');
    $og_image = $options['og_image'] ?? '';
    ?>
    <input 
      type="hidden"
      name="bwd_plus_options[og_image]" 
      id="bwd_plus_og_image"
      value="<?= esc_attr($og_image)?> "
    />
    <img 
      src="<?= esc_attr($og_image)?>"
      id="og-img-preview"
    >
    <a href="#" class="button-primary" 
      id="og-img-btn">
      Select Image
    </a>
    <?php
  }

  function og_description_input_callback() {
    $options = get_option('bwd_plus_options');
    $og_description = $options['og_description'] ?? '';
    ?>
    <textarea 
      class="large-text" 
      name="bwd_plus_options[og_description]" 
      id="bwd_plus_og_description"
    ><?= esc_html($og_description)?></textarea>
    <?php
  }

  function og_enable_input_callback() {
    $options = get_option('bwd_plus_options');
    $og_enable = $options['enable_og'] ?? '';
    ?>
    <label for="bwd_plus_og_enable">
      <input 
        type="checkbox"
        name="bwd_plus_options[enable_og]" 
        id="bwd_plus_enable_og"
        value="1"
        <?= checked(1, $og_enable, false) ?>
      />
      <span class="description">
        <?= __('Enable Open Graph', 'bwd-plus') ?>
      </span>
    </label>
    <?php
  }

  function bwd_plus_options_section_callback() {
    echo __('An alternative form for updateing options with the settings API.', 'bwd-plus');
  }