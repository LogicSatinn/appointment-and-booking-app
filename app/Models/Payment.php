<?php

namespace App\Models;

use App\States\Payment\PaymentState;
use Carbon\Carbon;
use Database\Factories\PaymentFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Payment
 *
 * @property int $id
 * @property string $payment_method
 * @property float $paid_amount
 * @property float $total_amount
 * @property float $due_amount
 * @property string $status
 * @property int $booking_id
 * @property string $reference_code
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Booking $booking
 * @method static PaymentFactory factory(...$parameters)
 * @method static Builder|Payment newModelQuery()
 * @method static Builder|Payment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Payment onlyTrashed()
 * @method static Builder|Payment query()
 * @method static Builder|Payment whereBookingId($value)
 * @method static Builder|Payment whereCreatedAt($value)
 * @method static Builder|Payment whereDeletedAt($value)
 * @method static Builder|Payment whereDueAmount($value)
 * @method static Builder|Payment whereId($value)
 * @method static Builder|Payment wherePaidAmount($value)
 * @method static Builder|Payment wherePaymentMethod($value)
 * @method static Builder|Payment whereReferenceCode($value)
 * @method static Builder|Payment whereStatus($value)
 * @method static Builder|Payment whereTotalAmount($value)
 * @method static Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Payment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Payment withoutTrashed()
 * @mixin \Eloquent
 * @property string $amount
 * @method static Builder|Payment whereAmount($value)
 */
class Payment extends Model
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
        'paid_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
        'booking_id' => 'integer',
        'status' => PaymentState::class
    ];

    /**
     * @return BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

}
