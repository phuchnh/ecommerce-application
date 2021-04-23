<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">{{ $page.props.cpanel.title }}</h2>
    </template>
    <template #action>
      <form class="d-flex" @submit.prevent="search">
        <div class="mr-3">
          <div class="input-icon">
            <input
              type="text"
              class="form-control"
              placeholder="Search by title"
              v-model="filter.title"
            />
            <span class="input-icon-addon">
              <i class="ti ti-search icon"></i>
            </span>
          </div>
        </div>
        <inertia-link class="btn btn-primary" :href="route('cpanel.promotions.create')">
          Create
        </inertia-link>
      </form>
    </template>

    <div class="row row-cards">
      <div class="col-md-12" v-if="$page.props.errors.image">
        <b-alert variant="warning" show dismissible fade>{{ $page.props.errors.image }}</b-alert>
      </div>
      <div class="col-md-12" v-if="promotions.data.length">
        <SimplePaginate :links="promotions.links" />
      </div>
      <div class="col-md-12">
        <div class="card">
          <Empty v-if="!promotions.data.length" />
          <div class="list-group card-list-group" v-if="promotions.data.length">
            <div class="list-group-item" v-for="item of promotions.data" :key="item.id">
              <div class="row row-sm align-items-center">
                <div class="col-auto">
                  <img
                    :src="item.img_cover"
                    class="object-cover"
                    :alt="item.title"
                    width="100"
                    height="100"
                  />
                </div>
                <div class="col">
                  <div class="text-body">
                    <inertia-link :href="route('cpanel.promotions.edit', { promotion: item.id })">
                      {{ item.title }}
                    </inertia-link>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="text-muted">{{ item.promotion_type }}</div>
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
      <div class="col-md-12" v-if="promotions.data.length">
        <SimplePaginate :links="promotions.links" />
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import SimplePaginate from '@/Components/SimplePaginate';
import Empty from '@/Components/Empty';
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    BreezeAuthenticatedLayout,
    SimplePaginate,
    Empty,
  },

  props: {
    promotions: Object,
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
    remove(id) {
      Inertia.delete(this.route('cpanel.promotions.destroy', { promotion: id }), {
        onFinish: () => {
          Inertia.visit(this.route('cpanel.promotions.index'), {
            only: ['promotions'],
          });
        },
      });
    },

    search() {
      Inertia.visit(
        this.route('cpanel.promotions.index', {
          _query: {
            'filter[title]': this.filter.title,
          },
        }),
        {
          only: ['promotions', 'filter'],
        }
      );
    },
  },
};
</script>
