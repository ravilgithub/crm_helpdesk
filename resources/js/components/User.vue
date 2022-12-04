<template lang="pug">

.user
    h2.user__item {{user.first}} {{user.last}}
    slot

</template>

<script>
export default {
    name: "User",

    props: {
      user: {
         type: Array,
         required: true
      }
    }
}
</script>

<style lang="sass" scoped>
    .user
        margin-bottom: 10px
        padding-bottom: 10px
        border-bottom: 1px solid #555

        &__item
            /**/
</style>
