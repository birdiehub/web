<template>
  <nav class="navigation-items-wrapper">
    <ul>
      <li><NavigationItem :route="`/dashboard`" :name="`Dashboard`" :content="this.$translator.translate('app.nav.dashboard')" :icon="`home`"/></li>
      <li><NavigationItem :route="`/players`" :name="`Players`" :content="this.$translator.translate('app.nav.players')" :icon="`person`"/></li>
    </ul>
  </nav>
</template>

<script>
import NavigationItem from "@/components/Navigation/NavigationItem";

export default {
  name: "SideNavigation",
  components: {
    NavigationItem
  }
};
</script>
