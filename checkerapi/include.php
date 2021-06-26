<?php
error_reporting(0);
set_time_limit(0);
    

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


    //$rand = rand (1, 9999);
    //$link = __curl('https://opcs.unitedeway.org/Cng/ClickAndGive.aspx?fdn=43001&cngCampaign=CNGUWW');
    //$viewstate1 = getStr($link, 'name="__VIEWSTATE" id="__VIEWSTATE" value="', '""');

//      if (empty($cc)) {
//      die("{Die} CC Invalida");
//    } elseif (empty($mes)) {
//      die("{Die} Mês Invalido");
//  }elseif (empty($ano)) {
//      die("{Die} Ano Invalido");
//  }elseif (empty($cvv)) {
//      die("{Die} CVV Invalido");
//  }elseif (strlen($cvv) < 3) {
//      die("{Die} CVV Invalido");
//  }
//  if (strpos(strtolower($bin), 'prepaid') OR strpos($bin, 'PREPAID') OR strpos($bin, 'NU PAGAMENTOS')) {
//      die(" Querendo usar prepago né safadu :3 ");
//      return;
//  }   


//  $mes = intval($mes);
//  $ano = intval($ano);
//  
//  if($mes < 10){
//      $mes = "0$mes";
//}
//  
//  if(strlen($ano) == 4){
//      $ano_sub = substr($ano, 2,4);
//  }else{
//      $ano_sub = $ano;
//}


    if(file_exists("cookie_bp.txt")){
      unlink("cookie_bp.txt");
    } 

?>