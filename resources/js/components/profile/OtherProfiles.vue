<template>
    <div>
        <main class="container rounded mt-5 mb-5">
            <div class="row gap-4">
                <div class="col-md-3 border-right bg-mine">
                    <div
                        class="d-flex flex-column align-items-center text-center p-3 py-5"
                    >
                        <img
                            class="rounded-circle mt-5"
                            width="150px"
                            :src="previewAvatar(profile.avatar)"
                        /><span class="font-weight-bold text-break"
                            >{{ profile.firstname }}
                            {{ profile.lastname }}</span
                        >
                        <span class="text-black-50 text-break">{{
                            profile.nickname
                        }}</span>
                        <span
                            class="btn btn-primary"
                            v-if="!followed"
                            @click="followProfile(profile_id, $route.params.id)"
                            >متابعة <i class="fa-solid fa-plus"></i
                        ></span>
                        <span
                            class="btn btn-danger"
                            v-else
                            @click="
                                unFollowProfile(profile_id, $route.params.id)
                            "
                            >الغاء متابعة <i class="fa-solid fa-minus"></i
                        ></span>
                        <span
                            >{{ profile.followers_count | toNumber }} مُتَابَع
                        </span>
                        <span
                            >{{ profile.followings_count | toNumber }}
                            يتابع
                        </span>
                    </div>
                    <div>
                        <span>حول</span>
                        <textarea
                            class="form-control"
                            type="text"
                            aria-label="readonly input example"
                            readonly
                            v-model="profile.about"
                        >
                        </textarea>
                    </div>
                </div>
                <div class="col-md-5 border-right bg-mine">
                    <div class="p-3 py-5">
                        <div
                            class="d-flex justify-content-between align-items-center mb-3"
                        >
                            <h4 class="text-right">الملف الشخصي</h4>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">النوع:</label>
                                <div class="">
                                    {{ profile.gender }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">تاريخ الميلاد:</label>
                                <div class="">
                                    {{ profile.birthdate }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الدولة:</label>
                                <div class="">
                                    {{ profile.country }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الولاية:</label>
                                <div class="">
                                    {{ profile.state }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">المدينة:</label>
                                <div class="">
                                    {{ profile.city }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الشارع:</label>
                                <div class="">
                                    {{ profile.street }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الموقع الإلكتروني:</label>
                                <div class="">
                                    {{ profile.website }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">ارقام الهواتف:</label>
                                <div
                                    class=""
                                    v-for="(phone, i) in profile.phones"
                                    :key="i"
                                >
                                    {{ phone.phone }}
                                </div>
                            </div>
                            <div class="p-3 row py-5">
                                <div
                                    class="d-flex justify-content-between align-items-center experience"
                                >
                                    <h3>التعليم</h3>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">الجامعة:</label>
                                    <div class="">
                                        {{ profile.university }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels"
                                        >الدرجة العلمية:</label
                                    >
                                    <div class="">
                                        {{ profile.degree }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">نوع التخصص:</label>
                                    <div class="">
                                        {{ profile.study_type }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 py-0">
                        <h4>
                            منشورات {{ profile.firstname }}
                            {{ profile.nickname }}
                        </h4>
                        <view-posts
                            :onPageClick="getProfilePosts"
                            :posts="posts"
                        ></view-posts>
                    </div>
                </div>
                <div class="col-md-3 bg-mine">
                    <div class="p-3 py-5">
                        <div
                            class="d-flex justify-content-between align-items-center experience"
                        >
                            <h3>الخبرات</h3>
                        </div>
                        <!-- <br /> -->
                        <div class="accordion" id="accordionExample">
                            <div
                                v-for="(exp, i) in profile.experiences"
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

                            <ul class="list-group list">
                                <li
                                    class="text-center list-group-item"
                                    v-for="(skill, i) in profile.skills"
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
import ViewPosts from "../../components/posts/ViewPosts.vue";

export default {
    data() {
        return {
            skill_name: "",
            start: "",
            end: "",
            profile: {},
            position: "",
            company_name: "",
            followed: false,
            phone: "",
            posts: {},
            profile_id: 0,
        };
    },
    methods: {
        getProfileInfo() {
            var vm = this;

            axios
                .get("/api/profiles/" + vm.$route.params.id + "", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.profile = response.data.data;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        followProfile(profileId, targetProfileId) {
            var vm = this;

            axios
                .post(
                    "/api/profiles/" + profileId + "/follows",
                    {
                        profile_id: targetProfileId,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.followed = true;
                    vm.profile.followersCount += 1;
                    vm.$notify({
                        title: "نجاح",
                        text: response.data.message,
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
        unFollowProfile(profileId, targetProfileId) {
            var vm = this;

            axios
                .delete(
                    "/api/profiles/" +
                        profileId +
                        "/profiles/" +
                        targetProfileId +
                        "/follows",
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.followed = false;
                    vm.profile.followersCount -= 1;
                    vm.$notify({
                        title: "نجاح",
                        text: response.data.message,
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
        isFollowed(profileId, targetProfileId) {
            var vm = this;

            axios
                .get(
                    "/api/profiles/" +
                        profileId +
                        "/profiles/" +
                        targetProfileId +
                        "/is-followed",
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.followed = response.data.data;
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
        getProfilePosts(pageNumber = 1) {
            var vm = this;

            axios
                .get(
                    "/api/profiles/" +
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
        previewAvatar(avatar) {
            if (!avatar) {
                return "/images/assets/personal.jpg";
            }
            return avatar;
        },
    },
    computed: {},
    created() {
        this.profile_id = JSON.parse(localStorage.getItem("user")).profile_id;
        this.getProfileInfo();
        this.getProfilePosts();
        this.isFollowed(this.profile_id, this.$route.params.id);
    },
    components: {
        ViewPosts,
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
    font-size: 25px;
    font-weight: bold;
}

.add-experience:hover {
    background: #ba68c8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #ba68c8;
}

textarea {
    resize: none;
    min-height: 300px;
}
</style>
