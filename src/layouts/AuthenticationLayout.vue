<template>
  <div id="authentication-layout">
      <Notifications :fixed="true"/>
      <div class="flex-center-row auth-wrapper">
          <div class="flex-gap-col">
              <div class="auth-nav flex-gap-row">
                  <NavigationButton route="/auth/login" name="Login"/>
                  <NavigationButton route="/auth/register" name="Register"/>
              </div>
              <div class="auth-action box">
                  <router-view name="Authentication"/>
              </div>
          </div>
      </div>
  </div>
</template>

<script>


import NavigationButton from "@/components/Navigation/NavigationButton.vue";
import Notifications from "@/components/Notification/Notifications.vue";

export default {
    name: "AuthenticationLayout",
    components: {
        Notifications,
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

  .auth-wrapper {
      width: 100%;
      height: 100%;
  }

  .auth-action {
    min-width: 40vw;
    min-height: 60vh;
    overflow: auto;
    padding: 1rem;
  }

</style>