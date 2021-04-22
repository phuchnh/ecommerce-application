<template>
  <div class="navbar-expand-md">
    <div class="navbar collapse navbar-collapse navbar-light" id="navbar-menu">
      <div class="container-xl">
        <ul class="navbar-nav">
          <li class="nav-item" :class="{ active: route().current('cpanel.dashboard') }">
            <inertia-link class="nav-link" :href="route('cpanel.dashboard')">
              <span class="nav-link-title">DASHBOARD</span>
            </inertia-link>
          </li>
          <li class="nav-item" :class="{ active: route().current('cpanel.setting') }">
            <inertia-link class="nav-link" :href="route('cpanel.setting')">
              <span class="nav-link-title">SETTING</span>
            </inertia-link>
          </li>
          <li class="nav-item" :class="{ active: route().current('cpanel.media.index') }">
            <inertia-link class="nav-link" :href="route('cpanel.media.index')">
              <span class="nav-link-title">MEDIA</span>
            </inertia-link>
          </li>
          <li class="nav-item" :class="{ active: route().current('cpanel.promotions.index') }">
            <inertia-link class="nav-link" :href="route('cpanel.promotions.index')">
              <span class="nav-link-title">PROMOTION</span>
            </inertia-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped></style>
