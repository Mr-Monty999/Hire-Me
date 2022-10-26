<template>
    <main class="contrainer-fluid">
        <loading v-if="!loaded"></loading>
        <div v-if="loaded" class="row">
            <div class="bg-mine col-md-2 offset-md-1 mar-1"></div>
            <div
                class="bg-mine height-v90 col-md-5 d-flex flex-column align-items-center mar-1"
            >
                <h1>الإشعارات</h1>
                <div
                    v-for="(notification, index) in notifications.data"
                    :key="index"
                    class="max-width"
                >
                    <div
                        @click="
                            if (notification.data.post_id)
                                return showPost(notification.data.post_id);
                            else if (notification.data.job_id)
                                return showJob(notification.data.job_id);
                        "
                        :class="'alert ' + getAlertClass(notification)"
                    >
                        <div v-if="notification.data.profile">
                            <div>
                                <img
                                    v-if="
                                        notification.data.profile.avatar != null
                                    "
                                    class="photo"
                                    :src="notification.data.profile.avatar"
                                    alt=""
                                    @click="showUser(notification.data.user_id)"
                                />
                                <img
                                    v-else
                                    class="photo"
                                    src="/images/assets/personal.jpg"
                                    alt=""
                                    @click="showUser(notification.data.user_id)"
                                />
                                <b
                                    class="text-break fullname"
                                    @click="showUser(notification.data.user_id)"
                                >
                                    {{ notification.data.profile.firstname }}
                                    {{ notification.data.profile.lastname }}
                                </b>
                                <div
                                    v-if="
                                        notification.type ==
                                        'App\\Notifications\\CreatePostNotification'
                                    "
                                    class="text-break"
                                >
                                    <b>قام بنشر منشور جديد </b>
                                    <div class="limited">
                                        <span v-if="notification.data.post">
                                            "{{
                                                notification.data.post.content
                                            }}"
                                        </span>
                                    </div>
                                </div>
                                <div
                                    v-else-if="
                                        notification.type ==
                                        'App\\Notifications\\ReactToPostNotification'
                                    "
                                    class="text-break"
                                >
                                    <span>قام بالتفاعل مع منشورك</span>
                                    <i
                                        v-if="notification.data.react_type == 1"
                                        class="fa-solid fa-thumbs-up text-primary"
                                    ></i>
                                    <i
                                        v-else-if="
                                            notification.data.react_type == 2
                                        "
                                        class="fa-solid fa-thumbs-down text-primary"
                                    ></i>
                                </div>
                                <div
                                    v-else-if="
                                        notification.type ==
                                        'App\\Notifications\\OfferJobNotification'
                                    "
                                    class="text-break"
                                >
                                    <b>قام بعرض وظيفة جديدة</b>
                                    <div class="limited">
                                        <span v-if="notification.data.job">
                                            "{{ notification.data.job.title }}"
                                        </span>
                                    </div>
                                </div>
                                <div
                                    v-else-if="
                                        notification.type ==
                                        'App\\Notifications\\FollowNotification'
                                    "
                                    class="text-break"
                                >
                                    <b>يتابعك الأن</b>
                                </div>
                                <!-- <div
                                    v-else-if="
                                        notification.type ==
                                        'App\\Notifications\\ConnectionRequestNotification'
                                    "
                                    class="text-break"
                                >
                                    <span>أرسل إليك طلب إتصال</span>
                                    <div>
                                        <button
                                            @click="
                                                acceptConnection(
                                                    user_id,
                                                    notification.data.user_id
                                                )
                                            "
                                            class="btn btn-success"
                                        >
                                            تأكيد
                                        </button>
                                        <button
                                            @click="
                                                removeConnection(
                                                    user_id,
                                                    notification.data.user_id
                                                )
                                            "
                                            class="btn btn-danger"
                                        >
                                            حذف
                                        </button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <paginate
                    v-if="notifications.last_page > 1"
                    :page-count="notifications.last_page"
                    :prev-text="'السابق'"
                    :per-page="notifications.per_page"
                    :click-handler="getNotifications"
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
    </main>
</template>

<script>
import axios from "axios";
import headerAuth from "../../../helpers/auth";
import Paginate from "vuejs-paginate";
import Loading from "../../../components/bootstrap/Loading.vue";

export default {
    data() {
        return {
            user_id: 0,
            notifications: {},
            users: [],
            loaded: false,
        };
    },
    methods: {
        getNotifications(pageNumber = 1) {
            var vm = this;

            axios
                .get("/api/users/auth/notifications?page=" + pageNumber, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.notifications = response.data.data.notifications;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        showUser(userId) {
            this.$router.push({
                name: "profile",
                params: {
                    id: userId,
                },
            });
        },
        showPost(postId) {
            this.$router.push({
                name: "post",
                params: {
                    id: postId,
                },
            });
        },
        showJob(jobId) {
            this.$router.push({
                name: "job.show",
                params: {
                    id: jobId,
                },
            });
        },
        // showUser(userId) {
        //     this.$router.push({
        //         name: "user",
        //         params: {
        //             id: userId,
        //         },
        //     });
        // },
        getAlertClass(notification) {
            if (notification.read_at == null) return "alert-info";
            else return "alert-light";
        },
        acceptConnection(targetUserId) {
            var vm = this;
            axios
                .post(
                    "/api/users/auth/connections/accept",
                    {
                        target_user_id: targetUserId,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);

                    var notificationIndex = vm.notifications.data.findIndex(
                        (el) => el.data.user_id == targetUserId
                    );

                    vm.notifications.data.splice(notificationIndex, 1);

                    vm.$notify({
                        title: "نجاح",
                        text: "تم قبول طلب الإتصال بنجاح",
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
        removeConnection(targetUserId) {
            var vm = this;
            axios
                .delete("/api/users/auth/connections/remove" + targetUserId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);

                    var notificationIndex = vm.notifications.data.findIndex(
                        (el) => el.data.user_id == targetUserId
                    );

                    vm.notifications.data.splice(notificationIndex, 1);

                    vm.$notify({
                        title: "نجاح",
                        text: "تم حذف الطلب بنجاح",
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
    components: {
        Paginate,
        Loading,
    },
    created() {
        var vm = this;
        let userId = JSON.parse(localStorage.getItem("user")).id;
        vm.user_id = userId;
        vm.getNotifications();
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
main {
    padding: 10px;
    overflow-x: hidden;
}
.alert {
    margin-bottom: 5px !important;
}
.alert * {
    font-size: 16px;
}
.photo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-left: 5px;
}
img,
.fullname {
    cursor: pointer;
}
.fullname {
    font-size: 25px;
}
.alert:hover {
    background-color: #eceded;
}
.limited {
    overflow: hidden;
    max-height: 100px;
}
</style>
