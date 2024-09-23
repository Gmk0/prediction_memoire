<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredictionResult extends Model
{
    use HasFactory;

    protected $fillable=[
        'prediction',
        'interprétation',
        'classe',
        'recommandations',
        'model_type',
        'medical_data_id',

        ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'recommandations' => 'array',
            'classe' => 'array',
        ];
    }
}
