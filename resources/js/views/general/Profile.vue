<template>
    <div>
        <profile-header-bar></profile-header-bar>
        <div v-if="myUserId == $route.params.id">
            <my-profile></my-profile>
        </div>
        <div v-else>
            <other-profiles></other-profiles>
        </div>
        <footer-bar></footer-bar>
    </div>
</template>

<script>
import ProfileHeaderBar from "../../components/layouts/ProfileHeaderBar.vue";
import FooterBar from "../../components/layouts/FooterBar.vue";
import MyProfile from "../../components/profile/MyProfile.vue";
import OtherProfiles from "../../components/profile/OtherProfiles.vue";

export default {
    data() {
        return {
            myUserId: 0,
        };
    },
    methods: {},
    components: {
        FooterBar,
        ProfileHeaderBar,
        OtherProfiles,
        MyProfile,
    },
    created() {
        let userId = JSON.parse(localStorage.getItem("user")).id;
        this.myUserId = userId;
    },
};
</script>

<style scoped>
body {
    background: rgb(99, 39, 120);
}

.form-control:focus {
    box-shadow: none;
    border-color: #ba68c8;
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none;
}

.profile-button:hover {
    background: #682773;
}

.profile-button:focus {
    background: #198754;
    box-shadow: none;
}

.profile-button:active {
    background: #682773;
    box-shadow: none;
}

.back:hover {
    color: #682773;
    cursor: pointer;
}

.labels {
    font-size: 11px;
}

.add-experience:hover {
    background: #ba68c8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #ba68c8;
}

textarea {
    resize: none;
}
</style>
