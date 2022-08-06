<?php

namespace App\Models;

use App\Enums\BookingMethod;
use App\States\Booking\BookingState;
use Carbon\Carbon;
use Database\Factories\BookingFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Booking
 *
 * @property int $id
 * @property int $client_id
 * @property int $skill_id
 * @property string $status
 * @property string $reference_code
 * @property Carbon $booked_at
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $timetable_id
 * @property-read Client $client
 * @property-read Skill|null $skill
 * @property-read Collection|Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read Collection|Reservation[] $reservations
 * @property-read int|null $reservations_count
 *
 * @method static BookingFactory factory(...$parameters)
 * @method static Builder|Booking newModelQuery()
 * @method static Builder|Booking newQuery()
 * @method static \Illuminate\Database\Query\Builder|Booking onlyTrashed()
 * @method static Builder|Booking query()
 * @method static Builder|Booking whereTimetableId($value)
 * @method static Builder|Booking whereBookedAt($value)
 * @method static Builder|Booking whereClientId($value)
 * @method static Builder|Booking whereCreatedAt($value)
 * @method static Builder|Booking whereDeletedAt($value)
 * @method static Builder|Booking whereId($value)
 * @method static Builder|Booking whereReferenceCode($value)
 * @method static Builder|Booking whereStatus($value)
 * @method static Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Booking withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Booking withoutTrashed()
 * @mixin \Eloquent
 *
 * @property string $paid_amount
 * @property string $total_amount
 * @property string $due_amount
 * @property BookingMethod|null $booking_method
 * @property-read Timetable $timetable
 *
 * @method static Builder|Booking orWhereNotState(string $column, $states)
 * @method static Builder|Booking orWhereState(string $column, $states)
 * @method static Builder|Booking whereBookingMethod($value)
 * @method static Builder|Booking whereDueAmount($value)
 * @method static Builder|Booking whereNotState(string $column, $states)
 * @method static Builder|Booking wherePaidAmount($value)
 * @method static Builder|Booking whereState(string $column, $states)
 * @method static Builder|Booking whereTotalAmount($value)
 */
class Booking extends Model
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
        'client_id' => 'integer',
        'timetable_id' => 'integer',
        'status' => BookingState::class,
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
        'booking_method' => BookingMethod::class,
    ];

    /**
     * @return Attribute
     */
    public function bookedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::create($value)->toFormattedDateString(),
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
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
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
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'reference_code';
    }
}
