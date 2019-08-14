<?php 
class Soraco_Qlm_Model_Observer {		
		
		public function setgeneratedKey(Varien_Event_Observer $observer)
		{
			$order = $observer->getEvent()->getOrder();
			
			if( $order->getId() ) {
				
				$data = $order->getBillingAddress()->getData();
				
				$parameter = array();
				$parameter["OrderId"] = $order->getId();
				$parameter["ReceiptId"] = $order->getIncrementId();
				$parameter["Customer_Name"] = $order->getCustomerFirstname() ." ".$order->getCustomerLastname();
				$parameter["Customer_Email"] = $order->getCustomerEmail();
				$parameter["Customer_Company"] = $data["company"];
				$parameter["Customer_Address1"] = $data["city"];
				$parameter["Customer_Address2"] = $data["street"];
				$parameter["Customer_City"] = $data["city"];
				$parameter["Customer_State"] = $data["region"];
				$parameter["Customer_Zip"] = $data["postcode"];
				$parameter["Customer_Country"] = $data["country_id"];
				$parameter["Customer_Phone"] = $data["telephone"];
				$parameter["is_quantity"] = 1;
				$parameter["yearly_maintenance_plan"] = 1;
				
				foreach( $order->getAllVisibleItems() as $item ) {
					$pid = $item->getProductId();
					
					$coll =  Mage::getModel('catalog/product')->load($pid);
					$licparameter = $coll->getLicparameter();
					
					$parameter["is_quantity"] = $item->getQtyOrdered();
					
					$keyid = Mage::helper("soraco_qlm")->generatekeydata($pid,$licparameter,$parameter);
					
					$existentOptions = $item->getProductOptions();
					if (!isset($existentOptions['additional_options'])) {
						$existentOptions['additional_options'] = array(); 
					}
					
					if($keyid!="")
					{
						$existentOptions['additional_options'][] = array(
							'label' => 'Licence Key',
							'value' => $keyid,
							'print_value' => $keyid
						);
						$item->setProductOptions($existentOptions);	
					}					
				}       
			}
			
		}
}
