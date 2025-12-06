<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'client_id',
        'lead_id',
        'service_id',
        'custom_requirements',
        'total_price',
        'discount',
        'final_price',
        'payment_status',
        'order_status',
        'due_date',
        'notes_internal',
    ];

    protected $casts = [
        'due_date' => 'date',
        'total_price' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
