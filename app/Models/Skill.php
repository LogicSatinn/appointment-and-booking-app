<?php

namespace App\Models;

use App\States\Skill\Draft;
use App\States\Skill\SkillStatus;
use Carbon\Carbon;
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
use Illuminate\Support\Str;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Skill
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property float $price
 * @property int $category_id
 * @property bool $access
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read Category $category
 * @property-read Collection|resource[] $resources
 * @property-read int|null $resources_count
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|Skill newModelQuery()
 * @method static Builder|Skill newQuery()
 * @method static \Illuminate\Database\Query\Builder|Skill onlyTrashed()
 * @method static Builder|Skill query()
 * @method static Builder|Skill whereCategoryId($value)
 * @method static Builder|Skill whereCreatedAt($value)
 * @method static Builder|Skill whereDeletedAt($value)
 * @method static Builder|Skill whereDescription($value)
 * @method static Builder|Skill whereId($value)
 * @method static Builder|Skill whereTitle($value)
 * @method static Builder|Skill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Skill withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Skill withoutTrashed()
 * @mixin Eloquent
 * @property string $status
 * @method static Builder|Skill whereStatus($value)
 * @property-read Collection|Timetable[] $timetables
 * @property-read int|null $timetables_count
 * @property string|null $image_path
 * @method static Builder|Skill whereImagePath($value)
 * @property string $slug
 * @method static Builder|Skill whereSlug($value)
 * @property string $mode_of_delivery
 * @property string $prerequisite
 * @property string $suitable_for
 * @method static SkillFactory factory(...$parameters)
 * @method static Builder|Skill whereModeOfDelivery($value)
 * @method static Builder|Skill wherePrerequisite($value)
 * @method static Builder|Skill whereSuitableFor($value)
 * @method static Builder|Skill orWhereNotState(string $column, $states)
 * @method static Builder|Skill orWhereState(string $column, $states)
 * @method static Builder|Skill whereNotState(string $column, $states)
 * @method static Builder|Skill whereState(string $column, $states)
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->status = Draft::class;
        });
    }

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
            set: fn () => strtolower(Str::snake($this->title, '-'))
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
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
