<?php

/**
 * @file
 * Provides and alters variables available in menu local task templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

/**
 * Implements hook_preprocess_menu_local_task().
 */
function ultima_front_preprocess_menu_local_task(array &$variables) {
  // Override titles of certain local menu tasks.
  $overrides = [
    'Create new account' => t('Register'),
    'Log in' => t('Login'),
    'Reset your password' => t('Reset password'),
  ];
  foreach ($overrides as $default => $override) {
    if ($variables['element']['#link']['title'] == $default) {
      $variables['link']['#title'] = $override;
    }
  }

  // Add an extra class to all local tasks.
  // $variables['element']['#link']['url']->setOption('attributes', ['class'=>'rounded']);
}
