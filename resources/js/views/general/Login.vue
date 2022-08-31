<template>
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
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            email: "",
            password: "",
            success: null,
        };
    },
    methods: {
        login() {
            axios
                .post("/api/users/login", {
                    email: this.email,
                    password: this.password,
                })
                .then(function (response) {
                    console.log(response);
                    // this.success = true;
                    this.$router.push({ name: "profile" });
                })
                .catch(function (error) {
                    // this.success = false;
                    console.log(error.response);
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
