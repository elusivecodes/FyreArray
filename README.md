# FyreArray

**FyreArray** is a free, array manipulation library for *PHP*.


## Table Of Contents
- [Installation](#installation)
- [Methods](#methods)



## Installation

**Using Composer**

```
composer install fyre/array
```

In PHP:

```php
use Fyre\Arr;
```


## Methods

**Chunk**

Split an array into chunks.

- `$array` is the input array.
- `$size` is the size of each chunk.
- `$preserveKeys` determines if the array keys will be preserved, and will default to *false*.

```php
$chunk = Arr::chunk($array, $size, $preserveKeys);
```

**Collapse**

Recursively replace elements into the first array.

- `$array` is the input array.

All arguments supplied to this method will be replace into the first array.

```php
$collapsed = Arr::collapse($array, ...$replacements);
```

**Column**

Return the values from a single column in the input array.

- `$array` is the input array.
- `$key` is the column to pull values from.

```php
$column = Arr::column($array, $key);
```

**Combine**

Creates an array by using one array for keys and another for its values.

- `$keys` is the keys array.
- `$values` is the keys array.

```php
$combined = Arr::combine($keys, $values);
```

**Count**

Count all elements in an array.

- `$array` is the input array.
- `$mode` is the counting mode, and will default to *COUNT_NORMAL*.

```php
$count = Arr::count($array, $mode);
```

**Difference**

Find values in the first array not present in any of the other arrays.

- `$array` is the input array.

Any additional arguments supplied will be used to test for the values of the first array.

```php
$diff = Arr::diff($array, ...$arrays);
```

**Divide**

Split an array into keys and values.

- `$array` is the input array.

```php
$divided = Arr::divide($array);
```

**Except**

Return an array without the specified key/value pairs.

- `$array` is the input array.
- `$keys` is the keys to remove.

```php
$except = Arr::except($array, $keys);
```

**Fill**

Fill an array with values.

- `$amount` is the number of elements to insert.
- `$value` is the value to insert.

```php
$filled = Arr::fill($amount, $value);
```

**Filter**

Filter elements of an array using a callback function.

- `$array` is the input array.
- `$callback` is the callback function to use.
- `$mode` is the lagf determining arguments sent to the callback.

If `$callback` is omitted this function will filter empty elements from the array.

```php
$filtered = Arr::filtered($array, $callback);
```

**Find**

Find the first value in an array that satisfies a callback.

- `$array` is the input array.
- `$callback` is the callback function to use.
- `$default` is the default value to return.

```php
$find = Arr::find($array, $callback, $default);
```

**Find Last**

Find the last value in an array that satisfies a callback.

- `$array` is the input array.
- `$callback` is the callback function to use.
- `$default` is the default value to return.

```php
$findLast = Arr::findLast($array, $callback, $default);
```

**Flatten**

Flatten a multi-dimensional array into a single level.

- `$array` is the input array.
- `$maxDepth` is the maximum depth to flatten, and will default to *1*.

```php
$flattened = Arr::flatten($array, $maxDepth);
```

**Has Key**

Check if a given key exists in an array.

- `$array` is the input array.
- `$key` is the key to check for.

```php
$hasKey = Arr::hasKey($array, $key);
```

**Includes**

Check if a given value exists in an array.

- `$array` is the input array.
- `$value` is the value to check for.

```php
$includes = Arr::includes($array, $value);
```

**Index**

Index a multi-dimensional array using a given key value.

- `$array` is the input array.
- `$key` is the column to pull key values from.

```php
$index = Arr::index($array, $key);
```

**Index Of**

Search an array for a given value and returns the first key.

- `$array` is the input array.
- `$value` is the value to search for.
- `$strict` determines if a strict search will be performed, and will default to *false*.

```php
$indexOf = Arr::indexOf($array, $value, $strict);
```

**Intersect**

Find values in the first array present in all of the other arrays.

- `$array` is the input array.

All additional arguments supplied will be used to test for intersections.

```php
$intersect = Arr::intersect($array, ...$arrays);
```

**Is Array**

Determine if the value is an array.

- `$value` is the value to test.

```php
$isArray = Arr::isArray($value);
```

**Join**

Join an array elements using a specified seperator.

- `$array` is the input array.
- `$seperator` is the seperator to join with, and will default to *","*

```php
$joined = Arr::join($array, $seperator);
```

**Keys**

Return all keys of an array.

- `$array` is the input array.

```php
$keys = Arr::keys($array);
```

**Last Index Of**

Search an array for a given value and returns the last key.

- `$array` is the input array.
- `$value` is the value to search for.
- `$strict` determines if a strict search will be performed, and will default to *false*.

```php
$lastIndexOf = Arr::lastIndexOf($array, $value, $strict);
```

**Map**

Apply a callback to the elements of an array.

- `$array` is the input array.
- `$callback` is the callback function to use.

```php
$map = Arr::map($array, $callback);
```

**Merge**

Merge one or more arrays.

- `$array` is the input array.

All additional arguments supplied will be merged with the first array.

```php
$merged = Arr::merge($array, ...$arrays);
```

**Only**

Return an array with only the specified key/value pairs.

- `$array` is the input array.
- `$keys` is the keys to include.

```php
$only = Arr::only($array, $keys);
```

**Pad**

Pad an array to a specified length with a value.

- `$array` is the input array.
- `$size` is the new size of the array.
- `$value` is the value to pad with.

```php
$padded = Arr::pad($array, $size, $value);
```

**Pop**

Pop the element off the end of array.

- `$array` is the input array.

```php
$pop = Arr::pop($array);
```

**Push**

Push one or more elements onto the end of array.

- `$array` is the input array.

All additional arguments supplied will be pushed onto the array.

```php
Arr::push($array, ...$values);
```

**Random Value**

Return a random value from an array.

- `$array` is the input array.

```php
$randomValue = Arr::randomValue($array);
```

**Range**

Create an array containing a range of elements.

- `$start` is the first value of the sequence.
- `$end` is the ending value in the sequence.
- `$step` is the increment between values in the sequence, and will default to *1*.

```php
$range = Arr::range($start, $end, $step);
```

**Reduce**

Iteratively reduce an array to a single value using a callback function.

- `$array` is the input array.
- `$callback` is the callback function to use.
- `$initial` is the initial value to use, and will default to *null*.

```php
$reduced = Arr::reduce($array, $callback, $initial);
```

**Reverse**

Return an array with elements in reverse order.

- `$array` is the input array.

```php
$reversed = Arr::reverse($array);
```

**Shift**

Shift an element off the beginning of the array.

- `$array` is the input array.

```php
$shift = Arr::shift($array);
```

**Shuffle**

Shuffle an array.

- `$array` is the input array.

```php
$shuffled = Arr::shuffle($array);
```

**Slice**

Extract a slice of the array.

- `$array` is the input array.
- `$offset` is the starting offset.
- `$length` is the length of the slice.
- `$preserveKeys` determines if the array keys will be preserved, and will default to *false*.

```php
$slice = Arr::slice($array, $offset, $length, $preserveKeys);
```

**Sort**

Sort an array.

- `$array` is the input array.
- `$sort` is a sorting flag or a comparison callback, and will default to *SORT_NATURAL*.

```php
$sorted = Arr::sort($array, $sort);
```

**Splice**

Remove a portion of the array and replace it with something else.

- `$array` is the input array.
- `$offset` is the starting offset.
- `$length` is the length of the slice.
- `$replacement` is the element(s) to insert in the array.

```php
Arr::splice($array, $offset, $length, $replacement);
```

**Unique**

Remove duplicate values from an array.

- `$array` is the input array.

```php
$unique = Arr::unique($array);
```

**Unshift**

Prepend one or more elements to the beginning of an array.

- `$array` is the input array.

All additional arguments supplied will be prepended to the array.

```php
Arr::unshift($array, ...$values);
```

**Values**

Return all values of an array.

- `$array` is the input array.

```php
$values = Arr::values($array);
```

**Wrap**

Create an array from any value.

- `$value` is the value to wrap.

```php
$wrapped = Arr::wrap($value);
```