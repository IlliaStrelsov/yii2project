<?php

class BtcCurrency{

    private $url = 'https://bitpay.com/api/rates';

    public function getBtncurrencyInGrivnas(){

        // getting 1 bitcoin in dollars
        $data = json_decode(file_get_contents($this->url));
        $bitcoin = 0;
        foreach( $data as $obj ){
            if( $obj->code=='USD' )$bitcoin=$obj->rate;
        }


        $xml = simplexml_load_file("https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5");
        $m = $xml->xpath('//exchangerate[@ccy="USD"]');
        $exrate = (string)$m[0]['buy'];

        $uah = $bitcoin * $exrate;

        return '1 BTC = ' . $uah . ' UAH.';
    }
}

?>