<template>
    <div class="container mt-5 mb-5">
        <loading v-if="!loaded"></loading>
        <div
            v-if="loaded"
            class="row d-flex align-items-center justify-content-center"
        >
            <div class="col-md-12" v-if="post && post.user">
                <!-- <div class="card" v-for="(post, i) in posts.data" :key="i"> -->
                <div class="d-flex justify-content-between p-2 px-3">
                    <div class="d-flex flex-row align-items-center gap-2">
                        <img
                            :src="previewAvatar(post.user.profile.avatar)"
                            width="50"
                            class="rounded-circle"
                            @click="goToProfile(post.user.profile.id)"
                        />
                        <div class="d-flex flex-column ml-2">
                            <span class="text-break name"
                                >{{ post.user.profile.firstname }}
                                {{ post.user.profile.lastname }}</span
                            >
                            <small class="mr-2 date">{{
                                post.created_at_diff_for_humans
                            }}</small>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-row mt-1 gap-2"
                        v-if="post.user_id == user_id"
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
                            :name="'editPost'"
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
                                        :for="'photo'"
                                    >
                                        <input
                                            type="file"
                                            :name="'photo'"
                                            hidden
                                            :id="'photo'"
                                            @change="getFile"
                                        />
                                    </label>
                                    <!-- </div> -->
                                    <i class="options fa fa-ellipsis-h col-1">
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
                            :name="'deletePost'"
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
                                            :name="'deletePost' "
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
                            class="d-flex flex-row icons d-flex align-items-center gap-1"
                        >
                            <i
                                v-if="post.react_type == 1"
                                class="fa-solid fa-thumbs-up text-primary"
                                @click="removeReactFromPost(user_id, post.id)"
                            ></i>
                            <i
                                v-else
                                class="fa-solid fa-thumbs-up"
                                @click="reactToPost(user_id, post.id, 1)"
                            ></i>
                            <span>
                                {{ post.likes_count | toNumber }}
                            </span>
                            <i
                                v-if="post.react_type == 2"
                                class="fa-solid fa-thumbs-down text-primary"
                                @click="removeReactFromPost(user_id, post.id)"
                            ></i>
                            <i
                                v-else
                                class="fa-solid fa-thumbs-down"
                                @click="reactToPost(user_id, post.id, 2)"
                            ></i>
                            <span>
                                {{ post.dislikes_count | toNumber }}
                            </span>
                        </div>
                        <!-- <div class="d-flex flex-row muted-color">
                            <span>التعليقات {{ post.comments.length }}</span>
                        </div> -->
                    </div>
                    <hr />
                    <div class="comments">
                        <div
                            class="comment-input d-flex justify-content-center align-items-center"
                        >
                            <img
                                v-if="post.user.profile.avatar != null"
                                class="photo"
                                :src="post.user.profile.avatar"
                                alt=""
                            />
                            <img
                                v-else
                                class="photo"
                                src="/images/assets/personal.jpg"
                                alt=""
                            />
                            <textarea-autosize
                                placeholder="أكتب تعليقك"
                                ref="myTextarea"
                                v-model="post.comment"
                                :max-height="350"
                                rows="1"
                                class="form-control"
                                @keyup.enter.native="
                                    sendComment(post, post.comment)
                                "
                                important
                            />
                            <div hidden class="fonts">
                                <i class="fa fa-camera"></i>
                            </div>
                        </div>
                        <div
                            v-if="post.comments_count > 0"
                            class="d-flex gap-3"
                        >
                            <span
                                v-if="!post.commentsLoaded"
                                @click="loadComments(post)"
                                class="muted-color load-comments"
                                >إظهار {{ post.comments_count }}
                                تعليق
                                <i class="fa-solid fa-arrow-rotate-left"></i
                            ></span>
                            <span
                                v-else-if="post.commentsLoaded"
                                @click="hideComments(post)"
                                class="muted-color load-comments"
                                >إخفاء التعليقات
                                <i class="fa-solid fa-arrow-rotate-right"></i
                            ></span>
                        </div>
                        <div v-for="(comment, i) in post.comments" :key="i">
                            <div class="comment">
                                <comment
                                    :post="post"
                                    :comment="comment"
                                    :parentComment="comment"
                                    @renderComment="$forceUpdate()"
                                    :loadRepliesById="
                                        $route.params.parentCommentId
                                    "
                                />
                            </div>
                            <div v-for="(reply, x) in comment.replies" :key="x">
                                <div class="reply">
                                    <comment
                                        :post="post"
                                        :comment="reply"
                                        :parentComment="comment"
                                        @renderComment="$forceUpdate()"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <h1>عفوا هذا المنشور غير موجود</h1>
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
import Comment from "../../views/user/Comment.vue";

