<template>
    <auth-card>
        <template #logo>
            <a href="/">
                <application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </template>

        <!-- Validation Errors -->
        <auth-validation-errors class="mb-4" :errors="$window.Laravel.errors" />

        <form :method="routeMethod('password.update')" :action="route('password.update')">
            <csrf-token />

            <!-- Password Reset Token -->
            <input type="hidden" name="token" :value="tokenFromUrl">

            <!-- Email Address -->
            <div>
                <input-label for="email" value="E-Mail" />

                <input-field id="email" classes="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <input-label for="password" value="Neues Passwort" />

                <input-field id="password" classes="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <input-label for="password_confirmation" value="Neues Passwort bestätigen" />

                <input-field id="password_confirmation" classes="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <submit-button>
                    Neues Passwort setzen
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
    name: 'ResetPassword',
    components: { SubmitButton, InputField, InputLabel, CsrfToken, AuthValidationErrors, ApplicationLogo, AuthCard },
    computed: {
        tokenFromUrl () {
            return window.location.pathname.split(/\//).pop()
        }
    }
}
</script>
