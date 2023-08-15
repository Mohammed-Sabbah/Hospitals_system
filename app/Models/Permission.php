<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as spatiePermission;
class Permission extends spatiePermission
{
    use HasFactory ;
}
