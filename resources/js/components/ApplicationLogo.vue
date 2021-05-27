<template>
    <span v-if="large">
        <img :src="logo" alt="Logo" width="200" height="200">
        <img :src="laeubrary" alt="Läubrary" width="200">
    </span>
    <img v-else :src="logo" alt="logo" width="60" height="60">
</template>
<script>
import logo from '../../images/logo-large.png'
import laeubrary from '../../images/laeubrary.png'
export default {
    name: 'ApplicationLogo',
    props: {
        large: { type: Boolean, default: false }
    },
    data: () => ({
        logo,
        laeubrary
    })
}
</script>
