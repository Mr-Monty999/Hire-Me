<template>
    <div>
        <div class="mar-1">
            <div class="comment">
                <img
                    v-if="comment.user.profile.avatar != null"
                    class="photo"
                    :src="comment.user.profile.avatar"
                    alt=""
                />
                <img class="photo" src="/images/assets/personal.jpg" alt="" />
                <b class="text-break fullname">
                    {{ comment.user.profile.firstname }}
                    {{ comment.user.profile.lastname }}
                </b>
                <span
                    v-if="comment.mention"
                    class="text-break text-bold mention text-primary"
                >
                    <br />
                    @{{ comment.mention.profile.firstname }}
                    {{ comment.mention.profile.lastname }}
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
                    v-if="comment.replies_count > 0"
                    @click="loadReplies(comment)"
                    class="muted-color comment-bar"
                    >اظهار الردود
                    <i class="fa-solid fa-sort-down"></i>
                </span>
                <!-- <span
                    v-if="comment.replies_count > 0"
                    @click="hideReplies(comment)"
                    class="muted-color comment-bar"
                    >إخفاء الردود <i class="fa-solid fa-arrow-rotate-right"></i
                ></span> -->
                <span class="muted-color comment-bar"> رد </span>
                <span class="muted-color comment-bar">
                    {{ comment.created_at_diff_for_humans }}
                </span>
            </div>
        </div>
        <div hidden class="comment-input">
            <textarea-autosize
                placeholder="رد"
                ref="comment"
                v-model="comment.comment"
                :min-height="30"
                :max-height="350"
                class="form-control"
                @keyup.enter.native="
                    sendComment(
                        post,
                        comment.comment,
                        parentComment,
                        comment.user
                    )
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

// import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

export default {
    components: {
        // ModalSnippet,
    },
    data() {
        return {
            user_id: 0,
        };
    },
    methods: {
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
        sendComment(post, commentContent, parentComment, mention) {
            let vm = this;
            this.comment.comment = "";

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
                    // comment.replies.unshift(response.data.data);
                    vm.$notify({
                        title: "نجاح",
                        text: "تم مشاركة التعليق بنجاح",
                        type: "success",
                    });
                })
                .catch(function (error) {
                    this.comment.comment = commentContent;
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
    props: ["post", "comment", "parentComment"],
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
    },

    mounted: function () {
        let vm = this;
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
}

.comment-bar:hover {
    color: #65676b !important;
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
}
textarea {
    border-radius: 10px !important;
}
</style>
