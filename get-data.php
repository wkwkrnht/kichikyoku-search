<?php
function sanitze_band($band){
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
    $prefecture = $_POST['prefecture'];
    //$citie      = $_POST['citie'];
    $band       = $_POST['Band'];
    if($prefecture==='none'){
        $HC = '';
    }else{
        $HC = $prefecture;
    }
    /*if($citie==='none'){
        $HV = '';
    }else{
        $HV = $citie;
    }*/
    if($band==='none'){
        $FF = ;
        $TF = ;
    }else{
        $band = sanitize_band($band);
        $FF   = '&FF=' . $band['FF'];
        $TF   = '&TF=' . $band['TF'];
    }
    return'OW=FB+0&MK=CCC&HZ=3&SelectID=5&DC=500&SK=4&pageID=3&CONFIRM=1' . $HC . $HV . $FF . $TF;
}
function get_data(){
    use Goutte\Client;
    $html    = '';
    $queri   = get_queri();
    $client  = new Client();
    $number  = $client->request('GET','http://www.tele.soumu.go.jp/musen/SearchServlet?' . $queri . '&SC=1#result')->fiter('#temp1 > form > table')->first()->fiter('tbody > tr > td')->last()->text();
    $number  = str_replace('検索結果件数  1 ～ 500 / ','',$number);
    $number  = intval($number);
    $surplus = $number % 500;
    if($surplus!==0){
        $surplus = 1;
    }
    $number  = $number / 500 + $surplus;
    for($i = 0;$i < $number; $i++){
        if($i===0){
            $page = '&SC=1';
        }else{
            $page_now = $i - 1;
            $page_now = $page_now * 5
            $page     = '&SC=' . $page_now . '01'
        }
        $url   = 'http://www.tele.soumu.go.jp/musen/SearchServlet?' . $queri . $page . '#result';
        $html .= '<table>' . $client->request('GET',$url)->fiter('#temp1 > form > table.borderstyle')->text() . '</table>';
    }
    echo $html;
}