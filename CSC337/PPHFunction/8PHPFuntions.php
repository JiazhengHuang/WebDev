<?php

/**
 * 8 PHP functions requiring functions, assert, selection, repetition, and arrays,
 * The code has a few asserts and some output, which you may delete when done.
 * Write more asserts to test your code. We will have many more asserts when grading.
 * It is important for you to learn how to test your code.
 *
 * Programmer: Jiazheng Huang
 */

// 1) howSwedish
// ABBA is a band, they have many songs including Dancing Queen, and
// Fernando. ABBA is actually a Swedish band, so if we wanted to find
// out howSwedish a String is, we could simply find out how many times
// the String contains the substring "abba". We want to look for this
// substring in a case insensitive manner. So "abba" counts, and so
// does "aBbA". We also want to check for overlapping abba's such as
// in the String "abbAbba" that contains "abba" twice.
//
// howSwedish("ABBA a b b a") returns 1
// howSwedish("abbabba!") returns 2
function howSwedish($str)
{
    $count = 0;
    $txt = 'abba';
    for ($i = 0; $i < strlen($str); $i ++) {
        $tmp = substr(strtolower($str), $i, $i + 4);
        if ($tmp == $txt)
            $count ++;
    }
    return $count;
}

echo '     howSwedish(abbabba) 2: ' . howSwedish('abbabba') . "\n";
assert(2 == howSwedish('abbabba'));
echo 'howSwedish(ABBA a b b a) 1: ' . howSwedish("ABBA a b b a") . "\n";

// 2) mirrorEnds
// Complete method mirrorEnds that given a string, looks for a mirror
// image (backwards) string at both the beginning and end of the given string.
// In other words, zero or more characters at the very beginning of the given
// string, and at the very end of the string in reverse order (possibly overlapping).
// For example, "abXYZba" has the mirror end "ab".
//
// assert("" == mirrorEnds(""));
// assert("" == mirrorEnds("abcde"));
// assert("a" == mirrorEnds("abca"));
// assert("aba" == mirrorEnds("aba"));
//
function mirrorEnds($str)
{
    $len = strlen($str);
    $reversed = strrev($str);

    for ($i = 0; $i < $len; $i ++) {
        if (substr_compare($str, $reversed, 0, $i) == 0)
            $answer = substr($str, 0, $i);
    }
    return $answer;
}

mirrorEnds('123456');
echo PHP_EOL . "mirrorEnds(abcdefcba) abc: " . mirrorEnds('abcdefcba') . "\n";
assert('abc' == mirrorEnds('abcdefcba'));
echo "   mirrorEnds(zzRSTzz) zz: " . mirrorEnds('racecar') . "\n";

// 3) isStringSorted
// Given a String, return true if the letters are in ascending order.
// Note: 'a' < 'b' and '5' < '8'
// isStringSorted("") returns true
// isStringSorted("a") returns true
// isStringSorted("abbcddef") returns true
// isStringSorted("123456") returns true
// isStringSorted("12321") returns false
function isStringSorted($str)
{
    for ($i = 0; $i < strlen($str) - 1; $i ++) {
        if (strcmp($str{$i}, $str{$i + 1}) > 0)
            return false;
    }
    return true; // bogus return
}

echo PHP_EOL . '  isStringSorted(abcdefg) 1: ' . isStringSorted('abcdefg') . "\n";
echo '  isStringSorted(cba) false: ' . isStringSorted('cba') . "\n";
assert(! isStringSorted('cba'));
echo 'isStringSorted(abcddeeff) 1: ' . isStringSorted('abcddeeff') . "\n";

// 4) maxBlock
// Given a string, return the length of the largest "block" in the string.
// A block is a run of adjacent chars that are the same.
// maxBlock("hoopla") returns 2
// maxBlock("abbCCCddBBBxx") returns 3
// maxBlock("") returns 0
//
function maxBlock($str)
{
    if (strlen($str) == 0)
        return 0;

    $answer = 0;
    $curr = 1;

    for ($i = 0; $i < strlen($str); $i ++) {
        if ($str{$i} == $str{$i - 1}) {
            $curr ++;
        } else {
            if ($curr > $answer)
                $answer = $curr;
            $curr = 1;
        }
    }
    return max($answer, $curr);
}
echo PHP_EOL . 'maxBlock(abbCCCddBBBxx) 3: ' . maxBlock("abbCCCddBBBxx") . "\n";
assert(3 == maxBlock("abbCCCddBBBxx"));
echo '          maxBlock(abc) 1: ' . maxBlock("abc") . "\n";

// 5) isArraySorted
// Given an array , return true if the element are in ascending order.
// Note: 'abe' < 'ben' and 5 > 3
// Precondition $arr has all the same type of elements
function isArraySorted($arr)
{
    for ($i = 0; $i < count($arr) - 1; $i ++) {
        if ($arr[$i] > $arr[$i + 1])
            return false;
    }
    return true;
}

