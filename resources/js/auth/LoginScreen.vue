<template>
<auth-card>
    <template #logo>
        <a href="/">
            <application-logo large class="fill-current text-gray-500" />
        </a>
    </template>

    <!-- Session Status -->
    <auth-session-status class="mb-4" :status="$window.Laravel.status" />

    <!-- Validation Errors -->
    <auth-validation-errors class="mb-4" :errors="$window.Laravel.errors" />

    <form method="POST" :action="route('login')">
        <csrf-token />

        <!-- Email Address -->
        <div>
            <input-label for="email" value="E-Mail" />

            <input-field id="email" classes="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <input-label for="password" value="Passwort" />

            <input-field id="password" classes="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                <span class="ml-2 text-sm text-gray-600">Eingeloggt bleiben</span>
            </label>
        </div>

        <!-- Hash from original URL -->
        <input type="hidden" name="url_hash" :value="hashFromUrl">

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" :href="route('password.request')">
                Passwort vergessen?
            </a>

            <submit-button class="ml-3 bg-gray-800 border-transparent text-white hover:bg-gray-700 active:bg-gray-900">
                Einloggen
            </submit-button>
        </div>
    </form>
</auth-card>
</template>
<script>
import ApplicationLogo from '../components/ApplicationLogo'
import CsrfToken from '../components/CsrfToken'
import AuthCard from '../components/AuthCard'
import InputLabel from '../components/InputLabel'
import InputField from '../components/InputField'
import SubmitButton from '../components/SubmitButton'
import AuthValidationErrors from '../components/AuthValidationErrors'
import AuthSessionStatus from '../components/AuthSessionStatus'
export default {
    name: 'LoginScreen',
    components: { AuthSessionStatus, AuthValidationErrors, SubmitButton, InputField, InputLabel, AuthCard, CsrfToken, ApplicationLogo },
    computed: {
        hashFromUrl () {
            return window.location.hash.substring(1)
        }
    }
}
</script>
