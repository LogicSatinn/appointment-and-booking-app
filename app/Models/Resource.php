<?php

namespace App\Models;

use App\States\Resource\ResourceState;
use Carbon\Carbon;
use Database\Factories\ResourceFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Resource
 *
 * @property int $id
 * @property string $name
 * @property int $no_of_seats
 * @property bool $available
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $note
 * @property int $capacity
 * @property-read Collection|Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read Collection|Skill[] $courses
 * @property-read int|null $courses_count
 * @method static ResourceFactory factory(...$parameters)
 * @method static Builder|Resource newModelQuery()
 * @method static Builder|Resource newQuery()
 * @method static \Illuminate\Database\Query\Builder|Resource onlyTrashed()
 * @method static Builder|Resource query()
 * @method static Builder|Resource whereAvailable($value)
 * @method static Builder|Resource whereCapacity($value)
 * @method static Builder|Resource whereCreatedAt($value)
 * @method static Builder|Resource whereDeletedAt($value)
 * @method static Builder|Resource whereId($value)
 * @method static Builder|Resource whereName($value)
 * @method static Builder|Resource whereNote($value)
 * @method static Builder|Resource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Resource withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Resource withoutTrashed()
 * @mixin Eloquent
 */
class Resource extends Model
{
    use HasFactory, SoftDeletes, HasStates;


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'state' => ResourceState::class,
    ];

    /**
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * @return BelongsToMany
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }
}
