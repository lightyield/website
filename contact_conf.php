<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php //error_reporting(E_ALL | E_STRICT);
##-----------------------------------------------------------------------------------------------------------------##
#
#  PHPメールプログラム　フリー版 最終更新日2014/12/12
#　改造や改変は自己責任で行ってください。
#
#  今のところ特に問題点はありませんが、不具合等がありましたら下記までご連絡ください。
#  MailAddress: info@php-factory.net
#  name: K.Numata
#  HP: http://www.php-factory.net/
#
#  重要！！サイトでチェックボックスを使用する場合のみですが。。。
#  チェックボックスを使用する場合はinputタグに記述するname属性の値を必ず配列の形にしてください。
#  例　name="当サイトをしったきっかけ[]"  として下さい。
#  nameの値の最後に[と]を付ける。じゃないと複数の値を取得できません！
#
##-----------------------------------------------------------------------------------------------------------------##
if (version_compare(PHP_VERSION, '5.1.0', '>=')) {//PHP5.1.0以上の場合のみタイムゾーンを定義
	date_default_timezone_set('Asia/Tokyo');//タイムゾーンの設定（日本以外の場合には適宜設定ください）
}
/*-------------------------------------------------------------------------------------------------------------------
* ★以下設定時の注意点　
* ・値（=の後）は数字以外の文字列（一部を除く）はダブルクオーテーション「"」、または「'」で囲んでいます。
* ・これをを外したり削除したりしないでください。後ろのセミコロン「;」も削除しないください。
* ・また先頭に「$」が付いた文字列は変更しないでください。数字の1または0で設定しているものは必ず半角数字で設定下さい。
* ・メールアドレスのname属性の値が「Email」ではない場合、以下必須設定箇所の「$Email」の値も変更下さい。
* ・name属性の値に半角スペースは使用できません。
*以上のことを間違えてしまうとプログラムが動作しなくなりますので注意下さい。
-------------------------------------------------------------------------------------------------------------------*/


//---------------------------　必須設定　必ず設定してください　-----------------------

//サイトのトップページのURL　※デフォルトでは送信完了後に「トップページへ戻る」ボタンが表示されますので
$site_top = "https://lightyield.co.jp/";

// 管理者メールアドレス ※メールを受け取るメールアドレス(複数指定する場合は「,」で区切ってください 例 $to = "aa@aa.aa,bb@bb.bb";)
$to = "sales@lightyield.co.jp";

//フォームのメールアドレス入力箇所のname属性の値（name="○○"　の○○部分）
$Email = "メールアドレス";

/*------------------------------------------------------------------------------------------------
以下スパム防止のための設定　
※有効にするにはこのファイルとフォームページが同一ドメイン内にある必要があります
------------------------------------------------------------------------------------------------*/

//スパム防止のためのリファラチェック（フォームページが同一ドメインであるかどうかのチェック）(する=1, しない=0)
$Referer_check = 1;

//リファラチェックを「する」場合のドメイン ※以下例を参考に設置するサイトのドメインを指定して下さい。
$Referer_check_domain = "lightyield.co.jp";

//---------------------------　必須設定　ここまで　------------------------------------


//---------------------- 任意設定　以下は必要に応じて設定してください ------------------------


// 管理者宛のメールで差出人を送信者のメールアドレスにする(する=1, しない=0)
// する場合は、メール入力欄のname属性の値を「$Email」で指定した値にしてください。
//メーラーなどで返信する場合に便利なので「する」がおすすめです。
$userMail = 1;

// Bccで送るメールアドレス(複数指定する場合は「,」で区切ってください 例 $BccMail = "aa@aa.aa,bb@bb.bb";)
$BccMail = "";

// 管理者宛に送信されるメールのタイトル（件名）
$subject = "ホームページのお問い合わせ";

// 送信確認画面の表示(する=1, しない=0)
$confirmDsp = 1;

// 送信完了後に自動的に指定のページ(サンクスページなど)に移動する(する=1, しない=0)
// CV率を解析したい場合などはサンクスページを別途用意し、URLをこの下の項目で指定してください。
// 0にすると、デフォルトの送信完了画面が表示されます。
$jumpPage = 0;

// 送信完了後に表示するページURL（上記で1を設定した場合のみ）※httpから始まるURLで指定ください。
$thanksPage = "http://xxx.xxxxxxxxx/thanks.html";

// 必須入力項目を設定する(する=1, しない=0)
$requireCheck = 1;

/* 必須入力項目(入力フォームで指定したname属性の値を指定してください。（上記で1を設定した場合のみ）
値はシングルクォーテーションで囲み、複数の場合はカンマで区切ってください。フォーム側と順番を合わせると良いです。
配列の形「name="○○[]"」の場合には必ず後ろの[]を取ったものを指定して下さい。*/
$require = array('お名前','会社名','メールアドレス','お問い合わせ内容');


//----------------------------------------------------------------------
//  自動返信メール設定(START)
//----------------------------------------------------------------------

// 差出人に送信内容確認メール（自動返信メール）を送る(送る=1, 送らない=0)
// 送る場合は、フォーム側のメール入力欄のname属性の値が上記「$Email」で指定した値と同じである必要があります
$remail = 0;

//自動返信メールの送信者欄に表示される名前　※あなたの名前や会社名など（もし自動返信メールの送信者名が文字化けする場合ここは空にしてください）
$refrom_name = "";

// 差出人に送信確認メールを送る場合のメールのタイトル（上記で1を設定した場合のみ）
$re_subject = "送信ありがとうございました";

//フォーム側の「名前」箇所のname属性の値　※自動返信メールの「○○様」の表示で使用します。
//指定しない、または存在しない場合は、○○様と表示されないだけです。あえて無効にしてもOK
$dsp_name = 'お名前';

//自動返信メールの冒頭の文言 ※日本語部分のみ変更可
$remail_text = <<< TEXT

お問い合わせありがとうございました。
早急にご返信致しますので今しばらくお待ちください。

送信内容は以下になります。

TEXT;


//自動返信メールに署名（フッター）を表示(する=1, しない=0)※管理者宛にも表示されます。
$mailFooterDsp = 0;

//上記で「1」を選択時に表示する署名（フッター）（FOOTER～FOOTER;の間に記述してください）
$mailSignature = <<< FOOTER

──────────────────────
株式会社○○○○　佐藤太郎
〒150-XXXX 東京都○○区○○ 　○○ビル○F　
TEL：03- XXXX - XXXX 　FAX：03- XXXX - XXXX
携帯：090- XXXX - XXXX 　
E-mail:xxxx@xxxx.com
URL: http://www.php-factory.net/
──────────────────────

FOOTER;


//----------------------------------------------------------------------
//  自動返信メール設定(END)
//----------------------------------------------------------------------

