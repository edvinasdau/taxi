<?php
//
//$arr = [1, 5, 8, 2, 6, 7];

//function getMin($arr)
//{
//    if (!empty($arr)) {
//
//        $temp = $arr[0];
//        foreach ($arr as $x) {
//            if ($x < $temp) {
//                $temp = $x;
//            }
//        }
//        return $temp;
//    } else {
//        return null;
//    }
//}
//
//function getMax($arr)
//{
//    $temp = $arr[0];
//    foreach ($arr as $x) {
//        if ($x > $temp) {
//            $temp = $x;
//        }
//    }
//    return $temp;
//}
//
//var_dump(getMin($arr) === 1);
//var_dump(getMax($arr) === 8);
//var_dump(getMin([]) === null);

//function sumOfEvenNumbers($arr) {
//    foreach ($arr as $item) {
//        if ($item % 2 == 0) {
//            $array [] = $item;
//        }
//    }
//    return array_sum($array);
//}
//
//var_dump(sumOfEvenNumbers($arr) === 16);


//function hahaha ($arr) {
//    $array = [];
//    for($i = 0; $i < count($arr); $i++) {
//        if ($arr[0] < $arr[$i]){
//            $array [] = $arr[0];
//        }
//    }
//}
//
//var_dump(hahaha($arr));

//$arr = [-5, -4, -3, -2, 1, 2, 5];
//
//
//function closestToZero($arr) {
//    if (!empty($arr)) {
//        foreach ($arr as $i) {
//            $array[] = abs($i);
//        }
//        return min($array);
//    }
//    else {
//        return null;
//    }
//}
//
//var_dump(closestToZero($arr) === 1);
//var_dump(closestToZero([]) === null);

//function sumOfPrimes($n){
////    $primes = [2];
////    $i = 3;
////    while (count($primes) < $n) {
////        $prime = true;
////
////        foreach ($primes as $single) {
////            if ($i % $single == 0){
////                $prime = false;
////                break;
////            }
////        }
////
////        if ($prime) {
////            $primes[] = $i;
////        }
////        $i += 2;
////    }
////    return array_sum($primes);
////}
//
//var_dump(sumOfPrimes(3) == 10);
//var_dump(sumOfPrimes(8) == 10+7+11+13+17+19);


//$primes = [2];
//
//for ($i = 3; $i < 120; $i += 2) {
//
//    $prime = true;
//    foreach($primes as $single) {
//        if ($i % $single == 0) {
//            $prime = false;
//                break;
//        }
//    }
//    if ($prime) {
//        $primes[] = $i;
//    }
//}
//
//foreach ($primes as $split) {
//    foreach((str_split($split)) as $a) {
//        $str [] = $a;
//    }
//}
//var_dump(array_count_values($str));

// nl2br($text) - nauja eilute
//strpos
//substr($text, 2, 6 (kiek kirpti simboliu)) - iskerpa daly stringo.


//project euler uzdavinys 3:
//    $primes = [2];
//    $i = 3;
//    while (count($primes) < 6000) {
//        $prime = true;
//
//        foreach ($primes as $single) {
//            if ($i % $single == 0){
//                $prime = false;
//                break;
//            }
//        }
//
//        if ($prime) {
//            $primes[] = $i;
//        }
//        $i += 2;
//    }
//foreach ($primes as $prime) {
//    if (600851475143 % $prime == 0){
//        $arr[] = $prime;
//    }
//}
//
//echo max($arr);

//project euler uzdavinys 4 :
//for ($i = 100; $i < 999; $i++){
//    for($x = 100; $x < 999; $x++){
//        $palindromic = $x * $i;
//        if ((string)$palindromic === strrev ((string)$palindromic)) {
//            $arr[] = $palindromic;
//        } else {
//        }
//    }
//}
//var_dump(max($arr));