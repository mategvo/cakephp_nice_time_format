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
		$msDif = strtotime(date('Y-m-d H:i')) - strtotime(date('Y-m-d H:i', strtotime($time)));
		if($msDif > 60*60*24){
			$timeago = round(($msDif/(60*60*24))).' '.__(' days ago');
		}elseif($msDif > 60*60){
			$timeago = round(($msDif/(60*60))).' '.__(' hours ago');
		}elseif($msDif >= 60){
			$timeago = round(($msDif/60)).' '.__(' min. ago');
		}elseif($msDif > 10){
			$timeago = round($msDif).' '.__('sec. ago');
		}else{
			$timeago = __('just now');
		}

		return $timeago;
	}

	public function niceTime($time){

		$time = $this->timeAfter($time);

		return $time;
	}


}
