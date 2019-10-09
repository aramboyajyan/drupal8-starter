<?php

/**
 * @file
 * Provides and alters variables available in menu templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_menu().
 */
function ultima_front_preprocess_menu(array &$variables) {
  // Add clearfix class to all menus.
  $variables['attributes']['class'][] = 'clearfix';
}
