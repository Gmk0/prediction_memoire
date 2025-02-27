<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalData extends Model
{
    use HasFactory;

    protected $fillable=[
            'medical_data',
            'user_id'
        ];



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'medical_data' => 'array',

        ];
    }

    public function User(){
        return $this->belongsTo(User::class);
    }


    public function prediction()
    {

        return $this->hasOne(PredictionResult::class);
    }






}
