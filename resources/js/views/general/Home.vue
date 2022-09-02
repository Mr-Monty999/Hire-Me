<template>
    <div>
        <header-bar></header-bar>
        <main class="container d-flex flex-column align-items-center">
            <img src="../../assets/images/hello2.png" alt="" />
            <h1>مرحبا بكم في موقع شغلني</h1>
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

<style scoped>
img {
    width: 60%;
}
@media only screen and (min-width: 0px) {
    img {
        width: 100%;
    }
}
@media only screen and (min-width: 500px) {
    img {
        width: 70%;
    }
}
@media only screen and (min-width: 1200px) {
    img {
        width: 50%;
    }
}
a {
    margin-top: 20px;
}
</style>
