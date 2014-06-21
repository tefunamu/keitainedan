<link rel="stylesheet" href="../../css/welcome.css">
<link href="../../js/pagefile.js" type="text/javascript" />
<div id="wrapper">
   <img src="../../images/hon.gif"  alt= ></br>
   <div id="content_left">
<form action="ruta">
ご利用中のケーブルテレビがございましたら選択してください</br>
<input type="radio" name="kaisen" value="au_kaisen">auの提携回線</br>
<?php
if ($_SESSION["kisyu"] == "iphone"){
echo ('<input type="radio" name="kaisen" value="softbank_kaisen">softbankの提携回線(Yahoo!BB)</Br>');
}
?>
<input type="radio" name="kaisen" value="nashi" checked="">該当なし</br>
<input type="submit" value="次へ"></a>
</Br>
</br>
お手数をおかけしますが、右記リンクよりご確認ください。</Br>

</br></br>
表示の仕方を必要あり</br>
それと回線の表現がわからん</br>

</br>1:勝手に調べてもらう</br>
2:リンク貼る</br>
3:全部の選択肢に対応させる</br>
4:なんか別の方法考える</br>
5:一つまたは全部複合</br></br>

該当なしを選べばルータへ</br>
そうでなければパケットへ

</div>
<div id="content_right">
・auの提携回線</br>
J:COM、他多数</Br>
<a href="http://www.au.kddi.com/mobile/charge/usage-fee-discount/smartvalue/catv/" target="_blank">
調べる!(クリックするとauのページにジャンプします)</a></br>(au by KDDIのページが</br>
別ウィンドウで開きます。)</br>

</br>
<?php
if ($_SESSION["kisyu"] == "iphone"){
echo ('
・softbankの提携回線</br>
ホワイトBB</br>
もしくは</br>
ホワイトコール24と下記いずれか</br>
ケーブルライン</br>
ひかりdeトークS</br>
NURO 光 でんわ</br>

詳しくは
<a href="http://www.softbank.jp/mobile/campaigns/list/sumaho-bb/" target="_blank">ここ</a>をクリックしてください。

');
}?>


</form>
</div>
</div>
