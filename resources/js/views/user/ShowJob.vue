<template>
    <div class="container mt-5 mb-5">
        <loading v-if="!loaded"></loading>
        <div
            v-if="loaded"
            class="row d-flex align-items-center justify-title-center"
        >
            <div class="col-md-12" v-if="job && job.user">
                <!-- <div class="card" v-for="(job, i) in jobs.data" :key="i"> -->
                <div class="d-flex justify-content-between p-2 px-3">
                    <div class="d-flex flex-row align-items-center gap-2">
                        <img
                            :src="previewAvatar(job.user.profile.avatar)"
                            width="50"
                            class="rounded-circle"
                            @click="goToProfile(job.user.profile.id)"
                        />
                        <div class="d-flex flex-column ml-2">
                            <span class="text-break name"
                                >{{ job.user.profile.firstname }}
                                {{ job.user.profile.lastname }}</span
                            >
                            <small class="mr-2 date">{{
                                job.created_at_diff_for_humans
                            }}</small>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-row mt-1 gap-2"
                        v-if="job.user_id == user_id"
                    >
                        <!-- <i class="fa fa-ellipsis-h"></i> -->
                        <modal-snippet
                            launchButtonName="تعديل"
                            closeButtonName="إغلاق"
                            confirmButtonName="تعديل"
                            title="تعديل عملك"
                            iconLaunchButton
                            launchButtonClass="fa-solid fa-pen-to-square text-warning"
                            confirmButtonClass="btn btn-warning"
                            :name="'editJob'"
                            @confirmEvent="updateJob(job.id)"
                            @onLaunchButtonClick="editJob(job.id)"
                        >
                            <div class="col-md-12 mar-1">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="عنوان الوظيفة"
                                    name="title"
                                    cols="100px"
                                    v-model="title"
                                />
                            </div>
                            <div class="col-md-12">
                                <textarea
                                    type="text"
                                    class="form-control"
                                    placeholder="الوصف"
                                    name="title"
                                    cols="100px"
                                    v-model="description"
                                ></textarea>
                            </div>
                            <div class="col-md-12 mar-1">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="الموقع"
                                    name="location"
                                    cols="100px"
                                    v-model="location"
                                />
                            </div>
                        </modal-snippet>
                        <modal-snippet
                            closeButtonName="إغلاق"
                            launchButtonName="حذف"
                            iconLaunchButton
                            confirmButtonName="حذف"
                            title="حذف عملك"
                            launchButtonClass="fa-solid fa-trash text-danger"
                            confirmButtonClass="btn btn-danger"
                            :name="'deleteJob'"
                            confirmAndClosed
                            @confirmEvent="deleteJob(job.id)"
                        >
                            هل أنت متأكد من حذف هذه الوظيفة؟
                        </modal-snippet>
                        <!-- <div class="dropdown">
                                <a
                                    class="text-dark"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i class="fa fa-ellipsis-h"></i>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <button class="dropdown-item">
                                            تعديل
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            class="dropdown-item"
                                            @click.prevent="showModal()"
                                        >
                                            حذف
                                        </button>
                                        <modal-snippet
                                            launchButtonName="حذف"
                                            closeButtonName="إغلاق"
                                            confirmButtonName="حذف"
                                            title="حذف منشورك"
                                            launchButtonClass="dropdown-item"
                                            confirmButtonClass="btn btn-danger"
                                            :name="'deleteJob' "
                                            confirmAndClosed
                                            @confirmEvent="deleteJob(job.id)"
                                        >
                                            هل أنت متأكد من حذف هذا المنشور؟
                                        </modal-snippet>
                                    </li>
                                </ul>
                            </div> -->
                    </div>
                </div>

                <div>
                    <h3 class="text-justify p-2">
                        {{ job.title }}
                    </h3>
                    <div class="text-justify p-2">
                        <div>{{ job.description }}</div>
                    </div>
                    <hr />
                    <div
                        class="d-flex d-none justify-title-between align-items-center p-2"
                    >
                        <!-- <div
                                class="d-flex flex-row icons d-flex align-items-center gap-1"
                            >
                                <i
                                    v-if="job.react_type == 1"
                                    class="fa-solid fa-thumbs-up text-primary"
                                    @click="
                                        removeReactFromJob(
                                            user_id,
                                            job.id,
                                            1
                                        )
                                    "
                                ></i>
                                <i
                                    v-else
                                    class="fa-solid fa-thumbs-up"
                                    @click="reactToJob(user_id, job.id, 1)"
                                ></i>
                                <span>
                                    {{ job.likes_count | toNumber }}
                                </span>
                                <i
                                    v-if="job.react_type == 2"
                                    class="fa-solid fa-thumbs-down text-primary"
                                    @click="
                                        removeReactFromJob(
                                            user_id,
                                            job.id,
                                            2
                                        )
                                    "
                                ></i>
                                <i
                                    v-else
                                    class="fa-solid fa-thumbs-down"
                                    @click="reactToJob(user_id, job.id, 2)"
                                ></i>
                                <span>
                                    {{ job.dislikes_count | toNumber }}
                                </span>
                            </div> -->

                        <!-- <div class="d-flex flex-row muted-color">
                                <span>التعليقات</span>
                            </div> -->
                    </div>
                    <small class="text-justify p-2 date">
                        {{ job.location }}
                        <i class="fa-solid fa-location-dot text-primary"></i>
                    </small>
                    <!-- <hr /> -->
                </div>
            </div>
            <div v-else>
                <h1>عفوا هذه الوظيفة غير موجودة</h1>
            </div>
        </div>
    </div>
    <!-- </div> -->
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";
import headerFormAuth from "../../helpers/formAuth";
import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";
import Loading from "../../components/bootstrap/Loading.vue";

