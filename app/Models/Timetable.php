<?php

namespace App\Models;

use App\States\Timetable\TimetableState;
use Carbon\Carbon;
use Database\Factories\TimetableFactory;
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

/**
 * App\Models\Timetable
 *
 * @property int $id
 * @property string $title
 * @property Carbon $duration
 * @property Carbon $timetable_time
 * @property int $resource_id
 * @property int $skill_id
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $from
 * @property string $to
 * @property string $start
 * @property string $end
 * @property string $status
 * @property string $price
 * @property int $client_id
 * @property int $skills_id
 * @property-read Collection|Client[] $clients
 * @property-read int|null $clients_count
 * @property-read Skill|null $skill
 * @property-read Collection|Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read Resource $resource
 * @method static TimetableFactory factory(...$parameters)
 * @method static Builder|Timetable newModelQuery()
 * @method static Builder|Timetable newQuery()
 * @method static \Illuminate\Database\Query\Builder|Timetable onlyTrashed()
 * @method static Builder|Timetable query()
 * @method static Builder|Timetable whereClientId($value)
 * @method static Builder|Timetable whereCreatedAt($value)
 * @method static Builder|Timetable whereDeletedAt($value)
 * @method static Builder|Timetable whereDuration($value)
 * @method static Builder|Timetable whereEnd($value)
 * @method static Builder|Timetable whereFrom($value)
 * @method static Builder|Timetable whereId($value)
 * @method static Builder|Timetable wherePrice($value)
 * @method static Builder|Timetable whereResourceId($value)
 * @method static Builder|Timetable whereSkillsId($value)
 * @method static Builder|Timetable whereStart($value)
 * @method static Builder|Timetable whereStatus($value)
 * @method static Builder|Timetable whereTo($value)
 * @method static Builder|Timetable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Timetable withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Timetable withoutTrashed()
 * @mixin \Eloquent
 * @method static Builder|Timetable whereSkillId($value)
 * @method static Builder|Timetable whereTitle($value)
 * @property string $slug
 * @method static Builder|Timetable whereSlug($value)
 */
class Timetable extends Model
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
        'status' => TimetableState::class,
        'price' => 'decimal:2',
        'resource_id' => 'integer',
        'skill_id' => 'integer',
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
     * @return Attribute
     */
    public function from(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::create($value)->toFormattedDateString(),
            set: fn ($value) => date('Y-m-d', strtotime(str_replace('/', '-', $value)))
        );
    }


    /**
     * @return Attribute
     */
    public function to(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::create($value)->toFormattedDateString(),
            set: fn ($value) => date('Y-m-d', strtotime(str_replace('/', '-', $value)))
        );
    }

    /**
     * @return Attribute
     */
    public function duration(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->from)->diffInDays($this->to),
        );
    }

    /**
     * @return Attribute
     */
    public function representablePrice(): Attribute
    {
        return Attribute::make(
            get: fn () => 'TZS' . ' ' . number_format($this->price),
        );
    }


    /**
     * @return Attribute
     */
    public function start(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('H:i', strtotime($value))
        );
    }


    /**
     * @return Attribute
     */
    public function end(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('H:i', strtotime($value))
        );
    }

    /**
     * @return Attribute
     */
    public function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value)
        );
    }


    /**
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * @return BelongsTo
     */
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

    /**
     * @return BelongsTo
     */
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }


    /**
     * @return BelongsToMany
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class)
            ->withPivot('no_of_seats')
            ->withTimestamps();
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
