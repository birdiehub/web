<template>
  <select :name="name" class="box" v-model="selected">
    <option v-for="option in options" :value="option" @click="() => handleSelect(option)">
        {{ option.label }}
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
    },
    select: {
      required: false
    }
  },
  data() {
    return {
      selected: this.select ?? this.options[0]
    };
  },
  methods: {
    handleSelect(selected) {
      this.selected = selected;
      this.$emit('select', selected);
    }
  },
  mounted() {
    this.$emit('select', this.selected);
  }
};
</script>
