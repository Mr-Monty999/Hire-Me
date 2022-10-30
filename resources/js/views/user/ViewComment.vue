<template>
    <div>
        <div class="mar-1">
            <div class="comment">
                <img
                    v-if="comment.user.profile.avatar != null"
                    class="photo"
                    :src="comment.user.profile.avatar"
                    alt=""
                    @click="goToUserProfile(comment.user.id)"
                />
                <img
                    v-else
                    class="photo"
                    src="/images/assets/personal.jpg"
                    alt=""
                    @click="goToUserProfile(comment.user.id)"
                />
                <b
                    @click="goToUserProfile(comment.user.id)"
                    class="text-break fullname"
                >
                    {{ comment.user.profile.firstname }}
                    {{ comment.user.profile.lastname }}
                </b>
                <span v-if="comment.user.id == user_id" class="actions">
                    <modal-snippet
                        closeButtonName="إغلاق"
                        launchButtonName="حذف"
                        iconLaunchButton
                        confirmButtonName="حذف"
                        title="حذف تعليق"
                        launchButtonClass="fa-solid fa-trash text-danger"
                        confirmButtonClass="btn btn-danger"
                        :name="'deleteComment' + comment.id"
                        confirmAndClosed
                        @confirmEvent="deleteComment(comment)"
                    >
                        هل أنت متأكد من حذف هذا التعليق؟
                    </modal-snippet>
                </span>
                <span v-if="comment.mention" class="text-break">
                    <br />
                    <mark class="text-bold mention text-primary">
                        @{{ comment.mention.profile.firstname }}
                        {{ comment.mention.profile.lastname }}
                    </mark>
                    <br />
                </span>
                <div class="text-break">
                    <span class="comment-content">{{ comment.content }} </span>
                </div>
            </div>
            <div
                class="d-flex gap-3 align-items-center"
                style="margin-right: 20px"
            >
                <span
                    v-if="comment.replies_count > 0 && !repliesLoaded"
                    @click="loadReplies(parentComment)"
                    class="muted-color comment-bar"
                    >{{ comment.replies_count }} رد
                    <i class="fa-solid fa-sort-down"></i>
                </span>
                <span
                    v-else-if="comment.replies_count > 0 && repliesLoaded"
                    @click="hideReplies(parentComment)"
                    class="muted-color comment-bar"
                >
                    {{ comment.replies_count }} رد
                    <i class="fa-solid fa-sort-up"></i>
                </span>
                <span class="muted-color comment-bar" @click="enableReply()">
                    رد
                </span>
                <span class="muted-color comment-bar comment-time">
                    {{ comment.created_at_diff_for_humans }}
                </span>
            </div>
        </div>
        <div
            v-if="replyEnabled"
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
                placeholder="رد"
                ref="comment"
                v-model="content"
                :max-height="350"
                rows="1"
                class="form-control"
                @keyup.enter.native="
                    sendReply(post, content, parentComment, comment.user)
                "
                important
            />
            <div hidden class="fonts">
                <i class="fa fa-camera"></i>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";

import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

export default {
    name: "ViewComment",

    components: {
        ModalSnippet,
    },
    data() {
        return {
            user_id: 0,
            content: "",
            repliesLoaded: false,
            replyEnabled: false,
        };
    },
    methods: {
        deleteComment(comment) {
            var vm = this;
            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري حذف التعليق " + spinner,
                type: "info",
            });

            axios
                .delete("/api/comments/" + comment.id, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);

                    var index = vm.post.comments.findIndex(
                        (el) => el.id == comment.id
                    );

                    vm.post.comments.splice(index, 1);

                    vm.$emit("renderComment");
                    vm.$forceUpdate();

                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تم حذف التعليق بنجاح",
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
        loadReplies(comment) {
            let vm = this;

            axios
                .get("/api/comments/" + comment.id + "/replies", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    comment.replies = response.data.data;
                    vm.$emit("renderComment");
                    vm.repliesLoaded = true;
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
            this.$emit("renderComment");
            this.repliesLoaded = false;
        },
        sendReply(post, commentContent, parentComment, mention) {
            let vm = this;
            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري مشاركة الرد" + spinner,
                type: "info",
            });

            axios
                .post(
                    "/api/comments",
                    {
                        content: commentContent,
                        post_id: post.id,
                        user_id: vm.user_id,
                        comment_id: parentComment.id,
                        mention_id: mention.id,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    if (!parentComment.replies) parentComment.replies = [];
                    parentComment.replies.push(response.data.data);

                    parentComment.replies_count += 1;
                    vm.replyEnabled = false;
                    vm.$emit("renderComment");
                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تمت مشاركة التعليق بنجاح",
                        type: "success",
                    });
                    vm.content = "";
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
        enableReply() {
            /*
            this.content =
                // "<span class='text-primary'>" +
                "@" +
                this.comment.user.profile.firstname +
                " " +
                this.comment.user.profile.lastname +
                "\n ";
            // "</span><br>";
*/
            if (!this.replyEnabled) this.replyEnabled = true;
            else this.replyEnabled = false;
        },
        goToUserProfile(userId) {
            if (userId != this.$route.params.id) {
                let url = this.$router.resolve({
                    name: "profile",
                    params: {
                        id: userId,
                    },
                });

                window.open(url.href, "_blank");
            }
        },
    },
    props: ["post", "comment", "parentComment"],
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

.comment-bar {
    font-size: 11px;
    cursor: pointer;
    /* display: flex;
    justify-content: center;
    align-items: center; */
    font-weight: bold;
    position: relative;
}
.fa-sort-up {
    transform: translateY(47%);
}

.comment-bar:hover {
    color: #65676b !important;
}
.comment-time {
    cursor: initial;
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
    cursor: pointer;
}
.comment-content {
    font-size: 16px;
}
.comment {
    padding: 10px;
    border-radius: 10px;
    background-color: #ededed;
    width: fit-content;
    min-width: 35%;
}

.mention {
    font-size: 16px;
    border-radius: 5px;
    padding: 3px;
    background-color: transparent;
    /* color: #065fd4; */
}
textarea {
    border-radius: 10px !important;
}
</style>
