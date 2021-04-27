<template>
  <div class="input-group">
    <b-dropdown variant="link" text="Filters" @hide="handleFilterChange">
      <slot />
      <b-dropdown-item-button @click="reset">
        <i class="ti ti-trash icon mr-2"></i>Reset
      </b-dropdown-item-button>
    </b-dropdown>
    <div class="input-icon">
      <input
        type="text"
        class="form-control"
        placeholder="Search…"
        v-model="value.keyword"
        @keyup.enter="handleFilterChange"
      />
      <span class="input-icon-addon">
        <i class="ti ti-search"></i>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SearchFilter',
  props: {
    value: Object,
  },
  methods: {
    handleFilterChange() {
      this.$emit('update:value', this.value);
      this.$emit('search');
    },

    reset() {
      for (const property in this.value) {
        this.value[property] = '';
      }
      this.handleFilterChange();
    },
  },
};
</script>

<style scoped></style>
