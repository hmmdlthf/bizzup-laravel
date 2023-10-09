<?php

if (!function_exists('generateUid')) {
    function generateUid($prefix) {
        // Generate a random 4-digit number
        $randomNumber = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // Combine the prefix and random number to create the UID
        $uid = $prefix . $randomNumber;
        
        return $uid;
    }
}

if (!function_exists('generateAlphaPrefix')) {
    function generateAlphaPrefix() {
        // Generate a random uppercase letter followed by a random lowercase letter
        $prefix = chr(rand(65, 90)) . chr(rand(65, 90));
        
        return $prefix;
    }
}
