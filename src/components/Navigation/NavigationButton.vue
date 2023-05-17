<template>
    <router-link :to="route" class="no-text-decoration">
        <TextButton :content="name" :class="{ 'selected': currentRouteName === name }" class="box nav-button"/>
    </router-link>
</template>

<script>

import TextButton from "@/components/Button/TextButton.vue";

export default {
    name: "NavigationButton",
    components: {
        TextButton
    },
    props: {
        route: String,
        name: String
    },
    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    }
};
</script>

<style scoped lang="scss">

.nav-button {
  color: var(--color-text);
}

.selected {
  color: var(--color-white);
  background-color: var(--color-secondary-soft);
}


</style>
