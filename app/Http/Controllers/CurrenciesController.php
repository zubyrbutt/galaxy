<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Validator;
use App\Currencies;

use GuzzleHttp\Client;
use DOMDocument;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		set_time_limit(0);
		//$client_liverate = new Client();
		//$api_response = $client_liverate->get("http://www.exchangerate.com/");
		//$api_response->getStatusCode(); // 200
		//$response = $api_response->getBody();
		//$response = json_decode($response,true);	
		$url = "http://www.exchangerate.com/";
		if($url==''){ echo "URL link empty";exit; }
		
		$html = file_get_contents($url);
		libxml_use_internal_errors( true);
		$doc = new \DOMDocument;
		$doc->loadHTML( $html);
		$xpath = new \DOMXpath( $doc);

		$val_9_usd = $xpath->query( '//td[@class="ttsb"]')->item(49);
		$val_11_gbp = $xpath->query( '//td[@class="ttsb"]')->item(48);
		$val_13_aud = $xpath->query( '//td[@class="ttsb"]')->item(1);
		$val_14_cad = $xpath->query( '//td[@class="ttsb"]')->item(5);
		$val_16_nzd = $xpath->query( '//td[@class="ttsb"]')->item(28);
		$val_0_sgd = $xpath->query( '//td[@class="ttsb"]')->item(38);
		$val_30_pkr = $xpath->query( '//td[@class="ttsb"]')->item(30);
		
		echo $val_9_usd = $val_9_usd->textContent;echo "<br>";
		echo $val_11_gbp = $val_11_gbp->textContent;echo "<br>";
		echo $val_13_aud = $val_13_aud->textContent;echo "<br>";
		echo $val_14_cad = $val_14_cad->textContent;echo "<br>";
		echo $val_16_nzd = $val_16_nzd->textContent;echo "<br>";
		echo $val_0_sgd = $val_0_sgd->textContent;echo "<br>";
		echo $val_30_pkr = $val_30_pkr->textContent;echo "<br>";

		echo "Now converting to 1 gbp/aud/cad/nzd/sgd to USD";
		echo "<br>";
		echo "<br>";
		echo $val_9_usd = round(1/$val_9_usd,6);echo "<br>";
		echo $val_11_gbp = round(1/$val_11_gbp,6);echo "<br>";
		echo $val_13_aud = round(1/$val_13_aud,6);echo "<br>";
		echo $val_14_cad = round(1/$val_14_cad,6);echo "<br>";
		echo $val_16_nzd = round(1/$val_16_nzd,6);echo "<br>";
		echo $val_0_sgd = round(1/$val_0_sgd,6);echo "<br>";
		echo $val_30_pkr = round(1/$val_30_pkr,6);echo "<br>";

		if($val_9_usd!='' && $val_11_gbp!='' && $val_13_aud!='' && $val_14_cad!='' && $val_16_nzd!='' && $val_0_sgd!='' && $val_30_pkr!=''){
			$currencies= new \App\Currencies;
            $currencies->one_gbp_to_usd=$val_11_gbp;
            $currencies->one_usd_to_usd=$val_9_usd;
            $currencies->one_cad_to_usd=$val_14_cad;
            $currencies->one_aud_to_usd=$val_13_aud;
            $currencies->one_nzd_to_usd=$val_16_nzd;
			$currencies->one_sgd_to_usd=$val_0_sgd;
			$currencies->one_pkr_to_usd=$val_30_pkr;
			
            $date=date('Y-m-d H:i:s');
            //$format = date_format($date,"Y-m-d");
			$currencies->date = date('Y-m-d');
            $currencies->created_at = $date;
            $currencies->updated_at = $date;
            $currencies->save();
			echo "Successful";
		}
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
