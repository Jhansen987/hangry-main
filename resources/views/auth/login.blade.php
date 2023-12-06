<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{url('/home')}}"><img src="images/hangry-logo-orange-bg.png" style="border-radius:50%;height:100px;margin-top:40px;"></a>
        </x-slot>

        @if(session('success'))
            <script>
                const audio = new Audio("{{asset('sounds/alert-sound.mp3')}}");
                audio.play();
                alert("{{session('success')}}");
            </script>
        @endif

        <div class="mt-4" style="margin-bottom:30px;border-bottom:1px solid #8a878b;">
                <p style="font-size:20px;color:#555356;text-align:center;"><b>LOGIN</b></p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
                <br><br>
            </div>
        </form>
        <x-validation-errors class="mb-4" />

        <div class="block mt-4" style="text-align:center;border-top:1px solid #8a878b;padding-top:10px;">
            <p style="display:inline-block;padding-right:2px;color:#555356;">Don't have an account yet?</p>
            <a style="display:inline-block;color:#438cde;" href="{{url('register')}}">Sign up</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
