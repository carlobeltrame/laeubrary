<template>
    <div>
        <div class="sm:float-right sm:ml-5 mb-5 sm:w-auto bg-gray-100 rounded-lg text-left overflow-hidden sm:max-w-md sm:w-full shadow-md">
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row">

                <modal-dialog class="mt-3 sm:mt-0 flex-grow sm:ml-3 sm:w-auto" :cancel="false">
                    <template #activator="{ onClick }">
                        <submit-button class="px-5 py-3 flex-grow inline-flex justify-center bg-white border-gray-300 text-gray-600 hover:bg-gray-200 active:bg-gray-200 w-full" @click="onClick"><font-awesome-icon class="mr-2 opacity-70" icon="qrcode" /> QR-Code</submit-button>
                    </template>

                    <template #header><p class="text-lg font-medium leading-6 text-gray-900"><font-awesome-icon class="mr-2 opacity-70" icon="qrcode"></font-awesome-icon> QR-Code für {{ book.name }}</p></template>

                    <div class="w-full flex justify-center">
                        <book-qrcode :book-id="book.id" :book-name="book.name" style="max-width: 11rem;"/>
                    </div>
                </modal-dialog>

                <modal-dialog :formmethod="routeMethod('borrowings.store')" :formaction="route('borrowings.store')" anchor="borrow" class="mt-3 sm:mt-0 flex-grow sm:ml-3 sm:w-auto">
                    <template #activator="{ onClick }">
                        <submit-button @click="onClick" class="px-5 py-3 inline-flex justify-center bg-blue-50 border-blue-300 text-blue-600 hover:bg-blue-100 active:bg-blue-200 w-full"><font-awesome-icon class="mr-2 opacity-70" icon="hand-holding-heart"></font-awesome-icon> Ausleihen</submit-button>
                    </template>

                    <template #header><p class="text-lg font-medium leading-6 text-gray-900"><font-awesome-icon class="mr-2 opacity-70" icon="hand-holding-heart"></font-awesome-icon> {{ book.name }} ausleihen</p></template>

                    <div v-if="book.current_borrowing" class="flex flex-col mt-4 mb-6 p-3 bg-red-200 rounded md:mt-0">
                        <form :method="routeMethod('borrowings.return')" :action="route('borrowings.return', { borrowing: book.current_borrowing.id, returnToBorrowing: true })">
                            <csrf-token />
                            <submit-button class="float-right bg-white border-gray-300 text-gray-500 hover:bg-gray-200 active:bg-gray-200">Zurückgegeben</submit-button>
                            <span>Aktuell ausgeliehen an:</span>
                            <div class="font-medium text-gray-500 mt-2"><font-awesome-icon class="mr-1 opacity-60" icon="hand-holding-heart" /> {{ borrower(book.current_borrowing) }}</div>
                            <div class="text-xs mt-2"><span class="font-handwriting">{{ borrowDate(book.current_borrowing) }}</span></div>
                        </form>
                    </div>

                    <multi-select
                        v-if="!newBorrower"
                        ref="borrowerSelect"
                        v-model="selectedBorrower"
                        :options="fetchOptions"
                        :delay="500"
                        :filter-results="false"
                        label="name"
                        valueProp="id"
                        searchable
                        required
                        :can-deselect="false"
                        no-results-text="Niemand gefunden."
                        no-options-text="Niemand gefunden."
                        class="mb-2"
                        @search-change="borrowerSearchUpdated"
                    >
                        <template #afterlist>
                            <button class="flex px-3 py-2 w-full text-gray-500 items-center justify-start cursor-pointer hover:bg-gray-200 z-20" tabindex="-1" @click.prevent @mousedown.prevent.stop="addNewBorrower">Neue Person erfassen...</button>
                        </template>
                    </multi-select><input v-else ref="newBorrowerName" type="text" name="new_borrower_name" v-model="newBorrower" class="w-full mb-2 rounded" style="height: 54.5px" @input="newBorrowerUpdated" /> möchte <span class="font-semibold text-gray-700">{{ book.name }}</span> ausleihen.

                    <input type="hidden" name="book_id" :value="book.id" />
                    <input v-if="!newBorrower" type="hidden" name="borrower_id" :value="selectedBorrower" />

                    <template #submit><submit-button class="ml-3 bg-blue-800 border-transparent text-white hover:bg-blue-700 active:bg-blue-900"><font-awesome-icon class="mr-2 opacity-90" icon="hand-holding-heart"></font-awesome-icon> Ausleihen</submit-button></template>
                </modal-dialog>
            </div>
        </div>

        <editable-text :value="book.description" name="description" type="textarea" :method="routeMethod('books.update')" :action="route('books.update', { book: book.id })" edit-class="w-full lg:w-1/2" placeholder="Beschreibung" class="whitespace-pre-wrap"></editable-text>

        <div class="clear-both"></div>

        <h3 v-if="borrowings.length" class="font-medium text-xl text-gray-600 mt-6 mb-3">History</h3>

        <data-table v-if="borrowings.length" :data="borrowings" :columns="columns" class="md:shadow">
            <template #name="{ row: borrowing }">
                <span class="opacity-0 select-none">{{ borrower(borrowing) }}</span>
                <a :href="route('borrowers.show', { borrower: borrowing.borrower_id })" class="py-3 px-6 md:border-b border-gray-200 absolute inset-0 flex items-center font-medium" :class="{'hover:text-pink-500': !borrowing.returned_at, 'hover:text-blue-500': borrowing.returned_at}">
                    <font-awesome-icon class="hidden md:inline mr-2 opacity-70" icon="hand-holding-heart"></font-awesome-icon>
                    {{ borrower(borrowing) }}
                </a>
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
import BookQrcode from './BookQrcode'

export default {
    name: 'BookDetail',
    components: { BookQrcode, EditableText, ModalDialog, CsrfToken, SubmitButton, DataTable, MultiSelect},
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
        },
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
            return (await window.axios.get(this.route('borrowers.available', { query: query || '' }))).data
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
