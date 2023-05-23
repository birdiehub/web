<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "PhoneInput",
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
    <label for="phone">
        {{ this.$translator.translate('global.fields.phone.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="text"
           id="phone"
           name="phone"
           required
           autocomplete="off"
           :placeholder="this.$translator.translate('global.fields.phone.placeholder')"/>
</template>

<style scoped lang="scss">

</style>