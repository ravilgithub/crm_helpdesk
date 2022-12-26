<template lang="pug">

nav
    ul.menu
        li.menu__item
            router-link(to="/" class="menu__link") Home
        li.menu__item
            router-link(to="/users" class="menu__link") Users
        li.menu__item
            router-link(to="/admin" class="menu__link") Admin

router-view

</template>

<script>

    export default {
        name: "App",
    }

</script>

<style lang="sass" scoped>

.menu
    display: flex
    column-gap: 10px
    padding-left: 0

    &__item
        list-style: none
        padding-left: 0
        &:not(:last-child)
            &:after
                content: "|"
                padding-left: 10px

    &__link
        color: #000000
        text-decoration: none

    .router-link-active
        color: #ff0000
        text-decoration: underline

</style>
