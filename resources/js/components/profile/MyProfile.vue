<template>
    <div class="root-div">
        <main class="container rounded mt-5 mb-5">
            <div class="row gap-4">
                <div class="col-md-3 border-right bg-mine">
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
                        <span
                            ><router-link
                                :to="{
                                    name: 'profile.edit',
                                    params: {
                                        id: user_id,
                                    },
                                }"
                                class="btn btn-warning"
                                >تعديل الملف الشخصي</router-link
                            >
                        </span>
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
                <div class="col-md-5 border-right bg-mine">
                    <div class="p-3 py-5">
                        <h4>منشوراتك</h4>
                        <create-post></create-post>
                        <view-posts></view-posts>
                    </div>
                </div>
                <div class="col-md-3 bg-mine">
                    <div class="p-3 py-5">
                        <div
                            class="d-flex justify-content-between align-items-center experience"
                        >
                            <h3>الخبرات</h3>
                        </div>
                        <br />

                        <div class="mt-1">
                            <modal-snippet
                                launchButtonName="خبرة جديدة"
                                closeButtonName="إغلاق"
                                confirmButtonName="إضافة"
                                title="خبرة جديدة"
                                launchButtonClass="btn btn-success"
                                confirmButtonClass="btn btn-success"
                                name="addExperience"
                                confirmAndClosed
                                @confirmEvent="addExperience()"
                                @onLaunchButtonClick="clearData()"
                            >
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
                            </modal-snippet>
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
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center gap-1 mar-1"
                                    >
                                        <modal-snippet
                                            launchButtonName="حذف"
                                            closeButtonName="إغلاق"
                                            confirmButtonName="حذف"
                                            title="حذف خبرة"
                                            launchButtonClass="btn btn-danger"
                                            confirmButtonClass="btn btn-danger"
                                            :name="'deleteExperience' + i"
                                            confirmAndClosed
                                            @confirmEvent="
                                                deleteExperience(exp.id)
                                            "
                                        >
                                            هل أنت متأكد من حذف هذه الخبرة ؟
                                        </modal-snippet>

                                        <modal-snippet
                                            launchButtonName="تعديل"
                                            closeButtonName="إغلاق"
                                            confirmButtonName="تعديل"
                                            title="تعديل خبرة"
                                            launchButtonClass="btn btn-warning"
                                            confirmButtonClass="btn btn-warning"
                                            :name="'updateExperience' + i"
                                            @confirmEvent="
                                                updateExperience(exp.id)
                                            "
                                            @onLaunchButtonClick="
                                                editExperience(exp.id)
                                            "
                                        >
                                            <div class="col-md-12">
                                                <label class="labels"
                                                    >إسم الشركة</label
                                                ><input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="إسم الشركة"
                                                    name="company_name"
                                                    v-model="company_name"
                                                />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels"
                                                    >بداية المنصب</label
                                                ><input
                                                    type="date"
                                                    class="form-control"
                                                    placeholder="بداية المنصب"
                                                    name="start"
                                                    v-model="start"
                                                />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels"
                                                    >نهاية المنصب</label
                                                ><input
                                                    type="date"
                                                    class="form-control"
                                                    placeholder="نهاية المنصب"
                                                    name="end"
                                                    v-model="end"
                                                />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels"
                                                    >المنصب</label
                                                ><input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="المنصب"
                                                    name="position"
                                                    v-model="position"
                                                />
                                            </div>
                                        </modal-snippet>
                                    </div>
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

                            <div class="mt-1">
                                <modal-snippet
                                    launchButtonName="مهارة جديدة"
                                    closeButtonName="إغلاق"
                                    confirmButtonName="إضافة"
                                    title="مهارة جديدة'"
                                    launchButtonClass="btn btn-success"
                                    confirmButtonClass="btn btn-success"
                                    name="addSkill"
                                    confirmAndClosed
                                    @confirmEvent="addSkill()"
                                >
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
                                </modal-snippet>
                            </div>

                            <ul class="list-group list">
                                <li
                                    class="text-center list-group-item"
                                    v-for="(skill, i) in skills"
                                    :key="i"
                                >
                                    <p>{{ skill.name }}</p>
                                    <modal-snippet
                                        launchButtonName="حذف"
                                        closeButtonName="إغلاق"
                                        confirmButtonName="حذف"
                                        :title="'حذف ' + skill.name"
                                        launchButtonClass="btn btn-danger"
                                        confirmButtonClass="btn btn-success"
                                        :name="'deleteSkill' + i"
                                        confirmAndClosed
                                        @confirmEvent="
                                            deleteSkill(profile_id, skill.id)
                                        "
                                    >
                                        هل أنت متأكد من حذف {{ skill.name }}?
                                    </modal-snippet>
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
import ViewPosts from "../../components/posts/ViewPosts.vue";
import CreatePost from "../../components/posts/CreatePost.vue";
import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

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
        savePersonalInfo(profileId = this.profile_id) {
            var vm = this;

            axios
                .put(
                    "/api/profiles/" + profileId + "",
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
                    vm.experiences.push(response.data);
                    vm.clearData();

                    vm.$notify({
                        title: "نجاح",
                        text: "تم إضافة الخبرة بنجاح",
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
                    var skillExist = vm.skills.find(
                        (el) => el.name == response.data.name
                    );
                    if (!skillExist) {
                        vm.skills.push(response.data);
                        vm.skill_name = "";
                        vm.$notify({
                            title: "نجاح",
                            text: "تم إضافة المهارة بنجاح",
                            type: "success",
                        });
                    } else {
                        vm.$notify({
                            title: "خطأ:لم يتم تنفيذ",
                            text: "هذه المهارة موجودة بالفعل !",
                            type: "error",
                        });
                    }
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
        deleteSkill(profileId, skillId) {
            var vm = this;

            axios
                .delete("/api/skills/detach/" + profileId + "/" + skillId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    var index = vm.skills.findIndex((el) => el.id == skillId);
                    vm.skills.splice(index, 1);
                    vm.$notify({
                        title: "نجاح",
                        text: "تم حذف المهارة بنجاح",
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
        deleteExperience(experienceId) {
            var vm = this;

            axios
                .delete("/api/experiences/" + experienceId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    var index = vm.experiences.findIndex(
                        (el) => el.id == experienceId
                    );
                    vm.experiences.splice(index, 1);
                    vm.$notify({
                        title: "نجاح",
                        text: "تم حذف الخبرة بنجاح",
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
        editExperience(experienceId) {
            var vm = this;
            let expIndex = vm.experiences.findIndex(
                (el) => el.id == experienceId
            );
            vm.company_name = vm.experiences[expIndex].company_name;
            vm.start = vm.experiences[expIndex].start;
            vm.end = vm.experiences[expIndex].end;
            vm.position = vm.experiences[expIndex].position;
        },
        updateExperience(experienceId) {
            var vm = this;

            axios
                .put(
                    "/api/experiences/" + experienceId,
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

                    let expIndex = vm.experiences.findIndex(
                        (el) => el.id == experienceId
                    );
                    vm.experiences[expIndex].company_name = vm.company_name;
                    vm.experiences[expIndex].start = vm.start;
                    vm.experiences[expIndex].end = vm.end;
                    vm.experiences[expIndex].position = vm.position;

                    vm.$notify({
                        title: "نجاح",
                        text: "تم تعديل الخبرة بنجاح",
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
        clearData() {
            this.company_name = "";
            this.start = "";
            this.end = "";
            this.position = "";
            this.skill_name = "";
        },
    },
    components: {
        ViewPosts,
        CreatePost,
        ModalSnippet,
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
