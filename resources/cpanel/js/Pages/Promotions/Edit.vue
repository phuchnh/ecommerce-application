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
import pick from 'lodash/pick';

export default {
  components: {
    Form,
    BreezeAuthenticatedLayout,
  },
  props: {
    promotion: Object,
    errors: Object,
  },

  remember: ['form'],

  data() {
    return {
      form: this.$inertia.form(
        pick(this.promotion.data, [
          'promotion_type',
          'cover_image',
          'cover_image_url',
          'title',
          'content',
          'from_date',
          'to_date',
          'published_at',
        ])
      ),
    };
  },

  methods: {
    submit() {
      this.form
        .transform(data => ({ ...data, _method: 'PUT' }))
        .post(this.route('cpanel.promotions.update', { promotion: this.promotion.data.id }));
    },
  },
};
</script>
