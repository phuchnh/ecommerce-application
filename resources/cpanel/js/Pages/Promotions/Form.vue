<template>
  <form @submit.prevent="$emit('submit', form)">
    <div class="form-group mb-3 row">
      <label class="form-label col-3 col-form-label">Image Cover</label>
      <div class="col">
        <label class="btn btn-primary">
          <i class="ti ti-upload icon"></i>
          Upload
          <input type="file" hidden @input="handleImageUpload" />
        </label>
        <strong v-if="form.cover_image && form.cover_image.name" class="ml-3">
          {{ form.cover_image.name }}
        </strong>
        <div v-if="!hasUpload && form.cover_image_url">
          <img :src="form.cover_image_url" :alt="form.title" height="150" />
        </div>
        <div v-if="hasUpload && form.cover_image">
          <img :src="form.cover_image | preview" :alt="form.cover_image.name" height="150" />
        </div>
        <div v-if="errors.cover_image" class="text-red">
          {{ errors.cover_image }}
        </div>
      </div>
    </div>
    <div class="form-group mb-3 row">
      <label class="form-label col-3 col-form-label">Offline/Online?</label>
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
            <DatePicker v-model="form.from_date" class="w-100" :shortcuts="shortcuts" />
            <div v-if="errors.from_date" class="text-red">{{ errors.from_date }}</div>
          </div>
          <div class="col">
            <DatePicker v-model="form.to_date" class="w-100" :shortcuts="shortcuts" />
            <div v-if="errors.to_date" class="text-red">{{ errors.to_date }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group mb-3 row">
      <label class="form-label col-3 col-form-label">Content</label>
      <div class="col">
        <ckeditor :editor="editor" v-model="form.content" :config="editorConfig" />
        <div v-if="errors.content" class="text-red">{{ errors.content }}</div>
      </div>
    </div>
    <div class="form-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <inertia-link
        :preserveState="true"
        :href="route('cpanel.promotions.index')"
        class="btn btn-outline-secondary"
      >
        Cancel
      </inertia-link>
    </div>
  </form>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue2';
import DatePicker from 'vue2-datepicker';

export default {
  name: 'Form',
  components: {
    ckeditor: CKEditor.component,
    DatePicker,
  },
  props: {
    form: Object,
    errors: Object,
    data: Object,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        toolbar: [
          'heading',
          '|',
          'bold',
          'italic',
          '|',
          'undo',
          'redo',
          '|',
          'bulletedList',
          'numberedList',
        ],
      },
      hasUpload: false,
      promotion_type: ['online', 'offline'],
      shortcuts: [
        {
          text: 'Today',
          onClick() {
            return new Date();
          },
        },
      ],
    };
  },
  methods: {
    handleImageUpload($event) {
      this.form.cover_image = $event.target.files[0];
      this.hasUpload = true;
    },
  },
};
</script>

<style scoped>
::v-deep .mx-input {
  border: 1px solid rgba(110, 117, 130, 0.2);
  border-radius: 3px;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  box-shadow: none;
}
</style>
