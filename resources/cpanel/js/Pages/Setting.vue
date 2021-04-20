<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="page-title">Setting</h2>
    </template>

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="submit">
              <div class="form-group mb-3 row" v-for="item in general" :key="item">
                <label class="form-label col-3 col-form-label">{{ title.general[item] }}</label>
                <div class="col">
                  <input type="text" class="form-control" v-model="form[item]" />
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <b-button variant="outline-primary">Button</b-button>
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
        site_name: this.setting.site_name,
        email_address: this.setting.email_address,
        seo_meta_description: this.setting.seo_meta_description,
        seo_meta_title: this.setting.seo_meta_title,
        social_facebook: this.setting.social_facebook,
        social_google: this.setting.social_google,
        social_instagram: this.setting.social_instagram,
        social_twitter: this.setting.social_twitter,
      }),
      title: {
        general: {
          site_name: 'Site Name',
          email_address: 'Email Address',
          seo_meta_description: 'Meta Description',
          seo_meta_title: 'Meta Title',
          social_facebook: 'Social Facebook',
          social_google: 'Social Google',
          social_instagram: 'Social Instagram',
          social_twitter: 'Social Twitter',
        },
      },
    };
  },

  computed: {
    general() {
      return Object.keys(this.setting);
    },
    user() {
      return this.$page.props.auth.user;
    },
  },

  methods: {
    submit() {
      this.form
        .transform((data) => {
          return {
            general: data,
          };
        })
        .put(this.route('cpanel.setting'), {
          onFinish: () => {},
        });
    },
  },
};
</script>
