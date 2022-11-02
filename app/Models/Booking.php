<?php

namespace App\Models;

use App\Enums\BookingMethod;
use App\States\Booking\BookingState;
use Carbon\Carbon;
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
use Illuminate\Support\Carbon as IlluminateCarbon;
use Illuminate\Support\Str;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Booking
 *
 * @property int $id
 * @property string $reference_code
 * @property string $paid_amount
 * @property string $total_amount
 * @property string $due_amount
 * @property BookingMethod|null $booking_method
 * @property mixed $status
 * @property int $client_id
 * @property int $timetable_id
 * @property int $reservation_id
 * @property int|null $last_modified_by
 * @property string $booked_at
 * @property IlluminateCarbon|null $deleted_at
 * @property IlluminateCarbon|null $created_at
 * @property IlluminateCarbon|null $updated_at
 * @property-read Client $client
 * @property-read User|null $lastModifiedBy
 * @property-read Collection|Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read Reservation $reservation
 * @property-read Timetable $timetable
 *
 * @method static \Database\Factories\BookingFactory factory(...$parameters)
 * @method static Builder|Booking newModelQuery()
 * @method static Builder|Booking newQuery()
 * @method static DatabaseQueryBuilder|Booking onlyTrashed()
 * @method static Builder|Booking orWhereNotState(string $column, $states)
 * @method static Builder|Booking orWhereState(string $column, $states)
 * @method static Builder|Booking query()
 * @method static Builder|Booking whereBookedAt($value)
 * @method static Builder|Booking whereBookingMethod($value)
 * @method static Builder|Booking whereClientId($value)
 * @method static Builder|Booking whereCreatedAt($value)
 * @method static Builder|Booking whereDeletedAt($value)
 * @method static Builder|Booking whereDueAmount($value)
 * @method static Builder|Booking whereId($value)
 * @method static Builder|Booking whereLastModifiedBy($value)
 * @method static Builder|Booking whereNotState(string $column, $states)
 * @method static Builder|Booking wherePaidAmount($value)
 * @method static Builder|Booking whereReferenceCode($value)
 * @method static Builder|Booking whereReservationId($value)
 * @method static Builder|Booking whereState(string $column, $states)
 * @method static Builder|Booking whereStatus($value)
 * @method static Builder|Booking whereTimetableId($value)
 * @method static Builder|Booking whereTotalAmount($value)
 * @method static Builder|Booking whereUpdatedAt($value)
 * @method static DatabaseQueryBuilder|Booking withTrashed()
 * @method static DatabaseQueryBuilder|Booking withoutTrashed()
 * @mixin Eloquent
 */
class Booking extends Model
{
    use HasFactory, SoftDeletes, HasStates;

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
        'client_id' => 'integer',
        'timetable_id' => 'integer',
        'status' => BookingState::class,
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
        'booking_method' => BookingMethod::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->booked_at = now();
            $model->reference_code = 'NL-B' . Str::padLeft(value: strval(self::max('id') + 1), length: 6, pad:  0);
        });
    }

    /**
     * @return Attribute
     */
    public function bookedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d F Y - H:i'),
        );
    }

    /**
     * @param $value
     * @return string
     */
    public function representablePrice($value): string
    {
        return 'TZS'.' '.number_format($value);
    }

    /**
     * @return BelongsTo
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
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
