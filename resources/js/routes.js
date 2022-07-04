import Vue from 'vue';

import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes:[
        {
            name: 'home',
            path: '/',
            params: [':month',':year'],
            component: require('./views/Home.vue').default,
            props: true
        },
        {
            name: 'about',
            path: '/nosotros',
            component: require('./views/About').default
        },
        {
            name: 'archive',
            path: '/archivo',
            component: require('./views/Archive').default
        },
        {
            name: 'contact',
            path: '/contacto',
            component: require('./views/Contact').default
        },
        {
            name: 'post_show',
            path: '/blog/:url',
            component: require('./views/postShow').default,
            props: true
        },
        {
            name: 'category_posts',
            path: '/categorias/:category',
            component: require('./views/CategoryPosts').default,
            props: true
        },
        {
            name: 'tag_posts',
            path: '/tags/:tag',
            component: require('./views/TagPosts').default,
            props: true
        },
        {
            path: '*',
            component: require('./views/404').default
        }
    ],
    linkExactActiveClass: 'active',
    mode: 'history',
    scrollBehavior(){
        return {x:0, y:0}
    }
})