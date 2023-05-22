<template>
    <form id="register-view" class="flex-gap-col">
        <h1>{{ this.$translator.translate('auth.register_title') }}</h1>
        <div class="form-fields">
            <div class="flex-gap-col field-separator">
                <div class="width-100">
                    <label for="username">{{ this.$translator.translate('auth.fields.username.label') }}</label>
                    <input v-model="user.username" type="text" id="username" name="username" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.username.placeholder')"/>
                </div>
                <div class="">
                    <div class="flex-gap-row">
                        <div class="width-100">
                            <label for="password">{{ this.$translator.translate('auth.fields.password.label') }}</label>
                            <input v-model="user.password" type="password" id="password" name="password" required autocomplete="off"  min="8" max="255" :placeholder="this.$translator.translate('auth.fields.password.placeholder')"/>
                        </div>
                        <div class="width-100">
                            <label for="confirm-password">{{ this.$translator.translate('auth.fields.confirm_password.label') }}</label>
                            <input v-model="confirm_password" type="password" id="confirm-password" name="password" required autocomplete="off"  min="8" max="255" :placeholder="this.$translator.translate('auth.fields.confirm_password.placeholder')"/>
                        </div>
                    </div>
                    <p class="field-info">{{ this.$translator.translate('auth.fields.password.info') }}</p>
                </div>
            </div>
            <div class="field-separator flex-gap-col">
                <div class="flex-gap-row">
                    <div class="width-100">
                        <label for="first_name">{{ this.$translator.translate('auth.fields.first_name.label') }}</label>
                        <input v-model="user.first_name" type="text" id="first_name" name="first_name" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.first_name.placeholder')"/>
                    </div>
                    <div class="width-100">
                        <label for="last_name">{{ this.$translator.translate('auth.fields.last_name.label') }}</label>
                        <input v-model="user.last_name" type="text" id="last_name" name="last_name" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.last_name.placeholder')"/>
                    </div>
                </div>
                <div class="flex-gap-row">
                    <div class="width-100">
                        <label for="email">{{ this.$translator.translate('auth.fields.email.label') }}</label>
                        <input v-model="user.email" type="email" id="email" name="email" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.email.placeholder')"/>
                    </div>
                    <div class="width-100">
                        <label for="phone">{{ this.$translator.translate('auth.fields.phone.label') }}</label>
                        <input v-model="user.phone" type="text" id="phone" name="phone" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.phone.placeholder')"/>
                    </div>
                </div>
            </div>
            <div class="flex-gap-col">
                <div class="width-100">
                    <label for="address">{{ this.$translator.translate('auth.fields.address.label') }}</label>
                    <input v-model="user.address" type="text" id="address" name="address" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.address.placeholder')"/>
                </div>
                <div class="flex-gap-row">

                    <div :style="{'width': `60%`}">
                        <label for="city">{{ this.$translator.translate('auth.fields.city.label') }}</label>
                        <input v-model="user.city" type="text" id="city" name="city" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.city.placeholder')"/>
                    </div>
                    <div :style="{'width': `20%`}">
                        <label for="zip">{{ this.$translator.translate('auth.fields.zip.label') }}</label>
                        <input v-model="user.zip" type="text" id="zip" name="zip" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.zip.placeholder')"/>
                    </div>
                    <div :style="{'width': `20%`}">
                        <label for="country">{{ this.$translator.translate('auth.fields.country.label') }}</label>
                        <Dropdown :options="countryOptions()"
                                  @select="(selected) => this.user.country_id = selected.value.id"
                                  id="country" name="country" required autocomplete="off" :placeholder="this.$translator.translate('auth.fields.country.placeholder')"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-buttons">
            <TextIconButton :content="this.$translator.translate('auth.register')"
                            :icon="`create`" :width="`fit-content`" :height="`2rem`"
                            :flexDirection="`row-reverse`" @click="clickedRegister"/>
            <a href="#/auth/login">{{ this.$translator.translate('auth.redirect_to_login') }}</a>
        </div>
    </form>
</template>

<script>
import TextIconButton from "@/components/Button/TextIconButton.vue";
import {mapActions, mapGetters} from "vuex";
import Dropdown from "@/components/Form/Dropdown.vue";
import Load from "@/components/Load/Load.vue";

export default {
    name: "RegisterView",
    components: {
        Load,
        Dropdown,
        TextIconButton
    },
    methods: {
        ...mapActions(['register', 'createNotification']),
        clickedRegister() {
            if (this.user.password !== this.confirm_password) {
                this.createNotification({
                    type: 'error',
                    content: 'Passwords do not match'
                });
                return;
            }
            this.register(this.user);
        },
        countryOptions() {
            return this.countries.map(country => {
                return {
                    value: country,
                    label: country.name
                }
            });
        }
    },
    computed: {
        ...mapGetters(['countries'])
    },
    data() {
        return {
            user: {
                username: undefined,
                password: undefined,
                first_name: undefined,
                last_name: undefined,
                email: undefined,
                phone: undefined,
                address: undefined,
                city: undefined,
                zip: undefined,
                country_id: undefined
            },
            confirm_password: undefined
        };
    }
}
</script>

<style scoped lang="scss">

#register-view {
    height: 100%;
}

.field-separator {
    padding-bottom: 1rem;
    margin-bottom: 1rem;
    border-bottom: var(--border);
}

.field-info {
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

</style>
