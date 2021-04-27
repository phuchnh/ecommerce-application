require('./bootstrap');

import { InertiaProgress } from '@inertiajs/progress';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import Vue from 'vue';
import UpdatePageTitle from './Mixins/UpdatePageTitle';
import DateFormat from './Mixins/DateFormat';
import PreviewUploadedFile from './Mixins/PreviewUploadedFile';
import JsonViewer from './Mixins/JsonViewer';
import { BootstrapVue } from 'bootstrap-vue';
import VueLazyload from 'vue-lazyload';

Vue.use(VueLazyload, { preLoad: 1.3, attempt: 1 });
Vue.use(BootstrapVue);
Vue.use(InertiaPlugin);
Vue.mixin(UpdatePageTitle);
Vue.mixin(DateFormat);
Vue.mixin(PreviewUploadedFile);
Vue.mixin(JsonViewer);
Vue.mixin({ methods: { route } });

Vue.config.productionTip = false;

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
