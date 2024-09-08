<?php

namespace App\Models;

use App\Models\Facture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Day extends Model
{
    use HasFactory;
    protected $fillable = ['day'];
    
    public function factures(){
        return $this->hasMany(Facture::class);
    }
}
