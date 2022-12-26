<template lang="pug">

h1 {{title}}

input(
    type="text",
    v-model="title"
)

</template>

<script>

    export default {
        name: "AppHome",

        data() {
            return {
                title: 'Crm Helpdesk!',
            }
        },
    }

</script>

<style lang="sass" scoped>

</style>
