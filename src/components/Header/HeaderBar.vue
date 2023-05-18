<template>
  <header class="header-wrapper">
    <div class="desktop-header">
      <div class="header-actions flex-center-row">
        <IconButton :icon="`notifications`" :color="`var(--color-text)`"/>
        <ProfileButton :content="initials()" @click="showProfileMenu = !showProfileMenu"/>
        <div class="profile-menu box" v-show="showProfileMenu">
          <div class="flex-gap-row">
              <h3>{{ this.me.first_name }} {{ this.me.last_name }}</h3>
              <IconButton :icon="`logout`" :color="`var(--color-text)`" @click="clickedLogout"/>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';

import TextButton from "@/components/Button/TextButton";
import IconButton from "@/components/Button/IconButton";
import ProfileButton from "@/components/Button/ProfileButton";

export default {
  name: "HeaderBar",
  methods: {
    ...mapActions(['logout']),
    initials() {
      const char1 = this.me.first_name.charAt(0).toUpperCase();
      const char2 = this.me.last_name.charAt(0).toUpperCase();
      return char1 + char2;
    },
    clickedLogout() {
      this.logout().then(() => {
        this.$router.push('/auth/login');
      });
    }
  },
  computed: {
    ...mapGetters(['me'])
  },
  components: {
    TextButton,
    IconButton,
    ProfileButton
  },
  data() {
    return {
      showProfileMenu: false
    };
  }
};
</script>

<style scoped lang="scss">

.header-wrapper {
  /* height is used in .content-wrapper! */
  height: 4rem;
  display: flex;
  flex: auto;
  align-items: center;
  justify-content: end;
  border-bottom: var(--border);
  box-shadow: var(--box-shadow);
  padding: 0 1rem;
}

.header-actions {
  gap: 2rem;
}

.profile-menu {
  position: absolute;
  top: 3.5rem;
  right: 1rem;
  box-shadow: var(--box-shadow);
  display: inline-block;
  z-index: 11;
  padding: 1rem;
}

</style>
