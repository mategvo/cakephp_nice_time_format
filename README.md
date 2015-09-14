<?php

/*

Creates extra field formated in nice phrase
Works with CakePHP 2.X

Modify the field list that should appear in "nice" format:
$this->fields = array('created','modified');

*/

class NiceTimeBehavior extends ModelBehavior {


	public function setup(Model $Model, $settings = array()) {
		
		//the fields that should be modified
		$this->fields = array('created','modified');

	}

	public function afterFind(Model $model, $results, $primary = false) {
		foreach ($results as $key => $result) {
			foreach ($this->fields as $field) {
				foreach ($result as $modelName => $value) {

					if(isset($value[$field])){
						if( $value[$field] != null ){
							if(!is_array($value[$field])){
								$results[$key][$modelName][$field.'_nice'] = $this->niceTime($results[$key][$modelName][$field]);
							}
						}
					}
					
				}
			}
		}

		return $results;
	}

	public function timeAfter($time){
		$msDif = strtotime(date('Y-m-d H:i', strtotime($time))) - strtotime(date('Y-m-d H:i'));
		if($msDif > 60*60*24){
			$timeagoInt = round(($msDif/(60*60*24)));
			if($timeagoInt > 1){
				$timeago = $timeagoInt.' days';
			}else{
				$timeago = $timeagoInt.' day';		
			}

		}elseif($msDif > 60*60){

			$timeagoInt = round(($msDif/(60*60)));
			if($timeagoInt >= 1){
				$timeago = $timeagoInt.' '.__('hours');
			}else{
				$timeago = $timeagoInt.' '.__('hour');		
			}

		}elseif($msDif >= 60){
			$timeagoInt = round(($msDif/60));
			if($timeagoInt > 1){
				$timeago = $timeagoInt.' '.__('minutes');
			}else{
				$timeago = $timeagoInt.' '.__('minute');		
			}	
			
		}elseif($msDif > 10){

			$timeagoInt = round($msDif);
			if($timeagoInt > 1){
				$timeago = $timeagoInt.' '.__('seconds');
			}else{
				$timeago = $timeagoInt.' '.__('second');		
			}	

		}else{
			$timeago = __("just now");
		}

		return $timeago;
	}

	public function niceTime($time){

		if(strtotime($time) > strtotime('now')){
			$time = $this->timeAfter($time);
		}else{
			$time = $this->timeAfter($time);
		}

		return $time;
	}


}
