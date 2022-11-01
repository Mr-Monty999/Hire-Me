<template>
    <div>
        <!-- Button trigger modal -->

        <i
            v-if="iconLaunchButton"
            :class="launchButtonClass"
            data-bs-toggle="modal"
            :data-bs-target="'#' + name"
            @click="$emit('onLaunchButtonClick')"
        ></i>
        <button
            v-else
            :class="launchButtonClass"
            data-bs-toggle="modal"
            :data-bs-target="'#' + name"
            @click="$emit('onLaunchButtonClick')"
        >
            {{ launchButtonName }}
        </button>

        <!-- Modal -->
        <div
            class="modal fade"
            :id="name"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            tabindex="-1"
            :aria-labelledby="name + 'Label'"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" :id="name + 'Label'">
                            {{ title }}
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <slot />
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="$emit('closeEvent')"
                            data-bs-dismiss="modal"
                        >
                            {{ closeButtonName }}
                        </button>
                        <button
                            v-if="confirmAndClosed"
                            @click="$emit('confirmEvent')"
                            data-bs-dismiss="modal"
                            type="button"
                            :class="confirmButtonClass"
                        >
                            {{ confirmButtonName }}
                        </button>
                        <button
                            v-else
                            type="button"
                            @click="$emit('confirmEvent')"
                            :class="confirmButtonClass"
                        >
                            {{ confirmButtonName }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "ModalSnippet",
    components: {},
    props: {
        launchButtonName: String,
        closeButtonName: String,
        confirmButtonName: String,
        confirmAndClosed: Boolean,
        title: String,
        launchButtonClass: String,
        confirmButtonClass: String,
        name: String,
        iconLaunchButton: Boolean,
    },
};
</script>

<style scoped>
i {
    cursor: pointer !important;
}
</style>
