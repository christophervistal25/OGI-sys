<?php 
if (! function_exists('addSuffixToLevel')) {
    function addSuffixToLevel($level)
    {
        if ($level == 1 || strtolower($level) == 'first') {
        	return '1st';
        } elseif ($level == 2 || strtolower($level) == 'second') {
        	return '2nd';
        } elseif ($level == 3 || strtolower($level) == 'third') {
        	return '3rd';
        } elseif ($level == 4 || strtolower($level) == 'fourth') {
        	return '4th';
        } elseif ($level == 5 || strtolower($level) == 'fifth') {
        	return '5th';
        }
    }
}