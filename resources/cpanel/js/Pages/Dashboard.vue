<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">Dashboard</h2>
    </template>

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            Welcome back <span class="font-weight-black">{{ user.name }}</span>
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';

export default {
  components: {
    BreezeAuthenticatedLayout
  },

  computed: {
    user() {
      return this.$page.props.auth.user;
    }
  }
};
</script>
