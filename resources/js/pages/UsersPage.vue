<template lang="pug">

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
        v-model="fname"
        type="text"
        placeholder="First name"
        required
    )

    input.form__item.form__item--text(
        v-model="lname"
        type="text"
        placeholder="Last name"
        required
    )

    select.form__item.form__item--select(
        v-model="role"
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

import User from '../components/User.vue'

export default {
    name: "UsersPage",

    components: {
        User,
    },

    data() {
        return {
            users: [
                {
                    id: 1,
                    fname: 'Dmitriy',
                    lname:  'Petrov',
                    role:  'admin',
                },
                {
                    id: 2,
                    fname: 'Nikolay',
                    lname:  'Ivanov',
                    role:  'main-manager',
                },
                {
                    id: 3,
                    fname: 'Irina',
                    lname:  'Lavrova',
                    role:  'manager',
                },
                {
                    id: 4,
                    fname: 'Vasiliy',
                    lname:  'Frolov',
                    role:  'client',
                },
                {
                    id: 5,
                    fname: 'Tatiana',
                    lname:  'Corokina',
                    role:  'client',
                },
            ],

            fname: '',
            lname: '',
            role: '',

            roles: [
                'admin',
                'main-manager',
                'manager',
                'client',
            ],

            userRole: '',
        }
    },

    created() {
        // this.userRole = this.getUserRole()
    },

    computed: {
        shouldShowUsers() {
            return this.users.filter( user => user.role !== this.userRole )
        }
    },

    methods: {
        // Temp method
        /*getUserRole() {
            const queryString = window.location.search,
                urlParams = new URLSearchParams( queryString ),
                role = urlParams.get( 'role' )

            return role ? role : this.userRole
        },*/

        getKey() {
            return Math.random().toString( 36 ).slice( -10 )
        },

        addUser() {
            if ( this.fname && this.lname && this.role ) {
                const userId = this.users.length + 1
                this.users.push( {
                    id: userId,
                    fname: this.fname,
                    lname: this.lname,
                    role: this.role,
                } )

                this.fname = ''
                this.lname = ''
                this.role = ''
            }
        },
    },
}

</script>

<style lang="sass" scoped>

.users
    margin-top: 30px
    padding-top: 10px
    border-top: 1px solid #555

.form
    &__item
        display: block
        margin-top: 4px

</style>
