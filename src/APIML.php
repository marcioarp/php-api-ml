<?php

namespace php_api_ml;

class APIML
{
	var $ml = [];
	public function learn($txt,$link='',$method='',$send='',$response='')
	{
		if (is_array($txt))
		{
			return $this->learnArr($txt);
		}
		$this->ml[] = array
		(
			"txt" => $txt,
			"link" => $link,
			"method" => $method,
			"send" => $send,
			"response" => $response
		);
		return true;
	}
	
	private function learnArr($arr)
	{
		for ($i=0;$i< sizeof($arr);$i++)
		{
			if (isset($arr['txt']))
			{
				$this->learn($arr[$i]['txt'], $arr[$i]['link'], $arr[$i]['method'], $arr[$i]['send'], $arr[$i]['response']);
			} else
			{
				$this->learn($arr[$i][0], $arr[$i][1], $arr[$i][2], $arr[$i][3], $arr[$i][4]);
			}
		}
		return true;
	}
	
	public function getList()
	{
		return $this->arr;
	}
	
	public function process($txt)
	{
		$perca=0;
		$obj = [];
		for ($i=0;$i<sizeof($this->ml);$i++) 
		{
			$perc = $this->_comparePerc($txt, $this->ml[$i]['txt']);
			if ($perc > $perca) {
				$obj = $this->ml[$i];
				$perca = $perc;
			}
		}
		return ['obj'=>$obj,'perc'=>$perca];
	}
	
	private function _comparePerc($st1, $st2) 
	{
		$st1 = strtolower($st1);
		$st2 = strtolower($st2);
		$tam = strlen($st1);
		//return similar_text($st1, $st2, $percst);
		return  ($tam - levenshtein($st1,$st2)) / $tam  * 100;
		
	}
}