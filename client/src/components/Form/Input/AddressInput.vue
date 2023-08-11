<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "AddressInput",
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
    <label for="address">
        {{ this.$translator.translate('global.fields.address.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="text"
           id="address"
           name="address"
           required
           autocomplete="off"
           :placeholder="this.$translator.translate('global.fields.address.placeholder')"/>
</template>

<style scoped lang="scss">

</style>