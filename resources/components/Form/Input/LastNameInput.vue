<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "LastNameInput",
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
    <label for="last_name">
        {{ this.$translator.translate('global.fields.last_name.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="text"
           id="last_name"
           name="last_name"
           required
           autocomplete="off"
           :placeholder="this.$translator.translate('global.fields.last_name.placeholder')"/>
</template>

<style scoped lang="scss">

</style>