//メールアドレスの形式チェックを行うかどうか。(する=1, しない=0)
//※デフォルトは「する」。特に理由がなければ変更しないで下さい。メール入力欄のname属性の値が上記「$Email」で指定した値である必要があります。
$mail_check = 1;

//全角英数字→半角変換を行うかどうか。(する=1, しない=0)
$hankaku = 0;

//全角英数字→半角変換を行う項目のname属性の値（name="○○"の「○○」部分）
//※複数の場合にはカンマで区切って下さい。（上記で「1」を指定した場合のみ有効）
//配列の形「name="○○[]"」の場合には必ず後ろの[]を取ったものを指定して下さい。
$hankaku_array = array('電話番号','金額');


//------------------------------- 任意設定ここまで ---------------------------------------------


// 以下の変更は知識のある方のみ自己責任でお願いします。


//----------------------------------------------------------------------
//  関数実行、変数初期化
//----------------------------------------------------------------------
$encode = "UTF-8";//このファイルの文字コード定義（変更不可）

if(isset($_GET)) $_GET = sanitize($_GET);//NULLバイト除去//
if(isset($_POST)) $_POST = sanitize($_POST);//NULLバイト除去//
if(isset($_COOKIE)) $_COOKIE = sanitize($_COOKIE);//NULLバイト除去//
if($encode == 'SJIS') $_POST = sjisReplace($_POST,$encode);//Shift-JISの場合に誤変換文字の置換実行
$funcRefererCheck = refererCheck($Referer_check,$Referer_check_domain);//リファラチェック実行

//変数初期化
$sendmail = 0;
$empty_flag = 0;
$post_mail = '';
$errm ='';
$header ='';

if($requireCheck == 1) {
	$requireResArray = requireCheck($require);//必須チェック実行し返り値を受け取る
	$errm = $requireResArray['errm'];
	$empty_flag = $requireResArray['empty_flag'];
}
//メールアドレスチェック
if(empty($errm)){
	foreach($_POST as $key=>$val) {
		if($val == "confirm_submit") $sendmail = 1;
		if($key == $Email) $post_mail = h($val);
		if($key == $Email && $mail_check == 1 && !empty($val)){
			if(!checkMail($val)){
				$errm .= "<p class=\"error_messe\">【".$key."】はメールアドレスの形式が正しくありません。</p>\n";
				$empty_flag = 1;
			}
		}
	}
}