echo PHP_EOL . 'isArraySorted(array(1, 2, 2, 99) 1: ' . isArraySorted(array(
    1,
    2,
    2,
    99
)) . "\n";
assert(isArraySorted(array(
    1,
    2,
    2,
    99
)));
echo 'isArraySorted(array(2, 2, 1) false: ' . isArraySorted(array(
    2,
    2,
    1
)) . "\n";

// 6) numberOfPairs
// Return the number of times a pair occurs in array. A pair is any two String values that are equal (case
// sensitive) in consecutive array elements. The array may be empty or have only one element. In both of
// these cases, return 0.
//
// numberOfPairs( array('a', 'b', 'c') ) returns 0
// numberOfPairs( array('a', 'a', 'a') ) returns 2
// assert(2 == numberOfPairs( array('a', 'a', 'b', 'b' ) ) );
// numberOfPairs( array ( ) ) returns 0
// numberOfPairs( array ('a') ) returns 0
// Precondition: $arr has all the same type of elements
function numberOfPairs($arr)
{
    if (count($arr) == 0)
        return 0;

    $count = 0;
    for ($i = 0; $i < count($arr) - 1; $i ++) {
        if ($arr[$i] == $arr[$i + 1])
            $count ++;
    }
    return $count; // bogus return
}

echo PHP_EOL . 'numberOfPairs( array(a, a, a) ) 2: ' . numberOfPairs(array(
    'a',
    'a',
    'a'
)) . "\n";
echo '       numberOfPairs( array() ) 0: ' . numberOfPairs(array()) . "\n";

// 7) frequency
// Given an array of integers in the range of 0..10 (like quiz scores),
// return an array of 11 integers where the first value (at index 0) is the
// number of 0s in the array argument, the second value (at index 1) is the number
// of ones in the array and the 11th value (at index 10) is the number of
// tens in the array. The following assertions must pass.
//
// Precondition: $arr has valid ints in the range of 0..10
function frequency($arr)
{
    $answer = array();

    for ($i = 0; $i < 11; $i ++) {
        $count = 0;
        for ($j = 0; $j < count($arr); $j ++) {
            if ($i == $arr[$j])
                $count ++;
        }
        $answer[$i] = $count;
    }
    return $answer;
}

echo PHP_EOL . "Frequency of 0..10" . "\n";
$arr = frequency(array(
    1,
    1,
    4,
    4,
    4,
    9,
    9,
    9,
    9,
    10,
    0,
    0,
    0,
    0,
    0
));
assert(5 == $arr[0]);
assert(1 == $arr[10]);
// Use print_r to show all array elements
print_r($arr);

// 8) shiftNTimes
// Modify array so it is "left shifted" n times -- so shiftNTimes(array(6, 2, 5, 3), 1)
// changes the array argument to (2, 5, 3, 6) and shiftNTimes(array(6, 2, 5, 3), 2)
// changes the array argument to (5, 3, 6, 2). You must modify the array argument by
// changing the parameter array inside method shiftNTimes. A change to the
// parameter inside the method shiftNTimes changes the argument if the
// argument is passed by reference, that means it is preceded by an ampersand &
//
// shiftNTimes( array(1, 2, 3, 4, 5, 6, 7), 3 ) modifies array to ( 4, 5, 6, 7, 1, 2, 3 )
// shiftNTimes( array(1, 2, 3), 5) modifies array to (3, 1, 2)
// shiftNTimes( array(3), 5) modifies array to (3)
//
function shiftNTimes(&$array, $numShifts)
{
    for ($i = 0; $i < $numShifts; $i ++) {
        $tmp = $array[0];
        array_shift($array);
        array_push($array, $tmp);
    }
}

// Precondition: count($nums) >= 1
function maxSpan($nums)
{
    if (count($nums) == 0) {
        return 0;
    }

    $span = 0;
    $tmp = 0;
    $len = count($nums);

    for ($i = 0; $i < $len; $i ++) {
        for ($j = 0; $j < $len; $j ++) {
            if($nums[$i] == $nums[$j]){
                $tmp = $j-$i+1;
                $span = max($span, $tmp);
            }
        }
    }
    return $span;
}
echo "maxspan: " . maxSpan([1, 4, 2, 1, 4, 4, 4]);
// echo count([1, 4, 2, 1, 4, 4, 4]);

$arr = array(
    1,
    2,
    3,
    4
);
shiftNTimes($arr, 2);
assert(3 == $arr[0]);
assert(4 == $arr[1]);
echo PHP_EOL . 'shiftNTimes(array(1, 2, 3, 4),  2)' . "\n";
// Use print_r to see all array elements on separate lines
print_r($arr);

?>
