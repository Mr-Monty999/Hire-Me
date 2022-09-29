<template>
    <div>Connections</div>
</template>

<script>
export default {
    data() {
        return {
            myProfileId: 0,
        };
    },
    methods: {},
    components: {},
    created() {
        let profileId = JSON.parse(localStorage.getItem("user")).profile_id;
        this.myProfileId = profileId;
    },
};
</script>

<style scoped></style>
