require('./bootstrap');

import { InertiaProgress } from '@inertiajs/progress';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import Vue from 'vue';

const el = document.getElementById('app');

new Vue({
  render: (h) =>
    h(InertiaApp, {
      props: {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: (name) => require(`./Pages/${name}`).default,
      },
    }),
}).$mount(el);

Vue.use(InertiaPlugin);
Vue.mixin({ methods: { route } });
InertiaProgress.init({ color: '#4B5563' });