if(($confirmDsp == 0 || $sendmail == 1) && $empty_flag != 1){

  try{
	//ini_set( 'display_errors', 1 );
    //チケット起票
		$adminBody="「".$subject."」からメールが届きました\n\n";
		$adminBody.="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
		$adminBody.= postToMail($_POST);//POSTデータを関数からセット
		$adminBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
		$adminBody.="送信された日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
		$adminBody.="送信者のIPアドレス：".@$_SERVER["HTTP_X_FORWARDED_FOR"]."\n";
		$adminBody.="送信者のホスト名：".getHostByAddr(getenv('HTTP_X_FORWARDED_FOR'))."\n";
		if($confirmDsp != 1){
			$adminBody.="問い合わせのページURL：".@$_SERVER['HTTP_REFERER']."\n";
		}else{
			$adminBody.="問い合わせのページURL：".@$_POST['httpReferer']."\n";
		}
		$ticketsubject="「${_POST[会社名]}」社";
		if($_POST[部署名／役職名] != '') {
			$ticketsubject.="「${_POST[部署名／役職名]}」";
		}
		$ticketsubject.="の「${_POST[お名前]}」様よりお問い合わせがありました";
    $ticketdata = array(
      'issue'=> array(
        'project_id'=>10,
        'tracker_id'=>3,
        'status_id'=>1,
        'subject'=>$ticketsubject,
        'description'=>$adminBody
      )
    );
		$ticketheaders = array(
		    'Accept: application/json',
		    'Content-Type: application/json',
		    'X-Redmine-API-Key: 2049136fa7bf689d725a542d8641624a1449449e'
    );
    $ticketdata_json = json_encode($ticketdata);
    //echo $ticketdata_json;
    //curl -v -H "X-Redmine-API-Key:2049136fa7bf689d725a542d8641624a1449449e" -H "Accept: application/json" -H "Content-type: application/json" -X POST -d '{"issue": {"project_id": 10,"tracker_id": 3,"status_id": 1,"subject": "title","description": "description"}}' https://yield:light@redmine.lightyield.co.jp/issues.json
    $ticketch = curl_init();
    //curl_setopt($ticketch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    //curl_setopt($ticketch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    //curl_setopt($ticketch, CURLOPT_HTTPHEADER, array('X-Redmine-API-Key: 2049136fa7bf689d725a542d8641624a1449449e'));
		curl_setopt($ticketch, CURLOPT_HTTPHEADER, $ticketheaders);
    curl_setopt($ticketch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ticketch, CURLOPT_POSTFIELDS, $ticketdata_json);
		curl_setopt($ticketch, CURLOPT_POST, true);
		curl_setopt($ticketch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ticketch, CURLOPT_HEADER, false);
    //curl_setopt($ticketch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ticketch, CURLOPT_URL, 'https://yield:light@redmine.lightyield.co.jp/issues.json');
    $ticketresult=curl_exec($ticketch);
    //echo 'RETURN:'.$ticketresult;
    curl_close($ticketch);
  } catch (Exception $e) {
  }

	try{
		//差出人に届くメールをセット
		if($remail == 1) {
			$userBody = mailToUser($_POST,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode);
			$reheader = userHeader($refrom_name,$to,$encode);
			$re_subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($re_subject,"JIS",$encode))."?=";
		}
		//管理者宛に届くメールをセット
		$adminBody = mailToAdmin($_POST,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp);
		$header = adminHeader($userMail,$post_mail,$BccMail,$to);
		$subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($subject,"JIS",$encode))."?=";

		mail($to,$subject,$adminBody,$header);
		//if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader);
	} catch (Exception $e) {
	}

}
else if($confirmDsp == 1){

/*　▼▼▼送信確認画面のレイアウト※編集可　オリジナルのデザインも適用可能▼▼▼　*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="initial-scale=1.0">
<title>お問い合わせ｜株式会社ライトイールド</title>
<link rel="stylesheet" href="css/base.css">
<style type="text/css">
<!--
.conf_wrapper{max-width: 625px;width: 100%;margin:0 auto;}
.conf_heading{padding:0 0 20px 0;}
.conf_cont{border-top:1px #999 dotted;padding:10px 0;}
.conf_cont_label{display:block}
.conf_cont_cont{display:block;word-break : break-all;word-wrap : break-word;  overflow-wrap : break-word;}
.submit_btn{display:inline-block;margin-top:20px;}
@media screen and ( min-width : 768px ) {
.conf_cont_label{display:inline-block;width:25%;vertical-align:top;}
.conf_cont_cont{display:inline-block;width:75%;}
}
-->
</style>
<!--[if lte IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<link rel="stylesheet" href="css/ie-base.css">
<![endif]-->
</head>
<body>
<header id="header">
  <div class="header_cont">
    <h1 class="header_heading"><a href="index.html" title="トップページへ">
     <svg version="1.1" id="header_logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
   y="0px" viewBox="456.5 0 87 97" style="enable-background:new 456.5 0 87 97;" xml:space="preserve">
   <foreignObject display="none" width="87" height="97"><img src="img/header_logo.png" alt="株式会社ライトイールドロゴ" width="87" height="97" /></foreignObject>
<g><title>株式会社ライトイールド</title><desc>株式会社ライトイールドロゴ</desc></g><g><g><path class="hl0" d="M458.3,33.2v-33l48.3,16.5L458.3,33.2z M462.1,5.6V28l32.8-11.2L462.1,5.6z"/><path class="hl0" d="M543.5,33.2l-48.3-16.5l48.3-16.5V33.2z M506.9,16.8l32.8,11.2V5.6L506.9,16.8z"/></g><g><g><path class="hl0" d="M470.8,63.1h-11.5V37.6h4.1v21.6h7.4V63.1z"/></g><g><path class="hl0" d="M478.5,63.1h-4.1V37.6h4.1V63.1z"/></g><g><path class="hl0" d="M493.6,63.6c-3.5,0-6.6-1.3-9.2-3.9c-2.5-2.6-3.8-5.7-3.8-9.3c0-3.7,1.3-6.8,3.9-9.4s5.7-3.9,9.4-3.9c2,0,3.9,0.4,5.6,1.2c1.6,0.8,3.3,2.1,4.9,4l0.1,0.1l-2.9,2.8l-0.1-0.1c-2-2.7-4.5-4.1-7.4-4.1c-2.6,0-4.8,0.9-6.6,2.7c-1.8,1.8-2.7,4-2.7,6.7c0,2.7,1,5,3,6.8c1.8,1.6,3.9,2.5,6,2.5c1.8,0,3.5-0.6,4.9-1.9c1.4-1.2,2.2-2.6,2.4-4.3h-6.3v-3.9h10.7v1c0,1.9-0.2,3.6-0.7,5.1c-0.4,1.4-1.2,2.7-2.2,3.8C500.3,62.2,497.3,63.6,493.6,63.6z"/></g><g><path class="hl0" d="M526.4,63.1h-4.1V51.4h-10.5v11.7h-4.1V37.6h4.1v9.8h10.5v-9.8h4.1V63.1z"/></g><g><path class="hl0" d="M537.7,63.1h-4.1V41.5h-5.8v-3.9h15.7v3.9h-5.8V63.1z"/></g></g><g><g><path class="hl0" d="M469,96.8h-4.2v-11l-8.3-14.5h4.7l5.7,9.9l5.7-9.9h4.7l-8.4,14.5L469,96.8L469,96.8z"/></g><g><path class="hl0" d="M483.8,96.8h-4.1V71.2h4.1V96.8z"/></g><g><path class="hl0" d="M503.1,96.8h-14.2V71.2h14.2v3.9H493v5.7h9.8v3.9H493v8.1h10.1V96.8z"/></g><g><path class="hl0" d="M518.6,96.8h-11.5V71.2h4.1v21.6h7.4V96.8z"/></g><g><path class="hl0" d="M526.6,96.8h-5.4V71.2h5.4c2.5,0,4.6,0.3,6,0.8c1.6,0.5,3,1.3,4.3,2.5c2.6,2.4,3.9,5.6,3.9,9.5s-1.4,7.1-4.1,9.5c-1.4,1.2-2.8,2.1-4.3,2.5C531.2,96.6,529.2,96.8,526.6,96.8z M525.3,92.9h1.6c1.7,0,3.1-0.2,4.2-0.5c1.1-0.4,2.1-1,3-1.8c1.8-1.7,2.8-3.9,2.8-6.5c0-2.7-0.9-4.9-2.7-6.6c-1.6-1.5-4.1-2.3-7.2-2.3h-1.6L525.3,92.9L525.3,92.9z"/></g></g></g>
</svg>
    </a></h1>
    <nav>
  	 <ul class="header_nav">
    	 <li><a href="index.html">トップ</a></li>
    	 <li><a href="about.html">会社概要</a></li>
    	 <li class="header_nav_cont_current"><a href="contact.html">お問い合わせ</a></li>
      </ul>
    </nav>
    <p class="header_link-fb"><a href="https://www.facebook.com/lightyield/" target="_blank" title="Facebookページへ">
    <svg version="1.1" id="header_fb_btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 33 33" style="enable-background:new 0 0 33 33;" xml:space="preserve">
     <foreignObject display="none" width="34" height="34"><img src="img/header_fb.png" alt="Facebookページへ" width="34" height="34" /></foreignObject>
     <g><title>Facebookページへ</title><desc>株式会社ライトイールドのフェイスブックはこちら</desc></g>
     <g><path class="fbh" d="M31.2,0c0.5,0,0.9,0.2,1.3,0.5S33,1.3,33,1.8v29.3c0,0.5-0.2,0.9-0.5,1.3S31.7,33,31.2,33h-8.4V20.2H27l0.6-5h-4.9v-3.2c0-0.8,0.2-1.4,0.5-1.8c0.3-0.4,1-0.6,2-0.6l2.6,0V5.2C27,5,25.7,5,24,5c-1.9,0-3.5,0.6-4.7,1.7c-1.2,1.1-1.8,2.8-1.8,4.9v3.7h-4.3v5h4.3V33H1.8c-0.5,0-0.9-0.2-1.3-0.5C0.2,32.1,0,31.7,0,31.2V1.8c0-0.5,0.2-0.9,0.5-1.3C0.9,0.2,1.3,0,1.8,0H31.2z"/></g></svg>
    </a></p>
  </div>
  <div class="header_img">
   <h1 class="header_img_heading"><img src="img/header_contact.jpg" alt="お問い合わせ｜株式会社ライトイールド" width="1200" height="340"></h1>
  </div>
</header>

<section id="about"><div class="main_cont">
  <h1 class="section_heading section_heading-works"><span class="section_heading_en">Contact</span><span class="section_heading_ja">お問い合わせ</span></h1>


  <div class="conf_wrapper">
<?php if($empty_flag == 1){ ?>
<div align="center">
<h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4>
<?php echo $errm; ?><br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()">
</div>
<?php }else{ ?>
  		<h2 class="conf_heading">確認画面</h2>
<form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="POST">

<?php echo confirmOutput($_POST);//入力内容を表示?>

<p align="center"><input type="hidden" name="mail_set" value="confirm_submit">
<input type="hidden" name="httpReferer" value="<?php echo h($_SERVER['HTTP_REFERER']);?>">
<input type="submit" class="submit_btn" value="この内容で送信する" />

</form>
<?php } ?>

  </div>


</div></section>


<footer id="footer"><div class="footer_wrapper"><!--↓footer↓-->
  <div class="footer_cont">
    <h1 class="footer_heading">
      <svg version="1.1" id="footer_logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="472.5 0 55 61" style="enable-background:new 472.5 0 55 61;" xml:space="preserve"> <foreignObject display="none" width="56" height="62"><img src="img/footer_logo.png" alt="株式会社ライトイールドロゴ" width="56" height="62" /></foreignObject>
      <g><title>株式会社ライトイールド</title><desc>株式会社ライトイールドロゴ</desc></g><g><g><path class="st0" d="M473.7,20.9V0l30.5,10.4L473.7,20.9z M476.1,3.4v14.2l20.7-7.1L476.1,3.4z"/><path class="st0" d="M527.5,20.9L497,10.5l30.5-10.4V20.9z M504.4,10.4l20.7,7.1V3.4L504.4,10.4z"/></g><g><g><path class="st0" d="M481.6,39.7h-7.3V23.6h2.6v13.6h4.7L481.6,39.7L481.6,39.7z"/></g><g><path class="st0" d="M486.4,39.7h-2.6V23.6h2.6V39.7z"/></g><g><path class="st0" d="M496,40c-2.2,0-4.2-0.8-5.8-2.4c-1.6-1.6-2.4-3.6-2.4-5.9c0-2.3,0.8-4.3,2.4-5.9s3.6-2.4,6-2.4c1.3,0,2.4,0.3,3.5,0.8c1,0.5,2.1,1.4,3.1,2.5l0.1,0.1l-1.9,1.8l-0.1-0.1c-1.3-1.7-2.9-2.6-4.7-2.6c-1.6,0-3,0.6-4.2,1.7c-1.1,1.1-1.7,2.5-1.7,4.2s0.6,3.2,1.9,4.3c1.2,1,2.4,1.6,3.8,1.6c1.2,0,2.2-0.4,3.1-1.2s1.4-1.7,1.5-2.7h-4v-2.5h6.8v0.6c0,1.2-0.1,2.3-0.4,3.2c-0.3,0.9-0.8,1.7-1.4,2.4C500.2,39.2,498.3,40,496,40z"/></g><g><path class="st0" d="M516.7,39.7h-2.6v-7.4h-6.7v7.4h-2.6V23.6h2.6v6.2h6.7v-6.2h2.6V39.7z"/></g><g><path class="st0" d="M523.9,39.7h-2.6V26.1h-3.7v-2.5h9.9v2.5h-3.6L523.9,39.7L523.9,39.7z"/></g></g><g><g><path class="st0" d="M480.4,61h-2.6v-6.9l-5.3-9.2h3l3.6,6.3l3.6-6.3h3l-5.3,9.2L480.4,61L480.4,61z"/></g><g><path class="st0" d="M489.8,61h-2.6V44.9h2.6V61z"/></g><g><path class="st0" d="M502,61h-9V44.9h9v2.5h-6.4V51h6.2v2.5h-6.2v5.1h6.4V61z"/></g><g><path class="st0" d="M511.8,61h-7.3V44.9h2.6v13.6h4.7L511.8,61L511.8,61z"/></g><g><path class="st0" d="M516.8,61h-3.4V44.9h3.4c1.6,0,2.9,0.2,3.8,0.5c1,0.3,1.9,0.8,2.7,1.6c1.7,1.5,2.5,3.5,2.5,6s-0.9,4.5-2.6,6c-0.9,0.8-1.8,1.3-2.7,1.6C519.7,60.9,518.4,61,516.8,61z M516,58.6h1c1.1,0,2-0.1,2.7-0.3s1.3-0.6,1.9-1.1c1.2-1.1,1.7-2.4,1.7-4.1c0-1.7-0.6-3.1-1.7-4.2c-1-0.9-2.6-1.4-4.6-1.4h-1L516,58.6L516,58.6z"/></g></g></g>
      </svg>
    </h1>
    <p class="footer_add">株式会社ライトイールド<br>564-0051 大阪府吹田市豊津町１−１８エクラート江坂ビル３階</p>
    <nav>
      <ul class="footer_nav">
        <li><a href="index.html">トップ</a></li>
        <li><a href="about.html">会社概要</a></li>
        <li><a href="contact.html">お問い合わせ</a></li>
      </ul>
    </nav>
    <p class="footer_link-fb"><a href="https://www.facebook.com/lightyield/" target="_blank" title="Facebookページへ">
    <svg version="1.1" id="footer_fb_btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 33 33" style="enable-background:new 0 0 33 33;" xml:space="preserve">
    <foreignObject display="none" width="33" height="34"><img src="img/footer_fb.png" alt="Facebookページへ" width="33" height="34" /></foreignObject>
    <g><title>Facebookページへ</title><desc>株式会社ライトイールドのフェイスブックはこちら</desc></g>
    <g><path class="fbf" d="M31.2,0c0.5,0,0.9,0.2,1.3,0.5S33,1.3,33,1.8v29.3c0,0.5-0.2,0.9-0.5,1.3S31.7,33,31.2,33h-8.4V20.2H27l0.6-5h-4.9v-3.2c0-0.8,0.2-1.4,0.5-1.8c0.3-0.4,1-0.6,2-0.6l2.6,0V5.2C27,5,25.7,5,24,5c-1.9,0-3.5,0.6-4.7,1.7c-1.2,1.1-1.8,2.8-1.8,4.9v3.7h-4.3v5h4.3V33H1.8c-0.5,0-0.9-0.2-1.3-0.5C0.2,32.1,0,31.7,0,31.2V1.8c0-0.5,0.2-0.9,0.5-1.3C0.9,0.2,1.3,0,1.8,0H31.2z"/></g></svg>
    </a></p>
  </div>
  <p class="copyRight">&copy;2016　Light Yield Co., Ltd.</p>
</div></footer><!--↑footer↑-->
</body>
</html>
<?php
/* ▲▲▲送信確認画面のレイアウト　※オリジナルのデザインも適用可能▲▲▲　*/
}

