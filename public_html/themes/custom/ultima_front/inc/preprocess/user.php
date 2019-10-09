<?php

/**
 * @file
 * Provides and alters variables available in user templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_user().
 */
function ultima_front_preprocess_user(array &$variables) {
  // Add extra classes.
  $variables['attributes']['class'][] = 'profile';
}
