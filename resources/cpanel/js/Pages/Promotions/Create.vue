<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">{{ $page.props.cpanel.title }}</h2>
    </template>
    <div class="row row-cards">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <Form @submit="submit" :form="form" :errors="errors" />
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import Form from '@/Pages/Promotions/Form';

export default {
  components: {
    Form,
    BreezeAuthenticatedLayout,
  },

  props: {
    errors: Object,
  },

  remember: 'form',

  data() {
    return {
      form: this.$inertia.form({
        promotion_type: null,
        cover_image: null,
        title: null,
        content: null,
        from_date: null,
        to_date: null,
        published_at: null,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route('cpanel.promotions.store'));
    },
  },
};
</script>
