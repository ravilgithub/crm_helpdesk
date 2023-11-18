<template lang="pug">

// Users list
.users
    user(
        v-for="user in users"
        :user="user"
        :key="user.id"
    ) Some test

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
            users: {},
        }
    },

    mounted() {
        this.getUsersData()
    },

    methods: {
        async getUsersData() {
            await axios
                .get('/users')
                .then(({ data, status }) => {
                    if (200 === status)
                        this.users = data
                })
        }
    },
}

</script>

<style lang="sass" scoped>

.users
    margin-top: 30px
    padding-top: 10px
    border-top: 1px solid #555

</style>
