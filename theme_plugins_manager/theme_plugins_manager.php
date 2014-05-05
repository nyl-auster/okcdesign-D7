<?php
/**
 * To let user choose how different parts of Drupal are affected
 * by foundation framework, we use a system of "plugin".
 *
 * Template.php implements all existing hooks and asked all plugins
 * if the have something to do in this hook. So a plugin can talk to
 * several hook.
 *
 * A plugin is simply a class, each method name MUST be exactly the name
 * of corresponding hook in template.php
 */

spl_autoload_register('okcdesign_plugins_autoloader');

function okcdesign_plugins_autoloader($class_name) {
  $file = drupal_get_path('theme', 'okcdesign') . "/" . theme_get_setting('okcdesign_plugins_directory') . "/$class_name.php";
  if (is_readable($file)) {
    include_once $file;
  }
}

/**
 * Return registered plugins
 * @return mixed
 */
function theme_get_plugins() {

  static $plugins = array();
  if ($plugins) return $plugins;

  $themes = list_themes();
  $theme = $themes['okcdesign'];
  if (!empty($theme->info['theme_plugins'])) {
    $plugins = $theme->info['theme_plugins'];
    // add required plugins in our array.
    foreach ($plugins as $id => $plugin) {
      $plugins[$id]['required_by_plugins'] = theme_get_required_by_plugins($id);
    }
  }
  return $plugins;
}

/**
 * Tell us if a okcdsign plug is enabled
 * @param $plugin : plugin id, as declared in theme info file.
 * @return bool
 */
function theme_plugin_is_enabled($plugin) {
  $result = theme_get_setting("theme_plugin_$plugin");
  return $result ? TRUE : FALSE;
}

/**
 * Return enabled plugins.
 * @return array
 */
function theme_plugin_get_enabled_plugins() {
  $enabled = array();
  $plugins = theme_get_plugins();
  foreach($plugins as $id => $datas) {
    if (theme_get_setting("theme_plugin_$id")) {
      $enabled[$id] = $id;
    }
  }
  return $enabled;
}

/**
 * Invoke all plugins for a specific drupal hook. It will look for all
 * plugins responding to a hook and call them.
 *
 * For preprocess, variables are passed by reference so several plugins
 * may respond to one hook.
 * For theme functions, only one can be called as we need a return statement
 * to render html; so one a result is return, we return it and other plugins
 * are not called.
 */
function theme_plugins_invoke($hook, &$arg1 = array(), &$arg2 = array(), &$arg3 = array(), &$arg4 = array()) {

  $plugins = theme_get_plugins();
  $plugins_enabled = theme_plugin_get_enabled_plugins();

  // plug in only enabled plugins.
  foreach ($plugins_enabled  as $plugin_id) {
    // get full plugin infos from info file.
    $plugin_infos = $plugins[$plugin_id];
    // plugin id is corresponding file / class name.
    $class = $plugin_id;
    // for okcdesign_preprocess_page, call method hook_preprocess_page() in plugin class.
    $method = str_replace('okcdesign' . '', 'hook', $hook);
    // if plugins declared a method to fire for this particular hook, call it.
    if (in_array($method, $plugin_infos['hooks'])) {
      $plugin = new $class();
      $result = $plugin->$method($arg1, $arg2, $arg3, $arg4);
      // if we have a return, this is a theme function returning html,
      // we have to return it to Drupal.
      if ($result) return $result;
    }
  }

}

/**
 * Return dependencie for a given plugin
 * @param $plugin_id
 *   machine name of the plugin, as defined in theme info file.
 * @return array()
 *    array of plugin dependencies or empty array if no dependencies are found.
 */
function theme_get_required_by_plugins($plugin_id) {
  $plugins = theme_get_plugins();
  $required_by_plugins = array();
  foreach ($plugins as $id => $plugin) {
    if (isset($plugin['dependencies'])) {
      foreach ($plugin['dependencies'] as $dependency) {
        if ($dependency == $plugin_id) {
          $required_by_plugins[$id] = $plugins[$id];
        }
      }
    }
  }
  return $required_by_plugins;
}
