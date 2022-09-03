function getToken() {
    var token = null;
    if (localStorage.getItem("user") != null)
        token = JSON.parse(localStorage.getItem("user")).token;

    return token;
}

const header = {
    "Content-Type": "application/json",
    Authorization: "Bearer " + getToken(),
};
export default header;
