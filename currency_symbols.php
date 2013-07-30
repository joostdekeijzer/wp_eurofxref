<?php
/**
 * copied from xclam_currency_converter
 *
 * also see http://www.ecb.europa.eu/stats/exchange/eurofxref/html/index.en.html
 *
 * License: GPLv2 or later
 */
$currency['EUR'] = '&euro;';

$currency['USD'] = '$';			// US Dollar
$currency['JPY'] = '&#165;';	// Japanese Yen
$currency['BGN'] = 'ЛВ.';		// Bulgarian Lev
$currency['CZK'] = 'K&#269;';	// Czech Republic Koruna
$currency['DKK'] = 'kr';		// Danish Krone
$currency['GBP'] = '&pound;';	// British Pound Sterling
$currency['HUF'] = 'Ft';		// Hungarian Forint
$currency['LTL'] = 'Lt';		// Lithuanian Litas
$currency['LVL'] = 'Ls';		// Latvian Lats
$currency['PLN'] = 'z&#322;';	// Polish Zloty
$currency['RON'] = 'RON';		// New Romanian Leu
$currency['SEK'] = 'kr';		// Swedish Krona
$currency['CHF'] = 'CHF';		// Swiss Franc
$currency['NOK'] = 'kr';		// Norwegian Krone
$currency['HRK'] = 'kn';		// Croatian Kuna
$currency['RUB'] = 'py6.';		// Russian Rouble
$currency['TRY'] = 'TL';		// Turkish Lira
$currency['AUD'] = '$';			// Australian Dollar
$currency['BRL'] = 'R$';		// Brasilian Real
$currency['CAD'] = '$';			// Canadian Dollar
$currency['CNY'] = '&#20803;';	// Chinese Yuan
$currency['HKD'] = '$';			// Hong Kong Dollar
$currency['IDR'] = 'Rp';		// Indonesian Rupiah
$currency['ILS'] = '&#8362;';	// Israeli New Sheqel
$currency['INR'] = '&#8377;';	// Indian Rupee - Rs &#8377; ₹
$currency['KRW'] = '&#8361;';	// South Korean Won
$currency['MXN'] = '$';			// Mexican Peso
$currency['MYR'] = 'RM';		// Malaysian Ringgit
$currency['NZD'] = '$';			// New Zealand Dollar
$currency['PHP'] = '₱';			// Philippine Peso - P ₱
$currency['SGD'] = '$';			// Singapore Dollar
$currency['THB'] = '&#3647;';	// Thai Baht
$currency['ZAR'] = 'R';			// South African Rand

//$currency['ISK'] = 'kr';		// Icelandic krona - The last rate was published on 3 Dec 2008

//$currency['EGP'] = '&pound;';
//$currency['ARS'] = '$';
//$currency['BBD'] = '$';
//$currency['CLP'] = '$';
//$currency['XCD'] = '$';
//$currency['EEK'] = 'kr';
//$currency['JMD'] = 'J$';
//$currency['LBP'] = '$pound;';
//$currency['NAD'] = '$';
//$currency['NPR'] = 'Rs';
//$currency['OMR'] = '&#65020;';
//$currency['PKR'] = 'Rs';
//$currency['PAB'] = 'B/.';
//$currency['QAR'] = '&#65020;';
//$currency['SAR'] = '&#65020;';
//$currency['LKR'] = 'Rs';
//$currency['VEF'] = 'Bs';

/**
 * added number format
 */
$number_format['EUR'] = array( 'dp' => ',', 'ts' => '.' , 'after' => false );

$number_format['USD'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['JPY'] = array( 'dp' => '.', 'ts' => ',', 'round' => true );
$number_format['BGN'] = array( 'dp' => ',', 'ts' => '&nbsp;', 'after' => true );
$number_format['CZK'] = array( 'dp' => '.', 'ts' => '&nbsp;', 'after' => true );
$number_format['DKK'] = array( 'dp' => ',', 'ts' => '.', 'after' => true );
$number_format['GBP'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['HUF'] = array( 'dp' => ',', 'ts' => '&nbsp;', 'after' => true, 'round' => true );
$number_format['LTL'] = array( 'dp' => '.', 'ts' => ',', 'after' => true );
$number_format['LVL'] = array( 'dp' => ',', 'ts' => '&nbsp;', 'after' => true );
$number_format['PLN'] = array( 'dp' => ',', 'ts' => '&nbsp;', 'after' => true );
$number_format['RON'] = array( 'dp' => ',', 'ts' => '.', 'after' => true );
$number_format['SEK'] = array( 'dp' => ',', 'ts' => '&nbsp;', 'after' => true );
$number_format['CHF'] = array( 'dp' => '.', 'ts' => '&rsquo;', 'after' => true );
$number_format['NOK'] = array( 'dp' => ',', 'ts' => '&nbsp;' );
$number_format['HRK'] = array( 'dp' => ',', 'ts' => '.', 'after' => true );
$number_format['RUB'] = array( 'dp' => ',', 'ts' => '&nbsp;', 'after' => true );
$number_format['TRY'] = array( 'dp' => ',', 'ts' => '.', 'after' => true );
$number_format['AUD'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['BRL'] = array( 'dp' => ',', 'ts' => '.' );
$number_format['CAD'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['CNY'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['HKD'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['IDR'] = array( 'dp' => ',', 'ts' => '.', 'round' => true );
$number_format['ILS'] = array( 'dp' => '.', 'ts' => ',', 'after' => true );
$number_format['INR'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['KRW'] = array( 'dp' => '.', 'ts' => ',', 'round' => true );
$number_format['MXN'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['MYR'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['NZD'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['PHP'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['SGD'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['THB'] = array( 'dp' => '.', 'ts' => ',' );
$number_format['ZAR'] = array( 'dp' => ',', 'ts' => '&nbsp;' );

//$number_format['EGP'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['ARS'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['BBD'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['CLP'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['XCD'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['EEK'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['ISK'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['JMD'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['LBP'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['NAD'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['NPR'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['OMR'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['PKR'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['PAB'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['QAR'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['SAR'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['LKR'] = array( 'dp' => '.', 'ts' => ',' );
//$number_format['VEF'] = array( 'dp' => '.', 'ts' => ',' );
