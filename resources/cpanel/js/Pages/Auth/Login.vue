<template>
  <form class="card card-md" @submit.prevent="submit">
    <div class="card-body">
      <h2 class="mb-5 text-center">Login to your account</h2>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input
          type="text"
          class="form-control"
          :class="{ 'is-invalid': !!errors.email }"
          placeholder="Enter email"
          autocomplete="off"
          v-model="form.email"
        />
        <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
      </div>
      <div class="mb-2">
        <label class="form-label">Password</label>
        <input
          type="password"
          class="form-control"
          :class="{ 'is-invalid': !!errors.password }"
          placeholder="Password"
          v-model="form.password"
        />
        <div v-if="errors.password" class="invalid-feedback">{{ errors.password }}</div>
      </div>
      <div class="mb-2">
        <label class="form-check">
          <input type="checkbox" class="form-check-input" v-model="form.remember" />
          <span class="form-check-label">Remember</span>
        </label>
      </div>
      <div class="form-footer">
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
      </div>
    </div>
  </form>
</template>

<script>
import BreezeGuestLayout from '@/Layouts/Guest';

export default {
  layout: BreezeGuestLayout,

  components: {},

  props: {
    errors: Object,
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

  methods: {
    submit() {
      axios.get('/sanctum/csrf-cookie').then(response => {
        this.form
          .transform(data => ({
            ...data,
            remember: this.form.remember ? 'on' : '',
          }))
          .post(this.route('cpanel.login'), {
            onFinish: () => this.form.reset('password'),
          });
      });
    },
  },
};
</script>
