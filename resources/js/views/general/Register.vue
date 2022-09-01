<template>
    <div>
        <header-bar></header-bar>

        <main class="container d-flex flex-column align-items-center">
            <form @submit.prevent="register()" class="">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="الإسم الأول"
                        v-model="firstname"
                    />
                </div>
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="إسم العائلة"
                        v-model="lastname"
                    />
                </div>
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="البريد الإلكتروني @example.com"
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

                <div class="input-group mb-3">
                    <input
                        type="password"
                        class="form-control"
                        placeholder="كلمة المرور إعادة كتابة كلمة المرور"
                        v-model="repassword"
                    />
                </div>
                <button class="btn btn-success offset-3" type="submit">
                    إنشاء حساب
                </button>
                <div v-if="success" class="alert alert-success text-center">
                    تم إنشاء الحساب بنجاح
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
            firstname: "",
            lastname: "",
            email: "",
            password: "",
            repassword: "",
            success: null,
        };
    },
    components: {
        HeaderBar,
        FooterBar,
    },
    methods: {
        register() {
            axios
                .post(
                    "/api/users",
                    {
                        firstname: this.firstname,
                        lastname: this.lastname,
                        email: this.email,
                        password: this.password,
                        repassword: this.repassword,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then((response) => {
                    console.log(response);
                    this.success = true;
                    localStorage.setItem("token", response.data.data.token);
                    this.$router.push({ name: "profile" });
                })
                .catch((error) => {
                    console.log(error.response);
                    this.success = false;
                });
        },
    },
};
</script>

<style scoped>
.alert {
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
