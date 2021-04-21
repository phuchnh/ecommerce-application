<!--suppress RequiredAttributes -->
<template>
  <div class="card card-sm">
    <a href="#" class="d-block">
      <img v-lazy="src" class="card-img-top object-cover" alt="" height="150" />
    </a>
  </div>
</template>

<script>
export default {
  props: ['src'],
  name: 'ImageCard',
};
</script>
