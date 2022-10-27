<template>
    <div>
        <loading v-if="!loaded"></loading>
        <main v-if="loaded" class="container rounded mt-5 mb-5">
            <div class="row gap-4">
                <div class="col-md-3 border-right bg-mine radius-1">
                    <div
                        class="d-flex flex-column align-items-center text-center p-3 py-5"
                    >
                        <img
                            class="rounded-circle mt-5"
                            width="150px"
                            :src="previewAvatar(user.profile.avatar)"
                        /><span class="font-weight-bold text-break"
                            >{{ user.profile.firstname }}
                            {{ user.profile.lastname }}</span
                        >
                        <span class="text-black-50 text-break">{{
                            user.profile.nickname
                        }}</span>

                        <span
                            class="btn btn-warning"
                            v-if="connection_request == false"
                            @click="removeConnection($route.params.id)"
                            >في إنتظار القبول
                            <i class="fa-solid fa-user-plus"></i
                        ></span>
                        <span
                            class="btn btn-danger"
                            v-else-if="connection_request == true"
                            @click="removeConnection($route.params.id)"
                            >إلغاء الأتصال<i class="fa-solid fa-minus"></i
                        ></span>
                        <span
                            class="btn btn-success"
                            v-else
                            @click="addConnection($route.params.id)"
                            >إتصال <i class="fa-solid fa-user-plus"></i
                        ></span>
                        <span
                            class="btn btn-primary mar-1"
                            v-if="!followed"
                            @click="followUser($route.params.id)"
                            >متابعة <i class="fa-solid fa-plus"></i
                        ></span>
                        <span
                            class="btn btn-danger mar-1"
                            v-else
                            @click="unFollowUser($route.params.id)"
                            >الغاء متابعة <i class="fa-solid fa-minus"></i
                        ></span>
                        <span
                            >{{ user.followers_count | toNumber }}
                            مُتَابِع
                        </span>
                        <!-- <span
                            >{{ user.followings_count | toNumber }}
                            يتابع
                        </span> -->
                    </div>
                    <div>
                        <span>حول</span>
                        <textarea
                            class="form-control"
                            type="text"
                            aria-label="readonly input example"
                            readonly
                            v-model="user.profile.about"
                        >
                        </textarea>
                    </div>
                </div>
                <div class="col-md-5 border-right bg-mine radius-1">
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
                                    {{ user.profile.gender }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">تاريخ الميلاد:</label>
                                <div class="">
                                    {{ user.profile.birthdate }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الدولة:</label>
                                <div class="">
                                    {{ user.profile.country }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الولاية:</label>
                                <div class="">
                                    {{ user.profile.state }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">المدينة:</label>
                                <div class="">
                                    {{ user.profile.city }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الشارع:</label>
                                <div class="">
                                    {{ user.profile.street }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الموقع الإلكتروني:</label>
                                <div class="">
                                    {{ user.profile.website }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">ارقام الهواتف:</label>
                                <div
                                    class=""
                                    v-for="(phone, i) in user.phones"
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
                                        {{ user.profile.university }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels"
                                        >الدرجة العلمية:</label
                                    >
                                    <div class="">
                                        {{ user.profile.degree }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">نوع التخصص:</label>
                                    <div class="">
                                        {{ user.profile.study_type }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 py-0">
                        <h4>
                            منشورات {{ user.profile.firstname }}
                            {{ user.profile.nickname }}
                        </h4>
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
                        <!-- <br /> -->
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
                                    v-for="(skill, i) in user.skills"
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
import Loading from "../../components/bootstrap/Loading.vue";

export default {
    data() {
        return {
            skill_name: "",
            start: "",
            end: "",
            user: {
                profile: {},
            },
            position: "",
            company_name: "",
            followed: false,
            phone: "",
            posts: {},
            user_id: 0,
            connection_request: null,
            loaded: false,
        };
    },
    methods: {
        getUserInfo() {
            var vm = this;

            axios
                .get("/api/users/" + vm.$route.params.id + "", {
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
        followUser(targetUserId) {
            var vm = this;
            vm.followed = true;
            vm.user.followers_count += 1;
            vm.$notify({
                title: "نجاح",
                text: "تمت المتابعة بنجاح",
                type: "success",
            });
            axios
                .post(
                    "/api/users/auth/follows/" + targetUserId,
                    {},
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
                    for (const error in errors) {
                        vm.$notify({
                            title: "خطأ:لم يتم تنفيذ",
                            text: errors[error][0],
                            type: "error",
                        });
                    }
                });
        },
        unFollowUser(targetUserId) {
            var vm = this;
            vm.followed = false;
            vm.user.followers_count -= 1;
            vm.$notify({
                title: "نجاح",
                text: "تم إلغاء المتابعة بنجاح",
                type: "success",
            });
            axios
                .delete("/api/users/auth/unfollows/" + targetUserId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
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
        isFollowed(userId, targetUserId) {
            var vm = this;

            axios
                .get(
                    "/api/users/" +
                        userId +
                        "/is-followed/" +
                        targetUserId +
                        "",
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
        previewAvatar(avatar) {
            if (!avatar) {
                return "/images/assets/personal.jpg";
            }
            return avatar;
        },

        addConnection(targetUserId) {
            var vm = this;
            vm.connection_request = false;
            vm.$notify({
                title: "نجاح",
                text: "تم إرسال طلب الإتصال بنجاح",
                type: "success",
            });
            axios
                .post(
                    "/api/users/auth/connections/request/" + targetUserId + "",
                    {},
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
                    for (const error in errors) {
                        vm.$notify({
                            title: "خطأ:لم يتم تنفيذ",
                            text: errors[error][0],
                            type: "error",
                        });
                    }
                });
        },

        removeConnection(targetUserId) {
            var vm = this;
            vm.connection_request = null;
            vm.$notify({
                title: "نجاح",
                text: "تم إلغاء طلب الإتصال بنجاح",
                type: "success",
            });
            axios
                .delete(
                    "/api/users/auth/connections/remove/" + targetUserId + "",
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
                    for (const error in errors) {
                        vm.$notify({
                            title: "خطأ:لم يتم تنفيذ",
                            text: errors[error][0],
                            type: "error",
                        });
                    }
                });
        },
        connectionStatus(targetUserId) {
            var vm = this;

            axios
                .get("/api/users/auth/connection-status/" + targetUserId + "", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);

                    vm.connection_request = response.data.data;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
    },
    computed: {},
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
        this.getUserInfo();
        this.getUserPosts();
        this.isFollowed(this.user_id, this.$route.params.id);
        this.connectionStatus(this.$route.params.id);
    },
    mounted: function () {
        let vm = this;
        this.$nextTick(function () {
            setTimeout(function () {
                vm.loaded = true;
            }, 1000);
        });
    },

    components: {
        ViewPosts,
        Loading,
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
