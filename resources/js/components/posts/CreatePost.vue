<template>
    <div>
        <div class="container px-4 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="card">
                    <div class="row px-3">
                        <img
                            class="profile-pic mr-3"
                            src="https://i.imgur.com/6tPhTUn.jpg"
                        />
                        <div class="flex-column">
                            <h3 class="mb-0 font-weight-normal">
                                Camilla Perez
                            </h3>
                            <select hidden name="privacy" class="privacy">
                                <option>Public post</option>
                                <option>Private post</option>
                            </select>
                        </div>
                    </div>
                    <div class="row px-3 form-group">
                        <textarea
                            class="text-muted bg-light mt-4 mb-3"
                            placeholder="مرحبا,ماذا يدور في بالك اليوم؟"
                        ></textarea>
                    </div>
                    <div class="row px-3">
                        <p class="fa fa-image options mr-4 col-1"></p>
                        <i class="options fa fa-ellipsis-h col-1"> </i>
                    </div>
                    <div class="btn btn-success ml-auto">نشر</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "CreatePost",
    components: {},
};
</script>

<style scoped>
/* your CSS goes here*/
body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #00c853;
    background-repeat: no-repeat;
}

.card {
    border-radius: 10px;
    width: 500px;
    padding: 20px;
    margin-top: 50px;
    margin-bottom: 50px;
}

.profile-pic {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: contain;
    background-color: #e0e0e0;
}

textarea {
    padding: 15px 20px;
    border-radius: 10px;
    box-sizing: border-box;
    color: #616161;
    border: 1px solid #f5f5f5;
    font-size: 16px;
    letter-spacing: 1px;
    height: 120px !important;
    width: 100%;
}

textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #00c853 !important;
    outline-width: 0 !important;
}

select {
    border: none;
    font-size: 15px;
    background-color: #fff !important;
}

select:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0 !important;
}

::placeholder {
    color: #bdbdbd;
}

:-ms-input-placeholder {
    color: #bdbdbd;
}

::-ms-input-placeholder {
    color: #bdbdbd;
}

.btn-success {
    border-radius: 50px;
    padding: 4px 40px;
}

.options {
    font-size: 23px;
    color: #757575;
    cursor: pointer;
}

.options:hover {
    color: #000;
}
</style>
