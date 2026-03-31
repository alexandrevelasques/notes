<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Operations
{
    //password decryption
    public static function decryptId($value)
    {
        try {
            $value = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            return null;
        }
        return $value;
    }
}
