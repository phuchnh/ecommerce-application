<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">{{ $page.props.cpanel.title }}</h2>
    </template>
    <div class="row row-cards">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="submit">
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Image Cover</label>
                <div class="col">
                  <label class="btn btn-primary">
                    <i class="ti ti-upload icon"></i>
                    Upload
                    <input type="file" hidden @input="form.img_cover = $event.target.files[0]" />
                  </label>
                  <strong v-if="form.img_cover && form.img_cover.name" class="ml-3">
                    {{ form.img_cover.name }}
                  </strong>
                  <div v-if="form.img_cover">
                    <img :src="form.img_cover" :alt="form.title" height="150" />
                  </div>
                  <div v-if="errors.img_cover" class="text-red">
                    {{ errors.img_cover }}
                  </div>
                </div>
              </div>
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Offline/Online</label>
                <div class="col">
                  <div class="form-selectgroup" :class="{ 'is-invalid': errors.promotion_type }">
                    <label class="form-selectgroup-item" v-for="item of promotion_type" :key="item">
                      <input
                        type="radio"
                        name="promotion_type"
                        :value="item"
                        v-model="form.promotion_type"
                        class="form-selectgroup-input"
                      />
                      <span class="form-selectgroup-label text-capitalize">{{ item }}</span>
                    </label>
                  </div>
                  <div v-if="errors.promotion_type" class="text-red">
                    {{ errors.promotion_type }}
                  </div>
                </div>
              </div>
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Title</label>
                <div class="col">
                  <input type="text" class="form-control" v-model="form.title" />
                  <div v-if="errors.title" class="text-red">{{ errors.title }}</div>
                </div>
              </div>
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Expired</label>
                <div class="col">
                  <div class="row">
                    <div class="col">
                      {{ form.from_date }}
                      <input type="date" class="form-control" v-model="form.from_date" />
                      <b-form-datepicker
                        class="form-control"
                        v-model="form.from_date"
                        date-format-options=""
                      >
                      </b-form-datepicker>
                      <div v-if="errors.from_date" class="text-red">
                        {{ errors.from_date }}
                      </div>
                    </div>
                    <div class="col">
                      <input type="date" class="form-control" v-model="form.to_date" />
                      <div v-if="errors.to_date" class="text-red">{{ errors.to_date }}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Content</label>
                <div class="col">
                  <vue-editor v-model="form.content" />
                  <div v-if="errors.content" class="text-red">{{ errors.content }}</div>
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-success">Submit & Publish</button>
                <inertia-link
                  :href="route('cpanel.promotions.index')"
                  class="btn btn-outline-secondary"
                >
                  Cancel
                </inertia-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import MediaDialog from '@/Components/MediaDialog';
import { VueEditor } from 'vue2-editor';

export default {
  components: {
    MediaDialog,
    VueEditor,
    BreezeAuthenticatedLayout,
  },
  props: {
    promotion: Object,
    errors: Object,
  },

  data() {
    return {
      promotion_type: ['online', 'offline'],
      form: this.$inertia.form({
        promotion_type: this.promotion.data.promotion_type,
        img_cover: this.promotion.data.img_cover,
        title: this.promotion.data.title,
        content: this.promotion.data.content,
        from_date: this.promotion.data.from_date,
        to_date: this.promotion.data.to_date,
        published_at: this.promotion.data.published_at,
      }),
    };
  },

  filters: {
    preview: function (file) {
      if (!file) return '';
      return URL.createObjectURL(file);
    },
  },

  methods: {
    submit() {
      this.form
        .transform(data => ({
          ...data,
        }))
        .post(this.route('cpanel.promotions.store'), {
          forceFormData: true,
          onFinish: () => this.form.reset('password'),
        });
    },
  },
};
</script>

<style scoped>
::v-deep .ql-editor strong {
  font-weight: bold !important;
}

::v-deep .quillWrapper.is-invalid {
  border: 1px solid #cd201f;
}
</style>
