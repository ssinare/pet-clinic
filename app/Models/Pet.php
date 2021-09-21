<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\Owner;

class Pet extends Model
{
    use HasFactory;

    public function petByDoctor()
    {

        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function petByOwner()
    {

        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }
}