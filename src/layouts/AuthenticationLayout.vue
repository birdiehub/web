<template>
  <div id="authentication-layout" class="flex-center-col">
      <div class="auth-nav flex-gap-row">
          <NavigationButton route="/auth/login" name="Login"/>
          <NavigationButton route="/auth/register" name="Register"/>
      </div>
      <router-view name="Authentication"/>
  </div>
</template>

<script>


import NavigationButton from "@/components/Navigation/NavigationButton.vue";

export default {
    name: "AuthenticationLayout",
    components: {
        NavigationButton
    }
}

</script>

<style scoped lang="scss">

  #authentication-layout {
    position: fixed;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
    background-color: var(--color-background-mute);
  }

</style>