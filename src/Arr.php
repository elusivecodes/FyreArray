<?php
declare(strict_types=1);

namespace Fyre\Utility;

use
    Closure;

use const
    ARRAY_FILTER_USE_BOTH,
    ARRAY_FILTER_USE_KEY,
    COUNT_NORMAL,
    COUNT_RECURSIVE,
    SORT_LOCALE_STRING,
    SORT_NATURAL,
    SORT_NUMERIC,
    SORT_REGULAR,
    SORT_STRING;

use function
    array_chunk,
    array_column,
    array_combine,
    array_diff,
    array_fill,
    array_filter,
    array_intersect,
    array_is_list,
    array_key_exists,
    array_keys,
    array_map,
    array_merge,
    array_pad,
    array_pop,
    array_push,
    array_rand,
    array_reduce,
    array_replace_recursive,
    array_reverse,
    array_search,
    array_shift,
    array_slice,
    array_splice,
    array_unique,
    array_unshift,
    array_values,
    count,
    implode,
    in_array,
    is_array,
    is_int,
    range,
    shuffle,
    sort,
    usort;

/**
 * Arr
 */
abstract class Arr
{

    public const COUNT_NORMAL = COUNT_NORMAL;
    public const COUNT_RECURSIVE = COUNT_RECURSIVE;

    public const FILTER_BOTH = ARRAY_FILTER_USE_BOTH;
    public const FILTER_KEY = ARRAY_FILTER_USE_KEY;
    public const FILTER_VALUE = 0;

    public const SORT_LOCALE = SORT_LOCALE_STRING;
    public const SORT_NATURAL = SORT_NATURAL;
    public const SORT_NUMERIC = SORT_NUMERIC;
    public const SORT_REGULAR = SORT_REGULAR;
    public const SORT_STRING = SORT_STRING;

    /**
     * Split an array into chunks.
     * @param array $array The input array.
     * @param int $size The size of each chunk.
     * @param bool $preserveKeys Whether to preserve the array keys.
     * @return array An array of array chunks.
     */
    public static function chunk(array $array, int $size, bool $preserveKeys = false): array
    {
        return array_chunk($array, $size, $preserveKeys);
    }

    /**
     * Recursively replace elements into the first array.
     * @param array $array The input array.
     * @param array ...$replacements The arrays to use for replacement.
     * @return array The modified array.
     */
    public static function collapse(array $array, array ...$replacements): array
    {
        return array_replace_recursive($array, ...$replacements);
    }

    /**
     * Return the values from a single column in the input array.
     * @param array $array The input array.
     * @param string|int|null $key The column to pull values from.
     * @return array An array of column values.
     */
    public static function column(array $arrays, string|int|null $key): array
    {
        return array_column($arrays, $key);
    }

    /**
     * Creates an array by using one array for keys and another for its values.
     * @param array $keys The keys array.
     * @param array $values The values array.
     * @return array The combined array.
     */
    public static function combine(array $keys, array $values): array
    {
        return array_combine($keys, $values);
    }

    /**
     * Count all elements in an array.
     * @param array $array The input array.
     * @param int|null $mode The counting mode.
     * @return int The number of elements in the array.
     */
    public static function count(array $array, int|null $mode = null): int
    {
        return count($array, $mode ?? static::COUNT_NORMAL);
    }

    /**
     * Find values in the first array not present in any of the other arrays.
     * @param array $array The input array.
     * @param array ...$arrays The arrays to use for comparison.
     * @return array An array containing values not present in any of the other arrays.
     */
    public static function diff(array $array, array ...$arrays): array
    {
        return array_diff($array, ...$arrays);
    }

    /**
     * Split an array into keys and values.
     * @param array $array The input array.
     * @return array An array containing an array of keys and an array of values.
     */
    public static function divide(array $array): array
    {
        return [
            static::keys($array),
            static::values($array)
        ];
    }

