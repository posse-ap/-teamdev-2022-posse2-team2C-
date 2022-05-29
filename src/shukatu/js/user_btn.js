//お気に入りから削除ボタン
const favo_delete_btn = document.querySelector(".user_favorite__btn_delete");
const delete_label = document.querySelectorAll(".delete_label");
const delete_checkbox = document.querySelectorAll(".delete_checkbox");

delete_label.forEach(function(element,index){
  element.setAttribute("onclick", `delete_btn_op(${index})`);
});

function delete_btn_op(i){
  if(delete_checkbox[i].checked){
    favo_delete_btn.style.display = "none";
    delete_checkbox.forEach(function(element,index){
      if(index !== i){
        if(element.checked){
          favo_delete_btn.style.display = "block";
        }
      }
    })
  } else {
    favo_delete_btn.style.display = "block";
    console.log("a");
  }
}