export default {
    name: "Job",
    data() {
        return {
            title: "",
            description: "",
            location: "",
            job: {
                reacts: [],
                tags: [],
                comments: [],
            },
            user_id: 0,
            loaded: false,
        };
    },
    components: {
        ModalSnippet,
        Loading,
    },
    methods: {
        editJob(jobId) {
            var vm = this;
            vm.clearData();
            vm.title = vm.job.title;
            vm.description = vm.job.description;
            vm.location = vm.job.location;
        },
        updateJob(jobId) {
            var vm = this;
            // let data = new FormData();
            // data.append("title", vm.title);
            // data.append("description", vm.description);
            // data.append("location", vm.location);
            // data.append("_method", "put");

            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري تعديل الوظيفة " + spinner,
                type: "info",
            });
            axios
                .put(
                    "/api/jobs/" + jobId,
                    {
                        title: vm.title,
                        description: vm.description,
                        location: vm.location,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);

                    vm.job.title = response.data.data.title;
                    vm.job.description = response.data.data.description;
                    vm.job.location = response.data.data.location;

                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تم تعديل الوظيفة بنجاح",
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
        deleteJob(jobId) {
            var vm = this;
            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري حذف الوظيفة " + spinner,
                type: "info",
            });
            axios
                .delete("/api/jobs/" + jobId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.job = null;

                    vm.$notify({
                        clean: true,
                    });

                    vm.$notify({
                        title: "نجاح",
                        text: "تم حذف الوظيفة بنجاح",
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
            this.title = "";
            this.description = "";
            this.location = "";
        },
        showModal() {
            this.$modal.show("my-modal");
        },
        hideModal() {
            this.$modal.hide("my-modal");
        },
        goToProfile(userId) {
            if (userId != this.$route.params.id) {
                this.$router.push({
                    name: "profile",
                    params: {
                        id: userId,
                    },
                });
            }
        },
        // reactToJob(userId, jobId, reactType) {
        //     var vm = this;

        //     vm.removeMyReacts(vm.job);
        //     vm.job.react_type = reactType;

        //     if (reactType == 1) {
        //         vm.job.likes_count += 1;
        //     } else if (reactType == 2) {
        //         vm.job.dislikes_count += 1;
        //     }

        //     vm.$notify({
        //         title: "نجاح",
        //         text: "تم التفاعل مع المنشور بنجاح",
        //         type: "success",
        //     });

        //     axios
        //         .job(
        //             "/api/jobs/" + jobId + "/profiles",
        //             {
        //                 user_id: userId,
        //                 type: reactType,
        //                 job_author: vm.job.user_id,
        //                 job_id: jobId,
        //             },
        //             {
        //                 headers: headerAuth,
        //             }
        //         )
        //         .then(function (response) {
        //             console.log(response);
        //         })
        //         .catch(function (error) {
        //             console.log(error.response);
        //             var errors = error.response.data.errors;
        //             for (const error in errors) {
        //                 vm.$notify({
        //                     title: "خطأ:لم يتم تنفيذ",
        //                     text: errors[error][0],
        //                     type: "error",
        //                 });
        //             }
        //         });
        // },
        // removeReactFromJob(userId, jobId) {
        //     var vm = this;

        //     vm.removeMyReacts(vm.job);
        //     vm.job.react_type = 0;

        //     vm.$notify({
        //         title: "نجاح",
        //         text: "تم التفاعل مع المنشور بنجاح",
        //         type: "success",
        //     });
        //     axios
        //         .delete("/api/jobs/" + jobId + "/profiles/" + userId, {
        //             headers: headerAuth,
        //         })
        //         .then(function (response) {
        //             console.log(response);
        //         })
        //         .catch(function (error) {
        //             console.log(error.response);
        //             var errors = error.response.data.errors;
        //             for (const error in errors) {
        //                 vm.$notify({
        //                     title: "خطأ:لم يتم تنفيذ",
        //                     text: errors[error][0],
        //                     type: "error",
        //                 });
        //             }
        //         });
        // },
        // removeMyReacts(job) {
        //     if (job.react_type == 1 && job.likes_count > 0)
        //         job.likes_count -= 1;
        //     else if (job.react_type == 2 && job.dislikes_count > 0)
        //         job.dislikes_count -= 1;
        // },

        previewAvatar(avatar) {
            if (!avatar) {
                return "/images/assets/personal.jpg";
            }
            return avatar;
        },
        getJob(jobId) {
            var vm = this;

            axios
                .get("/api/jobs/" + jobId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.job = response.data.data;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
    },
    computed: {},
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
        this.getJob(this.$route.params.id);
        console.log("View Jobs");
        console.log(this.jobs);
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
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");
body {
    background-color: #eee;
    font-family: "Poppins", sans-serif;
    font-weight: 300;
}
.card {
    border: none;
    /* margin-top: 10px; */
    margin-bottom: 100px;
}
.ellipsis {
    color: #a09c9c;
}
hr {
    color: #a09c9c;
    margin-top: 4px;
    margin-bottom: 8px;
}
.muted-color {
    color: #a09c9c;
    font-size: 13px;
}
.ellipsis i {
    margin-top: 3px;
    cursor: pointer;
}
.icons i {
    font-size: 25px;
}

.icons i:hover {
    color: #0d6efd;
}

.icons .fa-solid.fa-thumbs-up {
}
.icons .fa-solid.fa-thumbs-down {
    margin-top: 4px;
    margin-right: 10px;
}
.rounded-image {
    border-radius: 50% !important;
    display: flex;
    justify-title: center;
    align-items: center;
    height: 50px;
    width: 50px;
}
.name {
    font-weight: bold;
}
.date {
    color: #65676b !important;
}
.comment-text {
    font-size: 12px;
}
.status small {
    margin-right: 10px;
    color: blue;
}
.form-control {
    border-radius: 26px;
}
.comment-input {
    position: relative;
}
.comment-input textarea {
    height: 50px;
}
.fonts {
    position: absolute;
    left: 13px;
    top: 8px;
    color: #a09c9c;
}
.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #8bbafe;
    outline: 0;
    box-shadow: none;
}
.options {
    font-size: 23px;
    color: #757575;
    cursor: pointer;
}

.options:hover {
    color: #000;
}
a {
    text-decoration: none;
}
textarea {
    resize: none !important;
    height: 300px;
}
img {
    cursor: pointer;
}
i {
    cursor: pointer;
}
</style>
