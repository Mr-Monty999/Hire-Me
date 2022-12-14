/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/css/bootstrap.rtl.min.css";
import "jquery";
import "normalize.css";
import "./assets/css/main.css";
import "./assets/css/all.min.css";

import MainLayout from "./components/layouts/MainLayout.vue";
import router from "./router/index";
import Vue from "vue";
import Notifications from "vue-notification";
import VModal from "vue-js-modal";
import TextareaAutosize from "vue-textarea-autosize";

Vue.use(TextareaAutosize);
Vue.use(VModal);
Vue.use(Notifications);

Vue.filter("toNumber", function (value) {
    return Number(value).toLocaleString();
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    components: {
        MainLayout,
    },
});
