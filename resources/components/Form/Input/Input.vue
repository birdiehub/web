<template>
    <input v-model="internalValue" />
</template>

<script>
export default {
    name: 'Input',
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
    },
};
</script>
