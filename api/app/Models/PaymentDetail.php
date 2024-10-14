<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'payment_method_id',  // Example: 'cash', 'credit_card', 'bank_transfer', etc.
        'bank_id',
        'check_number',
        'due_date',
        'sales_invoice_id',
        'amount',
        'cas_tendered',
        'change',
        'description',
        'status',
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
