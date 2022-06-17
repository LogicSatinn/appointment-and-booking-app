<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property-read Collection|Resource[] $resources
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
 * @mixin \Eloquent
 */
class Skill extends Model
{
    use HasFactory, SoftDeletes;

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
        'price' => 'decimal:2',
        'category_id' => 'integer',
        'access' => 'boolean',
    ];


    public function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value)
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
}
