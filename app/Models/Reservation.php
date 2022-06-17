<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\ReservationFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Reservation
 *
 * @property int $id
 * @property int $client_id
 * @property int $appointment_id
 * @property int $booking_id
 * @property int $seat_number
 * @property string $status
 * @property string $reference_code
 * @property Carbon $reserved_at
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Appointment $appointment
 * @property-read Booking $booking
 * @property-read Client $client
 * @method static ReservationFactory factory(...$parameters)
 * @method static Builder|Reservation newModelQuery()
 * @method static Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Query\Builder|Reservation onlyTrashed()
 * @method static Builder|Reservation query()
 * @method static Builder|Reservation whereAppointmentId($value)
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
 * @mixin \Eloquent
 */
class Reservation extends Model
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
        'client_id' => 'integer',
        'appointment_id' => 'integer',
        'booking_id' => 'integer',
        'reserved_at' => 'timestamp',
    ];

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
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * @return BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

}
