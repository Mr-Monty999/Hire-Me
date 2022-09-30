<template>
    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-12">
                <div class="card" v-for="(post, i) in posts.data" :key="i">
                    <div class="d-flex justify-content-between p-2 px-3">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <img
                                :src="previewAvatar(post.profile.avatar)"
                                width="50"
                                class="rounded-circle"
                                @click="goToProfile(post.profile.id)"
                            />
                            <div class="d-flex flex-column ml-2">
                                <span class="text-break name"
                                    >{{ post.profile.firstname }}
                                    {{ post.profile.lastname }}</span
                                >
                                <small class="mr-2 date">{{
                                    post.created_at
                                }}</small>
                            </div>
                        </div>
                        <div
                            class="d-flex flex-row mt-1 gap-2"
                            v-if="post.profile_id == profile_id"
                        >
                            <!-- <i class="fa fa-ellipsis-h"></i> -->
                            <modal-snippet
                                launchButtonName="تعديل"
                                closeButtonName="إغلاق"
                                confirmButtonName="تعديل"
                                title="تعديل منشورك"
                                iconLaunchButton
                                launchButtonClass="fa-solid fa-pen-to-square text-warning"
                                confirmButtonClass="btn btn-warning"
                                :name="'editPost' + i"
                                @confirmEvent="updatePost(post.id)"
                                @onLaunchButtonClick="editPost(post.id)"
                            >
                                <div class="col-md-12">
                                    <textarea
                                        type="text"
                                        class="form-control"
                                        placeholder="محتوى المنشور"
                                        name="content"
                                        cols="100px"
                                        v-model="content"
                                    ></textarea>
                                    <div
                                        class="d-flex justify-content-center mar-1"
                                    >
                                        <img
                                            :src="getPhoto"
                                            class="img-fluid"
                                            alt=""
                                        />
                                    </div>
                                    <div class="row px-3 mar-1">
                                        <!-- <div> -->
                                        <label
                                            class="fa fa-image options mr-4 col-1"
                                            :for="'photo' + i"
                                        >
                                            <input
                                                type="file"
                                                :name="'photo' + i"
                                                hidden
                                                :id="'photo' + i"
                                                @change="getFile"
                                            />
                                        </label>
                                        <!-- </div> -->
                                        <i
                                            class="options fa fa-ellipsis-h col-1"
                                        >
                                        </i>
                                    </div>
                                </div>
                            </modal-snippet>
                            <modal-snippet
                                closeButtonName="إغلاق"
                                launchButtonName="حذف"
                                iconLaunchButton
                                confirmButtonName="حذف"
                                title="حذف منشورك"
                                launchButtonClass="fa-solid fa-trash text-danger"
                                confirmButtonClass="btn btn-danger"
                                :name="'deletePost' + i"
                                confirmAndClosed
                                @confirmEvent="deletePost(post.id)"
                            >
                                هل أنت متأكد من حذف هذا المنشور؟
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
                                            :name="'deletePost' + i"
                                            confirmAndClosed
                                            @confirmEvent="deletePost(post.id)"
                                        >
                                            هل أنت متأكد من حذف هذا المنشور؟
                                        </modal-snippet>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                    </div>

                    <div>
                        <p class="text-justify p-2">
                            {{ post.content }}
                        </p>
                        <div class="d-flex justify-content-center">
                            <img :src="post.photo" class="img-fluid" />
                        </div>
                        <hr />
                        <div
                            class="d-flex justify-content-between align-items-center p-2"
                        >
                            <div
                                class="d-flex flex-row icons d-flex align-items-center"
                            >
                                <i
                                    v-if="reactType(post, profile_id) == 1"
                                    class="fa-solid fa-thumbs-up text-primary"
                                    @click="
                                        removeReactFromPost(profile_id, post.id)
                                    "
                                ></i>
                                <i
                                    v-else
                                    class="fa-solid fa-thumbs-up"
                                    @click="reactToPost(profile_id, post.id, 1)"
                                ></i>
                                <i
                                    v-if="reactType(post, profile_id) == 2"
                                    class="fa-solid fa-thumbs-down text-primary"
                                    @click="
                                        removeReactFromPost(profile_id, post.id)
                                    "
                                ></i>
                                <i
                                    v-else
                                    class="fa-solid fa-thumbs-down"
                                    @click="reactToPost(profile_id, post.id, 2)"
                                ></i>
                            </div>
                            <div class="d-flex flex-row muted-color">
                                <span
                                    >التعليقات {{ post.comments.length }}</span
                                >
                            </div>
                        </div>
                        <hr />
                        <div class="comments">
                            <div class="comment-input">
                                <textarea
                                    type="text"
                                    class="form-control"
                                ></textarea>
                                <div class="fonts">
                                    <i class="fa fa-camera"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <paginate
                v-if="posts.last_page > 1"
                :page-count="posts.last_page"
                :prev-text="'السابق'"
                :per-page="posts.per_page"
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
import services from "../../helpers/services";

