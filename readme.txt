=== Euro FxRef Currency Converter ===
Contributors: joostdekeijzer
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=joost@dekeijzer.org&item_name=eurofxref+WordPress+plugin&item_number=Joost+de+Keijzer&currency_code=EUR
Tags: shortcode, currency converter, currency, converter, foreign exchange conversion, fx rate converter, ECB
Requires at least: 3.3
Tested up to:  3.6
Stable tag: 1.2
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

* `EUR`    Euro (&euro;)
* `USD`    US Dollar ($)
* `JPY`    Japanese Yen (&#165;)
* `BGN`    Bulgarian Lev (ЛВ.)
* `CZK`    Czech Republic Koruna (K&#269;)
* `DKK`    Danish Krone (kr)
* `GBP`    British Pound Sterling (&pound;)
* `HUF`    Hungarian Forint (Ft)
* `LTL`    Lithuanian Litas (Lt)
* `LVL`    Latvian Lats (Ls)
* `PLN`    Polish Zloty (z&#322;)
* `RON`    New Romanian Leu ()RON
* `SEK`    Swedish Krona (kr)
* `CHF`    Swiss Franc (CHF)
* `NOK`    Norwegian Krone (kr)
* `HRK`    Croatian Kuna (kn)
* `RUB`    Russian Rouble (py6.)
* `TRY`    Turkish Lira (TL)
* `AUD`    Australian Dollar ($)
* `BRL`    Brasilian Real (R$)
* `CAD`    Canadian Dollar ($)
* `CNY`    Chinese Yuan (&#20803;)
* `HKD`    Hong Kong Dollar ($)
* `IDR`    Indonesian Rupiah (Rp)
* `ILS`    Israeli New Sheqel (&#8362;)
* `INR`    Indian Rupee (&#8377;)
* `KRW`    South Korean Won (&#8361;)
* `MXN`    Mexican Peso ($)
* `MYR`    Malaysian Ringgit (RM)
* `NZD`    New Zealand Dollar ($)
* `PHP`    Philippine Peso (₱)
* `SGD`    Singapore Dollar ($)
* `THB`    Thai Baht (&#3647;)
* `ZAR`    South African Rand (R)

== Frequently Asked Questions ==

= Where do the exchange rates come from? =
The European Central Bank (ECB) daily publishes "foreign exchange reference rates" against more than 30 other currencies. These rates are used by this plugin.

The rates are published for informational purposes only and exchange rates may vary.

See http://www.ecb.europa.eu/stats/eurofxref/ for more information.

== Changelog ==

= 1.2 =
* bugfix where [currency_legal] default prepend "* " would not be added
* updated plugin uri to new WordPress.org uri scheme
* all currency symbols should be correct now (some in unicode)

= 1.1 =
* added help text to edit pages

= 1.0 =
* first public version
