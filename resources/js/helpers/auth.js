const token = localStorage.getItem("token");

const header = {
    "Content-Type": "application/json",
    Authorization: "Bearer " + token,
};

export default header;
