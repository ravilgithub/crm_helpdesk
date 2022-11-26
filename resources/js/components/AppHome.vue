<template lang="pug">
h1 Crm Helpdesk!
.box
    p.active {{ greating }}
</template>

<script>
export default {
    name: "AppHome",
    data() {
        return {
            greating: 'Hello, World!'
        }
    }
}
</script>

<style lang="sass" scoped>
    $baseColor: blue
    $baseBgColor: #d7d7d7

    *
        color: $baseColor

    p
        background-color: $baseBgColor
</style>
