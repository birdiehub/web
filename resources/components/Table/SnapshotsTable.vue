<template>
  <GridTable :title="this.$translator.translate('global.entities.snapshot.name')" :items="items()"/>
</template>

<script>
import {defineComponent} from 'vue'
import GridTable from "@/components/Table/GridTable.vue";

export default defineComponent({
    name: "SnapshotsTable",
    components: {GridTable},
    props: {
        snapshots: {
            type: Array,
            required: true,
            default: [
                {
                    title: 'N/A',
                    value: 'N/A',
                    description: 'N/A',
                }
            ]
        }
    },
    methods: {
        items() {
            return this.snapshots.map(snapshot => {
                return [
                    {
                        label: this.$translator.translate('global.entities.snapshot.attributes.title'),
                        value: snapshot?.title ?? 'N/A',
                    },
                    {
                        label: this.$translator.translate('global.entities.snapshot.attributes.value'),
                        value: snapshot?.value ?? 'N/A',
                    },
                    {
                        label: this.$translator.translate('global.entities.snapshot.attributes.description'),
                        value: snapshot?.description ?? 'N/A',
                    }
                ]
            }, [])
        }
    }
})
</script>

<style scoped lang="scss">

</style>