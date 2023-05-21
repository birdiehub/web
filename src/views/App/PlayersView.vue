<template>
    <HeaderContent :title="this.$translator.translate('app.views.players.title')"/>
    <load v-if="!loaded"/>
    <div class="filter-sort flex-gap-row">
        <div>
            <label for="page-size">{{ this.$translator.translate('app.views.players.filter.show') }}</label>
            <Dropdown id="page-size" :name="`Select page size`" :options="pageSizeOptions()" :select="defaultPageSize()" @select="(newPageSize) => {this.pageSize = newPageSize.value}"/>
        </div>
        <div>
            <label for="sort-direction">{{ this.$translator.translate('app.views.players.filter.sort') }}</label>
            <Dropdown id="sort-direction" :name="`Select sort`" :options="sortOptions()" :select="defaultSort()" @select="(newSort) => {this.sort = newSort.value}"/>
        </div>
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
                if (this.meta.current_page > this.meta.last_page)
                    this.page = this.meta.last_page;
                this.loaded = true;
            });
        },
        pageSizeOptions() {
            const sizes = [10, 20, 50, 100];
            return sizes.map((size) => {
                return {
                    label: `${size} ${this.$translator.translate('app.views.players.filter.show_records')}`,
                    value: size
                }
            });
        },
        defaultPageSize() {
            return this.pageSizeOptions().find((option) => option.value === this.pageSize);
        },
        sortOptions(){
            return [
                {
                    label: this.$translator.translate('app.views.players.filter.sort_options.rank_f_to_l'),
                    value: "rank,asc"
                },
                {
                    label: this.$translator.translate('app.views.players.filter.sort_options.rank_l_to_f'),
                    value: "rank,desc"
                },
                {
                    label: this.$translator.translate('app.views.players.filter.sort_options.first_name_a_to_z'),
                    value: "first_name,asc"
                },
                {
                    label: this.$translator.translate('app.views.players.filter.sort_options.first_name_z_to_a'),
                    value: "first_name,desc"
                },
                {
                    label: this.$translator.translate('app.views.players.filter.sort_options.last_name_a_to_z'),
                    value: "last_name,asc"
                },
                {
                    label: this.$translator.translate('app.views.players.filter.sort_options.last_name_z_to_a'),
                    value: "last_name,desc"
                }
            ]
        },
        defaultSort() {
            return this.sortOptions().find((option) => option.value === this.sort);
        }
    },
    async created() {
        this.page = this.$route.query.page || 1;
        this.$router.push({query: {page: this.page}});
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
                this.$router.push({query: {page: this.page}});
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

.filter-sort {
    margin-bottom: 1rem;
    flex-direction: row-reverse;
    gap: 2rem;

    > div {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 0.5rem;

        label {
            margin: 0;
        }

    }

}

</style>
