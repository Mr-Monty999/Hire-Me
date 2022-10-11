<template>
    <div>
        <loading v-if="!loaded"></loading>
        <main v-if="loaded" class="container rounded mt-5 mb-5">
            <div></div>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";
import ViewPosts from "../../components/posts/ViewPosts.vue";
import Loading from "../../components/bootstrap/Loading.vue";

// import ModalSnippet from "../../components/bootstrap/ModalSnippet.vue";

export default {
    components: {
        ViewPosts,
        Loading,
        // ModalSnippet,
    },
    data() {
        return {
            profile_id: 0,
            posts: {},
            loaded: false,
        };
    },
    methods: {},

    created() {
        this.profile_id = JSON.parse(localStorage.getItem("user")).profile_id;
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
