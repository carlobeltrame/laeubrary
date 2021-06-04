<template>
    <div>
        <div class="flex items-baseline">
            <submit-button
                class="inline-flex items-center px-4 py-2 shadow-sm border rounded-md font-semibold text-base sm:text-sm tracking-wider focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-25 transition ease-in-out duration-150 px-5 py-3 mb-3 mx-2 md:mx-0 bg-white border-gray-300 text-gray-600 hover:bg-gray-200 active:bg-gray-200 flex-grow md:flex-grow-0"
                :disabled="!selected.length"
                target="_blank"
                :href="route('qrcodes.print', { books: selected.join(',') })">
                <font-awesome-icon class="mr-2 opacity-70" icon="qrcode" />
                <span v-if="selected.length === 1">1 QR-Code drucken...</span>
                <span v-else>{{ selected.length }} QR-Codes drucken...</span>
            </submit-button>

            <a class="ml-4 underline text-gray-600 hover:text-gray-900 cursor-pointer text-sm" @click="selectAll">Alle auswählen</a>
            <a class="ml-4 underline text-gray-600 hover:text-gray-900 cursor-pointer text-sm" @click="selectNone">Keine auswählen</a>
        </div>
        <data-table :data="data" :columns="columns" style="max-height: calc(100vh - 170px)">
            <template #name="{ row: { name, id, current_borrowing } }">
                <label :for="'selected['+id+']'">
                    <span class="opacity-0 select-none">{{ name }}</span>
                    <span class="py-3 px-6 md:border-b border-gray-200 absolute inset-0 flex items-center" :class="{'hover:text-pink-500': current_borrowing, 'hover:text-blue-500': !current_borrowing}">
                        <input type="checkbox" :name="'selected['+id+']'" :id="'selected['+id+']'" :value="id" v-model="selected" class="mr-2" />
                        <font-awesome-icon class="hidden md:inline mr-2 opacity-50" :icon="['fas', 'book']"></font-awesome-icon>
                        {{ name }}
                    </span>
                </label>
            </template>
            <template #created-at="{ row: { created_at } }">
                {{ $date(created_at).format('DD.MM.YYYY') }}
            </template>
        </data-table>
    </div>
</template>
<script>
import DataTable from './DataTable'
import SubmitButton from './SubmitButton'
export default {
    name: 'QrcodeSelection',
    components: { SubmitButton, DataTable },
    props: {
        data: { type: Array, default: [] },
    },
    data: () => ({
        columns: [{
            label: 'Name',
            name: 'name',
            classes: 'font-medium sticky left-0 bg-white hover:bg-gray-100 z-10 border-none overflow-hidden overflow-ellipsis',
            headerClasses: 'sticky left-0 z-20',
        }, {
            label: 'Hinzugefügt',
            name: 'created_at',
            classes: 'overflow-hidden overflow-ellipsis md:max-w-lg limit-max-width',
        }, {
            label: 'Beschreibung',
            name: 'description',
            classes: 'overflow-hidden overflow-ellipsis md:max-w-lg limit-max-width',
        }],
        selected: [],
    }),
    methods: {
        borrower (borrowing) {
            if (!borrowing || !borrowing.borrower) return ''
            return borrowing.borrower.name
        },
        borrowDate (borrowing) {
            if (!borrowing) return ''
            return this.$date(borrowing.created_at).format('DD.MM.YYYY')
        },
        selectAll () {
            this.selected = this.data.map(book => book.id)
        },
        selectNone () {
            this.selected = []
        },
    }
}
</script>
<style scoped>
/deep/ .limit-max-width {
    width: calc(100vw - 3rem - 2px);
}
@media (max-width: 640px) {
    /deep/ .limit-max-width {
        width: 100vw;
    }
}
</style>
