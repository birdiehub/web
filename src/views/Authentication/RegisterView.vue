<template>
    <Load v-if="!loaded"/>
    <form v-if="loaded" id="register-view" class="flex-gap-col">
        <h1>Create your Birdie account</h1>
        <div class="form-fields">
            <div class="flex-gap-col field-separator">
                <div class="width-100">
                    <label for="username">Username</label>
                    <input v-model="user.username" type="text" id="username" name="username" required autocomplete="off" placeholder="Enter username"/>
                </div>
                <div class="">
                    <div class="flex-gap-row">
                        <div class="width-100">
                            <label for="password">Password</label>
                            <input v-model="user.password" type="password" id="password" name="password" required autocomplete="off"  min="8" max="255" placeholder="Enter password"/>
                        </div>
                        <div class="width-100">
                            <label for="confirm-password">Confirm</label>
                            <input v-model="confirm_password" type="password" id="confirm-password" name="password" required autocomplete="off"  min="8" max="255" placeholder="Enter password"/>
                        </div>
                    </div>
                    <p class="field-info">Use 8 or more characters with a mix of letters, numbers & symbols</p>
                </div>
            </div>
            <div class="field-separator flex-gap-col">
                <div class="flex-gap-row">
                    <div class="width-100">
                        <label for="first_name">First name</label>
                        <input v-model="user.first_name" type="text" id="first_name" name="first_name" required autocomplete="off" placeholder="Enter first name"/>
                    </div>
                    <div class="width-100">
                        <label for="last_name">Last name</label>
                        <input v-model="user.last_name" type="text" id="last_name" name="last_name" required autocomplete="off" placeholder="Enter last name"/>
                    </div>
                </div>
                <div class="flex-gap-row">
                    <div class="width-100">
                        <label for="email">Email</label>
                        <input v-model="user.email" type="email" id="email" name="email" required autocomplete="off" placeholder="Enter email"/>
                    </div>
                    <div class="width-100">
                        <label for="phone">Phone</label>
                        <input v-model="user.phone" type="text" id="phone" name="phone" required autocomplete="off" placeholder="Enter phone"/>
                    </div>
                </div>
            </div>
            <div class="flex-gap-col">
                <div class="width-100">
                    <label for="address">Address</label>
                    <input v-model="user.address" type="text" id="address" name="address" required autocomplete="off" placeholder="Enter address"/>
                </div>
                <div class="flex-gap-row">

                    <div :style="{'width': `60%`}">
                        <label for="city">City</label>
                        <input v-model="user.city" type="text" id="city" name="city" required autocomplete="off" placeholder="Enter city"/>
                    </div>
                    <div :style="{'width': `20%`}">
                        <label for="zip">ZIP</label>
                        <input v-model="user.zip" type="text" id="zip" name="zip" required autocomplete="off" placeholder="Enter ZIP"/>
                    </div>
                    <div :style="{'width': `20%`}">
                        <label for="country">Country</label>
                        <Dropdown :options="countryOptions()"
                                  @selected="(selected) => this.user.country_id = selected.value.id"
                                  id="country" name="country" required autocomplete="off" placeholder="Select country"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-buttons">
            <TextIconButton :content="`Register`" :icon="`create`" :width="`8.5rem`" :height="`2rem`" :flexDirection="`row-reverse`" @click="clickedRegister"/>
            <a href="#/auth/login">Already have an account? Login.</a>
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
    async mounted() {
        this.fetchCountries().then(() => {
            this.loaded = true;
        });
    },
    methods: {
        ...mapActions(['register', 'fetchCountries', 'createNotification']),
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
            confirm_password: undefined,
            loaded: false
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
