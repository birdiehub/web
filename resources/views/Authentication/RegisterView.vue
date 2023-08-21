<template>
    <form id="register-view" class="flex-gap-col">
        <h1>
            {{ this.$translator.translate('auth.views.register.title') }}
        </h1>
        <div class="form-fields">
            <div class="flex-gap-col field-separator">
                <div class="width-100">
                    <UsernameInput v-model:value="user.username"/>
                </div>
                <div class="">
                    <div class="flex-gap-row">
                        <div class="width-100">
                            <PasswordInput v-model:value="user.password"/>
                        </div>
                        <div class="width-100">
                            <ConfirmPasswordInput v-model:value="confirm_password"/>
                        </div>
                    </div>
                    <p class="field-info">
                        {{ this.$translator.translate('global.fields.password.info') }}
                    </p>
                </div>
            </div>
            <div class="field-separator flex-gap-col">
                <div class="flex-gap-row">
                    <div class="width-100">
                        <FirstNameInput v-model:value="user.first_name"/>
                    </div>
                    <div class="width-100">
                        <LastNameInput v-model:value="user.last_name"/>
                    </div>
                </div>
                <div class="flex-gap-row">
                    <div class="width-100">
                        <EmailInput v-model:value="user.email"/>
                    </div>
                    <div class="width-100">
                        <PhoneInput v-model:value="user.phone"/>
                    </div>
                </div>
            </div>
            <div class="flex-gap-col">
                <div class="width-100">
                    <AddressInput v-model:value="user.address"/>
                </div>
                <div class="flex-gap-row">

                    <div :style="{'width': `60%`}">
                        <CityInput v-model:value="user.city"/>
                    </div>
                    <div :style="{'width': `20%`}">
                        <ZipInput v-model:value="user.zip"/>
                    </div>
                    <div :style="{'width': `20%`}">
                        <CountryDropdown @select="(country) => user.country_id = country.value.id"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-buttons">
            <TextIconButton :content="this.$translator.translate('global.actions.register')"
                            :icon="`create`"
                            :width="`fit-content`"
                            :height="`2rem`"
                            :flexDirection="`row-reverse`"
                            @click="clickedRegister"/>
            <a href="#/auth/login">
                {{ this.$translator.translate('auth.views.register.redirect_to_login') }}
            </a>
        </div>
    </form>
</template>

<script>
import TextIconButton from "@/components/Button/TextIconButton.vue";
import {mapActions, mapGetters} from "vuex";
import Dropdown from "@/components/Form/Dropdown/Dropdown.vue";
import Load from "@/components/Load/Load.vue";
import Input from "@/components/Form/Input/Input.vue";
import UsernameInput from "@/components/Form/Input/UsernameInput.vue";
import PasswordInput from "@/components/Form/Input/PasswordInput.vue";
import ConfirmPasswordInput from "@/components/Form/Input/ConfirmPasswordInput.vue";
import FirstNameInput from "@/components/Form/Input/FirstNameInput.vue";
import LastNameInput from "@/components/Form/Input/LastNameInput.vue";
import EmailInput from "@/components/Form/Input/EmailInput.vue";
import PhoneInput from "@/components/Form/Input/PhoneInput.vue";
import AddressInput from "@/components/Form/Input/AddressInput.vue";
import CityInput from "@/components/Form/Input/CityInput.vue";
import ZipInput from "@/components/Form/Input/ZipInput.vue";
import CountryDropdown from "@/components/Form/Dropdown/CountryDropdown.vue";

export default {
    name: "RegisterView",
    components: {
        CountryDropdown,
        ZipInput,
        CityInput,
        AddressInput,
        PhoneInput,
        EmailInput,
        LastNameInput,
        FirstNameInput,
        ConfirmPasswordInput,
        PasswordInput,
        UsernameInput,
        Input,
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
        }
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
