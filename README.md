# Custom Drupal package

Placeholder

## Setup

Todo

## Additional Installs

- [Drush Launcher](https://github.com/drush-ops/drush-launcher)
- [Drupal Console Launcher](https://docs.drupalconsole.com/en/getting/launcher.html)

## Todo

- Add a custom back end theme
- Add a custom front end theme
  - Use SASS
  - Setup a gulp process
  - Live reload?
  - Add basic styles used elsewhere
- Add a boilerplate main custom module
- Add w3b4 custom modules? Should these be git submodules or composer packages?
- Rename the profile to "w3b4"
- Update `.gitignore` to include only specific folders in the root
- Update README (this file)
- Development environment settings
- Settings for live / dev environment
- Create links in main menu (Home) and footer menu
- Create "About" page
- Remove "webform_node" module and the node?
- Enable `settings.local.php` in `settings.php`. Features:
  - `settings.local.php`:
    - Disable caching
    - Disable aggregation
    - Show all errors to the screen
  - `settings.live.php`:
    - Enable caching
    - Hide all errors
    - Redirect to `www` and `https` (if the site uses SSL)
- Default context for form only pages
- Add shortcuts for Drupal related tools; e.g.:
  - `drupal` should call `vendor/drupal/console/bin/drupal`
  - `drush` should call `vendor/drush/drush/drush`
  - Should npm be installed in the root or it is enough that it is in the theme?

## Theme settings

This is just as a reference; the following could be added as well:
- Social network links
- Copyright text
- URLs for "Contact" and "About" pages

## Potential additional setups

- Multilingual
  - Multilingual modules
  - Multilingual setup (?)
- Commerce
  - Commerce modules
  - Commerce setup (?)
  - Custom module for commerce things

## Ideal workflow

- Clone these files
- Create a new database
- Update `settings.local.php` with those credentials
- Open the site in browser
