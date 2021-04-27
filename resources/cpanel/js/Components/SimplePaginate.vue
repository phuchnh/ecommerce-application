<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-between">
      <li class="page-item" :class="{ disabled: !hasPrev }">
        <inertia-link
          class="page-link"
          :href="prevUrl"
          :tabindex="hasPrev ? 1 : -1"
          :aria-disabled="!hasPrev"
        >
          <i class="ti ti-chevron-left"></i>
          Prev
        </inertia-link>
      </li>
      <li class="page-item">
        <select
          class="form-select"
          v-model="meta.per_page"
          @change="$emit('pageSizeChange', $event)"
        >
          <option value="10">10</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </li>
      <li class="page-item" :class="{ disabled: !hasNext }">
        <inertia-link
          class="page-link"
          :href="nextUrl"
          :tabindex="hasNext ? 1 : -1"
          :aria-disabled="!hasNext"
        >
          Next
          <i class="ti ti-chevron-right"></i>
        </inertia-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: 'SimplePaginate',
  props: {
    links: Object,
    meta: Object,
  },
  computed: {
    prevUrl() {
      return this.links.prev || '';
    },
    hasPrev() {
      return !!this.links.prev;
    },
    nextUrl() {
      return this.links.next || '';
    },
    hasNext() {
      return !!this.links.next;
    },
  },
};
</script>

<style scoped></style>
