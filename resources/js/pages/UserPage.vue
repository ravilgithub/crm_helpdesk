<template lang="pug">

.user
    .user__details( v-if="getUser" )
        h1 {{getUser.fname}} {{getUser.lname}}
        p Роль: {{getUser.role}}
        p ID: {{getUser.id}}
    .user__notexist( v-else ) Пользователь с ID {{id}} не существует.

</template>

<script>
export default {
    name: "UserPage",

    data() {
        return {
            id: null,

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
        }
    },

    created() {
        this.id = parseInt( this.$route.params.id )
    },

    computed: {
        getUser() {
            return this.users.filter( user => user.id === this.id )[ 0 ]
        },
    },
}
</script>

<style scoped>

</style>
