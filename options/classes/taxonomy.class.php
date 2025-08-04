<?php

declare(strict_types=1);

if (! defined('ABSPATH')) {
  die;
} // Cannot access pages directly.
/**
 *
 * Taxonomy Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Taxonomy extends CSFramework_Abstract
{

  /**
   *
   * taxonomy options
   * @access public
   * @var array
   *
   */
  public array $options = [];

  /**
   *
   * instance
   * @access private
   * @var class|null
   *
   */
  private static ?self $instance = null;

  /**
   * Constructor to initialize taxonomy options and hooks.
   *
   * @param array $options
   */
  public function __construct(array $options)
  {
    $this->options = apply_filters('cs_taxonomy_options', $options);

    if (! empty($this->options)) {
      $this->addAction('admin_init', 'add_taxonomy_fields');
    }
  }

  /**
   * Get instance of the class (singleton).
   *
   * @param array $options
   * @return self|null
   */
  public static function instance(array $options = []): ?self
  {
    if (is_null(self::$instance) && CS_ACTIVE_TAXONOMY) {
      self::$instance = new self($options);
    }
    return self::$instance;
  }

  /**
   * Add taxonomy add/edit fields hooks.
   *
   * @return void
   */
  public function add_taxonomy_fields(): void
  {
    foreach ($this->options as $option) {
      $opt_taxonomy = $option['taxonomy'];
      $get_taxonomy = cs_get_var('taxonomy');

      if ($get_taxonomy === $opt_taxonomy) {
        $this->addAction($opt_taxonomy . '_add_form_fields', 'render_taxonomy_form_fields');
        $this->addAction($opt_taxonomy . '_edit_form', 'render_taxonomy_form_fields');

        $this->addAction('created_' . $opt_taxonomy, 'save_taxonomy');
        $this->addAction('edited_' . $opt_taxonomy, 'save_taxonomy');
        $this->addAction('delete_' . $opt_taxonomy, 'delete_taxonomy');
      }
    }
  }

  /**
   * Render taxonomy add/edit form fields.
   *
   * @param object|string|null $term
   * @return void
   */
  public function render_taxonomy_form_fields($term = null): void
  {
    global $cs_errors;

    $form_edit = (is_object($term) && isset($term->taxonomy)) ? true : false;
    $taxonomy  = ($form_edit) ? $term->taxonomy : $term;
    $classname = ($form_edit) ? 'edit' : 'add';
    $cs_errors = get_transient('cs-taxonomy-transient');

    wp_nonce_field('cs-taxonomy', 'cs-taxonomy-nonce');

    echo '<div class="cs-framework cs-taxonomy cs-taxonomy-' . $classname . '-fields">';

    foreach ($this->options as $option) {

      if ($taxonomy === $option['taxonomy']) {

        $tax_value = ($form_edit) ? get_term_meta($term->term_id, $option['id'], true) : '';

        foreach ($option['fields'] as $field) {

          $default    = $field['default'] ?? '';
          $elem_id    = $field['id'] ?? '';
          $elem_value = (is_array($tax_value) && isset($tax_value[$elem_id])) ? $tax_value[$elem_id] : $default;

          echo cs_add_element($field, $elem_value, $option['id']);
        }
      }
    }

    echo '</div>';
  }

  /**
   * Save taxonomy form fields.
   *
   * @param int $term_id
   * @return void
   */
  public function save_taxonomy(int $term_id): void
  {
    if (wp_verify_nonce(cs_get_var('cs-taxonomy-nonce'), 'cs-taxonomy')) {
      $errors = [];
      $taxonomy = cs_get_var('taxonomy');

      foreach ($this->options as $request_value) {
        if ($taxonomy === $request_value['taxonomy']) {
          $request_key = $request_value['id'];
          $request = cs_get_var($request_key, []);

          // ignore _nonce
          if (isset($request['_nonce'])) {
            unset($request['_nonce']);
          }

          if (isset($request_value['fields'])) {
            foreach ($request_value['fields'] as $field) {
              if (isset($field['type']) && isset($field['id'])) {
                $field_value = cs_get_vars($request_key, $field['id']);

                if ($field_value !== null) {
                  // sanitize options
                  if (isset($field['sanitize']) && $field['sanitize'] !== false) {
                    $sanitize_type = $field['sanitize'];
                  } else if (! isset($field['sanitize'])) {
                    $sanitize_type = $field['type'];
                  }

                  if (has_filter('cs_sanitize_' . $sanitize_type)) {
                    $request[$field['id']] = apply_filters('cs_sanitize_' . $sanitize_type, $field_value, $field, $request_value['fields']);
                  }

                  // validate options
                  if (isset($field['validate']) && has_filter('cs_validate_' . $field['validate'])) {
                    $validate = apply_filters('cs_validate_' . $field['validate'], $field_value, $field, $request_value['fields']);

                    if (! empty($validate)) {
                      $meta_value = get_term_meta($term_id, $request_key, true);

                      $errors[$field['id']] = array('code' => $field['id'], 'message' => $validate, 'type' => 'error');
                      $default_value = $field['default'] ?? '';
                      $request[$field['id']] = (isset($meta_value[$field['id']])) ? $meta_value[$field['id']] : $default_value;
                    }
                  }
                }
              }
            }
          }

          $request = apply_filters('cs_save_taxonomy', $request, $request_key, $term_id);

          if (empty($request)) {
            delete_term_meta($term_id, $request_key);
          } else {
            if (get_term_meta($term_id, $request_key, true)) {
              update_term_meta($term_id, $request_key, $request);
            } else {
              add_term_meta($term_id, $request_key, $request);
            }
          }
        }
      }
      set_transient('cs-taxonomy-transient', $errors, 10);
    }
  }

  /**
   * Delete taxonomy meta data.
   *
   * @param int $term_id
   * @return void
   */
  public function delete_taxonomy(int $term_id): void
  {
    $taxonomy = cs_get_var('taxonomy');

    if (! empty($taxonomy)) {
      foreach ($this->options as $request_value) {
        if ($taxonomy === $request_value['taxonomy']) {
          $request_key = $request_value['id'];
          delete_term_meta($term_id, $request_key);
        }
      }
    }
  }
}
