<?php

namespace App\Models;

use App\Enums\SkillLevel;
use App\States\Timetable\Complete;
use App\States\Timetable\NotStarted;
use App\States\Timetable\OnGoing;
use App\States\Timetable\TimetableState;
use Carbon\Carbon;
use Database\Factories\TimetableFactory;
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
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Timetable
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property SkillLevel $level
 * @property string $from
 * @property string $to
 * @property string $start
 * @property string $end
 * @property mixed $status
 * @property string $price
 * @property int $resource_id
 * @property int $skill_id
 * @property int $created_by
 * @property int|null $last_modified_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection|Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read User $createdBy
 * @property-read User|null $lastModifiedAt
 * @property-read Collection|Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read Resource $resource
 * @property-read Skill $skill
 * @method static TimetableFactory factory(...$parameters)
 * @method static Builder|Timetable newModelQuery()
 * @method static Builder|Timetable newQuery()
 * @method static DatabaseQueryBuilder|Timetable onlyTrashed()
 * @method static Builder|Timetable orWhereNotState(string $column, $states)
 * @method static Builder|Timetable orWhereState(string $column, $states)
 * @method static Builder|Timetable query()
 * @method static Builder|Timetable whereCreatedAt($value)
 * @method static Builder|Timetable whereCreatedBy($value)
 * @method static Builder|Timetable whereDeletedAt($value)
 * @method static Builder|Timetable whereEnd($value)
 * @method static Builder|Timetable whereFrom($value)
 * @method static Builder|Timetable whereId($value)
 * @method static Builder|Timetable whereLastModifiedBy($value)
 * @method static Builder|Timetable whereLevel($value)
 * @method static Builder|Timetable whereNotState(string $column, $states)
 * @method static Builder|Timetable wherePrice($value)
 * @method static Builder|Timetable whereResourceId($value)
 * @method static Builder|Timetable whereSkillId($value)
 * @method static Builder|Timetable whereSlug($value)
 * @method static Builder|Timetable whereStart($value)
 * @method static Builder|Timetable whereState(string $column, $states)
 * @method static Builder|Timetable whereStatus($value)
 * @method static Builder|Timetable whereTitle($value)
 * @method static Builder|Timetable whereTo($value)
 * @method static Builder|Timetable whereUpdatedAt($value)
 * @method static DatabaseQueryBuilder|Timetable withTrashed()
 * @method static DatabaseQueryBuilder|Timetable withoutTrashed()
 * @mixin Eloquent
 */
class Timetable extends Model
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
        'status' => TimetableState::class,
        'price' => 'decimal:2',
        'resource_id' => 'integer',
        'skill_id' => 'integer',
        'level' => SkillLevel::class,
    ];

    /**
     * @return Attribute
     */
    public function from(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::create($value)->toFormattedDateString(),
            set: fn ($value) => date(format: 'Y-m-d', timestamp: strtotime(str_replace(search: '/', replace: '-', subject: $value)))
        );
    }

    /**
     * @return Attribute
     */
    public function to(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::create($value)->toFormattedDateString(),
            set: fn ($value) => date(format: 'Y-m-d', timestamp: strtotime(str_replace(search: '/', replace: '-', subject: $value)))
        );
    }

    /**
     * @return Attribute
     */
    public function duration(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse(time: $this->from)->diffInDays($this->to),
        );
    }

    /**
     * @return string
     */
    public function representablePrice(): string
    {
        return 'TZS'.' '.number_format($this->price);
    }

    /**
     * @return Attribute
     */
    public function start(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date(format: 'H:i', timestamp: strtotime($value))
        );
    }

    /**
     * @return Attribute
     */
    public function end(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date(format: 'H:i', timestamp: strtotime($value))
        );
    }

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(related: Booking::class, foreignKey: 'timetable_id');
    }

    /**
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(related: Reservation::class, foreignKey: 'timetable_id');
    }

    /**
     * @return BelongsTo
     */
    public function resource(): BelongsTo
    {
        return $this->belongsTo(related: Resource::class, foreignKey: 'resource_id');
    }

    /**
     * @return BelongsTo
     */
    public function skill(): BelongsTo
    {
        return $this->belongsTo(related: Skill::class, foreignKey: 'skill_id');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function lastModifiedAt(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'last_modified_by');
    }

    /**
     * @return bool
     */
    public function hasNotStarted(): bool
    {
        return $this->status->equals(NotStarted::class);
    }

    /**
     * @return bool
     */
    public function isOnGoing(): bool
    {
        return $this->status->equals(OnGoing::class);
    }

    /**
     * @return bool
     */
    public function isComplete(): bool
    {
        return $this->status->equals(Complete::class);
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
