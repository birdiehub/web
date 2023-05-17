<template>
 <div class="notification" :class="notification.type">
   <div class="notification-content flex-center-row flex-gap-row">
     <Icon :icon="icon()" :color="`var(--color-white)`"/>
     <p>{{ notification.content }}</p>
   </div>
   <div class="close-notification">
     <IconButton :icon="`close`" :color="`var(--color-white)`" @click="close"/>
   </div>
 </div>
</template>

<script>
import {mapActions} from "vuex";

import IconButton from "@/components/Button/IconButton";
import Icon from "@/components/Icon/Icon";

export default {
  name: "NotificationBar",
  components: {
    IconButton,
    Icon
  },
  props: {
    notification: {
      type: Object,
      required: true
    }
  },
  created() {
    setTimeout(this.close, 8000);
  },
  methods: {
    ...mapActions(['removeNotification']),
    close() {
      this.removeNotification(this.notification.id);
    },
    icon() {
      switch (this.notification.type){
        case "error":
          return `error`;
        case "success":
          return `check_circle`;
        case "warning":
          return `warning`;
        default:
          return `info`;
      }
    }
  }
};
</script>

<style scoped>

.notification {
  color: var(--color-white);
  height: 4rem;
  background-color: var(--color-secondary-soft);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 1rem;
}

.notification-content {
  gap: 1rem;
}

.info {
  background-color: var(--color-secondary-soft);
}

.success {
  background-color: var(--color-green);
}

.error {
  background-color: var(--color-red);
}

.warning {
  background-color: var(--color-orange);
}

</style>
