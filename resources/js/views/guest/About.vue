<template>
    <div>
        <main class="container d-flex flex-column align-items-center">
            <img src="/images/assets/about.png" alt="" />

            <h1>
                مشروع شغلني هو موقع يساعدك في إيجاد وعرض الوظائف بمختلف أنواعها
            </h1>
        </main>
    </div>
</template>

<script>
import axios from "axios";
export default {
    components: {},
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
