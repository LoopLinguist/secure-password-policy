<?php

namespace LoopLinguist\SecurePasswordPolicy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    use HasFactory; // Include the HasFactory trait in the model

    protected $fillable = ['password']; // Specify the fillable fields of the model

    public function user()
    {
        return $this->belongsTo(User::class);  // Define a many-to-one relationship with the User model
    }
}
