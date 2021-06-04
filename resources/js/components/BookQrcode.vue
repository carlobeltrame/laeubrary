<template>
    <div class="flex flex-col items-center bg-white text-xs p-3 border">
        <qrcode-vue class="mb-4" :value="qrCodeLocation" size="120" level="H"/>
        <a :href="qrCodeLocation" class="w-full text-center line-clamp-2 h-8 break-words">{{ qrCodeLocation }}</a>
        <div v-if="bookName" class="w-full text-center line-clamp-3 h-12">{{ bookName }}</div>
    </div>
</template>
<script>
import QrcodeVue from 'qrcode.vue'

export default {
    name: 'BookQrcode',
    components: { QrcodeVue },
    props: {
        bookName: { type: String, default: null },
        bookId: { type: Number, required: true },
    },
    computed: {
        qrCodeLocation () {
            const location = new URL(window.location)
            location.hash = '#borrow'
            location.pathname = '/books/' + this.bookId
            location.search = ''
            return location.toString()
        }
    }
}
</script>
