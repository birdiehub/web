<template>
    <HeaderContent :title="this.$translator.translate('app.views.player.title')"/>
    <Load v-if="!loaded"/>
    <main v-if="loaded" class="main-content">
        <div class="player-info">
            <div class="player-info__image">
                <img :src="this.player?.headshot" alt="Player image">
            </div>
            <div class="player-info__details">
                <h2>{{ this.player.full_name }}</h2>
                <p>{{ this.player?.bio }}</p>
            </div>
        </div>
    </main>
</template>

<script>

import {mapActions} from "vuex";
import Load from "@/components/Load/Load.vue";
import HeaderContent from "@/components/Header/HeaderContent.vue";

export default {
    name: "PlayerView",
    components: {
        HeaderContent,
        Load
    },
    methods: {
        ...mapActions(['fetchPlayer']),
        loadPlayer() {
            this.loaded = false;
            this.fetchPlayer({ id: this.$route.params.id }).then((player) => {
                this.player = player;
                this.loaded = true;
            });
        },
    },
    data() {
        return {
            loaded: false,
            player: {},
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

</style>