<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\CategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $note
 * @property int $added_by
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $addedBy
 * @property-read Collection|Skill[] $skills
 * @property-read int|null $skills_count
 * @method static CategoryFactory factory(...$parameters)
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|Category onlyTrashed()
 * @method static Builder|Category query()
 * @method static Builder|Category whereAddedBy($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereDeletedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereNote($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Category withoutTrashed()
 * @mixin Eloquent
 * @property string $slug
 * @method static Builder|Category whereSlug($value)
 */
class Category extends Model
{
    use HasFactory, SoftDeletes;

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
            $model->added_by = auth()->id();
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * @return BelongsTo
     */
    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
