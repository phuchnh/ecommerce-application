<template>
  <header class="navbar navbar-expand-md navbar-light sticky-top d-print-none">
    <div class="container-xl">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbar-menu"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <inertia-link
        href="/"
        class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3"
      >
        <span class="text-bold">Cpanel</span>
      </inertia-link>
      <div class="navbar-nav flex-row order-md-last">
        <div class="nav-item dropdown">
          <a
            href="#"
            class="nav-link d-flex lh-1 text-reset p-0"
            data-toggle="dropdown"
            aria-expanded="false"
          >
            <div class="d-none d-xl-block pl-2">
              <div>{{ user.name }}</div>
              <div class="mt-1 small text-muted">{{ user.email }}</div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <inertia-link
              class="dropdown-item"
              :href="route('cpanel.logout')"
              method="post"
              as="button"
            >
              Logout
            </inertia-link>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  computed: {
    user() {
      return this.$page.props.auth.user;
    },
  },
};
</script>

<style scoped></style>
