<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesInvoice extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'branchno',
        'referencedocnum',
        'sales_orderid',
        'date',
        'customerno',
        'userno',
        'iscancelled',
        'cancelledby',
        'preparedby',
        'approvedby',
        'isapprovedby',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'branchno',
            'referencedocnum',
            'sales_orderid',
            'date',
            'customerno',
            'userno',
            'iscancelled',
            'cancelledby',
            'preparedby',
            'approvedby',
            'isapprovedby',
            'created_at',
            'updated_at',
        ];
    }
}
