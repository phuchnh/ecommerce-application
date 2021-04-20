<template>
  <div class="mb-4 text-sm text-gray-600">
    This is a secure area of the application. Please confirm your password before continuing.
  </div>

  <breeze-validation-errors class="mb-4" />

  <form @submit.prevent="submit">
    <div>
      <breeze-label for="password" value="Password" />
      <breeze-input
        id="password"
        v-model="form.password"
        autocomplete="current-password"
        autofocus
        class="mt-1 block w-full"
        required
        type="password"
      />
    </div>

    <div class="flex justify-end mt-4">
      <breeze-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        class="ml-4"
      >
        Confirm
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
        password: ''
      })
    };
  },

  methods: {
    submit() {
      this.form.post(this.route('password.confirm'), {
        onFinish: () => this.form.reset()
      });
    }
  }
};
</script>
