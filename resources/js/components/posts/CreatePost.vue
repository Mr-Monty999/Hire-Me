<template>
    <div>
        <div class="container px-4 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="card">
                    <div class="row">
                        <img class="profile-pic" :src="previewAvatar" />
                        <div class="flex-column col-9">
                            <h5 class="mb-0 font-weight-normal">
                                {{ profile.firstname }} {{ profile.lastname }}
                            </h5>
                            <select hidden name="privacy" class="privacy">
                                <option>Public post</option>
                                <option>Private post</option>
                            </select>
                        </div>
                    </div>
                    <div class="row px-3 form-group">
                        <textarea
                            class="text-muted bg-light mt-4 mb-3"
                            :placeholder="
                                'مرحبا ' +
                                profile.firstname +
                                ' ' +
                                profile.lastname +
                                ' ماذا يدور في بالك ؟'
                            "
                            v-model="content"
                        ></textarea>
                    </div>
                    <div class="">
                        <img :src="getPhoto" class="img-fluid" alt="" />
                    </div>
                    <div class="row px-3 mar-1">
                        <!-- <div> -->
                        <label
                            class="fa fa-image options mr-4 col-1"
                            for="photo"
                        >
                            <input
                                type="file"
                                name="photo"
                                hidden
                                id="photo"
                                @change="getFile"
                            />
                        </label>
                        <!-- </div> -->
                        <i class="options fa fa-ellipsis-h col-1"> </i>
                    </div>
                    <div class="d-flex justify-content-end">
                        <modal-snippet
                            launchButtonName="نشر"
                            closeButtonName="إغلاق"
                            confirmButtonName="نشر"
                            title="نشر منشور"
                            launchButtonClass="btn btn-success"
                            confirmButtonClass="btn btn-success"
                            name="createPost"
                            confirmAndClosed
                            @confirmEvent="createPost()"
                        >
                            هل أنت متأكد من نشر هذا المنشور؟
                        </modal-snippet>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import headerFormAuth from "../../helpers/formAuth";
import headerAuth from "../../helpers/auth";

import services from "../../helpers/services";

import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

export default {
    name: "CreatePost",
    data() {
        return {
            profile: {},
            content: "",
            photo: "",
            previewPhoto: "",
            user_id: "",
        };
    },
    props: ["posts"],
    components: {
        ModalSnippet,
    },

    methods: {
        getUserInfo() {
            var vm = this;

            axios
                .get("/api/users/" + vm.user_id + "/profile", {
                    headers: headerFormAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.profile = response.data.data;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        createPost() {
            var vm = this;
            let data = new FormData();
            data.append("content", vm.content);
            data.append("photo", vm.previewPhoto);
            // data.append("likes_count", 0);
            // data.append("dislikes_count", 0);
            // data.append("photo", vm.previewPhoto);
            // data.append("user_id", vm.user_id);

            var spinner =
                '<div class="spinner-border text-white" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                "</div>";

            vm.$notify({
                title: "في الإنتظار...",
                text: "جاري نشر المنشور " + spinner,
                type: "info",
            });
            axios
                .post("/api/posts/", data, {
                    headers: headerFormAuth,
                })
                .then(function (response) {
                    console.log(response);

                    vm.$notify({
                        clean: true,
                    });
                    vm.$notify({
                        title: "نجاح",
                        text: "تم نشر المنشور بنجاح",
                        type: "success",
                    });
                    // vm.posts.data.unshift(response.data.data);
                    vm.content = "";
                    vm.photo = "";
                    vm.previewPhoto = "";
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

        getFile(e) {
            this.previewPhoto = e.target.files[0];
            if (this.previewPhoto == undefined) this.previewPhoto = "";
        },
    },
    computed: {
        getPhoto() {
            if (this.previewPhoto)
                return URL.createObjectURL(this.previewPhoto);
            else if (this.photo) return this.photo;
        },
        previewAvatar() {
            if (!this.profile.avatar) {
                return "/images/assets/personal.jpg";
            }
            return this.profile.avatar;
        },
    },
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
        this.getUserInfo();
    },
};
</script>

<style scoped>
/* your CSS goes here*/
body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #00c853;
    background-repeat: no-repeat;
}

.card {
    border-radius: 10px;
    width: 500px;
    padding: 20px;
    margin-top: 50px;
    margin-bottom: 50px;
}

.profile-pic {
    width: 88px;
    height: 60px;
    border-radius: 50%;
    /* object-fit: contain;
    background-color: #e0e0e0; */
}

textarea {
    padding: 15px 20px;
    border-radius: 10px;
    box-sizing: border-box;
    color: #616161;
    border: 1px solid #f5f5f5;
    font-size: 16px;
    letter-spacing: 1px;
    height: 120px !important;
    width: 100%;
}

textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #00c853 !important;
    outline-width: 0 !important;
}

select {
    border: none;
    font-size: 15px;
    background-color: #fff !important;
}

select:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0 !important;
}

::placeholder {
    color: #bdbdbd;
}

:-ms-input-placeholder {
    color: #bdbdbd;
}

::-ms-input-placeholder {
    color: #bdbdbd;
}

.btn-success {
    /* border-radius: 50px; */
    align-self: flex-end;
}

.options {
    font-size: 23px;
    color: #757575;
    cursor: pointer;
}

.options:hover {
    color: #000;
}
</style>
