<template>
    <auth-card>
        <template #logo>
            <a href="/">
                <application-logo large class="fill-current text-gray-500" />
            </a>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Bitte bestätige dein Passwort bevor du fortfährst.
        </div>

        <!-- Validation Errors -->
        <auth-validation-errors class="mb-4" :errors="$window.Laravel.errors" />

        <form method="POST" :action="route('password.confirm')">
            <csrf-token />

            <!-- Password -->
            <div>
                <input-label for="password" value="Passwort" />

                <input-field id="password" classes="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex justify-end mt-4">
                <submit-button class="bg-gray-800 border-transparent text-white hover:bg-gray-700 active:bg-gray-900">
                    Bestätigen
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
    name: 'ConfirmPassword',
    components: { SubmitButton, InputField, InputLabel, CsrfToken, AuthValidationErrors, ApplicationLogo, AuthCard }
}
</script>
