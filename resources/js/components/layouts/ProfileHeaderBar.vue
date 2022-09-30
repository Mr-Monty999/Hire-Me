<template>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">شغلني</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul
                        class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center align-items-center"
                    >
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <span>
                                    <span>{{ firstname }} {{ lastname }}</span>
                                    <img
                                        class="personal-photo"
                                        :src="previewAvatar"
                                        alt=""
                                    />
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link
                                        class="dropdown-item"
                                        :to="{
                                            name: 'feed',
                                        }"
                                        >الصفحة الرئيسية</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        class="dropdown-item"
                                        :to="{
                                            name: 'profile',
                                            params: { id: profile_id },
                                        }"
                                        >الملف الشخصي</router-link
                                    >
                                </li>
                                <li hidden>
                                    <a class="dropdown-item" href="#"
                                        >الشركات</a
                                    >
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <button
                                        @click="logout()"
                                        class="dropdown-item"
                                    >
                                        تسجيل خروج
                                    </button>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item"
                            @click="readAllNotifications(profile_id)"
                        >
                            <router-link
                                class="nav-link position-relative"
                                :to="{
                                    name: 'notifications',
                                }"
                            >
                                <span>
                                    <i class="fa-solid fa-bell"></i>
                                </span>
                                <span
                                    v-if="unreadedNotifications > 0"
                                    class="position-absolute translate-middle badge rounded-pill bg-danger notificate"
                                >
                                    {{ unreadedNotifications }}+
                                    <span class="visually-hidden"
                                        >unread notifications</span
                                    >
                                </span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link
                                class="nav-link position-relative"
                                :to="{
                                    name: 'connections',
                                }"
                            >
                                <span>
                                    <i class="fa-solid fa-user-group"></i>
                                </span>
                                <span
                                    v-if="incommingConnections > 0"
                                    class="position-absolute translate-middle badge rounded-pill bg-danger notificate"
                                >
                                    {{ incommingConnections }}+
                                    <span class="visually-hidden"
                                        >unread messages</span
                                    >
                                </span>
                            </router-link>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input
                            class="form-control me-2"
                            type="search"
                            placeholder="بحث"
                            aria-label="Search"
                        />
                    </form>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";

export default {
    name: "ProfileHeaderBar",
    components: {},
    data() {
        return {
            firstname: "",
            lastname: "",
            profile_id: "",
            avatar: "",
            user_id: "",
            unreadedNotifications: 0,
            incommingConnections: 0,
        };
    },
    methods: {
        logout() {
            var vm = this;
            localStorage.removeItem("user");

            axios
                .post(
                    "/api/users/logout",
                    {},
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    // vm.$router.push({ name: "login" });
                    location.reload();
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        viewProfile() {
            var vm = this;

            vm.$router.push({ name: "profile", params: { id: vm.profile_id } });
        },

        getProfileInfo(profileId = this.profile_id) {
            var vm = this;

            axios
                .get("/api/profiles/" + profileId + "/info", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.firstname = response.data.data.firstname;
                    vm.lastname = response.data.data.lastname;
                    vm.avatar = response.data.data.avatar;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        getHeaderCounts(profileId) {
            var vm = this;
            axios
                .get("/api/profiles/" + profileId + "/header/counts", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.unreadedNotifications =
                        response.data.data.unreaded_notifications_count;
                    vm.incommingConnections =
                        response.data.data.incoming_connections_count;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        readAllNotifications(profileId) {
            var vm = this;
            axios
                .post(
                    "/api/profiles/" + profileId + "/notifications/readall",
                    {},
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.unreadedNotifications = 0;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
    },
    computed: {
        previewAvatar() {
            if (!this.avatar) {
                return "/images/assets/personal.jpg";
            }
            return this.avatar;
        },
    },
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
        this.profile_id = JSON.parse(localStorage.getItem("user")).profile_id;
        this.getProfileInfo();
        this.getHeaderCounts(this.profile_id);
    },
};
</script>

<style scoped>
.personal-photo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.notificate {
    font-size: 10px;
    left: 10% !important;
    top: 30% !important;
}
.fa-solid {
    font-size: 24px;
}
</style>
