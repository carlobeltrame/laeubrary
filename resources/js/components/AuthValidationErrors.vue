<template>
    <div v-if="anyErrors" v-bind="$attrs">
        <div class="font-medium text-red-600">
            Uuups, da ist etwas schief gelaufen.
        </div>
    </div>
</template>
<script>
export default {
    name: 'AuthValidationErrors',
    props: {
        errors: { type: Object, default: {} }
    },
    computed: {
        anyErrors () {
            return Object.keys(this.errors).length !== 0
        }
    }
}
</script>
