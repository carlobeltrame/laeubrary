<template>
<a :class="classes" v-bind="$attrs">
    <slot />
</a>
</template>
<script>
export default {
    name: 'NavLink',
    props: {
        active: { type: Boolean, default: false }
    },
    computed: {
        classes () {
            return this.active ?
                'font-handwriting inline-flex items-center px-1 pt-2 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' :
                'font-handwriting inline-flex items-center px-1 pt-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
        }
    }
}
</script>
