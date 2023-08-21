<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "CityInput",
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
    <label for="city">
        {{ this.$translator.translate('global.fields.city.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="text"
           id="city"
           name="city"
           required
           autocomplete="off"
           :placeholder="this.$translator.translate('global.fields.city.placeholder')"/>
</template>

<style scoped lang="scss">

</style>