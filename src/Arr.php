<?php
declare(strict_types=1);

namespace Fyre\Utility;

use Closure;

use function array_all;
use function array_any;
use function array_chunk;
use function array_column;
use function array_combine;
use function array_diff;
use function array_fill;
use function array_filter;
use function array_find_key;
use function array_intersect;
use function array_is_list;
use function array_key_exists;
use function array_keys;
use function array_map;
use function array_merge;
use function array_pad;
use function array_pop;
use function array_push;
use function array_rand;
use function array_reduce;
use function array_replace_recursive;
use function array_reverse;
use function array_search;
use function array_shift;
use function array_slice;
use function array_splice;
use function array_unique;
use function array_unshift;
use function array_values;
use function count;
use function implode;
use function in_array;
use function is_array;
use function range;
use function shuffle;
use function sort;
use function usort;

use const ARRAY_FILTER_USE_BOTH;
use const ARRAY_FILTER_USE_KEY;
use const COUNT_NORMAL;
use const COUNT_RECURSIVE;
use const SORT_LOCALE_STRING;
use const SORT_NATURAL;
use const SORT_NUMERIC;
use const SORT_REGULAR;
use const SORT_STRING;

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
     *
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
     *
     * @param array $array The input array.
     * @param array ...$replacements The arrays to use for replacement.
     * @return array The modified array.
     */
    public static function collapse(array $array, array ...$replacements): array
    {
        return array_replace_recursive($array, ...$replacements);
    }

    /**
     * Get the values from a single column in the input array.
     *
     * @param array $arrays The input array.
     * @param int|string $key The column to pull values from.
     * @return array An array of column values.
     */
    public static function column(array $arrays, int|string $key): array
    {
        return array_column($arrays, $key);
    }

    /**
     * Create an array by using one array for keys and another for its values.
     *
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
     *
     * @param array $array The input array.
     * @param int $mode The counting mode.
     * @return int The number of elements in the array.
     */
    public static function count(array $array, int $mode = self::COUNT_NORMAL): int
    {
        return count($array, $mode);
    }

    /**
     * Find values in the first array not present in any of the other arrays.
     *
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
     *
     * @param array $array The input array.
     * @return array An array containing an array of keys and an array of values.
     */
    public static function divide(array $array): array
    {
        return [
            array_keys($array),
            array_values($array),
        ];
    }

    /**
     * Flatten a multi-dimensional array using "dot" notation.
     *
     * @param array $array The input array.
     * @param string|null $prefix The key prefix.
     * @return array The flattened array.
     */
    public static function dot(array $array, string|null $prefix = null): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            if ($prefix) {
                $key = $prefix.'.'.$key;
            }

            if (is_array($value)) {
                $dot = static::dot($value, $key);
                $result = array_merge($result, $dot);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Determine whether every element in an array passes a callback.
     *
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @return bool TRUE if every element in the array passes the callback, otherwise FALSE.
     */
    public static function every(array $array, callable $callback): bool
    {
        return array_all($array, $callback);
    }

    /**
     * Filter an array without the specified key/value pairs.
     *
     * @param array $array The input array.
     * @param array $keys The keys to remove.
     * @return array An array without the specified key/value pairs.
     */
    public static function except(array $array, array $keys): array
    {
        return array_filter(
            $array,
            fn(mixed $key): bool => !in_array($key, $keys),
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * Fill an array with values.
     *
     * @param int $amount The number of elements to insert.
     * @param mixed $value The value to insert.
     * @return array An array filled with values.
     */
    public static function fill(int $amount, mixed $value): array
    {
        return array_fill(0, $amount, $value);
    }

    /**
     * Filter elements of an array using a callback function.
     *
     * @param array $array The input array.
     * @param callable|null $callback The callback function to use.
     * @param int $mode Flag determining arguments sent to the callback.
     * @return array The filtered array.
     */
    public static function filter(array $array, callable|null $callback = null, int $mode = self::FILTER_BOTH): array
    {
        return array_filter($array, $callback, $mode);
    }

    /**
     * Find the first value in an array that satisfies a callback.
     *
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @param mixed $default The default value to return.
     * @return mixed The first value satisfying the callback, or the default value.
     */
    public static function find(array $array, callable $callback, mixed $default = null): mixed
    {
        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }

        return $default;
    }

    /**
     * Find the first key in an array that satisfies a callback.
     *
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @return mixed The first key satisfying the callback.
     */
    public static function findKey(array $array, callable $callback): mixed
    {
        return array_find_key($array, $callback);
    }

    /**
     * Find the last value in an array that satisfies a callback.
     *
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @param mixed $default The default value to return.
     * @return mixed The last value satisfying the callback, or the default value.
     */
    public static function findLast(array $array, callable $callback, mixed $default = null): mixed
    {
        return static::find(
            array_reverse($array, true),
            $callback,
            $default
        );
    }

    /**
     * Find the last key in an array that satisfies a callback.
     *
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @return mixed The last key satisfying the callback.
     */
    public static function findLastKey(array $array, callable $callback): mixed
    {
        return array_find_key(
            array_reverse($array, true),
            $callback
        );
    }

    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param array $array The input array.
     * @param int $maxDepth The maximum depth to flatten.
     * @return array The flattened array.
     */
    public static function flatten(array $array, int $maxDepth = 1): array
    {
        return array_reduce(
            $array,
            fn(mixed $a, mixed $b): mixed => array_merge(
                $a,
                is_array($b) ?
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
     *
     * @param array $array The input array.
     * @param string $key The key.
     * @return array The filtered array.
     */
    public static function forgetDot(array $array, string $key): array
    {
        $keys = explode('.', $key);

        $pointer = &$array;

        while (($key = array_shift($keys)) && count($keys) > 0) {
            if (!is_array($pointer) || !array_key_exists($key, $pointer)) {
                return $array;
            }

            $pointer = &$pointer[$key];
        }

        unset($pointer[$key]);

        return $array;
    }

    /**
     * Retrieve a value using "dot" notation.
     *
     * @param array $array The input array.
     * @param string $key The key.
     * @param mixed $default The default value to return.
     * @return mixed The value.
     */
    public static function getDot(array $array, string $key, mixed $default = null): mixed
    {
        $result = $array;

        foreach (explode('.', $key) as $key) {
            if (!is_array($result) || !array_key_exists($key, $result)) {
                return $default;
            }

            $result = $result[$key];
        }

        return $result;
    }

    /**
     * Determine whether a given element exists in an array using "dot" notation.
     *
     * @param array $array The input array.
     * @param string The key to check for.
     * @return bool Whether the given element exists in the array.
     */
    public static function hasDot(array $array, string $key): bool
    {
        foreach (explode('.', $key) as $key) {
            if (!is_array($array) || !array_key_exists($key, $array)) {
                return false;
            }

            $array = & $array[$key];
        }

        return true;
    }

    /**
     * Determine whether a given key exists in an array.
     *
     * @param array $array The input array.
     * @param float|int|string The key to check for.
     * @return bool Whether the given key exists in the array.
     */
    public static function hasKey(array $array, float|int|string $key): bool
    {
        return array_key_exists($key, $array);
    }

    /**
     * Determine whether a given value exists in an array.
     *
     * @param array $array The input array.
     * @param mixed The value to check for.
     * @return bool Whether the given value exists in the array.
     */
    public static function includes(array $array, mixed $value): bool
    {
        return in_array($value, $array);
    }

    /**
     * Index a multi-dimensional array using a given key value.
     *
     * @param array $array The input array.
     * @param int|string $key The column to pull key values from.
     * @return array The indexed array.
     */
    public static function index(array $array, int|string $key): array
    {
        return array_column($array, null, $key);
    }

    /**
     * Search an array for a given value and returns the first key.
     *
     * @param array $array The input array.
     * @param mixed $value The value to search for.
     * @param bool $strict Whether to perform a strict search.
     * @return false|int|string The first key for a matching value, otherwise FALSE.
     */
    public static function indexOf(array $array, mixed $value, bool $strict = false): false|int|string
    {
        return array_search($value, $array, $strict);
    }

    /**
     * Find values in the first array present in all of the other arrays.
     *
     * @param array $array The input array.
     * @param array ...$arrays The arrays to use for comparison.
     * @return array An array containing values present in all of the other arrays.
     */
    public static function intersect(array $array, array ...$arrays): array
    {
        return array_intersect($array, ...$arrays);
    }

    /**
     * Determine whether the value is an array.
     *
     * @param mixed $value The value to test.
     * @return bool TRUE if the value is an array, otherwise FALSE.
     */
    public static function isArray(mixed $value): bool
    {
        return is_array($value);
    }

    /**
     * Determine whether an array has consecutive keys starting from 0.
     *
     * @param array $array The array to test.
     * @return bool TRUE if the value has consecutive keys starting from 0, otherwise FALSE.
     */
    public static function isList(array $array): bool
    {
        return array_is_list($array);
    }

    /**
     * Join an array elements using a specified separator.
     *
     * @param array $array The input array.
     * @param string $separator The separator to join with.
     * @return string The joined string.
     */
    public static function join(array $array, string $separator = ','): string
    {
        return implode($separator, $array);
    }

    /**
     * Get all keys of an array.
     *
     * @param array $array The input array.
     * @return array The array keys.
     */
    public static function keys(array $array): array
    {
        return array_keys($array);
    }

    /**
     * Search an array for a given value and returns the last key.
     *
     * @param array $array The input array.
     * @param mixed $value The value to search for.
     * @param bool $strict Whether to perform a strict search.
     * @return false|int|string The last key for a matching value, otherwise FALSE.
     */
    public static function lastIndexOf(array $array, $value, bool $strict = false): false|int|string
    {
        return array_search(
            $value,
            array_reverse($array, true),
            $strict
        );
    }

    /**
     * Apply a callback to the elements of an array.
     *
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @return array The modified array.
     */
    public static function map(array $array, callable $callback): array
    {
        return array_map(
            $callback,
            $array,
            array_keys($array)
        );
    }

    /**
     * Merge one or more arrays.
     *
     * @param array ...$arrays The arrays to merge.
     * @return array The merged array.
     */
    public static function merge(array ...$arrays): array
    {
        return array_merge(...$arrays);
    }

    /**
     * Determine whether no elements in an array pass a callback.
     *
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @return bool TRUE if no elements in the array pass the callback, otherwise FALSE.
     */
    public static function none(array $array, callable $callback): bool
    {
        return !array_any($array, $callback);
    }

    /**
     * Filter an array with only the specified key/value pairs.
     *
     * @param array $array The input array.
     * @param array $keys The keys to include.
     * @return array An array with only the specified key/value pairs.
     */
    public static function only(array $array, array $keys): array
    {
        return array_filter(
            $array,
            fn(mixed $key): bool => in_array($key, $keys),
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * Pad an array to a specified length with a value.
     *
     * @param array $array The input array.
     * @param int $size The new size of the array.
     * @param mixed $value The value to pad with.
     * @return array The padded array.
     */
    public static function pad(array $array, int $size, mixed $value): array
    {
        return array_pad($array, $size, $value);
    }

    /**
     * Pluck a list of values using "dot" notation.
     *
     * @param array $arrays The input arrays.
     * @param string $key The key to lookup.
     * @return array An array of values.
     */
    public static function pluckDot(array $arrays, string $key): array
    {
        $result = [];

        foreach ($arrays as $array) {
            $result[] = static::getDot($array, $key);
        }

        return $result;
    }

    /**
     * Pop the element off the end of the array.
     *
     * @param array $array The input array.
     * @return mixed The last value of the array.
     */
    public static function pop(array &$array): mixed
    {
        return array_pop($array);
    }

    /**
     * Push one or more elements onto the end of array.
     *
     * @param array $array The input array.
     * @param mixed ...$values The values to push.
     * @return int The new number of elements in the array.
     */
    public static function push(array &$array, mixed ...$values): int
    {
        return array_push($array, ...$values);
    }

    /**
     * Get a random value from an array.
     *
     * @param array $array The input array.
     * @return mixed A random value from the array.
     */
    public static function randomValue(array $array): mixed
    {
        if ($array === []) {
            return null;
        }

        $key = array_rand($array, 1);

        return $array[$key];
    }

    /**
     * Create an array containing a range of elements.
     *
     * @param float|int|string $start The first value of the sequence.
     * @param float|int|string $end The ending value in the sequence.
     * @param float|int $step The increment between values in the sequence.
     * @return array An array of values from start to end, inclusive.
     */
    public static function range(float|int|string $start, float|int|string $end, float|int $step = 1): array
    {
        return range($start, $end, $step);
    }

    /**
     * Iteratively reduce an array to a single value using a callback function.
     *
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @param mixed $initial The initial value.
     * @return mixed The final value.
     */
    public static function reduce(array $array, callable $callback, mixed $initial = null): mixed
    {
        return array_reduce($array, $callback, $initial);
    }

    /**
     * Reverse the order of elements in an array.
     *
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
     *
     * @param array $array The input array.
     * @param string $key The key.
     * @param mixed $value The value to set.
     * @param bool $overwrite Whether to overwrite previous values.
     * @return array The modified array.
     */
    public static function setDot(array $array, string $key, mixed $value, bool $overwrite = true): array
    {
        $keys = explode('.', $key);

        $pointer = &$array;

        while (($key = array_shift($keys)) && count($keys) > 0) {
            if ($key !== '*') {
                if (!array_key_exists($key, $pointer) || !is_array($pointer[$key])) {
                    $pointer[$key] = [];
                }
                $pointer = &$pointer[$key];

                continue;
            }

            foreach ($pointer as &$point) {
                static::setDot(
                    $point,
                    implode('.', $keys),
                    $value,
                    $overwrite
                );
            }

            return $array;
        }

        if ($overwrite || !array_key_exists($key, $pointer)) {
            $pointer[$key] = $value;
        }

        return $array;
    }

    /**
     * Shift an element off the beginning of the array.
     *
     * @param array $array The input array.
     * @return mixed The first value of the array.
     */
    public static function shift(array &$array): mixed
    {
        return array_shift($array);
    }

    /**
     * Shuffle an array.
     *
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
     *
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
     * Determine whether some elements in an array pass a callback.
     *
     * @param array $array The input array.
     * @param callable $callback The callback function to use.
     * @return bool TRUE if some elements in the array pass the callback, otherwise FALSE.
     */
    public static function some(array $array, callable $callback): bool
    {
        return array_any($array, $callback);
    }

    /**
     * Sort an array.
     *
     * @param array $array The input array.
     * @param Closure|int $sort The sorting flag, or a comparison Closure.
     * @return array The sorted array.
     */
    public static function sort(array $array, Closure|int $sort = self::SORT_NATURAL): array
    {
        if ($sort instanceof Closure) {
            usort($array, $sort);
        } else {
            sort($array, $sort);
        }

        return $array;
    }

    /**
     * Remove a portion of the array and replace it with something else.
     *
     * @param array $array The input array.
     * @param int $offset The starting offset.
     * @param int|null $length The length to remove.
     * @param mixed $replacement The element(s) to insert in the array.
     * @return array The spliced elements.
     */
    public static function splice(array &$array, int $offset, int|null $length = null, mixed $replacement = []): array
    {
        return array_splice($array, $offset, $length, $replacement);
    }

    /**
     * Remove duplicate values from an array.
     *
     * @param array $array The input array.
     * @param int $flags The comparison flag.
     * @return array The filtered array.
     */
    public static function unique(array $array, int $flags = self::SORT_REGULAR): array
    {
        return array_unique($array, $flags);
    }

    /**
     * Prepend one or more elements to the beginning of an array.
     *
     * @param array $array The input array.
     * @param mixed ...$values The values to prepend.
     * @return int The new number of elements in the array.
     */
    public static function unshift(array &$array, mixed ...$values): int
    {
        return array_unshift($array, ...$values);
    }

    /**
     * Get all values of an array.
     *
     * @param array $array The input array.
     * @return array The array values.
     */
    public static function values(array $arrays): array
    {
        return array_values($arrays);
    }

    /**
     * Create an array from any value.
     *
     * @param mixed $value The value to wrap.
     * @return array The wrapped value.
     */
    public static function wrap(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        return $value === null ?
            [] :
            [$value];
    }
}
