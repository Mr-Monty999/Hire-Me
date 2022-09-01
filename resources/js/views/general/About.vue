<template>
    <div>
        <header-bar></header-bar>
        <main class="container d-flex flex-column align-items-center">
            About
        </main>
        <footer-bar></footer-bar>
    </div>
</template>

<script>
import axios from "axios";
import HeaderBar from "../../components/layouts/HeaderBar.vue";
import FooterBar from "../../components/layouts/FooterBar.vue";

export default {
    components: {
        HeaderBar,
        FooterBar,
    },
};
</script>

<style scoped></style>
