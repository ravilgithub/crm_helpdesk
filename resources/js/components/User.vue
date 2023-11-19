<template lang="pug">

.user
    h2.user__fio= user.name
    p.user__role( :class="roleHighlight" )= user.role
    slot
    router-link( :to="{ name: 'user', params: { id: user.id }}" class="user__details" ) User page

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
            return 'user__role--' + this.user.role.toLowerCase()
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
