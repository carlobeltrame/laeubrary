<template>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            <font-awesome-icon class="ml-1 mr-2 opacity-80" icon="book"></font-awesome-icon> {{ book.name }}
        </h2>
        <div v-if="this.book.current_borrowing" class="flex flex-col mt-4 md:mt-0">
            <div class="font-medium text-gray-500"><font-awesome-icon class="mr-1 text-gray-400" icon="hand-holding-heart" /> {{ borrower }}</div>
            <div class="text-xs mt-2"><span class="font-handwriting">{{ borrowDate }}</span></div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'BookHeader',
    components: {},
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
