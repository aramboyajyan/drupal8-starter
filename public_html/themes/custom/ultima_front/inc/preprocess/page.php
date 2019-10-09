<?php

/**
 * @file
 * Provides and alters variables available in block templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_page().
 */
function ultima_front_preprocess_page(array &$variables) {
  // Set the ID of page container.
  $variables['attributes']['id'] = 'page';
}
