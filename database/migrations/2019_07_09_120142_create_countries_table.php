<?php

use App\Models\Countries;
use App\Models\Currency;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('currencies', function (Blueprint $table) {
			$table->char('code', 3);
			$table->primary('code');
			$table->string('name');
			$table->string('symbol', 4);
			$table->float('exchange_rate', 10, 4)->default(0.00);
			$table->timestamps();
		});

		Schema::create('countries', function (Blueprint $table) {
			$table->char('country_code', 2);
			$table->primary('country_code');
			$table->string('name');
			$table->string('dial_code', 6);
			$table->char('currency_code', 3)->nullable(true);
			$table->foreign('currency_code')->references('code')->on('currencies')->onDelete('cascade');
		});

		$this->populateData();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('countries');
		Schema::dropIfExists('currencies');
	}

	private function populateData()
	{

		$currencies = [
			[
				"code" => "IDR",
				"name" => "Indonesian rupiah",
				"symbol" => "Rp",
				"exchange_rate" => 15536.69
			],
			[
				"code" => "HUF",
				"name" => "Hungarian forint",
				"symbol" => "Ft",
				"exchange_rate" => 330.53
			],
			[
				"code" => "ISK",
				"name" => "Icelandic króna",
				"symbol" => "kr",
				"exchange_rate" => 136.9
			],
			[
				"code" => "JPY",
				"name" => "Japanese yen",
				"symbol" => "¥",
				"exchange_rate" => 120.54
			],
			[
				"code" => "INR",
				"name" => "Indian rupee",
				"symbol" => "₹",
				"exchange_rate" => 80.0085
			],
			[
				"code" => "RUB",
				"name" => "Russian ruble",
				"symbol" => "",
				"exchange_rate" => 69.119
			],
			[
				"code" => "PHP",
				"name" => "Philippine peso",
				"symbol" => "₱",
				"exchange_rate" => 56.983
			],
			[
				"code" => "THB",
				"name" => "Thai baht",
				"symbol" => "฿",
				"exchange_rate" => 33.614
			],
			[
				"code" => "CZK",
				"name" => "Czech koruna",
				"symbol" => "Kč",
				"exchange_rate" => 25.36
			],
			[
				"code" => "MXN",
				"name" => "Mexican peso",
				"symbol" => "$",
				"exchange_rate" => 21.1433
			],
			[
				"code" => "ZAR",
				"name" => "South African rand",
				"symbol" => "R",
				"exchange_rate" => 15.9222
			],
			[
				"code" => "SEK",
				"name" => "Swedish krona",
				"symbol" => "kr",
				"exchange_rate" => 10.4858
			],
			[
				"code" => "NOK",
				"name" => "Norwegian krone",
				"symbol" => "kr",
				"exchange_rate" => 9.8315
			],
			[
				"code" => "HKD",
				"name" => "Hong Kong dollar",
				"symbol" => "$",
				"exchange_rate" => 8.6713
			],
			[
				"code" => "CNY",
				"name" => "Chinese yuan",
				"symbol" => "¥",
				"exchange_rate" => 7.7712
			],
			[
				"code" => "DKK",
				"name" => "Danish krone",
				"symbol" => "kr",
				"exchange_rate" => 7.4731
			],
			[
				"code" => "HRK",
				"name" => "Croatian kuna",
				"symbol" => "kn",
				"exchange_rate" => 7.4463
			],
			[
				"code" => "TRY",
				"name" => "Turkish lira",
				"symbol" => "",
				"exchange_rate" => 6.6587
			],
			[
				"code" => "RON",
				"name" => "Romanian leu",
				"symbol" => "lei",
				"exchange_rate" => 4.7784
			],
			[
				"code" => "MYR",
				"name" => "Malaysian ringgit",
				"symbol" => "RM",
				"exchange_rate" => 4.5725
			],
			[
				"code" => "BRL",
				"name" => "Brazilian real",
				"symbol" => "R$",
				"exchange_rate" => 4.5271
			],
			[
				"code" => "PLN",
				"name" => "Polish z?oty",
				"symbol" => "zł",
				"exchange_rate" => 4.2493
			],
			[
				"code" => "ILS",
				"name" => "Israeli new shekel",
				"symbol" => "₪",
				"exchange_rate" => 3.8766
			],
			[
				"code" => "BGN",
				"name" => "Bulgarian lev",
				"symbol" => "лв",
				"exchange_rate" => 1.9558
			],
			[
				"code" => "NZD",
				"name" => "New Zealand dollar",
				"symbol" => "$",
				"exchange_rate" => 1.6718
			],
			[
				"code" => "AUD",
				"name" => "Australian dollar",
				"symbol" => "$",
				"exchange_rate" => 1.6031
			],
			[
				"code" => "CAD",
				"name" => "Canadian dollar",
				"symbol" => "$",
				"exchange_rate" => 1.4471
			],
			[
				"code" => "USD",
				"name" => "United States dollar",
				"symbol" => "$",
				"exchange_rate" => 1.1147
			],
			[
				"code" => "CHF",
				"name" => "Swiss franc",
				"symbol" => "Fr",
				"exchange_rate" => 1.084
			],
			[
				"code" => "GBP",
				"name" => "British pound",
				"symbol" => "£",
				"exchange_rate" => 0.85115
			],
			[
				"code" => "TWD",
				"name" => "New Taiwan dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "NPR",
				"name" => "Nepalese rupee",
				"symbol" => "₨",
				"exchange_rate" => 0
			],
			[
				"code" => "COP",
				"name" => "Colombian peso",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "BHD",
				"name" => "Bahraini dinar",
				"symbol" => ".د.ب",
				"exchange_rate" => 0
			],
			[
				"code" => "PKR",
				"name" => "Pakistani rupee",
				"symbol" => "₨",
				"exchange_rate" => 0
			],
			[
				"code" => "XOF",
				"name" => "West African CFA fra",
				"symbol" => "Fr",
				"exchange_rate" => 0
			],
			[
				"code" => "TND",
				"name" => "Tunisian dinar",
				"symbol" => "د.ت",
				"exchange_rate" => 0
			],
			[
				"code" => "OMR",
				"name" => "Omani rial",
				"symbol" => "ر.ع.",
				"exchange_rate" => 0
			],
			[
				"code" => "MZN",
				"name" => "Mozambican metical",
				"symbol" => "MT",
				"exchange_rate" => 0
			],
			[
				"code" => "GYD",
				"name" => "Guyanese dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "MGA",
				"name" => "Malagasy ariary",
				"symbol" => "Ar",
				"exchange_rate" => 0
			],
			[
				"code" => "GIP",
				"name" => "Gibraltar pound",
				"symbol" => "£",
				"exchange_rate" => 0
			],
			[
				"code" => "MVR",
				"name" => "Maldivian rufiyaa",
				"symbol" => ".ރ",
				"exchange_rate" => 0
			],
			[
				"code" => "RWF",
				"name" => "Rwandan franc",
				"symbol" => "Fr",
				"exchange_rate" => 0
			],
			[
				"code" => "NAD",
				"name" => "Namibian dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "JOD",
				"name" => "Jordanian dinar",
				"symbol" => "د.ا",
				"exchange_rate" => 0
			],
			[
				"code" => "VUV",
				"name" => "Vanuatu vatu",
				"symbol" => "Vt",
				"exchange_rate" => 0
			],
			[
				"code" => "BBD",
				"name" => "Barbadian dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "UAH",
				"name" => "Ukrainian hryvnia",
				"symbol" => "₴",
				"exchange_rate" => 0
			],
			[
				"code" => "SOS",
				"name" => "Somali shilling",
				"symbol" => "Sh",
				"exchange_rate" => 0
			],
			[
				"code" => "GEL",
				"name" => "Georgian lari",
				"symbol" => "ლ",
				"exchange_rate" => 0
			],
			[
				"code" => "LKR",
				"name" => "Sri Lankan rupee",
				"symbol" => "රු",
				"exchange_rate" => 0
			],
			[
				"code" => "MDL",
				"name" => "Moldovan leu",
				"symbol" => "L",
				"exchange_rate" => 0
			],
			[
				"code" => "MMK",
				"name" => "Burmese kyat",
				"symbol" => "Ks",
				"exchange_rate" => 0
			],
			[
				"code" => "LRD",
				"name" => "Liberian dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "MRO",
				"name" => "Mauritanian ouguiya",
				"symbol" => "UM",
				"exchange_rate" => 0
			],
			[
				"code" => "BYR",
				"name" => "Belarusian ruble",
				"symbol" => "Br",
				"exchange_rate" => 0
			],
			[
				"code" => "PGK",
				"name" => "Papua New Guinean ki",
				"symbol" => "K",
				"exchange_rate" => 0
			],
			[
				"code" => "BZD",
				"name" => "Belize dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "SRD",
				"name" => "Surinamese dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "DZD",
				"name" => "Algerian dinar",
				"symbol" => "د.ج",
				"exchange_rate" => 0
			],
			[
				"code" => "ARS",
				"name" => "Argentine peso",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "KHR",
				"name" => "Cambodian riel",
				"symbol" => "៛",
				"exchange_rate" => 0
			],
			[
				"code" => "FJD",
				"name" => "Fijian dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "PEN",
				"name" => "Peruvian nuevo sol",
				"symbol" => "S/.",
				"exchange_rate" => 0
			],
			[
				"code" => "UZS",
				"name" => "Uzbekistani som",
				"symbol" => "",
				"exchange_rate" => 0
			],
			[
				"code" => "DJF",
				"name" => "Djiboutian franc",
				"symbol" => "Fr",
				"exchange_rate" => 0
			],
			[
				"code" => "HNL",
				"name" => "Honduran lempira",
				"symbol" => "L",
				"exchange_rate" => 0
			],
			[
				"code" => "LBP",
				"name" => "Lebanese pound",
				"symbol" => "ل.ل",
				"exchange_rate" => 0
			],
			[
				"code" => "EGP",
				"name" => "Egyptian pound",
				"symbol" => "ج.م",
				"exchange_rate" => 0
			],
			[
				"code" => "TJS",
				"name" => "Tajikistani somoni",
				"symbol" => "ЅМ",
				"exchange_rate" => 0
			],
			[
				"code" => "TMT",
				"name" => "Turkmenistan manat",
				"symbol" => "m",
				"exchange_rate" => 0
			],
			[
				"code" => "LSL",
				"name" => "Lesotho loti",
				"symbol" => "L",
				"exchange_rate" => 0
			],
			[
				"code" => "YER",
				"name" => "Yemeni rial",
				"symbol" => "﷼",
				"exchange_rate" => 0
			],
			[
				"code" => "SBD",
				"name" => "Solomon Islands doll",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "MUR",
				"name" => "Mauritian rupee",
				"symbol" => "₨",
				"exchange_rate" => 0
			],
			[
				"code" => "PAB",
				"name" => "Panamanian balboa",
				"symbol" => "B/.",
				"exchange_rate" => 0
			],
			[
				"code" => "KMF",
				"name" => "Comorian franc",
				"symbol" => "Fr",
				"exchange_rate" => 0
			],
			[
				"code" => "BDT",
				"name" => "Bangladeshi taka",
				"symbol" => "৳",
				"exchange_rate" => 0
			],
			[
				"code" => "HTG",
				"name" => "Haitian gourde",
				"symbol" => "G",
				"exchange_rate" => 0
			],
			[
				"code" => "ALL",
				"name" => "Albanian lek",
				"symbol" => "L",
				"exchange_rate" => 0
			],
			[
				"code" => "MAD",
				"name" => "Moroccan dirham",
				"symbol" => "د.م.",
				"exchange_rate" => 0
			],
			[
				"code" => "MWK",
				"name" => "Malawian kwacha",
				"symbol" => "MK",
				"exchange_rate" => 0
			],
			[
				"code" => "AMD",
				"name" => "Armenian dram",
				"symbol" => "",
				"exchange_rate" => 0
			],
			[
				"code" => "UGX",
				"name" => "Ugandan shilling",
				"symbol" => "Sh",
				"exchange_rate" => 0
			],
			[
				"code" => "DOP",
				"name" => "Dominican peso",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "KWD",
				"name" => "Kuwaiti dinar",
				"symbol" => "د.ك",
				"exchange_rate" => 0
			],
			[
				"code" => "EUR",
				"name" => "Euro",
				"symbol" => "€",
				"exchange_rate" => 1
			],
			[
				"code" => "ZMW",
				"name" => "Zambian kwacha",
				"symbol" => "ZK",
				"exchange_rate" => 0
			],
			[
				"code" => "XAF",
				"name" => "Central African CFA ",
				"symbol" => "Fr",
				"exchange_rate" => 0
			],
			[
				"code" => "IQD",
				"name" => "Iraqi dinar",
				"symbol" => "ع.د",
				"exchange_rate" => 0
			],
			[
				"code" => "BIF",
				"name" => "Burundian franc",
				"symbol" => "Fr",
				"exchange_rate" => 0
			],
			[
				"code" => "GHS",
				"name" => "Ghana cedi",
				"symbol" => "₵",
				"exchange_rate" => 0
			],
			[
				"code" => "CUC",
				"name" => "Cuban convertible pe",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "SZL",
				"name" => "Swazi lilangeni",
				"symbol" => "L",
				"exchange_rate" => 0
			],
			[
				"code" => "GNF",
				"name" => "Guinean franc",
				"symbol" => "Fr",
				"exchange_rate" => 0
			],
			[
				"code" => "ETB",
				"name" => "Ethiopian birr",
				"symbol" => "Br",
				"exchange_rate" => 0
			],
			[
				"code" => "AOA",
				"name" => "Angolan kwanza",
				"symbol" => "Kz",
				"exchange_rate" => 0
			],
			[
				"code" => "SCR",
				"name" => "Seychellois rupee",
				"symbol" => "₨",
				"exchange_rate" => 0
			],
			[
				"code" => "GTQ",
				"name" => "Guatemalan quetzal",
				"symbol" => "Q",
				"exchange_rate" => 0
			],
			[
				"code" => "SLL",
				"name" => "Sierra Leonean leone",
				"symbol" => "Le",
				"exchange_rate" => 0
			],
			[
				"code" => "CVE",
				"name" => "Cape Verdean escudo",
				"symbol" => "Esc",
				"exchange_rate" => 0
			],
			[
				"code" => "JMD",
				"name" => "Jamaican dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "AWG",
				"name" => "Aruban florin",
				"symbol" => "ƒ",
				"exchange_rate" => 0
			],
			[
				"code" => "SAR",
				"name" => "Saudi riyal",
				"symbol" => "ر.س",
				"exchange_rate" => 0
			],
			[
				"code" => "BWP",
				"name" => "Botswana pula",
				"symbol" => "P",
				"exchange_rate" => 0
			],
			[
				"code" => "UYU",
				"name" => "Uruguayan peso",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "TTD",
				"name" => "Trinidad and Tobago ",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "BND",
				"name" => "Brunei dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "BTN",
				"name" => "Bhutanese ngultrum",
				"symbol" => "Nu.",
				"exchange_rate" => 0
			],
			[
				"code" => "QAR",
				"name" => "Qatari riyal",
				"symbol" => "ر.ق",
				"exchange_rate" => 0
			],
			[
				"code" => "BMD",
				"name" => "Bermudian dollar",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "SDG",
				"name" => "Sudanese pound",
				"symbol" => "ج.س.",
				"exchange_rate" => 0
			],
			[
				"code" => "LAK",
				"name" => "Lao kip",
				"symbol" => "₭",
				"exchange_rate" => 0
			],
			[
				"code" => "AED",
				"name" => "United Arab Emirates",
				"symbol" => "د.إ",
				"exchange_rate" => 0
			],
			[
				"code" => "CLP",
				"name" => "Chilean peso",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "RSD",
				"name" => "Serbian dinar",
				"symbol" => "дин.",
				"exchange_rate" => 0
			],
			[
				"code" => "KGS",
				"name" => "Kyrgyzstani som",
				"symbol" => "лв",
				"exchange_rate" => 0
			],
			[
				"code" => "KES",
				"name" => "Kenyan shilling",
				"symbol" => "Sh",
				"exchange_rate" => 0
			],
			[
				"code" => "XPF",
				"name" => "CFP franc",
				"symbol" => "Fr",
				"exchange_rate" => 0
			],
			[
				"code" => "AZN",
				"name" => "Azerbaijani manat",
				"symbol" => "",
				"exchange_rate" => 0
			],
			[
				"code" => "XCD",
				"name" => "East Caribbean dolla",
				"symbol" => "$",
				"exchange_rate" => 0
			],
			[
				"code" => "AFN",
				"name" => "Afghan afghani",
				"symbol" => "؋",
				"exchange_rate" => 0
			],
			[
				"code" => "ERN",
				"name" => "Eritrean nakfa",
				"symbol" => "Nfk",
				"exchange_rate" => 0
			],
			[
				"code" => "NGN",
				"name" => "Nigerian naira",
				"symbol" => "₦",
				"exchange_rate" => 0
			]
		];

		$countries = [
			[
				'name'            => 'Aland Islands',
				'country_code'    => 'AX',
				'dial_code'       => '+358',
				'currency_code'   => null
			],
			[
				'name'            => 'Albania',
				'country_code'    => 'AL',
				'dial_code'       => '+355',
				'currency_code'   => 'ALL'
			],
			[
				'name'            => 'Algeria',
				'country_code'    => 'DZ',
				'dial_code'       => '+213',
				'currency_code'   => 'DZD'
			],
			[
				'name'            => 'AmericanSamoa',
				'country_code'    => 'AS',
				'dial_code'       => '+1684',
				'currency_code'   => null
			],
			[
				'name'            => 'Andorra',
				'country_code'    => 'AD',
				'dial_code'       => '+376',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Angola',
				'country_code'    => 'AO',
				'dial_code'       => '+244',
				'currency_code'   => 'AOA'
			],
			[
				'name'            => 'Anguilla',
				'country_code'    => 'AI',
				'dial_code'       => '+1264',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Antarctica',
				'country_code'    => 'AQ',
				'dial_code'       => '+672',
				'currency_code'   => null
			],
			[
				'name'            => 'Antigua and Barbuda',
				'country_code'    => 'AG',
				'dial_code'       => '+1268',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Argentina',
				'country_code'    => 'AR',
				'dial_code'       => '+54',
				'currency_code'   => 'ARS'
			],
			[
				'name'            => 'Armenia',
				'country_code'    => 'AM',
				'dial_code'       => '+374',
				'currency_code'   => 'AMD'
			],
			[
				'name'            => 'Aruba',
				'country_code'    => 'AW',
				'dial_code'       => '+297',
				'currency_code'   => 'AWG'
			],
			[
				'name'            => 'Australia',
				'country_code'    => 'AU',
				'dial_code'       => '+61',
				'currency_code'   => 'AUD'
			],
			[
				'name'            => 'Austria',
				'country_code'    => 'AT',
				'dial_code'       => '+43',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Azerbaijan',
				'country_code'    => 'AZ',
				'dial_code'       => '+994',
				'currency_code'   => 'AZN'
			],
			[
				'name'            => 'Bahamas',
				'country_code'    => 'BS',
				'dial_code'       => '+1242',
				'currency_code'   => null
			],
			[
				'name'            => 'Bahrain',
				'country_code'    => 'BH',
				'dial_code'       => '+973',
				'currency_code'   => 'BHD'
			],
			[
				'name'            => 'Bangladesh',
				'country_code'    => 'BD',
				'dial_code'       => '+880',
				'currency_code'   => 'BDT'
			],
			[
				'name'            => 'Barbados',
				'country_code'    => 'BB',
				'dial_code'       => '+1246',
				'currency_code'   => 'BBD'
			],
			[
				'name'            => 'Belarus',
				'country_code'    => 'BY',
				'dial_code'       => '+375',
				'currency_code'   => 'BYR'
			],
			[
				'name'            => 'Belgium',
				'country_code'    => 'BE',
				'dial_code'       => '+32',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Belize',
				'country_code'    => 'BZ',
				'dial_code'       => '+501',
				'currency_code'   => 'BZD'
			],
			[
				'name'            => 'Benin',
				'country_code'    => 'BJ',
				'dial_code'       => '+229',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Bermuda',
				'country_code'    => 'BM',
				'dial_code'       => '+1441',
				'currency_code'   => 'BMD'
			],
			[
				'name'            => 'Bhutan',
				'country_code'    => 'BT',
				'dial_code'       => '+975',
				'currency_code'   => 'BTN'
			],
			[
				'name'            => 'Bolivia, Plurination',
				'country_code'    => 'BO',
				'dial_code'       => '+591',
				'currency_code'   => null
			],
			[
				'name'            => 'Bosnia and Herzegovi',
				'country_code'    => 'BA',
				'dial_code'       => '+387',
				'currency_code'   => null
			],
			[
				'name'            => 'Botswana',
				'country_code'    => 'BW',
				'dial_code'       => '+267',
				'currency_code'   => 'BWP'
			],
			[
				'name'            => 'Brazil',
				'country_code'    => 'BR',
				'dial_code'       => '+55',
				'currency_code'   => 'BRL'
			],
			[
				'name'            => 'British Indian Ocean',
				'country_code'    => 'IO',
				'dial_code'       => '+246',
				'currency_code'   => null
			],
			[
				'name'            => 'Brunei Darussalam',
				'country_code'    => 'BN',
				'dial_code'       => '+673',
				'currency_code'   => null
			],
			[
				'name'            => 'Bulgaria',
				'country_code'    => 'BG',
				'dial_code'       => '+359',
				'currency_code'   => 'BGN'
			],
			[
				'name'            => 'Burkina Faso',
				'country_code'    => 'BF',
				'dial_code'       => '+226',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Burundi',
				'country_code'    => 'BI',
				'dial_code'       => '+257',
				'currency_code'   => 'BIF'
			],
			[
				'name'            => 'Cambodia',
				'country_code'    => 'KH',
				'dial_code'       => '+855',
				'currency_code'   => 'KHR'
			],
			[
				'name'            => 'Cameroon',
				'country_code'    => 'CM',
				'dial_code'       => '+237',
				'currency_code'   => 'XAF'
			],
			[
				'name'            => 'Canada',
				'country_code'    => 'CA',
				'dial_code'       => '+1',
				'currency_code'   => 'CAD'
			],
			[
				'name'            => 'Cape Verde',
				'country_code'    => 'CV',
				'dial_code'       => '+238',
				'currency_code'   => 'CVE'
			],
			[
				'name'            => 'Central African Repu',
				'country_code'    => 'CF',
				'dial_code'       => '+236',
				'currency_code'   => null
			],
			[
				'name'            => 'Chad',
				'country_code'    => 'TD',
				'dial_code'       => '+235',
				'currency_code'   => 'XAF'
			],
			[
				'name'            => 'Chile',
				'country_code'    => 'CL',
				'dial_code'       => '+56',
				'currency_code'   => 'CLP'
			],
			[
				'name'            => 'China',
				'country_code'    => 'CN',
				'dial_code'       => '+86',
				'currency_code'   => 'CNY'
			],
			[
				'name'            => 'Christmas Island',
				'country_code'    => 'CX',
				'dial_code'       => '+61',
				'currency_code'   => null
			],
			[
				'name'            => 'Cocos (Keeling) Isla',
				'country_code'    => 'CC',
				'dial_code'       => '+61',
				'currency_code'   => null
			],
			[
				'name'            => 'Colombia',
				'country_code'    => 'CO',
				'dial_code'       => '+57',
				'currency_code'   => 'COP'
			],
			[
				'name'            => 'Comoros',
				'country_code'    => 'KM',
				'dial_code'       => '+269',
				'currency_code'   => 'KMF'
			],
			[
				'name'            => 'Congo',
				'country_code'    => 'CG',
				'dial_code'       => '+242',
				'currency_code'   => null
			],
			[
				'name'            => 'Congo, The Democrati',
				'country_code'    => 'CD',
				'dial_code'       => '+243',
				'currency_code'   => null
			],
			[
				'name'            => 'Cook Islands',
				'country_code'    => 'CK',
				'dial_code'       => '+682',
				'currency_code'   => 'NZD'
			],
			[
				'name'            => 'Cote d\'Ivoire',
				'country_code'    => 'CI',
				'dial_code'       => '+225',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Croatia',
				'country_code'    => 'HR',
				'dial_code'       => '+385',
				'currency_code'   => 'HRK'
			],
			[
				'name'            => 'Cuba',
				'country_code'    => 'CU',
				'dial_code'       => '+53',
				'currency_code'   => 'CUC'
			],
			[
				'name'            => 'Cyprus',
				'country_code'    => 'CY',
				'dial_code'       => '+357',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Czech Republic',
				'country_code'    => 'CZ',
				'dial_code'       => '+420',
				'currency_code'   => 'CZK'
			],
			[
				'name'            => 'Denmark',
				'country_code'    => 'DK',
				'dial_code'       => '+45',
				'currency_code'   => 'DKK'
			],
			[
				'name'            => 'Djibouti',
				'country_code'    => 'DJ',
				'dial_code'       => '+253',
				'currency_code'   => 'DJF'
			],
			[
				'name'            => 'Dominica',
				'country_code'    => 'DM',
				'dial_code'       => '+1767',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Dominican Republic',
				'country_code'    => 'DO',
				'dial_code'       => '+1849',
				'currency_code'   => 'DOP'
			],
			[
				'name'            => 'Ecuador',
				'country_code'    => 'EC',
				'dial_code'       => '+593',
				'currency_code'   => 'USD'
			],
			[
				'name'            => 'Egypt',
				'country_code'    => 'EG',
				'dial_code'       => '+20',
				'currency_code'   => 'EGP'
			],
			[
				'name'            => 'El Salvador',
				'country_code'    => 'SV',
				'dial_code'       => '+503',
				'currency_code'   => 'USD'
			],
			[
				'name'            => 'Equatorial Guinea',
				'country_code'    => 'GQ',
				'dial_code'       => '+240',
				'currency_code'   => 'XAF'
			],
			[
				'name'            => 'Eritrea',
				'country_code'    => 'ER',
				'dial_code'       => '+291',
				'currency_code'   => 'ERN'
			],
			[
				'name'            => 'Estonia',
				'country_code'    => 'EE',
				'dial_code'       => '+372',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Ethiopia',
				'country_code'    => 'ET',
				'dial_code'       => '+251',
				'currency_code'   => 'ETB'
			],
			[
				'name'            => 'Falkland Islands (Ma',
				'country_code'    => 'FK',
				'dial_code'       => '+500',
				'currency_code'   => null
			],
			[
				'name'            => 'Faroe Islands',
				'country_code'    => 'FO',
				'dial_code'       => '+298',
				'currency_code'   => 'DKK'
			],
			[
				'name'            => 'Fiji',
				'country_code'    => 'FJ',
				'dial_code'       => '+679',
				'currency_code'   => 'FJD'
			],
			[
				'name'            => 'Finland',
				'country_code'    => 'FI',
				'dial_code'       => '+358',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'France',
				'country_code'    => 'FR',
				'dial_code'       => '+33',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'French Guiana',
				'country_code'    => 'GF',
				'dial_code'       => '+594',
				'currency_code'   => null
			],
			[
				'name'            => 'French Polynesia',
				'country_code'    => 'PF',
				'dial_code'       => '+689',
				'currency_code'   => 'XPF'
			],
			[
				'name'            => 'Gabon',
				'country_code'    => 'GA',
				'dial_code'       => '+241',
				'currency_code'   => 'XAF'
			],
			[
				'name'            => 'Gambia',
				'country_code'    => 'GM',
				'dial_code'       => '+220',
				'currency_code'   => null
			],
			[
				'name'            => 'Georgia',
				'country_code'    => 'GE',
				'dial_code'       => '+995',
				'currency_code'   => 'GEL'
			],
			[
				'name'            => 'Germany',
				'country_code'    => 'DE',
				'dial_code'       => '+49',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Ghana',
				'country_code'    => 'GH',
				'dial_code'       => '+233',
				'currency_code'   => 'GHS'
			],
			[
				'name'            => 'Gibraltar',
				'country_code'    => 'GI',
				'dial_code'       => '+350',
				'currency_code'   => 'GIP'
			],
			[
				'name'            => 'Greece',
				'country_code'    => 'GR',
				'dial_code'       => '+30',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Greenland',
				'country_code'    => 'GL',
				'dial_code'       => '+299',
				'currency_code'   => null
			],
			[
				'name'            => 'Grenada',
				'country_code'    => 'GD',
				'dial_code'       => '+1473',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Guadeloupe',
				'country_code'    => 'GP',
				'dial_code'       => '+590',
				'currency_code'   => null
			],
			[
				'name'            => 'Guam',
				'country_code'    => 'GU',
				'dial_code'       => '+1671',
				'currency_code'   => null
			],
			[
				'name'            => 'Guatemala',
				'country_code'    => 'GT',
				'dial_code'       => '+502',
				'currency_code'   => 'GTQ'
			],
			[
				'name'            => 'Guernsey',
				'country_code'    => 'GG',
				'dial_code'       => '+44',
				'currency_code'   => 'GBP'
			],
			[
				'name'            => 'Guinea',
				'country_code'    => 'GN',
				'dial_code'       => '+224',
				'currency_code'   => 'GNF'
			],
			[
				'name'            => 'Guinea-Bissau',
				'country_code'    => 'GW',
				'dial_code'       => '+245',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Guyana',
				'country_code'    => 'GY',
				'dial_code'       => '+595',
				'currency_code'   => 'GYD'
			],
			[
				'name'            => 'Haiti',
				'country_code'    => 'HT',
				'dial_code'       => '+509',
				'currency_code'   => 'HTG'
			],
			[
				'name'            => 'Holy See (Vatican Ci',
				'country_code'    => 'VA',
				'dial_code'       => '+379',
				'currency_code'   => null
			],
			[
				'name'            => 'Honduras',
				'country_code'    => 'HN',
				'dial_code'       => '+504',
				'currency_code'   => 'HNL'
			],
			[
				'name'            => 'Hong Kong',
				'country_code'    => 'HK',
				'dial_code'       => '+852',
				'currency_code'   => 'HKD'
			],
			[
				'name'            => 'Hungary',
				'country_code'    => 'HU',
				'dial_code'       => '+36',
				'currency_code'   => 'HUF'
			],
			[
				'name'            => 'Iceland',
				'country_code'    => 'IS',
				'dial_code'       => '+354',
				'currency_code'   => 'ISK'
			],
			[
				'name'            => 'India',
				'country_code'    => 'IN',
				'dial_code'       => '+91',
				'currency_code'   => 'INR'
			],
			[
				'name'            => 'Indonesia',
				'country_code'    => 'ID',
				'dial_code'       => '+62',
				'currency_code'   => 'IDR'
			],
			[
				'name'            => 'Iran, Islamic Republ',
				'country_code'    => 'IR',
				'dial_code'       => '+98',
				'currency_code'   => null
			],
			[
				'name'            => 'Iraq',
				'country_code'    => 'IQ',
				'dial_code'       => '+964',
				'currency_code'   => 'IQD'
			],
			[
				'name'            => 'Ireland',
				'country_code'    => 'IE',
				'dial_code'       => '+353',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Isle of Man',
				'country_code'    => 'IM',
				'dial_code'       => '+44',
				'currency_code'   => 'GBP'
			],
			[
				'name'            => 'Israel',
				'country_code'    => 'IL',
				'dial_code'       => '+972',
				'currency_code'   => 'ILS'
			],
			[
				'name'            => 'Italy',
				'country_code'    => 'IT',
				'dial_code'       => '+39',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Jamaica',
				'country_code'    => 'JM',
				'dial_code'       => '+1876',
				'currency_code'   => 'JMD'
			],
			[
				'name'            => 'Japan',
				'country_code'    => 'JP',
				'dial_code'       => '+81',
				'currency_code'   => 'JPY'
			],
			[
				'name'            => 'Jersey',
				'country_code'    => 'JE',
				'dial_code'       => '+44',
				'currency_code'   => 'GBP'
			],
			[
				'name'            => 'Jordan',
				'country_code'    => 'JO',
				'dial_code'       => '+962',
				'currency_code'   => 'JOD'
			],
			[
				'name'            => 'Kenya',
				'country_code'    => 'KE',
				'dial_code'       => '+254',
				'currency_code'   => 'KES'
			],
			[
				'name'            => 'Kiribati',
				'country_code'    => 'KI',
				'dial_code'       => '+686',
				'currency_code'   => 'AUD'
			],
			[
				'name'            => 'Korea, Democratic Pe',
				'country_code'    => 'KP',
				'dial_code'       => '+850',
				'currency_code'   => null
			],
			[
				'name'            => 'Korea, Republic of S',
				'country_code'    => 'KR',
				'dial_code'       => '+82',
				'currency_code'   => null
			],
			[
				'name'            => 'Kuwait',
				'country_code'    => 'KW',
				'dial_code'       => '+965',
				'currency_code'   => 'KWD'
			],
			[
				'name'            => 'Kyrgyzstan',
				'country_code'    => 'KG',
				'dial_code'       => '+996',
				'currency_code'   => 'KGS'
			],
			[
				'name'            => 'Laos',
				'country_code'    => 'LA',
				'dial_code'       => '+856',
				'currency_code'   => 'LAK'
			],
			[
				'name'            => 'Latvia',
				'country_code'    => 'LV',
				'dial_code'       => '+371',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Lebanon',
				'country_code'    => 'LB',
				'dial_code'       => '+961',
				'currency_code'   => 'LBP'
			],
			[
				'name'            => 'Lesotho',
				'country_code'    => 'LS',
				'dial_code'       => '+266',
				'currency_code'   => 'LSL'
			],
			[
				'name'            => 'Liberia',
				'country_code'    => 'LR',
				'dial_code'       => '+231',
				'currency_code'   => 'LRD'
			],
			[
				'name'            => 'Libyan Arab Jamahiri',
				'country_code'    => 'LY',
				'dial_code'       => '+218',
				'currency_code'   => null
			],
			[
				'name'            => 'Liechtenstein',
				'country_code'    => 'LI',
				'dial_code'       => '+423',
				'currency_code'   => 'CHF'
			],
			[
				'name'            => 'Lithuania',
				'country_code'    => 'LT',
				'dial_code'       => '+370',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Luxembourg',
				'country_code'    => 'LU',
				'dial_code'       => '+352',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Macao',
				'country_code'    => 'MO',
				'dial_code'       => '+853',
				'currency_code'   => null
			],
			[
				'name'            => 'Macedonia',
				'country_code'    => 'MK',
				'dial_code'       => '+389',
				'currency_code'   => null
			],
			[
				'name'            => 'Madagascar',
				'country_code'    => 'MG',
				'dial_code'       => '+261',
				'currency_code'   => 'MGA'
			],
			[
				'name'            => 'Malawi',
				'country_code'    => 'MW',
				'dial_code'       => '+265',
				'currency_code'   => 'MWK'
			],
			[
				'name'            => 'Malaysia',
				'country_code'    => 'MY',
				'dial_code'       => '+60',
				'currency_code'   => 'MYR'
			],
			[
				'name'            => 'Maldives',
				'country_code'    => 'MV',
				'dial_code'       => '+960',
				'currency_code'   => 'MVR'
			],
			[
				'name'            => 'Mali',
				'country_code'    => 'ML',
				'dial_code'       => '+223',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Malta',
				'country_code'    => 'MT',
				'dial_code'       => '+356',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Marshall Islands',
				'country_code'    => 'MH',
				'dial_code'       => '+692',
				'currency_code'   => 'USD'
			],
			[
				'name'            => 'Martinique',
				'country_code'    => 'MQ',
				'dial_code'       => '+596',
				'currency_code'   => null
			],
			[
				'name'            => 'Mauritania',
				'country_code'    => 'MR',
				'dial_code'       => '+222',
				'currency_code'   => 'MRO'
			],
			[
				'name'            => 'Mauritius',
				'country_code'    => 'MU',
				'dial_code'       => '+230',
				'currency_code'   => 'MUR'
			],
			[
				'name'            => 'Mayotte',
				'country_code'    => 'YT',
				'dial_code'       => '+262',
				'currency_code'   => null
			],
			[
				'name'            => 'Mexico',
				'country_code'    => 'MX',
				'dial_code'       => '+52',
				'currency_code'   => 'MXN'
			],
			[
				'name'            => 'Micronesia, Federate',
				'country_code'    => 'FM',
				'dial_code'       => '+691',
				'currency_code'   => null
			],
			[
				'name'            => 'Moldova',
				'country_code'    => 'MD',
				'dial_code'       => '+373',
				'currency_code'   => 'MDL'
			],
			[
				'name'            => 'Monaco',
				'country_code'    => 'MC',
				'dial_code'       => '+377',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Montenegro',
				'country_code'    => 'ME',
				'dial_code'       => '+382',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Montserrat',
				'country_code'    => 'MS',
				'dial_code'       => '+1664',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Morocco',
				'country_code'    => 'MA',
				'dial_code'       => '+212',
				'currency_code'   => 'MAD'
			],
			[
				'name'            => 'Mozambique',
				'country_code'    => 'MZ',
				'dial_code'       => '+258',
				'currency_code'   => 'MZN'
			],
			[
				'name'            => 'Myanmar',
				'country_code'    => 'MM',
				'dial_code'       => '+95',
				'currency_code'   => 'MMK'
			],
			[
				'name'            => 'Namibia',
				'country_code'    => 'NA',
				'dial_code'       => '+264',
				'currency_code'   => 'NAD'
			],
			[
				'name'            => 'Nauru',
				'country_code'    => 'NR',
				'dial_code'       => '+674',
				'currency_code'   => 'AUD'
			],
			[
				'name'            => 'Nepal',
				'country_code'    => 'NP',
				'dial_code'       => '+977',
				'currency_code'   => 'NPR'
			],
			[
				'name'            => 'Netherlands',
				'country_code'    => 'NL',
				'dial_code'       => '+31',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Netherlands Antilles',
				'country_code'    => 'AN',
				'dial_code'       => '+599',
				'currency_code'   => null
			],
			[
				'name'            => 'New Caledonia',
				'country_code'    => 'NC',
				'dial_code'       => '+687',
				'currency_code'   => 'XPF'
			],
			[
				'name'            => 'New Zealand',
				'country_code'    => 'NZ',
				'dial_code'       => '+64',
				'currency_code'   => 'NZD'
			],
			[
				'name'            => 'Niger',
				'country_code'    => 'NE',
				'dial_code'       => '+227',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Nigeria',
				'country_code'    => 'NG',
				'dial_code'       => '+234',
				'currency_code'   => 'NGN'
			],
			[
				'name'            => 'Niue',
				'country_code'    => 'NU',
				'dial_code'       => '+683',
				'currency_code'   => 'NZD'
			],
			[
				'name'            => 'Norfolk Island',
				'country_code'    => 'NF',
				'dial_code'       => '+672',
				'currency_code'   => null
			],
			[
				'name'            => 'Northern Mariana Isl',
				'country_code'    => 'MP',
				'dial_code'       => '+1670',
				'currency_code'   => null
			],
			[
				'name'            => 'Norway',
				'country_code'    => 'NO',
				'dial_code'       => '+47',
				'currency_code'   => 'NOK'
			],
			[
				'name'            => 'Oman',
				'country_code'    => 'OM',
				'dial_code'       => '+968',
				'currency_code'   => 'OMR'
			],
			[
				'name'            => 'Pakistan',
				'country_code'    => 'PK',
				'dial_code'       => '+92',
				'currency_code'   => 'PKR'
			],
			[
				'name'            => 'Palau',
				'country_code'    => 'PW',
				'dial_code'       => '+680',
				'currency_code'   => null
			],
			[
				'name'            => 'Palestinian Territor',
				'country_code'    => 'PS',
				'dial_code'       => '+970',
				'currency_code'   => null
			],
			[
				'name'            => 'Panama',
				'country_code'    => 'PA',
				'dial_code'       => '+507',
				'currency_code'   => 'PAB'
			],
			[
				'name'            => 'Papua New Guinea',
				'country_code'    => 'PG',
				'dial_code'       => '+675',
				'currency_code'   => 'PGK'
			],
			[
				'name'            => 'Peru',
				'country_code'    => 'PE',
				'dial_code'       => '+51',
				'currency_code'   => 'PEN'
			],
			[
				'name'            => 'Philippines',
				'country_code'    => 'PH',
				'dial_code'       => '+63',
				'currency_code'   => 'PHP'
			],
			[
				'name'            => 'Pitcairn',
				'country_code'    => 'PN',
				'dial_code'       => '+872',
				'currency_code'   => null
			],
			[
				'name'            => 'Poland',
				'country_code'    => 'PL',
				'dial_code'       => '+48',
				'currency_code'   => 'PLN'
			],
			[
				'name'            => 'Portugal',
				'country_code'    => 'PT',
				'dial_code'       => '+351',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Puerto Rico',
				'country_code'    => 'PR',
				'dial_code'       => '+1939',
				'currency_code'   => null
			],
			[
				'name'            => 'Qatar',
				'country_code'    => 'QA',
				'dial_code'       => '+974',
				'currency_code'   => 'QAR'
			],
			[
				'name'            => 'Romania',
				'country_code'    => 'RO',
				'dial_code'       => '+40',
				'currency_code'   => 'RON'
			],
			[
				'name'            => 'Russia',
				'country_code'    => 'RU',
				'dial_code'       => '+7',
				'currency_code'   => 'RUB'
			],
			[
				'name'            => 'Rwanda',
				'country_code'    => 'RW',
				'dial_code'       => '+250',
				'currency_code'   => 'RWF'
			],
			[
				'name'            => 'Reunion',
				'country_code'    => 'RE',
				'dial_code'       => '+262',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Barthelemy',
				'country_code'    => 'BL',
				'dial_code'       => '+590',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Helena, Ascens',
				'country_code'    => 'SH',
				'dial_code'       => '+290',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Kitts and Nevi',
				'country_code'    => 'KN',
				'dial_code'       => '+1869',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Lucia',
				'country_code'    => 'LC',
				'dial_code'       => '+1758',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Saint Martin',
				'country_code'    => 'MF',
				'dial_code'       => '+590',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Pierre and Miq',
				'country_code'    => 'PM',
				'dial_code'       => '+508',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Vincent and th',
				'country_code'    => 'VC',
				'dial_code'       => '+1784',
				'currency_code'   => null
			],
			[
				'name'            => 'San Marino',
				'country_code'    => 'SM',
				'dial_code'       => '+378',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Sao Tome and Princip',
				'country_code'    => 'ST',
				'dial_code'       => '+239',
				'currency_code'   => null
			],
			[
				'name'            => 'Saudi Arabia',
				'country_code'    => 'SA',
				'dial_code'       => '+966',
				'currency_code'   => 'SAR'
			],
			[
				'name'            => 'Senegal',
				'country_code'    => 'SN',
				'dial_code'       => '+221',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Serbia',
				'country_code'    => 'RS',
				'dial_code'       => '+381',
				'currency_code'   => 'RSD'
			],
			[
				'name'            => 'Seychelles',
				'country_code'    => 'SC',
				'dial_code'       => '+248',
				'currency_code'   => 'SCR'
			],
			[
				'name'            => 'Sierra Leone',
				'country_code'    => 'SL',
				'dial_code'       => '+232',
				'currency_code'   => 'SLL'
			],
			[
				'name'            => 'Singapore',
				'country_code'    => 'SG',
				'dial_code'       => '+65',
				'currency_code'   => 'BND'
			],
			[
				'name'            => 'Slovakia',
				'country_code'    => 'SK',
				'dial_code'       => '+421',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Slovenia',
				'country_code'    => 'SI',
				'dial_code'       => '+386',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Solomon Islands',
				'country_code'    => 'SB',
				'dial_code'       => '+677',
				'currency_code'   => 'SBD'
			],
			[
				'name'            => 'Somalia',
				'country_code'    => 'SO',
				'dial_code'       => '+252',
				'currency_code'   => 'SOS'
			],
			[
				'name'            => 'South Africa',
				'country_code'    => 'ZA',
				'dial_code'       => '+27',
				'currency_code'   => 'ZAR'
			],
			[
				'name'            => 'South Georgia and th',
				'country_code'    => 'GS',
				'dial_code'       => '+500',
				'currency_code'   => null
			],
			[
				'name'            => 'Spain',
				'country_code'    => 'ES',
				'dial_code'       => '+34',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Sri Lanka',
				'country_code'    => 'LK',
				'dial_code'       => '+94',
				'currency_code'   => 'LKR'
			],
			[
				'name'            => 'Sudan',
				'country_code'    => 'SD',
				'dial_code'       => '+249',
				'currency_code'   => 'SDG'
			],
			[
				'name'            => 'Suriname',
				'country_code'    => 'SR',
				'dial_code'       => '+597',
				'currency_code'   => 'SRD'
			],
			[
				'name'            => 'Svalbard and Jan May',
				'country_code'    => 'SJ',
				'dial_code'       => '+47',
				'currency_code'   => null
			],
			[
				'name'            => 'Swaziland',
				'country_code'    => 'SZ',
				'dial_code'       => '+268',
				'currency_code'   => 'SZL'
			],
			[
				'name'            => 'Sweden',
				'country_code'    => 'SE',
				'dial_code'       => '+46',
				'currency_code'   => 'SEK'
			],
			[
				'name'            => 'Switzerland',
				'country_code'    => 'CH',
				'dial_code'       => '+41',
				'currency_code'   => 'CHF'
			],
			[
				'name'            => 'Syrian Arab Republic',
				'country_code'    => 'SY',
				'dial_code'       => '+963',
				'currency_code'   => null
			],
			[
				'name'            => 'Taiwan',
				'country_code'    => 'TW',
				'dial_code'       => '+886',
				'currency_code'   => 'TWD'
			],
			[
				'name'            => 'Tajikistan',
				'country_code'    => 'TJ',
				'dial_code'       => '+992',
				'currency_code'   => 'TJS'
			],
			[
				'name'            => 'Tanzania, United Rep',
				'country_code'    => 'TZ',
				'dial_code'       => '+255',
				'currency_code'   => null
			],
			[
				'name'            => 'Thailand',
				'country_code'    => 'TH',
				'dial_code'       => '+66',
				'currency_code'   => 'THB'
			],
			[
				'name'            => 'Timor-Leste',
				'country_code'    => 'TL',
				'dial_code'       => '+670',
				'currency_code'   => null
			],
			[
				'name'            => 'Togo',
				'country_code'    => 'TG',
				'dial_code'       => '+228',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Tokelau',
				'country_code'    => 'TK',
				'dial_code'       => '+690',
				'currency_code'   => null
			],
			[
				'name'            => 'Trinidad and Tobago',
				'country_code'    => 'TT',
				'dial_code'       => '+1868',
				'currency_code'   => 'TTD'
			],
			[
				'name'            => 'Tunisia',
				'country_code'    => 'TN',
				'dial_code'       => '+216',
				'currency_code'   => 'TND'
			],
			[
				'name'            => 'Turkey',
				'country_code'    => 'TR',
				'dial_code'       => '+90',
				'currency_code'   => 'TRY'
			],
			[
				'name'            => 'Turkmenistan',
				'country_code'    => 'TM',
				'dial_code'       => '+993',
				'currency_code'   => 'TMT'
			],
			[
				'name'            => 'Turks and Caicos Isl',
				'country_code'    => 'TC',
				'dial_code'       => '+1649',
				'currency_code'   => null
			],
			[
				'name'            => 'Tuvalu',
				'country_code'    => 'TV',
				'dial_code'       => '+688',
				'currency_code'   => 'AUD'
			],
			[
				'name'            => 'Uganda',
				'country_code'    => 'UG',
				'dial_code'       => '+256',
				'currency_code'   => 'UGX'
			],
			[
				'name'            => 'Ukraine',
				'country_code'    => 'UA',
				'dial_code'       => '+380',
				'currency_code'   => 'UAH'
			],
			[
				'name'            => 'United Arab Emirates',
				'country_code'    => 'AE',
				'dial_code'       => '+971',
				'currency_code'   => 'AED'
			],
			[
				'name'            => 'United Kingdom',
				'country_code'    => 'GB',
				'dial_code'       => '+44',
				'currency_code'   => 'GBP'
			],
			[
				'name'            => 'United States',
				'country_code'    => 'US',
				'dial_code'       => '+1',
				'currency_code'   => 'USD'
			],
			[
				'name'            => 'Uruguay',
				'country_code'    => 'UY',
				'dial_code'       => '+598',
				'currency_code'   => 'UYU'
			],
			[
				'name'            => 'Uzbekistan',
				'country_code'    => 'UZ',
				'dial_code'       => '+998',
				'currency_code'   => 'UZS'
			],
			[
				'name'            => 'Vanuatu',
				'country_code'    => 'VU',
				'dial_code'       => '+678',
				'currency_code'   => 'VUV'
			],
			[
				'name'            => 'Venezuela, Bolivaria',
				'country_code'    => 'VE',
				'dial_code'       => '+58',
				'currency_code'   => null
			],
			[
				'name'            => 'Virgin Islands, Brit',
				'country_code'    => 'VG',
				'dial_code'       => '+1284',
				'currency_code'   => null
			],
			[
				'name'            => 'Virgin Islands, U.S.',
				'country_code'    => 'VI',
				'dial_code'       => '+1340',
				'currency_code'   => null
			],
			[
				'name'            => 'Wallis and Futuna',
				'country_code'    => 'WF',
				'dial_code'       => '+681',
				'currency_code'   => 'XPF'
			],
			[
				'name'            => 'Yemen',
				'country_code'    => 'YE',
				'dial_code'       => '+967',
				'currency_code'   => 'YER'
			],
			[
				'name'            => 'Zambia',
				'country_code'    => 'ZM',
				'dial_code'       => '+260',
				'currency_code'   => 'ZMW'
			],
			[
				'name'            => 'Zimbabwe',
				'country_code'    => 'ZW',
				'dial_code'       => '+263',
				'currency_code'   => 'BWP'
			],
		];

		Currency::insert($currencies);
		Countries::insert($countries);
	}
}
