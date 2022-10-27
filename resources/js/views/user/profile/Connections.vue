<template>
    <main class="contrainer-fluid">
        <loading v-if="!loaded"></loading>
        <div v-if="loaded" class="row">
            <div class="bg-mine col-md-2 offset-md-1 mar-1"></div>
            <div
                class="bg-mine height-v90 col-md-5 d-flex flex-column align-items-center mar-1"
            >
                <h1>طلبات الإتصال</h1>
                <div
                    v-for="(connection, index) in connections.data"
                    :key="index"
                    class="max-width alert alert-info"
                >
                    <div :class="''">
                        <div>
                            <div>
                                <img
                                    v-if="connection.profile.avatar != null"
                                    class="photo"
                                    :src="connection.profile.avatar"
                                    alt=""
                                    @click="goToProfile(connection.id)"
                                />
                                <img
                                    v-else
                                    class="photo"
                                    src="/images/assets/personal.jpg"
                                    alt=""
                                    @click="goToProfile(connection.id)"
                                />
                                <b
                                    class="text-break fullname"
                                    @click="goToProfile(connection.id)"
                                >
                                    {{ connection.profile.firstname }}
                                    {{ connection.profile.lastname }}
                                </b>

                                <div class="text-break">
                                    <span>أرسل إليك طلب إتصال</span>
                                </div>
                                <div>
                                    <button
                                        @click="acceptConnection(connection.id)"
                                        class="btn btn-success"
                                    >
                                        تأكيد
                                    </button>
                                    <button
                                        @click="removeConnection(connection.id)"
                                        class="btn btn-danger"
                                    >
                                        حذف
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <paginate
                    v-if="connections.last_page > 1"
                    :page-count="connections.last_page"
                    :prev-text="'السابق'"
                    :per-page="connections.per_page"
                    :click-handler="getConnections"
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
            connections: {},
            users: [],
            loaded: false,
        };
    },
    methods: {
        getConnections(pageNumber = 1) {
            var vm = this;

            axios
                .get(
                    "/api/users/auth/connections/incomming?page=" + pageNumber,
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.connections = response.data.data;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        goToProfile(userId) {
            this.$router.push({
                name: "profile",
                params: {
                    id: userId,
                },
            });
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

                    var connectionIndex = vm.connections.data.findIndex(
                        (el) => el.id == targetUserId
                    );

                    vm.connections.data.splice(connectionIndex, 1);

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
                .delete("/api/users/auth/connections/remove/" + targetUserId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);

                    var connectionIndex = vm.connections.data.findIndex(
                        (el) => el.id == targetUserId
                    );

                    vm.connections.data.splice(connectionIndex, 1);

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
        vm.getConnections();
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
