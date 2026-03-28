<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number','name','email','phone','address','city',
        'state','pincode','subtotal','shipping','total',
        'status','payment_method','payment_status','notes',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber(): string
    {
        return 'SAAJ-' . strtoupper(substr(uniqid(), -6)) . '-' . date('dmY');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'bg-yellow-100 text-yellow-700',
            'processing' => 'bg-purple-100 text-purple-700',
            'shipped'    => 'bg-blue-100 text-blue-700',
            'delivered'  => 'bg-green-100 text-green-700',
            'cancelled'  => 'bg-red-100 text-red-700',
            default      => 'bg-gray-100 text-gray-700',
        };
    }
}
