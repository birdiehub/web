<template>
    <div :class="{'notifications': fixed}">
        <NotificationBar v-for="notification in notifications" :notification="notification"/>
    </div>
</template>

<script>


import NotificationBar from "@/components/Notification/NotificationBar.vue";
import {mapGetters} from "vuex";

export default {
    name: "Notifications",
    components: {
        NotificationBar
    },
    computed: {
        ...mapGetters(['notifications'])
    },
    props: {
        fixed: {
            type: Boolean,
            default: false
        }
    },
}

</script>

<style scoped lang="scss">


.notifications {
  position: fixed;
  width: 100%;
  z-index: 100;
}

</style>