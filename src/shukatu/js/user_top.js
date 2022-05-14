//タグから探すボタン
const tag = document.querySelector(".tag");
const tag__background = document.querySelector(".tag__background");
function show_tag(){
  tag.style.display = "block";
  tag__background.style.display = "block";
}
function hide_tag(){
  tag.style.display = "none";
  tag__background.style.display = "none";
}
document.querySelector(".tag-search__btn").addEventListener("click",function(){
  show_tag();
});
tag__background.addEventListener("click",function(){
  hide_tag();
})

//エリアから探すボタン
const area = document.querySelector(".area");
const area__background = document.querySelector(".area__background");

function show_area(){
  area.style.display = "block";
  area__background.style.display = "block";
}
function hide_area(){
  area.style.display = "none";
  area__background.style.display = "none";
}

document.querySelector(".area-search__btn").addEventListener("click",function(){
  show_area();
});
area__background.addEventListener("click",function(){
  hide_area();
})

//エリア検索の挙動
//地域選択
const area__container = document.querySelectorAll(".area__container");
const region = document.querySelectorAll(".area__region");
const prefectures = document.querySelectorAll(".area__prefecture");
const btn_area = document.querySelector(".area__btn-area");

function rm_other_regions(n){
  area__container.forEach(function(element,index){
    if(index !== n){
      element.style.display = "none";
    }
  })
}
function show_prefecture(n){
  for(let i = 1; i < area__container[n].childElementCount; i++){
    area__container[n].children[i].style.display = "block";
  }
}
function reset(){
  btn_area.innerHTML = "";
  for(let i = 0; i < prefectures.length; i++){
    prefectures[i].style.display = "none";
  }
  area__container.forEach(function(element){
    element.style.display = "flex";
  })
  region.forEach(function(element){
    element.firstElementChild.checked = false;
  })
  prefectures.forEach(function(element){
    element.firstElementChild.checked = false;
  })
}
function determine(){
  hide_area();
}
function make_buttons(){
  const reset_btn = document.createElement("div");
  const determination_btn = document.createElement("div");
  reset_btn.innerHTML = "リセット";
  determination_btn.innerHTML = "決定";
  reset_btn.id = "reset_btn";
  determination_btn.id = "determination_btn";
  reset_btn.setAttribute("onclick", "reset()");
  determination_btn.setAttribute("onclick", "determine()");
  btn_area.appendChild(reset_btn);
  btn_area.appendChild(determination_btn);
}
function select_region(n){
  rm_other_regions(n);
  show_prefecture(n);
  make_buttons();
}

for(let i = 0; i < region.length; i++){
  region[i].firstChild.setAttribute("onclick", `select_region(${i})`);
}