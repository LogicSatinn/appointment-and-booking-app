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
use Illuminate\Support\Str;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Reservation
 *
 * @property int $id
 * @property int $client_id
 * @property int $timetable_id
 * @property int $booking_id
 * @property int $seat_number
 * @property string $status
 * @property string $reference_code
 * @property Carbon $reserved_at
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Timetable $timetable
 * @property-read Booking $booking
 * @property-read Client $client
 * @method static ReservationFactory factory(...$parameters)
 * @method static Builder|Reservation newModelQuery()
 * @method static Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Query\Builder|Reservation onlyTrashed()
 * @method static Builder|Reservation query()
 * @method static Builder|Reservation whereTimetableId($value)
 * @method static Builder|Reservation whereBookingId($value)
 * @method static Builder|Reservation whereClientId($value)
 * @method static Builder|Reservation whereCreatedAt($value)
 * @method static Builder|Reservation whereDeletedAt($value)
 * @method static Builder|Reservation whereId($value)
 * @method static Builder|Reservation whereReferenceCode($value)
 * @method static Builder|Reservation whereReservedAt($value)
 * @method static Builder|Reservation whereSeatNumber($value)
 * @method static Builder|Reservation whereStatus($value)
 * @method static Builder|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Reservation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Reservation withoutTrashed()
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
            $model->reference_code = 'NL-R' . Str::padLeft(self::max('id') + 1, 6, 0);
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
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'reference_code';
    }
}
