<?php

/**
 * @file
 * Enables modules and site configuration for a standard site installation.
 *
 * Created by: VARBO CORPORATION s.r.o.
 * https://www.varbo.eu/
 */

use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Implements hook_form_FORM_ID_alter() for install_configure_form().
 *
 * Allows the profile to alter the site configuration form.
 */
function custom_profile_form_install_configure_form_alter(&$form, FormStateInterface $form_state) {
  // Check if the admin wants to automatically create new pages.
  $form['pages'] = [
    '#type' => 'fieldset',
    '#title' => t('Create Pages'),
    '#description' => t('Select which pages you want the system to create automatically.')
  ];
  $form['pages']['page_home'] = [
    '#type' => 'checkbox',
    '#title' => t('Home page'),
  ];
  $form['pages']['page_privacy'] = [
    '#type' => 'checkbox',
    '#title' => t('Privacy Policy'),
  ];
  $form['pages']['page_terms'] = [
    '#type' => 'checkbox',
    '#title' => t('Terms of Use'),
  ];
  $form['pages']['page_404'] = [
    '#type' => 'checkbox',
    '#title' => t('Page Not Found'),
  ];
  $form['pages']['page_403'] = [
    '#type' => 'checkbox',
    '#title' => t('Access Denied'),
  ];
  $form['pages']['page_contact'] = [
    '#type' => 'checkbox',
    '#title' => t('Contact (webform)'),
  ];
  // Add our custom submit handler for creating the pages.
  $form['#submit'][] = 'custom_profile_install_pages_submit';
}

/**
 * Submit callback for install_configure_form() that creates new pages.
 */
function custom_profile_install_pages_submit($form, FormStateInterface $form_state) {
  // Home page.
  if ($form_state->getValue('page_home')) {
    // Create the node.
    $node = Node::create([
      'uid' => 1,
      'type' => 'page',
      'title' => 'Home',
      'status' => NodeInterface::PUBLISHED,
      'body' => ['value' => '<p>Welcome!</p>', 'format' => 'full_html'],
    ]);
    $node->save();
    // Set it as the default page.
    \Drupal::configFactory()
      ->getEditable('system.site')
      ->set('page.front', '/node/' . $node->id())
      ->save(TRUE);
    // Show the message.
    \Drupal::messenger()->addMessage(t('Home page has been successfully created. It has also been set as the front page of the site.'));
  }

  // Privacy Policy page.
  if ($form_state->getValue('page_privacy')) {
    // Create the node.
    $node = Node::create([
      'uid' => 1,
      'type' => 'page',
      'title' => 'Privacy Policy',
      'status' => NodeInterface::PUBLISHED,
      // Taken from the default WordPress website.
      'body' => ['value' => '<p>This page has been automatically generated. You should edit the content here to reflect your own Privacy Policy.</p><h2>Who we are</h2><p>Placeholder</p><h2>What personal data we collect and why</h2><p>Placeholder</p><h2>Cookies</h2><p>Placeholder</p><h2>Embedded content from other websites</h2><p>Pages or articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p><p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p><h2>Analytics</h2><p>Placeholder</p><h2>How long we retain your data</h2><p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p><h2>What rights you have over your data</h2><p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p><h2>Where we send your data</h2><p>Visitor comments may be checked through an automated spam detection service.</p><h2>Your contact information</h2><p>Placeholder</p><h2>Additional information</h2><p>Placeholder</p><h3>How we protect your data</h3><p>Placeholder</p><h3>What data breach procedures we have in place</h3><p>Placeholder</p><h3>What third parties we receive data from</h3><p>Placeholder</p><h3>What automated decision making and/or profiling we do with user data</h3><p>Placeholder</p><h3>Industry regulatory disclosure requirements</h3><p>Placeholder</p>', 'format' => 'full_html'],
    ]);
    $node->save();
    // Show the message.
    \Drupal::messenger()->addMessage(t('@page page has been successfully created.', [
      '@page' => 'Privacy Policy',
    ]));
  }

  // Terms of Use page.
  if ($form_state->getValue('page_terms')) {
    // Create the node.
    $node = Node::create([
      'uid' => 1,
      'type' => 'page',
      'title' => 'Terms of Use',
      'status' => NodeInterface::PUBLISHED,
      'body' => ['value' => '<p>Placeholder.</p>', 'format' => 'full_html'],
    ]);
    $node->save();
    // Show the message.
    \Drupal::messenger()->addMessage(t('@page page has been successfully created.', [
      '@page' => 'Terms of Use',
    ]));
  }

  // Page Not Found page.
  if ($form_state->getValue('page_404')) {
    // Create the node.
    $node = Node::create([
      'uid' => 1,
      'type' => 'page',
      'title' => 'Page Not Found',
      'status' => NodeInterface::PUBLISHED,
      'body' => ['value' => '<p>The page you requested could not be found on this website. You may have clicked on an expired link or used an old bookmark.</p><p><a href="' . Url::fromRoute('<front>')->toString() . '">Click here</a> to go back to our front page.</p>', 'format' => 'full_html'],
    ]);
    $node->save();
    // Set it as the 404 page.
    \Drupal::configFactory()
      ->getEditable('system.site')
      ->set('page.404', '/node/' . $node->id())
      ->save(TRUE);
    // Show the message.
    \Drupal::messenger()->addMessage(t('@page page has been successfully created.', [
      '@page' => 'Page Not Found',
    ]));
  }

  // Access Denied page.
  if ($form_state->getValue('page_403')) {
    // Create the node.
    $node = Node::create([
      'uid' => 1,
      'type' => 'page',
      'title' => 'Access Denied',
      'status' => NodeInterface::PUBLISHED,
      'body' => ['value' => '<p>You do not have sufficient permissions to access this page. If you are not logged in, please login and try again.</p>', 'format' => 'full_html'],
    ]);
    $node->save();
    // Set it as the 403 page.
    \Drupal::configFactory()
      ->getEditable('system.site')
      ->set('page.403', '/node/' . $node->id())
      ->save(TRUE);
    // Show the message.
    \Drupal::messenger()->addMessage(t('@page page has been successfully created.', [
      '@page' => 'Access Denied',
    ]));
  }

  // Webform page.
  if ($form_state->getValue('page_contact')) {
    // Create the node.
    $node = Node::create([
      'uid' => 1,
      'type' => 'webform',
      'title' => 'Contact',
      'status' => NodeInterface::PUBLISHED,
    ]);
    $node->save();
    // Show the message.
    \Drupal::messenger()->addMessage(t('@page page has been successfully created. It has no fields at the moment so you have to create them yourself.', [
      '@page' => 'Contact',
    ]));
  }
}
