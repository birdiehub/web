<template>
    <table>
        <thead>
        <tr>
            <th>{{ this.$translator.translate('global.entities.player.attributes.rank') }}</th>
            <th>{{ this.$translator.translate('global.entities.player.attributes.headshot') }}</th>
            <th>{{ this.$translator.translate('global.entities.player.attributes.full_name') }}</th>
            <th>{{ this.$translator.translate('global.entities.player.attributes.country') }}</th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="item in this.items" @click="this.$router.push(`/players/${item.id}`)">
                <td>{{ item.rank }}</td>
                <td>
                    <img class="cell-image" :src="item.headshot ?? 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png'" alt=""/>
                </td>
                <td>{{ item.first_name + ' ' + item.last_name }}</td>
                <td>
                    <div v-if="item.country" class="country-cell">
                        <img class="cell-image" :src="item.country?.flag" alt="">
                        <p>{{ item.country?.name }}</p>
                    </div>
                    {{ !item.country ? "N/A" : "" }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>

export default {
    name: "PlayersTable",
    props: {
        items: {
            type: Array,
            required: true
        }
    }
}

</script>

<style scoped lang="scss">

.table-wrapper {
  margin: 0;
  background: var(--color-background);
  font-family: sans-serif;
  font-weight: 100;
}

table {
  width: 100%;
  border-collapse: collapse;
  overflow: hidden;
  box-shadow: var(--box-shadow);
  border-radius: var(--box-radius);
}

th, td {
  padding: 12px;
  background-color: rgba(255,255,255,0.2);
  color: var(--color-primary-soft);
}

td {
    vertical-align: middle;
}

th {
  text-align: left;
}

thead {
  th {
    background-color: var(--color-secondary);
    color: var(--color-white);
  }
}

tbody {
  tr {
    &:hover {
      background-color: rgba(118, 120, 122, 0.1);
    }
  }
  td {
    position: relative;
    &:hover {
      &:before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: -9999px;
        bottom: -9999px;
        background-color: rgba(255,255,255,0.2);
        z-index: -1;
      }
    }
  }
}

.cell-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

.country-cell {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 1rem;
}



</style>