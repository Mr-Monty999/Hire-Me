<template>
    <div>
        <header-bar></header-bar>

        <main class="container d-flex flex-column align-items-center">
            <form @submit.prevent="register()" class="">
                <div class="form-floating mb-3">
                    <input
                        id="firstname"
                        type="text"
                        class="form-control"
                        placeholder="الإسم الأول"
                        v-model="firstname"
                    />
                    <label for="firstname">الإسم الأول</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="إسم العائلة"
                        v-model="lastname"
                        id="lastname"
                    />
                    <label for="lastname">إسم العائلة</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="date"
                        class="form-control"
                        placeholder="تاريخ الميلاد"
                        v-model="birthdate"
                        id="birthdate"
                    />
                    <label for="birthdate">تاريخ الميلاد</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="البريد الإلكتروني @example.com"
                        v-model="email"
                        id="email"
                    />
                    <label for="email">البريد الإلكتروني</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="password"
                        class="form-control"
                        placeholder="كلمة المرور"
                        v-model="password"
                        id="password"
                    />
                    <label for="password">كلمة المرور</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="password"
                        class="form-control"
                        placeholder="إعادة كتابة كلمة المرور"
                        v-model="repassword"
                        id="repassword"
                    />
                    <label for="repassword">إعادة كتابة كلمة المرور</label>
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
                    "/api/users/register",
                    {
                        email: vm.email,
                        password: vm.password,
                        repassword: vm.repassword,
                        firstname: vm.firstname,
                        lastname: vm.lastname,
                        birthdate: vm.birthdate,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then((response) => {
                    console.log(response);
                    vm.success = true;
                    localStorage.setItem("user", JSON.stringify(response.data));

                    // vm.$router.push({
                    //     name: "profile",
                    //     params: {
                    //         id: response.data.id,
                    //     },
                    // });

                    location.reload();
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
