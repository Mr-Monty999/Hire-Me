<template>
    <div>
        <header-bar></header-bar>
        <main class="container d-flex flex-column align-items-center">
            <img src="../../assets/images/about.png" alt="" />

            <h1>
                مشروع شغلني هو موقع يساعدك في إيجاد وعرض الوظائف بمختلف أنواعها
            </h1>
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

<style scoped>
@media only screen and (min-width: 0px) {
    img {
        width: 100%;
    }
}
@media only screen and (min-width: 500px) {
    img {
        width: 70%;
    }
}
@media only screen and (min-width: 1200px) {
    img {
        width: 50%;
    }
}
</style>
