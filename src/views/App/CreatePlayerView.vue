<template>
    <HeaderContent :title="this.$translator.translate('app.views.create_player.title')"/>
    <main class="main-content flex-gap-col">
        <InfoBox :text="this.$translator.translate('app.views.create_player.info')" />
        <form action="#" class="box height-100 flex-gap-col">
            <div class="flex-gap-col">
                <div class="flex-gap-row">
                    <div class="width-100">
                        <label for="first_name">{{ this.$translator.translate('app.views.create_player.fields.first_name.label') }}</label>
                        <input v-model="player.first_name" type="text" id="first_name" name="first_name" required autocomplete="off" :placeholder="this.$translator.translate('app.views.create_player.fields.first_name.placeholder')"/>
                    </div>
                    <div class="width-100">
                        <label for="last_name">{{ this.$translator.translate('app.views.create_player.fields.last_name.label') }}</label>
                        <input v-model="player.last_name" type="text" id="last_name" name="last_name" required autocomplete="off" :placeholder="this.$translator.translate('app.views.create_player.fields.last_name.placeholder')"/>
                    </div>
                </div>
                <div class="flex-gap-row">
                    <div class="width-100">
                        <label for="gender">{{ this.$translator.translate('app.views.create_player.fields.gender.label') }}</label>
                        <Dropdown :options="genderOptions()"
                                  @select="(selected) => this.player.gender = selected.value"
                                  id="gender" name="gender" required autocomplete="off"
                                  :placeholder="this.$translator.translate('app.views.create_player.fields.gender.placeholder')"/>
                    </div>
                    <div class="width-100">
                        <label for="country">{{ this.$translator.translate('app.views.create_player.fields.country.label') }}</label>
                        <Dropdown :options="countryOptions()"
                                  @select="(selected) => this.player.country_id = selected.value.id"
                                  id="country" name="country" required autocomplete="off"
                                  placeholder="this.$translator.translate('app.views.create_player.fields.country.placeholder')"/>
                    </div>
                </div>
            </div>
            <div class="bottom-buttons">
                <TextIconButton :content="this.$translator.translate('app.views.create_player.title')" :icon="`create`" :width="`8.5rem`" :height="`2rem`" :flexDirection="`row-reverse`" @click="createPlayer"/>
            </div>
        </form>
    </main>
</template>

<script>

import HeaderContent from "@/components/Header/HeaderContent.vue";
import Load from "@/components/Load/Load.vue";
import InfoBox from "@/components/Info/InfoBox.vue";
import Dropdown from "@/components/Form/Dropdown.vue";
import {mapGetters} from "vuex";
import TextIconButton from "@/components/Button/TextIconButton.vue";

export default {
    name: "CreatePlayerView",
    components: {TextIconButton, Dropdown, InfoBox, Load, HeaderContent},
    data() {
        return {
            player: {
                first_name: undefined,
                last_name: undefined,
                gender: undefined,
                country_id: undefined
            }
        }
    },
    computed: {
        ...mapGetters(['countries'])
    },
    methods: {
        countryOptions() {
            return this.countries.map((country) => {
                return {
                    label: country.name,
                    value: country
                }
            });
        },
        genderOptions() {
          const genders = {
              "male": { "en": "M", "de": "M", "fr": "H", "it": "U", "es": "H", "nl": "M" },
              "female": { "en": "F", "de": "W", "fr": "F", "it": "D", "es": "M", "nl": "V" }
          }
          return [
              {
                  label: genders["male"][this.$translator.language()],
                  value: genders["male"]
              },
              {
                  label: genders["female"][this.$translator.language()],
                  value: genders["female"]
              }
          ]
        },
        async createPlayer() {
            await this.$store.dispatch('createPlayer', this.player);
        }
    }
}
</script>


<style scoped lang="scss">

</style>