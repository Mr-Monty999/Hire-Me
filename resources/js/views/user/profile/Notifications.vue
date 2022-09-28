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
                    class="alert alert-info max-width"
                >
                    {{ notification.data }}
                    {{ notification.data }}
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
        };
    },
    methods: {
        async getNotifications(profileId) {
            var vm = this;

            await axios
                .get("/api/profiles/" + profileId + "/notifications", {
                    headers: headerAuth,
                })
                .then(async function (response) {
                    console.log(response);
                    vm.notifications = response.data.data.notifications;

                    for (const notification in vm.notifications) {
                        const id =
                            vm.notifications[notification].data.profile_id;
                        vm.notifications[notification].data.profile =
                            await vm.getProfileInfo(id);
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
</style>
