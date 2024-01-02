<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'saler';
    // protected $primaryKey = 'Kode'; 
protected $fillable = ['Kode', 'Nama', /* other attributes */];
    use HasFactory;
}
