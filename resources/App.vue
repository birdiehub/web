<template>
  <LoadApp v-if="!loaded"/>
  <router-view v-if="loaded" name="Layout"/>
</template>

<script>

import {mapActions} from "vuex";
import LoadApp from "@/components/Load/LoadApp.vue";

export default {
  name: "App",
    components: {LoadApp},
  methods: {
    ...mapActions(["fetchCountries"])
  },
  async mounted() {

    await Promise.all([
        this.fetchCountries()
    ]).then(() => {
        this.loaded = true;
    });

  },
  data() {
    return {
      loaded: false
    };
  }
};

</script>

<style lang="scss">
@use "@/assets/scss/main.scss";
</style>
