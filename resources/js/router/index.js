import Vue from "vue";
import VueRouter from "vue-router";
import About from "../views/general/About.vue";
import Home from "../views/general/Home.vue";
import Login from "../views/general/Login.vue";
import Profile from "../views/general/Profile.vue";
import Register from "../views/general/Register.vue";
import Contact from "../views/general/Contact.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/about",
        name: "about",
        component: About,
    },
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/profile",
        name: "profile",
        component: Profile,
    },
    {
        path: "/register",
        name: "register",
        component: Register,
    },
    {
        path: "/contact",
        name: "contact",
        component: Contact,
    },
];

const router = new VueRouter({
    mode: "history",
    routes,
});

router.beforeEach(function (to, from, next) {
    const routes = ["profile"];
    if (localStorage.getItem("token") == null) {
        if (routes.includes(to.name)) next({ name: "login" });
    } else {
        if (!routes.includes(to.name)) next({ name: "profile" });
    }

    next();
});

export default router;
