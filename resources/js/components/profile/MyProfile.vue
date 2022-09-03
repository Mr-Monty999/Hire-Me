<template>
    <div>
        <main class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div
                        class="d-flex flex-column align-items-center text-center p-3 py-5"
                    >
                        <img
                            class="rounded-circle mt-5"
                            width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                        /><span class="font-weight-bold"
                            >{{ firstname }} {{ lastname }}</span
                        ><span class="text-black-50">{{ email }}</span
                        ><span>8,000 متابع </span>
                    </div>
                    <div>
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
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div
                            class="d-flex justify-content-between align-items-center mb-3"
                        >
                            <h4 class="text-right">إعدادات الملف الشخصي</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">الإسم الأول</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    placeholder="الإسم الأول"
                                    name="firstname"
                                    v-model="firstname"
                                />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">إسم العائلة</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    placeholder="إسم العائلة"
                                    name="lastname"
                                    v-model="lastname"
                                />
                            </div>

                            <div class="col-md-6">
                                <label class="labels">اللقب</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    placeholder="اللقب"
                                    name="nickname"
                                    v-model="nickname"
                                />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels"> رقم الهاتف</label
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
                                    @click="addPhone"
                                    class="btn btn-success"
                                    type="button"
                                >
                                    اضافة رقم الهاتف
                                </button>
                            </div>

                            <div class="col-md-12">
                                <label class="labels">تاريخ الميلاد</label
                                ><input
                                    type="date"
                                    class="form-control"
                                    placeholder="تاريخ الميلاد"
                                    name="birthdate"
                                    v-model="birthdate"
                                />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">الدولة</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    placeholder="الدولة"
                                    name="country"
                                    v-model="country"
                                />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">الولاية</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    placeholder="الولاية"
                                    name="state"
                                    v-model="state"
                                />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">المدينة</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    placeholder="المدينة"
                                    name="city"
                                    v-model="city"
                                />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">الشارع</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    placeholder="الشارع"
                                    name="street"
                                    v-model="street"
                                />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">الموقع الإلكتروني</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    placeholder="الموقع الإكتروني"
                                    name="website"
                                    v-model="website"
                                />
                            </div>
                            <div class="p-3 py-5">
                                <div
                                    class="d-flex justify-content-between align-items-center experience"
                                >
                                    <h3>التعليم</h3>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">الجامعة</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="الجامعة"
                                        name="university"
                                        v-model="university"
                                    />
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">الدرجة العلمية</label
                                    ><input
                                        type="text"
                                        class="form-control"
                                        placeholder="الدرجة العلمية"
                                        name="degree"
                                        v-model="degree"
                                    />
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">نوع التخصص</label
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

                        <div class="mt-1 text-center">
                            <button
                                @click="savePersonalInfo()"
                                class="btn btn-success"
                                type="button"
                            >
                                حفظ
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div
                            class="d-flex justify-content-between align-items-center experience"
                        >
                            <h3>الخبرة</h3>
                        </div>
                        <br />
                        <div class="col-md-12">
                            <label class="labels">إسم الشركة</label
                            ><input
                                type="text"
                                class="form-control"
                                placeholder="إسم الشركة"
                                name="company_name"
                                v-model="company_name"
                            />
                        </div>
                        <div class="col-md-12">
                            <label class="labels">بداية العمل</label
                            ><input
                                type="date"
                                class="form-control"
                                placeholder="بداية العمل"
                                name="start"
                                v-model="start"
                            />
                        </div>
                        <div class="col-md-12">
                            <label class="labels">النهاية</label
                            ><input
                                type="date"
                                class="form-control"
                                placeholder="النهاية"
                                name="end"
                                v-model="end"
                            />
                        </div>
                        <div class="col-md-12">
                            <label class="labels">نوع العمل</label
                            ><input
                                type="text"
                                class="form-control"
                                placeholder="نوع العمل"
                                name="position"
                                v-model="position"
                            />
                        </div>
                        <div class="mt-1">
                            <button class="btn btn-success" type="button">
                                اضافة الخبرة
                            </button>
                        </div>

                        <div class="p-3 py-5">
                            <div
                                class="d-flex justify-content-between align-items-center experience"
                            >
                                <h3>المهارات</h3>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">إسم المهارة</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    placeholder="إسم المهارة"
                                    name="skill_name"
                                    v-model="skill_name"
                                />
                            </div>
                            <div class="mt-1">
                                <button class="btn btn-success" type="button">
                                    اضافة المهارة
                                </button>
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
import headerAuth from "../../helpers/auth";

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
            success: null,
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

                    vm.success = true;
                })
                .catch(function (error) {
                    vm.success = false;
                    console.log(error.response);
                });
        },
        addExperience() {
            var vm = this;

            axios
                .post(
                    "/api/experiences",
                    {
                        company_name: vm.company_name,
                        start: vm.start,
                        end: vm.end,
                        position: vm.position,
                        user_id: vm.user_id,
                    },

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);

                    vm.success = true;
                })
                .catch(function (error) {
                    vm.success = false;
                    console.log(error.response);
                });
        },
        addSkill() {
            var vm = this;

            axios
                .post(
                    "/api/skills",
                    {
                        name: this.skill_name,
                        user_id: vm.user_id,
                    },

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);

                    vm.success = true;
                })
                .catch(function (error) {
                    vm.success = false;
                    console.log(error.response);
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

                    vm.success = true;
                })
                .catch(function (error) {
                    vm.success = false;
                    console.log(error.response);
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
    background: rgb(99, 39, 120);
}

.form-control:focus {
    box-shadow: none;
    border-color: #ba68c8;
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none;
}

.profile-button:hover {
    background: #682773;
}

.profile-button:focus {
    background: #198754;
    box-shadow: none;
}

.profile-button:active {
    background: #682773;
    box-shadow: none;
}

.back:hover {
    color: #682773;
    cursor: pointer;
}

.labels {
    font-size: 11px;
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
</style>