if(($jumpPage == 0 && $sendmail == 1) || ($jumpPage == 0 && ($confirmDsp == 0 && $sendmail == 0))) {

/* ▼▼▼送信完了画面のレイアウト　編集可 ※送信完了後に指定のページに移動しない場合のみ表示▼▼▼　*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="initial-scale=1.0">
<title>お問い合わせ｜株式会社ライトイールド</title>
<link rel="stylesheet" href="css/base.css">
<style type="text/css">
<!--
.conf_wrapper{max-width: 625px;width: 100%;margin:0 auto;}
.conf_heading{padding:0 0 20px 0;}
.conf_cont{border-top:1px #999 dotted;padding:10px 0;}
.conf_cont_label{display:block}
.conf_cont_cont{display:block;word-break : break-all;word-wrap : break-word;  overflow-wrap : break-word;}
.submit_btn{display:inline-block;margin-top:20px;}
@media screen and ( min-width : 768px ) {
.conf_cont_label{display:inline-block;width:25%;vertical-align:top;}
.conf_cont_cont{display:inline-block;width:75%;}
}
-->
</style>
<!--[if lte IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<link rel="stylesheet" href="css/ie-base.css">
<![endif]-->
</head>
<body>
<header id="header">
  <div class="header_cont">
    <h1 class="header_heading"><a href="index.html" title="トップページへ">
     <svg version="1.1" id="header_logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
   y="0px" viewBox="456.5 0 87 97" style="enable-background:new 456.5 0 87 97;" xml:space="preserve">
   <foreignObject display="none" width="87" height="97"><img src="img/header_logo.png" alt="株式会社ライトイールドロゴ" width="87" height="97" /></foreignObject>
<g><title>株式会社ライトイールド</title><desc>株式会社ライトイールドロゴ</desc></g><g><g><path class="hl0" d="M458.3,33.2v-33l48.3,16.5L458.3,33.2z M462.1,5.6V28l32.8-11.2L462.1,5.6z"/><path class="hl0" d="M543.5,33.2l-48.3-16.5l48.3-16.5V33.2z M506.9,16.8l32.8,11.2V5.6L506.9,16.8z"/></g><g><g><path class="hl0" d="M470.8,63.1h-11.5V37.6h4.1v21.6h7.4V63.1z"/></g><g><path class="hl0" d="M478.5,63.1h-4.1V37.6h4.1V63.1z"/></g><g><path class="hl0" d="M493.6,63.6c-3.5,0-6.6-1.3-9.2-3.9c-2.5-2.6-3.8-5.7-3.8-9.3c0-3.7,1.3-6.8,3.9-9.4s5.7-3.9,9.4-3.9c2,0,3.9,0.4,5.6,1.2c1.6,0.8,3.3,2.1,4.9,4l0.1,0.1l-2.9,2.8l-0.1-0.1c-2-2.7-4.5-4.1-7.4-4.1c-2.6,0-4.8,0.9-6.6,2.7c-1.8,1.8-2.7,4-2.7,6.7c0,2.7,1,5,3,6.8c1.8,1.6,3.9,2.5,6,2.5c1.8,0,3.5-0.6,4.9-1.9c1.4-1.2,2.2-2.6,2.4-4.3h-6.3v-3.9h10.7v1c0,1.9-0.2,3.6-0.7,5.1c-0.4,1.4-1.2,2.7-2.2,3.8C500.3,62.2,497.3,63.6,493.6,63.6z"/></g><g><path class="hl0" d="M526.4,63.1h-4.1V51.4h-10.5v11.7h-4.1V37.6h4.1v9.8h10.5v-9.8h4.1V63.1z"/></g><g><path class="hl0" d="M537.7,63.1h-4.1V41.5h-5.8v-3.9h15.7v3.9h-5.8V63.1z"/></g></g><g><g><path class="hl0" d="M469,96.8h-4.2v-11l-8.3-14.5h4.7l5.7,9.9l5.7-9.9h4.7l-8.4,14.5L469,96.8L469,96.8z"/></g><g><path class="hl0" d="M483.8,96.8h-4.1V71.2h4.1V96.8z"/></g><g><path class="hl0" d="M503.1,96.8h-14.2V71.2h14.2v3.9H493v5.7h9.8v3.9H493v8.1h10.1V96.8z"/></g><g><path class="hl0" d="M518.6,96.8h-11.5V71.2h4.1v21.6h7.4V96.8z"/></g><g><path class="hl0" d="M526.6,96.8h-5.4V71.2h5.4c2.5,0,4.6,0.3,6,0.8c1.6,0.5,3,1.3,4.3,2.5c2.6,2.4,3.9,5.6,3.9,9.5s-1.4,7.1-4.1,9.5c-1.4,1.2-2.8,2.1-4.3,2.5C531.2,96.6,529.2,96.8,526.6,96.8z M525.3,92.9h1.6c1.7,0,3.1-0.2,4.2-0.5c1.1-0.4,2.1-1,3-1.8c1.8-1.7,2.8-3.9,2.8-6.5c0-2.7-0.9-4.9-2.7-6.6c-1.6-1.5-4.1-2.3-7.2-2.3h-1.6L525.3,92.9L525.3,92.9z"/></g></g></g>
</svg>
    </a></h1>
    <nav>
  	 <ul class="header_nav">
    	 <li><a href="index.html">トップ</a></li>
    	 <li><a href="about.html">会社概要</a></li>
    	 <li class="header_nav_cont_current"><a href="contact.html">お問い合わせ</a></li>
      </ul>
    </nav>
    <p class="header_link-fb"><a href="https://www.facebook.com/lightyield/" target="_blank" title="Facebookページへ">
    <svg version="1.1" id="header_fb_btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 33 33" style="enable-background:new 0 0 33 33;" xml:space="preserve">
     <foreignObject display="none" width="34" height="34"><img src="img/header_fb.png" alt="Facebookページへ" width="34" height="34" /></foreignObject>
     <g><title>Facebookページへ</title><desc>株式会社ライトイールドのフェイスブックはこちら</desc></g>
     <g><path class="fbh" d="M31.2,0c0.5,0,0.9,0.2,1.3,0.5S33,1.3,33,1.8v29.3c0,0.5-0.2,0.9-0.5,1.3S31.7,33,31.2,33h-8.4V20.2H27l0.6-5h-4.9v-3.2c0-0.8,0.2-1.4,0.5-1.8c0.3-0.4,1-0.6,2-0.6l2.6,0V5.2C27,5,25.7,5,24,5c-1.9,0-3.5,0.6-4.7,1.7c-1.2,1.1-1.8,2.8-1.8,4.9v3.7h-4.3v5h4.3V33H1.8c-0.5,0-0.9-0.2-1.3-0.5C0.2,32.1,0,31.7,0,31.2V1.8c0-0.5,0.2-0.9,0.5-1.3C0.9,0.2,1.3,0,1.8,0H31.2z"/></g></svg>
    </a></p>
  </div>
  <div class="header_img">
   <h1 class="header_img_heading"><img src="img/header_contact.jpg" alt="お問い合わせ｜株式会社ライトイールド" width="1200" height="340"></h1>
  </div>
</header>

<section id="about"><div class="main_cont">
  <h1 class="section_heading section_heading-works"><span class="section_heading_en">Contact</span><span class="section_heading_ja">お問い合わせ</span></h1>


  <div class="conf_wrapper">
<?php if($empty_flag == 1){ ?>
<h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4>
<div style="color:red"><?php echo $errm; ?></div>
<br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()">
</div>

  </div>


</div></section>


<footer id="footer"><div class="footer_wrapper"><!--↓footer↓-->
  <div class="footer_cont">
    <h1 class="footer_heading">
      <svg version="1.1" id="footer_logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="472.5 0 55 61" style="enable-background:new 472.5 0 55 61;" xml:space="preserve"> <foreignObject display="none" width="56" height="62"><img src="img/footer_logo.png" alt="株式会社ライトイールドロゴ" width="56" height="62" /></foreignObject>
      <g><title>株式会社ライトイールド</title><desc>株式会社ライトイールドロゴ</desc></g><g><g><path class="st0" d="M473.7,20.9V0l30.5,10.4L473.7,20.9z M476.1,3.4v14.2l20.7-7.1L476.1,3.4z"/><path class="st0" d="M527.5,20.9L497,10.5l30.5-10.4V20.9z M504.4,10.4l20.7,7.1V3.4L504.4,10.4z"/></g><g><g><path class="st0" d="M481.6,39.7h-7.3V23.6h2.6v13.6h4.7L481.6,39.7L481.6,39.7z"/></g><g><path class="st0" d="M486.4,39.7h-2.6V23.6h2.6V39.7z"/></g><g><path class="st0" d="M496,40c-2.2,0-4.2-0.8-5.8-2.4c-1.6-1.6-2.4-3.6-2.4-5.9c0-2.3,0.8-4.3,2.4-5.9s3.6-2.4,6-2.4c1.3,0,2.4,0.3,3.5,0.8c1,0.5,2.1,1.4,3.1,2.5l0.1,0.1l-1.9,1.8l-0.1-0.1c-1.3-1.7-2.9-2.6-4.7-2.6c-1.6,0-3,0.6-4.2,1.7c-1.1,1.1-1.7,2.5-1.7,4.2s0.6,3.2,1.9,4.3c1.2,1,2.4,1.6,3.8,1.6c1.2,0,2.2-0.4,3.1-1.2s1.4-1.7,1.5-2.7h-4v-2.5h6.8v0.6c0,1.2-0.1,2.3-0.4,3.2c-0.3,0.9-0.8,1.7-1.4,2.4C500.2,39.2,498.3,40,496,40z"/></g><g><path class="st0" d="M516.7,39.7h-2.6v-7.4h-6.7v7.4h-2.6V23.6h2.6v6.2h6.7v-6.2h2.6V39.7z"/></g><g><path class="st0" d="M523.9,39.7h-2.6V26.1h-3.7v-2.5h9.9v2.5h-3.6L523.9,39.7L523.9,39.7z"/></g></g><g><g><path class="st0" d="M480.4,61h-2.6v-6.9l-5.3-9.2h3l3.6,6.3l3.6-6.3h3l-5.3,9.2L480.4,61L480.4,61z"/></g><g><path class="st0" d="M489.8,61h-2.6V44.9h2.6V61z"/></g><g><path class="st0" d="M502,61h-9V44.9h9v2.5h-6.4V51h6.2v2.5h-6.2v5.1h6.4V61z"/></g><g><path class="st0" d="M511.8,61h-7.3V44.9h2.6v13.6h4.7L511.8,61L511.8,61z"/></g><g><path class="st0" d="M516.8,61h-3.4V44.9h3.4c1.6,0,2.9,0.2,3.8,0.5c1,0.3,1.9,0.8,2.7,1.6c1.7,1.5,2.5,3.5,2.5,6s-0.9,4.5-2.6,6c-0.9,0.8-1.8,1.3-2.7,1.6C519.7,60.9,518.4,61,516.8,61z M516,58.6h1c1.1,0,2-0.1,2.7-0.3s1.3-0.6,1.9-1.1c1.2-1.1,1.7-2.4,1.7-4.1c0-1.7-0.6-3.1-1.7-4.2c-1-0.9-2.6-1.4-4.6-1.4h-1L516,58.6L516,58.6z"/></g></g></g>
      </svg>
    </h1>
    <p class="footer_add">株式会社ライトイールド<br>564-0051 大阪府吹田市豊津町１−１８エクラート江坂ビル３階</p>
    <nav>
      <ul class="footer_nav">
        <li><a href="index.html">トップ</a></li>
        <li><a href="about.html">会社概要</a></li>
        <li><a href="contact.html">お問い合わせ</a></li>
      </ul>
    </nav>
    <p class="footer_link-fb"><a href="https://www.facebook.com/lightyield/" target="_blank" title="Facebookページへ">
    <svg version="1.1" id="footer_fb_btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 33 33" style="enable-background:new 0 0 33 33;" xml:space="preserve">
    <foreignObject display="none" width="33" height="34"><img src="img/footer_fb.png" alt="Facebookページへ" width="33" height="34" /></foreignObject>
    <g><title>Facebookページへ</title><desc>株式会社ライトイールドのフェイスブックはこちら</desc></g>
    <g><path class="fbf" d="M31.2,0c0.5,0,0.9,0.2,1.3,0.5S33,1.3,33,1.8v29.3c0,0.5-0.2,0.9-0.5,1.3S31.7,33,31.2,33h-8.4V20.2H27l0.6-5h-4.9v-3.2c0-0.8,0.2-1.4,0.5-1.8c0.3-0.4,1-0.6,2-0.6l2.6,0V5.2C27,5,25.7,5,24,5c-1.9,0-3.5,0.6-4.7,1.7c-1.2,1.1-1.8,2.8-1.8,4.9v3.7h-4.3v5h4.3V33H1.8c-0.5,0-0.9-0.2-1.3-0.5C0.2,32.1,0,31.7,0,31.2V1.8c0-0.5,0.2-0.9,0.5-1.3C0.9,0.2,1.3,0,1.8,0H31.2z"/></g></svg>
    </a></p>
  </div>
  <p class="copyRight">&copy;2016　Light Yield Co., Ltd.</p>
</div></footer><!--↑footer↑-->
</body>
</html>
<?php }else{ ?>
送信ありがとうございました。<br />
送信は正常に完了しました。<br /><br />
</div>
<?php copyright(); ?>

  </div>


</div></section>


<footer id="footer"><div class="footer_wrapper"><!--↓footer↓-->
  <div class="footer_cont">
    <h1 class="footer_heading">
      <svg version="1.1" id="footer_logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="472.5 0 55 61" style="enable-background:new 472.5 0 55 61;" xml:space="preserve"> <foreignObject display="none" width="56" height="62"><img src="img/footer_logo.png" alt="株式会社ライトイールドロゴ" width="56" height="62" /></foreignObject>
      <g><title>株式会社ライトイールド</title><desc>株式会社ライトイールドロゴ</desc></g><g><g><path class="st0" d="M473.7,20.9V0l30.5,10.4L473.7,20.9z M476.1,3.4v14.2l20.7-7.1L476.1,3.4z"/><path class="st0" d="M527.5,20.9L497,10.5l30.5-10.4V20.9z M504.4,10.4l20.7,7.1V3.4L504.4,10.4z"/></g><g><g><path class="st0" d="M481.6,39.7h-7.3V23.6h2.6v13.6h4.7L481.6,39.7L481.6,39.7z"/></g><g><path class="st0" d="M486.4,39.7h-2.6V23.6h2.6V39.7z"/></g><g><path class="st0" d="M496,40c-2.2,0-4.2-0.8-5.8-2.4c-1.6-1.6-2.4-3.6-2.4-5.9c0-2.3,0.8-4.3,2.4-5.9s3.6-2.4,6-2.4c1.3,0,2.4,0.3,3.5,0.8c1,0.5,2.1,1.4,3.1,2.5l0.1,0.1l-1.9,1.8l-0.1-0.1c-1.3-1.7-2.9-2.6-4.7-2.6c-1.6,0-3,0.6-4.2,1.7c-1.1,1.1-1.7,2.5-1.7,4.2s0.6,3.2,1.9,4.3c1.2,1,2.4,1.6,3.8,1.6c1.2,0,2.2-0.4,3.1-1.2s1.4-1.7,1.5-2.7h-4v-2.5h6.8v0.6c0,1.2-0.1,2.3-0.4,3.2c-0.3,0.9-0.8,1.7-1.4,2.4C500.2,39.2,498.3,40,496,40z"/></g><g><path class="st0" d="M516.7,39.7h-2.6v-7.4h-6.7v7.4h-2.6V23.6h2.6v6.2h6.7v-6.2h2.6V39.7z"/></g><g><path class="st0" d="M523.9,39.7h-2.6V26.1h-3.7v-2.5h9.9v2.5h-3.6L523.9,39.7L523.9,39.7z"/></g></g><g><g><path class="st0" d="M480.4,61h-2.6v-6.9l-5.3-9.2h3l3.6,6.3l3.6-6.3h3l-5.3,9.2L480.4,61L480.4,61z"/></g><g><path class="st0" d="M489.8,61h-2.6V44.9h2.6V61z"/></g><g><path class="st0" d="M502,61h-9V44.9h9v2.5h-6.4V51h6.2v2.5h-6.2v5.1h6.4V61z"/></g><g><path class="st0" d="M511.8,61h-7.3V44.9h2.6v13.6h4.7L511.8,61L511.8,61z"/></g><g><path class="st0" d="M516.8,61h-3.4V44.9h3.4c1.6,0,2.9,0.2,3.8,0.5c1,0.3,1.9,0.8,2.7,1.6c1.7,1.5,2.5,3.5,2.5,6s-0.9,4.5-2.6,6c-0.9,0.8-1.8,1.3-2.7,1.6C519.7,60.9,518.4,61,516.8,61z M516,58.6h1c1.1,0,2-0.1,2.7-0.3s1.3-0.6,1.9-1.1c1.2-1.1,1.7-2.4,1.7-4.1c0-1.7-0.6-3.1-1.7-4.2c-1-0.9-2.6-1.4-4.6-1.4h-1L516,58.6L516,58.6z"/></g></g></g>
      </svg>
    </h1>
    <p class="footer_add">株式会社ライトイールド<br>564-0051 大阪府吹田市豊津町１−１８エクラート江坂ビル３階</p>
    <nav>
      <ul class="footer_nav">
        <li><a href="index.html">トップ</a></li>
        <li><a href="about.html">会社概要</a></li>
        <li><a href="contact.html">お問い合わせ</a></li>
      </ul>
    </nav>
    <p class="footer_link-fb"><a href="https://www.facebook.com/lightyield/" target="_blank" title="Facebookページへ">
    <svg version="1.1" id="footer_fb_btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 33 33" style="enable-background:new 0 0 33 33;" xml:space="preserve">
    <foreignObject display="none" width="33" height="34"><img src="img/footer_fb.png" alt="Facebookページへ" width="33" height="34" /></foreignObject>
    <g><title>Facebookページへ</title><desc>株式会社ライトイールドのフェイスブックはこちら</desc></g>
    <g><path class="fbf" d="M31.2,0c0.5,0,0.9,0.2,1.3,0.5S33,1.3,33,1.8v29.3c0,0.5-0.2,0.9-0.5,1.3S31.7,33,31.2,33h-8.4V20.2H27l0.6-5h-4.9v-3.2c0-0.8,0.2-1.4,0.5-1.8c0.3-0.4,1-0.6,2-0.6l2.6,0V5.2C27,5,25.7,5,24,5c-1.9,0-3.5,0.6-4.7,1.7c-1.2,1.1-1.8,2.8-1.8,4.9v3.7h-4.3v5h4.3V33H1.8c-0.5,0-0.9-0.2-1.3-0.5C0.2,32.1,0,31.7,0,31.2V1.8c0-0.5,0.2-0.9,0.5-1.3C0.9,0.2,1.3,0,1.8,0H31.2z"/></g></svg>
    </a></p>
  </div>
  <p class="copyRight">&copy;2016　Light Yield Co., Ltd.</p>
</div></footer><!--↑footer↑-->
</body>
</html>
<?php
/* ▲▲▲送信完了画面のレイアウト 編集可 ※送信完了後に指定のページに移動しない場合のみ表示▲▲▲　*/
  }
}
//確認画面無しの場合の表示、指定のページに移動する設定の場合、エラーチェックで問題が無ければ指定ページヘリダイレクト
else if(($jumpPage == 1 && $sendmail == 1) || $confirmDsp == 0) {
	if($empty_flag == 1){ ?>
<div align="center"><h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4><div style="color:red"><?php echo $errm; ?></div><br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()"></div>
<?php
	}else{ header("Location: ".$thanksPage); }
}

