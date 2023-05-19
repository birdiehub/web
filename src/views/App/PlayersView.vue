<template>
    <HeaderContent :title="this.$translator.translate('app.views.players.title')"/>
    <main class="main-content">

    </main>
</template>

<script>
import HeaderContent from "@/components/Header/HeaderContent.vue";
import Icon from "@/components/Icon/Icon.vue";
import {mapGetters} from "vuex";
import router from "@/router";
import TextTile from "@/components/Tile/TextTile.vue";
import ShortcutTile from "@/components/Tile/ShortcutTile.vue";
import NotificationItem from "@/components/Notification/NotificationItem.vue";

export default {
    name: "PlayersView",
    components: {
        HeaderContent
    },
    methods: {
    }
};
</script>

<style scoped lang="scss">

</style>
