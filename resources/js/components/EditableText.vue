<template>
    <form v-if="editing" :method="method === 'GET' ? method : 'POST'" :action="action" class="inline"><!--
        --><csrf-token /><!--
        --><input type="hidden" name="_method" :value="method" /><!--
        --><input-field :name="name" :type="type" :class="{'inline-block': type !== 'textarea'}" :classes="editClass" :value="value" :placeholder="placeholder" />
        <submit-button @click="editing = false">Abbrechen</submit-button>
        <submit-button class="bg-blue-500 border-transparent text-white hover:bg-blue-700 active:bg-blue-900">OK</submit-button>
    </form>
    <span v-else class="hover-editable">{{ value }} <font-awesome-icon icon="pen-nib" class="edit-button text-blue-500 ml-3 hover:text-blue-800" :class="{ invisible: value }" @click="editing = true"></font-awesome-icon></span>
</template>
<script>
import InputField from './InputField'
import SubmitButton from './SubmitButton'
import CsrfToken from './CsrfToken'
export default {
    name: 'EditableText',
    components: { CsrfToken, SubmitButton, InputField },
    props: {
        value: { type: String, requred: true },
        method: { type: String, default: 'POST' },
        action: { type: String, required: true },
        name: { type: String, required: true },
        type: { type: String, default: 'text' },
        editClass: { type: String, default: '' },
        placeholder: { type: String, default: '' },
    },
    data: () => ({
        editing: false
    })
}
</script>
<style scoped>
.hover-editable:hover .edit-button {
    visibility: visible;
}
</style>
