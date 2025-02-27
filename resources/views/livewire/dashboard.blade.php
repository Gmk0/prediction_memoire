

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 sm:rounded-lg">

                <!-- Titre -->
                <h1 class="mb-6 text-2xl font-bold text-center text-gray-800 dark:text-white">
                    🎛️ Tableau de Bord Utilisateur
                </h1>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                    <!-- Dernière Prédiction -->
                   <div class="p-5 bg-blue-100 rounded-lg shadow dark:bg-blue-900">
                    <h2 class="text-lg font-semibold text-blue-800 dark:text-blue-300">📊 Dernière Prédiction</h2>

                    <!-- Affichage de la prédiction avec un risque -->
                    <p class="mt-2 text-gray-700 dark:text-gray-300">
                        Votre dernière prédiction indiquait un risque de
                        <span class="font-bold text-blue-600">
                            @if($last_medical_data->prediction == "0")
                            Faible
                            @elseif($last_medical_data->prediction == "1")
                            Modéré
                            @else
                            Inconnu
                            @endif
                        </span>.
                    </p>

                    <!-- Affichage de l'interprétation -->
                    <p class="mt-2 text-gray-700 dark:text-gray-300">
                        <strong>Interprétation :</strong> {{ $last_medical_data->prediction->interprétation ?? 'Aucune interprétation disponible' }}
                    </p>

                    <!-- Recommandations -->
                    <div class="mt-4">
                        <strong class="text-gray-700 dark:text-gray-300">Recommandations :</strong>
                        <ul class="ml-5 text-gray-700 list-disc dark:text-gray-300">
                            @foreach ($last_medical_data->prediction->recommandations as $recommandation)
                            <li>{{ $recommandation }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Lien pour voir les détails -->

                </div>

                    <!-- Historique des Évaluations -->
                    <div class="p-5 bg-green-100 rounded-lg shadow dark:bg-green-900">
                        <h2 class="text-lg font-semibold text-green-800 dark:text-green-300">📅 Historique</h2>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">Vous avez réalisé <span
                                class="font-bold text-green-600">{{$medical_data_count}} évaluations</span>.</p>

                    </div>

                    <!-- Recommandations Personnalisées -->
                    <div class="p-5 bg-yellow-100 rounded-lg shadow dark:bg-yellow-900">
                        <h2 class="text-lg font-semibold text-yellow-800 dark:text-yellow-300">💡 Recommandations</h2>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">Découvrez des conseils adaptés à votre profil.
                        </p>
                        <a href="{{route('recommandations')}}"
                            class="inline-block mt-3 font-semibold text-yellow-600 dark:text-yellow-300 hover:underline">
                            📌 Voir les recommandations
                        </a>
                    </div>

                    <!-- Profil Utilisateur -->


                    <!-- Lien vers les Centres -->
                    <div class="p-5 bg-purple-100 rounded-lg shadow dark:bg-purple-900">
                        <h2 class="text-lg font-semibold text-purple-800 dark:text-purple-300">🏥 Centres de Soins</h2>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">Trouvez des centres spécialisés proches de chez
                            vous.</p>
                        <a href="{{route('centre')}}"
                            class="inline-block mt-3 font-semibold text-purple-600 dark:text-purple-300 hover:underline">
                            📍 Trouver un centre
                        </a>
                    </div>

                    <!-- Assistance et Contact -->
                    <div class="p-5 bg-red-100 rounded-lg shadow dark:bg-red-900">
                        <h2 class="text-lg font-semibold text-red-800 dark:text-red-300">📞 Assistance</h2>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">Besoin d’aide ? Contactez-nous.</p>
                        <a href=""
                            class="inline-block mt-3 font-semibold text-red-600 dark:text-red-300 hover:underline">
                            ✉️ Contacter le support
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

