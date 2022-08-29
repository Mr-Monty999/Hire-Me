<template>
    <div>
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
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'home' }"
                                active-class="active"
                                >الرئيسية</router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'login' }"
                                active-class="active"
                                >تسجيل دخول</router-link
                            >
                        </li>
                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'register' }"
                                active-class="active"
                                >إنضمام</router-link
                            >
                        </li>
                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'about' }"
                                active-class="active"
                                >حول</router-link
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "NavBar",
};
</script>

<style scoped>
a {
    text-decoration: none;
}
</style>
