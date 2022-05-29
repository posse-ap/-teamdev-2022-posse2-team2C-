//タグから探すボタン
const tag = document.querySelector(".tag");
const tag__background = document.querySelector(".tag__background");
function show_tag() {
  tag.style.display = "flex";
  tag__background.style.display = "block";
}
function hide_tag() {
  tag.style.display = "none";
  tag__background.style.display = "none";
}
document.querySelectorAll(".tag-search__btn").forEach(function (element) {
  element.addEventListener("click", function () {
    show_tag();
  });
});

tag__background.addEventListener("click", function () {
  hide_tag();
});

//エリアから探すボタン
const area = document.querySelector(".area");
const area__background = document.querySelector(".area__background");

document.querySelectorAll(".area-search__btn").forEach(function (element) {
  element.addEventListener("click", function () {
    show_area();
  });
});

function show_area() {
  area.style.display = "block";
  area__background.style.display = "block";
}
function hide_area() {
  area.style.display = "none";
  area__background.style.display = "none";
}

document
  .querySelector(".area-search__btn")
  .addEventListener("click", function () {
    show_area();
  });
area__background.addEventListener("click", function () {
  hide_area();
});

//エリア検索の挙動
//地域選択
const area__container = document.querySelectorAll(".area__container");
const region = document.querySelectorAll(".area__region");
const prefectures = document.querySelectorAll(".area__prefecture");
const btn_area = document.querySelector(".area__btn-area");

function rm_other_regions(n) {
  area__container.forEach(function (element, index) {
    if (index !== n) {
      element.style.display = "none";
    }
  });
}
function show_prefecture(n) {
  for (let i = 1; i < area__container[n].childElementCount; i++) {
    area__container[n].children[i].style.display = "block";
  }
}
function reset() {
  btn_area.innerHTML = "";
  for (let i = 0; i < prefectures.length; i++) {
    prefectures[i].style.display = "none";
  }
  area__container.forEach(function (element) {
    element.style.display = "flex";
  });
  region.forEach(function (element) {
    element.firstElementChild.checked = false;
  });
  prefectures.forEach(function (element) {
    element.firstElementChild.checked = false;
  });
  both_search_btn.classList.add("untouchable");
}
function determine() {
  hide_area();
}
function make_buttons() {
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
function select_region(n) {
  rm_other_regions(n);
  show_prefecture(n);
  make_buttons();
}

for (let i = 0; i < region.length; i++) {
  region[i].firstChild.setAttribute("onclick", `select_region(${i})`);
}

//検索ボタンの位置
const agents = document.querySelector(".top-page__agent_position");
const footer = document.querySelector("footer");
const searchBtn = document.querySelector(".both-search");
window.addEventListener("scroll", function () {
  const agents_position = agents.getBoundingClientRect().top;
  const search_area_pc = document.querySelector(".top_page__search_area_pc");
  if (agents_position < 0) {
    search_area_pc.classList.add("fixed");
  } else {
    search_area_pc.classList.remove("fixed");
  }

  const footer_position = footer.getBoundingClientRect().top;
  if (footer_position < screen.availHeight) {
    searchBtn.classList.add("float");
  } else {
    searchBtn.classList.remove("float");
  }
});

const footer_position_default = footer.getBoundingClientRect().top;
if (footer_position_default < screen.availHeight) {
  searchBtn.classList.add("float");
}

//スマホ版ボタン
const search_switcher = document.querySelector(".search_box_switcher");
const search_box = document.querySelector(".tag-area-search__wrapper");

search_switcher.addEventListener("click", function () {
  search_box.classList.toggle("shown");
  searchBtn.classList.toggle("shown");
});

//タグ、エリア選んでないとき
const checkboxes_tag = document.querySelectorAll(".tag__input");
const checkboxes_prefecture = document.querySelectorAll(".area__prefecture");
const both_search_btn = document.querySelector(".both-search");
const tag_reset_btn = document.querySelector("#rest_btn");

function search_btn_color(){
  both_search_btn.classList.add("untouchable");
  checkboxes_tag.forEach(function (element_tag) {
    if (element_tag.firstChild.checked) {
      checkboxes_prefecture.forEach(function (element_prefecture) {
        if (element_prefecture.firstChild.checked) {
          both_search_btn.classList.remove("untouchable");
        }
      });
    }
  });
}

checkboxes_tag.forEach(function (element) {
  element.firstChild.addEventListener("click", function () {
    search_btn_color();
  });
});

checkboxes_prefecture.forEach(function (element) {
  element.firstChild.addEventListener("click", function () {
    search_btn_color();
  });
});