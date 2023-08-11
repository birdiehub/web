<script>
import {defineComponent} from 'vue'
import Input from "@/components/Form/Input/Input.vue";

export default defineComponent({
    name: "UsernameInput",
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
    <label for="username">
        {{ this.$translator.translate('global.fields.username.label') }}
    </label>
    <Input v-model:value="internalValue"
           type="text"
           id="username"
           name="username"
           required
           autocomplete="off"
           :placeholder="this.$translator.translate('global.fields.username.placeholder')"/>
</template>

<style scoped lang="scss">

</style>