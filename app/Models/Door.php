<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    use HasFactory;
    protected $fillable = ['ref','color','photo','price','description','category'];

    public function facturesdoors(){
        return $this->hasMany(FactureDoors::class);
      }
}
