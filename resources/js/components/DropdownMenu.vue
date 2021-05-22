<template>

<div class="relative" @close.stop="close" v-click-outside="close">
    <div @click="open = ! open">
        <slot name="trigger" />
    </div>

    <div v-if="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-50 mt-2 rounded-md shadow-lg"
            :class="width + ' ' + alignmentClasses"
            @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5" :class="contentClasses">
            <slot />
        </div>
    </div>
</div>
</template>
<script>
export default {
    name: 'DropdownMenu',
    props: {
        align: { type: String, default: 'right' },
        width: { type: String, default: 'w-48' },
        contentClasses: { type: String, default: 'py-1 bg-white' }
    },
    data: () => ({
        open: false
    }),
    computed: {
        alignmentClasses () {
            if (this.align === 'left') return 'origin-top-left left-0'
            if (this.align === 'top') return 'origin-top'
            return 'origin-top-right right-0'
        }
    },
    methods: {
        close () {
            this.open = false
        }
    }
}
</script>
