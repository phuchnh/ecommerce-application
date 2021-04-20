<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">Setting</h2>
    </template>

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <form>
              <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Email address</label>
                <div class="col">
                  <input type="email" class="form-control" />
                  <small class="form-hint">We'll never share your email with anyone else.</small>
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
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
    BreezeAuthenticatedLayout,
  },

  props: {
    setting: Object,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false,
      }),
    };
  },

  computed: {
    user() {
      return this.$page.props.auth.user;
    },
  },
};
</script>
