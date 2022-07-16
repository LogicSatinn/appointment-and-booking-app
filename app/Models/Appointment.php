<?php

namespace App\Models;

use App\States\Appointment\AppointmentState;
use Carbon\Carbon;
use Database\Factories\AppointmentFactory;
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
 * App\Models\Appointment
 *
 * @property int $id
 * @property string $title
 * @property Carbon $duration
 * @property Carbon $appointment_time
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
 * @method static AppointmentFactory factory(...$parameters)
 * @method static Builder|Appointment newModelQuery()
 * @method static Builder|Appointment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Appointment onlyTrashed()
 * @method static Builder|Appointment query()
 * @method static Builder|Appointment whereClientId($value)
 * @method static Builder|Appointment whereCreatedAt($value)
 * @method static Builder|Appointment whereDeletedAt($value)
 * @method static Builder|Appointment whereDuration($value)
 * @method static Builder|Appointment whereEnd($value)
 * @method static Builder|Appointment whereFrom($value)
 * @method static Builder|Appointment whereId($value)
 * @method static Builder|Appointment wherePrice($value)
 * @method static Builder|Appointment whereResourceId($value)
 * @method static Builder|Appointment whereSkillsId($value)
 * @method static Builder|Appointment whereStart($value)
 * @method static Builder|Appointment whereStatus($value)
 * @method static Builder|Appointment whereTo($value)
 * @method static Builder|Appointment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Appointment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Appointment withoutTrashed()
 * @mixin \Eloquent
 * @method static Builder|Appointment whereSkillId($value)
 * @method static Builder|Appointment whereTitle($value)
 * @property string $slug
 * @method static Builder|Appointment whereSlug($value)
 */
class Appointment extends Model
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
        'status' => AppointmentState::class,
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
    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'TZS' . ' ' . $value,
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
        return $this->belongsToMany(Client::class);
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
