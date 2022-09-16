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
                        <create-post></create-post>
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
// import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

export default {
    components: {
        CreatePost,
        // ModalSnippet,
    },
};
</script>

<style scoped></style>
