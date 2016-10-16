<?php

/**
 * Implements template_preprocess_html().
 */
function etc_preprocess_html(&$variables) {
}

/**
 * Implements template_preprocess_page.
 */
function etc_preprocess_page(&$variables) {
}

/**
 * Implements template_preprocess_node.
 */
function etc_preprocess_node(&$variables) {
}

function etc_links__topbar_main_menu(&$variables) {
  // We need to fetch the links ourselves because we need the entire tree.
  $links = menu_tree_output(menu_tree_all_data(variable_get('menu_main_links_source', 'main-menu')));
  $output = _zurb_foundation_links($links);
  $variables['attributes']['class'][] = 'right';
  // $variables['attributes']['id'] = 'menu';

  return '<ul' . drupal_attributes($variables['attributes']) . '>' . $output . '</ul>';
}

function etc_menu_link(array $variables) {
  //unset all the classes
  unset($variables['element']['#attributes']['class']);
  // echo '<pre>';
  // var_dump($variables);
  // echo '</pre>';

  $element = $variables['element'];
  
  $sub_menu = '';
  $element['#attributes']['class'][] = strtolower(str_replace(' ', '-', $element['#title']));

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  if (($element['#theme'] == 'menu_link__menu_social')){
    $base = base_path();
    $theme = path_to_theme();
    $title = strtolower(str_replace(' ', '-', $element['#title']));
    $svg = '<svg class="social" viewBox="0 0 512 512"><use xlink:href="'. $base.$theme.'/imgs/imgs.svg#social-' . $title . '" /></svg>';
    $output = '<a href="' . $element['#href'] . '" target="_blank" class="' . $title . '">' . $svg . '</a>';
  } else {
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  }
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
