<template>
<button type="submit" class="inline-flex items-center px-4 py-2 shadow-sm border rounded-md font-semibold text-base sm:text-sm tracking-wider focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-25 transition ease-in-out duration-150" v-bind="$attrs">
    <slot />
</button>
</template>
<script>
export default {
    name: 'SubmitButton'
}
</script>
