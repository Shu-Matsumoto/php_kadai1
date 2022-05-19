import { ContentProxy } from "./front/contentProxy.js";

// ログインボタンクリック時イベント
$("#login_button").on("click", () => {
  // ユーザ名取得
  let userName = $("#input_name").val();
  // PW取得
  let pw = $("#input_password").val();
  console.log(userName + " , " + pw);

  // ユーザ認証
  ContentProxy.DoAuthentication(userName, pw).then((result) => {
    let loginPass = result;
    console.log(loginPass);
    // ログイン情報判定結果チェック
  if (loginPass) {
    $(document.body).fadeOut("slow", function(){
      window.location.href = "../front/main.html" + "?" +
        "username=" + encodeURIComponent(userName);
    });
  } else {
    alert("ユーザ名、パスワードが誤っています。");
  }
  });
});

// ユーザ登録ボタンクリック時イベント
$("#user_registration_button").on("click", () => {
  $(document.body).fadeOut("slow", function(){
      window.location.href = "./front/addUser.html";
    });
});