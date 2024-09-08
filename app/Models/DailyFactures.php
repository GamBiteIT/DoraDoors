<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyFactures extends Model
{
    use HasFactory;
    protected $fillable = ['day',"price_in",'price_out','description','price_net'];
}
