<template>
    <div class="root-div">
        <loading v-if="!loaded"></loading>
        <main v-if="loaded" class="container rounded mt-5 mb-5">
            <div class="row gap-4">
                <div class="col-md-3 border-right bg-mine">
                    <button @click="back()" class="btn btn-secondary">
                        رجوع
                    </button>
                    <div
                        class="d-flex flex-column align-items-center text-center p-3 py-5"
                    >
                        <img
                            class="rounded-circle mt-5"
                            width="150px"
                            :src="getAvatar"
                        /><span class="font-weight-bold text-break"
                            >{{ user.profile.firstname }}
                            {{ user.profile.lastname }}</span
                        >
                        <span
                            v-if="user.profile.nickname"
                            class="font-weight-bold text-break"
                            >({{ user.profile.nickname }})</span
                        >
                        <span
                            v-if="user.profile.user.email"
                            class="text-black-50 text-break"
                            >{{ user.profile.user.email }}</span
                        >
                    </div>
                    <div class="mar-1">
                        <label for="" class="form-label">حول</label>
                        <textarea
                            name="about"
                            v-model="user.profile.about"
                            class="form-control"
                            id=""
                            cols="50"
                            rows="5"
                            readonly
                            placeholder="عني"
                        ></textarea>
                    </div>
                </div>
                <div class="col-md-8 border-right bg-mine">
                    <div class="p-3 py-5">
                        <h4>إعدادات الملف الشخصي</h4>
                        <div class="">
                            <div class="d-flex mb-3"></div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >الإسم الأول</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="الإسم الأول"
                                        name="firstname"
                                        v-model="user.profile.firstname"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >إسم العائلة</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="إسم العائلة"
                                        name="lastname"
                                        v-model="user.profile.lastname"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >اللقب</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="اللقب"
                                        name="nickname"
                                        v-model="user.profile.nickname"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >النوع</label
                                    >
                                    <select
                                        class="form-control"
                                        name="gender"
                                        id="gender"
                                        v-model="user.profile.gender"
                                    >
                                        <option
                                            value="ذكر"
                                            v-if="user.profile.gender == 'ذكر'"
                                            selected
                                        >
                                            ذكر
                                        </option>
                                        <option value="ذكر" v-else>ذكر</option>

                                        <option
                                            value="أنثى"
                                            v-if="user.profile.gender == 'أنثى'"
                                            selected
                                        >
                                            انثى
                                        </option>
                                        <option value="أنثى" v-else>
                                            أنثى
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">حول</label>
                                    <textarea
                                        name="about"
                                        v-model="user.profile.about"
                                        class="form-control"
                                        id=""
                                        cols="50"
                                        rows="5"
                                        placeholder="عني"
                                    ></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label
                                            for="formFileSm"
                                            class="form-label"
                                            >الصورة الشخصية</label
                                        >
                                        <input
                                            class="form-control form-control-sm"
                                            id="formFileSm"
                                            type="file"
                                            name="avatar"
                                            @change="getFile"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h4>أرقام الهواتف</h4>

                                <ul class="list-group list">
                                    <li
                                        class="text-center list-group-item"
                                        v-for="(p, i) in user.phones"
                                        :key="i"
                                    >
                                        <p>{{ p.phone }}</p>
                                        <div
                                            class="d-flex justify-content-center gap-1"
                                        >
                                            <modal-snippet
                                                launchButtonName="حذف"
                                                closeButtonName="إغلاق"
                                                confirmButtonName="حذف"
                                                title="حذف رقم الهاتف"
                                                launchButtonClass="btn btn-danger"
                                                confirmButtonClass="btn btn-danger"
                                                :name="'deletePhone' + i"
                                                confirmAndClosed
                                                @confirmEvent="
                                                    deletePhone(user_id, p.id)
                                                "
                                            >
                                                هل أنت متأكد من حذف هذا الرقم
                                                {{ p.phone }} ؟
                                            </modal-snippet>
                                            <modal-snippet
                                                launchButtonName="تعديل"
                                                closeButtonName="إغلاق"
                                                confirmButtonName="تعديل"
                                                title="تعديل رقم الهاتف"
                                                launchButtonClass="btn btn-warning"
                                                confirmButtonClass="btn btn-warning"
                                                :name="'editPhone' + i"
                                                @closeEvent="
                                                    getUserPhones(user_id)
                                                "
                                                @confirmEvent="
                                                    updatePhone(
                                                        user_id,
                                                        p.id,
                                                        p.phone
                                                    )
                                                "
                                            >
                                                <div class="col-md-12">
                                                    <label
                                                        class="labels form-label"
                                                    >
                                                        رقم الهاتف</label
                                                    ><input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="رقم الهاتف"
                                                        name="phone"
                                                        v-model="p.phone"
                                                    />
                                                </div>
                                            </modal-snippet>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-1 gap-1">
                                    <modal-snippet
                                        launchButtonName="اضافة رقم هاتف"
                                        closeButtonName="إغلاق"
                                        confirmButtonName="إضافة"
                                        title="رقم هاتف جديد"
                                        launchButtonClass="btn btn-success"
                                        confirmButtonClass="btn btn-success"
                                        name="addPhone"
                                        confirmAndClosed
                                        @confirmEvent="addPhone(user_id, phone)"
                                    >
                                        <div class="col-md-12">
                                            <label class="labels form-label">
                                                رقم الهاتف</label
                                            ><input
                                                type="text"
                                                class="form-control"
                                                placeholder="رقم الهاتف"
                                                name="phone"
                                                v-model="phone"
                                            />
                                        </div>
                                    </modal-snippet>
                                </div>

                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >تاريخ الميلاد</label
                                    ><input
                                        type="date"
                                        class="form-control"
                                        placeholder="تاريخ الميلاد"
                                        name="birthdate"
                                        v-model="user.profile.birthdate"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >الدولة</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="الدولة"
                                        name="country"
                                        v-model="user.profile.country"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >الولاية</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="الولاية"
                                        name="state"
                                        v-model="user.profile.state"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >المدينة</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="المدينة"
                                        name="city"
                                        v-model="user.profile.city"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >الشارع</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="الشارع"
                                        name="street"
                                        v-model="user.profile.street"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <label class="labels form-label"
                                        >الموقع الإلكتروني</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="الموقع الإكتروني"
                                        name="website"
                                        v-model="user.profile.website"
                                    />
                                </div>
                                <div class="p-3 py-5 row">
                                    <div
                                        class="d-flex justify-content-between align-items-center experience"
                                    >
                                        <h3>التعليم</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels form-label"
                                            >الجامعة</label
                                        ><input
                                            type="text"
                                            class="form-control"
                                            placeholder="الجامعة"
                                            name="university"
                                            v-model="user.profile.university"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels form-label"
                                            >الدرجة العلمية</label
                                        ><input
                                            type="text"
                                            class="form-control"
                                            placeholder="الدرجة العلمية"
                                            name="degree"
                                            v-model="user.profile.degree"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels form-label"
                                            >نوع التخصص</label
                                        ><input
                                            type="text"
                                            class="form-control"
                                            placeholder="نوع التخصص"
                                            name="study_type"
                                            v-model="user.profile.study_type"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <modal-snippet
                                    launchButtonName="حفظ"
                                    closeButtonName="إغلاق"
                                    confirmButtonName="حفظ"
                                    title="حفظ الملف الشخصي"
                                    launchButtonClass="btn btn-warning col-4 offset-3"
                                    confirmButtonClass="btn btn-warning"
                                    name="savePersonalInfo"
                                    confirmAndClosed
                                    @confirmEvent="savePersonalInfo(user_id)"
                                >
                                    هل أنت متأكد من حفظ الملف الشخصي
                                </modal-snippet>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../../helpers/auth";
