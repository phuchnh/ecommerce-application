<template>
  <b-modal v-model="visibility" size="lg" title="Gallery" centered>
    <div class="row row-cards">
      <div class="col-md-4" v-for="item of media.data" :key="item.id" @click="active = item">
        <div class="card" :class="{ 'card-active': item === active }">
          <img :src="item.url" :alt="item.name" class="card-img-top object-fill" height="150" />
        </div>
      </div>
    </div>
    <template #modal-footer>
      <div class="d-flex justify-content-between w-100">
        <div class="btn-group">
          <button
            type="button"
            class="btn btn-white btn-icon"
            aria-label="Button"
            :disabled="!media.links.prev"
            @click="prev(media.meta.current_page - 1)"
          >
            <i class="ti ti-chevron-left"></i>
          </button>
          <button
            type="button"
            class="btn btn-white btn-icon"
            aria-label="Button"
            :disabled="!media.links.next"
            @click="next(media.meta.current_page + 1)"
          >
            <i class="ti ti-chevron-right"></i>
          </button>
        </div>
        <div class="btn-list">
          <a class="btn btn-link" @click="hide">Cancel</a>
          <button type="button" class="btn btn-primary ms-auto">OK</button>
        </div>
      </div>
    </template>
  </b-modal>
</template>

<script>
export default {
  name: 'MediaDialog',

  props: ['select'],

  data() {
    return {
      active: null,
      visibility: false,
      media: {},
    };
  },

  async mounted() {
    this.media = await this.fetchMedia();
  },

  methods: {
    async next(page) {
      this.media = await this.fetchMedia(page);
    },
    async prev(page) {
      this.media = await this.fetchMedia(page);
    },
    show() {
      this.visibility = true;
    },
    hide() {
      this.visibility = false;
    },
    async fetchMedia(page = 1) {
      const response = await axios.get('/api/media', {
        params: {
          page,
          per_page: 10,
        },
      });
      return response.data;
    },
  },
};
</script>

<style scoped></style>
