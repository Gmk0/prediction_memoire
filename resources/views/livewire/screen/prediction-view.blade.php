<div class="flex items-center justify-center min-h-screen p-10">
    <div class="flex flex-col w-full max-w-7xl overflow-hidden bg-white rounded-lg shadow-md lg:flex-row">
        <div class="p-8 bg-blue-100 lg:w-[35%]">
            <h1 class="mb-4 text-3xl font-bold text-blue-900">Pourquoi il est important de connaître votre risque de
                diabète</h1>
            <p class="mb-4 text-blue-800">Le diabète de type 2 est une maladie silencieuse qui peut avoir de graves
                conséquences sur
                votre santé si elle n'est pas détectée et gérée à temps. Connaître votre risque vous permet de prendre
                des mesures préventives pour protéger votre santé. Un dépistage précoce peut vous aider à éviter des
                complications graves, telles que des maladies cardiovasculaires, des problèmes rénaux et des troubles de
                la vue.</p>
            <p class="mb-4 text-blue-800">Nous vous encourageons fortement à vous faire tester pour le diabète de type
                2, surtout si
                vous présentez des facteurs de risque. Prendre conscience de votre état de santé actuel est la première
                étape pour vivre une vie plus saine et plus épanouissante. Consultez un professionnel de la santé dès
                aujourd'hui pour un dépistage complet.</p>
            <p class="font-semibold text-blue-900">Votre santé est précieuse. Ne laissez pas le diabète de type 2
                prendre le contrôle.
                Agissez maintenant!</p>
        </div>
        <div class="p-8 bg-white lg:w-[65%]">
            <form wire:submit.prevent='test' class="space-y-6">
                {{$this->form}}
            </form>
            @if(isset($result))
            <div class="p-4 mt-6 bg-gray-100 rounded-lg shadow">
                <h2 class="mb-4 text-xl font-bold">Résultats de Prédiction</h2>
                <p class="mb-2"><strong>Interprétation :</strong> {{ $result['interpretation'] }}</p>
                <p class="mb-2"><strong>Prédiction :</strong> {{ $result['prediction'] }}</p>
                <p class="mb-2"><strong>Probabilité :</strong></p>
                <ul class="mb-4 list-disc list-inside ">
                    <li>Classe non Diabetiques  : {{ $result['probability']['class_0'] }}%</li>
                    <li>Classe Diabetiques : {{ $result['probability']['class_1'] }}%</li>
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
