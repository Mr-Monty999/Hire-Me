<template>
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
</template>

<script>
import axios from "axios";

export default {};
</script>

<style scoped></style>
