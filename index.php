<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <meta name=viewport content=width=device-width,minimum-scale=1,initial-scale=1>
        <meta name=referrer content=default>
        <meta name=renderer content=webkit>
        <meta name=HandheldFriendly content=true>
        <meta name=description content=移動体通信用基地局の検索用サイトです>
        <meta name=theme-color content=##ffcc00>
        <meta name=msapplication-TileColor content=#ffcc00>
        <title>携帯基地局検索用サイト</title>
        <?php
        function sanitize_band($band){
            switch($band){
                case '1':
                $FF = '';
                $TF = '';
                break;
                case '3':
                $FF = '';
                $TF = '';
                break;
                case '8':
                $FF = '';
                $TF = '';
                break;
                case '11':
                $FF = '';
                $TF = '';
                break;
                case '18':
                $FF = '';
                $TF = '';
                break;
                case '19':
                $FF = '';
                $TF = '';
                break;
                case '21':
                $FF = '';
                $TF = '';
                break;
                case '28':
                $FF = '';
                $TF = '';
                break;
                case 'UQ':
                $FF = '';
                $TF = '';
                break;
                case 'UQ2':
                $FF = '';
                $TF = '';
                break;
                case 'WCP':
                $FF = '';
                $TF = '';
                break;
                case 'BWA':
                $FF = '';
                $TF = '';
                break;
                case '42':
                $FF = '';
                $TF = '';
                break;
                default:
                $FF = '';
                $TF = '';
                break;
            }
            return array('FF'=>$FF,'TF'=>$TF);
        }
        function get_queri(){
            $HC = '';
            $HV = '';
            $FF = '';
            $TF = '';
            /*$prefecture = $_POST['prefecture'];
            $citie      = $_POST['citie'];
            $band       = $_POST['Band'];
            if($prefecture==='none'){
                $HC = '';
            }else{
                $HC = $prefecture;
            }
            if($citie==='none'){
                $HV = '';
            }else{
                $HV = $citie;
            }
            if($band==='none'){
                $FF = '';
                $TF = '';
            }else{
                $band = sanitize_band($band);
                $FF   = '&FF=' . $band['FF'];
                $TF   = '&TF=' . $band['TF'];
            }*/
            return'OW=FB+0&MK=CCC&HZ=3&SelectID=5&DC=500&SK=4&pageID=3&CONFIRM=1' . $HC . $HV . $FF . $TF;
        }
        function search_number($url_base){
            $ch     = curl_init($url_base . '&SC=1#result');
            $fp     = fopen($url_base . '&SC=1#result','r');
            curl_setopt($ch,CURLOPT_FILE,$number);
            curl_setopt($ch,CURLOPT_HEADER,0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            $number  = mb_convert_variables("UTF-8","SJIS, SJIS-win, sjis, sjis-win",$number);
            $number  = preg_match_all('/<div id="#temp1">.*?<\/div>/',$number);
            $number  = preg_match_all('/<form name="result">.*?<\/form>/',$number[0][0]);
            $number  = preg_match_all('/<table width="95%" border="0">.*?<\/table>/',$number[0][0]);
            $number  = preg_match_all('/<tbody>.*?<\/tbody>/',$number[0][0]);
            $number  = preg_match_all('/<tr>.*?<\/tr>/',$number[0][0]);
            $number  = preg_match_all('/<td align="right">.*?<\/td>/',$number[0][0]);
            $number  = str_replace('検索結果件数  1 ～ 500 / ','',$number[0][0]);
            $number  = intval($number);
            $surplus = $number % 500;
            if($surplus!==0){
                $surplus = 1;
            }
            $number = $number / 500 + $surplus;
            return $number;
        }
        function get_data(){
            $url_base = 'http://www.tele.soumu.go.jp/musen/SearchServlet?' . get_queri();
            $number   = search_number($url_base);
            for($i = 0; $i < $number; $i++){
                if($i===0){
                    $page = '&SC=1';
                }else{
                    $page_now = $i - 1;
                    $page_now = $page_now * 5;
                    $page     = '&SC=' . $page_now . '01';
                }
                $url = $url_base . $page . '#result';
                $src = file_get_contents($url);
                $ch_ = curl_init($url);
                $fp_ = fopen($url,'r');
                curl_setopt($ch_,CURLOPT_FILE,$src);
                curl_setopt($ch_,CURLOPT_HEADER,0);
                curl_exec($ch_);
                curl_close($ch_);
                fclose($fp_);
                $src = mb_convert_variables("UTF-8","SJIS, SJIS-win, sjis, sjis-win",$src);
                $src = preg_match_all('/<div id="#temp1">.*?<\/div>/',$src);
                $src = preg_match_all('/<form name="result">.*?<\/form>/',$src[0][0]);
                $src = preg_match_all('/<table class="borderstyle" width="100%" cellspacing="0" cellpadding="3" border="1">.*?<\/table>/',$src[0][0]);
                echo'<table>' . $src[0][0] . '</table>';
            }
        }
        ?>
    </head>
    <body>
        <header>
            <h1>携帯基地局検索用サイト</h1>
            <p>データは総務省電波利用ホームページから取得しています。以下のセレクトボックスで、条件を設定して検索してください。</p>
        </header>
        <main>
            <section>
                <h2>条件指定</h2>
                <form id=term action=index.php method=post>
                    <select form=term name=Band>
                        <option value=none selected>選択なし</option>
                        <option value=1>Band 1</option>
                        <option value=3>Band 3</option>
                        <option value=8>Band 8</option>
                        <option value=11>Band 11</option>
                        <option value=18>Band 18</option>
                        <option value=19>Band 19</option>
                        <option value=21>Band 21</option>
                        <option value=28>Band 28</option>
                        <option value=UQ>UQ - WiMAX</option>
                        <option value=UQ2>UQ - WiMAX 2+</option>
                        <option value=WCP>WCP</option>
                        <option value=BWA>地域BWA</option>
                        <option value=42>Band 42</option>
                    </select>
                    <select form=term name=prefecture>
                        <option value=none selected>選択なし</option>
                        <option value=01>北海道</option>
                        <option value=02>青森県</option>
                        <option value=03>岩手県</option>
                        <option value=04>宮城県</option>
                        <option value=05>秋田県</option>
                        <option value=06>山形県</option>
                        <option value=07>福島県</option>
                        <option value=08>茨城県</option>
                        <option value=09>栃木県</option>
                        <option value=10>群馬県</option>
                        <option value=11>埼玉県</option>
                        <option value=12>千葉県</option>
                        <option value=13>東京都</option>
                        <option value=14>神奈川県</option>
                        <option value=15>新潟県</option>
                        <option value=16>富山県</option>
                        <option value=17>石川県</option>
                        <option value=18>福井県</option>
                        <option value=19>山梨県</option>
                        <option value=20>長野県</option>
                        <option value=21>岐阜県</option>
                        <option value=22>静岡県</option>
                        <option value=23>愛知県</option>
                        <option value=24>三重県</option>
                        <option value=25>滋賀県</option>
                        <option value=26>京都府</option>
                        <option value=27>大阪府</option>
                        <option value=28>兵庫県</option>
                        <option value=29>奈良県</option>
                        <option value=30>和歌山県</option>
                        <option value=31>鳥取県</option>
                        <option value=32>島根県</option>
                        <option value=33>岡山県</option>
                        <option value=34>広島県</option>
                        <option value=35>山口県</option>
                        <option value=36>徳島県</option>
                        <option value=37>香川県</option>
                        <option value=38>愛媛県</option>
                        <option value=39>高知県</option>
                        <option value=40>福岡県</option>
                        <option value=41>佐賀県</option>
                        <option value=42>長崎県</option>
                        <option value=43>熊本県</option>
                        <option value=44>大分県</option>
                        <option value=45>宮崎県</option>
                        <option value=46>鹿児島県</option>
                        <option value=47>沖縄県</option>
                    </select>
                    <input type=submit value=Save>
                </form>
            </section>
            <section>
                <?php get_data();?>
            </section>
        </main>
    </body>
</html>