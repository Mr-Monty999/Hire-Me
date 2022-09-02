<template>
    <header>
        <nav class="navbar navbar-expand-lg bg-success">
            <div class="container-fluid">
                <router-link class="navbar-brand" :to="{ name: 'home' }"
                    >شغلني</router-link
                >
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
                                exact
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
                        <!-- <li class="nav-item">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'contact' }"
                                active-class="active"
                                >تواصل معنا</router-link
                            >
                        </li> -->
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
    </header>
</template>

<script>
import axios from "axios";

export default {
    name: "HeaderBar",
};
</script>

<style scoped>
a {
    text-decoration: none;
    color: white;
}
</style>
