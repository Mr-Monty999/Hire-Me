<template>
    <div>
        <loading v-if="!loaded"></loading>
        <main v-if="loaded" class="container rounded mt-5 mb-5">
            <div class="row gap-md-4">
                <div class="col-md-2 border-right bg-mine radius-1">
                    <div
                        class="d-flex flex-column align-items-center text-center p-3 py-5"
                    ></div>
                </div>
                <div class="col-md-7 border-right bg-mine radius-1">
                    <div class="p-3 py-5">
                        <create-post :posts="posts"></create-post>
                        <h3>المنشورات</h3>
                        <view-posts
                            :onPageClick="getPosts"
                            :posts="posts"
                        ></view-posts>
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
import CreatePost from "../../components/posts/CreatePost.vue";
import ViewPosts from "../../components/posts/ViewPosts.vue";
import Loading from "../../components/bootstrap/Loading.vue";

// import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

export default {
    components: {
        CreatePost,
        ViewPosts,
        Loading,
        // ModalSnippet,
    },
    data() {
        return {
            user_id: 0,
            posts: {},
            loaded: false,
        };
    },
    methods: {
        getPosts(pageNumber = 1) {
            var vm = this;

            axios
                .get(
                    "/api/users/" +
                        this.user_id +
                        "/feedback/posts?page=" +
                        pageNumber,
                    {
                        headers: headerAuth,
                    }
                )
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
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
        this.getPosts();
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
