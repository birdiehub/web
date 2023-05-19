<template>
    <Dropdown :name="`Languages`" :options="languageOptions()" :select="defaultLanguage()" @select="handleSelectedLanguage"/>
</template>

<script>

import Dropdown from "@/components/Form/Dropdown.vue";
import translator from "@/lang";

export default {
    name: "SelectLanguage",
    components: {Dropdown},
    methods: {
        languageOptions() {
            return translator.languages().map((language) => {
                return {
                    value: language,
                    label: language
                }
            });
        },
        defaultLanguage() {
            const language = translator.language();
            return this.languageOptions().find((option) => option.value === language);
        },
        handleSelectedLanguage(lang) {
            translator.setLanguage(lang.value);
        }
    }
}

</script>

<style scoped lang="scss">

</style>