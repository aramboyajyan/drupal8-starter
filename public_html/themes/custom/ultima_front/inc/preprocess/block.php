<?php

/**
 * @file
 * Provides and alters variables available in block templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

use Drupal\block\Entity\Block;

/**
 * Implements hook_preprocess_block().
 */
function ultima_front_preprocess_block(array &$variables) {
  $block = Block::load($variables['elements']['#id']);

  // Add CSS classes based on the block information.
  $variables['attributes']['class'][] = 'block';
  $variables['attributes']['class'][] = 'plugin-' . $variables['plugin_id'];
  $variables['attributes']['class'][] = 'id-' . $variables['configuration']['id'];

  /**
   * Processing based on the region.
   */
  switch ($block->getRegion()) {
    // Blocks in the content region.
    case 'content':
      $variables['attributes']['class'][] = 'container';
      break;
  }
}
