<?php
/*
  Plugin Name: Euro FxRef Currency Converter
  Plugin URI: http://wordpress.org/plugins/euro-fxref-currency-converter/
  Description: Adds the [currency] and [currency_legal] shortcodes to convert currencies based on the ECB reference exchange rates.
  Version: 1.3.0
  Author: joostdekeijzer
  Author URI: http://dekeijzer.org/
  License: GPLv2 or later
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
/*
  Development code at https://github.com/joostdekeijzer/wp_eurofxref

  This plugin is based on the Xclamation Currency Converter Shortcode plugin.
  See http://www.xclamationdesign.co.uk/free-currency-converter-shortcode-plugin-for-wordpress/
  for more information.
 */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

class EuroFxRef {
	static protected $euroFxRef;
	const TRANSIENT_LABEL = 'EuroFxRefRates';

	public $space = '&nbsp;';

	public function __construct() {
		// for testing
		//delete_transient( self::TRANSIENT_LABEL );

		add_shortcode( 'currency', array( $this, 'currency_converter' ) );
		add_shortcode( 'currency_legal', array( $this, 'legal_string' ) );

		add_action( 'admin_head', array( $this, 'insert_help_tab' )  );
	}

	public static function legal_string( $atts ) {
		$prepend = '* ';

		if( is_array( $atts ) && isset( $atts['prepend'] ) ) {
			$prepend = $atts['prepend'];
		}
		return $prepend . __( 'For informational purposes only. Exchange rates may vary. Based on <a href="http://www.ecb.europa.eu/stats/eurofxref/" target="_blank">ECB reference rates</a>.', __CLASS__ );
	}

	public static function convert( $amount = 0, $from = 'EUR', $to = 'USD' ) {
		$from = strtoupper($from);
		$to   = strtoupper($to);
		if( ( 'EUR' != $from && null === self::getEuroFxRef($from) ) || ( 'EUR' != $to && null === self::getEuroFxRef($to) ) )
			return 0;

		if( 'EUR' != $from && 'EUR' != $to ) {
			// normalize on Euro
			$amount = self::convert( $amount, $from, 'EUR' );
			$from = 'EUR';
		}

		if( 'EUR' == $from ) {
			// from Euro to ...
			return $amount * self::getEuroFxRef($to);
		} else {
			// from ... to Euro
			return $amount / self::getEuroFxRef($from);
		}
	}

