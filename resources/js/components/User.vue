<template lang="pug">

.user
    .user__fio {{user.first}} {{user.last}}
    small.user__role( v-if="user.role === 'client'" )= user.role
    p.user__role( v-else )= user.role
    slot

</template>

<script>
export default {
    name: "User",

    props: {
      user: {
         type: Object,
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

        &__fio
            /**/

        &__role
            display: block
</style>
