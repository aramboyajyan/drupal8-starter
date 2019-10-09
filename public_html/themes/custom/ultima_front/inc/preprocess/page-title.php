<?php

/**
 * @file
 * Provides and alters variables available in page title templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_page_title().
 */
function ultima_front_preprocess_page_title(array &$variables) {
  // Uncomment the following code to hide page title on the front page.
  // if (\Drupal::service('path.matcher')->isFrontPage()) {
  //  $variables['title'] = NULL;
  // }
}
