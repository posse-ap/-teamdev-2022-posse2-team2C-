$(".LikesIcon").on("click", function () {
  let $btn = $(this);
  // Likeアイコンがonクラス持っていたら
  if ($btn.hasClass("on")) {
    $btn.removeClass("on");
    $btn.removeClass("HeartAnimation");
    $btn.css("background-position", "left");
  } else {
    $btn.addClass("on");
    $btn.addClass("HeartAnimation");
  }
});

$(".heart_link").on("click", function() {
    event.preventDefault();
    var link = $(this).attr('href');
    setTimeout(function() {
      location.href= link;
    }, 2000);
  });
