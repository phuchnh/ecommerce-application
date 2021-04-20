<template>
  <div class="navbar-expand-md">
    <div class="navbar collapse navbar-collapse navbar-light" id="navbar-menu">
      <div class="container-xl">
        <ul class="navbar-nav">
          <li class="nav-item" :class="{ active: route().current('cpanel.dashboard') }">
            <inertia-link class="nav-link" :href="route('cpanel.dashboard')">
              <span class="nav-link-title">Dashboard</span>
            </inertia-link>
          </li>
          <li class="nav-item" :class="{ active: route().current('cpanel.setting') }">
            <inertia-link class="nav-link" :href="route('cpanel.setting')">
              <span class="nav-link-title">Setting</span>
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
