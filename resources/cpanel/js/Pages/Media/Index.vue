<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">Media</h2>
    </template>
    <template #action>
      <form class="d-flex" @submit.prevent="search">
        <div class="mr-3">
          <div class="input-icon">
            <input
              type="text"
              class="form-control"
              placeholder="Search by name"
              v-model="filter.name"
            />
            <span class="input-icon-addon">
              <i class="ti ti-search icon"></i>
            </span>
          </div>
        </div>
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
      <div class="col-md-12" v-if="media.data.length">
        <SimplePaginate :links="media.links" />
      </div>
      <div class="col-md-12">
        <div class="card">
          <Empty v-if="!media.data.length" />
          <div class="list-group card-list-group" v-if="media.data.length">
            <div class="list-group-item" v-for="item of media.data" :key="item.id">
              <div class="row row-sm align-items-center">
                <div class="col-auto">
                  <img
                    :src="item.url"
                    class="object-cover"
                    :alt="item.name"
                    width="100"
                    height="100"
                  />
                </div>
                <div class="col">
                  <div class="text-body">{{ item.name }}</div>
                </div>
                <div class="col-auto">
                  <div class="text-muted">{{ item.mime_type }}</div>
                </div>
                <div class="col-auto">
                  <div class="text-muted">{{ item.size }}</div>
                </div>
                <div class="col-auto">
                  <button class="btn btn-icon btn-outline-danger" @click="remove(item.id)">
                    <i class="ti ti-trash icon"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12" v-if="media.data.length">
        <SimplePaginate :links="media.links" />
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import SimplePaginate from '@/Components/SimplePaginate';
import Empty from '@/Components/Empty';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

export default {
  components: {
    BreezeAuthenticatedLayout,
    SimplePaginate,
    Empty,
  },

  props: {
    media: Object,
    filter: Object,
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

    remove(id) {
      Inertia.delete(this.route('cpanel.media.destroy', { media: id }), {
        onFinish: () => {
          Inertia.visit(this.route('cpanel.media.index'), {
            only: ['media'],
          });
        },
      });
    },

    search() {
      Inertia.visit(
        this.route('cpanel.media.index', {
          _query: {
            'filter[name]': this.filter.name,
          },
        }),
        {
          only: ['media', 'filter'],
        }
      );
    },
  },
};
</script>