    /**
     * Flatten a multi-dimensional array using "dot" notation.
     * @param array $array The input array.
     * @param string|null $prefix The key prefix.
     * @return array The flattened array.
     */
    public static function dot(array $array, string|null $prefix = null): array
    {
        $result = [];

        foreach ($array AS $key => $value) {
            if ($prefix) {
                $key = $prefix.'.'.$key;
            }

            if (static::isArray($value)) {
                $dot = static::dot($value, $key);
                $result = static::merge($result, $dot);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Return an array without the specified key/value pairs.
     * @param array $array The input array.
     * @param array $keys The keys to remove.
     * @return array An array without the specified key/value pairs.
     */
    public static function except(array $array, array $keys): array
    {
        return static::filter(
            $array,
            fn($key) => !static::includes($keys, $key),
            static::FILTER_KEY
        );
    }

    /**
     * Fill an array with values.
     * @param int $amount The number of elements to insert.
     * @param mixed $value The value to insert.
     * @return array An array filled with values.
     */
    public static function fill(int $amount, $value): array
    {
        return array_fill(0, $amount, $value);
    }

    /**
     * Filter elements of an array using a callback function.
     * @param array $array The input array.
     * @param callable|null $callback The callback function to use.
     * @param int|null $mode Flag determining arguments sent to the callback.
     * @return array The filtered array.
     */
    public static function filter(array $array, callable|null $callback = null, int|null $mode = null): array
    {
        return array_filter($array, $callback, $mode ?? static::FILTER_BOTH);
    }

    /**
     * Find the first value in an array that satisfies a callback.
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @param mixed $default The default value to return.
     * @return mixed The first value satisfying the callback, or the default value.
     */
    public static function find(array $array, callable $callback, $default = null)
    {
        foreach ($array AS $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }

        return $default;
    }

    /**
     * Find the last value in an array that satisfies a callback.
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @param mixed $default The default value to return.
     * @return mixed The last value satisfying the callback, or the default value.
     */
    public static function findLast(array $array, callable $callback, $default = null)
    {
        return static::find(
            static::reverse($array, true),
            $callback,
            $default
        );
    }

    /**
     * Flatten a multi-dimensional array into a single level.
     * @param array $array The input array.
     * @param int $maxDepth The maximum depth to flatten.
     * @return array The flattened array.
     */
    public static function flatten(array $array, int $maxDepth = 1): array
    {
        return static::reduce(
            $array,
            fn($a, $b) => static::merge(
                $a,
                static::isArray($b) ?
                    (
                        $maxDepth > 1 ?
                            static::flatten($b, $maxDepth - 1) :
                            $b
                    ) :
                    [$b]
            ),
            []
        );
    }

    /**
     * Remove a key/value pair using "dot" notation.
     * @param array $array The input array.
     * @param string $key The key.
     * @return array The filtered array.
     */
    public static function forgetDot(array $array, string $key): array
    {
        $keys = explode('.', $key);

        $pointer = &$array;

        while (($key = static::shift($keys)) && static::count($keys) > 0) {
            if (!static::isArray($pointer) || !static::hasKey($pointer, $key)) {
                return $array;
            }
    
            $pointer = &$pointer[$key];
        }

        unset($pointer[$key]);

        return $array;
    }

    /**
     * Retrieve a value using "dot" notation.
     * @param array $array The input array.
     * @param string $key The key.
     * @param mixed $default The default value to return.
     * @return mixed The value.
     */
    public static function getDot(array $array, string $key, $default = null)
    {
        $result = $array;

        foreach (explode('.', $key) AS $key) {
            if (!static::isArray($result) || !static::hasKey($result, $key)) {
                return $default;
            }

            $result = $result[$key];
        }

        return $result;
    }

    /**
     * Check if a given element exists in an array using "dot" notation.
     * @param array $array The input array.
     * @param string The key to check for.
     * @return bool Whether the given element exists in the array.
     */
    public static function hasDot(array $array, string $key): bool
    {
        foreach (explode('.', $key) AS $key) {
            if (!static::isArray($array) || !static::hasKey($array, $key)) {
                return false;
            }

            $array =& $array[$key];
        }

        return true;
    }

    /**
     * Check if a given key exists in an array.
     * @param array $array The input array.
     * @param string|int|float The key to check for.
     * @return bool Whether the given key exists in the array.
     */
    public static function hasKey(array $array, string|int|float $key): bool
    {
        return array_key_exists($key, $array);
    }

    /**
     * Check if a given value exists in an array.
     * @param array $array The input array.
     * @param mixed The value to check for.
     * @return bool Whether the given value exists in the array.
     */
    public static function includes(array $array, $value): bool
    {
        return in_array($value, $array);
    }

    /**
     * Index a multi-dimensional array using a given key value.
     * @param array $array The input array.
     * @param string|int|null $key The column to pull key values from.
     * @return array The indexed array.
     */
    public static function index(array $array, string|int|null $key): array
    {
        return static::combine(
            static::column($array, $key),
            $array
        );
    }

    /**
     * Search an array for a given value and returns the first key.
     * @param array $array The input array.
     * @param mixed $value The value to search for.
     * @param bool $strict Whether to perform a strict search.
     * @return string|int|false The first key for a matching value, otherwise FALSE.
     */
    public static function indexOf(array $array, $value, bool $strict = false): string|int|false
    {
        return array_search($value, $array, $strict);
    }

    /**
     * Find values in the first array present in all of the other arrays.
     * @param array $array The input array.
     * @param array ...$arrays The arrays to use for comparison.
     * @return array An array containing values present in all of the other arrays.
     */
    public static function intersect(array $array, array ...$arrays): array
    {
        return array_intersect($array, ...$arrays);
    }

    /**
     * Determine if the value is an array.
     * @param mixed $value The value to test.
     * @return bool TRUE if the value is an array, otherwise FALSE.
     */
    public static function isArray($value): bool
    {
        return is_array($value);
    }

    /**
     * Determine if an array has consecutive keys starting from 0.
     * @param mixed $array The array to test.
     * @return bool TRUE if the value has consecutive keys starting from 0, otherwise FALSE.
     */
    public static function isList(array $array): bool
    {
        return array_is_list($array);
    }

    /**
     * Join an array elements using a specified seperator.
     * @param array $array The input array.
     * @param string $seperator The seperator to join with.
     * @return string The joined string.
     */
    public static function join(array $array, string $seperator = ','): string
    {
        return implode($seperator, $array);
    }

    /**
     * Return all keys of an array.
     * @param array $array The input array.
     * @return array The array keys.
     */
    public static function keys(array $array): array
    {
        return array_keys($array);
    }

    /**
     * Search an array for a given value and returns the last key.
     * @param array $array The input array.
     * @param mixed $value The value to search for.
     * @param bool $strict Whether to perform a strict search.
     * @return string|int|false The last key for a matching value, otherwise FALSE.
     */
    public static function lastIndexOf(array $array, $value, bool $strict = false): string|int|false
    {
        return static::indexOf(
            static::reverse($array, true),
            $value,
            $strict
        );
    }

    /**
     * Apply a callback to the elements of an array.
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @return array The modified array.
     */
    public static function map(array $array, callable $callback): array
    {
        return array_map(
            $callback,
            $array,
            static::keys($array)
        );
    }

    /**
     * Merge one or more arrays.
     * @param array ...$arrays The arrays to merge.
     * @return array The merged array.
     */
    public static function merge(array ...$arrays): array
    {
        return array_merge(...$arrays);
    }

    /**
     * Return an array with only the specified key/value pairs.
     * @param array $array The input array.
     * @param array $keys The keys to include.
     * @return array An array with only the specified key/value pairs.
     */
    public static function only(array $array, array $keys): array
    {
        return static::filter(
            $array,
            fn($key) => static::includes($keys, $key),
            static::FILTER_KEY
        );
    }

    /**
     * Pad an array to a specified length with a value.
     * @param array $array The input array.
     * @param int $size The new size of the array.
     * @param mixed $value The value to pad with.
     * @return array The padded array.
     */
    public static function pad(array $array, int $size, $value): array
    {
        return array_pad($array, $size, $value);
    }

    /**
     * Pluck a list of values using "dot" notation.
     * @param array $arrays The input arrays.
     * @param string $key The key to lookup.
     * @return array An array of values.
     */
    public static function pluckDot(array $arrays, string $key): array
    {
        $result = [];

        foreach ($arrays AS $array) {
            $result[] = static::getDot($array, $key);
        }

        return $result;
    }

    /**
     * Pop the element off the end of the array.
     * @param array $array The input array.
     * @return mixed The last value of the array.
     */
    public static function pop(array &$array)
    {
        return array_pop($array);
    }

    /**
     * Push one or more elements onto the end of array.
     * @param array $array The input array.
     * @param mixed ...$values The values to push.
     */
    public static function push(array &$array, ...$values): void
    {
        array_push($array, ...$values);
    }

    /**
     * Return a random value from an array.
     * @param array $array The input array.
     * @return mixed A random value from the array.
     */
    public static function randomValue(array $array)
    {
        if ($array === []) {
            return null;
        }

        $key = array_rand($array, 1);
        return $array[$key];
    }

    /**
     * Create an array containing a range of elements.
     * @param string|int|float $start The first value of the sequence.
     * @param string|int|float $end The ending value in the sequence.
     * @param int|float $step The increment between values in the sequence.
     * @return array An array of values from start to end, inclusive.
     */
    public static function range(string|int|float $start, string|int|float $end, int|float $step = 1): array
    {
        return range($start, $end, $step);
    }

    /**
     * Iteratively reduce an array to a single value using a callback function.
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @param mixed $initial The initial value.
     * @return mixed The final value.
     */
    public static function reduce(array $array, callable $callback, $initial = null)
    {
        return array_reduce($array, $callback, $initial);
    }

    /**
     * Return an array with elements in reverse order.
     * @param array $array The input array.
     * @param bool $preserveKeys Whether to preserve the array keys.
     * @return array The reversed array.
     */
    public static function reverse(array $array, bool $preserveKeys = false): array
    {
        return array_reverse($array, $preserveKeys);
    }

    /**
     * Set a value using "dot" notation.
     * @param array $array The input array.
     * @param string $key The key.
     * @param mixed $value The value to set.
     * @param bool $overwrite Whether to overwrite previous values.
     * @return array The modified array.
     */
    public static function setDot(array $array, string $key, $value, bool $overwrite = true): array
    {
        $keys = explode('.', $key);

        $pointer = &$array;

        while (($key = static::shift($keys)) && static::count($keys) > 0) {
            if ($key !== '*') {
                if (!static::hasKey($pointer, $key) || !static::isArray($pointer[$key])) {
                    $pointer[$key] = [];
                }
                $pointer = &$pointer[$key];

                continue;
            }

            foreach ($pointer AS &$point) {
                static::setDot(
                    $point,
                    static::join($keys, '.'),
                    $value,
                    $overwrite
                );
            }

            return $array;
        }

        if ($overwrite || !static::hasKey($pointer, $key)) {
            $pointer[$key] = $value;
        }

        return $array;
    }

    /**
     * Shift an element off the beginning of the array.
     * @param array $array The input array.
     * @return mixed The first value of the array.
     */
    public static function shift(array &$array)
    {
        return array_shift($array);
    }

    /**
     * Shuffle an array.
     * @param array $array The input array.
     * @return array The shuffled array.
     */
    public static function shuffle(array $array): array
    {
        shuffle($array);

        return $array;
    }

    /**
     * Extract a slice of the array.
     * @param array $array The input array.
     * @param int $offset The starting offset.
     * @param int|null $length The length of the slice.
     * @param bool $preserveKeys Whether to preserve the array keys.
     * @return array The sliced array.
     */
    public static function slice(array $array, int $offset = 0, int|null $length = null, bool $preserveKeys = false): array
    {
        return array_slice($array, $offset, $length, $preserveKeys);
    }

    /**
     * Sort an array.
     * @param array $array The input array.
     * @param Closure|int|null $sort The sorting flag, or a comparison Closure.
     * @return array The sorted array.
     */
    public static function sort(array $array, Closure|int|null $sort = null): array
    {
        if ($sort instanceof Closure) {
            usort($array, $sort);
        } else {
            sort($array, $sort ?? static::SORT_NATURAL);
        }

        return $array;
    }

    /**
     * Remove a portion of the array and replace it with something else.
     * @param array $array The input array.
     * @param int $offset The starting offset.
     * @param int|null $length The length to remove.
     * @param mixed $replacement The element(s) to insert in the array.
     */
    public static function splice(array &$array, int $offset, int|null $length = null, $replacement = []): void
    {
        array_splice($array, $offset, $length, $replacement);
    }

    /**
     * Remove duplicate values from an array.
     * @param array $array The input array.
     * @param int|null $flags The comparison flag.
     * @return array The filtered array.
     */
    public static function unique(array $array, int|null $flags = null): array
    {
        return array_unique($array, $flags ?? static::SORT_REGULAR);
    }

    /**
     * Prepend one or more elements to the beginning of an array.
     * @param array $array The input array.
     * @param mixed ...$values The values to prepend.
     */
    public static function unshift(array &$array, ...$values)
    {
        return array_unshift($array, ...$values);
    }

    /**
     * Return all values of an array.
     * @param array $array The input array.
     * @return array The array values.
     */
    public static function values(array $arrays): array
    {
        return array_values($arrays);
    }

    /**
     * Create an array from any value.
     * @param mixed $value The value to wrap.
     * @return array The wrapped value.
     */
    public static function wrap($value): array
    {
        if (static::isArray($value)) {
            return $value;
        }

        return $value === null ?
            [] :
            [$value];
    }

}
