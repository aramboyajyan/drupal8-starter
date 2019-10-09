<?php

/**
 * @file
 * Provides theme settings form.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function ultima_front_form_system_theme_settings_alter(&$form, FormStateInterface $form_state) {
  /**
   * Settings for third party scripts.
   */
  $form['ultima_front_settings_scripts'] = [
    '#type' => 'details',
    '#title' => t('Scripts'),
    '#open' => TRUE,
  ];
  $form['ultima_front_settings_scripts']['ultima_front_setting_script_head'] = [
    '#type' => 'textarea',
    '#title' => t('Head scripts'),
    '#description' => t('Enter the code that you want to be included within the head HTML tag.'),
    '#default_value' => theme_get_setting('ultima_front_setting_script_head'),
  ];
  $form['ultima_front_settings_scripts']['ultima_front_setting_script_body_top'] = [
    '#type' => 'textarea',
    '#title' => t('Body scripts (top)'),
    '#description' => t('Enter the code that you want to be included at the beginning of the body HTML tag.'),
    '#default_value' => theme_get_setting('ultima_front_setting_script_body_top'),
  ];
  $form['ultima_front_settings_scripts']['ultima_front_setting_script_body_bottom'] = [
    '#type' => 'textarea',
    '#title' => t('Body scripts (bottom)'),
    '#description' => t('Enter the code that you want to be included at the bottom of the body HTML tag.'),
    '#default_value' => theme_get_setting('ultima_front_setting_script_body_bottom'),
  ];

  /**
   * Settings for pages.
   */
  $form['ultima_front_settings_pages'] = [
    '#type' => 'details',
    '#title' => t('Pages'),
    '#open' => TRUE,
  ];
  $form['ultima_front_settings_pages']['ultima_front_setting_page_terms'] = [
    '#type' => 'textfield',
    '#title' => t('Terms of Use'),
    '#description' => t('Enter the URL of the page that contains Terms of Use. Link to this page will be displayed on the user registration form.'),
    '#default_value' => theme_get_setting('ultima_front_setting_page_terms'),
  ];
  $form['ultima_front_settings_pages']['ultima_front_setting_page_privacy'] = [
    '#type' => 'textfield',
    '#title' => t('Privacy Policy'),
    '#description' => t('Enter the URL of the page that contains Privacy Policy. Link to this page will be displayed on the user registration form.'),
    '#default_value' => theme_get_setting('ultima_front_setting_page_privacy'),
  ];
}
