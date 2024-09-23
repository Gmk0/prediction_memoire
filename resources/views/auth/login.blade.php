<x-guest-layout>


    <div class="flex items-center justify-center min-h-screen p-10">
        <div class="flex flex-col w-full overflow-hidden bg-white rounded-lg shadow-md lg:flex-row max-w-7xl">
         <div class="p-8 bg-blue-100 lg:w-[40%]">
            <h1 class="mb-4 text-3xl font-bold text-blue-900">Bienvenue sur votre espace de prédiction de risque de diabète</h1>
            <p class="mb-4 text-blue-800">Connectez-vous pour accéder à vos prédictions personnalisées et découvrez des
                recommandations pour mieux gérer votre santé. En quelques clics, vous aurez accès à une analyse avancée de vos
                données qui vous aidera à comprendre et à réduire votre risque de diabète de type 2.</p>
            <p class="mb-4 text-blue-800">Si vous n'avez pas encore de compte, <a href="{{route('register')}}" wire:navigate class="text-lg underline cursor-pointer">inscrivez-vous</a> dès maintenant pour profiter de
                notre service de prédiction et prendre en main votre santé.</p>
            <p class="font-semibold text-blue-900">Votre santé, c'est notre priorité. Rejoignez-nous pour un avenir en meilleure
                santé.</p>
        </div>
            <div class="p-8 bg-gray-100 lg:w-[60%]">
                <x-authentication-card>
                    <x-slot name="logo">
                        <x-authentication-card-logo />
                    </x-slot>

                    <x-validation-errors class="mb-4" />

                    @session('status')
                    <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                        {{ $value }}
                    </div>
                    @endsession

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
                                autofocus autocomplete="username" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                                autocomplete="current-password" />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublier?') }}
                            </a>
                            @endif

                            <x-button class="ms-4">
                                {{ __('Connexion') }}
                            </x-button>
                        </div>
                    </form>
                </x-authentication-card>

            </div>
        </div>
    </div>
</x-guest-layout>
