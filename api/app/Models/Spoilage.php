<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spoilage extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_no',
        'damaged_date',
        'remarks',
        'prepared_by_id',
        'approved_by_id',
        'is_cancelled',
        'cancelled_by',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function reported_by(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'id');
    }

    public function spoilage_details(): HasMany
    {
        return $this->hasMany(SpoilageDetail::class);
    }
}
