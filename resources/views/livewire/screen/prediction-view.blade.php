<div class="flex items-center justify-center min-h-screen p-10">
    <div class="flex flex-col w-full overflow-hidden bg-white rounded-lg shadow-md lg:flex-row max-w-7xl">
        <div class="p-8 bg-blue-100 lg:w-[40%]">
            <h1 class="mb-4 text-3xl font-bold text-blue-900">Prédiction du Risque de Diabète : Pourquoi c'est important
            </h1>
            <p class="mb-4 text-blue-800">La prédiction du risque de diabète de type 2 vous permet de prendre des
                décisions éclairées sur votre santé. Grâce à une analyse avancée de vos données de santé, nous pouvons
                estimer votre probabilité de développer cette maladie. Ces informations sont essentielles pour agir tôt
                et prévenir les complications liées au diabète.</p>
            <p class="mb-4 text-blue-800">La santé est une priorité. En connaissant votre risque, vous avez la
                possibilité d'adopter des habitudes de vie plus saines et de consulter un professionnel de santé pour
                des conseils personnalisés. Ce service de prédiction vous guide vers une gestion proactive et
                personnalisée de votre bien-être.</p>
            <p class="font-semibold text-blue-900">Ne laissez pas l'incertitude dominer. Prenez en main votre avenir et
                découvrez dès maintenant votre risque de diabète de type 2.</p>
        </div>

        <div class="p-8 bg-white lg:w-[60%]">
            <form wire:submit.prevent='test' class="space-y-6">
                {{$this->form}}
            </form>
            @if(isset($result))
            <div class="p-4 mt-6 bg-gray-100 rounded-lg shadow">
                <h2 class="mb-4 text-xl font-bold">Résultats de Prédiction</h2>
                <p class="mb-2"><strong>Interprétation :</strong> {{ $result['interpretation'] }}</p>
                <p class="mb-2"><strong>Prédiction :</strong> {{ $result['prediction'] }}</p>
                <p class="mb-2"><strong>Probabilité :</strong></p>
                <ul class="mb-4 list-disc list-inside">
                    <li>Classe non Diabétiques : {{ $result['probability']['class_0'] }}%</li>
                    <li>Classe Diabétiques : {{ $result['probability']['class_1'] }}%</li>
                </ul>
                <p class="mb-2"><strong>Recommandations :</strong></p>
                <ul class="mb-4 list-disc list-inside">
                    @foreach($result['recommendations'] as $recommendation)
                    <li>{{ $recommendation }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
