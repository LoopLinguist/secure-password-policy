# Laravel Secure Passwords Policy

This is used to prevent the use of previously used passwords for Laravel.

## Installation

Install using [Composer](https://getcomposer.org)

```bash
composer require looplinguist/secure-password-policy
```


#### User model 
Update the User model to define a relationship with the password_histories table. You can add the following code to the User model:

```php

use Illuminate\Database\Eloquent\Relations\HasMany;
use LoopLinguist\SecurePasswordPolicy\Models\PasswordHistory;

class User extends Authenticatable
{
    //  ... 

    public function passwordHistories(): HasMany
    {
        return $this->hasMany(PasswordHistory::class);
    }
}
```

#### Method 
Add the following code to the method that handles password changes:

```php

use LoopLinguist\SecurePasswordPolicy\Http\HasPasswordHistory;

 if ((new HasPasswordHistory($request->input('password')))->hasHistory()) {
            return response()->json([
                'message' => 'Password found.'
            ], 409);
        }
```           
    
Publish the config file with:

```bash
php artisan vendor:publish --tag=secure-password-policy-config    
```
This is the content of the file that will be published in config/secure-password-policy.php


Publish the migrations with:

```bash
php artisan vendor:publish --tag=secure-password-policy-migrations    
```

```bash
php artisan migrate
```