	public function currency_converter( $atts ) {
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

		// fix booleans
		foreach( array( 'iso', 'show_from', 'round' ) as $var ) {
			$$var = $this->_bool_from_string( $$var );
		}

		// load $currency and $number_format variables
		include( dirname( __FILE__ ) . '/currency_symbols.php');

		if( !isset($currency[$from] ) || !isset($currency[$to] ) ) {
			$currency[$from] = $currency[$to] = '';
			$number_format[$from] = $number_format[$to] = array( 'dp' => ',', 'ts' => '.' );
			$iso = true;
		}

		$cAmount = self::convert( $amount, $from, $to );
		if( $cAmount > 0 ) {
			$cAmount = number_format( $cAmount, ( $round ? 0 : 2 ), $number_format[$to]['dp'], $number_format[$to]['ts'] );
			if( $round && '' != $round_append ) $cAmount .= $number_format[$to]['dp'] . $round_append;
		} else {
			$show_from = true;
		}

		$amount = number_format( $amount, ( $round ? 0 : 2 ), $number_format[$from]['dp'], $number_format[$from]['ts'] );
		if( $round && '' != $round_append ) $amount .= $number_format[$from]['dp'] . $round_append;

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
			$cOne = number_format( self::convert( 1, strtoupper( $from ), strtoupper( $to ) ), 4, $number_format[$to]['dp'], $number_format[$to]['ts'] );
			$output = "<span style='$to_style' title='1 $from = $cOne $to'>" . $output . '</span>' . $append;
		}
		return $output;
	}

	public function insert_help_tab() {
		global $post_type;
		$screen = get_current_screen();
		if( 'post' != $screen->base || !post_type_supports($post_type, 'editor') ) return;
	
		$id = __CLASS__ . '_help_id';
		$title = __( "Using the [currency] shortcodes", __CLASS__ );
		$help = <<<EOH
<p><strong>currency</strong> shortcode examples:<br/>
	<code>[currency from="EUR" to="GBP" amount="10"]</code><br/>
	<code>[currency from="JPY" to="CHF" amount="750"]</code></p>
<p>Full example with default values:<br/>
	<code>[currency from="EUR" to="USD" amount="1" iso=false show_from=true between="&amp;nbsp;/&amp;nbsp;" append="&amp;nbsp;*" round=true round_append="=" to_style="cursor:help;border-bottom:1px dotted gray;"]</code></p>

<p><strong>currency_legal</strong> shortcode examples:<br/>
	<code>[currency_legal]</code><br/>
	<code>[currency_legal prepend='* ']</code> (full example with default value)</p>
<p>The legal text is:<br/>
	'For informational purposes only. Exchange rates may vary. Based on <a href="http://www.ecb.europa.eu/stats/eurofxref/" target="_blank">ECB reference rates</a>.'</p>

<p><strong>Need more help?</strong><br/>
	Please visit <a href="http://wordpress.org/plugins/euro-fxref-currency-converter/other_notes/" target="_blank">http://wordpress.org/plugins/euro-fxref-currency-converter/other_notes/</a> for more examples and a full list of supported currencies.</p>
EOH;

		$screen->add_help_tab( array(
			'id' => $id,
			'title' => $title,
			'content' => $help,
		) );
	}

	protected static function getEuroFxRef( $currency = null ) {
		if( !isset(self::$euroFxRef) || false == self::$euroFxRef || 0 == count(self::$euroFxRef) ) {
			self::$euroFxRef = get_transient( self::TRANSIENT_LABEL );
			if( false == self::$euroFxRef || 0 == count(self::$euroFxRef) ) {
				//This is a PHP(5)script example on how eurofxref-daily.xml can be parsed
				//the file is updated daily between 2.15 p.m. and 3.00 p.m. CET
		
				//Read eurofxref-daily.xml file in memory
				//For the next command you will need the config option allow_url_fopen=On (default)
				$response = wp_remote_get('http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');

				self::$euroFxRef = array();
				if( !is_wp_error( $response ) ) {
					$fxRefXml = simplexml_load_string( $response['body'] );

					$fxRefDateString = (string) $fxRefXml->Cube->Cube['time'];

					foreach($fxRefXml->Cube->Cube->Cube as $rate) {
						self::$euroFxRef[(string)$rate['currency']] = (float)$rate['rate'];
					}

					/**
					 * Calculate transient expiration to try update around 3.00 p.m. (15h00) daily
					 * with a minimum of 15 minutes and a maximum of 6 hours.
					 * 
					 * All calculated in Seconds since the Unix Epoch to support PHP 5.2
					 */
					$pubEpoch = date_format( new DateTime( $fxRefDateString, new DateTimeZone('CET') ), 'U' );
					$pubEpoch += 60 * 60 * 15; // add 15h for actual publication date
					$pubEpoch += 60 * 60 * 24; // add 24h for NEXT publication date

					$transient_expiration = min( 60 * 60 * 6, max( 60 * 15, $pubEpoch - current_time('timestamp', true) ) );

					set_transient( self::TRANSIENT_LABEL, self::$euroFxRef, $transient_expiration );
				}
			}
		}
		if( isset($currency) ) {
			if( isset( self::$euroFxRef[$currency] ) ) {
				return self::$euroFxRef[$currency];
			} else {
				return null;
			}
		} else {
			return self::$euroFxRef;
		}
	}

	/**
	 * converts strings and integers to boolean values.
	 * 0, "0", false, "FALSE", "no", 'n' etc. becomes (bool) false
	 * all other becomes (bool) true.
	 * 
	 * The function itself defaults to (bool) false
	 * 
	 * Also see http://php.net/manual/en/function.is-bool.php#93165
	 */
	private function _bool_from_string( $val = false ) {
		if( is_bool( $val ) ) return $val;

		$val = strtolower( trim( $val ) );

		if(
			'false' == $val ||
			'null' == $val ||
			'off' == $val ||
			'no' == $val ||
			'n' == $val ||
			'0' == $val
		) {
			return false;
		} else {
			return true;
		}
	}
}
$EuroFxRef = new EuroFxRef();
