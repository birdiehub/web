<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "ZipInput",
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
    <label for="zip">
        {{ this.$translator.translate('global.fields.zip.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="text"
           id="zip"
           name="zip"
           required
           autocomplete="off"
           :placeholder="this.$translator.translate('global.fields.zip.placeholder')"/>
</template>

<style scoped lang="scss">

</style>