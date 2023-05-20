<template>
    <HeaderContent :title="this.$translator.translate('app.views.players.title')"/>
    <load v-if="!loaded"/>
    <div class="filter">
        <label for="page-size">Show</label>
        <Dropdown :name="`Select page size`" :options="pageSizeOptions()" :select="defaultPageSize()" @select="(newPageSize) => {this.pageSize = newPageSize.value}"/>
    </div>
    <main v-if="loaded" class="main-content flex-gap-col">
        <PlayersTable :items="this.players"/>
        <PageBar :lastPage="this.meta.last_page" :currentPage="this.meta.current_page" @changePage="(newPage) => {this.page = newPage}"/>
    </main>
</template>

<script>
import HeaderContent from "@/components/Header/HeaderContent.vue";
import {mapActions} from "vuex";
import Load from "@/components/Load/Load.vue";
import PageBar from "@/components/Pages/PageBar.vue";
import PlayersTable from "@/components/Table/PlayersTable.vue";
import Dropdown from "@/components/Form/Dropdown.vue";

export default {
    name: "PlayersView",
    components: {
        Dropdown,
        PlayersTable,
        PageBar,
        Load,
        HeaderContent
    },
    methods: {
        ...mapActions(['fetchPlayers']),
        async loadPlayers() {
            this.loaded = false;
            await this.fetchPlayers({page: this.page, sort: this.sort, pageSize: this.pageSize}).then((json) => {
                this.players = json.data;
                this.meta = json.meta;
                this.loaded = true;
            });
        },
        pageSizeOptions() {
            const sizes = [10, 20, 50, 100];
            return sizes.map((size) => {
                return {
                    label: `${size} records`,
                    value: size
                }
            });
        },
        defaultPageSize() {
            return this.pageSizeOptions().find((option) => option.value === this.pageSize);
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
