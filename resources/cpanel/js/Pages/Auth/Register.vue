<template>
  <breeze-validation-errors class="mb-4" />

  <form @submit.prevent="submit">
    <div>
      <breeze-label for="name" value="Name" />
      <breeze-input
        id="name"
        v-model="form.name"
        autocomplete="name"
        autofocus
        class="mt-1 block w-full"
        required
        type="text"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="email" value="Email" />
      <breeze-input
        id="email"
        v-model="form.email"
        autocomplete="username"
        class="mt-1 block w-full"
        required
        type="email"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="password" value="Password" />
      <breeze-input
        id="password"
        v-model="form.password"
        autocomplete="new-password"
        class="mt-1 block w-full"
        required
        type="password"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="password_confirmation" value="Confirm Password" />
      <breeze-input
        id="password_confirmation"
        v-model="form.password_confirmation"
        autocomplete="new-password"
        class="mt-1 block w-full"
        required
        type="password"
      />
    </div>

    <div class="flex items-center justify-end mt-4">
      <inertia-link
        :href="route('login')"
        class="underline text-sm text-gray-600 hover:text-gray-900"
      >
        Already registered?
      </inertia-link>

      <breeze-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        class="ml-4"
      >
        Register
      </breeze-button>
    </div>
  </form>
</template>

<script>
import BreezeButton from '../../Components/Button';
import BreezeGuestLayout from '../../Layouts/Guest';
import BreezeInput from '../../Components/Input';
import BreezeLabel from '../../Components/Label';
import BreezeValidationErrors from '../../Components/ValidationErrors';

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors
  },

  data() {
    return {
      form: this.$inertia.form({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false
      })
    };
  },

  methods: {
    submit() {
      this.form.post(this.route('register'), {
        onFinish: () => this.form.reset('password', 'password_confirmation')
      });
    }
  }
};
</script>
