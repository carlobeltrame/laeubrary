<template>
    <div class="bg-white flex flex-wrap">
        <book-qrcode v-for="book in data" :key="book.id" :book-id="book.id" :book-name="book.name" class="w-1/4" />
    </div>
</template>
<script>
import BookQrcode from './BookQrcode'
export default {
    name: 'QrcodePrint',
    components: { BookQrcode },
    props: {
        data: { type: Array, default: [] },
    },
}
</script>
<style scoped>
</style>
