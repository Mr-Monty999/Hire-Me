<template>
    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-12">
                <div class="card" v-for="(post, i) in posts" :key="i">
                    <div class="d-flex justify-content-between p-2 px-3">
                        <div class="d-flex flex-row align-items-center">
                            <img
                                :src="post.profile.avatar"
                                width="50"
                                class="rounded-circle"
                            />
                            <div class="d-flex flex-column ml-2">
                                <span class="font-weight-bold"
                                    >{{ post.profile.firstname }}
                                    {{ post.profile.lastname }}</span
                                >
                                <small class="mr-2">2 min ago</small>
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-1 ellipsis">
                            <i class="fa fa-ellipsis-h"></i>
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
        </div>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";

export default {
    name: "ViewPosts",
    data() {
        return {};
    },
    components: {},
    methods: {},
    props: ["posts"],
    created() {},
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
    font-weight: 600;
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
</style>