export default {
    name: "Post",
    data() {
        return {
            content: "",
            photo: "",
            previewPhoto: "",
            post: {
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
        Comment,
    },
    methods: {
        getFile(e) {
            this.previewPhoto = e.target.files[0];
            if (this.previewPhoto == undefined) this.previewPhoto = "";
        },
        editPost(postId) {
            var vm = this;
            vm.clearData();
            vm.content = vm.post.content;
            vm.photo = vm.post.photo;
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

                    vm.post.content = response.data.data.content;
                    vm.post.photo = response.data.data.photo;
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

                    vm.post = null;
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
        reactToPost(userId, postId, reactType) {
            var vm = this;

            vm.removeMyReacts(vm.post);
            vm.post.react_type = reactType;

            if (reactType == 1) {
                vm.post.likes_count += 1;
            } else if (reactType == 2) {
                vm.post.dislikes_count += 1;
            }

            vm.$notify({
                title: "نجاح",
                text: "تم التفاعل مع المنشور بنجاح",
                type: "success",
            });

            axios
                .post(
                    "/api/posts/" + postId + "/react",
                    {
                        user_id: userId,
                        type: reactType,
                        post_author: vm.post.user_id,
                        post_id: postId,
                    },
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
        removeReactFromPost(userId, postId) {
            var vm = this;

            vm.removeMyReacts(vm.post);
            vm.post.react_type = 0;

            vm.$notify({
                title: "نجاح",
                text: "تم التفاعل مع المنشور بنجاح",
                type: "success",
            });
            axios
                .delete("/api/posts/" + postId + "/unreact", {
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
        removeMyReacts(post) {
            if (post.react_type == 1 && post.likes_count > 0)
                post.likes_count -= 1;
            else if (post.react_type == 2 && post.dislikes_count > 0)
                post.dislikes_count -= 1;
        },
        sendComment(post, comment) {
            let vm = this;
            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري مشاركة التعليق" + spinner,
                type: "info",
            });
            let tempContent = post.comment;
            post.comment = "";

            axios
                .post(
                    "/api/comments",
                    {
                        content: comment,
                        post_id: post.id,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    if (!post.comments) post.comments = [];
                    post.comments.unshift(response.data.data);
                    post.comments_count += 1;
                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تمت مشاركة التعليق بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
                    post.comment = tempContent.trim();
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
        loadComments(post) {
            let vm = this;
            axios
                .get("/api/posts/" + post.id + "/comments", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    post.comments = response.data.data;
                    vm.$set(post, "commentsLoaded", true);
                    if (vm.$route.params.parentCommentId) {
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
        hideComments(post) {
            post.comments = [];
            this.$set(post, "commentsLoaded", false);
        },
        loadReplies(comment) {
            let vm = this;
            axios
                .get("/api/comments/" + comment.id + "/replies", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    comment.replies = response.data.data;
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
        hideReplies(comment) {
            comment.replies = [];
        },

        previewAvatar(avatar) {
            if (!avatar) {
                return "/images/assets/personal.jpg";
            }
            return avatar;
        },
        getPost(postId) {
            var vm = this;

            axios
                .get("/api/posts/" + postId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.post = response.data.data;

                    if (vm.$route.params.parentCommentId)
                        vm.loadComments(vm.post);
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
    },
    computed: {
        getPhoto() {
            if (this.previewPhoto)
                return URL.createObjectURL(this.previewPhoto);
            else if (this.photo) return this.photo;
        },
    },
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;

        this.getPost(this.$route.params.id);

        console.log("View Posts");
        console.log(this.posts);
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
img {
    cursor: pointer;
}
i {
    cursor: pointer;
}

.fa-arrow-rotate-left,
.fa-arrow-rotate-right {
    font-size: inherit;
}
.photo {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-left: 5px;
}
.fullname {
    font-size: 16px;
}

.comment {
    margin-right: 20px;
    margin-left: 10px;
}
.reply {
    margin-right: 60px;
    margin-left: 10px;
}

textarea {
    border-radius: 10px !important;
}
.load-comments {
    font-size: 15px;
    cursor: pointer;
}
.load-comments:hover {
    color: #65676b !important;
}
</style>
