<template>
  <LoadApp v-if="!loaded"/>
  <div id="authenticated-layout" v-if="loaded">
    <div class="sidebar-wrapper">
      <Sidebar/>
    </div>
    <div class="header-and-content-wrapper">
      <HeaderBar/>
      <Notifications/>
      <section class="content-wrapper">
        <router-view name="App"/>
      </section>
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

import LoadApp from "@/components/Load/LoadApp.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderBar from "@/components/Header/HeaderBar.vue";
import Notifications from "@/components/Notification/Notifications.vue";


export default {
  name: "AppLayout",
  components: {
    Notifications,
    LoadApp,
    Sidebar,
    HeaderBar
  },
  data() {
    return {
      loaded: false,
      reloadTimer: undefined
    };
  },
  computed: {
    ...mapGetters(['me'])
  },
  async mounted() {

      await Promise.all([
          this.fetchMe()
      ]).then(() => {
          this.loaded = true;
          // this.reload();
          this.createNotification({content: `${this.$translator.translate('global.feedback.welcome')}, ${this.me.first_name} ${this.me.last_name}!`});
      });
  },
  methods: {
    ...mapActions(["fetchMe", "createNotification"]),
    reload() {
      // Fetch data every 2 seconds here
      this.reloadTimer = setTimeout(this.reload, 2000);
    }
  },
  unmounted() {
    clearTimeout(this.reloadTimer);
  },
  destroyed() {
    clearTimeout(this.reloadTimer);
  }
};
</script>

<style scoped lang="scss">


#authenticated-layout {
  --sidebar-width: 16rem;

  position: fixed;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
}

.sidebar-wrapper {
  position: fixed;
  top: 0;
  left: 0;

  overflow: hidden;
  height: 100vh;
  width: var(--sidebar-width);
}

.header-and-content-wrapper {
  position: relative;
  height: 100vh;
  margin-left: var(--sidebar-width);
}

.content-wrapper {
  /* 5rem from padding and 4rem is from header bar */
  height: calc(100vh - 5rem - 4rem);
  background-color: var(--color-background-mute);
  padding: 2.5rem;
  overflow: auto;
}

</style>
