<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Master
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string|null $emailVerifiedAt
 * @property string $password
 * @property string|null $rememberToken
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Master extends Model
{
    use ModelAttributesAccess;

    protected $fillable = ['name', 'email', 'mobile', 'email_verified_at', 'password', 'remember_token'];
}
