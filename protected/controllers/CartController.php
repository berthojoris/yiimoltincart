<?php

use Moltin\Cart\Cart;
use Moltin\Cart\Storage\Session;
use Moltin\Cart\Identifier\Cookie;

class CartController extends Controller
{
	public function init()
	{
		$Path = Yii::getPathOfAlias('application.vendors.MoltinCart.vendor');
		include($Path.'/autoload.php');
	}
	
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	public function actionInsert()
	{
		$cart = new Cart(new Session, new Cookie);
		
		$cart->insert(array(
			'id'       => 'A001',
			'name'     => 'Baju',
			'price'    => 50000,
			'quantity' => 5,
			'tax'      => 10
		));
		
		$cart->insert(array(
			'id'       => 'B001',
			'name'     => 'Sepatu',
			'price'    => 140000,
			'quantity' => 10,
			'tax'      => 10
		));
		
		$cart->insert(array(
			'id'       => 'C001',
			'name'     => 'Tas',
			'price'    => 110000,
			'quantity' => 15,
			'tax'      => 10
		));
		
		$result = "Sukses insert";
		echo $result;
	}
	
	public function actionRead()
	{		
		$cart = new Cart(new Session, new Cookie);
		
		foreach($cart->contents() as $items){
			echo "ID : ".$items->identifier."<br>";
			echo "Kode Barang : ".$items->id."<br>";
			echo "Nama Barang : ".$items->name."<br>";
			echo "Harga : ".$items->price."<br>";
			echo "Pajak : ".$items->tax."%<br>";
			echo "Quantity : ".$items->quantity."<hr>";
		}
		
		echo "Total Item : ".$cart->totalItems()."<br>";
		echo "Total Item Unique : ".$cart->totalItems(true)."<br>";
		echo "Total Harga (Include Pajak) : ".$cart->total()."<br>";
		echo "Total Harga (Tanpa Pajak) : ".$cart->total(false)."<br>";
	}
	
	public function actionDestroy()
	{
		$cart = new Cart(new Session, new Cookie);
		
		$cart->destroy();
		$result = "Sukses destroy";
		echo $result;
	}
	
	public function actionRemoveitem()
	{		
		$cart = new Cart(new Session, new Cookie);
		$item = $cart->has('60327efb00bc704d6193b90c087ad472');
		if($item){
			$cart->item('60327efb00bc704d6193b90c087ad472')->remove();
			$result = "Item berhasil dihapus";
		}else{
			$result = "Item tidak ditemukan di keranjang belanja";
		}
		echo $result;
	}
	
	public function actionItemcheck()
	{		
		$cart = new Cart(new Session, new Cookie);
		echo "<pre>";
		var_dump($cart->item('60327efb00bc704d6193b90c087ad472'));
	}
	
	public function actionIndex()
	{
		echo "WELCOME MOLTIN CART YII";
	}
}
