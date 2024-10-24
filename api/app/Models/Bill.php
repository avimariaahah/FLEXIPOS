<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'prepared_by_id',
        'cancelled_by_id',
        'purchase_order_no',
        'bill_date',
        'amount',
        'payment_terms',
        'is_cancelled',
    ];

    public function casts(): array
    {
        return [
            'is_cancelled' => 'boolean',
        ];
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function prepared_by(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'id');
    }

    public function cancelled_by(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'id');
    }

    public function bill_details(): HasMany
    {
        return $this->hasMany(BillDetail::class);
    }
}
