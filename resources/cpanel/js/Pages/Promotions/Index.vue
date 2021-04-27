<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">{{ $page.props.cpanel.title }}</h2>
    </template>

    <template #action>
      <div class="d-flex">
        <div class="mr-3">
          <SearchFilter v-model.sync="filter" @search="search">
            <b-dropdown-group header="Type">
              <div class="mb-3 mx-3">
                <select class="form-select" v-model="filter.type">
                  <option value="">Both</option>
                  <option value="online">Online</option>
                  <option value="offline">Offline</option>
                </select>
              </div>
            </b-dropdown-group>
            <b-dropdown-group header="Status">
              <div class="mb-3 mx-3">
                <select class="form-select" v-model="filter.active">
                  <option value="">Both</option>
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </b-dropdown-group>
          </SearchFilter>
        </div>
        <inertia-link class="btn btn-primary" :href="route('cpanel.promotions.create')">
          Create
        </inertia-link>
      </div>
    </template>

    <div class="row row-cards">
      <div class="col-md-12" v-if="$page.props.errors.image">
        <b-alert variant="warning" show dismissible fade>{{ $page.props.errors.image }}</b-alert>
      </div>
      <div class="col-md-12" v-if="promotions.data.length">
        <SimplePaginate
          :links="promotions.links"
          :meta="promotions.meta"
          @pageSizeChange="search({ filter, paging: $event })"
        />
      </div>
      <div class="col-md-12">
        <div class="card">
          <b-table-lite
            striped
            hover
            :items="promotions.data"
            primary-key="id"
            fixed
            :fields="fields"
            class="table-vcenter card-table"
          >
            <template #cell(title)="data">
              <inertia-link :href="route('cpanel.promotions.edit', { promotion: data.item.id })">
                {{ data.item.title }}
              </inertia-link>
            </template>
            <template #cell(from_date)="data">
              {{ data.item.from_date | dateFormat('L') }}
            </template>
            <template #cell(to_date)="data">
              {{ data.item.to_date | dateFormat('L') }}
            </template>
            <template #cell(cover_image_url)="data">
              <img
                v-lazy="data.item.cover_image_url"
                :alt="data.item.title"
                class="object-cover rounded"
                width="100"
                height="100"
              />
            </template>

            <template #cell(published_at)="data">
              <label class="form-check form-switch">
                <input
                  class="form-check-input"
                  type="checkbox"
                  :checked="!!data.item.published_at"
                  @input="published(data.item.id)"
                />
              </label>
            </template>
          </b-table-lite>
        </div>
      </div>
      <div class="col-md-12" v-if="promotions.data.length">
        <SimplePaginate :links="promotions.links" :meta="promotions.meta" />
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import SimplePaginate from '@/Components/SimplePaginate';
import Empty from '@/Components/Empty';
import SearchFilter from '@/Components/SearchFilter';
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    BreezeAuthenticatedLayout,
    SimplePaginate,
    Empty,
    SearchFilter,
  },

  props: {
    promotions: Object,
    filter: Object,
  },

  remember: ['filter'],

  data() {
    return {
      fields: [
        { key: 'title', label: 'TITLE' },
        { key: 'cover_image_url', label: 'IMAGE' },
        { key: 'promotion_type', label: 'TYPE' },
        { key: 'from_date', label: 'FROM DATE' },
        { key: 'to_date', label: 'TO DATE' },
        { key: 'published_at', label: 'STATUS' },
      ],
    };
  },

  computed: {
    user() {
      return this.$page.props.auth.user;
    },
  },

  methods: {
    async published(id) {
      await Inertia.put(this.route('cpanel.promotions.publish', { promotion: id }));
    },

    async remove(id) {
      await Inertia.delete(this.route('cpanel.promotions.destroy', { promotion: id }), {
        onStart: () => confirm('Are you sure you want to delete this promotion?'),
      });
    },

    search() {
      Inertia.get(
        this.route('cpanel.promotions.index'),
        {
          'filter[keyword]': this.filter.keyword,
          'filter[type]': this.filter.type,
          'filter[active]': this.filter.active,
        },
        {
          only: ['promotions', 'filter'],
        }
      );
    },
  },
};
</script>
