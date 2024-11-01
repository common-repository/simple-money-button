=== Simple Money Button ===
Contributors: kuopassa
Tags: money button,bitcoin
Donate link: https://www.paypal.me/kuopassa
Requires at least: 5.1.0
Tested up to: 6.1.1
Requires PHP: 7.0
Stable tag: trunk

Place [simple_money_button] shortcodes in your WordPress site.

== Description ==
Create one or more shortcodes for accepting Bitcoin SV payments through Money Button. A shotcode looks like:

[simple_money_button to="kuopassa@moneybutton.com" amount="0.01" currency="USD" type="tip"]

a) Variable "to" should be either a Money Button username, a Paymail address, or a Bitcoin SV address.
b) Variable "amount" should use a period as decimal separator.
c) Currency can be either fiat currency code, like USD, or digital currency code, like BSV.
d) Variable "type" can be either "tip" or "buy".
e) Quotes in the shortcode should be basic quotes, not curly.

Available attributes, their default values, and data types:

to = empty (string)
amount = 1 (string)
currency = USD (string)
label = empty (string)*
successmessage = Thank you! (string)
hideamount = false (boolean)
buttonid = empty (string)
type = tip (string)
editable = false (boolean)
disabled = false (boolean)
devmode = false (boolean)

*) max. 20 characters including amount length.

More information about Money Button is available at: www.moneybutton.com

== Installation ==
Install and enable.

== Changelog ==
Version 0.1 was released 24th March 2019. Basic functionality was implemented.

Version 0.2 was released 18th May 2019. Minor enhancements to the code.

Version 0.3 was released 28th January 2023. Minor enhancements to the code.