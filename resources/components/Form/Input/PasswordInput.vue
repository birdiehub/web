<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "PasswordInput",
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
    <label for="password">
        {{ this.$translator.translate('global.fields.password.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="password"
           id="password"
           name="password"
           required
           autocomplete="off"
           min="8"
           max="255"
           :placeholder="this.$translator.translate('global.fields.password.placeholder')"/>
</template>

<style scoped lang="scss">

</style>