<template>
    <Dropdown :name="`Languages`" :options="languageOptions()" :select="defaultLanguage()" @select="handleSelectedLanguage"/>
</template>

<script>

import Dropdown from "@/components/Form/Dropdown/Dropdown.vue";
import {mapActions} from "vuex";

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
            const previousLanguage = this.$translator.language();
            this.$translator.setLanguage(lang.value);
            if (previousLanguage !== this.$translator.language()) {
                location.reload();
            }
        }
    }
}

</script>

<style scoped lang="scss">

</style>