<?php

namespace App\Models;

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
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Support\Carbon as BaseCarbon;
use Illuminate\Support\Str;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $note
 * @property int $created_by
 * @property BaseCarbon|null $deleted_at
 * @property BaseCarbon|null $created_at
 * @property BaseCarbon|null $updated_at
 * @property-read User $createdBy
 * @property-read Collection|Skill[] $skills
 * @property-read int|null $skills_count
 * @method static CategoryFactory factory(...$parameters)
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static DatabaseQueryBuilder|Category onlyTrashed()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereCreatedBy($value)
 * @method static Builder|Category whereDeletedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereNote($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @method static DatabaseQueryBuilder|Category withTrashed()
 * @method static DatabaseQueryBuilder|Category withoutTrashed()
 * @mixin Eloquent
 */
class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, mixed>
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
            set: fn () => strtolower(Str::snake(value: $this->name, delimiter:  '-'))
        );
    }

    /**
     * @return HasMany
     */
    public function skills(): HasMany
    {
        return $this->hasMany(related: Skill::class, foreignKey: 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'created_by');
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
