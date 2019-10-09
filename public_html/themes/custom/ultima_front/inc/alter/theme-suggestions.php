<?php

/**
 * @file
 * Provides custom theme suggestions.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_theme_suggestions_alter().
 */
function ultima_front_theme_suggestions_alter(array &$suggestions, array $variables, $hook) {
  switch ($hook) {
    // Additional node template suggestions.
    case 'node':
      // Provide additional templates based on the view mode.
      if (isset($variables['elements']['#view_mode'])) {
        $suggestions[] = 'node__' . $variables['elements']['#node']->getType() . '_' . $variables['elements']['#view_mode'];
      }
      break;

    // Additional block template suggestions.
    case 'block':
      // Provide additional templates based on the block type.
      if (isset($variables['elements']['content']['#block_content'])) {
        $suggestions[] = 'block__' . $variables['elements']['content']['#block_content']->bundle();
      }
      break;
  }
}
