<template>
    <div>
        <loading v-if="!loaded"></loading>
        <main v-if="loaded" class="container rounded">
            <div>
                <select
                    v-model="selectedFilter"
                    class="form-select"
                    aria-label="Default select example"
                >
                    <option hidden value="1">الكل</option>
                    <option value="2">الأشخاص</option>
                    <option value="3">الوظائف</option>
                    <option value="4">المنشورات</option>
                </select>
                <div class="mar-1">
                    <view-posts
                        v-if="selectedFilter == 4"
                        :onPageClick="search"
                        :posts="searchedData"
                    ></view-posts>
                    <view-jobs
                        v-else-if="selectedFilter == 3"
                        :onPageClick="search"
                        :jobs="searchedData"
                    ></view-jobs>
                    <show-users
                        v-else-if="selectedFilter == 2"
                        :onPageClick="search"
                        :users="searchedData"
                    ></show-users>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";
import ViewPosts from "../../components/posts/ViewPosts.vue";
import Loading from "../../components/bootstrap/Loading.vue";
import Paginate from "vuejs-paginate";
import ViewJobs from "../../components/jobs/ViewJobs.vue";
import ShowUsers from "../user/ShowUsers.vue";

// import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

export default {
    components: {
        ViewPosts,
        Loading,
        Paginate,
        ViewJobs,
        ShowUsers,
        // ModalSnippet,
    },
    data() {
        return {
            user_id: 0,
            searchedData: [],
            selectedFilter: 2,
            loaded: false,
        };
    },
    methods: {
        search(pageNumber = 1) {
            var vm = this;

            if (vm.selectedFilter == 2) {
                axios
                    .get(
                        "/api/users/search/" +
                            this.$route.params.pattern +
                            "?page=" +
                            pageNumber,
                        {
                            headers: headerAuth,
                        }
                    )
                    .then(function (response) {
                        console.log(response);
                        vm.searchedData = null;
                        vm.searchedData = response.data.data;
                        scrollTo(0, 10);
                    })
                    .catch(function (error) {
                        console.log(error.response);
                    });
            } else if (vm.selectedFilter == 3) {
                axios
                    .get(
                        "/api/jobs/search/" +
                            this.$route.params.pattern +
                            "?page=" +
                            pageNumber,
                        {
                            headers: headerAuth,
                        }
                    )
                    .then(function (response) {
                        console.log(response);
                        vm.searchedData = null;
                        vm.searchedData = response.data.data;
                        scrollTo(0, 10);
                    })
                    .catch(function (error) {
                        console.log(error.response);
                    });
            } else if (vm.selectedFilter == 4) {
                axios
                    .get(
                        "/api/posts/search/" +
                            this.$route.params.pattern +
                            "?page=" +
                            pageNumber,
                        {
                            headers: headerAuth,
                        }
                    )
                    .then(function (response) {
                        console.log(response);
                        vm.searchedData = null;
                        vm.searchedData = response.data.data;
                        scrollTo(0, 10);
                    })
                    .catch(function (error) {
                        console.log(error.response);
                    });
            }
        },
        selectFilter(value) {
            this.filter = value;
        },
    },
    watch: {
        $route() {
            this.search();
        },
        selectedFilter() {
            this.search();
        },
    },
    created() {
        this.user_id = JSON.parse(localStorage.getItem("user")).id;
        this.search();
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
