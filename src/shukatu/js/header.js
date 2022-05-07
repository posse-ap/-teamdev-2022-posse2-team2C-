//現在のページのボタンの色を変化させる
const page_switch_link = document.querySelectorAll(".page_switch_link");

change_button_color();

function change_button_color(){
    page_switch_link.forEach(function(element){
        if(location.href === element.href){
            element.className = "page_switch_link_here";
        }
    })
}

//ハンバーガーメニュー
menu.addEventListener("click", function(){
    const menu = document.getElementById("menu");
    const nav_area = document.getElementById("nav_area");
    if (menu.className === "cross"){
        menu.className = "menu";
        nav_area.className = "hidden";
    }else{
        menu.className = "cross";
        nav_area.className = "shown";
    }
})