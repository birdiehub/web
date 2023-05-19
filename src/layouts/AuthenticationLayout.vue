<template>
  <div id="authentication-layout">
      <Notifications :fixed="true"/>
      <header class="header-wrapper">
          <TransparentLogo :titleTxt="`Header bar Logo`" :width="`10%`"/>
          <div class="flex-gap-row">
             <SelectLanguage/>
              <div class="auth-nav flex-gap-row">
                  <NavigationButton route="/auth/login" name="Login"/>
                  <NavigationButton route="/auth/register" name="Register"/>
              </div>
          </div>
      </header>
      <div class="flex-center-row auth-wrapper">
          <div class="auth-action box">
              <router-view name="Authentication"/>
          </div>
      </div>
  </div>
</template>

<script>


import NavigationButton from "@/components/Navigation/NavigationButton.vue";
import Notifications from "@/components/Notification/Notifications.vue";
import TransparentLogo from "@/components/Logo/TransparentLogo.vue";
import SelectLanguage from "@/components/Language/SelectLanguage.vue";

export default {
    name: "AuthenticationLayout",
    components: {
        SelectLanguage,
        TransparentLogo,
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
      height: calc(100vh - 4rem);
  }

  .auth-action {
    width: 50%;
    height: calc(80% - 2rem); // 2rem padding..
    overflow: auto;
    padding: 1rem;
  }

  .header-wrapper {
      height: 4rem;
      display: flex;
      flex: auto;
      align-items: center;
      justify-content: space-between;
      border-bottom: var(--border);
      box-shadow: var(--box-shadow);
      padding: 0 1rem;
      background-color: var(--color-background);
  }

</style>