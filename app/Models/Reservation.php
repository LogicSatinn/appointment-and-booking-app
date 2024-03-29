<?php

namespace App\Models;

use App\States\Reservation\ReservationStatus;
use Carbon\Carbon;
use Database\Factories\ReservationFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Support\Str;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Reservation
 *
 * @property int $id
 * @property string $reference_code
 * @property int|null $no_of_seats
 * @property mixed $status
 * @property int $client_id
 * @property int $timetable_id
 * @property int|null $last_modified_by
 * @property string $reserved_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Booking|null $booking
 * @property-read Client $client
 * @property-read User|null $lastModifiedBy
 * @property-read Timetable $timetable
 * @method static ReservationFactory factory(...$parameters)
 * @method static Builder|Reservation newModelQuery()
 * @method static Builder|Reservation newQuery()
 * @method static DatabaseQueryBuilder|Reservation onlyTrashed()
 * @method static Builder|Reservation orWhereNotState(string $column, $states)
 * @method static Builder|Reservation orWhereState(string $column, $states)
 * @method static Builder|Reservation query()
 * @method static Builder|Reservation whereClientId($value)
 * @method static Builder|Reservation whereCreatedAt($value)
 * @method static Builder|Reservation whereDeletedAt($value)
 * @method static Builder|Reservation whereId($value)
 * @method static Builder|Reservation whereLastModifiedBy($value)
 * @method static Builder|Reservation whereNoOfSeats($value)
 * @method static Builder|Reservation whereNotState(string $column, $states)
 * @method static Builder|Reservation whereReferenceCode($value)
 * @method static Builder|Reservation whereReservedAt($value)
 * @method static Builder|Reservation whereState(string $column, $states)
 * @method static Builder|Reservation whereStatus($value)
 * @method static Builder|Reservation whereTimetableId($value)
 * @method static Builder|Reservation whereUpdatedAt($value)
 * @method static DatabaseQueryBuilder|Reservation withTrashed()
 * @method static DatabaseQueryBuilder|Reservation withoutTrashed()
 * @mixin Eloquent
 */
class Reservation extends Model
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
        'status' => ReservationStatus::class,
        'reference_code' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->reference_code = 'NL-R'.Str::padLeft(self::max('id') + 1, 6, 0);
            $model->reserved_at = now();
        });

        static::created(function ($model) {

        });
    }

    /**
     * @return Attribute
     */
    public function reservedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d F Y - H:i')
        );
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return BelongsTo
     */
    public function timetable(): BelongsTo
    {
        return $this->belongsTo(Timetable::class);
    }

    /**
     * @return HasOne
     */
    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
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
        return 'reference_code';
    }
}
