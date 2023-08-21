<script>
import {defineComponent} from 'vue'
import Dropdown from "@/components/Form/Dropdown/Dropdown.vue";
import {mapGetters} from "vuex";

export default defineComponent({
    name: "GenderDropdown",
    components: {Dropdown},
    methods: {
        genderOptions() {
            const genders = {
                "male": { "en": "M", "de": "M", "fr": "H", "it": "U", "es": "H", "nl": "M" },
                "female": { "en": "F", "de": "W", "fr": "F", "it": "D", "es": "M", "nl": "V" }
            }
            return [
                {
                    label: genders["male"][this.$translator.language()],
                    value: genders["male"]
                },
                {
                    label: genders["female"][this.$translator.language()],
                    value: genders["female"]
                }
            ]
        },
        handleSelect(selected) {
            this.$emit('select', selected);
        }
    }
})
</script>

<template>
    <label for="gender">
        {{ this.$translator.translate('global.fields.gender.label') }}
    </label>
    <Dropdown :options="genderOptions()"
              @select="handleSelect"
              id="gender"
              name="gender"
              autocomplete="off"
              :placeholder="this.$translator.translate('global.fields.gender.placeholder')"/>
</template>

<style scoped lang="scss">

</style>