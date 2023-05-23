<template>
    <HeaderContent :title="this.$translator.translate('app.views.create_player.title')"/>
    <main class="main-content flex-gap-col">
        <InfoBox :text="this.$translator.translate('app.views.create_player.info')" />
        <form action="#" class="box height-100 flex-gap-col">
            <div class="flex-gap-col">
                <div class="flex-gap-row">
                    <div class="width-100">
                        <FirstNameInput v-model:value="player.first_name" required/>
                    </div>
                    <div class="width-100">
                        <LastNameInput v-model:value="player.last_name" required/>
                    </div>
                </div>
                <div class="flex-gap-row">
                    <div class="width-100">
                        <GenderDropdown @select="(selected) => this.player.gender = selected.value"/>
                    </div>
                    <div class="width-100">
                        <CountryDropdown @select="(country) => player.country_id = country.value.id"
                                        :selectCountryId="player.country_id"/>
                    </div>
                </div>
            </div>
            <div class="bottom-buttons">
                <TextIconButton :content="this.$translator.translate('global.actions.create')"
                                :icon="`create`" :width="`fit-content`" :height="`2rem`"
                                :flexDirection="`row-reverse`" @click="createPlayer"/>
            </div>
        </form>
    </main>
</template>

<script>

import HeaderContent from "@/components/Header/HeaderContent.vue";
import Load from "@/components/Load/Load.vue";
import InfoBox from "@/components/Info/InfoBox.vue";
import Dropdown from "@/components/Form/Dropdown/Dropdown.vue";
import {mapGetters} from "vuex";
import TextIconButton from "@/components/Button/TextIconButton.vue";
import FirstNameInput from "@/components/Form/Input/FirstNameInput.vue";
import LastNameInput from "@/components/Form/Input/LastNameInput.vue";
import CountryDropdown from "@/components/Form/Dropdown/CountryDropdown.vue";
import GenderDropdown from "@/components/Form/Dropdown/GenderDropdown.vue";

export default {
    name: "CreatePlayerView",
    components: {
        GenderDropdown,
        CountryDropdown, LastNameInput, FirstNameInput, TextIconButton, Dropdown, InfoBox, Load, HeaderContent},
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
    },
    methods: {
        async createPlayer() {
            await this.$store.dispatch('createPlayer', this.player);
        }
    }
}
</script>


<style scoped lang="scss">

</style>