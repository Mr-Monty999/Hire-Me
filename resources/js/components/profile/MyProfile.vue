<template>
    <div class="root-div">
        <loading v-if="!loaded"></loading>
        <main v-if="loaded" class="container rounded mt-5 mb-5">
            <div class="row gap-md-4">
                <div class="col-md-3 border-right bg-mine radius-1">
                    <div
                        class="d-flex flex-column align-items-center text-center p-3 py-5"
                    >
                        <img
                            class="rounded-circle mt-5"
                            width="150px"
                            :src="previewAvatar"
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
                        <span class="text-black-50">{{ user.email }}</span
                        ><span
                            >{{ user.followers_count | toNumber }}
                            مُتَابع
                        </span>
                        <span
                            >{{ user.followings_count | toNumber }}
                            يتابع
                        </span>
                    </div>
                    <div hidden class="mar-1">
                        <label for="" class="form-label">حول</label>
                        <textarea
                            name="profile.about"
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
                <div class="col-md-5 border-right bg-mine radius-1">
                    <div class="p-3 py-5">
                        <h4>منشوراتك</h4>
                        <create-post :posts="posts"></create-post>
                        <view-posts
                            :onPageClick="getUserPosts"
                            :posts="posts"
                        ></view-posts>
                    </div>
                </div>
                <div class="col-md-3 bg-mine radius-1">
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
                                v-for="(exp, i) in user.experiences"
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
                                        class="d-flex justify-content-center align-items-center gap-2 mar-1"
                                    >
                                        <modal-snippet
                                            launchButtonName="حذف"
                                            closeButtonName="إغلاق"
                                            confirmButtonName="حذف"
                                            title="حذف خبرة"
                                            iconLaunchButton
                                            launchButtonClass="fa-solid fa-trash text-danger profile-actions"
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
                                            iconLaunchButton
                                            title="تعديل خبرة"
                                            launchButtonClass="fa-solid fa-pen-to-square text-warning profile-actions"
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
                                    title="مهارة جديدة"
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
                                            list="skillListOptions"
                                            id="skill"
                                            @keyup="searchForSkill(skill_name)"
                                        />
                                        <datalist id="skillListOptions">
                                            <option
                                                v-for="skill in suggestSkills"
                                                :key="skill.id"
                                                :value="skill.name"
                                            ></option>
                                        </datalist>
                                    </div>
                                </modal-snippet>
                            </div>

                            <ul class="list-group list">
                                <li
                                    class="text-center list-group-item"
                                    v-for="(skill, i) in user.skills"
                                    :key="i"
                                >
                                    <p>{{ skill.name }}</p>
                                    <modal-snippet
                                        launchButtonName="حذف"
                                        closeButtonName="إغلاق"
                                        confirmButtonName="حذف"
                                        iconLaunchButton
                                        :title="'حذف ' + skill.name"
                                        launchButtonClass="fa-solid fa-trash text-danger profile-actions"
                                        confirmButtonClass="btn btn-danger"
                                        :name="'deleteSkill' + i"
                                        confirmAndClosed
                                        @confirmEvent="deleteSkill(skill.id)"
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
import Loading from "../../components/bootstrap/Loading.vue";

