<template>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            <font-awesome-icon class="ml-1 mr-2 opacity-80" icon="user-circle"></font-awesome-icon>
            <editable-text v-if="borrower.id" :value="borrower.name" name="name" :method="routeMethod('borrowers.update')" :action="route('borrowers.update', { borrower: borrower.id })" placeholder="Name"></editable-text>
            <template v-else>{{ borrower.name }}</template>
        </h2>
        <div class="font-medium text-gray-500 mt-4 md:mt-0">
            <font-awesome-icon class="mr-1 text-gray-400" icon="hand-holding-heart" /> {{ numActiveBorrowings }}
        </div>
    </div>
</template>
<script>
import EditableText from './EditableText'
export default {
    name: 'BorrowerDetail',
    components: { EditableText },
    props: {
        borrower: { type: Object, required: true }
    },
    computed: {
        activeBorrowings () {
            if (!this.borrower.borrowings) return []
            return this.borrower.borrowings.filter(borrowing => borrowing.returned_at == null)
        },
        numActiveBorrowings () {
            const count = this.activeBorrowings.length
            if (count === 0) return 'Aktuell nichts ausgeliehen'
            if (count === 1) return 'Ein ausgeliehenes Buch'
            return count + ' ausgeliehene Bücher'
        }
    }
}
</script>
