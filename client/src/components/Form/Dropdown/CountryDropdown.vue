<script>
import {defineComponent} from 'vue'
import Dropdown from "@/components/Form/Dropdown/Dropdown.vue";
import {mapGetters} from "vuex";

export default defineComponent({
    name: "CountryDropdown",
    components: {Dropdown},
    props: ['selectCountryId'],
    computed: {
        ...mapGetters(['countries'])
    },
    methods: {
        countryOptions() {
            return this.countries.map(country => {
                return {
                    value: country,
                    label: country.name
                }
            });
        },
        handleSelect(selected) {
            this.$emit('select', selected);
        },
        defaultCountry() {
            return this.countryOptions().find((option) => option.value.id === this.selectCountryId) ?? this.countryOptions()[0];
        }
    }
})
</script>

<template>
    <label for="country">
        {{ this.$translator.translate('global.fields.country.label') }}
    </label>
    <Dropdown :options="countryOptions()"
              @select="handleSelect"
              :select="defaultCountry()"
              id="country"
              name="country"
              autocomplete="off"
              :placeholder="this.$translator.translate('global.fields.country.placeholder')"/>
</template>

<style scoped lang="scss">

</style>