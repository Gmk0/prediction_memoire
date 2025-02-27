<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recommandation;

class RecommandationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recommandation::insert([
            [
                'title' => 'Adoptez une alimentation équilibrée',
                'description' => 'Réduisez votre consommation de sucre et privilégiez les aliments riches en fibres.',
                'content' => 'Mangez plus de légumes, de céréales complètes et évitez les boissons sucrées.',
                'image_url' => 'images/alimentation.jpg',
                'variable_ass' => 'alimentation',
            ],
            [
                'title' => 'Pratiquez une activité physique régulière',
                'description' => 'L’exercice aide à réguler la glycémie et à maintenir un poids sain.',
                'content' => 'Essayez de faire au moins 30 minutes d’exercice par jour, comme la marche rapide.',
                'image_url' => 'images/exercice.jpg',
                'variable_ass' => 'activité_physique',
            ],
            [
                'title' => 'Surveillez votre glycémie',
                'description' => 'Un suivi régulier permet d’anticiper d’éventuels problèmes.',
                'content' => 'Consultez votre médecin pour déterminer la fréquence des tests de glycémie.',
                'image_url' => 'images/glycemie.jpg',
                'variable_ass' => 'glycémie',
            ],[
                'title' => 'Évitez le stress excessif',
                'description' => 'Le stress peut influencer négativement la glycémie.',
                'content' => 'Pratiquez des activités relaxantes comme la méditation, le yoga ou la respiration profonde.',
                'image_url' => 'images/stress.jpg',
                'variable_ass' => 'stress',
            ],
            [
                'title' => 'Hydratez-vous suffisamment',
                'description' => 'L’eau aide à éliminer l’excès de glucose dans le sang.',
                'content' => 'Buvez au moins 1,5 à 2 litres d’eau par jour et évitez les boissons sucrées.',
                'image_url' => 'images/eau.jpg',
                'variable_ass' => 'hydratation',
            ],
            [
                'title' => 'Privilégiez un bon sommeil',
                'description' => 'Un sommeil de qualité régule les hormones et la glycémie.',
                'content' => 'Essayez de dormir entre 7 et 9 heures par nuit, et évitez les écrans avant le coucher.',
                'image_url' => 'images/sommeil.jpg',
                'variable_ass' => 'sommeil',
            ],
            [
                'title' => 'Arrêtez le tabac et limitez l’alcool',
                'description' => 'Le tabac et l’alcool augmentent le risque de complications du diabète.',
                'content' => 'Réduisez ou arrêtez ces substances pour améliorer votre santé générale.',
                'image_url' => 'images/tabac_alcool.jpg',
                'variable_ass' => 'tabac_alcool',
            ],
            [
                'title' => 'Consultez régulièrement un professionnel de santé',
                'description' => 'Un suivi médical permet d’adapter votre traitement si nécessaire.',
                'content' => 'Planifiez des consultations régulières et effectuez les examens recommandés.',
                'image_url' => 'images/medecin.jpg',
                'variable_ass' => 'suivi_medical',
            ],

        ]);
    }
}
