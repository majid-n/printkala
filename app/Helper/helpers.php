<?php 
use App\Price;

function getPrice( $pid, $uid ) {
	$price = Price::where('product_id', $pid)->where('unit_id', $uid)->first()->price;
	return $price;
}