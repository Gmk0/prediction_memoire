<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // Récupérer le dernier MedicalData de l'utilisateur connecté
        $lastMedicalData = auth()->user()->medicalDatas()->latest()->first();

        $medicalDataCount = auth()->user()->medicalDatas()->count();

        return view('livewire.dashboard', [
            'last_medical_data' => $lastMedicalData,
            'medical_data_count' => $medicalDataCount,  // Passer le compte à la vue
        ]);
    }
}
