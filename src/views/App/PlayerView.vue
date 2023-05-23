<template>
    <Load v-if="!loaded"/>
    <div v-if="loaded">
        <HeaderContent :title="this.player.first_name + ' ' + this.player.last_name"/>
        <div class="flex-gap-row">
            <TextIconButton :content="this.$translator.translate('global.actions.delete')"
                            :icon="`delete`"
                            :width="`fit-content`"
                            :height="`2rem`"
                            :flexDirection="`row-reverse`"
                            class="delete-button"
                            @click="this.removePlayer()"
                            v-if="this.canDeletePlayer"/>
            <TextIconButton :content="this.$translator.translate('global.actions.edit')"
                            :icon="`edit`"
                            :width="`fit-content`"
                            :height="`2rem`"
                            :flexDirection="`row-reverse`"
                            class="edit-button"
                            @click="this.$router.push(`/players/${this.player.id}/edit`)"
                            v-if="this.canEditPlayer"/>
        </div>
    </div>
    <main v-if="loaded" class="main-content flex-gap-col">
        <div class="player-basic-info box flex-gap-row">
            <img v-if="this.player.headshot" class="headshot" :src="this.player.headshot" :alt="this.player.full_name"/>
            <div class="basic-info-text-wrapper width-100 flex-space-between-col">
                <div class="basic-info-text-top flex-space-between-row width-100">
                    <div v-if="this.player.country" class="country flex-gap-row flex-center-row">
                        <img :src="this.player.country?.flag" :alt="this.player.country?.name"/>
                        <p>{{ this.player.country.name }}</p>
                    </div>
                    <div class="socials flex-gap-row">
                        <a class="no-text-decoration" v-for="social in this.player.socials" :href="social.url">
                            <img :src="socialIconPath(social.channel)" :alt="social.channel"/>
                        </a>
                    </div>
                </div>
                <div class="basic-info-text-bottom flex-space-between-row">
                    <div>
                        <h3 class="important">{{ this.$translator.translate('global.entities.player.attributes.age') }}</h3>
                        <p>{{ this.birthDate() ? age() + ' (' +  birthDateText() + ')' : 'N/A'}}</p>
                    </div>
                    <div>
                        <h3 class="important">{{ this.$translator.translate('global.entities.player.attributes.height') }}</h3>
                        <p>{{ this.player?.height_imperial ?? 'N/A' }} • {{ this.player?.height_meters ? this.player?.height_meters + 'm' : 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="important">{{ this.$translator.translate('global.entities.player.attributes.weight') }}</h3>
                        <p>{{ this.player?.weight_imperial ? this.player?.weight_imperial + 'lbs' : 'N/A' }} • {{ this.player?.weight_kilograms ? this.player?.weight_kilograms + 'kg' : 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="important">{{ this.$translator.translate('global.entities.player.attributes.turned_pro') }}</h3>
                        <p>{{ this.player?.turned_pro ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="important">{{ this.$translator.translate('global.entities.player.attributes.college') }}</h3>
                        <p>{{ this.player.college ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="player-details-wrapper">
            <TabBar :tabs="tabs" @changeTab="(tab) => this.currentTab = tab"/>
            <div v-if="currentTab.name === this.$translator.translate('global.miscellaneous.statistics')" class="player-stats flex-gap-col">
                <div class="box career-earnings">
                    <h3>{{ this.$translator.translate('global.entities.player.attributes.earnings') }} </h3>
                    <p>{{ this.player?.career_earnings ?? 'N/A' }}</p>
                </div>
                <LeaderboardTable :leaderboard="this.player?.leaderboard"/>
            </div>
            <div v-if="currentTab.name === this.$translator.translate('global.miscellaneous.highlights')" class="player-highlights">
                <SnapshotsTable :snapshots="this.player?.snapshots"/>
            </div>
            <div v-if="currentTab.name === this.$translator.translate('global.miscellaneous.about')" class="player-about flex-gap-col">
                <div class="player-bio box">
                    <h3>{{ this.$translator.translate('global.entities.player.attributes.bio') }}</h3>
                    <p>{{ this.player?.bio ?? 'N/A' }}</p>
                </div>
                <div class="player-family box">
                    <h3>{{ this.$translator.translate('global.entities.player.attributes.family') }}</h3>
                    <p>{{ this.player?.family ?? 'N/A' }}</p>
                </div>
                <div class="player-education box">
                    <h3>{{ this.$translator.translate('global.entities.player.attributes.degree') }}</h3>
                    <p>{{ this.player?.degree ?? 'N/A' }} at {{ this.player?.college ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </main>
</template>

<script>

import {mapActions} from "vuex";
import Load from "@/components/Load/Load.vue";
import HeaderContent from "@/components/Header/HeaderContent.vue";
import TabBar from "@/components/Tab/TabBar.vue";
import TextIconButton from "@/components/Button/TextIconButton.vue";
import LeaderboardTable from "@/components/Table/LeaderboardTable.vue";
import SnapshotsTable from "@/components/Table/SnapshotsTable.vue";

export default {
    name: "PlayerView",
    components: {
        SnapshotsTable,
        LeaderboardTable,
        TextIconButton,
        TabBar,
        HeaderContent,
        Load
    },
    methods: {
        ...mapActions(['fetchPlayer', 'meHasPermissions', 'deletePlayer']),
        loadPlayer() {
            this.loaded = false;
            const playerId = this.$route.params.id;
            if (!playerId) return this.$router.push('/players');
            this.fetchPlayer({ id: this.$route.params.id }).then((player) => {
                this.player = player;
                this.loaded = true;
            }).catch(() => {
                this.$router.push('/players');
            });
        },
        birthDate() {
            if(!this.player?.birth_date) return null;
            return new Date(this.player?.birth_date);
        },
        age() {
            const today = new Date();
            if(!this.birthDate()) return null;
            return parseInt(today.getFullYear() - this.birthDate().getFullYear());
        },
        birthDateText(){
            if(!this.birthDate()) return null;
            return this.birthDate().toLocaleDateString(
                this.$translator.language(),
                {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
        },
        socialIconPath(filename) {
            return require('@/assets/media/socials/' + filename + '.png');
        },
        removePlayer() {
            this.deletePlayer(this.player.id);
        },
        hasPermissions(permissions) {
            this.meHasPermissions(permissions).then((hasPermissions) => {
                this.canDeletePlayer = hasPermissions;
                this.canEditPlayer = hasPermissions;
            });
        }
    },
    data() {
        return {
            loaded: false,
            player: {},
            tabs: [
                { name: this.$translator.translate('global.miscellaneous.statistics'), index: 0 },
                { name: this.$translator.translate('global.miscellaneous.highlights'), index: 1 },
                { name:this.$translator.translate('global.miscellaneous.about'), index: 2 },
            ],
            currentTab: { name: this.$translator.translate('global.miscellaneous.statistics'), index: 0 },
            canDeletePlayer: false,
            canEditPlayer: false
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
        await this.hasPermissions(['edit-players', 'delete-players']);
    }
}

</script>


<style scoped lang="scss">

.delete-button {
    background-color: var(--color-red);
    margin-bottom: 1rem;
}

.edit-button {
    background-color: var(--color-purple);
    margin-bottom: 1rem;
}

.player-basic-info {
    padding: 0;

    .headshot {
        width: auto;
        border-bottom-left-radius: 10px;
        border-top-left-radius: 10px;
        object-fit: contain;
        box-sizing: border-box;
    }

    .basic-info-text-wrapper {
        padding: 2rem;
    }

    .country {
        img {
            width: 4rem;
            height: 4rem;
        }

        p {
            font-size: 2rem;
        }
    }

    .socials {
        img {
            width: 3rem;
            height: 3rem;
        }
    }

    .basic-info-text-bottom {
        p {
            font-size: 1rem;
        }
        h3 {
            text-transform: uppercase;
        }
    }
}

.player-stats {

    gap: 2rem;

}

.career-earnings {
    align-items: center;
    h3 {
        font-size: 1.5rem;
    }
    p {
        font-size: 1.5rem;
    }
}

</style>