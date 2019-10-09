<?php

/**
 * @file
 * Alters all front end forms.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_alter().
 */
function ultima_front_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  // Disable browser validation.
  $form['#attributes']['novalidate'] = 'novalidate';

  // Add clearfix class to all forms.
  $form['#attributes']['class'][] = 'clearfix';

  /**
   * Processing based on form ID.
   */
  switch ($form_id) {
    // User form: reset password.
    case 'user_pass':
      // Change the help text.
      $form['name']['#description'] = t('Further instructions will be sent to your email.');
      unset($form['mail']['#markup']);
      // Add the login link.
      $current_user = Drupal::currentUser();
      if (!$current_user->id()) {
        $form['#attributes']['class'][] = 'has-additional-link';
        $form['actions']['login'] = [
          '#title' => t('Login'),
          '#type' => 'link',
          '#url' => Url::fromRoute('user.login'),
          '#weight' => -100,
          '#prefix' => '<div class="form-additional-link">',
          '#suffix' => '</div>',
        ];
      }
      $form['actions']['submit']['#value'] = t('Reset');
      break;

    // User form: login.
    case 'user_login_form':
      // Remove unnecessary default help text.
      unset($form['name']['#description']);
      unset($form['pass']['#description']);
      // Add the reset password link.
      $form['#attributes']['class'][] = 'has-additional-link';
      $form['actions']['reset'] = [
        '#title' => t('Reset password'),
        '#type' => 'link',
        '#url' => Url::fromRoute('user.pass'),
        '#weight' => -100,
        '#prefix' => '<div class="form-additional-link">',
        '#suffix' => '</div>',
      ];
      break;

    // User form: register.
    case 'user_register_form':
      // Add the reset password link.
      $form['#attributes']['class'][] = 'has-additional-link';
      $form['actions']['reset'] = [
        '#title' => t('Reset password'),
        '#type' => 'link',
        '#url' => Url::fromRoute('user.pass'),
        '#weight' => -100,
        '#prefix' => '<div class="form-additional-link">',
        '#suffix' => '</div>',
      ];
      // Add legal line if "Terms and Conditions" and "Privacy Policy" URLs have
      // been entered in admin.
      $link_terms = theme_get_setting('ultima_front_setting_page_terms');
      $link_privacy = theme_get_setting('ultima_front_setting_page_privacy');
      if (!empty($link_terms) && !empty($link_privacy)) {
        $form['legal'] = [
          '#prefix' => '<div class="tou-wrap">',
          '#markup' => t('By clicking on "Create new account" button you agree to our <a href="@link_terms">Terms and Conditions</a> and <a href="@link_privacy">Privacy Policy</a>.', [
            '@link_terms' => $link_terms,
            '@link_privacy' => $link_privacy,
          ]),
          '#suffix' => '</div>',
          '#weight' => 50,
        ];
      }
      break;
  }
}
