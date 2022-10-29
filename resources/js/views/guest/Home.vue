<template>
    <div>
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
    </div>
</template>

<script>
import axios from "axios";

export default {
    components: {},
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
