function showAnswer(num){
  const target = document.querySelector(`#answer_${num}`);
  const mark = document.querySelector(`#show_ans_${num}`);
  if (target.style.display === "none"){
    target.style.display = "flex";
    mark.className = "hide_ans";
  }else{
    target.style.display = "none";
    mark.className = "show_ans";
  }
}

const show_ans_button = document.querySelectorAll(".show_ans_wrapper");

show_ans_button.forEach(function(element, index){
  element.setAttribute("onclick", `showAnswer(${index + 1})`);
})