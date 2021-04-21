<!--suppress RequiredAttributes -->
<template>
  <div class="card card-sm hover-shadow">
    <img v-lazy="src" class="card-img-top object-cover" alt="" height="150" />
  </div>
</template>

<script>
export default {
  props: ['src', 'alt'],
  name: 'CardImage',
};
</script>
