<template>
    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-12">
                <div class="card" v-for="(post, i) in posts.data" :key="i">
                    <div class="d-flex justify-content-between p-2 px-3">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <img
                                :src="post.profile.avatar"
                                width="50"
                                class="rounded-circle"
                            />
                            <div class="d-flex flex-column ml-2">
                                <span class="text-break name"
                                    >{{ post.profile.firstname }}
                                    {{ post.profile.lastname }}</span
                                >
                                <small class="mr-2 date">2 min ago</small>
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-1 ellipsis">
                            <!-- <i class="fa fa-ellipsis-h"></i> -->
                            <div class="dropdown">
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
                                        <!-- <button
                                            class="dropdown-item"
                                            @click.prevent="deletePost(post.id)"
                                        >
                                            حذف
                                        </button> -->
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
                            </div>
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
                                <i class="fa fa-heart"></i>
                                <i class="fa fa-smile-o ml-2"></i>
                            </div>
                            <div class="d-flex flex-row muted-color">
                                <span>{{ post.comments.length }} comments</span>
                                |
                                <span class="ml-2">Share</span>
                            </div>
                        </div>
                        <hr />
                        <div class="comments">
                            <div class="comment-input">
                                <input type="text" class="form-control" />
                                <div class="fonts">
                                    <i class="fa fa-camera"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <paginate
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
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";
import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";
import Paginate from "vuejs-paginate";

export default {
    name: "ViewPosts",
    data() {
        return {};
    },
    components: {
        ModalSnippet,
        Paginate,
    },
    methods: {
        deletePost(postId) {
            var vm = this;

            axios
                .delete("/api/posts/" + postId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    var index = vm.posts.findIndex((el) => el.id == postId);
                    vm.posts.splice(index, 1);
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
    },
    computed: {},
    props: ["posts", "onPageClick"],
    created() {
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
.icons .fa-heart {
    color: red;
}
.icons .fa-smile-o {
    color: yellow;
    font-size: 29px;
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
a {
    text-decoration: none;
}
</style>
