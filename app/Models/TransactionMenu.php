<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMenu extends Model
{
    use HasFactory;
    protected $fillable = ['id_transaction', 'id_menu'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
