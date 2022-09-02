let token = null;
if (localStorage.getItem("user") != null)
    token = JSON.parse(localStorage.getItem("user")).token;

const header = {
    "Content-Type": "application/json",
    Authorization: "Bearer " + token,
};
export default header;
