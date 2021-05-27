<template>
    <auth-card>
        <template #logo>
            <a href="/">
                <application-logo large class="fill-current text-gray-500" />
            </a>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Passwort vergessen? Kein Problem. Gib deine Mailadresse an und schon bekommst du einen Link zugesendet mit dem du ein neues Passwort setzen kannst.
        </div>

        <!-- Session Status -->
        <auth-session-status class="mb-4" :status="$window.Laravel.status" />

        <!-- Validation Errors -->
        <auth-validation-errors class="mb-4" :errors="$window.Laravel.errors" />

        <form :method="routeMethod('password.email')" :action="route('password.email')">
            <csrf-token />

            <!-- Email Address -->
            <div>
                <input-label for="email" value="E-Mail" />

                <input-field id="email" classes="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <submit-button class="bg-gray-800 border-transparent text-white hover:bg-gray-700 active:bg-gray-900">Link senden</submit-button>
            </div>
        </form>
    </auth-card>
</template>
<script>
import AuthCard from '../components/AuthCard'
import ApplicationLogo from '../components/ApplicationLogo'
import AuthSessionStatus from '../components/AuthSessionStatus'
import AuthValidationErrors from '../components/AuthValidationErrors'
import CsrfToken from '../components/CsrfToken'
import InputLabel from '../components/InputLabel'
import InputField from '../components/InputField'
import SubmitButton from '../components/SubmitButton'
export default {
    name: 'ForgotPassword',
    components: { SubmitButton, InputField, InputLabel, CsrfToken, AuthValidationErrors, AuthSessionStatus, ApplicationLogo, AuthCard }
}
</script>
