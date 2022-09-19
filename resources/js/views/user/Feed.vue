<template>
    <div>
        <main class="container rounded mt-5 mb-5">
            <div class="row gap-4">
                <div class="col-md-2 border-right bg-mine">
                    <div
                        class="d-flex flex-column align-items-center text-center p-3 py-5"
                    ></div>
                </div>
                <div class="col-md-7 border-right bg-mine">
                    <div class="p-3 py-5">
                        <h3>المنشورات</h3>
                        <create-post :posts="posts"></create-post>
                        <view-posts
                            :onPageClick="getPosts"
                            :posts="posts"
                        ></view-posts>
                    </div>
                </div>
                <div class="col-md-2 bg-mine">
                    <div class="p-3 py-5"></div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";
import CreatePost from "../../components/posts/CreatePost.vue";
import ViewPosts from "../../components/posts/ViewPosts.vue";
import { watch } from "vue";

// import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

export default {
    components: {
        CreatePost,
        ViewPosts,
        // ModalSnippet,
    },
    data() {
        return {
            profile_id: 0,
            posts: {},
        };
    },
    methods: {
        getPosts(pageNumber = 1) {
            var vm = this;

            axios
                .get("/api/posts?page=" + pageNumber, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.posts = response.data.data;
                    scrollTo(0, 200);
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
    },
    created() {
        this.profile_id = JSON.parse(localStorage.getItem("user")).profile_id;
        this.getPosts();
    },
};
</script>

<style scoped></style>
