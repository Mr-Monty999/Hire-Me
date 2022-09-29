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
                        @click="goToPost(notification.data.post_id)"
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
                                    @click="
                                        goToProfile(
                                            notification.data.profile_id
                                        )
                                    "
                                />
                                <img
                                    v-else
                                    class="photo"
                                    src="/images/assets/personal.jpg"
                                    alt=""
                                    @click="
                                        goToProfile(
                                            notification.data.profile_id
                                        )
                                    "
                                />
                                <b
                                    class="text-break fullname"
                                    @click="
                                        goToProfile(
                                            notification.data.profile_id
                                        )
                                    "
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
                                        "{{ notification.data.content }}"
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
            profile_id: 0,
            notifications: {},
            profiles: [],
            loaded: false,
        };
    },
    methods: {
        getNotifications(pageNumber = 1) {
            var vm = this;

            axios
                .get(
                    "/api/profiles/" +
                        this.profile_id +
                        "/notifications?page=" +
                        pageNumber,
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.notifications = response.data.data.notifications;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        goToProfile(profileId) {
            this.$router.push({
                name: "profile",
                params: {
                    id: profileId,
                },
            });
        },
        goToPost(postId) {
            this.$router.push({
                name: "post",
                params: {
                    id: postId,
                },
            });
        },
        getAlertClass(notification) {
            if (notification.read_at == null) return "alert-info";
            else return "alert-light";
        },
    },
    components: {
        Paginate,
        Loading,
    },
    created() {
        var vm = this;
        let profileId = JSON.parse(localStorage.getItem("user")).profile_id;
        vm.profile_id = profileId;
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
