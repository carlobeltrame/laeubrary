<template>
    <div>
        <h3 v-if="borrowings.length" class="font-medium text-xl text-gray-600 mb-3">History</h3>

        <data-table v-if="borrowings.length" :data="borrowings" :columns="columns" class="md:shadow">
            <template #book="{ row: { book } }">
                <a :href="route('books.show', { book: book.id })" class="hover:text-gray-900"><font-awesome-icon class="hidden md:inline mr-2 opacity-50" :icon="['fas', 'book']"></font-awesome-icon> {{ book.name }}</a>
            </template>

            <template #created-at="{ row: { created_at } }"><span class="font-handwriting">{{ $date(created_at).format('DD.MM.YYYY') }}</span></template>

            <template #returned-at="{ row: { returned_at, id } }">
                <span v-if="returned_at" class="font-handwriting">{{ $date(returned_at).format('DD.MM.YYYY') }}</span>
                <form v-else :method="routeMethod('borrowings.return')" :action="route('borrowings.return', { borrowing: id })">
                    <csrf-token />
                    <submit-button class="bg-white border-gray-300 text-gray-500 hover:bg-gray-200 active:bg-gray-200">Zurückgegeben</submit-button>
                </form>
            </template>
        </data-table>
    </div>
</template>
<script>
import DataTable from './DataTable'
import SubmitButton from './SubmitButton'
import CsrfToken from './CsrfToken'
import ModalDialog from './ModalDialog'
import MultiSelect from '@vueform/multiselect/dist/multiselect.vue2.js'
import EditableText from './EditableText'

export default {
    name: 'BorrowerDetail',
    components: { EditableText, ModalDialog, CsrfToken, SubmitButton, DataTable, MultiSelect},
    props: {
        borrower: { type: Object, required: true },
    },
    data: () => ({
        columns: [{
            label: 'Buch',
            name: 'book',
            classes: 'font-medium left-0 bg-white hover:bg-gray-100 overflow-hidden overflow-ellipsis',
            headerClasses: 'left-0',
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
            return (this.borrower.borrowings || []).sort((a, b) => {
                return this.$date(b.created_at).unix() - this.$date(a.created_at).unix()
            })
        },
    },
    methods: {
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
