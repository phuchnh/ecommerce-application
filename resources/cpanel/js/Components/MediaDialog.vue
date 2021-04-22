<template>
  <ul>
    <li v-for="item of media">{{ item.name }}</li>
  </ul>
</template>

<script>
export default {
  name: 'MediaDialog',

  props: ['select'],

  data() {
    return {
      media: [],
    };
  },

  async mounted() {
    this.media = await this.fetchMedia();
  },

  methods: {
    async fetchMedia() {
      const response = await axios.get('/api/media');
      return response.data.data;
    },
  },
};
</script>

<style scoped></style>
