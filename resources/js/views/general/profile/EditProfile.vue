<template>
    <div class="root-div">
        <profile-header-bar></profile-header-bar>

        <main class="container rounded mt-5 mb-5">
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
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                        /><span class="font-weight-bold"
                            >{{ firstname }} {{ lastname }}</span
                        >
                        <span v-if="nickname" class="font-weight-bold"
                            >({{ nickname }})</span
                        >
                        <span class="text-black-50">{{ email }}</span
                        ><span>8,000 متابع </span>
                        <span>9,000 يتابع </span>
                    </div>
                    <div class="mar-1">
                        <label for="" class="form-label">حول</label>
                        <textarea
                            name="about"
                            v-model="about"
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
                                        v-model="firstname"
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
                                        v-model="lastname"
                                    />
                                </div>

                                <div class="col-md-12">
                                    <label class="labels form-label"
                                        >اللقب</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="اللقب"
                                        name="nickname"
                                        v-model="nickname"
                                    />
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">حول</label>
                                    <textarea
                                        name="about"
                                        v-model="about"
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
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
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
                                <div class="mt-1">
                                    <button
                                        @click="addPhone()"
                                        class="btn btn-success"
                                        type="button"
                                    >
                                        اضافة رقم الهاتف
                                    </button>
                                    <modal-snippet
                                        launchButtonName="عرض جميع أرقام الهواتف"
                                        closeButtonName="إغلاق"
                                        confirmButtonName="حفظ"
                                        title="أرقام هواتفك"
                                        launchButtonClass="btn btn-success"
                                        confirmButtonClass="btn btn-warning"
                                        name="editPhones"
                                        confirmAndClosed
                                        @onLaunchButtonClick="
                                            getProfilePhones(profile_id)
                                        "
                                    >
                                        <ul class="list-group list">
                                            <li
                                                class="text-center list-group-item"
                                                v-for="(phone, i) in phones"
                                                :key="i"
                                            >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="رقم هاتف"
                                                    name="phones"
                                                    v-model="phones[i].phone"
                                                />
                                                <button
                                                    @click="
                                                        deletePhone(phone.id)
                                                    "
                                                    class="btn btn-danger"
                                                >
                                                    حذف
                                                </button>
                                            </li>
                                        </ul>
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
                                        v-model="birthdate"
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
                                        v-model="country"
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
                                        v-model="state"
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
                                        v-model="city"
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
                                        v-model="street"
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
                                        v-model="website"
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
                                            v-model="university"
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
                                            v-model="degree"
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
                                            v-model="study_type"
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
                                    @confirmEvent="savePersonalInfo()"
                                >
                                    هل أنت متأكد من حفظ الملف الشخصي
                                </modal-snippet>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer-bar></footer-bar>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../../helpers/auth";
import ModalSnippet from "../../../components/bootstrap/ModalSnippet.vue";
import ProfileHeaderBar from "../../../components/layouts/ProfileHeaderBar.vue";
import FooterBar from "../../../components/layouts/FooterBar.vue";

export default {
    data() {
        return {
            firstname: "",
            lastname: "",
            nickname: "",
            birthdate: "",
            email: "",
            about: "",
            avatar: "",
            background_photo: "",
            website: "",
            country: "",
            state: "",
            city: "",
            street: "",
            university: "",
            degree: "",
            study_type: "",
            skill_name: "",
            start: "",
            end: "",
            position: "",
            company_name: "",
            phone: "",
            phones: "",
            followers: "",
            experiences: "",
            skills: "",
            user_id: 0,
            profile_id: 0,
        };
    },
    methods: {
        savePersonalInfo(userId = this.user_id) {
            var vm = this;

            axios
                .put(
                    "/api/profiles/" + userId + "",
                    {
                        firstname: vm.firstname,
                        lastname: vm.lastname,
                        nickname: vm.nickname,
                        birthdate: vm.birthdate,
                        about: vm.about,
                        avatar: vm.avatar,
                        website: vm.website,
                        country: vm.country,
                        city: vm.city,
                        state: vm.state,
                        street: vm.street,
                        university: vm.university,
                        degree: vm.degree,
                        study_type: vm.study_type,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
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
        getProfilePhones(profileId) {
            var vm = this;

            axios
                .get("/api/profile-phones/" + profileId + "/phones", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.phones = response.data;
                })
                .catch(function (error) {
                    console.log(error.response);
                    var errors = error.response.data.errors;
                });
        },
        addPhone() {
            var vm = this;

            axios
                .post(
                    "/api/profile-phones",
                    {
                        phone: vm.phone,
                        user_id: vm.user_id,
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
        deletePhone(phoneId) {
            var vm = this;

            axios
                .delete(
                    "/api/profile-phones/" + phoneId,

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error.response);
                    var errors = error.response.data.errors;
                });
        },
        updatePhones() {
            var vm = this;

            axios
                .put(
                    "/api/profile-phones",
                    {
                        phone: vm.phone,
                        user_id: vm.user_id,
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
                        text: "تم حفظ أرقام الهواتف بنجاح",
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
        getProfileInfo() {
            var vm = this;

            axios
                .get("/api/profiles/" + vm.$route.params.id + "", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.profile_id = response.data.id;
                    vm.firstname = response.data.firstname;
                    vm.lastname = response.data.lastname;
                    vm.nickname = response.data.nickname;
                    vm.birthdate = response.data.birthdate;
                    vm.about = response.data.about;
                    vm.avatar = response.data.avatar;
                    vm.background_photo = response.data.background_photo;
                    vm.website = response.data.website;
                    vm.country = response.data.country;
                    vm.city = response.data.city;
                    vm.state = response.data.state;
                    vm.street = response.data.street;
                    vm.university = response.data.university;
                    vm.degree = response.data.degree;
                    vm.study_type = response.data.study_type;
                    vm.phones = response.data.phones;
                    vm.skills = response.data.skills;
                    vm.experiences = response.data.experiences;
                    vm.email = response.data.user.email;
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
        FooterBar,
        ProfileHeaderBar,
    },
    created() {
        let userId = JSON.parse(localStorage.getItem("user")).id;
        this.user_id = userId;
        this.getProfileInfo();
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

.profile-button {
    /* background: rgb(99, 39, 120); */
    box-shadow: none;
    border: none;
}

.profile-button:hover {
    /* background: #682773; */
}

.profile-button:focus {
    /* background: #198754; */
    box-shadow: none;
}

.profile-button:active {
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
