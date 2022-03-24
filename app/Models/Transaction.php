<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['invoice', 'id_customer', 'payment_status', 'id_transaction_menu', 'price'];

    public function transactionMenu()
    {
        return $this->belongsTo(TransactionMenu::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'id_customer');
    }
}