export default {
    name: "ViewPosts",
    data() {
        return {
            content: "",
            photo: "",
            previewPhoto: "",
            profile_id: 0,
        };
    },
    components: {
        ModalSnippet,
        Paginate,
    },
    methods: {
        getFile(e) {
            this.previewPhoto = e.target.files[0];
            if (this.previewPhoto == undefined) this.previewPhoto = "";
        },
        editPost(postId) {
            var vm = this;
            vm.clearData();
            let postIndex = vm.posts.data.findIndex((el) => el.id == postId);
            vm.content = vm.posts.data[postIndex].content;
            vm.photo = vm.posts.data[postIndex].photo;
        },
        updatePost(postId) {
            var vm = this;
            let data = new FormData();
            data.append("content", vm.content);
            data.append("photo", vm.previewPhoto);
            data.append("_method", "put");
            axios
                .post("/api/posts/" + postId, data, {
                    headers: headerFormAuth,
                })
                .then(function (response) {
                    console.log(response);
                    let postIndex = vm.posts.data.findIndex(
                        (el) => el.id == postId
                    );
                    vm.posts.data[postIndex].content =
                        response.data.data.content;
                    vm.posts.data[postIndex].photo = response.data.data.photo;
                    vm.$notify({
                        title: "نجاح",
                        text: "تم تعديل المنشور بنجاح",
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
        deletePost(postId) {
            var vm = this;

            axios
                .delete("/api/posts/" + postId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    var index = vm.posts.data.findIndex(
                        (el) => el.id == postId
                    );
                    vm.posts.data.splice(index, 1);
                    vm.$notify({
                        title: "نجاح",
                        text: "تم حذف المنشور بنجاح",
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
            this.content = "";
            this.photo = "";
            this.previewPhoto = "";
        },
        showModal() {
            this.$modal.show("my-modal");
        },
        hideModal() {
            this.$modal.hide("my-modal");
        },
        goToProfile(profileId) {
            if (profileId != this.$route.params.id) {
                this.$router.push({
                    name: "profile",
                    params: {
                        id: profileId,
                    },
                });
            }
        },
        reactToPost(profileId, postId, reactType) {
            var vm = this;

            var postIndex = vm.posts.data.findIndex((el) => el.id == postId);
            var reactIndex = vm.posts.data[postIndex].reacts.findIndex(
                (el) => el.id == profileId
            );

            axios
                .post(
                    "/api/posts/" + postId + "/profiles",
                    {
                        profile_id: profileId,
                        type: reactType,
                        post_author: vm.posts.data[postIndex].profile_id,
                        post_id: postId,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);

                    vm.posts.data[postIndex].reacts.splice(reactIndex, 1);
                    vm.posts.data[postIndex].reacts.push(response.data.data);

                    vm.$notify({
                        title: "نجاح",
                        text: response.data.message,
                        type: "success",
                    });
                    // services.sendNotification({
                    //     type: 2,
                    //     profile_id: vm.profile_id,
                    //     post_id: postId,
                    //     react_type: reactType,
                    //     post_author: vm.posts.data[postIndex].profile_id,
                    // });
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
        removeReactFromPost(profileId, postId) {
            var vm = this;

            axios
                .delete("/api/posts/" + postId + "/profiles/" + profileId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);

                    var postIndex = vm.posts.data.findIndex(
                        (el) => el.id == postId
                    );

                    var reactIndex = vm.posts.data[postIndex].reacts.findIndex(
                        (el) => el.id == profileId
                    );
                    vm.posts.data[postIndex].reacts.splice(reactIndex, 1);

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
        // reactType(profileId, postId) {
        //     var vm = this;

        //     axios
        //         .get("/api/posts/" + postId + "/profiles/" + profileId+"/react-type", {
        //             headers: headerAuth,
        //         })
        //         .then(function (response) {
        //             console.log(response);
        //             return response.data.data;
        //         })
        //         .catch(function (error) {
        //             console.log(error.response);
        //             return false;
        //         });
        //     return false;
        // },
        reactType(post, profileId) {
            var reactIndex = post.reacts.findIndex((el) => el.id == profileId);

            if (reactIndex >= 0) {
                return post.reacts[reactIndex].pivot.type;
            }
            return 0;
        },
        previewAvatar(avatar) {
            if (!avatar) {
                return "/images/assets/personal.jpg";
            }
            return avatar;
        },
    },
    computed: {
        calcPageCount() {
            return this.posts.total / this.posts.per_page;
        },
        getPhoto() {
            if (this.previewPhoto)
                return URL.createObjectURL(this.previewPhoto);
            else if (this.photo) return this.photo;
        },
    },
    props: ["posts", "onPageClick"],
    created() {
        this.profile_id = JSON.parse(localStorage.getItem("user")).profile_id;

        console.log("View Posts");
        console.log(this.posts);
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
    justify-content: center;
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
