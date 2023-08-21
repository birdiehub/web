<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "FirstNameInput",
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
    <label for="first_name">
        {{ this.$translator.translate('global.fields.first_name.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="text"
           id="first_name"
           name="first_name"
           required
           autocomplete="off"
           :placeholder="this.$translator.translate('global.fields.first_name.placeholder')"/>
</template>

<style scoped lang="scss">

</style>