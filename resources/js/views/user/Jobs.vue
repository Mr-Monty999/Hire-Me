<template>
    <div>
        <loading v-if="!loaded"></loading>
        <main v-if="loaded" class="container rounded mt-5 mb-5">
            <div class="row gap-4">
                <div class="col-md-2 border-right bg-mine radius-1">
                    <div
                        class="d-flex flex-column align-items-center text-center p-3 py-5"
                    ></div>
                </div>
                <div class="col-md-7 border-right bg-mine radius-1">
                    <div class="p-3 py-5">
                        <modal-snippet
                            launchButtonName="عرض وظيفة"
                            closeButtonName="إغلاق"
                            confirmButtonName="عرض الوظيف"
                            title="عرض وظيفة"
                            launchButtonClass="btn btn-success mar-1"
                            confirmButtonClass="btn btn-success"
                            name="offerJob"
                            confirmAndClosed
                            @confirmEvent="offerJob()"
                        >
                            <div class="col-md-12 mar-1">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="عنوان العمل"
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
                        <h3 class="mar-1">الوظائف المتوفرة</h3>

                        <view-jobs
                            :onPageClick="getJobs"
                            :jobs="jobs"
                        ></view-jobs>
                    </div>
                </div>
                <div class="col-md-2 bg-mine radius-1">
                    <div class="p-3 py-5"></div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";
import ViewJobs from "../../components/jobs/ViewJobs.vue";

import Loading from "../../components/bootstrap/Loading.vue";

import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

export default {
    components: {
        Loading,
        ViewJobs,
        ModalSnippet,
    },
    data() {
        return {
            profile_id: 0,
            jobs: {},
            loaded: false,
            title: "",
            description: "",
            location: "",
        };
    },
    methods: {
        getJobs(pageNumber = 1) {
            var vm = this;
            axios
                .get("/api/jobs?page=" + pageNumber, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.jobs = response.data.data;
                    scrollTo(0, 200);
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        reset() {
            this.title = "";
            this.description = "";
            this.location = "";
        },
        offerJob() {
            var vm = this;
            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري عرض الوظيفة " + spinner,
                type: "info",
            });

            axios
                .post(
                    "/api/jobs",
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
                    vm.jobs.data.unshift(response.data.data);
                    vm.reset();

                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تم عرض الوظيفة بنجاح",
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
    },

    created() {
        this.profile_id = JSON.parse(localStorage.getItem("user")).profile_id;
        this.getJobs();
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

<style scoped></style>
