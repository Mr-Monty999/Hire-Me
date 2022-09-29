<template>
    <div id="loading" class="d-flex justify-content-center align-items-center">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Loading",
    components: {},
};
</script>

<style>
#loading {
    background-color: white;
    width: 100vw;
    height: 100vh;
    /* position: fixed; */
    z-index: 1000;
}
</style>
