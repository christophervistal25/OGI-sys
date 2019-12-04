<?php 
if (! function_exists('addSuffixToLevel')) {
    function addSuffixToLevel($level)
    {
        if ($level == 1) {
        	return '1st';
        } elseif ($level == 2) {
        	return '2nd';
        } elseif ($level == 3) {
        	return '3rd';
        } elseif ($level == 4) {
        	return '4th';
        } elseif ($level == 5) {
        	return '5th';
        }
    }
}