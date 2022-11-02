<?php

namespace App\Models;

use App\States\Payment\PaymentState;
use Database\Factories\PaymentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Support\Carbon;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Payment
 *
 * @property int $id
 * @property string $reference_code
 * @property string|null $payment_method
 * @property string $amount
 * @property mixed $status
 * @property int $booking_id
 * @property int|null $created_by
 * @property int|null $last_modified_by
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Booking $booking
 * @property-read User|null $createdBy
 * @property-read User|null $lastModifiedBy
 * @method static PaymentFactory factory(...$parameters)
 * @method static Builder|Payment newModelQuery()
 * @method static Builder|Payment newQuery()
 * @method static DatabaseQueryBuilder|Payment onlyTrashed()
 * @method static Builder|Payment orWhereNotState(string $column, $states)
 * @method static Builder|Payment orWhereState(string $column, $states)
 * @method static Builder|Payment query()
 * @method static Builder|Payment whereAmount($value)
 * @method static Builder|Payment whereBookingId($value)
 * @method static Builder|Payment whereCreatedAt($value)
 * @method static Builder|Payment whereCreatedBy($value)
 * @method static Builder|Payment whereDeletedAt($value)
 * @method static Builder|Payment whereId($value)
 * @method static Builder|Payment whereLastModifiedBy($value)
 * @method static Builder|Payment whereNotState(string $column, $states)
 * @method static Builder|Payment wherePaymentMethod($value)
 * @method static Builder|Payment whereReferenceCode($value)
 * @method static Builder|Payment whereState(string $column, $states)
 * @method static Builder|Payment whereStatus($value)
 * @method static Builder|Payment whereUpdatedAt($value)
 * @method static DatabaseQueryBuilder|Payment withTrashed()
 * @method static DatabaseQueryBuilder|Payment withoutTrashed()
 * @mixin Eloquent
 */
class Payment extends Model
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
        'paid_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
        'booking_id' => 'integer',
        'status' => PaymentState::class,
    ];

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function lastModifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_modified_by');
    }

    /**
     * @return BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
