import Vue from "vue";
import VueRouter from "vue-router";
import About from "../views/general/About.vue";
import Home from "../views/general/Home.vue";
import Login from "../views/general/Login.vue";
import Profile from "../views/general/Profile.vue";
import Register from "../views/general/Register.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "About",
        name: "about",
        component: About,
    },
    {
        path: "Home",
        name: "home",
        component: Home,
    },
    {
        path: "Login",
        name: "login",
        component: Login,
    },
    {
        path: "Profile",
        name: "profile",
        component: Profile,
    },
    {
        path: "Register",
        name: "register",
        component: Register,
    },
];

const router = new VueRouter({
    mode: "history",
    routes,
});

export default router;
