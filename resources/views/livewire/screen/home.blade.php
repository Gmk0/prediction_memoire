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
           <div class="flex flex-wrap items-center justify-center gap-6 p-6 bg-gray-100 shadow-lg rounded-xl">
            <a href="{{route('evaluerRisque')}}"
                class="flex items-center gap-3 px-8 py-4 text-lg font-semibold text-blue-600 transition-all bg-white border border-blue-500 rounded-lg shadow-md hover:bg-blue-600 hover:text-white hover:shadow-lg">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 2a8 8 0 11-6.32 12.906l-3.387 1.13a1 1 0 01-1.267-1.267l1.13-3.387A8 8 0 0110 2zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                        clip-rule="evenodd"></path>
                </svg>
                Évaluer votre risque
            </a>

            <a href="{{route('evaluerRisqueGuest')}}"
                class="flex items-center gap-3 px-8 py-4 text-lg font-semibold text-blue-600 transition-all bg-white border border-blue-500 rounded-lg shadow-md hover:bg-blue-600 hover:text-white hover:shadow-lg">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8 9a3 3 0 116 0 3 3 0 01-6 0zm-2 5a5 5 0 0110 0v1a1 1 0 01-2 0v-1a3 3 0 00-6 0v1a1 1 0 01-2 0v-1z"
                        clip-rule="evenodd"></path>
                </svg>
                Évaluer sans se connecter
            </a>

            <a href="{{route('recommandations')}}"
                class="flex items-center gap-3 px-8 py-4 text-lg font-semibold text-blue-600 transition-all bg-white border border-blue-500 rounded-lg shadow-md hover:bg-blue-600 hover:text-white hover:shadow-lg">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm14 0H4v10h12V5zM6 7h8v2H6V7z"
                        clip-rule="evenodd"></path>
                </svg>
                Les Recommandations
            </a>

            <a href="{{route('recommandations')}}"
                class="flex items-center gap-3 px-8 py-4 text-lg font-semibold text-blue-600 transition-all bg-white border border-blue-500 rounded-lg shadow-md hover:bg-blue-600 hover:text-white hover:shadow-lg">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H4zm0 2h12v12H4V4zM9 7h2a1 1 0 010 2H9a1 1 0 010-2zm0 4h2a1 1 0 010 2H9a1 1 0 010-2z"
                        clip-rule="evenodd"></path>
                </svg>
                Les Centres
            </a>
        </div>
        </div>
    </div>
</div>
