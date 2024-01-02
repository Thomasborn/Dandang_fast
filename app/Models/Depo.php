<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depo extends Model
{
    protected $table = 'depo';
    // protected $primaryKey = 'Kode'; 
protected $fillable = ['Kode','alamat', /* other attributes */];
  
    use HasFactory;
}
