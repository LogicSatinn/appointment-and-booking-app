<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\BookingFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property int $appointment_id
 * @property-read Client $client
 * @property-read Skill|null $skill
 * @property-read Collection|Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read Collection|Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @method static BookingFactory factory(...$parameters)
 * @method static Builder|Booking newModelQuery()
 * @method static Builder|Booking newQuery()
 * @method static \Illuminate\Database\Query\Builder|Booking onlyTrashed()
 * @method static Builder|Booking query()
 * @method static Builder|Booking whereAppointmentId($value)
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
 */
class Booking extends Model
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
        'skill_id' => 'integer',
        'booked_at' => 'timestamp',
    ];

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
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

}
