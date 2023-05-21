<template>
    <Load v-if="!loaded"/>
    <div v-if="loaded">
        <HeaderContent :title="this.player.full_name"/>
    </div>
    <main v-if="loaded" class="main-content">
        <div class="player-basic-info box flex-gap-row">
            <img :src="this.player.headshot ?? 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png'" :alt="this.player.full_name"/>
            <div>
                <div>
                    <p>DOB: {{ this.player?.birthday }}</p>
                </div>
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
            const playerId = this.$route.params.id;
            if (!playerId) return this.$router.push('/players');
            this.fetchPlayer({ id: this.$route.params.id }).then((player) => {
                this.player = player;
                this.loaded = true;
            }).catch(() => {
                this.$router.push('/players');
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

.player-basic-info {
    background-color: var(--color-secondary);
    height: 30vh;

    * {
        color: var(--color-white);
    }

    img {
        flex: 1 1 20%;
        width: 100%;
        height: 100%;
        transform: scale(0.8);
        border-radius: 50%;
        margin: 0 auto;
        display: block;
    }

    > div {
        flex: 1 1 80%;
        display: flex;
    }

}

</style>