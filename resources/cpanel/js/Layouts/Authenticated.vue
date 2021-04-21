<template>
  <div class="page">
    <div class="sticky-top">
      <Header />
      <Nav />
    </div>
    <div class="content">
      <div class="container-xl">
        <!-- Page Heading -->
        <div class="page-header d-print-none" v-if="$slots.header">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="page-title">
                <slot name="header" />
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none" v-if="$slots.action">
              <slot name="action" />
            </div>
          </div>
        </div>
        <!-- Page Content -->
        <div class="row" v-if="$page.props.flash.message">
          <div class="col-md-12">
            <b-alert variant="success" show dismissible fade>
              {{ $page.props.flash.message }}
            </b-alert>
          </div>
        </div>
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
import Header from '@/Layouts/Header';
import Nav from '@/Layouts/Nav';

export default {
  components: {
    Header,
    Nav,
  },

  computed: {
    user() {
      return this.$page.props.auth.user;
    },
  },
};
</script>
