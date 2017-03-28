<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <meta name=viewport content=width=device-width,minimum-scale=1,initial-scale=1>
        <meta name=referrer content=default>
        <meta name=renderer content=webkit>
        <meta name=HandheldFriendly content=true>
        <meta name=description content=>
        <meta name=theme-color content=>
        <meta name=msapplication-TileColor content=>
        <title>携帯基地局検索用サイト</title>
    </head>
    <body>
        <header>
            <h1>携帯基地局検索用サイト</h1>
            <p>データは総務省電波利用ホームページから取得しています。以下のセレクトボックスで、条件を設定して検索してください。</p>
        </header>
        <main>
            <section>
                <h2>条件指定</h2>
                <form id=term action=get-data.php method=post>
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