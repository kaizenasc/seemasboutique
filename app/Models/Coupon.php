<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'usage_limit',
        'used_count',
        'minimum_order',
        'valid_from',
        'valid_until',
        'is_active'
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_active' => 'boolean'
    ];

    public function isValid()
    {
        if (!$this->is_active) return false;
        if ($this->used_count >= $this->usage_limit) return false;
        
        $now = now();
        if ($this->valid_from && $now->lt($this->valid_from)) return false;
        if ($this->valid_until && $now->gt($this->valid_until)) return false;
        
        return true;
    }

    public function calculateDiscount($subtotal)
    {
        if ($this->minimum_order && $subtotal < $this->minimum_order) {
            return 0;
        }

        if ($this->type === 'percentage') {
            return ($subtotal * $this->value) / 100;
        }

        return $this->value;
    }
}