<?php

namespace App\Helpers;

class PhoneHelper
{
    /**
     * Format phone number to international format for WhatsApp
     * 
     * @param string $phone
     * @return string
     */
    public static function formatForWhatsApp($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Handle empty phone
        if (empty($phone)) {
            return '6282229740385'; // Default number
        }
        
        // Convert to international format
        if (substr($phone, 0, 1) === '0') {
            // Remove leading 0 and add 62
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 2) !== '62') {
            // If doesn't start with 62, add it
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
    
    /**
     * Format phone number for display
     * 
     * @param string $phone
     * @return string
     */
    public static function formatForDisplay($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Handle empty phone
        if (empty($phone)) {
            return '+62 822 2974 0385';
        }
        
        // Convert to display format
        if (substr($phone, 0, 2) === '62') {
            // International format to local display
            $localPhone = '0' . substr($phone, 2);
        } elseif (substr($phone, 0, 1) === '0') {
            // Already local format
            $localPhone = $phone;
        } else {
            // Add leading 0
            $localPhone = '0' . $phone;
        }
        
        // Format with spaces for readability
        if (strlen($localPhone) >= 11) {
            return substr($localPhone, 0, 4) . ' ' . 
                   substr($localPhone, 4, 4) . ' ' . 
                   substr($localPhone, 8);
        }
        
        return $localPhone;
    }
    
    /**
     * Validate Indonesian phone number
     * 
     * @param string $phone
     * @return bool
     */
    public static function isValid($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Check if it's a valid Indonesian phone number
        // Should be 10-13 digits
        if (strlen($phone) < 10 || strlen($phone) > 13) {
            return false;
        }
        
        // Should start with 0, 62, 8, or +62
        $validPrefixes = ['0', '62', '8'];
        $startsWithValid = false;
        
        foreach ($validPrefixes as $prefix) {
            if (substr($phone, 0, strlen($prefix)) === $prefix) {
                $startsWithValid = true;
                break;
            }
        }
        
        return $startsWithValid;
    }
}
