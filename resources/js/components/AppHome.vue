<template lang="pug">

h1= title

input(
    type="text",
    v-model="title"
)


// Users list
user(
    v-for="user in users"
    :user="user"
    :key="getKey()"
) Some test


// Add User
input(
    v-model="firstName"
    type="text"
    placeholder="First name"
)

input(
    v-model="lastName"
    type="text"
    placeholder="Last name"
)

button.btn(
    @click="addUser"
) Add user

</template>

<script>
    import User from './User'

    export default {
        name: "AppHome",

        components: {
            User
        },

        data() {
            return {
                title: 'Crm Helpdesk!',

                users: [
                    {
                        first: 'John',
                        last: 'Smith'
                    },
                    {
                        first: 'Mike',
                        last: 'Dow'
                    },
                    {
                        first: 'Jane',
                        last: 'Dow'
                    }
                ],

                firstName: null,
                lastName: null
            }
        },

        methods: {
            getKey() {
                return Math.random().toString( 36 ).slice( -10 )
            },

            addUser() {
                if ( this.firstName && this.lastName ) {
                    this.users.push( {
                        first: this.firstName,
                        last: this.lastName }
                    )

                    this.firstName = null
                    this.lastName = null
                }
            }
        }
    }
</script>

<style lang="sass" scoped>
    $baseColor: #5830ea
    $baseBgColor: #d7d7d7

    *
        color: $baseColor

    p
        background-color: $baseBgColor

    input
        display: block
</style>
