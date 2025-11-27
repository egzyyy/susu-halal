<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Milk;
use App\Models\Request as MilkRequest;

class Allocation extends Model
{
    // Table name
    protected $table = 'allocation';

    // Primary key
    protected $primaryKey = 'allocation_ID';

    // Allowed fields for mass assignment
    protected $fillable = [
        'request_ID',
        'milk_ID',
        'total_selected_milk',
        'storage_location',
        'allocation_milk_date_time',
    ];

    // Cast allocation_milk_date_time JSON to array
    protected $casts = [
        'allocation_milk_date_time' => 'array',
    ];

    // Relationships
    public function milk()
    {
        return $this->belongsTo(Milk::class, 'milk_ID', 'milk_ID');
    }

    public function request()
    {
        return $this->belongsTo(MilkRequest::class, 'request_ID', 'request_ID');
    }
}
