<?php

namespace  LoopLinguist\SecurePasswordPolicy\Http;

use LoopLinguist\SecurePasswordPolicy\Models\PasswordHistory;
use Illuminate\Support\Facades\Auth;
use LoopLinguist\SecurePasswordPolicy\Http\Interfaces\PasswordHistory as _PasswordHistory;
use Illuminate\Support\Facades\Hash;

class HasPasswordHistory implements _PasswordHistory
{
    private $newPassword;

    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    public function hasHistory()
    {
        // Check if the new password matches any of the previous password hashes
        if (Auth::user()->passwordHistories->pluck('password')->contains(fn ($value) => Hash::check($this->newPassword, $value))) {
            return true;
        }
        // Create a new password history record for the user
        Auth::user()->passwordHistories()->save(new PasswordHistory([
            'password' => Hash::make($this->newPassword),
        ]));
        return false;
    }
}
