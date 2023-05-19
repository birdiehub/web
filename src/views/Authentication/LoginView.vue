<template>
  <form id="login-view" class="flex-gap-col">
      <h1>Use your Birdie account</h1>
      <div class="form-fields">
          <label for="username">Username</label>
          <input v-model="credentials.username" type="text" id="username" name="username" required autocomplete="off" placeholder="Enter username"/>
          <label for="password">Password</label>
          <input v-model="credentials.password" type="password" id="password" name="password" required autocomplete="off" placeholder="Enter password"/>
      </div>
      <div class="bottom-buttons">
          <TextIconButton :content="`Login`" :icon="`login`" :width="`8.5rem`" :height="`2rem`" :flexDirection="`row-reverse`" @click="clickedLogin"/>
          <a href="#/auth/register">Create account.</a>
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
