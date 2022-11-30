<template lang="pug">

h1= title

input(
    type='text',
    v-model='title'
)

ul
    li(
        v-for='user in users',
        :key='getKey()'
    )= user

input(
    type='text'
    v-model='name'
)

button.btn(
    @click='addUser'
) Add user

</template>

<script>
    export default {
        name: "AppHome",
        data() {
            return {
                title: 'Crm Helpdesk!',
                users: [
                    'John Smith',
                    'Mike Dow',
                    'Jane Dow',
                ],
                name: null,
            }
        },

        methods: {
            getKey() {
                return Math.random().toString( 36 ).slice( -10 )
            },

            addUser() {
                if ( this.name ) {
                    this.users.push( this.name )
                    this.name = null
                }
            },
        },
    }
</script>

<style lang="sass" scoped>
    $baseColor: #5830ea
    $baseBgColor: #d7d7d7

    *
        color: $baseColor

    p
        background-color: $baseBgColor
</style>
