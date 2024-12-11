<?php
class Action
{
  private static $storedAction;

  /**
   * Sets a callable function to be stored.
   *
   * @param callable $action The function to store.
   */
  public static function set($key, callable $action)
  {
    self::$storedAction[$key] = $action;
  }

  /**
   * Executes the stored function with the provided arguments.
   *
   * @param mixed ...$args The arguments to pass to the stored function.
   * @return mixed The result of the function execution.
   */
  public static function run($key,...$args)
  {
    if (!is_callable(self::$storedAction[$key])) {
      throw new Exception("No valid action has been set.");
    }

    return call_user_func_array(self::$storedAction[$key], $args);
  }

  public static function runAuto(callable $callback) 
  {
    try {
      return $callback();
    } catch (Throwable $e) {
      echo "Error: " . $e->getMessage();
    }
  } 
}