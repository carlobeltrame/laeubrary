<template>
    <auth-card>
        <template #logo>
            <a href="/">
                <application-logo large class="fill-current text-gray-500" />
            </a>
        </template>

        <!-- Validation Errors -->
        <auth-validation-errors class="mb-4" :errors="$window.Laravel.errors" />

        <form method="POST" :action="route('register')">
            <csrf-token />

            <!-- Name -->
            <div>
                <input-label for="name" value="Name" />

                <input-field id="name" classes="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <input-label for="email" value="E-Mail" />

                <input-field id="email" classes="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <input-label for="password" value="Passwort" />

                <input-field id="password" classes="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <input-label for="password_confirmation" value="Passwort bestätigen" />

                <input-field id="password_confirmation" classes="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" :href="route('login')">
                    Hast du bereits ein Konto?
                </a>

                <submit-button class="ml-4 bg-gray-800 border-transparent text-white hover:bg-gray-700 active:bg-gray-900">
                    Registrieren
                </submit-button>
            </div>
        </form>
    </auth-card>
</template>
<script>
import AuthCard from '../components/AuthCard'
import ApplicationLogo from '../components/ApplicationLogo'
import AuthValidationErrors from '../components/AuthValidationErrors'
import CsrfToken from '../components/CsrfToken'
import InputLabel from '../components/InputLabel'
import InputField from '../components/InputField'
import SubmitButton from '../components/SubmitButton'
export default {
    name: 'RegisterScreen',
    components: { SubmitButton, InputField, InputLabel, CsrfToken, AuthValidationErrors, ApplicationLogo, AuthCard }
}
</script>
