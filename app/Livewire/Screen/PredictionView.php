<?php

namespace App\Livewire\Screen;

use App\Models\MedicalData;
use App\Models\PredictionResult;
use Livewire\Component;
use Filament\Forms\Components\{TextInput, Select,Grid,Radio, Wizard};
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\View;
use robertogallea\LaravelPython\Services\LaravelPython;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;



class PredictionView extends Component
implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public  $result;
    public string $message = '';
    public string $chatGPTResponse;

    protected $openAIService;

    public function mount(): void
    {
        $this->form->fill();
    }






    public function form2(Form $form): Form
    {
        return $form->schema([
            Wizard::make()
                ->steps([
                    Wizard\Step::make('Informations de base')
                    ->schema([
                        Select::make('sexe')
                        ->label('Sexe')
                        ->options([
                            0 => 'Femme',
                            1 => 'Homme',
                        ])
                            ->required()
                            ->helperText('Sélectionnez votre sexe.'),

                        TextInput::make('age')
                        ->label('Âge')
                        ->required()
                            ->numeric()
                            ->helperText('Indiquez votre âge en années.'),
                    ]),

                    Wizard\Step::make('Symptômes')
                    ->schema([
                        Select::make('polyurie')
                        ->label('Polyurie')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous remarqué une augmentation de la quantité d\'urine que vous produisez habituellement ?'),

                        Select::make('polydipsie')
                        ->label('Polydipsie')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Ressentez-vous une soif excessive ces derniers temps ?'),

                        Select::make('perte_de_poids_soudaine')
                        ->label('Perte de poids soudaine')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous perdu du poids de manière inattendue et rapide récemment ?'),

                        Select::make('faiblesse')
                        ->label('Faiblesse')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Vous sentez-vous plus faible ou fatigué que d\'habitude sans raison apparente ?'),

                        Select::make('polyphagie')
                        ->label('Polyphagie')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous un appétit anormalement élevé récemment ?'),

                        Select::make('vision_floue')
                        ->label('Vision floue')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous des problèmes de vision floue ?'),

                        Select::make('parasie_partielle')
                        ->label('Parésie partielle')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous une faiblesse ou une incapacité à bouger une partie de votre corps ?'),

                        Select::make('raideur_musculaire')
                        ->label('Raideur musculaire')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Ressentez-vous de la raideur dans vos muscles, rendant vos mouvements difficiles ou douloureux ?'),

                        Select::make('obesite')
                        ->label('Obésité')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Considérez-vous que vous avez un excès de poids ?'),
                    ]),

                    Wizard\Step::make('Antécédents et habitudes')
                    ->schema([
                        Select::make('diabete_parental')
                        ->label('Diabète familial')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Y a-t-il des antécédents de diabète dans votre famille ?'),

                        Select::make('tabagisme')
                        ->label('Tabagisme')
                        ->options([
                            0 => 'Jamais fumeur',
                            1 => 'Fumeur actuel',
                            2 => 'Ancien fumeur',
                        ])
                            ->required()
                            ->helperText('Quel est votre statut actuel concernant le tabagisme ?'),

                        Select::make('hypertension')
                        ->label('Hypertension')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous été diagnostiqué avec de l\'hypertension ?'),

                        Select::make('glycemie_eleve')
                        ->label('Glycémie élevée')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous des niveaux de glycémie élevés mesurés par des tests médicaux ?'),
                    ]),
                ])
        ])->statePath('data');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make()
                ->steps([
                    Wizard\Step::make('Informations de base')
                    ->schema([
                        TextInput::make('age')
                        ->label('Âge')
                        ->required()
                            ->numeric()
                            ->helperText('Indiquez votre âge en années.'),

                        Select::make('sexe')
                        ->label('Sexe')
                        ->options([
                            0 => 'Femme',
                            1 => 'Homme',
                        ])
                            ->required()
                            ->helperText('Sélectionnez votre sexe.'),
                    ]),

                    Wizard\Step::make('Symptômes')
                    ->schema([
                        Select::make('polyurie')
                        ->label('Polyurie')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous remarqué une augmentation de la quantité d\'urine que vous produisez habituellement ?'),

                        Select::make('polydipsie')
                        ->label('Polydipsie')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Ressentez-vous une soif excessive ces derniers temps ?'),

                        Select::make('perte_de_poids_soudaine')
                        ->label('Perte de poids soudaine')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous perdu du poids de manière inattendue et rapide récemment ?'),

                        Select::make('faiblesse')
                        ->label('Faiblesse')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Vous sentez-vous plus faible ou fatigué que d\'habitude sans raison apparente ?'),

                        Select::make('polyphagie')
                        ->label('Polyphagie')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous un appétit anormalement élevé récemment ?'),

                        Select::make('vision_floue')
                        ->label('Vision floue')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous des problèmes de vision floue ?'),
                    ]),

                    Wizard\Step::make('Autres symptômes')
                    ->schema([


                        Select::make('obesite')
                        ->label('Obésité')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Considérez-vous que vous avez un excès de poids ?'),
                    ]),

                    Wizard\Step::make('Antécédents et habitudes')
                    ->schema([
                        Select::make('diabete_parental')
                        ->label('Diabète familial')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Y a-t-il des antécédents de diabète dans votre famille ?'),

                        Select::make('tabagisme')
                        ->label('Tabagisme')
                        ->options([
                            0 => 'Jamais fumeur',
                            1 => 'Fumeur actuel',
                            2 => 'Ancien fumeur',
                        ])
                            ->required()
                            ->helperText('Quel est votre statut actuel concernant le tabagisme ?'),

                        Select::make('hypertension')
                        ->label('Hypertension')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous été diagnostiqué avec de l\'hypertension ?'),

                        Select::make('glycemie_eleve')
                        ->label('Glycémie élevée')
                        ->options([
                            0 => 'Non',
                            1 => 'Oui',
                        ])
                            ->required()
                            ->helperText('Avez-vous des niveaux de glycémie élevés mesurés par des tests médicaux ?'),

                        Select::make('activites_physique')
                        ->label('Activités physique')
                        ->options([
                            0 => 'Sédentaire',
                            1 => 'Modérément actif',
                            2 => 'Très actif',
                        ])
                            ->required()
                            ->helperText('Quel est votre niveau d\'activité physique ?'),
                    ]),
                ])->submitAction(new HtmlString(
                    Blade::render(<<<BLADE
    <x-filament::button
        type="submit"
        size="md"
    >
        Tester
    </x-filament::button>
BLADE)
                ))
        ])->statePath('data');
    }




    public function predict()
    {
        try{

            $service = new LaravelPython();

        // Obtenir les données de la requête
        $data = [72,0,0,1,0,1,1,1,1,1,0,1,1,1];

        // Convertir les données en format JSON
        $json_data = json_encode($data);


        $result = $service->run('Public/models/prediction_file.py', $data);

        dd($result);
        // Retourner la prédiction
        return response()->json(json_decode($result, true));
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }



    public function test2()
    {

        $client = new Client();

        try {

            $data = [72, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0];

            // Préparer les données dans le format requis
            $features = ['features' => $data];

            $response = $client->post('https://diabete-api-dd5701036696.herokuapp.com/predict', [
                'json' => $features
            ]);


            $this->result = json_decode($response->getBody(), true);


        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }
    public function test()
    {
        $this->form->validate();
        $data = $this->form->getState();
        $features = array_values( $data);
        $client = new Client();
        try {

            $features = array_values($data);
            $response = $client->post('https://diabete-api-dd5701036696.herokuapp.com/predict', [
                'json' => ['features' => $features]
            ]);

            $this->result =
            json_decode($response->getBody(), true);

            if(auth()->user()!=null){

                $this->SaveDatabase($data,$this->result);
            }


            $this->form->fill();

        } catch (\Exception $e) {



            dd($e->getMessage());

            error_log($e->getMessage());
        }

    }
    public function SaveDatabase($data,  $result){


        $medical = new MedicalData();

        $medical->medical_data = $data;
        $medical->user_id = auth()->id();

        $medical->save();

        $result = new PredictionResult();
        $result->prediction = $this->result['prediction'];
        $result->recommandations = $this->result['recommendations'];
        $result->interprétation = $this->result['interpretation'];
        $result->classe = $this->result['probability'];
        $result->model_type = 'Random forest';
        $result->medical_data_id = $medical->id;

        $result->save();


    }
    public function render()
    {
        return view('livewire.screen.prediction-view');
    }
}
