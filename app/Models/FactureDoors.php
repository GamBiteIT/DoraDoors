<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureDoors extends Model
{
    use HasFactory;
    protected $fillable = ["door_id","id_facture",'day',"price_in",'qty','price_out','description','price_net'];

    public function doors(){
        return $this->belongsTo(Door::class);
    }
    public function door(){
        return $this->belongsTo(Door::class);
    }
 

}
