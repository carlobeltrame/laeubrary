<template>
    <span v-if="large">
        <img :src="logoLarge" width="200" height="200">
        <img :src="laeubrary" width="200">
    </span>
    <img v-else :src="logoSmall" width="40" height="40">
</template>
<script>
import logoLarge from '../../images/logo-large.png'
import logoSmall from '../../images/logo-small.png'
import laeubrary from '../../images/laeubrary.png'
export default {
    name: 'ApplicationLogo',
    props: {
        large: { type: Boolean, default: false }
    },
    data: () => ({
        logoLarge,
        logoSmall,
        laeubrary
    })
}
</script>
