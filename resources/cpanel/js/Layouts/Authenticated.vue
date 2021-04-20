<template>
  <div class="page">
    <Header />
    <Nav />
    <div class="content">
      <div class="container-xl">
        <!-- Page Heading -->
        <div class="page-header" v-if="$slots.header">
          <div class="row align-items-center">
            <div class="col-auto">
              <h2 class="page-title">
                <slot name="header" />
              </h2>
            </div>
            <div class="col-auto ml-auto" v-if="$slots.action">
              <slot name="action" />
            </div>
          </div>
        </div>
        <!-- Page Content -->
        <div class="row" v-if="$page.props.flash.message">
          <div class="col-12">
            <div class="alert alert-success alert-dismissible" role="alert">
              {{ $page.props.flash.message }}
              <a class="close" aria-label="close" @click.prevent="$page.props.flash.message = ''">
                &times;
              </a>
            </div>
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
