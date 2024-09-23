<x-guest-layout>




<div class="flex items-center justify-center min-h-screen p-10">
    <div class="flex flex-col w-full overflow-hidden bg-white rounded-lg shadow-md lg:flex-row max-w-7xl">
       <div class="p-8 bg-blue-100 lg:w-[40%]">
        <h1 class="mb-4 text-3xl font-bold text-blue-900">Rejoignez-nous et prenez le contrôle de votre santé</h1>
        <p class="mb-4 text-blue-800">Inscrivez-vous dès aujourd'hui pour accéder à notre service de prédiction de risque de
            diabète de type 2. En quelques étapes simples, vous pourrez créer votre compte et bénéficier d'une analyse
            personnalisée de vos données de santé.</p>
        <p class="mb-4 text-blue-800">Notre plateforme est conçue pour vous fournir des informations précieuses et des
            recommandations adaptées à votre profil. En vous inscrivant, vous faites le premier pas vers une meilleure
            compréhension de votre santé et la prévention des complications liées au diabète.</p>
        <p class="font-semibold text-blue-900">Ne laissez pas passer cette opportunité de vivre en meilleure santé.
            Rejoignez
            notre communauté et commencez votre parcours vers une vie plus saine dès maintenant.</p>
    </div>
        <div class="p-8 bg-gray-100 lg:w-[60%]">
          <x-authentication-card>
                <x-slot name="logo">
                    <x-authentication-card-logo />
                </x-slot>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-label for="name" value="{{ __('Nom') }}" />
                        <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus
                            autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
                            autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Mot de passe') }}" />
                        <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                            autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirmer') }}" />
                        <x-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation"
                            required autocomplete="new-password" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                        class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms
                                        of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                        class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy
                                        Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('login') }}">
                            {{ __('deja enregistrer?') }}
                        </a>

                        <x-button class="ms-4">
                            {{ __("S'inscrire") }}
                        </x-button>
                    </div>
                </form>
            </x-authentication-card>

        </div>
    </div>
</div>

</x-guest-layout>
