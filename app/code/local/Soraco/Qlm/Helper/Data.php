<?php
    class Soraco_Qlm_Helper_Data extends Mage_Core_Helper_Abstract
    {   
		public function generatekeydata($pid,$licparameter,$parameter){
			
			$api_url = Mage::getStoreConfig('soraco_qlm/qlm_group/qlm_apiurl',Mage::app()->getStore());
			$api_vendor = Mage::getStoreConfig('soraco_qlm/qlm_group/qlm_isvendor',Mage::app()->getStore());
			
			$key = "";
			if($pid){
				$input_xml = '<?xml version="1.0" encoding="UTF-8"?><ecommerce>';  
				foreach($parameter as $key=>$val){
					$input_xml .= '<'.$key.'>'.$val.'</'.$key.'>';	
				}
				$input_xml .= '</ecommerce>';
				
				$url = $api_url."/GetActivationKeyWithExpiryDate?is_vendor=magento".$licparameter;

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POSTFIELDS,"xmlRequest=" . $input_xml);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
			    $result = curl_exec($ch);
				curl_close($ch);
				
				$key = $result;
				
			}
			return $key;
		}        
	}
	     
