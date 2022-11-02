<?php

namespace App\Models;

use Database\Factories\InstructorFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;

/**
 * App\Models\Instructor
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string $password
 * @property string $email_verified_at
 * @property int $banned_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static InstructorFactory factory(...$parameters)
 * @method static Builder|Instructor newModelQuery()
 * @method static Builder|Instructor newQuery()
 * @method static DatabaseQueryBuilder|Instructor onlyTrashed()
 * @method static Builder|Instructor query()
 * @method static Builder|Instructor whereBannedAt($value)
 * @method static Builder|Instructor whereCreatedAt($value)
 * @method static Builder|Instructor whereDeletedAt($value)
 * @method static Builder|Instructor whereEmail($value)
 * @method static Builder|Instructor whereEmailVerifiedAt($value)
 * @method static Builder|Instructor whereId($value)
 * @method static Builder|Instructor whereName($value)
 * @method static Builder|Instructor wherePassword($value)
 * @method static Builder|Instructor wherePhoneNumber($value)
 * @method static Builder|Instructor whereRememberToken($value)
 * @method static Builder|Instructor whereUpdatedAt($value)
 * @method static DatabaseQueryBuilder|Instructor withTrashed()
 * @method static DatabaseQueryBuilder|Instructor withoutTrashed()
 * @mixin Eloquent
 */
class Instructor extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'banned_at' => 'timestamp',
    ];
}
