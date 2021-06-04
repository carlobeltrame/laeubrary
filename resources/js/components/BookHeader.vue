<template>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            <font-awesome-icon class="ml-1 mr-2 opacity-80" icon="book"></font-awesome-icon>
            <editable-text v-if="book.id" :value="book.name" name="name" :method="routeMethod('books.update')" :action="route('books.update', { book: book.id })" placeholder="Name"></editable-text>
            <template v-else>{{ book.name }}</template>
        </h2>
        <div v-if="book.current_borrowing" class="flex flex-col mt-4 md:mt-0">
            <a :href="route('borrowers.show', { borrower: book.current_borrowing.borrower_id })" class="font-medium text-gray-500"><font-awesome-icon class="mr-1 text-gray-400" icon="hand-holding-heart" /> {{ borrower }}</a>
            <div class="text-xs mt-2"><span class="font-handwriting">{{ borrowDate }}</span></div>
        </div>
    </div>
</template>
<script>
import EditableText from './EditableText'
export default {
    name: 'BookHeader',
    components: { EditableText },
    props: {
        book: { type: Object, required: true }
    },
    computed: {
        borrower () {
            if (!this.book.current_borrowing || !this.book.current_borrowing.borrower) return ''
            return this.book.current_borrowing.borrower.name
        },
        borrowDate () {
            if (!this.book.current_borrowing) return ''
            return this.$date(this.book.current_borrowing.created_at).format('DD.MM.YYYY')
        },
    }
}
</script>
