<template>
<div v-if="$window.Laravel.status" class="font-medium text-sm text-green-600">
    {{ status }}
</div>
</template>
<script>
export default {
    name: 'AuthSessionStatus',
    props: {
        status: {}
    }
}
</script>
