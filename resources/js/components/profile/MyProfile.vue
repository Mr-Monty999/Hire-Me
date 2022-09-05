<template>
    <div class="root-div">
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
                        <span>
                            <!-- Button trigger modal -->
                            <button
                                type="button"
                                class="btn btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editProfileInfo"
                            >
                                تعديل الملف الشخصي
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="editProfileInfo"
                                tabindex="-1"
                                aria-labelledby="editProfileInfoLabel"
                                aria-hidden="true"
                            >
                                <div
                                    class="modal-dialog modal-dialog-scrollable"
                                >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5
                                                class="modal-title"
                                                id="editProfileInfoLabel"
                                            >
                                                تعديل المعلومات الشخصية
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="">
                                                <div class="d-flex mb-3"></div>
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                            >الإسم الأول</label
                                                        ><input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="الإسم الأول"
                                                            name="firstname"
                                                            v-model="firstname"
                                                        />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                            >إسم العائلة</label
                                                        ><input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="إسم العائلة"
                                                            name="lastname"
                                                            v-model="lastname"
                                                        />
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                            >اللقب</label
                                                        ><input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="اللقب"
                                                            name="nickname"
                                                            v-model="nickname"
                                                        />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label
                                                            for=""
                                                            class="form-label"
                                                            >حول</label
                                                        >
                                                        <textarea
                                                            name="about"
                                                            v-model="about"
                                                            class="form-control"
                                                            id=""
                                                            cols="50"
                                                            rows="5"
                                                            placeholder="عني"
                                                        ></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                        >
                                                            رقم الهاتف</label
                                                        ><input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="رقم الهاتف"
                                                            name="phone"
                                                            v-model="phone"
                                                        />
                                                    </div>
                                                    <div class="mt-1">
                                                        <button
                                                            @click="addPhone"
                                                            class="btn btn-success"
                                                            type="button"
                                                        >
                                                            اضافة رقم الهاتف
                                                        </button>
                                                    </div>
                                                    <div
                                                        class="alert alert-success text-center"
                                                        v-if="addPhoneSuccess"
                                                    >
                                                        تم اضافة الرقم بنجاح
                                                    </div>
                                                    <div
                                                        class="alert alert-danger text-center"
                                                        v-else-if="
                                                            addPhoneSuccess ==
                                                            false
                                                        "
                                                    >
                                                        الرجاء التحقق من
                                                        البيانات
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                            >تاريخ
                                                            الميلاد</label
                                                        ><input
                                                            type="date"
                                                            class="form-control"
                                                            placeholder="تاريخ الميلاد"
                                                            name="birthdate"
                                                            v-model="birthdate"
                                                        />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                            >الدولة</label
                                                        ><input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="الدولة"
                                                            name="country"
                                                            v-model="country"
                                                        />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                            >الولاية</label
                                                        ><input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="الولاية"
                                                            name="state"
                                                            v-model="state"
                                                        />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                            >المدينة</label
                                                        ><input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="المدينة"
                                                            name="city"
                                                            v-model="city"
                                                        />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                            >الشارع</label
                                                        ><input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="الشارع"
                                                            name="street"
                                                            v-model="street"
                                                        />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label
                                                            class="labels form-label"
                                                            >الموقع
                                                            الإلكتروني</label
                                                        ><input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="الموقع الإكتروني"
                                                            name="website"
                                                            v-model="website"
                                                        />
                                                    </div>
                                                    <div class="p-3 py-5">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center experience"
                                                        >
                                                            <h3>التعليم</h3>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label
                                                                class="labels form-label"
                                                                >الجامعة</label
                                                            ><input
                                                                type="text"
                                                                class="form-control"
                                                                placeholder="الجامعة"
                                                                name="university"
                                                                v-model="
                                                                    university
                                                                "
                                                            />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label
                                                                class="labels form-label"
                                                                >الدرجة
                                                                العلمية</label
                                                            ><input
                                                                type="text"
                                                                class="form-control"
                                                                placeholder="الدرجة العلمية"
                                                                name="degree"
                                                                v-model="degree"
                                                            />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label
                                                                class="labels form-label"
                                                                >نوع
                                                                التخصص</label
                                                            ><input
                                                                type="text"
                                                                class="form-control"
                                                                placeholder="نوع التخصص"
                                                                name="study_type"
                                                                v-model="
                                                                    study_type
                                                                "
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="alert alert-success text-center"
                                                    v-if="saveSuccess"
                                                >
                                                    تم حفظ الملف الشخصي بنجاح
                                                </div>
                                                <div
                                                    class="alert alert-danger text-center"
                                                    v-else-if="
                                                        saveSuccess == false
                                                    "
                                                >
                                                    الرجاء التحقق من البيانات
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                إغلاق
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                @click="savePersonalInfo()"
                                            >
                                                حفظ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                        <span class="text-black-50">{{ email }}</span
                        ><span>8,000 متابع </span>
                    </div>
                    <div>
                        <label for="" class="form-label">حول</label>
                        <textarea
                            name="about"
                            v-model="about"
                            class="form-control"
                            id=""
                            cols="50"
                            rows="5"
                            readonly
                            placeholder="عني"
                        ></textarea>
                    </div>
                </div>
                <div class="col-md-5 border-right bg-mine">
                    <div class="p-3 py-5">
                        <h4>منشوراتك</h4>
                        <div class="container mt-5 mb-5">
                            <div
                                class="row d-flex align-items-center justify-content-center"
                            >
                                <div class="col-md-12">
                                    <div class="card">
                                        <div
                                            class="d-flex justify-content-between p-2 px-3"
                                        >
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <img
                                                    src="https://i.imgur.com/UXdKE3o.jpg"
                                                    width="50"
                                                    class="rounded-circle"
                                                />
                                                <div
                                                    class="d-flex flex-column ml-2"
                                                >
                                                    <span
                                                        class="font-weight-bold"
                                                        >Jeanette Sun</span
                                                    >
                                                    <small class="text-primary"
                                                        >Collegues</small
                                                    >
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex flex-row mt-1 ellipsis"
                                            >
                                                <small class="mr-2"
                                                    >20 mins</small
                                                >
                                                <i class="fa fa-ellipsis-h"></i>
                                            </div>
                                        </div>
                                        <img
                                            src="https://i.imgur.com/xhzhaGA.jpg"
                                            class="img-fluid"
                                        />
                                        <div class="p-2">
                                            <p class="text-justify">
                                                Lorem ipsum dolor sit amet,
                                                consectetur adipiscing elit, sed
                                                do eiusmod tempor incididunt.
                                            </p>
                                            <hr />
                                            <div
                                                class="d-flex justify-content-between align-items-center"
                                            >
                                                <div
                                                    class="d-flex flex-row icons d-flex align-items-center"
                                                >
                                                    <i class="fa fa-heart"></i>
                                                    <i
                                                        class="fa fa-smile-o ml-2"
                                                    ></i>
                                                </div>
                                                <div
                                                    class="d-flex flex-row muted-color"
                                                >
                                                    <span>2 comments</span>
                                                    |
                                                    <span class="ml-2"
                                                        >Share</span
                                                    >
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="comments">
                                                <div class="comment-input">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                    />
                                                    <div class="fonts">
                                                        <i
                                                            class="fa fa-camera"
                                                        ></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 bg-mine">
                    <div class="p-3 py-5">
                        <div
                            class="d-flex justify-content-between align-items-center experience"
                        >
                            <h3>الخبرات</h3>
                        </div>
                        <br />

                        <div class="mt-1">
                            <!-- <button
                                @click="addExperience"
                                class="btn btn-success"
                                type="button"
                            >
                                اضافة الخبرة
                            </button> -->

                            <!-- Button trigger modal -->
                            <button
                                type="button"
                                class="btn btn-success"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                            >
                                خبرة جديدة
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="exampleModal"
                                tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true"
                            >
                                <div
                                    class="modal-dialog modal-dialog-scrollable"
                                >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5
                                                class="modal-title"
                                                id="exampleModalLabel"
                                            >
                                                إضافة خبرة جديدة
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <label class="labels"
                                                    >إسم الشركة</label
                                                ><input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="إسم الشركة"
                                                    name="company_name"
                                                    v-model="company_name"
                                                />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels"
                                                    >بداية المنصب</label
                                                ><input
                                                    type="date"
                                                    class="form-control"
                                                    placeholder="بداية المنصب"
                                                    name="start"
                                                    v-model="start"
                                                />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels"
                                                    >نهاية المنصب</label
                                                ><input
                                                    type="date"
                                                    class="form-control"
                                                    placeholder="نهاية المنصب"
                                                    name="end"
                                                    v-model="end"
                                                />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels"
                                                    >المنصب</label
                                                ><input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="المنصب"
                                                    name="position"
                                                    v-model="position"
                                                />
                                            </div>
                                            <div
                                                class="alert alert-success text-center"
                                                v-if="addExperienceSuccess"
                                            >
                                                تم اضافة الخبرة بنجاح
                                            </div>
                                            <div
                                                class="alert alert-danger text-center"
                                                v-else-if="
                                                    addExperienceSuccess ==
                                                    false
                                                "
                                            >
                                                الرجاء التحقق من البيانات
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                إغلاق
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                @click="addExperience"
                                            >
                                                إضافة
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                            <div class="mt-1">
                                <button
                                    type="button"
                                    class="btn btn-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#skillModal"
                                >
                                    مهارة جديدة
                                </button>

                                <!-- Modal -->
                                <div
                                    class="modal fade"
                                    id="skillModal"
                                    tabindex="-1"
                                    aria-labelledby="skillModalLabel"
                                    aria-hidden="true"
                                >
                                    <div
                                        class="modal-dialog modal-dialog-scrollable"
                                    >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5
                                                    class="modal-title"
                                                    id="skillModalLabel"
                                                >
                                                    إضافة مهارة جديدة
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <label class="labels"
                                                        >إسم المهارة</label
                                                    ><input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="إسم المهارة"
                                                        name="skill_name"
                                                        v-model="skill_name"
                                                    />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    إغلاق
                                                </button>
                                                <button
                                                    type="button"
                                                    data-bs-dismiss="modal"
                                                    class="btn btn-success"
                                                    @click="addSkill"
                                                >
                                                    إضافة
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="alert alert-success text-center"
                                v-if="addSkillSuccess"
                            >
                                تم اضافة المهارة بنجاح
                            </div>
                            <div
                                class="alert alert-danger text-center"
                                v-else-if="addSkillSuccess == false"
                            >
                                الرجاء التحقق من البيانات
                            </div>
                            <ul class="list-group list">
                                <li
                                    class="text-center list-group-item"
                                    v-for="(skill, i) in skills"
                                    :key="i"
                                >
                                    <p>{{ skill.name }}</p>
                                    <!-- <button

                                        class="btn btn-danger"
                                    >
                                        حذف
                                    </button> -->
                                    <!-- Button trigger modal -->
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        :data-bs-target="
                                            '#deleteSkillModal' + i
                                        "
                                    >
                                        حذف
                                    </button>

                                    <!-- Modal -->
                                    <div
                                        class="modal fade"
                                        :id="'deleteSkillModal' + i"
                                        tabindex="-1"
                                        :aria-labelledby="
                                            'deleteSkillModal' + i
                                        "
                                        aria-hidden="true"
                                    >
                                        <div
                                            class="modal-dialog modal-dialog-scrollable"
                                        >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5
                                                        class="modal-title"
                                                        :id="
                                                            'deleteSkillModal' +
                                                            i
                                                        "
                                                    >
                                                        حذف {{ skill.name }}
                                                    </h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>
                                                <div class="modal-body">
                                                    هل أنت متاكد من حذف
                                                    {{ skill.name }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button
                                                        type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal"
                                                    >
                                                        لا
                                                    </button>
                                                    <button
                                                        type="button"
                                                        data-bs-dismiss="modal"
                                                        class="btn btn-success"
                                                        @click="
                                                            deleteSkill(
                                                                profile_id,
                                                                skill.id
                                                            )
                                                        "
                                                    >
                                                        نعم
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
            saveSuccess: null,
            addExperienceSuccess: null,
            addPhoneSuccess: null,
            addSkillSuccess: null,
        };
    },
    methods: {
        savePersonalInfo(userId = this.user_id) {
            var vm = this;

            axios
                .put(
                    "/api/profiles/" + userId + "",
                    {
                        firstname: vm.firstname,
                        lastname: vm.lastname,
                        nickname: vm.nickname,
                        birthdate: vm.birthdate,
                        about: vm.about,
                        avatar: vm.avatar,
                        website: vm.website,
                        country: vm.country,
                        city: vm.city,
                        state: vm.state,
                        street: vm.street,
                        university: vm.university,
                        degree: vm.degree,
                        study_type: vm.study_type,
                    },
                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);

                    vm.saveSuccess = true;
                })
                .catch(function (error) {
                    vm.saveSuccess = false;
                    console.log(error.response);
                });
        },
        addExperience() {
            var vm = this;

            axios
                .post(
                    "/api/experiences",
                    {
                        company_name: vm.company_name,
                        start: vm.start,
                        end: vm.end,
                        position: vm.position,
                        profile_id: vm.profile_id,
                    },

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.experiences.push(response.data);
                    vm.company_name = "";
                    vm.start = "";
                    vm.end = "";
                    vm.position = "";

                    vm.addExperienceSuccess = true;
                })
                .catch(function (error) {
                    vm.addExperienceSuccess = false;
                    console.log(error.response);
                });
        },
        addSkill() {
            var vm = this;

            axios
                .post(
                    "/api/skills",
                    {
                        name: this.skill_name,
                        profile_id: vm.profile_id,
                    },

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.skills.push(response.data);
                    vm.skill_name = "";

                    vm.addSkillSuccess = true;
                })
                .catch(function (error) {
                    vm.addSkillSuccess = false;
                    console.log(error.response);
                });
        },
        addPhone() {
            var vm = this;

            axios
                .post(
                    "/api/profile-phones",
                    {
                        phone: vm.phone,
                        user_id: vm.user_id,
                    },

                    {
                        headers: headerAuth,
                    }
                )
                .then(function (response) {
                    console.log(response);
                    vm.phone = "";
                    vm.addPhoneSuccess = true;
                })
                .catch(function (error) {
                    vm.addPhoneSuccess = false;
                    console.log(error.response);
                });
        },
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
        deleteSkill(profileId, skillId) {
            var vm = this;

            axios
                .delete("/api/skills/detach/" + profileId + "/" + skillId, {
                    headers: headerAuth,
                })
                .then(function (response) {
                    console.log(response);
                    var index = vm.skills.findIndex((el) => el.id == skillId);
                    vm.skills.splice(index, 1);
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
    },
    created() {
        let userId = JSON.parse(localStorage.getItem("user")).id;
        this.user_id = userId;
        this.getProfileInfo();
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
    font-size: 16px;
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
.alert {
    margin-top: 10px;
    margin-bottom: 10px;
}

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");
body {
    background-color: #eee;
    font-family: "Poppins", sans-serif;
    font-weight: 300;
}
.card {
    border: none;
}
.ellipsis {
    color: #a09c9c;
}
hr {
    color: #a09c9c;
    margin-top: 4px;
    margin-bottom: 8px;
}
.muted-color {
    color: #a09c9c;
    font-size: 13px;
}
.ellipsis i {
    margin-top: 3px;
    cursor: pointer;
}
.icons i {
    font-size: 25px;
}
.icons .fa-heart {
    color: red;
}
.icons .fa-smile-o {
    color: yellow;
    font-size: 29px;
}
.rounded-image {
    border-radius: 50% !important;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    width: 50px;
}
.name {
    font-weight: 600;
}
.comment-text {
    font-size: 12px;
}
.status small {
    margin-right: 10px;
    color: blue;
}
.form-control {
    border-radius: 26px;
}
.comment-input {
    position: relative;
}
.fonts {
    position: absolute;
    right: 13px;
    top: 8px;
    color: #a09c9c;
}
.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #8bbafe;
    outline: 0;
    box-shadow: none;
}
</style>
