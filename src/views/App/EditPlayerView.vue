<template>
    <HeaderContent :title="this.$translator.translate('app.views.edit_player.title')"/>
    <Load v-if="!loaded"/>
    <main v-if="loaded" class="main-content flex-gap-col">
        <InfoBox :text="this.$translator.translate('app.views.edit_player.info')" />
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
                        <CountryDropdown @select="(country) => player.country_id = country.value.id"
                                         :selectCountryId="player.country.id"/>
                    </div>
                </div>
            </div>
            <div class="bottom-buttons">
                <TextIconButton :content="this.$translator.translate('global.actions.edit')"
                                :icon="`edit`" :width="`fit-content`" :height="`2rem`"
                                :flexDirection="`row-reverse`" @click="changePlayer"/>
            </div>
        </form>
    </main>
</template>

<script>

import HeaderContent from "@/components/Header/HeaderContent.vue";
import Load from "@/components/Load/Load.vue";
import InfoBox from "@/components/Info/InfoBox.vue";
import Dropdown from "@/components/Form/Dropdown/Dropdown.vue";
import {mapActions, mapGetters} from "vuex";
import TextIconButton from "@/components/Button/TextIconButton.vue";
import CountryDropdown from "@/components/Form/Dropdown/CountryDropdown.vue";
import FirstNameInput from "@/components/Form/Input/FirstNameInput.vue";
import LastNameInput from "@/components/Form/Input/LastNameInput.vue";

export default {
    name: "EditPlayerView",
    components: {LastNameInput, FirstNameInput, CountryDropdown, TextIconButton, Dropdown, InfoBox, Load, HeaderContent},
    data() {
        return {
            player: undefined,
            originalPlayer: undefined,
            loaded: false
        }
    },
    methods: {
        ...mapActions(['fetchPlayer', 'editPlayer']),
        loadPlayer() {
            this.loaded = false;
            const playerId = this.$route.params.id;
            if (!playerId) return this.$router.push('/players');
            this.fetchPlayer({ id: this.$route.params.id }).then((player) => {
                this.originalPlayer = Object.assign({}, player);
                this.originalPlayer["country_id"] = player["country"]["id"];
                this.player = player;
                this.loaded = true;
            }).catch(() => {
                this.$router.push('/players');
            });
        },
        async changePlayer() {
            const changes = this.getChangedFields(this.originalPlayer, this.player);
            await this.editPlayer({ changes: changes, playerId: this.originalPlayer.id });
        },
        getChangedFields(object1, object2) {
            const changedFields = {};

            for (let key in object1) {
                if (object1.hasOwnProperty(key) && object2.hasOwnProperty(key)) {
                    if (object1[key] !== object2[key]) {
                        changedFields[key] = object2[key];
                    }
                }
            }

            return changedFields;
        }
    },
    async created() {
        // watch the params of the route to fetch the data again
        this.$watch(
            () => this.$route.params,
            () => {
                this.loadPlayer()
            },
            // fetch the data when the view is created and the data is
            // already being observed
            { immediate: true }
        );
    }
}
</script>


<style scoped lang="scss">

</style>