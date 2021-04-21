<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">Media</h2>
    </template>
    <template #action>
      <form class="d-flex">
        <label class="btn btn-primary">
          <i class="ti ti-upload icon"></i>
          Upload <input type="file" hidden @change="upload($event.target.files[0])" />
        </label>
      </form>
    </template>

    <div class="row row-cards">
      <div class="col-md-12" v-if="$page.props.errors.image">
        <b-alert variant="warning" show dismissible fade>{{ $page.props.errors.image }}</b-alert>
      </div>
      <div class="col-md-12">
        <SimplePaginate :links="media.links" />
      </div>
      <div class="col-sm-4 col-lg-2" v-for="(item, index) in media.data" :key="item.id">
        <CardImage :src="item.url" :alt="item.name" />
      </div>
      <div class="col-md-12">
        <SimplePaginate :links="media.links" />
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import CardImage from '@/Components/CardImage';
import SimplePaginate from '@/Components/SimplePaginate';

export default {
  components: {
    BreezeAuthenticatedLayout,
    CardImage,
    SimplePaginate,
  },

  props: {
    media: Object,
  },

  data() {
    return {
      form: this.$inertia.form({
        image: null,
      }),
    };
  },

  computed: {
    user() {
      return this.$page.props.auth.user;
    },
    images() {
      return Array.from(Array(100).keys());
    },
  },

  methods: {
    upload(file) {
      this.form.image = file;
      this.form.post(this.route('cpanel.media.upload'), {
        forceFormData: true,
        onFinish: () => {},
      });
    },
  },
};
</script>
