<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <x-authentication-card-logo /> -->
            <a href="{{url('/home')}}"><img src="images/hangry-logo-orange-bg.png" style="border-radius:50%;height:100px;margin-top:40px;"></a>
        </x-slot>

        <x-validation-errors class="mb-4" />
        <div class="mt-4" style="margin-bottom:30px;border-bottom:1px solid #8a878b;">
                <p style="font-size:20px;color:#555356;text-align:center;"><b>REGISTER</b></p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div style="display:inline-block;">
                <x-label for="firstname" value="First Name *"/>
                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('name')" required/>
            </div>

            <div style="display:inline-block;">
                <x-label for="lastname" value="Last Name *"/>
                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" required/>
            </div>

            <div class="mt-4">
                <x-label for="username" value="Username *" />
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" required/>
            </div>

            <div class="mt-4">
                <x-label for="gender" value="Gender *" style="margin-bottom:6px;"/>
                <x-input id="gender" type="radio" name="gender" value="Male" required/>
                <x-label for="gender" value="Male" style="display:inline-block;margin-left:3px;margin-right:50px;"/>
                <x-input id="gender" type="radio" name="gender" value="Female" required/>
                <x-label for="gender" value="Female" style="display:inline-block;margin-left:3px;margin-right:7px;"/>
            </div>

            <div class="mt-4">
                <x-label for="address" value="Full Home Address *" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="address" required/>
            </div>

            <div class="mt-4">
                <x-label for="contactnumber" value="Mobile Number *" />
                <x-input id="contactnumber" class="block mt-1 w-full" type="tel" placeholder="Ex: 09xxxxxxxxx" name="contactnumber" required/>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }} *" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }} *" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required/>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }} *" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <br>
    </x-authentication-card>
</x-guest-layout>
