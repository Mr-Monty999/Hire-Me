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
                                        src="https://cdn.pixabay.com/photo/2017/02/04/12/25/man-2037255_960_720.jpg"
                                        alt=""
                                    />
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link
                                        class="dropdown-item"
                                        :to="{
                                            name: 'profile',
                                            params: { id: user_id },
                                        }"
                                        >الملف الشخصي</router-link
                                    >
                                </li>
                                <li>
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
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link position-relative"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <span>
                                    <i class="fa-solid fa-bell"></i>
                                </span>
                                <span
                                    class="position-absolute top-0 start-3 translate-middle badge rounded-pill bg-danger"
                                >
                                    1+
                                    <span class="visually-hidden"
                                        >unread messages</span
                                    >
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">إشعار</a>
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <a class="dropdown-item" href="#">إشعار</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">رابط</a>
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
            user_id: "",
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

            vm.$router.push({ name: "profile", params: { id: vm.user_id } });
        },

        getProfileInfo(userId = this.user_id) {
            var vm = this;

            axios
                .get("/api/profiles/" + userId + "", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.firstname = response.data.firstname;
                    vm.lastname = response.data.lastname;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
    },

    created() {
        let userId = JSON.parse(localStorage.getItem("user")).id;
        this.user_id = userId;
        this.getProfileInfo();
    },
};
</script>

<style scoped>
.personal-photo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
</style>
