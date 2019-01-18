<?php

function url_get_contents ($url) {
    if (function_exists('curl_exec')){
        $conn = curl_init($url);
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        $url_get_contents_data = (curl_exec($conn));
        curl_close($conn);
    }elseif(function_exists('file_get_contents')){
        $url_get_contents_data = file_get_contents($url);
    }elseif(function_exists('fopen') && function_exists('stream_get_contents')){
        $handle = fopen ($url, "r");
        $url_get_contents_data = stream_get_contents($handle);
    }else{
        $url_get_contents_data = false;
    }
    return $url_get_contents_data;
}

$url = url_get_contents('http://www.tcmb.gov.tr/kurlar/today.xml');
preg_match_all('@<Currency CrossOrder="1" Kod="AUD" CurrencyCode="AUD">
			<Unit>(.*?)</Unit>
			<Isim>(.*?)</Isim>
			<CurrencyName>(.*?)</CurrencyName>
			<ForexBuying>(.*?)</ForexBuying>
			<ForexSelling>(.*?)</ForexSelling>
			<BanknoteBuying>(.*?)</BanknoteBuying>
			<BanknoteSelling>(.*?)</BanknoteSelling>
				(.*?)
		
	</Currency>
@si', $url, $aud);
preg_match_all('@<Currency CrossOrder="0" Kod="USD" CurrencyCode="USD">
			<Unit>(.*?)</Unit>
			<Isim>(.*?)</Isim>
			<CurrencyName>(.*?)</CurrencyName>
			<ForexBuying>(.*?)</ForexBuying>
			<ForexSelling>(.*?)</ForexSelling>
			<BanknoteBuying>(.*?)</BanknoteBuying>
			<BanknoteSelling>(.*?)</BanknoteSelling>
			<CrossRateUSD/>
			<CrossRateOther/>
		
	</Currency>
@si', $url, $dolar);

preg_match_all('@<Currency CrossOrder="2" Kod="DKK" CurrencyCode="DKK">
			<Unit>(.*?)</Unit>
			<Isim>(.*?)</Isim>
			<CurrencyName>(.*?)</CurrencyName>
			<ForexBuying>(.*?)</ForexBuying>
			<ForexSelling>(.*?)</ForexSelling>
			<BanknoteBuying>(.*?)</BanknoteBuying>
			<BanknoteSelling>(.*?)</BanknoteSelling>
			(.*?)
		
	</Currency>
@si', $url, $dkk);
preg_match_all('@<Currency CrossOrder="9" Kod="EUR" CurrencyCode="EUR">
			<Unit>(.*?)</Unit>
			<Isim>(.*?)</Isim>
			<CurrencyName>(.*?)</CurrencyName>
			<ForexBuying>(.*?)</ForexBuying>
			<ForexSelling>(.*?)</ForexSelling>
			<BanknoteBuying>(.*?)</BanknoteBuying>
			<BanknoteSelling>(.*?)</BanknoteSelling>
			(.*?)
		
	</Currency>
@si', $url, $eur);
var_dump($eur);

date_default_timezone_set('Europe/Istanbul');
/*foreach ($link[2] as $link) {
    $site = url_get_contents('https://www.pcgumruk.com/' . $link);
    $site = mb_convert_encoding($site, "UTF-8", "windows-1254");

    preg_match('@<table (.*?)">(.*?)</table>@si', $site, $icerik2);
    preg_match('@<font style="font-size: 16px" color="#000000" face="Raleway"><br>(.*?)<font style="font-size: 13px" color="#000000" face="Arial"><hr size="1">@si', $site, $baslik);


    /*if ($link) {

$aranacak=$baslik[1];
        $sorgu = $db->prepare("SELECT * FROM haber WHERE haber_baslik=:baslik");
$sorgu->execute(array('baslik'=>$baslik[1]));
$bitir=$sorgu->fetch(PDO::FETCH_ASSOC);

        if ($bitir) {
            echo 'GÜNCEL DUYURU YOK';
            echo '<br>';
        } else {

         $haber_kaydet=$db->prepare('insert into haber set
haber_baslik=:baslik,
haber_icerik=:icerik,
haber_tarih=:tarih

'); date_default_timezone_set('Europe/Istanbul');
        $haber_kaydet->execute(
            array(
                'baslik'=>$baslik[1],
                'icerik'=>$icerik2[0],
                'tarih'=>date('d.m.Y')


            )
        );
        }

    }


}*/
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Döviz Kodu</th>
        <th scope="col">Döviz Cinsi</th>
        <th scope="col">Döviz Alış</th>
        <th scope="col">Döviz Satış</th>

    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <th >USD/TRY</th>
        <td><?php echo $dolar[2][0]?></td>
        <td><?php echo $dolar[4][0]?></td>
        <td><?php echo $dolar[5][0]?></td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <th >AUD/TRY</th>
        <td><?php echo $aud[2][0]?></td>
        <td><?php echo $aud[4][0]?></td>
        <td><?php echo $aud[5][0]?></td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <th >DKK/TRY</th>
        <td><?php echo $dkk[2][0]?></td>
        <td><?php echo $dkk[4][0]?></td>
        <td><?php echo $dkk[5][0]?></td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <th >EUR/TRY</th>
        <td><?php echo $eur[2][0]?></td>
        <td><?php echo $eur[4][0]?></td>
        <td><?php echo $eur[5][0]?></td>
    </tr>
    </tbody>
</table>

