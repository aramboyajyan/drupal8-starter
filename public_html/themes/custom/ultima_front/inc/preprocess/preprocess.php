<?php

/**
 * @file
 * General preprocess handler.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess().
 */
function ultima_front_preprocess(array &$variables, $hook) {
  // Add "front_page" to all templates.
  $variables['front_page'] = \Drupal::service('path.matcher')->isFrontPage();

  // Get the generator so we can create links to various pages on the site.
  $generator = \Drupal::urlGenerator();
  // Create the query so user can be returned to the current page.
  $query = ['destination' => \Drupal::service('path.current')->getPath()];
  // Login link.
  $variables['login_link'] = $generator->generateFromRoute('user.login', [], ['query' => $query]);
  // Registration link.
  $variables['register_link'] = $generator->generateFromRoute('user.register', [], ['query' => $query]);
}