// 以下の変更は知識のある方のみ自己責任でお願いします。

//----------------------------------------------------------------------
//  関数定義(START)
//----------------------------------------------------------------------
function checkMail($str){
	$mailaddress_array = explode('@',$str);
	if(preg_match("/^[\.!#%&\-_0-9a-zA-Z\?\/\+]+\@[!#%&\-_0-9a-z]+(\.[!#%&\-_0-9a-z]+)+$/", "$str") && count($mailaddress_array) ==2){
		return true;
	}else{
		return false;
	}
}
function h($string) {
	global $encode;
	return htmlspecialchars($string, ENT_QUOTES,$encode);
}
function sanitize($arr){
	if(is_array($arr)){
		return array_map('sanitize',$arr);
	}
	return str_replace("\0","",$arr);
}
//Shift-JISの場合に誤変換文字の置換関数
function sjisReplace($arr,$encode){
	foreach($arr as $key => $val){
		$key = str_replace('＼','ー',$key);
		$resArray[$key] = $val;
	}
	return $resArray;
}
//送信メールにPOSTデータをセットする関数
function postToMail($arr){
	global $hankaku,$hankaku_array;
	$resArray = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){
				//連結項目の処理
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');

		}else{ $out = $val; }//チェックボックス（配列）追記ここまで
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }

		//全角→半角変換
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		if($out != "confirm_submit" && $key != "httpReferer") {
			$resArray .= "【 ".h($key)." 】 ".h($out)."\n";
		}
	}
	return $resArray;
}
//確認画面の入力内容出力用関数
function confirmOutput($arr){
	global $hankaku,$hankaku_array;
	$html = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){
				//連結項目の処理
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');

		}else{ $out = $val; }//チェックボックス（配列）追記ここまで
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		$out = nl2br(h($out));//※追記 改行コードを<br>タグに変換
		$key = h($key);

		//全角→半角変換
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}

		$html .= '<p class="conf_cont"><span class="conf_cont_label">'.$key.'</span><span class="conf_cont_cont">'.$out.'</span></p>';
		$html .= '<input type="hidden" name="'.$key.'" value="'.str_replace(array("<br />","<br>"),"",$out).'" />';
		$html .= "\n";
	}
	return $html;
}

