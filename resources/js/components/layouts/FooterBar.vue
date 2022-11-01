<template>
    <footer
        dir="ltr"
        class="d-flex footer bg-success justify-content-between text-light align-items-center"
    >
        <div>
            <h4>Made By :</h4>
            <h6>Montaser Mohammed</h6>
            <h6>Ahmed Adel</h6>
            <h6>Mohammed Anwer</h6>
            <h6>Marwaa</h6>
            <h6>Munjeda</h6>
        </div>
        <div>
            <h4>Supervised By :</h4>
            <h6>Sufian Ali</h6>
        </div>
    </footer>
</template>

<script>
import axios from "axios";

export default {
    name: "FooterBar",
};
</script>

<style scoped>
footer {
    padding: 30px;
}
</style>
