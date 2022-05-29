const agree = document.querySelector("#agree");
const ok_btn = document.querySelector(".student_info__form_btn_ok");
const agree_area = document.querySelector(".student_info__form_agree_checkbox");

agree_area.addEventListener("click", function(){
    if(agree.checked){
        ok_btn.classList.remove("untouchable");
    } else {
        ok_btn.classList.add("untouchable");
    }
})


