<template lang="pug">

.user
    .user__fio {{user.fname}} {{user.lname}}
    small.user__role( v-if="user.role === 'client'" :class="roleHighlight" )= user.role
    p.user__role( v-else :class="roleHighlight" )= user.role
    slot
    router-link( :to="'/users/' + user.id" class="user__details" ) User page

</template>

<script>

export default {
    name: "User",

    props: {
      user: {
         type: Object,
         required: true,
      }
    },

    computed: {
      roleHighlight() {
          return 'user__role--' + this.user.role
      },
    },
}

</script>

<style lang="sass" scoped>

$admin-color: green
$main-manager-color: coral
$manager-color: blue
$client-color: red

.user
    margin-bottom: 10px
    padding-bottom: 10px
    border-bottom: 1px solid #555

    &__fio
        /**/

    &__role
        display: block

        &--admin
            color: $admin-color
        &--main-manager
            color: $main-manager-color
        &--manager
            color: $manager-color
        &--client
            color: $client-color

    &__details
        display: block

</style>
