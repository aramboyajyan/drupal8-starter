<?php

/**
 * @file
 * Provides and alters variables available in html templates.
 *
 * Created by: Aram Boyajyan
 * https://www.aram.cz/
 */

use Drupal\Component\Utility\Html;

/**
 * Implements hook_preprocess_html().
 */
function ultima_front_preprocess_html(array &$variables) {
  /**
   * Scripts from theme settings form.
   */
  $variables['scripts_head'] = theme_get_setting('ultima_front_setting_script_head');
  $variables['scripts_body_top'] = theme_get_setting('ultima_front_setting_script_body_top');
  $variables['scripts_body_bottom'] = theme_get_setting('ultima_front_setting_script_body_bottom');

  /**
   * Add extra body classes.
   */
  // Check if this is home page.
  if (\Drupal::service('path.matcher')->isFrontPage()) {
    $variables['attributes']['class'][] = 'front';
  }
  else {
    $variables['attributes']['class'][] = 'not-front';
  }

  // Classes related to the current path.
  $current_path = \Drupal::service('path.current')->getPath();
  $path_parts = array_slice(explode('/', $current_path), 1);
  foreach ($path_parts as $element) {
    $variables['attributes']['class'][] = Html::cleanCssIdentifier('url-segment-' . $element);
  }
  switch (count($path_parts)) {
    case 1:
      $variables['attributes']['class'][] = 'url-' . $path_parts[0];
      $variables['attributes']['class'][] = 'url-current-' . $path_parts[0];
      break;
    case 2:
      $variables['attributes']['class'][] = 'url-' . $path_parts[0];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1];
      $variables['attributes']['class'][] = 'url-current-' . $path_parts[0] . '-' . $path_parts[1];
      break;
    case 3:
      $variables['attributes']['class'][] = 'url-' . $path_parts[0];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2];
      $variables['attributes']['class'][] = 'url-current-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2];
      break;
    case 4:
      $variables['attributes']['class'][] = 'url-' . $path_parts[0];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2] . '-' . $path_parts[3];
      $variables['attributes']['class'][] = 'url-current-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2] . '-' . $path_parts[3];
      break;
    case 5:
      $variables['attributes']['class'][] = 'url-' . $path_parts[0];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2] . '-' . $path_parts[3];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2] . '-' . $path_parts[3] . '-' . $path_parts[4];
      $variables['attributes']['class'][] = 'url-current-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2] . '-' . $path_parts[3] . '-' . $path_parts[4];
      break;
    case 6:
      $variables['attributes']['class'][] = 'url-' . $path_parts[0];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2] . '-' . $path_parts[3];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' . $path_parts[1] . '-' . $path_parts[2] . '-' . $path_parts[3] . '-' . $path_parts[4];
      $variables['attributes']['class'][] = 'url-' . $path_parts[0] . '-' .
        $path_parts[1] . '-' . $path_parts[2] . '-' . $path_parts[3] . '-' . $path_parts[4];
      $variables['attributes']['class'][] = 'url-current-' . $path_parts[0] .
        '-' . $path_parts[1] . '-' . $path_parts[2] . '-' . $path_parts[3] . '-' . $path_parts[4] . '-' . $path_parts[5];
      break;
  }

  // Check if this is form only page.
  $form_only_routes = [
    'user.pass',
    'user.login',
    'user.register',
  ];
  $route_name = \Drupal::routeMatch()->getRouteName();
  if (in_array($route_name, $form_only_routes)) {
    $variables['attributes']['class'][] = 'form-only-page';
  }

  // Current node related classes.
  $node = \Drupal::routeMatch()->getParameter('node');
  if ($node instanceof NodeInterface) {
    $variables['attributes']['class'][] = 'page-node';
    $variables['attributes']['class'][] = 'page-node-id-' . $node->id();
    $variables['attributes']['class'][] = 'page-node-type-' . $node->getType();
  }

  // User related classes.
  $current_user = Drupal::currentUser();
  if ($current_user->id()) {
    $variables['attributes']['class'][] = 'authenticated-user';
    // Add user ID.
    $variables['attributes']['class'][] = 'current-user-id-' . $current_user->id();
    // Add role classes.
    foreach ($current_user->getRoles() as $role) {
      $variables['attributes']['class'][] = Html::cleanCssIdentifier('user-role-' . $role);
    }
  }
  else {
    $variables['attributes']['class'][] = 'anonymous-user';
  }

  // Maintenance mode.
  if (\Drupal::state()->get('system.maintenance_mode')) {
    $variables['attributes']['class'][] = 'maintenance-mode';
  }

  // Add favicons of all different sizes.
  //
  // This is the markup we are after:
  //
  // <link rel="apple-touch-icon-precomposed" sizes="57x57" href="apple-touch-icon-57x57.png" />
  // <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114.png" />
  // <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72.png" />
  // <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144.png" />
  // <link rel="apple-touch-icon-precomposed" sizes="60x60" href="apple-touch-icon-60x60.png" />
  // <link rel="apple-touch-icon-precomposed" sizes="120x120" href="apple-touch-icon-120x120.png" />
  // <link rel="apple-touch-icon-precomposed" sizes="76x76" href="apple-touch-icon-76x76.png" />
  // <link rel="apple-touch-icon-precomposed" sizes="152x152" href="apple-touch-icon-152x152.png" />
  // <link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196" />
  // <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
  // <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
  // <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
  // <link rel="icon" type="image/png" href="favicon-128.png" sizes="128x128" />
  // <meta name="application-name" content="&nbsp;"/>
  // <meta name="msapplication-TileColor" content="#FFFFFF" />
  // <meta name="msapplication-TileImage" content="mstile-144x144.png" />
  // <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
  // <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
  // <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
  // <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />
  //
  // The markup is generated by http://www.favicomatic.com/
  // The original code file is available in img/favicons/README.md.
  $theme_path = base_path() . \Drupal::theme()->getActiveTheme()->getPath();
  $icons = [];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'apple-touch-icon-precomposed',
      'sizes' => '57x57',
      'href' => $theme_path . '/img/favicons/apple-touch-icon-57x57.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'apple-touch-icon-precomposed',
      'sizes' => '114x114',
      'href' => $theme_path . '/img/favicons/apple-touch-icon-114x114.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'apple-touch-icon-precomposed',
      'sizes' => '72x72',
      'href' => $theme_path . '/img/favicons/apple-touch-icon-72x72.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'apple-touch-icon-precomposed',
      'sizes' => '144x144',
      'href' => $theme_path . '/img/favicons/apple-touch-icon-144x144.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'apple-touch-icon-precomposed',
      'sizes' => '60x60',
      'href' => $theme_path . '/img/favicons/apple-touch-icon-60x60.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'apple-touch-icon-precomposed',
      'sizes' => '120x120',
      'href' => $theme_path . '/img/favicons/apple-touch-icon-120x120.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'apple-touch-icon-precomposed',
      'sizes' => '76x76',
      'href' => $theme_path . '/img/favicons/apple-touch-icon-76x76.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'apple-touch-icon-precomposed',
      'sizes' => '152x152',
      'href' => $theme_path . '/img/favicons/apple-touch-icon-152x152.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'icon',
      'type' => 'image/png',
      'href' => $theme_path . '/img/favicons/favicon-196x196.png',
      'sizes' => '196x196',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'icon',
      'type' => 'image/png',
      'href' => $theme_path . '/img/favicons/favicon-96x96.png',
      'sizes' => '96x96',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'icon',
      'type' => 'image/png',
      'href' => $theme_path . '/img/favicons/favicon-32x32.png',
      'sizes' => '32x32',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'icon',
      'type' => 'image/png',
      'href' => $theme_path . '/img/favicons/favicon-16x16.png',
      'sizes' => '16x16',
    ],
  ];
  $icons[] = [
    '#tag' => 'link',
    '#attributes' => [
      'rel' => 'icon',
      'type' => 'image/png',
      'href' => $theme_path . '/img/favicons/favicon-128.png',
      'sizes' => '128x128',
    ],
  ];
  $icons[] = [
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'application-name',
      'content' => '&nbsp;',
    ],
  ];
  $icons[] = [
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'msapplication-TileColor',
      'content' => '#FFFFFF',
    ],
  ];
  $icons[] = [
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'msapplication-TileImage',
      'content' => $theme_path . '/img/favicons/mstile-144x144.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'msapplication-square70x70logo',
      'content' => $theme_path . '/img/favicons/mstile-70x70.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'msapplication-square150x150logo',
      'content' => $theme_path . '/img/favicons/mstile-150x150.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'msapplication-wide310x150logo',
      'content' => $theme_path . '/img/favicons/mstile-310x150.png',
    ],
  ];
  $icons[] = [
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'msapplication-square310x310logo',
      'content' => $theme_path . '/img/favicons/mstile-310x310.png',
    ],
  ];
  // Put everything together at once.
  foreach ($icons as $key => $icon) {
    $variables['page']['#attached']['html_head'][] = [$icon, 'favicon-' . $key];
  }
}
