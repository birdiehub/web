<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "ConfirmPasswordInput",
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
    <label for="confirm-password">
        {{ this.$translator.translate('global.fields.confirm_password.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="password"
           id="confirm-password"
           name="password"
           required
           autocomplete="off"
           min="8"
           max="255"
           :placeholder="this.$translator.translate('global.fields.confirm_password.placeholder')"/>
</template>

<style scoped lang="scss">

</style>