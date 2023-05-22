<template>
    <Load v-if="!loaded"/>
    <div v-if="loaded">
        <HeaderContent :title="this.player.full_name"/>
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
                        <h3 class="important">{{ this.$translator.translate('app.views.player.age') }}</h3>
                        <p>{{ age() }} ({{ birthDateText() }})</p>
                    </div>
                    <div>
                        <h3 class="important">{{ this.$translator.translate('app.views.player.height') }}</h3>
                        <p>{{ this.player?.height_imperial ?? 'N/A' }} • {{ this.player?.height_meters ? this.player?.height_meters + 'm' : 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="important">{{ this.$translator.translate('app.views.player.weight') }}</h3>
                        <p>{{ this.player?.weight_imperial ? this.player?.weight_imperial + 'lbs' : 'N/A' }} • {{ this.player?.weight_kilograms ? this.player?.weight_kilograms + 'kg' : 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="important">{{ this.$translator.translate('app.views.player.turned_pro') }}</h3>
                        <p>{{ this.player?.turned_pro ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="important">{{ this.$translator.translate('app.views.player.college') }}</h3>
                        <p>{{ this.player.college ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="player-details-wrapper">
            <TabBar :tabs="tabs" @changeTab="(tab) => this.currentTab = tab"/>
            <div v-if="currentTab.name === this.$translator.translate('app.views.player.stats')" class="player-stats flex-gap-col">
                <div class="box career-earnings">
                    <h3>{{ this.$translator.translate('app.views.player.earnings') }} </h3>
                    <p>{{ this.player?.career_earnings ?? 'N/A' }}</p>
                </div>
                <div class="stats-table box">
                    <header class="stats-table-header">
                        <h2>{{ this.$translator.translate('app.views.player.leaderboard') }}</h2>
                    </header>
                    <main class="stats-table-body">
                        <div class="stats-table-row flex-space-between-row">
                            <div class="stats-table-cell">
                                <h3>{{ this.$translator.translate('app.views.player.current_rank') }}</h3>
                                <p>{{ this.player?.leaderboard.rank }}</p>
                            </div>
                            <div class="stats-table-cell">
                                <h3>{{ this.$translator.translate('app.views.player.last_week_rank') }}</h3>
                                <p>{{ this.player?.leaderboard.last_week_rank }}</p>
                            </div>
                            <div class="stats-table-cell">
                                <h3>{{ this.$translator.translate('app.views.player.last_year_rank') }}</h3>
                                <p>{{ this.player?.leaderboard.end_last_year_rank }}</p>
                            </div>
                        </div>
                        <div class="stats-table-row flex-space-between-row">
                            <div class="stats-table-cell">
                                <h3>{{ this.$translator.translate('app.views.player.points_total') }}</h3>
                                <p>{{ this.player?.leaderboard.points_total }}</p>
                            </div>
                            <div class="stats-table-cell">
                                <h3>{{ this.$translator.translate('app.views.player.points_won') }}</h3>
                                <p class="points-won">{{ this.player?.leaderboard.points_won }}</p>
                            </div>
                            <div class="stats-table-cell">
                                <h3>{{ this.$translator.translate('app.views.player.points_lost') }}</h3>
                                <p class="points-lost">{{ this.player?.leaderboard.points_lost }}</p>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div v-if="currentTab.name === this.$translator.translate('app.views.player.highlights')" class="player-highlights">
                <div class="stats-table box">
                    <header class="stats-table-header">
                        <h2>{{ this.$translator.translate('app.views.player.snapshots') }}</h2>
                    </header>
                    <main class="stats-table-body">
                        <div class="stats-table-row flex-space-between-row" v-for="snapshot in this.player?.snapshots">
                            <div class="stats-table-cell">
                                <h3>{{ this.$translator.translate('app.views.player.snapshots_table.title') }}</h3>
                                <p>{{ snapshot.title }}</p>
                            </div>
                            <div class="stats-table-cell">
                                <h3>{{ this.$translator.translate('app.views.player.snapshots_table.value') }}</h3>
                                <p>{{ snapshot.value ?? 'N/A' }}</p>
                            </div>
                            <div class="stats-table-cell">
                                <h3>{{ this.$translator.translate('app.views.player.snapshots_table.description') }}</h3>
                                <p>{{ snapshot.description ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div v-if="currentTab.name === this.$translator.translate('app.views.player.about')" class="player-about flex-gap-col">
                <div class="player-bio box">
                    <h3>{{ this.$translator.translate('app.views.player.bio') }}</h3>
                    <p>{{ this.player?.bio ?? 'N/A' }}</p>
                </div>
                <div class="player-family box">
                    <h3>{{ this.$translator.translate('app.views.player.family') }}</h3>
                    <p>{{ this.player?.family ?? 'N/A' }}</p>
                </div>
                <div class="player-education box">
                    <h3>{{ this.$translator.translate('app.views.player.education') }}</h3>
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

export default {
    name: "PlayerView",
    components: {
        TabBar,
        HeaderContent,
        Load
    },
    methods: {
        ...mapActions(['fetchPlayer']),
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
            return new Date(this.player?.birth_date);
        },
        age() {
            const today = new Date();
            return parseInt(today.getFullYear() - this.birthDate().getFullYear());
        },
        birthDateText(){
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
        }
    },
    data() {
        return {
            loaded: false,
            player: {},
            tabs: [
                { name: this.$translator.translate('app.views.player.stats'), index: 0 },
                { name: this.$translator.translate('app.views.player.highlights'), index: 1 },
                { name:this.$translator.translate('app.views.player.about'), index: 2 },
            ],
            currentTab: { name: this.$translator.translate('app.views.player.stats'), index: 0 }
        }
    },
    created() {
        // watch the params of the route to fetch the data again
        this.$watch(
            () => this.$route.params,
            () => {
                this.loadPlayer()
            },
            // fetch the data when the view is created and the data is
            // already being observed
            { immediate: true }
        )
    }
}

</script>


<style scoped lang="scss">

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

.stats-table {

    .stats-table-header {
        border-bottom: solid 0.2rem var(--color-secondary);
        h2 {
            font-size: 1.5rem;
        }
    }

    .stats-table-row:not(:last-child) {
        border-bottom: var(--border);
    }

    .stats-table-cell {
        flex: 1 1 33%;

        h3 {
            margin: 0.5rem 0;
            text-transform: uppercase;
            font-size: 1.15rem;
            color: var(--color-text);
        }

        p {
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: var(--color-secondary);
            font-weight: bold;
        }

        .points-won {
            color: var(--color-green);
        }

        .points-lost {
            color: var(--color-red);
        }

    }

}

</style>