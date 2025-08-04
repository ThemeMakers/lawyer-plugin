<?php

declare(strict_types=1);

if (! defined('ABSPATH')) {
  die;
} // Cannot access pages directly.
/**
 *
 * Abstract Class
 * A helper class for action and filter hooks
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
abstract class CSFramework_Abstract
{

  public function __construct() {}

  public function addAction(string $hook, string $function_to_add, int $priority = 30, int $accepted_args = 1): void
  {
    add_action($hook, [$this, $function_to_add], $priority, $accepted_args);
  }

  public function addFilter(string $tag, string $function_to_add, int $priority = 30, int $accepted_args = 1): void
  {
    add_filter($tag, [$this, $function_to_add], $priority, $accepted_args);
  }
}
