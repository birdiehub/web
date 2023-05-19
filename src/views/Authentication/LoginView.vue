<template>
  <form id="login-view" class="flex-gap-col">
      <h1>{{ this.$translator.translate('auth.login_title') }}</h1>
      <div class="form-fields">
          <label for="username">{{ this.$translator.translate('auth.fields.username.label') }}</label>
          <input v-model="credentials.username" type="text" id="username" name="username" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.username.placeholder')"/>
          <label for="password">{{ this.$translator.translate('auth.fields.password.label') }}</label>
          <input v-model="credentials.password" type="password" id="password" name="password" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.password.placeholder')"/>
      </div>
      <div class="bottom-buttons">
          <TextIconButton :content="this.$translator.translate('auth.login')" :icon="`login`" :width="`8.5rem`" :height="`2rem`" :flexDirection="`row-reverse`" @click="clickedLogin"/>
          <a href="#/auth/register">{{ this.$translator.translate('auth.redirect_to_register') }}</a>
      </div>
  </form>
</template>

<script>
import TextIconButton from "@/components/Button/TextIconButton.vue";
import {mapActions} from "vuex";

export default {
    name: "LoginView",
    components: {
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
