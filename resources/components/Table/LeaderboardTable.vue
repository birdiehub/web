<template>
  <GridTable :title="this.$translator.translate('global.entities.leaderboard.name')" :items="items"/>
</template>

<script>
import {defineComponent} from 'vue'
import GridTable from "@/components/Table/GridTable.vue";

export default defineComponent({
    name: "LeaderboardTable",
    components: {GridTable},
    props: {
        leaderboard: {
            type: Object,
            required: true,
            default: {
                rank: 'N/A',
                last_week_rank: 'N/A',
                end_last_year_rank: 'N/A',
                points_total: 'N/A',
                points_won: 'N/A',
                points_lost: 'N/A',
            }
        }
    },
    data() {
        return {
            items: [
                [
                    {
                        label: this.$translator.translate('global.entities.leaderboard.attributes.current_rank'),
                        value: this.leaderboard?.rank ?? 'N/A',
                    },
                    {
                        label: this.$translator.translate('global.entities.leaderboard.attributes.last_week_rank'),
                        value: this.leaderboard?.last_week_rank ?? 'N/A',
                    },
                    {
                        label: this.$translator.translate('global.entities.leaderboard.attributes.last_year_rank'),
                        value: this.leaderboard?.end_last_year_rank ?? 'N/A',
                    }
                ],
                [
                    {
                        label: this.$translator.translate('global.entities.leaderboard.attributes.points_total'),
                        value: this.leaderboard?.points_total ?? 'N/A',
                    },
                    {
                        label: this.$translator.translate('global.entities.leaderboard.attributes.points_won'),
                        value: this.leaderboard?.points_won ?? 'N/A',
                    },
                    {
                        label: this.$translator.translate('global.entities.leaderboard.attributes.points_lost'),
                        value: this.leaderboard?.points_lost ?? 'N/A',
                    }
                ]
            ]
        }
    },
})
</script>

<style scoped lang="scss">

</style>