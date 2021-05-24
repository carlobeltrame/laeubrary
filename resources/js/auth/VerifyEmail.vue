<template>
    <auth-card>
        <template #logo>
            <a href="/">
                <application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Danke fürs Registrieren! Bevor du loslegen kannst, bitte verifiziere deine E-Mail-Adresse indem du auf den Link klickst den wir dir gerade gesendet haben. Falls du keine E-Mail erhalten hast, senden wir dir gerne nochmals eine.
        </div>

        <div v-if="$window.Laravel.status === 'verification-link-sent'" class="mb-4 font-medium text-sm text-green-600">
            Wir haben dir nochmals eine E-Mail an die Adresse gesendet mit der du registriert bist.
        </div>

        <div class="mt-4 flex items-center justify-between">
            <form :method="routeMethod('verification.send')" :action="route('verification.send')">
                <csrf-token />

                <div>
                    <submit-button class="bg-gray-800 border-transparent text-white hover:bg-gray-700 active:bg-gray-900">
                        E-Mail erneut senden
                    </submit-button>
                </div>
            </form>

            <form :method="routeMethod('logout')" :action="route('logout')">
                <csrf-token />

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Abmelden
                </button>
            </form>
        </div>
    </auth-card>
</template>
<script>
import AuthCard from '../components/AuthCard'
import ApplicationLogo from '../components/ApplicationLogo'
import CsrfToken from '../components/CsrfToken'
import SubmitButton from '../components/SubmitButton'
export default {
    name: 'VerifyEmail',
    components: { SubmitButton, CsrfToken, ApplicationLogo, AuthCard }
}
</script>
