/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import _ from 'lodash';
Object.defineProperty(Vue.prototype, '_', { value: _ });

import Toasted from 'vue-toasted';
Vue.use(Toasted)

import VModal from 'vue-js-modal'
Vue.use(VModal, { dynamic: true, dynamicDefaults: { clickToClose: false } });