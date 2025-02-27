<div>

    <div class="p-6 mx-auto max-w-x6l">
        <h1 class="mb-6 text-3xl font-bold text-center text-blue-600">Recommandations </h1>

        <div class="grid gap-6 md:grid-cols-3">

            @forelse ($recomandations as  $recommandation)
            <div class="flex items-center p-6 bg-white shadow-lg rounded-2xl">
                <div class="p-4 text-white bg-blue-500 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h11M9 21V3m8 18h2a2 2 0 002-2V7a2 2 0 00-2-2h-2m-2 12h2a2 2 0 002-2v-4a2 2 0 00-2-2h-2">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-semibold">{{$recommandation->title}}</h2>
                    <p class="text-gray-600">{{$recommandation->description}}</p>
                </div>
            </div>

            @empty

            @endforelse


        </div>

        <div class="hidden mt-8 text-center">
            <a href="#" class="px-6 py-3 text-lg font-semibold text-white bg-blue-600 rounded-full hover:bg-blue-700">Voir
                plus de conseils</a>
        </div>


    </div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
</div>
