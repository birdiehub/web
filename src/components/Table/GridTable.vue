
<template>
    <div class="stats-table box">
        <header class="stats-table-header">
            <h2>{{ title }}</h2>
        </header>
        <main class="stats-table-body">
            <div v-for="row in items" class="stats-table-row flex-space-between-row">
                <div v-for="cell in row" class="stats-table-cell">
                    <h3>{{ cell.label }}</h3>
                    <p>{{ cell.value }}</p>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "GridTable",
    props: {
        title: {
            type: String,
            required: true,
        },
        items: {
            type: Array,
            required: true,
            default: [
                [
                    {
                        label: "Row 1, Column 1",
                        value: "N/A",
                    },
                    {
                        label: "Row 1, Column 2",
                        value: "N/A",
                    }
                ],
                [
                    {
                        label: "Row 2, Column 1",
                        value: "N/A",
                    },
                    {
                        label: "Row 2, Column 2",
                        value: "N/A",
                    }
                ],
            ]
        }
    }
})
</script>

<style scoped lang="scss">

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

  }

}

</style>