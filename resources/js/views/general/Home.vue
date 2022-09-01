<template>
    <div>
        <header-bar></header-bar>
        <main class="container d-flex flex-column align-items-center">
            <!-- <img src="../assets/images/hello.png" alt="" /> -->
            <h1>مرحبا بكم</h1>
            <h3>سجل الأن وأحصل على وظيفة</h3>
            <div>
                <router-link :to="{ name: 'login' }" class="btn btn-success"
                    >تسجيل دخول</router-link
                >
                <router-link :to="{ name: 'register' }" class="btn btn-success"
                    >إنشاء حساب جديد</router-link
                >
            </div>
        </main>
        <footer-bar></footer-bar>
    </div>
</template>

<script>
import axios from "axios";
import HeaderBar from "../../components/layouts/HeaderBar.vue";
import FooterBar from "../../components/layouts/FooterBar.vue";

export default {
    components: {
        HeaderBar,
        FooterBar,
    },
};
</script>

<style scoped></style>
