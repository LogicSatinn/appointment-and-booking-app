<?php

namespace App\Models;

use App\States\Resource\ResourceState;
use Database\Factories\ResourceFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Resource
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $note
 * @property int $capacity
 * @property mixed|null $state
 * @property int $created_by
 * @property int|null $last_modified_by
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Skill[] $courses
 * @property-read int|null $courses_count
 * @property-read User $createdBy
 * @property-read User|null $lastModifiedBy
 * @property-read Collection|Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @method static ResourceFactory factory(...$parameters)
 * @method static Builder|Resource newModelQuery()
 * @method static Builder|Resource newQuery()
 * @method static DatabaseQueryBuilder|Resource onlyTrashed()
 * @method static Builder|Resource orWhereNotState(string $column, $states)
 * @method static Builder|Resource orWhereState(string $column, $states)
 * @method static Builder|Resource query()
 * @method static Builder|Resource whereCapacity($value)
 * @method static Builder|Resource whereCreatedAt($value)
 * @method static Builder|Resource whereCreatedBy($value)
 * @method static Builder|Resource whereDeletedAt($value)
 * @method static Builder|Resource whereId($value)
 * @method static Builder|Resource whereLastModifiedBy($value)
 * @method static Builder|Resource whereName($value)
 * @method static Builder|Resource whereNotState(string $column, $states)
 * @method static Builder|Resource whereNote($value)
 * @method static Builder|Resource whereSlug($value)
 * @method static Builder|Resource whereState($value)
 * @method static Builder|Resource whereUpdatedAt($value)
 * @method static DatabaseQueryBuilder|Resource withTrashed()
 * @method static DatabaseQueryBuilder|Resource withoutTrashed()
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
     * @return Attribute
     */
    public function slug(): Attribute
    {
        return Attribute::make(
            set: fn () => strtolower(Str::snake($this->name, '-'))
        );
    }

    /**
     * @return HasMany
     */
    public function timetables(): HasMany
    {
        return $this->hasMany(Timetable::class);
    }

    /**
     * @return BelongsToMany
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function lastModifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_modified_by');
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
