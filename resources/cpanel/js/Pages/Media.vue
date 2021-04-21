<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">Media</h2>
    </template>

    <div class="row row-cards">
      <div class="col-sm-4 col-lg-2" v-for="item in images" :key="item">
        <CardImage :src="'https://picsum.photos/200/300?random=' + item" />
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import CardImage from '@/Components/CardImage';

export default {
  components: {
    BreezeAuthenticatedLayout,
    CardImage,
  },

  computed: {
    user() {
      return this.$page.props.auth.user;
    },
    images() {
      return Array.from(Array(100).keys());
    },
  },
};
</script>
