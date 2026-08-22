<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['email', 'code', 'expires_at'])]
class PasswordResetCode extends Model
{
    //
}
