<?php

/**
 * @file
 * Provides and alters variables available in select templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_select().
 */
function ultima_front_preprocess_select(array &$variables) {
  // Uncomment the following line if you want to enable Chosen support
  // automatically for all select elements. You can also edit the code and
  // have dynamic conditions.
  // $variables['attributes']['class'][] = 'select-chosen';
}
