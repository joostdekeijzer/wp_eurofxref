<?php
/*
  Plugin Name: Euro foreign exchange reference rates convertor
  Plugin URI: http://dekeijzer.org/
  Description: Converts currencies based on the ECB reference exchange rates.
  Author: Joost de Keijzer
  Version: 0.1
  Author URI: http://dekeijzer.org/
 */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

class EuroFxRef {
	var $euroFxRef;
	var $space = '&nbsp;';

	function __construct() {
		$transient_label = __CLASS__ . 'Rates';

		// for testing
		//delete_transient( $transient_label );
		$this->euroFxRef = get_transient( $transient_label );
		if( $this->euroFxRef == false ) {
			$this->_loadEuroFxRef( $transient_label );
		}
		add_shortcode( 'currency', array( $this, 'currency_convertor' ) );
		add_shortcode( 'currency_legal', array( $this, 'legal_string' ) );
	}

	static function legal_string( $notice = '' ) {
		return $notice . __( 'For informational purposes only. Exchange rates may vary. Based on <a href="http://www.ecb.europa.eu/stats/eurofxref/" target="_blank">ECB reference rates</a>.', __CLASS__ );
	}

	function currency_convertor( $atts ) {
		extract( shortcode_atts( array(
			'amount' => '1',
			'from' => 'EUR',
			'to' => 'USD',
			'iso' => false,
			//'flag' => '',
			'show_from' => true,
			'between' => '&nbsp;/&nbsp;',
			'append' => '&nbsp;*',
			'round' => true,
			'round_append' => '=',
			'to_style' => 'cursor:help;border-bottom:1px dotted gray;',
		), $atts ) );

		// load $currency and $number_format variables
		include( dirname( __FILE__ ) . '/currency_symbols.php');

		if( !isset($currency[$from] ) || !isset($currency[$to] ) ) {
			$currency[$from] = $currency[$to] = '';
			$number_format[$from] = $number_format[$to] = array( 'dp' => ',', 'ts' => '.' );
			$iso = true;
		}

		$cAmount = $this->_convert( $amount, strtoupper( $from ), strtoupper( $to ) );
		if( $cAmount > 0 ) {
			$cAmount = number_format( $cAmount, ( $round ? 0 : 2 ), $number_format[$to]['dp'], $number_format[$to]['ts'] );
			if( $round ) $cAmount .= $number_format[$to]['dp'] . $round_append;
		} else {
			$show_from = true;
		}

		$amount = number_format( $amount, ( $round ? 0 : 2 ), $number_format[$from]['dp'], $number_format[$from]['ts'] );
		if( $round ) $amount .= $number_format[$from]['dp'] . $round_append;

		$s = $this->space;
		if( $show_from ) {
			if( $iso ) {
				$output = $amount . $s . $from;
				if( $cAmount > 0 )
					$output .= $between . $cAmount . $s . $to . $append;
			} else {
				$output = $currency[$from] . $s . $amount;
				if( $cAmount > 0 )
					$output .= $between . $currency[$to] . $s . $cAmount . $append;
			}
		} else {
			if( $iso ) {
				$output = $cAmount . $s . $to;
			} else {
				$output = $currency[$to] . $s . $cAmount;
			}
			$cOne = number_format( $this->_convert( 1, strtoupper( $from ), strtoupper( $to ) ), 4, $number_format[$to]['dp'], $number_format[$to]['ts'] );
			$output = "<span style='$to_style' title='1 $from = $cOne $to'>" . $output . '</span>' . $append;
		}
		return $output;
	}

	private function _loadEuroFxRef( $transient_label ) {
		//This is aPHP(5)script example on how eurofxref-daily.xml can be parsed
		//the file is updated daily between 2.15 p.m. and 3.00 p.m. CET
		
		//Read eurofxref-daily.xml file in memory
		//For the next command you will need the config option allow_url_fopen=On (default)
		$response = wp_remote_get('http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');

		$this->euroFxRef = array();
		if( !is_wp_error( $response ) ) {
			$fxRefXml = simplexml_load_string( $response['body'] );
			
			foreach($fxRefXml->Cube->Cube->Cube as $rate) {
				$this->euroFxRef[(string)$rate['currency']] = (float)$rate['rate'];
			}
			set_transient( $transient_label, $this->euroFxRef, 60 * 60 * 12 );
		}
	}

	private function _convert( $amount, $from, $to ) {
		if( ( 'EUR' != $from && !isset( $this->euroFxRef[$from] ) ) || ( 'EUR' != $to && !isset( $this->euroFxRef[$to] ) ) )
			return 0;

		if( 'EUR' != $from && 'EUR' != $to ) {
			// normalize on Euro
			$amount = $this->_convert( $amount, $from, 'EUR' );
			$from = 'EUR';
		}

		if( 'EUR' == $from ) {
			// from Euro to ...
			return $amount * $this->euroFxRef[$to];
		} else {
			// from ... to Euro
			return $amount / $this->euroFxRef[$from];
		}
	}
}
$EuroFxRef = new EuroFxRef();
