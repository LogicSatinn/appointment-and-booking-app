<?php

namespace App\Models;

use App\States\Skill\Draft;
use App\States\Skill\SkillStatus;
use Database\Factories\SkillFactory;
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
 * App\Models\Skill
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $mode_of_delivery
 * @property string $prerequisite
 * @property string $suitable_for
 * @property mixed $status
 * @property string|null $image_path
 * @property int $category_id
 * @property int $created_by
 * @property int|null $last_modified_by
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read Category $category
 * @property-read User $createdBy
 * @property-read User|null $lastModifiedBy
 * @property-read Collection|Resource[] $resources
 * @property-read int|null $resources_count
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read Collection|Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @method static SkillFactory factory(...$parameters)
 * @method static Builder|Skill newModelQuery()
 * @method static Builder|Skill newQuery()
 * @method static DatabaseQueryBuilder|Skill onlyTrashed()
 * @method static Builder|Skill orWhereNotState(string $column, $states)
 * @method static Builder|Skill orWhereState(string $column, $states)
 * @method static Builder|Skill query()
 * @method static Builder|Skill whereCategoryId($value)
 * @method static Builder|Skill whereCreatedAt($value)
 * @method static Builder|Skill whereCreatedBy($value)
 * @method static Builder|Skill whereDeletedAt($value)
 * @method static Builder|Skill whereDescription($value)
 * @method static Builder|Skill whereId($value)
 * @method static Builder|Skill whereImagePath($value)
 * @method static Builder|Skill whereLastModifiedBy($value)
 * @method static Builder|Skill whereModeOfDelivery($value)
 * @method static Builder|Skill whereNotState(string $column, $states)
 * @method static Builder|Skill wherePrerequisite($value)
 * @method static Builder|Skill whereSlug($value)
 * @method static Builder|Skill whereState(string $column, $states)
 * @method static Builder|Skill whereStatus($value)
 * @method static Builder|Skill whereSuitableFor($value)
 * @method static Builder|Skill whereTitle($value)
 * @method static Builder|Skill whereUpdatedAt($value)
 * @method static DatabaseQueryBuilder|Skill withTrashed()
 * @method static DatabaseQueryBuilder|Skill withoutTrashed()
 * @mixin Eloquent
 */
class Skill extends Model
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
        'title' => 'string',
        'slug' => 'string',
        'category_id' => 'integer',
        'status' => SkillStatus::class,
        'image_path' => 'string',
        'description' => 'string',
        'mode_of_delivery' => 'string',
        'prerequisite' => 'string',
        'suitable_for' => 'string',
    ];

    /**
     * @return Attribute
     */
    public function slug(): Attribute
    {
        return Attribute::make(
            set: fn () => Str::snake(strtolower($this->title), '-')
        );
    }

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return HasMany
     */
    public function timetables(): HasMany
    {
        return $this->hasMany(Timetable::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany
     */
    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
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
