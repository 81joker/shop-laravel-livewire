<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;

class OrderItem extends Model
{
  use HasFactory;

  protected $fillable = ['order_id', 'name', 'description', 'price', 'quantity', 'amount_discount', 'amount_tax', 'amount_total'];

  public function order()
  {
    return $this->belongsTo(Order::class);
  }
}
