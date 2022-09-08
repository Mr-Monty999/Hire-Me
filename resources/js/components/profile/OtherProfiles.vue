<template>
    <div>
        <main class="container rounded mt-5 mb-5">
            <div class="row gap-4">
                <div class="col-md-3 border-right bg-mine">
                    <div
                        class="d-flex flex-column align-items-center text-center p-3 py-5"
                    >
                        <img
                            class="rounded-circle mt-5"
                            width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                        /><span class="font-weight-bold"
                            >{{ firstname }} {{ lastname }}</span
                        >
                        <span class="text-black-50">{{ email }}</span
                        ><span>8,000 متابع </span>
                    </div>
                    <div>
                        <span>حول</span>
                        <textarea
                            class="form-control"
                            type="text"
                            aria-label="readonly input example"
                            readonly
                            v-model="about"
                        >
                        </textarea>
                    </div>
                </div>
                <div class="col-md-5 border-right bg-mine">
                    <div class="p-3 py-5">
                        <div
                            class="d-flex justify-content-between align-items-center mb-3"
                        >
                            <h4 class="text-right">الملف الشخصي</h4>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">تاريخ الميلاد:</label>
                                <div class="">
                                    {{ birthdate }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الدولة:</label>
                                <div class="">
                                    {{ country }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الولاية:</label>
                                <div class="">
                                    {{ state }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">المدينة:</label>
                                <div class="">
                                    {{ city }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الشارع:</label>
                                <div class="">
                                    {{ street }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">الموقع الإلكتروني:</label>
                                <div class="">
                                    {{ website }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">ارقام الهواتف:</label>
                                <div
                                    class=""
                                    v-for="(phone, i) in phones"
                                    :key="i"
                                >
                                    {{ phone.phone }}
                                </div>
                            </div>
                            <div class="p-3 row py-5">
                                <div
                                    class="d-flex justify-content-between align-items-center experience"
                                >
                                    <h3>التعليم</h3>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">الجامعة:</label>
                                    <div class="">
                                        {{ university }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels"
                                        >الدرجة العلمية:</label
                                    >
                                    <div class="">
                                        {{ degree }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">نوع التخصص:</label>
                                    <div class="">
                                        {{ study_type }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 py-0">
                        <h4>منشورات {{ firstname }} {{ nickname }}</h4>
                        <view-posts></view-posts>
                    </div>
                </div>
                <div class="col-md-3 bg-mine">
                    <div class="p-3 py-5">
                        <div
                            class="d-flex justify-content-between align-items-center experience"
                        >
                            <h3>الخبرات</h3>
                        </div>
                        <!-- <br /> -->
                        <div class="accordion" id="accordionExample">
                            <div
                                v-for="(exp, i) in experiences"
                                :key="i"
                                class="accordion-item"
                            >
                                <h2
                                    class="accordion-header"
                                    :id="'heading' + i"
                                >
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        :data-bs-target="'#collapse' + i"
                                        aria-expanded="false"
                                        :aria-controls="'collapse' + i"
                                    >
                                        <div>
                                            <h5>{{ exp.company_name }}</h5>
                                            <p class="bold">
                                                خبرة
                                                {{
                                                    calcExp(exp.start, exp.end)
                                                }}
                                            </p>
                                        </div>
                                    </button>
                                </h2>
                                <div
                                    :id="'collapse' + i"
                                    class="accordion-collapse collapse"
                                    :aria-labelledby="'heading' + i"
                                    data-bs-parent="#accordionExample"
                                >
                                    <div class="accordion-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    إسم الشركة
                                                </h4>
                                                <p class="text-center">
                                                    {{ exp.company_name }}
                                                </p>
                                            </li>
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    نوع العمل
                                                </h4>
                                                <p class="text-center">
                                                    {{ exp.position }}
                                                </p>
                                            </li>
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    بداية المنصب
                                                </h4>
                                                <p class="text-center">
                                                    {{ exp.start }}
                                                </p>
                                            </li>
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    نهاية المنصب
                                                </h4>
                                                <p class="text-center">
                                                    {{ exp.end }}
                                                </p>
                                            </li>
                                            <li class="list-group-item">
                                                <h4 class="text-center">
                                                    الخبرة
                                                </h4>
                                                <p class="text-center">
                                                    {{
                                                        calcExp(
                                                            exp.start,
                                                            exp.end
                                                        )
                                                    }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 py-5">
                            <div
                                class="d-flex justify-content-between align-items-center experience"
                            >
                                <h3>المهارات</h3>
                            </div>

                            <ul class="list-group list">
                                <li
                                    class="text-center list-group-item"
                                    v-for="(skill, i) in skills"
                                    :key="i"
                                >
                                    {{ skill.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import headerAuth from "../../helpers/auth";
import ViewPosts from "../../components/posts/ViewPosts.vue";

export default {
    data() {
        return {
            firstname: "",
            lastname: "",
            nickname: "",
            birthdate: "",
            email: "",
            about: "",
            avatar: "",
            background_photo: "",
            website: "",
            country: "",
            state: "",
            city: "",
            street: "",
            university: "",
            degree: "",
            study_type: "",
            skill_name: "",
            start: "",
            end: "",
            position: "",
            company_name: "",
            phone: "",
            phones: "",
            followers: "",
            experiences: "",
            skills: "",
            user_id: 0,
            profile_id: 0,
            success: null,
        };
    },
    methods: {
        getProfileInfo() {
            var vm = this;

            axios
                .get("/api/profiles/" + vm.$route.params.id + "", {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    vm.profile_id = response.data.id;
                    vm.firstname = response.data.firstname;
                    vm.lastname = response.data.lastname;
                    vm.nickname = response.data.nickname;
                    vm.birthdate = response.data.birthdate;
                    vm.about = response.data.about;
                    vm.avatar = response.data.avatar;
                    vm.background_photo = response.data.background_photo;
                    vm.website = response.data.website;
                    vm.country = response.data.country;
                    vm.city = response.data.city;
                    vm.state = response.data.state;
                    vm.street = response.data.street;
                    vm.university = response.data.university;
                    vm.degree = response.data.degree;
                    vm.study_type = response.data.study_type;
                    vm.phones = response.data.phones;
                    vm.skills = response.data.skills;
                    vm.experiences = response.data.experiences;
                    vm.email = response.data.user.email;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        calcExp(startDate, endDate) {
            var start = new Date(startDate),
                end = new Date(endDate);

            var diff = end.getFullYear() - start.getFullYear();

            if (diff > 0) return diff + " سنة";

            diff = end.getMonth() - start.getMonth();

            if (diff > 0) return diff + " شهر";

            diff = end.getDate() - start.getDate();

            if (diff > 0) return diff + " يوم";
        },
    },
    created() {
        this.getProfileInfo();
    },
    components: {
        ViewPosts,
    },
};
</script>

<style scoped>
body {
    /* background: rgb(99, 39, 120); */
}

.form-control:focus {
    box-shadow: none;
    /* border-color: #ba68c8; */
}

.profile-button {
    /* background: rgb(99, 39, 120); */
    box-shadow: none;
    border: none;
}

.profile-button:hover {
    /* background: #682773; */
}

.profile-button:focus {
    /* background: #198754; */
    box-shadow: none;
}

.profile-button:active {
    /* background: #682773; */
    box-shadow: none;
}

.back:hover {
    /* color: #682773; */
    cursor: pointer;
}

.labels {
    font-size: 25px;
    font-weight: bold;
}

.add-experience:hover {
    background: #ba68c8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #ba68c8;
}

textarea {
    resize: none;
    min-height: 300px;
}
</style>
