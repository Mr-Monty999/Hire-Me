import headerAuth from "../helpers/auth";
import axios from "axios";
const functions = {
    sendNotification(data) {
        axios
            .post("/api/notifications", data, {
                headers: headerAuth,
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error.response);
                var errors = error.response.data.errors;
            });
    },

    getNotifications(profileId) {},
};

export default functions;
