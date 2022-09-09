<template>
    <div>
        <header-bar v-if="!isUser()"></header-bar>
        <profile-header-bar v-else></profile-header-bar>
        <router-view></router-view>
        <footer-bar></footer-bar>
    </div>
</template>

<script>
import HeaderBar from "./HeaderBar.vue";
import ProfileHeaderBar from "./ProfileHeaderBar.vue";
import FooterBar from "./FooterBar.vue";

export default {
    components: {
        HeaderBar,
        ProfileHeaderBar,
        FooterBar,
    },
    methods: {
        isUser() {
            var routes = ["profile", "profile.edit"];
            if (routes.includes(this.$route.name)) return true;

            return false;
        },
        isAdmin() {
            var routes = ["admin", "admin.edit"];
            if (routes.includes(this.$route.name)) return true;

            return false;
        },
    },
};
</script>

<style scoped></style>
