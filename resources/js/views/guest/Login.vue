<template>
    <div>
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
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";

export default {
    data() {
        return {
            email: "",
            password: "",
            success: null,
        };
    },
    components: {},
    methods: {
        login() {
            var vm = this;

            axios
                .post(
                    "/api/users/login",
                    {
                        email: vm.email,
                        password: vm.password,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    localStorage.setItem(
                        "user",
                        JSON.stringify(response.data.data)
                    );

                    vm.success = true;
                    // vm.$router.push({
                    //     name: "profile",
                    //     params: {
                    //         id: response.data.id,
                    //     },
                    // });
                    location.reload();
                })
                .catch(function (error) {
                    vm.success = false;
                    console.log(error.response);
                    var errors = error.response.data.errors;
                    for (const error in errors) {
                        vm.$notify({
                            title: "خطأ:لم يتم تنفيذ",
                            text: errors[error][0],
                            type: "error",
                        });
                    }
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
