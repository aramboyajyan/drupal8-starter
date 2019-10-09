<?php

/**
 * @file
 * Provides and alters variables available in node templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_node().
 */
function ultima_front_preprocess_node(array &$variables) {
  // Classes for all nodes.
  $variables['attributes']['class'][] = 'node';
  $variables['attributes']['class'][] = Html::cleanCssIdentifier('node-type-' . $variables['node']->getType());
  $variables['attributes']['class'][] = Html::cleanCssIdentifier('view-mode-' . $variables['view_mode']);

  // Classes for node title.
  $variables['title_attributes']['class'][] = 'node-title';

  // Add node ID as container identifier.
  $variables['attributes']['id'] = 'node-' . $variables['node']->id();

  // Default classes for content wrapper.
  $variables['content_attributes']['class'][] = 'content';

  /**
   * Processing based on content type.
   */
  switch ($variables['node']->getType()) {
    case 'page':
      //
      break;
  }
}

