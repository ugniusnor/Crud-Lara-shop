function addNewMaster() {
    let active=false;
const button = document.getElementById("add_new_user");
button.addEventListener('click',()=>{
        document.querySelector(".popUp").style.display="block";
    document.querySelector(".closePop").addEventListener('click',()=>{
        document.querySelector(".popUp").style.display="none";

    })

   
})
}

export  {addNewMaster};


function addNewOutfit() {
    let active=false;
const button = document.getElementById("add_new_item");
button.addEventListener('click',()=>{
        document.querySelector(".popUp").style.display="block";
    document.querySelector(".closePop").addEventListener('click',()=>{
        document.querySelector(".popUp").style.display="none";

    })

   
})
}

export  {addNewOutfit};