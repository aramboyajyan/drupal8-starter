<?php

/**
 * @file
 * Provides and alters variables available in region templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_region().
 */
function ultima_front_preprocess_region(array &$variables) {
  // Add extra classes.
  $variables['attributes']['class'][] = 'region';
  $variables['attributes']['class'][] = $variables['region'];
}
