<div class="flex items-center justify-center min-h-screen p-6">
    <div class="flex flex-col w-full overflow-hidden bg-white rounded-lg shadow-md lg:flex-row max-w-7xl">
        <div class="p-8 bg-blue-100 lg:w-[50%]">
            <h1 class="mb-4 text-3xl font-bold text-blue-900">Pourquoi il est important de connaître votre risque de
                diabète</h1>
            <p class="mb-4 text-blue-800">Le diabète de type 2 est une maladie insidieuse qui peut causer de graves
                complications si elle n'est pas dépistée et gérée rapidement. Connaître votre risque vous permet d'agir
                à temps pour protéger votre santé. Un dépistage précoce est essentiel pour éviter des conséquences
                graves, telles que des maladies cardiovasculaires, des problèmes rénaux, ou des troubles visuels.</p>
            <p class="mb-4 text-blue-800">Il est crucial de vous faire tester pour le diabète de type 2, en particulier
                si vous présentez des facteurs de risque. Comprendre votre état de santé est la première étape pour
                adopter un mode de vie plus sain et équilibré. Consultez dès aujourd'hui un professionnel de la santé
                pour un dépistage complet.</p>
            <p class="font-semibold text-blue-900">Votre santé est précieuse. Ne laissez pas le diabète de type 2
                prendre le dessus. Agissez maintenant!</p>
        </div>
        <div class="p-8 bg-gray-100 lg:w-[50%] mx-auto rounded-lg shadow-lg">
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{route('evaluerRisque')}}" wire:navigate
                    class="px-6 py-4 text-lg font-semibold border border-gray-300 rounded-lg hover:text-white hover:transition hover:bg-blue-600">
                    Évaluer votre risque
                </a>
                <a href="{{route('evaluerRisqueGuest')}}" wire:navigate
                    class="px-6 py-4 text-lg font-semibold border border-gray-300 rounded-lg hover:text-white hover:transition hover:bg-blue-600">
                    Évaluer votre risque sans se connecter
                </a>

                <a href="{{route('recommandations')}}" wire:navigate
                    class="px-6 py-4 text-lg font-semibold border border-gray-300 rounded-lg hover:text-white hover:transition hover:bg-blue-600">
                    Les Recommandations
                </a>

                <a href="{{route('bonnesPratiques')}}" wire:navigate
                    class="px-6 py-4 text-lg font-semibold border border-gray-300 rounded-lg hover:text-white hover:transition hover:bg-blue-600">
                    Bonnes pratiques pour diminuer
                </a>
            </div>
        </div>
    </div>
</div>
