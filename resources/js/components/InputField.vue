<template>
<div>
    <input :disabled="disabled" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" :name="name" :class="classes" :type="type" :value="value" :required="required" :autofocus="autofocus" v-bind="$attrs" />
    <ul v-if="errors.length" class="mt-2 list-disc list-inside text-sm text-red-600">
        <li v-for="error in errors">{{ error }}</li>
    </ul>
</div>
</template>
<script>
export default {
    name: 'InputField',
    props: {
        disabled: { type: Boolean, default: false },
        name: { type: String, required: true },
        classes: { type: String, default: '' },
        type: { type: String, default: 'text' },
        value: { type: String, default: '' },
        required: { type: Boolean, default: false },
        autofocus: { type: Boolean, default: false }
    },
    computed: {
        errors () {
            return window.Laravel.errors[this.name] ?? []
        }
    }
}
</script>
