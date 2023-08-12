<template>
  <form id="login-view" class="flex-gap-col">
      <h1>
          {{ this.$translator.translate('auth.views.login.title') }}
      </h1>
      <div class="form-fields">
          <UsernameInput v-model:value="credentials.username" />
          <PasswordInput v-model:value="credentials.password" />
      </div>
      <div class="bottom-buttons">
          <TextIconButton :content="this.$translator.translate('global.actions.login')"
                          :icon="`login`"
                          :width="`fit-content`"
                          :height="`2rem`"
                          :flexDirection="`row-reverse`"
                          @click="clickedLogin"/>
          <a href="#/auth/register">
              {{ this.$translator.translate('auth.views.login.redirect_to_register') }}
          </a>
      </div>
  </form>
</template>

<script>
import TextIconButton from "@/components/Button/TextIconButton.vue";
import {mapActions} from "vuex";
import UsernameInput from "@/components/Form/Input/UsernameInput.vue";
import PasswordInput from "@/components/Form/Input/PasswordInput.vue";

export default {
    name: "LoginView",
    components: {
        PasswordInput,
        UsernameInput,
        TextIconButton
    },
    methods: {
        ...mapActions(['login']),
        clickedLogin() {
            this.login(this.credentials);
        }
    },
    data() {
        return {
            credentials: {
                username: undefined,
                password: undefined
            }
        };
    }
}
</script>

<style scoped lang="scss">

#login-view {
    height: 100%;
}

.form-fields label:not(:first-child) {
    margin-top: 1rem;
}

</style>
