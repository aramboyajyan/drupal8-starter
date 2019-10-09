<?php

/**
 * @file
 * Provides and alters variables available in comment templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_comment().
 */
function ultima_front_preprocess_comment(array &$variables) {
  $comment = $variables['elements']['#comment'];
  $author = User::load($comment->getOwnerId());

  // Add extra classes.
  $variables['attributes']['class'][] = 'comment';

  // Provide new variable for storing the comment author name.
  $variables['author_name'] = $author->getDisplayName();

  // Provide new variable for storing the comment posted date.
  $variables['posted_date'] = \Drupal::service('date.formatter')->format($comment->getCreatedTime(), 'custom', 'd/m/Y H:i:s');
}
