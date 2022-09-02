<template>
    <div>
        <header-bar></header-bar>

        <main class="container d-flex flex-column align-items-center">
            <form @submit.prevent="login()">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="البريد الإلكتروني"
                        v-model="email"
                    />
                </div>

                <div class="input-group mb-3">
                    <input
                        type="password"
                        class="form-control"
                        placeholder="كلمة المرور"
                        v-model="password"
                    />
                </div>

                <button class="btn btn-success offset-3" type="submit">
                    تسجيل دخول
                </button>

                <div v-if="success" class="alert alert-success text-center">
                    تم تسجيل الدخول بنجاح
                </div>
                <div
                    v-else-if="success == false"
                    class="alert alert-danger text-center"
                >
                    خطأ الرجاء التحقق من البيانات
                </div>
            </form>
        </main>
        <footer-bar></footer-bar>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";
import HeaderBar from "../../components/layouts/HeaderBar.vue";
import FooterBar from "../../components/layouts/FooterBar.vue";

export default {
    data() {
        return {
            email: "",
            password: "",
            success: null,
        };
    },
    components: {
        HeaderBar,
        FooterBar,
    },
    methods: {
        login() {
            axios
                .post(
                    "/api/users/login",
                    {
                        email: this.email,
                        password: this.password,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    localStorage.setItem("user", JSON.stringify(response.data));

                    // this.success = true;
                    // this.$router.push({ name: "profile" });
                    location.reload();
                })
                .catch(function (error) {
                    // this.success = false;
                    console.log(error.response);
                });
        },
    },
    beforeCreate() {},
};
</script>

<style scoped>
.alert {
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
