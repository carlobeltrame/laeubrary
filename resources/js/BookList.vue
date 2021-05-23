<template>
    <data-table :data="data" :columns="columns" style="max-height: calc(100vh - 100px)">
        <template #name="{ row: { name } }">
            {{ name }}
            <div class="py-3 px-6 border-b border-gray-200 absolute inset-0 bg-white hover:bg-gray-100 flex items-center">{{ name }}</div>
        </template>
        <template #current-borrowing="{ row: { current_borrowing } }">
            <div v-if="current_borrowing" class="flex items-center">
                <img class="w-8 h-8 rounded-full mr-3" src="/images/borrower.svg"/>
                <div class="flex flex-col">
                    <div class="font-medium text-gray-500">{{ borrower(current_borrowing) }}</div>
                    <div class="text-xs mt-2"><span class="font-handwriting">{{ borrowDate(current_borrowing) }}</span></div>
                </div>
            </div>
        </template>
    </data-table>
</template>
<script>
import DataTable from './components/DataTable'
export default {
    name: 'BookList',
    components: { DataTable },
    props: {
        data: { type: Array, default: [] },
    },
    data: () => ({
        columns: [{
            label: 'Name',
            name: 'name',
            classes: 'font-medium sticky left-0 bg-white hover:bg-gray-100 z-10 border-none',
            headerClasses: 'sticky left-0 z-20'
        }, {
            label: 'Beschreibung',
            name: 'description',
            classes: 'overflow-hidden overflow-ellipsis max-w-lg'
        }, {
            label: 'Ausgeliehen an',
            name: 'current_borrowing.'
        }]
    }),
    methods: {
        borrower (borrowing) {
            if (!borrowing || !borrowing.borrower) return ''
            return borrowing.borrower.name
        },
        borrowDate (borrowing) {
            if (!borrowing) return ''
            return this.$date(borrowing.created_at).format('DD.MM.YYYY')
        }
    }
}
</script>
