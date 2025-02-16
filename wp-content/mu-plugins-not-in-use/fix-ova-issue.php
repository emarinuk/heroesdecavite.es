<?php
/**
 * Plugin Name: Elementor Scheme_Color and Scheme_Typography Class Issue
 **/

namespace Elementor;

\add_action(
  'plugins_loaded',
  function() {
    if ( ! class_exists( 'Elementor\Scheme_Color' ) ) {
      class Scheme_Color extends Core\Schemes\Color {}
    }
  }
);
\add_action(
  'plugins_loaded',
  function() {
    if ( ! class_exists( 'Elementor\Scheme_Typography' ) ) {
      class Scheme_Typography extends Core\Schemes\Typography {}
    }
  }
);