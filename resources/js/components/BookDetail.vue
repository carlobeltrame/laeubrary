<template>
    <div>
        <div class="sm:float-right sm:ml-5 mb-5 sm:w-auto bg-gray-100 rounded-lg text-left overflow-hidden sm:max-w-md sm:w-full shadow-md">
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row">
                <submit-button class="px-5 py-3 flex-grow inline-flex justify-center bg-white border-gray-300 text-gray-600 hover:bg-gray-200 active:bg-gray-200 sm:ml-3 w-full sm:w-auto"><font-awesome-icon class="mr-2 opacity-70" icon="qrcode" /> QR-Code</submit-button>
                <submit-button class="mt-3 sm:mt-0 px-5 py-3 flex-grow inline-flex justify-center bg-white border-gray-300 text-gray-600 hover:bg-gray-200 active:bg-gray-200 sm:ml-3 w-full sm:w-auto"><font-awesome-icon class="mr-2 opacity-70" icon="hand-holding-heart"></font-awesome-icon> Ausleihen</submit-button>
            </div>
        </div>

        {{ book.description }}

        <div class="clear-both"></div>
        <data-table v-if="borrowings.length" :data="borrowings" :columns="columns" class="mt-6" style="max-height: calc(100vh - 100px)">
            <template #name="{ row: borrowing }">
                <span class="opacity-0 select-none">{{ borrower(borrowing) }}</span>
                <a :href="'/borrowers/' + borrowing.id" class="py-3 px-6 border-b border-gray-200 absolute inset-0 bg-white hover:bg-gray-100 flex items-center font-medium" :class="{'hover:text-pink-500': !borrowing.returned_at, 'hover:text-blue-500': borrowing.returned_at}">
                    <font-awesome-icon class="hidden md:inline mr-2 opacity-70" :icon="['far', 'user-circle']"></font-awesome-icon>
                    {{ borrower(borrowing) }}
                </a>
            </template>

            <template #created-at="{ row: { created_at } }">{{ $date(created_at).format('DD.MM.YYYY') }}</template>

            <template #returned-at="{ row: { returned_at } }">
                <span v-if="returned_at">{{ $date(returned_at).format('DD.MM.YYYY') }}</span>
                <submit-button v-else class="bg-white border-gray-300 text-gray-500 hover:bg-gray-200 active:bg-gray-200">Zurückgegeben</submit-button>
            </template>
        </data-table>
    </div>
</template>
<script>
import DataTable from './DataTable'
import SubmitButton from './SubmitButton'
export default {
    name: 'BookDetail',
    components: { SubmitButton, DataTable },
    props: {
        book: { type: Object, required: true }
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
            classes: '',
        }, {
            label: 'Zurück',
            name: 'returned_at',
            classes: '',
        }],
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
    }
}
</script>
