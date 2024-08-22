<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keys extends Model
{
    protected $table = 'keys';

    protected $fillable = [
        'key',
        'product_id',
        'user_id',
        'order_id',
        'is_activated',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function delete()
    {
        return parent::delete();
    }
}
