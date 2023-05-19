<template>
  <select :name="name" class="box">
    <option v-for="option in options" :value="option" :selected="option === selected" @click="selected = option">
        {{ option.name }}
    </option>
  </select>
</template>

<script>
export default {
  name: "Dropdown",
  props: {
    name: String,
    options: {
      type: Array,
      required: true,
      default: []
    }
  },
  data() {
    return {
      selected: this.options[0] // default selected value
    };
  },
  methods: {
    getSelected() {
      this.$emit('selected', this.selected);
    }
  }
};
</script>
