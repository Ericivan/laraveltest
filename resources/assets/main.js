/**
 * Created by zhongzhiliang on 2018/2/6.
 */

import Vue from 'vue/dist/vue.js'

import App from './App.vue'

import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Example from './js/components/ExampleComponent.vue'


const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: [
        { path: '/example', component: Example }
    ]
})

new Vue(Vue.util.extend({ router }, App)).$mount('#app')