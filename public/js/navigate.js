document.addEventListener("DOMContentLoaded", init);
function init(){
    let profileButton = document.querySelector(".profile");
    if(profileButton !== null && profileButton !== undefined){
        let authid=parseInt(profileButton.dataset["index"]);
        sessionStorage.setItem("AuthId",authid);
    }
    
}

