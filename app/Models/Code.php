<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public static function generateUniqueCode()
    {
        do {
            $code = mt_rand(100000, 999999);
        } while (!static::isValidCode($code));

        return $code;
    }

    public static function isValidCode($code)
    {
        $code = (string) $code;
        $codeInstance = new static();

            if (strlen($code) !== 6 || !is_numeric($code)) {
                return ['valid' => false, 'reason' => 'Code must be 6 numeric digits'];
            }

            if ($codeInstance->isPalindrome($code)) {
                return ['valid' => false, 'reason' => 'Code is a palindrome'];
            }

            if ($codeInstance->hasRepeatedChars($code)) {
                return ['valid' => false, 'reason' => 'Code has a character repeated more than three times'];
            }

            if ($codeInstance->hasLongSequence($code)) {
                return ['valid' => false, 'reason' => 'Code has a sequence length greater than three'];
            }

            if ($codeInstance->hasEnoughUniqueChars($code)) {
                return ['valid' => false, 'reason' => 'Code does not have at least three unique characters'];
            }

            return ['valid' => true, 'reason' => 'Code is valid'];
    }

    private function isPalindrome($code)
    {
        return $code === strrev($code);
    }

    private function hasRepeatedChars($code)
    {
        return preg_match('/(\d)\1{3,}/', $code);
    }

    private function hasLongSequence($code)
    {
        return preg_match('/012|123|234|345|456|567|678|789/', $code);
    }

    private function hasEnoughUniqueChars($code)
    {
        return count(array_unique(str_split($code))) >= 3;
    }
}
