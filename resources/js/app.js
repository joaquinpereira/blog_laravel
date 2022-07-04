require('./bootstrap');

import Vue from 'vue';

import router from './routes';

Vue.component('post-header', require('./components/PostHeader.vue').default);
Vue.component('post-list', require('./components/PostList.vue').default);
Vue.component('post-list-item', require('./components/PostListItem.vue').default);
Vue.component('post-link', require('./components/PostLink.vue').default);
Vue.component('nav-bar', require('./components/NavBar.vue').default);
Vue.component('tags', require('./components/Tags.vue').default);
Vue.component('category-link', require('./components/CategoryLink.vue').default);
Vue.component('disqus-comments', require('./components/DisqusComments.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('pagination-links', require('./components/PaginationLinks.vue').default);
Vue.component('social-links', require('./components/SocialLinks.vue').default);
Vue.component('contact-form', require('./components/ContactForm.vue').default);
Vue.component('footer-nav', require('./components/FooterNav.vue').default);

const app = new Vue({
    el: '#app',
    router
});
