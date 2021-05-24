<template>
    <div class="px-6 pb-6 pt-3">

        <!-- Validation Errors -->
        <auth-validation-errors class="mb-4" :errors="$window.Laravel.errors" />

        <form :method="routeMethod('books.store')" :action="route('books.store')">
            <csrf-token />

            <div class="mt-4">
                <input-label for="name" value="Titel" />

                <input-field id="name" classes="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <input-label for="description" value="Beschreibung" />

                <input-field id="description" classes="block mt-1 w-full" type="textarea" name="description" :value="old('description')" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <submit-button class="ml-3 bg-gray-800 border-transparent text-white hover:bg-gray-700 active:bg-gray-900">
                    Speichern
                </submit-button>
            </div>
        </form>
    </div>
</template>
<script>
import DataTable from './DataTable'
import SubmitButton from './SubmitButton'
import CsrfToken from './CsrfToken'
import ModalDialog from './ModalDialog'
import MultiSelect from '@vueform/multiselect/dist/multiselect.vue2.js'
import InputLabel from './InputLabel'
import AuthValidationErrors from './AuthValidationErrors'
import InputField from './InputField'
export default {
    name: 'BookDetail',
    components: { InputField, AuthValidationErrors, InputLabel, ModalDialog, CsrfToken, SubmitButton, DataTable, MultiSelect },
    props: {
        book: { type: Object, required: true },
    },
    data: () => ({
        columns: [{
            label: 'Ausgeliehen an',
            name: 'name',
            classes: 'font-medium sticky left-0 bg-white hover:bg-gray-100 z-10 border-none overflow-hidden overflow-ellipsis',
            headerClasses: 'sticky left-0 z-20',
        }, {
            label: 'Datum',
            name: 'created_at',
            classes: 'text-xs',
        }, {
            label: 'Zurück',
            name: 'returned_at',
            classes: 'text-sm',
        }],
        selectedBorrower: null,
        borrowerQuery: '',
        newBorrower: '',
    }),
    computed: {
        borrowings () {
            return (this.book.borrowings || []).sort((a, b) => {
                return this.$date(b.created_at).unix() - this.$date(a.created_at).unix()
            })
        }
    },
    methods: {
        borrower (borrowing) {
            if (!borrowing || !borrowing.borrower) return ''
            return borrowing.borrower.name
        },
        borrowDate (borrowing) {
            if (!borrowing) return ''
            return this.$date(borrowing.created_at).format('DD.MM.YYYY')
        },
        borrowerSearchUpdated (query) {
            this.borrowerQuery = query
        },
        async fetchOptions (query) {
            if (!query) return (await window.axios.get('/borrowers')).data
            return (await window.axios.get('/borrowers?query=' + query)).data
        },
        addNewBorrower () {
            const emptyQuery = !this.borrowerQuery
            this.newBorrower = this.borrowerQuery || 'Name eingeben...'
            this.selectedBorrower = null
            this.$nextTick(() => {
                this.$refs.newBorrowerName.focus()
                if (emptyQuery) {
                    this.$refs.newBorrowerName.select()
                }
            })
        },
        newBorrowerUpdated () {
            if (!this.newBorrower) {
                this.$nextTick(() => {
                    this.$refs.borrowerSelect.open()
                })
            }
        },
    }
}
</script>
