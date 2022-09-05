<template>
    <div>
        <main class="container rounded mt-5 mb-5">
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

                            <div class="col-md-12">
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
                            <div
                                class="alert alert-success text-center"
                                v-if="addPhoneSuccess"
                            >
                                تم اضافة الرقم بنجاح
                            </div>
                            <div
                                class="alert alert-danger text-center"
                                v-else-if="addPhoneSuccess == false"
                            >
                                الرجاء التحقق من البيانات
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
                        <div
                            class="alert alert-success text-center"
                            v-if="saveSuccess"
                        >
                            تم حفظ الملف الشخصي بنجاح
                        </div>
                        <div
                            class="alert alert-danger text-center"
                            v-else-if="saveSuccess == false"
                        >
                            الرجاء التحقق من البيانات
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div
                            class="d-flex justify-content-between align-items-center experience"
                        >
                            <h3>الخبرات</h3>
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
                            <label class="labels">بداية المنصب</label
                            ><input
                                type="date"
                                class="form-control"
                                placeholder="بداية المنصب"
                                name="start"
                                v-model="start"
                            />
                        </div>
                        <div class="col-md-12">
                            <label class="labels">نهاية المنصب</label
                            ><input
                                type="date"
                                class="form-control"
                                placeholder="نهاية المنصب"
                                name="end"
                                v-model="end"
                            />
                        </div>
                        <div class="col-md-12">
                            <label class="labels">المنصب</label
                            ><input
                                type="text"
                                class="form-control"
                                placeholder="المنصب"
                                name="position"
                                v-model="position"
                            />
                        </div>
                        <div class="mt-1">
                            <button
                                @click="addExperience"
                                class="btn btn-success"
                                type="button"
                            >
                                اضافة الخبرة
                            </button>
                        </div>
                        <div
                            class="alert alert-success text-center"
                            v-if="addExperienceSuccess"
                        >
                            تم اضافة الخبرة بنجاح
                        </div>
                        <div
                            class="alert alert-danger text-center"
                            v-else-if="addExperienceSuccess == false"
                        >
                            الرجاء التحقق من البيانات
                        </div>
                        <div class="accordion" id="accordionExample">
                            <div
                                v-for="(exp, i) in experiences"
                                :key="i"
                                class="accordion-item"
                            >
                                <h2
                                    class="accordion-header"
                                    :id="'heading' + i"
                                >
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        :data-bs-target="'#collapse' + i"
                                        aria-expanded="false"
                                        :aria-controls="'collapse' + i"
                                    >
                                        <div>
                                            <h5>{{ exp.company_name }}</h5>
                                            <p class="bold">
                                                خبرة
                                                {{
                                                    calcExp(exp.start, exp.end)
                                                }}
                                            </p>
                                        </div>
                                    </button>
                                </h2>
                                <div
                                    :id="'collapse' + i"
                                    class="accordion-collapse collapse"
                                    :aria-labelledby="'heading' + i"
                                    data-bs-parent="#accordionExample"
                                >
                                    <div class="accordion-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    إسم الشركة
                                                </h4>
                                                <p class="text-center">
                                                    {{ exp.company_name }}
                                                </p>
                                            </li>
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    نوع العمل
                                                </h4>
                                                <p class="text-center">
                                                    {{ exp.position }}
                                                </p>
                                            </li>
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    بداية المنصب
                                                </h4>
                                                <p class="text-center">
                                                    {{ exp.start }}
                                                </p>
                                            </li>
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    نهاية المنصب
                                                </h4>
                                                <p class="text-center">
                                                    {{ exp.end }}
                                                </p>
                                            </li>
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    الخبرة
                                                </h4>
                                                <p class="text-center">
                                                    {{
                                                        calcExp(
                                                            exp.start,
                                                            exp.end
                                                        )
                                                    }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
                                <button
                                    @click="addSkill"
                                    class="btn btn-success"
                                    type="button"
                                >
                                    اضافة المهارة
                                </button>
                            </div>
                            <div
                                class="alert alert-success text-center"
                                v-if="addSkillSuccess"
                            >
                                تم اضافة المهارة بنجاح
                            </div>
                            <div
                                class="alert alert-danger text-center"
                                v-else-if="addSkillSuccess == false"
                            >
                                الرجاء التحقق من البيانات
                            </div>
                            <ul class="list-group list">
                                <li
                                    class="text-center list-group-item"
                                    v-for="(skill, i) in skills"
                                    :key="i"
                                >
                                    {{ skill.name }}
                                </li>
                            </ul>
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
            profile_id: 0,
            saveSuccess: null,
            addExperienceSuccess: null,
            addPhoneSuccess: null,
            addSkillSuccess: null,
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

                    vm.saveSuccess = true;
                })
                .catch(function (error) {
                    vm.saveSuccess = false;
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
                        profile_id: vm.profile_id,
                    },

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.company_name = "";
                    vm.start = "";
                    vm.end = "";
                    vm.position = "";

                    vm.addExperienceSuccess = true;
                })
                .catch(function (error) {
                    vm.addExperienceSuccess = false;
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
                        profile_id: vm.profile_id,
                    },

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.skills.push(response.data);
                    vm.skill_name = "";

                    vm.addSkillSuccess = true;
                })
                .catch(function (error) {
                    vm.addSkillSuccess = false;
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
                    vm.phone = "";
                    vm.addPhoneSuccess = true;
                })
                .catch(function (error) {
                    vm.addPhoneSuccess = false;
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
        calcExp(startDate, endDate) {
            var start = new Date(startDate),
                end = new Date(endDate);

            var diff = end.getFullYear() - start.getFullYear();

            if (diff > 0) return diff + " سنة";

            diff = end.getMonth() - start.getMonth();

            if (diff > 0) return diff + " شهر";

            diff = end.getDate() - start.getDate();

            if (diff > 0) return diff + " يوم";
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
.alert {
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
