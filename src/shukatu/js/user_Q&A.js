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