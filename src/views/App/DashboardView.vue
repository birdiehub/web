<template>
  <HeaderContent :title="this.$translator.translate('app.views.dashboard.title')"/>
  <main class="main-content">
      <h2 class="important">{{ this.$translator.translate('app.coming_soon') }}</h2>
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
  name: "DashboardView",
  components: {
      HeaderContent
  },
  methods: {
  }
};
</script>

<style scoped lang="scss">

.main-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-transform: uppercase;
}

</style>