export default {
    data() {
        return {
            user: {
                profile: {},
            },
            posts: {},
            skill_name: "",
            start: "",
            end: "",
            position: "",
            suggestSkills: [],
            company_name: "",
            phone: "",
            user_id: 0,
            loaded: false,
        };
    },
    computed: {
        previewAvatar() {
            if (!this.user.profile.avatar) {
                return "/images/assets/personal.jpg";
            }
            return this.user.profile.avatar;
        },
    },
    methods: {
        savePersonalInfo(userId = this.user_id) {
            var vm = this;

            axios
                .put(
                    "/api/profiles/" + userId + "",
                    {
                        firstname: vm.user.profile.firstname,
                        lastname: vm.user.profile.lastname,
                        nickname: vm.user.profile.nickname,
                        birthdate: vm.user.profile.birthdate,
                        about: vm.user.profile.about,
                        avatar: vm.user.profile.avatar,
                        website: vm.user.profile.website,
                        country: vm.user.profile.country,
                        city: vm.user.profile.city,
                        state: vm.user.profile.state,
                        street: vm.user.profile.street,
                        university: vm.user.profile.university,
                        degree: vm.user.profile.degree,
                        study_type: vm.user.profile.study_type,
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
            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري إضافة الخبرة " + spinner,
                type: "info",
            });
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
                    vm.user.experiences.push(response.data.data);
                    vm.clearData();
                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تم إضافة الخبرة بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
                    vm.$notify({
                        clean: true,
                    });
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
            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري إضافة المهارة " + spinner,
                type: "info",
            });
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
                    var skillExist = vm.user.skills.find(
                        (el) => el.name == response.data.data.name
                    );
                    vm.$notify({
                        clean: true,
                    });
                    if (!skillExist) {
                        vm.user.skills.push(response.data.data);
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
                    vm.$notify({
                        clean: true,
                    });
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
        searchForSkill(skillName) {
            var vm = this;

            axios
                .get("/api/skills/" + skillName + "/search", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.suggestSkills = response.data.data;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        getUserInfo() {
            var vm = this;

            axios
                .get("/api/users/" + vm.user_id + "", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.user = response.data.data;
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
        deleteSkill(skillId) {
            var vm = this;
            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري حذف المهارة " + spinner,
                type: "info",
            });
            axios
                .delete("/api/skills/" + skillId + "/detach", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    var index = vm.user.skills.findIndex(
                        (el) => el.id == skillId
                    );
                    vm.user.skills.splice(index, 1);
                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تم حذف المهارة بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
                    vm.$notify({
                        clean: true,
                    });
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

            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري حذف الخبرة " + spinner,
                type: "info",
            });
            axios
                .delete("/api/experiences/" + experienceId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    var index = vm.user.experiences.findIndex(
                        (el) => el.id == experienceId
                    );
                    vm.user.experiences.splice(index, 1);
                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تم حذف الخبرة بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
                    vm.$notify({
                        clean: true,
                    });
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
            let expIndex = vm.user.experiences.findIndex(
                (el) => el.id == experienceId
            );
            vm.company_name = vm.user.experiences[expIndex].company_name;
            vm.start = vm.user.experiences[expIndex].start;
            vm.end = vm.user.experiences[expIndex].end;
            vm.position = vm.user.experiences[expIndex].position;
        },
        updateExperience(experienceId) {
            var vm = this;

            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري حفظ الخبرة " + spinner,
                type: "info",
            });
            axios
                .put(
                    "/api/experiences/" + experienceId,
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

                    let expIndex = vm.user.experiences.findIndex(
                        (el) => el.id == experienceId
                    );
                    vm.user.experiences[expIndex].company_name =
                        vm.company_name;
                    vm.user.experiences[expIndex].start = vm.start;
                    vm.user.experiences[expIndex].end = vm.end;
                    vm.user.experiences[expIndex].position = vm.position;
                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تم تعديل الخبرة بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
                    vm.$notify({
                        clean: true,
                    });
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
        getUserPosts(pageNumber = 1) {
            var vm = this;

            axios
                .get(
                    "/api/users/" +
                        vm.$route.params.id +
                        "/posts?page=" +
                        pageNumber,
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);

                    vm.posts = response.data.data;
                    scrollTo(0, 300);
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
    },
    components: {
        ViewPosts,
        CreatePost,
        ModalSnippet,
        Loading,
    },
    mounted: function () {
        let vm = this;
        this.$nextTick(function () {
            setTimeout(function () {
                vm.loaded = true;
            }, 1000);
        });
    },
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
        this.getUserInfo();
        this.getUserPosts();
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
