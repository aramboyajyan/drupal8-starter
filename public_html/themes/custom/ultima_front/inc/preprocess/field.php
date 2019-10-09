<?php

/**
 * @file
 * Provides and alters variables available in field templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_field().
 */
function ultima_front_preprocess_field(array &$variables) {
  /**
   * Processing based on field name.
   */
  $element = $variables['element'];
  switch ($element['#field_name']) {
    // Comment fields.
    case 'comment':
      // Add extra classes.
      $variables['attributes']['class'][] = 'comments-wrap';
      $variables['content_attributes']['class'][] = 'comment-form-title';
      break;
  }
}

