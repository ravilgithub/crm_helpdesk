<template lang="pug">

.user
    .user__details
        h1= user.name
        p= user.email

</template>

<script>
export default {
    name: "UserPage",

    data() {
        return {
            user: {},
        }
    },

    mounted() {
        this.getUserData()
    },

    methods: {
        async getUserData() {
            // Vue Route
            const userId = this.$route.params.id

            // Laravel Route
            const response = await axios.get(`/users/${userId}`)

            if (200 === response.status)
                this.user = response.data
        },
    },
}
</script>

<style scoped></style>
