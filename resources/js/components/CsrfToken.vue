<template>
  <input type="hidden" name="_token" :value="$window.Laravel.csrf">
</template>
<script>
export default {
  name: 'CsrfToken'
}
</script>
