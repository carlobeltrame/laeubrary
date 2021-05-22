<template>
<label class="block font-medium text-sm text-gray-700" v-bind="$attrs">
    <slot>{{ value }}</slot>
</label>
</template>
<script>
export default {
    name: 'InputLabel',
    props: {
        value: { type: String, required: true }
    }
}
</script>
