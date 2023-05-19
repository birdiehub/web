<template>
    <HeaderContent :title="this.$translator.translate('app.views.players.title')"/>
    <load v-if="!loaded"/>
    <main v-if="loaded" class="main-content">
        <PageBar :lastPage="this.meta.last_page" :currentPage="this.meta.current_page" @changePage="(newPage) => {this.page = newPage}"/>
    </main>
</template>

<script>
import HeaderContent from "@/components/Header/HeaderContent.vue";
import {mapActions} from "vuex";
import Load from "@/components/Load/Load.vue";
import PageBar from "@/components/Pages/PageBar.vue";

export default {
    name: "PlayersView",
    components: {
        PageBar,
        Load,
        HeaderContent
    },
    methods: {
        ...mapActions(['fetchPlayers']),
        async loadPlayers() {
            this.loaded = false;
            await this.fetchPlayers(this.page, this.sort, this.pageSize).then((json) => {
                this.players = json.data;
                this.meta = json.meta;
                this.loaded = true;
            });
        }
    },
    async created() {
        await this.loadPlayers();
    },
    data() {
        return {
            players: [],
            meta: undefined,
            loaded: false,
            page: 1,
            sort: "rank,asc",
            pageSize: 20
        }
    },
    watch: {
        page: {
            handler: async function (value) {
                await this.loadPlayers();
            }
        },
        sort: {
            handler: async function (value) {
                await this.loadPlayers();
            }
        },
        pageSize: {
            handler: async function (value) {
                await this.loadPlayers();
            }
        }
    }
};
</script>

<style scoped lang="scss">

</style>
