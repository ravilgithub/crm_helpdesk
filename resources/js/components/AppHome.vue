<template lang="pug">

h1 {{title}}

input(
    type="text",
    v-model="title"
)


// Users list
.users
    user(
        v-for="user in shouldShowUsers"
        :user="user"
        :key="getKey()"
    ) Some test


// Add User
form.form.form--add-user
    input.form__item.form__item--text(
        v-model="firstName"
        type="text"
        placeholder="First name"
        required
    )

    input.form__item.form__item--text(
        v-model="lastName"
        type="text"
        placeholder="Last name"
        required
    )

    select.form__item.form__item--select(
        v-model="selectedRole"
        required
    )
        option(
            value=""
            disabled
        ) Please select one
        option(
            v-for="role in roles"
            :key="getKey()"
            :value="role"
        ) {{role}}

    button.btn.form__item.form__item--btn(
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
                        first: 'Dmitriy',
                        last:  'Petrov',
                        role:  'admin'
                    },
                    {
                        first: 'Nikolay',
                        last:  'Ivanov',
                        role:  'main-manager'
                    },
                    {
                        first: 'Irina',
                        last:  'Lavrova',
                        role:  'manager'
                    },
                    {
                        first: 'Vasiliy',
                        last:  'Frolov',
                        role:  'client'
                    },
                    {
                        first: 'Tatiana',
                        last:  'Corokina',
                        role:  'client'
                    }
                ],

                firstName: '',
                lastName: '',
                selectedRole: '',

                roles: [
                    'admin',
                    'main-manager',
                    'manager',
                    'client'
                ],

                userRole: ''
            }
        },

        created() {
            this.userRole = this.getUserRole()
        },

        computed: {
            shouldShowUsers() {
                return this.users.filter( user => user.role !== this.userRole )
            }
        },

        methods: {
            // Temp method
            getUserRole() {
                const queryString = window.location.search,
                    urlParams = new URLSearchParams( queryString ),
                    role = urlParams.get( 'role' )

                return role ? role : this.userRole
            },

            getKey() {
                return Math.random().toString( 36 ).slice( -10 )
            },

            addUser() {
                if ( this.firstName && this.lastName && this.selectedRole ) {
                    this.users.push( {
                        first: this.firstName,
                        last: this.lastName,
                        role: this.selectedRole
                    } )

                    this.firstName = ''
                    this.lastName = ''
                    this.selectedRole = ''
                }
            }
        }
    }
</script>

<style lang="sass" scoped>
    .form
        &__item
            display: block
            margin-top: 4px

    .users
        margin-top: 30px
        padding-top: 10px
        border-top: 1px solid #555
</style>
