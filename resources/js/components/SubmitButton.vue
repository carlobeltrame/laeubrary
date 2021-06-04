<template>
<button
    :is="href && !disabled ? 'a' : 'button'"
    :href="href"
    :disabled="disabled"
    type="submit"
    class="inline-flex items-center px-4 py-2 shadow-sm border rounded-md font-semibold text-base sm:text-sm tracking-wider transition ease-in-out duration-150"
    :class="{ 'opacity-50 cursor-auto': disabled, 'focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500': !disabled }"
    v-bind="$attrs"
    v-on="$listeners">
    <slot />
</button>
</template>
<script>
export default {
    name: 'SubmitButton',
    props: {
        href: { type: String, default: null },
        disabled: { type: Boolean, default: null },
    }
}
</script>
