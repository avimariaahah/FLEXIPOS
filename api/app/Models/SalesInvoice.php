<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SalesInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'sales_order_id',
        'customer_id',
        'processed_by_id',
        'cancel_type',
        'cancel_id',
        'approve_type',
        'approve_id',
        'document_no',
        'date',
        'is_approved',
        'is_cancelled',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function sales_order(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function cancel(): MorphTo
    {
        return $this->morphTo();
    }

    public function approve(): MorphTo
    {
        return $this->morphTo();
    }

    public function sales_invoice_details(): HasMany
    {
        return $this->hasMany(SalesInvoiceDetail::class);
    }
}
