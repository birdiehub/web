<template>
    <HeaderContent :title="this.$translator.translate('app.views.edit_player.title')"/>
    <Load v-if="!loaded"/>
    <main v-if="loaded" class="main-content flex-gap-col">
        <InfoBox :text="this.$translator.translate('app.views.edit_player.info')" />
        <form action="#" class="box height-100 flex-gap-col">
            <div class="flex-gap-col">
                <div class="flex-gap-row">
                    <div class="width-100">
                        <label for="first_name">{{ this.$translator.translate('app.views.edit_player.fields.first_name.label') }}</label>
                        <input v-model="player.first_name" type="text" id="first_name" name="first_name" autocomplete="off" :placeholder="this.$translator.translate('app.views.edit_player.fields.first_name.placeholder')"/>
                    </div>
                    <div class="width-100">
                        <label for="last_name">{{ this.$translator.translate('app.views.edit_player.fields.last_name.label') }}</label>
                        <input v-model="player.last_name" type="text" id="last_name" name="last_name" autocomplete="off" :placeholder="this.$translator.translate('app.views.edit_player.fields.last_name.placeholder')"/>
                    </div>
                </div>
                <div class="flex-gap-row">
                    <div class="width-100">
                        <label for="country">{{ this.$translator.translate('app.views.edit_player.fields.country.label') }}</label>
                        <Dropdown :options="countryOptions()"
                                  @select="(selected) => this.player.country_id = selected.value.id"
                                  :select="countryOptions().find((option) => option.value.id === player.country.id)"
                                  id="country" name="country" autocomplete="off"
                                  placeholder="this.$translator.translate('app.views.edit_player.fields.country.placeholder')"/>
                    </div>
                </div>
            </div>
            <div class="bottom-buttons">
                <TextIconButton :content="this.$translator.translate('app.views.edit_player.title')"
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
import Dropdown from "@/components/Form/Dropdown.vue";
import {mapActions, mapGetters} from "vuex";
import TextIconButton from "@/components/Button/TextIconButton.vue";

export default {
    name: "EditPlayerView",
    components: {TextIconButton, Dropdown, InfoBox, Load, HeaderContent},
    data() {
        return {
            player: undefined,
            originalPlayer: undefined,
            loaded: false
        }
    },
    computed: {
        ...mapGetters(['countries'])
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
        countryOptions() {
            return this.countries.map((country) => {
                return {
                    label: country.name,
                    value: country
                }
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