//全角→半角変換
function zenkaku2hankaku($key,$out,$hankaku_array){
	global $encode;
	if(is_array($hankaku_array) && function_exists('mb_convert_kana')){
		foreach($hankaku_array as $hankaku_array_val){
			if($key == $hankaku_array_val){
				$out = mb_convert_kana($out,'a',$encode);
			}
		}
	}
	return $out;
}
//配列連結の処理
function connect2val($arr){
	$out = '';
	foreach($arr as $key => $val){
		if($key === 0 || $val == ''){//配列が未記入（0）、または内容が空のの場合には連結文字を付加しない（型まで調べる必要あり）
			$key = '';
		}elseif(strpos($key,"円") !== false && $val != '' && preg_match("/^[0-9]+$/",$val)){
			$val = number_format($val);//金額の場合には3桁ごとにカンマを追加
		}
		$out .= $val . $key;
	}
	return $out;
}

//管理者宛送信メールヘッダ
function adminHeader($userMail,$post_mail,$BccMail,$to){
	$header = '';
	if($userMail == 1 && !empty($post_mail)) {
		$header="From: $post_mail\n";
		if($BccMail != '') {
		  $header.="Bcc: $BccMail\n";
		}
		$header.="Reply-To: ".$post_mail."\n";
	}else {
		if($BccMail != '') {
		  $header="Bcc: $BccMail\n";
		}
		$header.="Reply-To: ".$to."\n";
	}
		$header.="Content-Type:text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
		return $header;
}
//管理者宛送信メールボディ
function mailToAdmin($arr,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp){
	$adminBody="「".$subject."」からメールが届きました\n\n";
	$adminBody .="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$adminBody.= postToMail($arr);//POSTデータを関数からセット
	$adminBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$adminBody.="送信された日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
	$adminBody.="送信者のIPアドレス：".@$_SERVER["HTTP_X_FORWARDED_FOR"]."\n";
	$adminBody.="送信者のホスト名：".getHostByAddr(getenv('HTTP_X_FORWARDED_FOR'))."\n";
	if($confirmDsp != 1){
		$adminBody.="問い合わせのページURL：".@$_SERVER['HTTP_REFERER']."\n";
	}else{
		$adminBody.="問い合わせのページURL：".@$arr['httpReferer']."\n";
	}
	if($mailFooterDsp == 1) $adminBody.= $mailSignature;
	return mb_convert_encoding($adminBody,"JIS",$encode);
}

