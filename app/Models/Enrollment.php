<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;



    public function service()
{
    return $this->belongsTo(Service::class, 'service_id');
}

public function reneHistory()
{
    return $this->hasMany(ReneHistory::class, 'sub_id', 'id');
}



}