import headerFormAuth from "../../../helpers/formAuth";
import Loading from "../../../components/bootstrap/Loading.vue";

import ModalSnippet from "../../../components/bootstrap/ModalSnippet.vue";

export default {
    data() {
        return {
            user: {
                profile: {},
                phones: [],
            },
            phone: "",
            previewAvatar: "",
            user_id: 0,
            profile_id: 0,
            loaded: false,
        };
    },
    computed: {
        getAvatar() {
            if (this.previewAvatar)
                return URL.createObjectURL(this.previewAvatar);
            else if (this.user.profile.avatar) return this.user.profile.avatar;
            else return "/images/assets/personal.jpg";
        },
    },
    methods: {
        getFile(e) {
            this.previewAvatar = e.target.files[0];
            if (this.previewAvatar == undefined) this.previewAvatar = "";
        },
        savePersonalInfo(userId) {
            var vm = this;
            var data = new FormData();
            console.log(this.previewAvatar);

            data.append("firstname", vm.user.profile.firstname);
            data.append("lastname", vm.user.profile.lastname);
            data.append("nickname", vm.user.profile.nickname);
            data.append("gender", vm.user.profile.gender);
            data.append("birthdate", vm.user.profile.birthdate);
            data.append("about", vm.user.profile.about);
            data.append("avatar", vm.previewAvatar);
            data.append("website", vm.user.profile.website);
            data.append("country", vm.user.profile.country);
            data.append("city", vm.user.profile.city);
            data.append("state", vm.user.profile.state);
            data.append("street", vm.user.profile.street);
            data.append("university", vm.user.profile.university);
            data.append("degree", vm.user.profile.degree);
            data.append("study_type", vm.user.profile.study_type);
            data.append("_method", "put");
            axios
                .post("/api/users/" + userId + "/profile", data, {
                    headers: headerFormAuth,
                })
                .then(function (response) {
                    vm.user.profile.avatar = response.data.data.avatar;
                    console.log(response);
                    vm.$notify({
                        title: "نجاح",
                        text: "تم حفظ الملف الشخصي بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
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
        getUserPhones(userId) {
            var vm = this;

            axios
                .get("/api/users/" + userId + "/phones", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.user.phones = response.data.data;
                })
                .catch(function (error) {
                    console.log(error.response);
                    var errors = error.response.data.errors;
                });
        },
        addPhone(userId, myPhone) {
            var vm = this;

            axios
                .post(
                    "/api/users/" + userId + "/phones",
                    {
                        phone: myPhone,
                    },

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.user.phones.push(response.data.data);
                    vm.phone = "";
                    vm.$notify({
                        title: "نجاح",
                        text: "تم إضافة رقم الهاتف بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
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
        deletePhone(userId, phoneId) {
            var vm = this;
            var phoneIndex = vm.user.phones.findIndex((el) => el.id == phoneId);
            // vm.deletedPhones.push(vm.phones[phoneIndex]);
            vm.user.phones.splice(phoneIndex, 1);
            axios
                .delete(
                    "/api/users/" + userId + "/phones/" + phoneId,

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.phone = "";
                    vm.$notify({
                        title: "نجاح",
                        text: "تم حذف رقم الهاتف بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
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
        updatePhone(userId, phoneId, value) {
            var vm = this;
            axios
                .put(
                    "/api/users/" + userId + "/phones/" + phoneId,
                    {
                        phone: value,
                    },

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.phone = "";
                    vm.$notify({
                        title: "نجاح",
                        text: "تم تعديل رقم الهاتف بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
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
        getUserProfile(userId) {
            var vm = this;

            axios
                .get("/api/users/" + userId + "/profile", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);

                    vm.user.profile = response.data.data;
                    for (const key in vm.user.profile) {
                        if (
                            !vm.user.profile[key] ||
                            vm.user.profile[key] == null
                        )
                            vm.user.profile[key] = "";
                    }
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        resetData() {},
        back() {
            history.back();
        },
    },
    components: {
        ModalSnippet,
        Loading,
    },
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
        this.profile_id = JSON.parse(localStorage.getItem("user")).profile_id;
        this.getUserProfile(this.$route.params.id);
        this.getUserPhones(this.$route.params.id);
    },
    mounted: function () {
        let vm = this;
        this.$nextTick(function () {
            setTimeout(function () {
                vm.loaded = true;
            }, 1000);
        });
    },
};
</script>

<style scoped>
body {
    /* background: rgb(99, 39, 120); */
}

.form-control:focus {
    box-shadow: none;
    /* border-color: #ba68c8; */
}

.user-button {
    /* background: rgb(99, 39, 120); */
    box-shadow: none;
    border: none;
}

.user-button:hover {
    /* background: #682773; */
}

.user-button:focus {
    /* background: #198754; */
    box-shadow: none;
}

.user-button:active {
    /* background: #682773; */
    box-shadow: none;
}

.back:hover {
    /* color: #682773; */
    cursor: pointer;
}

.labels {
    font-size: 16px;
}

.add-experience:hover {
    background: #ba68c8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #ba68c8;
}

textarea {
    resize: none;
}
.alert {
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
