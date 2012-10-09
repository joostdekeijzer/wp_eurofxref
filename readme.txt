=== Euro FxRef Currency Converter ===
Contributors: joostdekeijzer
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=joost@dekeijzer.org&item_name=eurofxref+WordPress+plugin&item_number=Joost+de+Keijzer&currency_code=EUR
Tags: shortcode, currency converter, currency, converter, foreign exchange conversion, fx rate converter, ECB
Requires at least: 3.3
Tested up to:  3.4
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the [currency] and [currency_legal] shortcodes to convert currencies based on the ECB reference exchange rates.

== Description ==

Using the [currency] shortcode you can convert one currency to another. The conversion is based on the rates published by the ECB (updated daily between 2.15 p.m. and 3.00 p.m. CET).

You can change from and to any of the supported currencies.

The [currency_legal] shortcode outputs a disclaimer text and a link to the ECB eurofxref page.

This plugin is based on a plugin by [Xclamation](http://www.xclamationdesign.co.uk/free-currency-converter-shortcode-plugin-for-wordpress/).

Also see https://github.com/joostdekeijzer/wp_eurofxref

== Installation ==

* Download the plugin
* Uncompress it with your preferred unzip application
* Copy the entire directory in your plugin directory of your WordPress blog (/wp-content/plugins)
* Activate the plugin
* Use the [currency] shortcode in you texts!

== Shortcode usage & examples ==

= currency_legal shortcode =
This shortcode returns the string '* For informational purposes only. Exchange rates may vary. Based on <a href="http://www.ecb.europa.eu/stats/eurofxref/" target="_blank">ECB reference rates</a>.'

The prepended '* ' (the same string as the [currency] append string) can be changed using the 'prepend' attribute.

For example: `[currency_legal prepend='Please note: ']`

The legal string can also be retrieved in PHP using `<?php echo EuroFxRef::legal_string( 'optional prepend string' ) ?>`

= currency shortcode =

* `from`: currency code (default: EUR)
* `to`: currency code (default: USD)
* `amount`: number of "from" currency (default: 1)
* `iso`: boolean (true or false, default false); use ISO currency
      formatting
* `show_from`: boolean (default true); show from amount in output
* `between`: string (default '&amp;nbsp;/&amp;nbsp;' which is displayed as 
      '&nbsp;/&nbsp;' in the browser); string between from and to amounts
* `append`: string (default '&amp;nbsp;*' which is displayed as '&nbsp;*' in
      the browser); string put after conversion. The * references the
      disclaimer text, see [currency_legal] shortcode.
* `round: boolean` (default true); Round numbers to whole units.
* `round_append`: string (default '='); replaces decimals
* `to_style`: css formatting text (default
      'cursor:help;border-bottom:1px dotted gray;'); styling of "to"
      text.

Conversion from non-Euro to non-Euro is done through the Euro, so GBP to USD is calculated as GBP -> EUR -> USD.

= Examples =
* `[currency amount="875" from="EUR" to="GBP"]` 
  becomes "€ 875,= / £ 697.= *"
* `[currency amount="875" from="GBP" to="USD" iso=true between=" converts to " append="" round_append=""]` 
  becomes "875 GBP converts to 1,418 USD"
* `[currency amount="875" from="GBP" to="USD" show_from=false round=false]` 
  becomes "$ 1,130.15 *"

= Currently available currencies =

See full list at http://www.ecb.europa.eu/stats/eurofxref/

* `USD`    US dollar
* `JPY`    Japanese yen
* `BGN`    Bulgarian lev
* `CZK`    Czech koruna
* `DKK`    Danish krone
* `GBP`    Pound sterling
* `HUF`    Hungarian forint
* `LTL`    Lithuanian litas
* `LVL`    Latvian lats
* `PLN`    Polish zloty
* `RON`    New Romanian leu
* `SEK`    Swedish krona
* `CHF`    Swiss franc
* `NOK`    Norwegian krone
* `HRK`    Croatian kuna
* `RUB`    Russian rouble
* `TRY`    Turkish lira
* `AUD`    Australian dollar
* `BRL`    Brasilian real
* `CAD`    Canadian dollar
* `CNY`    Chinese yuan renminbi
* `HKD`    Hong Kong dollar
* `IDR`    Indonesian rupiah
* `ILS`    Israeli shekel
* `INR`    Indian rupee
* `KRW`    South Korean won
* `MXN`    Mexican peso
* `MYR`    Malaysian ringgit
* `NZD`    New Zealand dollar
* `PHP`    Philippine peso
* `SGD`    Singapore dollar
* `THB`    Thai baht
* `ZAR`    South African rand

== Frequently Asked Questions ==

= Where do the exchange rates come from? =
The European Central Bank (ECB) daily publishes "foreign exchange reference rates" against more than 30 other currencies. These rates are used by this plugin.

The rates are published for informational purposes only and exchange rates may vary.

See http://www.ecb.europa.eu/stats/eurofxref/ for more information.

== Changelog ==

= 1.1 =
* added help text to edit pages

= 1.0 =
* first public version
