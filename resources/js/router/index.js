import Vue from "vue";
import VueRouter from "vue-router";
import About from "../views/guest/About.vue";
import Home from "../views/guest/Home.vue";
import Login from "../views/guest/Login.vue";
import Profile from "../views/user/profile/Profile.vue";
import EditProfile from "../views/user/profile/EditProfile.vue";
import Register from "../views/guest/Register.vue";
import Contact from "../views/guest/Contact.vue";

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
        path: "/profile/:id",
        name: "profile",
        component: Profile,
    },
    {
        path: "/profile/:id/edit",
        name: "profile.edit",
        component: EditProfile,
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
    const routes = ["profile", "profile.edit"];
    const profileId = JSON.parse(localStorage.getItem("user")).profile_id;
    if (localStorage.getItem("user") == null) {
        if (routes.includes(to.name)) next({ name: "login" });
    } else {
        if (!routes.includes(to.name))
            next({
                name: "profile",
                params: {
                    id: profileId,
                },
            });
        if (to.name == "profile.edit" && to.params["id"] != profileId)
            return next({
                name: "profile.edit",
                params: {
                    id: profileId,
                },
            });
    }

    next();
});

export default router;
