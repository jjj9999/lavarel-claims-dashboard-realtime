<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    protected $fillable = [
        'pfas_cases',
        'sales_today',
        'leads_acquired',
        'leads_sold',
    ];
}
