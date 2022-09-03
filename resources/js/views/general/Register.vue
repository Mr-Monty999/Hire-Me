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
                        type="date"
                        class="form-control"
                        placeholder="تاريخ الميلاد"
                        v-model="birthdate"
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
                        placeholder="إعادة كتابة كلمة المرور"
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
import HeaderBar from "../../components/layouts/HeaderBar.vue";
import FooterBar from "../../components/layouts/FooterBar.vue";
import headerAuth from "../../helpers/auth";

export default {
    data() {
        return {
            firstname: "",
            lastname: "",
            email: "",
            password: "",
            birthdate: "",
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
            var vm = this;
            axios
                .post(
                    "/api/users",
                    {
                        firstname: vm.firstname,
                        lastname: vm.lastname,
                        email: vm.email,
                        birthdate: vm.birthdate,
                        password: vm.password,
                        repassword: vm.repassword,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then((response) => {
                    console.log(response);
                    vm.success = true;
                    localStorage.setItem("user", JSON.stringify(response.data));

                    vm.$router.push({ name: "profile" });
                })
                .catch((error) => {
                    console.log(error.response);
                    vm.success = false;
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
