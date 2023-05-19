<template>
    <Dropdown :name="`Languages`" :options="languageOptions()" :select="defaultLanguage()" @select="handleSelectedLanguage"/>
</template>

<script>

import Dropdown from "@/components/Form/Dropdown.vue";

export default {
    name: "SelectLanguage",
    components: {Dropdown},
    methods: {
        languageOptions() {
            return this.$translator.languages().map((language) => {
                return {
                    value: language,
                    label: language
                }
            });
        },
        defaultLanguage() {
            const language = this.$translator.language();
            return this.languageOptions().find((option) => option.value === language);
        },
        handleSelectedLanguage(lang) {
            this.$translator.setLanguage(lang.value);
        }
    }
}

</script>

<style scoped lang="scss">

</style>