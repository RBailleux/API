<?php 
class Meteo {
	
	public $longitude;
	public $latitude;
	public $date;
	public $url;
	public $exists = true;
	public $temperature;
	public $wind;
	public $rainLevel;
	public $snowRisk = false;
	
	public function __construct($latitude, $longitude, $date){
		$this->setParameter('longitude', $longitude);
		$this->setParameter('latitude', $latitude);
		$this->setParameter('date', $date);
		
		$xmlURL = "http://www.infoclimat.fr/public-api/gfs/xml?_ll=".$latitude.",".$longitude."&_auth=CRNTRAd5VXdfclNkBXMHLlU9DzoAdlJ1VCgLaAxpVisBal8%2BA2NXMQVrVisPIAQyUXxUNwgzADADaAN7WCoFZAljUz8HbFUyXzBTNgUqByxVew9uACBSdVQ0C2sMf1Y8AWVfJQNpVzUFdFY2Dz0EMVF9VCsINgA8A2kDZVgxBW4JY1M%2FB2BVNF8vUy4FMAc7VTMPaQA6Um5UNAtvDGZWMgE0X2gDYFc3BXRWMg84BDNRZVQ1CDAAOANlA3tYKgUfCRlTKgckVXVfZVN3BSgHZlU4Dzs%3D&_c=b71b572264f10ad1dedaa58344678cef";
		
		$this->setParameter('url', $xmlURL);
		$this->parseXMLUrl();
	}
	
	public function setParameter($param, $value){
		$this->$param = $value;
	}
	
	
	/**
	 * Parse the XML and return the specified value
	 * @param dateTime $date The date to get the value from
	 */
	public function parseXMLUrl(){
		$xml = simplexml_load_file($this->url) or die("Meteo feed not loading");
		$date = date_format($this->dateRange(),'Y-m-d H:i:s').' UTC';
		$meteo = $xml->xpath('/previsions/echeance [@timestamp="'.$date.'"]');
		if(!$meteo){
			$this->exists = false;
		}
		else{
			$kelvinTempMin = $meteo[0]->temperature->level[0];
			$kelvinTempMax = $meteo[0]->temperature->level[1];
			$kelvinTempMed = ($kelvinTempMin+$kelvinTempMax)/2;
			$this->setParameter('temperature', $this->kelvinToCelsius($kelvinTempMed));
			$this->setParameter('wind', (float) $meteo[0]->vent_moyen->level);
			
			if((string)$meteo[0]->risque_neige == 'oui'){
				$this->snowRisk = true;
			}
			$this->setParameter('rainLevel', (float)$meteo[0]->pluie*10);
		}
	}
	
	public function dateRange(){
		$date = date_format($this->date, 'Y-m-d');
		$hour =  date_format($this->date,'H');
		$hourRange = array(2,5,8,11,14,17,20,23);
		
		$closest = null;
		foreach ($hourRange as $item) {
			if ($closest === null || abs($hour- $closest) > abs($item - $hour)) {
				$closest = $item;
			}
		}
		var_dump(new dateTime($date.' '.$closest.':00:00'));
		return new dateTime($date.' '.$closest.':00:00');
	}
	
	public function kelvinToCelsius($kelvin){
		return $kelvin - 273.15;
	}
	
	
	public function exists(){
		return $this->exists;
	}
	public function getTemperature(){
		return $this->temperature;
	}
	public function getWind(){
		return $this->wind;
	}
	public function getSnowRisk(){
		return $this->snowRisk;
	}
	public function getRainLevel(){
		return $this->rainLevel;
	}
	
}
//$meteo = new Meteo(46.85341,2.3488, new dateTime());
?>