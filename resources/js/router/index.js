import Vue from "vue";
import VueRouter from "vue-router";
import About from "../views/guest/About.vue";
import Home from "../views/guest/Home.vue";
import Login from "../views/guest/Login.vue";
import Profile from "../views/user/profile/Profile.vue";
import EditProfile from "../views/user/profile/EditProfile.vue";
import Register from "../views/guest/Register.vue";
import Contact from "../views/guest/Contact.vue";
import Feed from "../views/user/Feed.vue";
import Notifications from "../views/user/profile/Notifications.vue";
import Connections from "../views/user/profile/Connections.vue";
import Post from "../views/user/Post.vue";
import Jobs from "../views/user/Jobs.vue";
import ShowJob from "../views/user/ShowJob.vue";
import Search from "../views/user/Search.vue";

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
        path: "/feed",
        name: "feed",
        component: Feed,
    },
    {
        path: "/search/:pattern",
        name: "search",
        component: Search,
    },
    {
        path: "/notifications",
        name: "notifications",
        component: Notifications,
    },
    {
        path: "/connections",
        name: "connections",
        component: Connections,
    },
    {
        path: "/jobs",
        name: "jobs",
        component: Jobs,
    },
    {
        path: "/posts/:id",
        name: "post",
        component: Post,
    },
    {
        path: "/jobs/:id",
        name: "job.show",
        component: ShowJob,
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
    const routes = [
        "profile",
        "profile.edit",
        "feed",
        "notifications",
        "connections",
        "post",
        "jobs",
        "job.show",
        "search",
    ];
    if (localStorage.getItem("user") == null) {
        if (routes.includes(to.name)) next({ name: "login" });
    } else {
        const userId = JSON.parse(localStorage.getItem("user")).id;

        if (!routes.includes(to.name))
            next({
                name: "feed",
                // params: {
                //     id: userId,
                // },
            });
        if (to.name == "profile.edit" && to.params["id"] != userId)
            return next({
                name: "profile.edit",
                params: {
                    id: userId,
                },
            });
    }

    next();
});

export default router;
