=== Euro FxRef Currency Converter ===
Contributors: joostdekeijzer
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=j@dkzr.nl&item_name=eurofxref+WordPress+plugin&item_number=Joost+de+Keijzer&currency_code=EUR&amount=10
Tags: shortcode, currency converter, currency, converter, foreign exchange conversion, fx rate converter, ECB
Requires at least: 3.3
Tested up to: 6.2
Stable tag: 2.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the [currency] and [currency_legal] shortcodes to convert currencies based on the ECB reference exchange rates.

== Description ==

Using the `[currency]` shortcode you can convert one currency to another. The conversion is based on the rates published by the ECB. You can change from and to any of the supported currencies. 

The `[currency_legal]` shortcode outputs a disclaimer text and a link to the ECB eurofxref page.

= Important! =
ECB advices against using their rates for transaction purposes. From their site: "The reference rates are published for information purposes only. Using the rates for transaction purposes is strongly discouraged."

The reference rates are usually updated by ECB at around 16:00 CET every working day, except on [TARGET closing days](https://www.ecb.europa.eu/services/contacts/working-hours/html/index.en.html).

Go to the [ECB site](https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/html/index.en.html) for more information and disclaimers.

Also note that conversion from non-Euro to non-Euro is done through the Euro, so GBP to USD is calculated as GBP &rarr; EUR &rarr; USD (converted 2 times).

This plugin is based on a plugin by [Xclamation](http://www.xclamationdesign.co.uk/free-currency-converter-shortcode-plugin-for-wordpress/).

Also see [wp_eurofxref on GitHub](https://github.com/joostdekeijzer/wp_eurofxref) where development takes place.

== Installation ==

Installation is easiest through the WordPress "New Plugin" button and search for "Euro FxRef Currency Converter".

But you can also manually:

* Download the plugin
* Uncompress it with your preferred unzip application
* Copy the entire directory in your plugin directory of your WordPress blog (/wp-content/plugins)
* Activate the plugin

== Shortcode usage & examples ==

= currency_legal shortcode =
This shortcode returns the string '* For informational purposes only. Exchange rates may vary. Based on <a href="https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/" target="_blank">ECB reference rates</a>.'

The prepended '* ' (the same string as the [currency] append string) can be changed using the 'prepend' attribute.

For example: `[currency_legal prepend='Please note: ']`

If you want to change the default prepent string for your whole site you can use the default `shortcode_atts_currency_legal` filter.
See the [shortcode_atts_{&#36;shortcode} reference](http://developer.wordpress.org/reference/hooks/shortcode_atts_shortcode/) for more information about this.

**`legal_string` method**

The legal string can also be retrieved in PHP

*Usage*

`<?php echo EuroFxRef::legal_string( &#36;prepend ) ?>`

*Parameters*

* &#36;prepend (string) The string to prepend the legal text with, default '* '

*Return Value*

(string) Legal text prepended with &#36;prepend string.

= currency shortcode =

Attributes:

* `from`: currency code (default: EUR)
* `to`: currency code (default: USD)
* `amount`: number of "from" currency (default: 1)
* `iso`: boolean (default false); use ISO currency formatting."€ 1" would become "1 EUR" in ISO notation.
* `show_from`: boolean (default true); show from amount in output
* `between`: string (default '&amp;nbsp;/&amp;nbsp;' which is displayed as '&nbsp;/&nbsp;' in the browser); string between from and to amounts
* `append`: string (default '&amp;nbsp;*' which is displayed as '&nbsp;*' in the browser); string put after conversion. The * references the disclaimer text, see [currency_legal] shortcode.
* `round: boolean` (default true); Round numbers to whole units.
* `round_append`: string (default '='); replaces decimals
* `no_from_show_rate`: boolean (default true); when from amount is hidden in the output the "to" text gets a tooltip that displays the exchange rate. The &lt;span&gt; element with this tooltip is styled with the `to_style` css string below. Set the `no_from_show_rate` option to false to disable the &lt;span&gt; and tooltip.
* `to_style`: css string (default 'cursor:help;border-bottom:1px dotted gray;'); styling of "to" text &lt;span&gt; wrapper.

If you want to change the defaults for your whole site you can use the default `shortcode_atts_currency` filter. See the [shortcode_atts_{&#36;shortcode} reference](http://developer.wordpress.org/reference/hooks/shortcode_atts_shortcode/) for more information about this.

**`convert` method**

Since v1.3, you can call the convertor staticly from PHP in your code.

*Usage*

`<?php EuroFxRef::convert( &#36;amount, &#36;from, &#36;to ); ?>`

*Parameters*

* &#36;amount (float) The amount of currency you want to convert.
* &#36;from (string) The currency code the amount is in, default EUR.
* &#36;to (string) The currency code the amount must be converted to, default USD

*Return Value*

(float) the converted value or 0 (zero) if any of the currency code's are not available.

= Examples =
* `[currency amount="875" from="EUR" to="GBP"]` 
  becomes "€ 875,= / £ 697.= *"
* `[currency amount="875" from="GBP" to="USD" iso=true between=" converts to " append="" round_append=""]` 
  becomes "875 GBP converts to 1,418 USD"
* `[currency amount="875" from="GBP" to="USD" show_from=false round=false]` 
  becomes "&#36; 1,130.15 *"

* `<?php &#36;process_later = EuroFxRef::convert( 10, 'USD', 'GBP' ); ?>`
  will return the raw numeric (float) value without formatting: `6.01877256317689468545495401485823094844818115234375`

= Currently available currencies =

* `AUD` - Australian dollar (&#36;)
* `BGN` - Bulgarian lev (&#1083;&#1074;.)
* `BRL` - Brasilian real (&#82;&#36;)
* `CAD` - Canadian dollar (&#36;)
* `CHF` - Swiss franc (&#67;&#72;&#70;)
* `CNY` - Chinese yuan (&yen;)
* `CZK` - Czech koruna (&#75;&#269;)
* `DKK` - Danish krone (kr.)
* `EUR` - Euro (&euro;)
* `GBP` - Pound sterling (&pound;)
* `HKD` - Hong Kong dollar (&#36;)
* `HUF` - Hungarian forint (&#70;&#116;)
* `IDR` - Indonesian rupiah (Rp)
* `ILS` - Israeli new sheqel (&#8362;)
* `INR` - Indian rupee (&#8377;)
* `ISK` - Icelandic króna (kr.)
* `JPY` - Japanese yen (&yen;)
* `KRW` - South Korean won (&#8361;)
* `MXN` - Mexican peso (&#36;)
* `MYR` - Malaysian ringgit (&#82;&#77;)
* `NOK` - Norwegian krone (&#107;&#114;)
* `NZD` - New Zealand dollar (&#36;)
* `PHP` - Philippine peso (&#8369;)
* `PLN` - Polish złoty (&#122;&#322;)
* `RON` - Romanian leu (lei)
* `SEK` - Swedish krona (&#107;&#114;)
* `SGD` - Singapore dollar (&#36;)
* `THB` - Thai baht (&#3647;)
* `TRY` - Turkish lira (&#8378;)
* `USD` - United States (US) dollar (&#36;)
* `ZAR` - South African rand (&#82;)

LTL and LVL are not published any more at least since 2-jan-2020.  
RUB is not published since 1-jun-2022 and HRK since 2-jan-2023.



== Frequently Asked Questions ==

= Where do the exchange rates come from? =
The European Central Bank (ECB) daily publishes "foreign exchange reference rates" against more than 30 other currencies. These rates are used by this plugin.

The rates are published for informational purposes only and exchange rates may vary.

See the [ECB site](https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/) for more information.

== Changelog ==

= 2.0 =
* Added `no_from_show_rate` shortcode attribute for the `[convert]` shortcode.
* Added an option to hook into the default `shortcode_atts_{&#36;shortcode}` filter for both shortcodes. Those filters become 'shortcode_atts_currency' and 'shortcode_atts_currency_legal'. Please see [shortcode_atts_{&#36;shortcode} reference](http://developer.wordpress.org/reference/hooks/shortcode_atts_shortcode/) for more information.
* Updated list of available currencies based on changes by the ECB (RUB and HRK where removed).
* Refactor of currency symbols and number formats based on how WooCommerce does it.
* Added filters to modify the currency symbols and the number formats: `eurofxref_currency_symbols` and `eurofxref_number_formats`.
* The currency symbols are also run through the `woocommerce_currency_symbols` filter so if you have WooCommerce you don't need to use the `eurofxref_currency_symbols` filter.

= 1.5 =
* ECB changed the currencies it publishes: ISK is published again but LTL and LVL were removed.

= 1.4.2 =
* Updated ECB url
* Updated all links to https
* Compatible with WordPress 5.3.2

= 1.4.1 =
* Updated PayPal donation link
* Compatible with WordPress 5.2.3

= 1.4 =
* ECB seems to block requests from user-agent WordPress/<version>, changed the user-agent string

= 1.3 =
* Rewrite, so now you can call the convertor staticly from PHP
* Compatible with WordPress 3.9

= 1.2.1 =
* Compatible with WordPress 3.8

= 1.2 =
* bugfix where [currency_legal] default prepend "* " would not be added
* updated plugin uri to new WordPress.org uri scheme
* all currency symbols should be correct now (some in unicode)

= 1.1 =
* added help text to edit pages

= 1.0 =
* first public version
