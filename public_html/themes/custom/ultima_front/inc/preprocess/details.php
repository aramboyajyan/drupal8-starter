<?php

/**
 * @file
 * Provides and alters variables available in details templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_details().
 */
function ultima_front_preprocess_details(array &$variables) {
  // Add extra classes to the details wrapper and summary element.
  $variables['attributes']['class'][] = 'details';
  $variables['summary_attributes']['class'] = 'summary';
}
