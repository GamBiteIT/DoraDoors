<?php

namespace App\Models;

use App\Models\Day;
use App\Models\Door;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = ['day_id','doors_id','qte','total_price'];

    public function day(){
        return $this->belongsTo(Day::class);
    }
    public function doors(){
        return $this->belongsTo(Door::class);
    }
}