//ユーザ宛送信メールヘッダ
function userHeader($refrom_name,$to,$encode){
	$reheader = "From: ";
	if(!empty($refrom_name)){
		$default_internal_encode = mb_internal_encoding();
		if($default_internal_encode != $encode){
			mb_internal_encoding($encode);
		}
		$reheader .= mb_encode_mimeheader($refrom_name)." <".$to.">\nReply-To: ".$to;
	}else{
		$reheader .= "$to\nReply-To: ".$to;
	}
	$reheader .= "\nContent-Type: text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
	return $reheader;
}
//ユーザ宛送信メールボディ
function mailToUser($arr,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode){
	$userBody = '';
	if(isset($arr[$dsp_name])) $userBody = h($arr[$dsp_name]). " 様\n";
	$userBody.= $remail_text;
	$userBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$userBody.= postToMail($arr);//POSTデータを関数からセット
	$userBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$userBody.="送信日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
	if($mailFooterDsp == 1) $userBody.= $mailSignature;
	return mb_convert_encoding($userBody,"JIS",$encode);
}
//必須チェック関数
function requireCheck($require){
	$res['errm'] = '';
	$res['empty_flag'] = 0;
	foreach($require as $requireVal){
		$existsFalg = '';
		foreach($_POST as $key => $val) {
			if($key == $requireVal) {

				//連結指定の項目（配列）のための必須チェック
				if(is_array($val)){
					$connectEmpty = 0;
					foreach($val as $kk => $vv){
						if(is_array($vv)){
							foreach($vv as $kk02 => $vv02){
								if($vv02 == ''){
									$connectEmpty++;
								}
							}
						}

					}
					if($connectEmpty > 0){
						$res['errm'] .= "<p class=\"error_messe\">【".h($key)."】は必須項目です。</p>\n";
						$res['empty_flag'] = 1;
					}
				}
				//デフォルト必須チェック
				elseif($val == ''){
					$res['errm'] .= "<p class=\"error_messe\">【".h($key)."】は必須項目です。</p>\n";
					$res['empty_flag'] = 1;
				}

				$existsFalg = 1;
				break;
			}

		}
		if($existsFalg != 1){
				$res['errm'] .= "<p class=\"error_messe\">【".$requireVal."】が未選択です。</p>\n";
				$res['empty_flag'] = 1;
		}
	}

	return $res;
}
//リファラチェック
function refererCheck($Referer_check,$Referer_check_domain){
	if($Referer_check == 1 && !empty($Referer_check_domain)){
		if(strpos($_SERVER['HTTP_REFERER'],$Referer_check_domain) === false){
  		  header("HTTP/1.1 301 Moved Permanently");
  		header("Location: https://lightyield.co.jp/contact.html");
		}
	}
}
function copyright(){
//	echo '<a style="display:block;text-align:center;margin:15px 0;font-size:11px;color:#aaa;text-decoration:none" href="http://www.php-factory.net/" target="_blank">- PHP工房 -</a>';
}
//----------------------------------------------------------------------
//  関数定義(END)
//----------------------------------------------------------------------
?>
