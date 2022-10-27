<template>
    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-title-center">
            <div class="col-md-12">
                <div
                    v-for="(data, index) in users.data"
                    :key="index"
                    class="max-width alert alert-light mar-1"
                >
                    <div :class="''">
                        <div>
                            <div>
                                <img
                                    v-if="data.avatar != null"
                                    class="photo"
                                    :src="data.avatar"
                                    alt=""
                                    @click="goToProfile(data.user.id)"
                                />
                                <img
                                    v-else
                                    class="photo"
                                    src="/images/assets/personal.jpg"
                                    alt=""
                                    @click="goToProfile(data.user.id)"
                                />
                                <b
                                    class="text-break fullname"
                                    @click="goToProfile(data.user.id)"
                                >
                                    {{ data.firstname }}
                                    {{ data.lastname }}
                                </b>

                                <div class="text-break">
                                    <span>
                                        {{
                                            data.user.followers_count | toNumber
                                        }}
                                        متابع
                                    </span>
                                </div>
                                <div>
                                    <span
                                        class="btn btn-warning mar-1"
                                        v-if="
                                            data.user.connection_request ==
                                            false
                                        "
                                        @click="removeConnection(data.user.id)"
                                        >في إنتظار القبول
                                        <i class="fa-solid fa-user-plus"></i
                                    ></span>
                                    <span
                                        class="btn btn-danger mar-1"
                                        v-else-if="
                                            data.user.connection_request == true
                                        "
                                        @click="removeConnection(data.user.id)"
                                        >إلغاء الأتصال<i
                                            class="fa-solid fa-minus"
                                        ></i
                                    ></span>
                                    <span
                                        class="btn btn-success mar-1"
                                        v-else
                                        @click="addConnection(data.user.id)"
                                        >إتصال
                                        <i class="fa-solid fa-user-plus"></i
                                    ></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <paginate
                v-if="users.last_page > 1"
                :page-count="users.last_page"
                :prev-text="'السابق'"
                :per-page="users.per_page"
                :click-handler="onPageClick"
                :page-range="3"
                :margin-pages="2"
                :next-text="'التالي'"
                :page-link-class="'page-link'"
                :prev-link-class="'page-link'"
                :next-link-class="'page-link'"
                :container-class="'pagination'"
                :page-class="'page-item'"
            ></paginate>
        </div>
        <!-- <modal name="my-modal">hello</modal> -->
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";
import headerFormAuth from "../../helpers/formAuth";
import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";
import Paginate from "vuejs-paginate";

export default {
    name: "ViewJobs",
    data() {
        return {};
    },
    components: {
        ModalSnippet,
        Paginate,
    },
    methods: {
        getUsers() {},
        clearData() {
            this.title = "";
            this.description = "";
            this.location = "";
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
        previewAvatar(avatar) {
            if (!avatar) {
                return "/images/assets/personal.jpg";
            }
            return avatar;
        },
        addConnection(targetUserId) {
            var vm = this;
            let userIndex = vm.users.data.findIndex(
                (e) => e.user.id == targetUserId
            );
            vm.users.data[userIndex].user.connection_request = false;
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
            let userIndex = vm.users.data.findIndex(
                (e) => e.user.id == targetUserId
            );
            vm.users.data[userIndex].user.connection_request = null;
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
    },
    computed: {},
    props: ["users", "onPageClick"],
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
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
.photo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-left: 5px;
}
</style>
