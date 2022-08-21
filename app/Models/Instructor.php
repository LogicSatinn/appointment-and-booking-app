<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\InstructorFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Instructor
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string $password
 * @property string $email_verified_at
 * @property Carbon $banned_at
 * @property string $remember_token
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static InstructorFactory factory(...$parameters)
 * @method static Builder|Instructor newModelQuery()
 * @method static Builder|Instructor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Instructor onlyTrashed()
 * @method static Builder|Instructor query()
 * @method static \Illuminate\Database\Query\Builder|Instructor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Instructor withoutTrashed()
 * @mixin \Eloquent
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
 */
class Instructor extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
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
