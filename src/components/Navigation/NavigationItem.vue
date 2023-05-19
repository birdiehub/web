<template>
  <router-link :to="route" class="no-text-decoration nav-item">
    <IconAndText :title="content" :icon="icon" :class="{ 'selected': currentRouteName === name}"/>
  </router-link>
</template>

<script>
import IconAndText from "@/components/Item/IconAndText";

export default {
  name: "NavigationItem",
  props: {
    route: String,
    name: String,
    content: String,
    icon: String
  },
  components: {
    IconAndText
  },
  computed: {
      currentRouteName() {
          return this.$route.name;
      }
  }
};
</script>

<style scoped lang="scss">

.nav-item {
  padding: 0 1rem;
}

.selected {
  font-weight: bold;
}

</style>
