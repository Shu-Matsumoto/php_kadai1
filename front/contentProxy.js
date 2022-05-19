import { SERVER_URL, SCRIPT_PATH } from "../back/serverDefine.js";

export class ContentProxy{

  // ユーザー認証
  static async DoAuthentication(userName, pw) {
    let params = new URLSearchParams();
    params.append("userName", userName);
    params.append("pw", pw);
    let result = await axios.post(SERVER_URL + SCRIPT_PATH + "doAuthentication.php", params);
    //console.log(result.data);
    return result.data.pass;
  }

  // ユーザ追加
  static async AddUser(userName, pw, profileImg) {

    let params = new URLSearchParams();
    params.append("userName", userName);
    params.append("pw", pw);
    let result = await axios.post(SERVER_URL + SCRIPT_PATH + "addUser.php", params);
    return result.data;
  }

  // チャンネル作成
  // channelName:チャンネルネーム
  static CreateChannel(channelName) {

    let params = new URLSearchParams();
    params.append("channelName", channelName);
    axios.post(SERVER_URL + SCRIPT_PATH + "createChannel.php", params)
      .then(response => {
        console.log(response.data);
      })
      .catch(error => {
        console.log(error);
      });
  }

  // チャンネルリスト取得
  static async GetChannelList() {

    // awaitしないと正常に戻り値が返らない
    let result = await axios.post(SERVER_URL + SCRIPT_PATH + "getChannelList.php", null);
    //console.log(result.data.channelList);
    return result.data.channelList;
  }

  // チャンネルの内容取得
  // channelName:チャンネルネーム
  static async GetChannelContents(channelName) {

    let params = new URLSearchParams();
    params.append("channelName", channelName);
    
    // awaitしないと正常に戻り値が返らない
    let result = await axios.post(SERVER_URL + SCRIPT_PATH + "getChannelContents.php", params)
    //console.log(result.data);
    return result.data.contentsArray;
  }

  // チャンネルへ内容追加
  // channelName:チャンネルネーム
  static async AddContentsToChannel(channelName, userName, contents) {
    let params = new URLSearchParams();
    params.append("channelName", channelName);
    params.append("time", new Date().toLocaleString());
    params.append("user", userName);
    params.append("contents", contents);
    // const params = {
    //   channelName: channelName,
    //   time: new Date().toLocaleString(),
    //   user: userName,
    //   contents: contents,
    // };
    let result = await axios.post(SERVER_URL + SCRIPT_PATH + "addContentsToChannel.php", params);
    //console.log(result.data);
    return result.data;
  }
}