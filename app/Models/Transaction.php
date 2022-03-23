<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['invoice', 'id_customer', 'payment_status', 'id_transaction_menu'];

    public function transactionMenu()
    {
        return $this->belongsTo(TransactionMenu::class);
    }
}
