<?php

namespace App\Models;

use App\States\Resource\Available;
use App\States\Resource\ResourceState;
use Carbon\Carbon;
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection|\App\Models\Skill[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\User $createdBy
 * @property-read \App\Models\User|null $lastModifiedBy
 * @property-read Collection|\App\Models\Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @method static \Database\Factories\ResourceFactory factory(...$parameters)
 * @method static Builder|Resource newModelQuery()
 * @method static Builder|Resource newQuery()
 * @method static \Illuminate\Database\Query\Builder|Resource onlyTrashed()
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->name;
            $model->state = Available::class;
            $model->created_by = auth()->id();
        });
    }

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
    public function lastModifiedBy()
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
