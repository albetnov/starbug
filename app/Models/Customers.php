<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'id_subcription', 'status'];

    public function subcription()
    {
        return $this->belongsTo(Subcriptions::class, 'id_subcription');
    }
}
