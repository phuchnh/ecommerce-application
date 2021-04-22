require('./bootstrap');

import { InertiaProgress } from '@inertiajs/progress';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import Vue from 'vue';
import UpdatePageTitle from './Mixins/UpdatePageTitle';
import { BootstrapVue } from 'bootstrap-vue';
import VueLazyload from 'vue-lazyload';
import Vue2Editor from 'vue2-editor';

Vue.use(VueLazyload, {
  preLoad: 1.3,
  attempt: 1,
});
Vue.use(BootstrapVue);
Vue.use(Vue2Editor);
Vue.use(InertiaPlugin);
Vue.mixin(UpdatePageTitle);
Vue.mixin({ methods: { route } });

const el = document.getElementById('app');

new Vue({
  render: h =>
    h(InertiaApp, {
      props: {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => require(`./Pages/${name}`).default,
      },
    }),
}).$mount(el);

// Loading
InertiaProgress.init({ color: '#4B5563', showSpinner: true });
