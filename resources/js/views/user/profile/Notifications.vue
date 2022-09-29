<template>
    <main class="contrainer-fluid">
        <div class="row">
            <div class="bg-mine col-md-2 offset-md-1 mar-1"></div>
            <div
                class="bg-mine height-v90 col-md-5 d-flex flex-column align-items-center mar-1"
            >
                <h1>الإشعارات</h1>
                <div
                    v-for="(notification, index) in notifications"
                    :key="index"
                    class="max-width"
                >
                    <div
                        @click="goToPost(notification.data.post_id)"
                        :class="'alert ' + getAlertClass(notification)"
                    >
                        <div v-if="profiles[index]">
                            <div>
                                <img
                                    v-if="profiles[index].avatar != null"
                                    class="photo"
                                    :src="profiles[index].avatar"
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
                                    {{ profiles[index].firstname }}
                                    {{ profiles[index].lastname }}
                                </b>
                                <div
                                    v-if="
                                        notification.type ==
                                        'App\\Notifications\\CreatePostNotification'
                                    "
                                    class="text-break"
                                >
                                    <b>قام بنشر منشور جديد </b>
                                    <span
                                        >"{{ notification.data.content }}"</span
                                    >
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
            </div>
        </div>
    </main>
</template>

<script>
import axios from "axios";
import headerAuth from "../../../helpers/auth";
export default {
    data() {
        return {
            profile_id: 0,
            notifications: {},
            profiles: [],
        };
    },
    methods: {
        getNotifications(profileId) {
            var vm = this;

            axios
                .get("/api/profiles/" + profileId + "/notifications", {
                    headers: headerAuth,
                })
                .then(async function (response) {
                    console.log(response);
                    vm.notifications = response.data.data.notifications;

                    for (const notification in vm.notifications) {
                        const id =
                            vm.notifications[notification].data.profile_id;

                        // vm.notifications[notification].data.profile =
                        //     await vm.getProfileInfo(id);

                        vm.profiles.push(await vm.getProfileInfo(id));
                    }
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        async getProfileInfo(profileId) {
            var vm = this;
            var data = null;
            await axios
                .get("/api/profiles/" + profileId + "/info", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    data = response.data.data;
                })
                .catch(function (error) {
                    console.log(error.response);
                });

            return data;
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
    components: {},
    created() {
        var vm = this;
        let profileId = JSON.parse(localStorage.getItem("user")).profile_id;
        vm.profile_id = profileId;
        vm.getNotifications(vm.profile_id);
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
</style>
