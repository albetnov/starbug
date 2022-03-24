<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMenu extends Model
{
    use HasFactory;
    protected $fillable = ['id_transaction', 'id_menu', 'qty'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaction', 'id');
    }
}
