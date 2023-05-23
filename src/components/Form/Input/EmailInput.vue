<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "EmailInput",
    components: {Input},
    props: ['value'],
    emits: ['update:value'],
    computed: {
        internalValue: {
            get() {
                return this.value;
            },
            set(newValue) {
                this.$emit('update:value', newValue);
            },
        },
    }
})
</script>

<template>
    <label for="email">
        {{ this.$translator.translate('global.fields.email.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="email"
           id="email"
           name="email"
           required
           autocomplete="off"
           :placeholder="this.$translator.translate('global.fields.email.placeholder')"/>
</template>

<style scoped lang="scss">

</style>