<?php

use App\Models\Countries;
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
		Schema::create('countries', function (Blueprint $table) {
			$table->string('name');
			$table->char('country_code', 2);
			$table->primary('country_code');
			$table->string('dial_code', 6);
			$table->string('currency_name');
			$table->string('currency_symbol', 4);
			$table->char('currency_code', 3)->nullable(true);
			$table->unique(['country_code', 'currency_code']);
			$table->float('exchange_rate', 10, 4)->default(0.00);
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
	}

	private function populateData()
	{
		$countries = [
			[
				'name'            => 'Afghanistan',
				'country_code'    => 'AF',
				'dial_code'       => '+93',
				'currency_name'   => 'Afghan afghani',
				'currency_symbol' => '؋',
				'currency_code'   => 'AFN'
			],
			[
				'name'            => 'Aland Islands',
				'country_code'    => 'AX',
				'dial_code'       => '+358',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Albania',
				'country_code'    => 'AL',
				'dial_code'       => '+355',
				'currency_name'   => 'Albanian lek',
				'currency_symbol' => 'L',
				'currency_code'   => 'ALL'
			],
			[
				'name'            => 'Algeria',
				'country_code'    => 'DZ',
				'dial_code'       => '+213',
				'currency_name'   => 'Algerian dinar',
				'currency_symbol' => 'د.ج',
				'currency_code'   => 'DZD'
			],
			[
				'name'            => 'AmericanSamoa',
				'country_code'    => 'AS',
				'dial_code'       => '+1684',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Andorra',
				'country_code'    => 'AD',
				'dial_code'       => '+376',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Angola',
				'country_code'    => 'AO',
				'dial_code'       => '+244',
				'currency_name'   => 'Angolan kwanza',
				'currency_symbol' => 'Kz',
				'currency_code'   => 'AOA'
			],
			[
				'name'            => 'Anguilla',
				'country_code'    => 'AI',
				'dial_code'       => '+1264',
				'currency_name'   => 'East Caribbean dolla',
				'currency_symbol' => '$',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Antarctica',
				'country_code'    => 'AQ',
				'dial_code'       => '+672',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Antigua and Barbuda',
				'country_code'    => 'AG',
				'dial_code'       => '+1268',
				'currency_name'   => 'East Caribbean dolla',
				'currency_symbol' => '$',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Argentina',
				'country_code'    => 'AR',
				'dial_code'       => '+54',
				'currency_name'   => 'Argentine peso',
				'currency_symbol' => '$',
				'currency_code'   => 'ARS'
			],
			[
				'name'            => 'Armenia',
				'country_code'    => 'AM',
				'dial_code'       => '+374',
				'currency_name'   => 'Armenian dram',
				'currency_symbol' => '',
				'currency_code'   => 'AMD'
			],
			[
				'name'            => 'Aruba',
				'country_code'    => 'AW',
				'dial_code'       => '+297',
				'currency_name'   => 'Aruban florin',
				'currency_symbol' => 'ƒ',
				'currency_code'   => 'AWG'
			],
			[
				'name'            => 'Australia',
				'country_code'    => 'AU',
				'dial_code'       => '+61',
				'currency_name'   => 'Australian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'AUD'
			],
			[
				'name'            => 'Austria',
				'country_code'    => 'AT',
				'dial_code'       => '+43',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Azerbaijan',
				'country_code'    => 'AZ',
				'dial_code'       => '+994',
				'currency_name'   => 'Azerbaijani manat',
				'currency_symbol' => '',
				'currency_code'   => 'AZN'
			],
			[
				'name'            => 'Bahamas',
				'country_code'    => 'BS',
				'dial_code'       => '+1242',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Bahrain',
				'country_code'    => 'BH',
				'dial_code'       => '+973',
				'currency_name'   => 'Bahraini dinar',
				'currency_symbol' => '.د.ب',
				'currency_code'   => 'BHD'
			],
			[
				'name'            => 'Bangladesh',
				'country_code'    => 'BD',
				'dial_code'       => '+880',
				'currency_name'   => 'Bangladeshi taka',
				'currency_symbol' => '৳',
				'currency_code'   => 'BDT'
			],
			[
				'name'            => 'Barbados',
				'country_code'    => 'BB',
				'dial_code'       => '+1246',
				'currency_name'   => 'Barbadian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'BBD'
			],
			[
				'name'            => 'Belarus',
				'country_code'    => 'BY',
				'dial_code'       => '+375',
				'currency_name'   => 'Belarusian ruble',
				'currency_symbol' => 'Br',
				'currency_code'   => 'BYR'
			],
			[
				'name'            => 'Belgium',
				'country_code'    => 'BE',
				'dial_code'       => '+32',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Belize',
				'country_code'    => 'BZ',
				'dial_code'       => '+501',
				'currency_name'   => 'Belize dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'BZD'
			],
			[
				'name'            => 'Benin',
				'country_code'    => 'BJ',
				'dial_code'       => '+229',
				'currency_name'   => 'West African CFA fra',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Bermuda',
				'country_code'    => 'BM',
				'dial_code'       => '+1441',
				'currency_name'   => 'Bermudian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'BMD'
			],
			[
				'name'            => 'Bhutan',
				'country_code'    => 'BT',
				'dial_code'       => '+975',
				'currency_name'   => 'Bhutanese ngultrum',
				'currency_symbol' => 'Nu.',
				'currency_code'   => 'BTN'
			],
			[
				'name'            => 'Bolivia, Plurination',
				'country_code'    => 'BO',
				'dial_code'       => '+591',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Bosnia and Herzegovi',
				'country_code'    => 'BA',
				'dial_code'       => '+387',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Botswana',
				'country_code'    => 'BW',
				'dial_code'       => '+267',
				'currency_name'   => 'Botswana pula',
				'currency_symbol' => 'P',
				'currency_code'   => 'BWP'
			],
			[
				'name'            => 'Brazil',
				'country_code'    => 'BR',
				'dial_code'       => '+55',
				'currency_name'   => 'Brazilian real',
				'currency_symbol' => 'R$',
				'currency_code'   => 'BRL'
			],
			[
				'name'            => 'British Indian Ocean',
				'country_code'    => 'IO',
				'dial_code'       => '+246',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Brunei Darussalam',
				'country_code'    => 'BN',
				'dial_code'       => '+673',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Bulgaria',
				'country_code'    => 'BG',
				'dial_code'       => '+359',
				'currency_name'   => 'Bulgarian lev',
				'currency_symbol' => 'лв',
				'currency_code'   => 'BGN'
			],
			[
				'name'            => 'Burkina Faso',
				'country_code'    => 'BF',
				'dial_code'       => '+226',
				'currency_name'   => 'West African CFA fra',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Burundi',
				'country_code'    => 'BI',
				'dial_code'       => '+257',
				'currency_name'   => 'Burundian franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'BIF'
			],
			[
				'name'            => 'Cambodia',
				'country_code'    => 'KH',
				'dial_code'       => '+855',
				'currency_name'   => 'Cambodian riel',
				'currency_symbol' => '៛',
				'currency_code'   => 'KHR'
			],
			[
				'name'            => 'Cameroon',
				'country_code'    => 'CM',
				'dial_code'       => '+237',
				'currency_name'   => 'Central African CFA ',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XAF'
			],
			[
				'name'            => 'Canada',
				'country_code'    => 'CA',
				'dial_code'       => '+1',
				'currency_name'   => 'Canadian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'CAD'
			],
			[
				'name'            => 'Cape Verde',
				'country_code'    => 'CV',
				'dial_code'       => '+238',
				'currency_name'   => 'Cape Verdean escudo',
				'currency_symbol' => 'Esc',
				'currency_code'   => 'CVE'
			],
			[
				'name'            => 'Central African Repu',
				'country_code'    => 'CF',
				'dial_code'       => '+236',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Chad',
				'country_code'    => 'TD',
				'dial_code'       => '+235',
				'currency_name'   => 'Central African CFA ',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XAF'
			],
			[
				'name'            => 'Chile',
				'country_code'    => 'CL',
				'dial_code'       => '+56',
				'currency_name'   => 'Chilean peso',
				'currency_symbol' => '$',
				'currency_code'   => 'CLP'
			],
			[
				'name'            => 'China',
				'country_code'    => 'CN',
				'dial_code'       => '+86',
				'currency_name'   => 'Chinese yuan',
				'currency_symbol' => '¥',
				'currency_code'   => 'CNY'
			],
			[
				'name'            => 'Christmas Island',
				'country_code'    => 'CX',
				'dial_code'       => '+61',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Cocos (Keeling) Isla',
				'country_code'    => 'CC',
				'dial_code'       => '+61',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Colombia',
				'country_code'    => 'CO',
				'dial_code'       => '+57',
				'currency_name'   => 'Colombian peso',
				'currency_symbol' => '$',
				'currency_code'   => 'COP'
			],
			[
				'name'            => 'Comoros',
				'country_code'    => 'KM',
				'dial_code'       => '+269',
				'currency_name'   => 'Comorian franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'KMF'
			],
			[
				'name'            => 'Congo',
				'country_code'    => 'CG',
				'dial_code'       => '+242',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Congo, The Democrati',
				'country_code'    => 'CD',
				'dial_code'       => '+243',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Cook Islands',
				'country_code'    => 'CK',
				'dial_code'       => '+682',
				'currency_name'   => 'New Zealand dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'NZD'
			],
			[
				'name'            => 'Cote d\'Ivoire',
				'country_code'    => 'CI',
				'dial_code'       => '+225',
				'currency_name'   => 'West African CFA fra',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Croatia',
				'country_code'    => 'HR',
				'dial_code'       => '+385',
				'currency_name'   => 'Croatian kuna',
				'currency_symbol' => 'kn',
				'currency_code'   => 'HRK'
			],
			[
				'name'            => 'Cuba',
				'country_code'    => 'CU',
				'dial_code'       => '+53',
				'currency_name'   => 'Cuban convertible pe',
				'currency_symbol' => '$',
				'currency_code'   => 'CUC'
			],
			[
				'name'            => 'Cyprus',
				'country_code'    => 'CY',
				'dial_code'       => '+357',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Czech Republic',
				'country_code'    => 'CZ',
				'dial_code'       => '+420',
				'currency_name'   => 'Czech koruna',
				'currency_symbol' => 'Kč',
				'currency_code'   => 'CZK'
			],
			[
				'name'            => 'Denmark',
				'country_code'    => 'DK',
				'dial_code'       => '+45',
				'currency_name'   => 'Danish krone',
				'currency_symbol' => 'kr',
				'currency_code'   => 'DKK'
			],
			[
				'name'            => 'Djibouti',
				'country_code'    => 'DJ',
				'dial_code'       => '+253',
				'currency_name'   => 'Djiboutian franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'DJF'
			],
			[
				'name'            => 'Dominica',
				'country_code'    => 'DM',
				'dial_code'       => '+1767',
				'currency_name'   => 'East Caribbean dolla',
				'currency_symbol' => '$',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Dominican Republic',
				'country_code'    => 'DO',
				'dial_code'       => '+1849',
				'currency_name'   => 'Dominican peso',
				'currency_symbol' => '$',
				'currency_code'   => 'DOP'
			],
			[
				'name'            => 'Ecuador',
				'country_code'    => 'EC',
				'dial_code'       => '+593',
				'currency_name'   => 'United States dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'USD'
			],
			[
				'name'            => 'Egypt',
				'country_code'    => 'EG',
				'dial_code'       => '+20',
				'currency_name'   => 'Egyptian pound',
				'currency_symbol' => 'ج.م',
				'currency_code'   => 'EGP'
			],
			[
				'name'            => 'El Salvador',
				'country_code'    => 'SV',
				'dial_code'       => '+503',
				'currency_name'   => 'United States dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'USD'
			],
			[
				'name'            => 'Equatorial Guinea',
				'country_code'    => 'GQ',
				'dial_code'       => '+240',
				'currency_name'   => 'Central African CFA ',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XAF'
			],
			[
				'name'            => 'Eritrea',
				'country_code'    => 'ER',
				'dial_code'       => '+291',
				'currency_name'   => 'Eritrean nakfa',
				'currency_symbol' => 'Nfk',
				'currency_code'   => 'ERN'
			],
			[
				'name'            => 'Estonia',
				'country_code'    => 'EE',
				'dial_code'       => '+372',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Ethiopia',
				'country_code'    => 'ET',
				'dial_code'       => '+251',
				'currency_name'   => 'Ethiopian birr',
				'currency_symbol' => 'Br',
				'currency_code'   => 'ETB'
			],
			[
				'name'            => 'Falkland Islands (Ma',
				'country_code'    => 'FK',
				'dial_code'       => '+500',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Faroe Islands',
				'country_code'    => 'FO',
				'dial_code'       => '+298',
				'currency_name'   => 'Danish krone',
				'currency_symbol' => 'kr',
				'currency_code'   => 'DKK'
			],
			[
				'name'            => 'Fiji',
				'country_code'    => 'FJ',
				'dial_code'       => '+679',
				'currency_name'   => 'Fijian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'FJD'
			],
			[
				'name'            => 'Finland',
				'country_code'    => 'FI',
				'dial_code'       => '+358',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'France',
				'country_code'    => 'FR',
				'dial_code'       => '+33',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'French Guiana',
				'country_code'    => 'GF',
				'dial_code'       => '+594',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'French Polynesia',
				'country_code'    => 'PF',
				'dial_code'       => '+689',
				'currency_name'   => 'CFP franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XPF'
			],
			[
				'name'            => 'Gabon',
				'country_code'    => 'GA',
				'dial_code'       => '+241',
				'currency_name'   => 'Central African CFA ',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XAF'
			],
			[
				'name'            => 'Gambia',
				'country_code'    => 'GM',
				'dial_code'       => '+220',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Georgia',
				'country_code'    => 'GE',
				'dial_code'       => '+995',
				'currency_name'   => 'Georgian lari',
				'currency_symbol' => 'ლ',
				'currency_code'   => 'GEL'
			],
			[
				'name'            => 'Germany',
				'country_code'    => 'DE',
				'dial_code'       => '+49',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Ghana',
				'country_code'    => 'GH',
				'dial_code'       => '+233',
				'currency_name'   => 'Ghana cedi',
				'currency_symbol' => '₵',
				'currency_code'   => 'GHS'
			],
			[
				'name'            => 'Gibraltar',
				'country_code'    => 'GI',
				'dial_code'       => '+350',
				'currency_name'   => 'Gibraltar pound',
				'currency_symbol' => '£',
				'currency_code'   => 'GIP'
			],
			[
				'name'            => 'Greece',
				'country_code'    => 'GR',
				'dial_code'       => '+30',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Greenland',
				'country_code'    => 'GL',
				'dial_code'       => '+299',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Grenada',
				'country_code'    => 'GD',
				'dial_code'       => '+1473',
				'currency_name'   => 'East Caribbean dolla',
				'currency_symbol' => '$',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Guadeloupe',
				'country_code'    => 'GP',
				'dial_code'       => '+590',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Guam',
				'country_code'    => 'GU',
				'dial_code'       => '+1671',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Guatemala',
				'country_code'    => 'GT',
				'dial_code'       => '+502',
				'currency_name'   => 'Guatemalan quetzal',
				'currency_symbol' => 'Q',
				'currency_code'   => 'GTQ'
			],
			[
				'name'            => 'Guernsey',
				'country_code'    => 'GG',
				'dial_code'       => '+44',
				'currency_name'   => 'British pound',
				'currency_symbol' => '£',
				'currency_code'   => 'GBP'
			],
			[
				'name'            => 'Guinea',
				'country_code'    => 'GN',
				'dial_code'       => '+224',
				'currency_name'   => 'Guinean franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'GNF'
			],
			[
				'name'            => 'Guinea-Bissau',
				'country_code'    => 'GW',
				'dial_code'       => '+245',
				'currency_name'   => 'West African CFA fra',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Guyana',
				'country_code'    => 'GY',
				'dial_code'       => '+595',
				'currency_name'   => 'Guyanese dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'GYD'
			],
			[
				'name'            => 'Haiti',
				'country_code'    => 'HT',
				'dial_code'       => '+509',
				'currency_name'   => 'Haitian gourde',
				'currency_symbol' => 'G',
				'currency_code'   => 'HTG'
			],
			[
				'name'            => 'Holy See (Vatican Ci',
				'country_code'    => 'VA',
				'dial_code'       => '+379',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Honduras',
				'country_code'    => 'HN',
				'dial_code'       => '+504',
				'currency_name'   => 'Honduran lempira',
				'currency_symbol' => 'L',
				'currency_code'   => 'HNL'
			],
			[
				'name'            => 'Hong Kong',
				'country_code'    => 'HK',
				'dial_code'       => '+852',
				'currency_name'   => 'Hong Kong dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'HKD'
			],
			[
				'name'            => 'Hungary',
				'country_code'    => 'HU',
				'dial_code'       => '+36',
				'currency_name'   => 'Hungarian forint',
				'currency_symbol' => 'Ft',
				'currency_code'   => 'HUF'
			],
			[
				'name'            => 'Iceland',
				'country_code'    => 'IS',
				'dial_code'       => '+354',
				'currency_name'   => 'Icelandic króna',
				'currency_symbol' => 'kr',
				'currency_code'   => 'ISK'
			],
			[
				'name'            => 'India',
				'country_code'    => 'IN',
				'dial_code'       => '+91',
				'currency_name'   => 'Indian rupee',
				'currency_symbol' => '₹',
				'currency_code'   => 'INR'
			],
			[
				'name'            => 'Indonesia',
				'country_code'    => 'ID',
				'dial_code'       => '+62',
				'currency_name'   => 'Indonesian rupiah',
				'currency_symbol' => 'Rp',
				'currency_code'   => 'IDR'
			],
			[
				'name'            => 'Iran, Islamic Republ',
				'country_code'    => 'IR',
				'dial_code'       => '+98',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Iraq',
				'country_code'    => 'IQ',
				'dial_code'       => '+964',
				'currency_name'   => 'Iraqi dinar',
				'currency_symbol' => 'ع.د',
				'currency_code'   => 'IQD'
			],
			[
				'name'            => 'Ireland',
				'country_code'    => 'IE',
				'dial_code'       => '+353',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Isle of Man',
				'country_code'    => 'IM',
				'dial_code'       => '+44',
				'currency_name'   => 'British pound',
				'currency_symbol' => '£',
				'currency_code'   => 'GBP'
			],
			[
				'name'            => 'Israel',
				'country_code'    => 'IL',
				'dial_code'       => '+972',
				'currency_name'   => 'Israeli new shekel',
				'currency_symbol' => '₪',
				'currency_code'   => 'ILS'
			],
			[
				'name'            => 'Italy',
				'country_code'    => 'IT',
				'dial_code'       => '+39',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Jamaica',
				'country_code'    => 'JM',
				'dial_code'       => '+1876',
				'currency_name'   => 'Jamaican dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'JMD'
			],
			[
				'name'            => 'Japan',
				'country_code'    => 'JP',
				'dial_code'       => '+81',
				'currency_name'   => 'Japanese yen',
				'currency_symbol' => '¥',
				'currency_code'   => 'JPY'
			],
			[
				'name'            => 'Jersey',
				'country_code'    => 'JE',
				'dial_code'       => '+44',
				'currency_name'   => 'British pound',
				'currency_symbol' => '£',
				'currency_code'   => 'GBP'
			],
			[
				'name'            => 'Jordan',
				'country_code'    => 'JO',
				'dial_code'       => '+962',
				'currency_name'   => 'Jordanian dinar',
				'currency_symbol' => 'د.ا',
				'currency_code'   => 'JOD'
			],
			[
				'name'            => 'Kenya',
				'country_code'    => 'KE',
				'dial_code'       => '+254',
				'currency_name'   => 'Kenyan shilling',
				'currency_symbol' => 'Sh',
				'currency_code'   => 'KES'
			],
			[
				'name'            => 'Kiribati',
				'country_code'    => 'KI',
				'dial_code'       => '+686',
				'currency_name'   => 'Australian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'AUD'
			],
			[
				'name'            => 'Korea, Democratic Pe',
				'country_code'    => 'KP',
				'dial_code'       => '+850',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Korea, Republic of S',
				'country_code'    => 'KR',
				'dial_code'       => '+82',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Kuwait',
				'country_code'    => 'KW',
				'dial_code'       => '+965',
				'currency_name'   => 'Kuwaiti dinar',
				'currency_symbol' => 'د.ك',
				'currency_code'   => 'KWD'
			],
			[
				'name'            => 'Kyrgyzstan',
				'country_code'    => 'KG',
				'dial_code'       => '+996',
				'currency_name'   => 'Kyrgyzstani som',
				'currency_symbol' => 'лв',
				'currency_code'   => 'KGS'
			],
			[
				'name'            => 'Laos',
				'country_code'    => 'LA',
				'dial_code'       => '+856',
				'currency_name'   => 'Lao kip',
				'currency_symbol' => '₭',
				'currency_code'   => 'LAK'
			],
			[
				'name'            => 'Latvia',
				'country_code'    => 'LV',
				'dial_code'       => '+371',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Lebanon',
				'country_code'    => 'LB',
				'dial_code'       => '+961',
				'currency_name'   => 'Lebanese pound',
				'currency_symbol' => 'ل.ل',
				'currency_code'   => 'LBP'
			],
			[
				'name'            => 'Lesotho',
				'country_code'    => 'LS',
				'dial_code'       => '+266',
				'currency_name'   => 'Lesotho loti',
				'currency_symbol' => 'L',
				'currency_code'   => 'LSL'
			],
			[
				'name'            => 'Liberia',
				'country_code'    => 'LR',
				'dial_code'       => '+231',
				'currency_name'   => 'Liberian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'LRD'
			],
			[
				'name'            => 'Libyan Arab Jamahiri',
				'country_code'    => 'LY',
				'dial_code'       => '+218',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Liechtenstein',
				'country_code'    => 'LI',
				'dial_code'       => '+423',
				'currency_name'   => 'Swiss franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'CHF'
			],
			[
				'name'            => 'Lithuania',
				'country_code'    => 'LT',
				'dial_code'       => '+370',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Luxembourg',
				'country_code'    => 'LU',
				'dial_code'       => '+352',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Macao',
				'country_code'    => 'MO',
				'dial_code'       => '+853',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Macedonia',
				'country_code'    => 'MK',
				'dial_code'       => '+389',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Madagascar',
				'country_code'    => 'MG',
				'dial_code'       => '+261',
				'currency_name'   => 'Malagasy ariary',
				'currency_symbol' => 'Ar',
				'currency_code'   => 'MGA'
			],
			[
				'name'            => 'Malawi',
				'country_code'    => 'MW',
				'dial_code'       => '+265',
				'currency_name'   => 'Malawian kwacha',
				'currency_symbol' => 'MK',
				'currency_code'   => 'MWK'
			],
			[
				'name'            => 'Malaysia',
				'country_code'    => 'MY',
				'dial_code'       => '+60',
				'currency_name'   => 'Malaysian ringgit',
				'currency_symbol' => 'RM',
				'currency_code'   => 'MYR'
			],
			[
				'name'            => 'Maldives',
				'country_code'    => 'MV',
				'dial_code'       => '+960',
				'currency_name'   => 'Maldivian rufiyaa',
				'currency_symbol' => '.ރ',
				'currency_code'   => 'MVR'
			],
			[
				'name'            => 'Mali',
				'country_code'    => 'ML',
				'dial_code'       => '+223',
				'currency_name'   => 'West African CFA fra',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Malta',
				'country_code'    => 'MT',
				'dial_code'       => '+356',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Marshall Islands',
				'country_code'    => 'MH',
				'dial_code'       => '+692',
				'currency_name'   => 'United States dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'USD'
			],
			[
				'name'            => 'Martinique',
				'country_code'    => 'MQ',
				'dial_code'       => '+596',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Mauritania',
				'country_code'    => 'MR',
				'dial_code'       => '+222',
				'currency_name'   => 'Mauritanian ouguiya',
				'currency_symbol' => 'UM',
				'currency_code'   => 'MRO'
			],
			[
				'name'            => 'Mauritius',
				'country_code'    => 'MU',
				'dial_code'       => '+230',
				'currency_name'   => 'Mauritian rupee',
				'currency_symbol' => '₨',
				'currency_code'   => 'MUR'
			],
			[
				'name'            => 'Mayotte',
				'country_code'    => 'YT',
				'dial_code'       => '+262',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Mexico',
				'country_code'    => 'MX',
				'dial_code'       => '+52',
				'currency_name'   => 'Mexican peso',
				'currency_symbol' => '$',
				'currency_code'   => 'MXN'
			],
			[
				'name'            => 'Micronesia, Federate',
				'country_code'    => 'FM',
				'dial_code'       => '+691',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Moldova',
				'country_code'    => 'MD',
				'dial_code'       => '+373',
				'currency_name'   => 'Moldovan leu',
				'currency_symbol' => 'L',
				'currency_code'   => 'MDL'
			],
			[
				'name'            => 'Monaco',
				'country_code'    => 'MC',
				'dial_code'       => '+377',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Montenegro',
				'country_code'    => 'ME',
				'dial_code'       => '+382',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Montserrat',
				'country_code'    => 'MS',
				'dial_code'       => '+1664',
				'currency_name'   => 'East Caribbean dolla',
				'currency_symbol' => '$',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Morocco',
				'country_code'    => 'MA',
				'dial_code'       => '+212',
				'currency_name'   => 'Moroccan dirham',
				'currency_symbol' => 'د.م.',
				'currency_code'   => 'MAD'
			],
			[
				'name'            => 'Mozambique',
				'country_code'    => 'MZ',
				'dial_code'       => '+258',
				'currency_name'   => 'Mozambican metical',
				'currency_symbol' => 'MT',
				'currency_code'   => 'MZN'
			],
			[
				'name'            => 'Myanmar',
				'country_code'    => 'MM',
				'dial_code'       => '+95',
				'currency_name'   => 'Burmese kyat',
				'currency_symbol' => 'Ks',
				'currency_code'   => 'MMK'
			],
			[
				'name'            => 'Namibia',
				'country_code'    => 'NA',
				'dial_code'       => '+264',
				'currency_name'   => 'Namibian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'NAD'
			],
			[
				'name'            => 'Nauru',
				'country_code'    => 'NR',
				'dial_code'       => '+674',
				'currency_name'   => 'Australian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'AUD'
			],
			[
				'name'            => 'Nepal',
				'country_code'    => 'NP',
				'dial_code'       => '+977',
				'currency_name'   => 'Nepalese rupee',
				'currency_symbol' => '₨',
				'currency_code'   => 'NPR'
			],
			[
				'name'            => 'Netherlands',
				'country_code'    => 'NL',
				'dial_code'       => '+31',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Netherlands Antilles',
				'country_code'    => 'AN',
				'dial_code'       => '+599',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'New Caledonia',
				'country_code'    => 'NC',
				'dial_code'       => '+687',
				'currency_name'   => 'CFP franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XPF'
			],
			[
				'name'            => 'New Zealand',
				'country_code'    => 'NZ',
				'dial_code'       => '+64',
				'currency_name'   => 'New Zealand dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'NZD'
			],
			[
				'name'            => 'Niger',
				'country_code'    => 'NE',
				'dial_code'       => '+227',
				'currency_name'   => 'West African CFA fra',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Nigeria',
				'country_code'    => 'NG',
				'dial_code'       => '+234',
				'currency_name'   => 'Nigerian naira',
				'currency_symbol' => '₦',
				'currency_code'   => 'NGN'
			],
			[
				'name'            => 'Niue',
				'country_code'    => 'NU',
				'dial_code'       => '+683',
				'currency_name'   => 'New Zealand dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'NZD'
			],
			[
				'name'            => 'Norfolk Island',
				'country_code'    => 'NF',
				'dial_code'       => '+672',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Northern Mariana Isl',
				'country_code'    => 'MP',
				'dial_code'       => '+1670',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Norway',
				'country_code'    => 'NO',
				'dial_code'       => '+47',
				'currency_name'   => 'Norwegian krone',
				'currency_symbol' => 'kr',
				'currency_code'   => 'NOK'
			],
			[
				'name'            => 'Oman',
				'country_code'    => 'OM',
				'dial_code'       => '+968',
				'currency_name'   => 'Omani rial',
				'currency_symbol' => 'ر.ع.',
				'currency_code'   => 'OMR'
			],
			[
				'name'            => 'Pakistan',
				'country_code'    => 'PK',
				'dial_code'       => '+92',
				'currency_name'   => 'Pakistani rupee',
				'currency_symbol' => '₨',
				'currency_code'   => 'PKR'
			],
			[
				'name'            => 'Palau',
				'country_code'    => 'PW',
				'dial_code'       => '+680',
				'currency_name'   => 'Palauan dollar',
				'currency_symbol' => '$',
				'currency_code'   => null
			],
			[
				'name'            => 'Palestinian Territor',
				'country_code'    => 'PS',
				'dial_code'       => '+970',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Panama',
				'country_code'    => 'PA',
				'dial_code'       => '+507',
				'currency_name'   => 'Panamanian balboa',
				'currency_symbol' => 'B/.',
				'currency_code'   => 'PAB'
			],
			[
				'name'            => 'Papua New Guinea',
				'country_code'    => 'PG',
				'dial_code'       => '+675',
				'currency_name'   => 'Papua New Guinean ki',
				'currency_symbol' => 'K',
				'currency_code'   => 'PGK'
			],
			[
				'name'            => 'Peru',
				'country_code'    => 'PE',
				'dial_code'       => '+51',
				'currency_name'   => 'Peruvian nuevo sol',
				'currency_symbol' => 'S/.',
				'currency_code'   => 'PEN'
			],
			[
				'name'            => 'Philippines',
				'country_code'    => 'PH',
				'dial_code'       => '+63',
				'currency_name'   => 'Philippine peso',
				'currency_symbol' => '₱',
				'currency_code'   => 'PHP'
			],
			[
				'name'            => 'Pitcairn',
				'country_code'    => 'PN',
				'dial_code'       => '+872',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Poland',
				'country_code'    => 'PL',
				'dial_code'       => '+48',
				'currency_name'   => 'Polish z?oty',
				'currency_symbol' => 'zł',
				'currency_code'   => 'PLN'
			],
			[
				'name'            => 'Portugal',
				'country_code'    => 'PT',
				'dial_code'       => '+351',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Puerto Rico',
				'country_code'    => 'PR',
				'dial_code'       => '+1939',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Qatar',
				'country_code'    => 'QA',
				'dial_code'       => '+974',
				'currency_name'   => 'Qatari riyal',
				'currency_symbol' => 'ر.ق',
				'currency_code'   => 'QAR'
			],
			[
				'name'            => 'Romania',
				'country_code'    => 'RO',
				'dial_code'       => '+40',
				'currency_name'   => 'Romanian leu',
				'currency_symbol' => 'lei',
				'currency_code'   => 'RON'
			],
			[
				'name'            => 'Russia',
				'country_code'    => 'RU',
				'dial_code'       => '+7',
				'currency_name'   => 'Russian ruble',
				'currency_symbol' => '',
				'currency_code'   => 'RUB'
			],
			[
				'name'            => 'Rwanda',
				'country_code'    => 'RW',
				'dial_code'       => '+250',
				'currency_name'   => 'Rwandan franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'RWF'
			],
			[
				'name'            => 'Reunion',
				'country_code'    => 'RE',
				'dial_code'       => '+262',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Barthelemy',
				'country_code'    => 'BL',
				'dial_code'       => '+590',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Helena, Ascens',
				'country_code'    => 'SH',
				'dial_code'       => '+290',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Kitts and Nevi',
				'country_code'    => 'KN',
				'dial_code'       => '+1869',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Lucia',
				'country_code'    => 'LC',
				'dial_code'       => '+1758',
				'currency_name'   => 'East Caribbean dolla',
				'currency_symbol' => '$',
				'currency_code'   => 'XCD'
			],
			[
				'name'            => 'Saint Martin',
				'country_code'    => 'MF',
				'dial_code'       => '+590',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Pierre and Miq',
				'country_code'    => 'PM',
				'dial_code'       => '+508',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Saint Vincent and th',
				'country_code'    => 'VC',
				'dial_code'       => '+1784',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'San Marino',
				'country_code'    => 'SM',
				'dial_code'       => '+378',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Sao Tome and Princip',
				'country_code'    => 'ST',
				'dial_code'       => '+239',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Saudi Arabia',
				'country_code'    => 'SA',
				'dial_code'       => '+966',
				'currency_name'   => 'Saudi riyal',
				'currency_symbol' => 'ر.س',
				'currency_code'   => 'SAR'
			],
			[
				'name'            => 'Senegal',
				'country_code'    => 'SN',
				'dial_code'       => '+221',
				'currency_name'   => 'West African CFA fra',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Serbia',
				'country_code'    => 'RS',
				'dial_code'       => '+381',
				'currency_name'   => 'Serbian dinar',
				'currency_symbol' => 'дин.',
				'currency_code'   => 'RSD'
			],
			[
				'name'            => 'Seychelles',
				'country_code'    => 'SC',
				'dial_code'       => '+248',
				'currency_name'   => 'Seychellois rupee',
				'currency_symbol' => '₨',
				'currency_code'   => 'SCR'
			],
			[
				'name'            => 'Sierra Leone',
				'country_code'    => 'SL',
				'dial_code'       => '+232',
				'currency_name'   => 'Sierra Leonean leone',
				'currency_symbol' => 'Le',
				'currency_code'   => 'SLL'
			],
			[
				'name'            => 'Singapore',
				'country_code'    => 'SG',
				'dial_code'       => '+65',
				'currency_name'   => 'Brunei dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'BND'
			],
			[
				'name'            => 'Slovakia',
				'country_code'    => 'SK',
				'dial_code'       => '+421',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Slovenia',
				'country_code'    => 'SI',
				'dial_code'       => '+386',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Solomon Islands',
				'country_code'    => 'SB',
				'dial_code'       => '+677',
				'currency_name'   => 'Solomon Islands doll',
				'currency_symbol' => '$',
				'currency_code'   => 'SBD'
			],
			[
				'name'            => 'Somalia',
				'country_code'    => 'SO',
				'dial_code'       => '+252',
				'currency_name'   => 'Somali shilling',
				'currency_symbol' => 'Sh',
				'currency_code'   => 'SOS'
			],
			[
				'name'            => 'South Africa',
				'country_code'    => 'ZA',
				'dial_code'       => '+27',
				'currency_name'   => 'South African rand',
				'currency_symbol' => 'R',
				'currency_code'   => 'ZAR'
			],
			[
				'name'            => 'South Georgia and th',
				'country_code'    => 'GS',
				'dial_code'       => '+500',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Spain',
				'country_code'    => 'ES',
				'dial_code'       => '+34',
				'currency_name'   => 'Euro',
				'currency_symbol' => '€',
				'currency_code'   => 'EUR'
			],
			[
				'name'            => 'Sri Lanka',
				'country_code'    => 'LK',
				'dial_code'       => '+94',
				'currency_name'   => 'Sri Lankan rupee',
				'currency_symbol' => 'රු',
				'currency_code'   => 'LKR'
			],
			[
				'name'            => 'Sudan',
				'country_code'    => 'SD',
				'dial_code'       => '+249',
				'currency_name'   => 'Sudanese pound',
				'currency_symbol' => 'ج.س.',
				'currency_code'   => 'SDG'
			],
			[
				'name'            => 'Suriname',
				'country_code'    => 'SR',
				'dial_code'       => '+597',
				'currency_name'   => 'Surinamese dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'SRD'
			],
			[
				'name'            => 'Svalbard and Jan May',
				'country_code'    => 'SJ',
				'dial_code'       => '+47',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Swaziland',
				'country_code'    => 'SZ',
				'dial_code'       => '+268',
				'currency_name'   => 'Swazi lilangeni',
				'currency_symbol' => 'L',
				'currency_code'   => 'SZL'
			],
			[
				'name'            => 'Sweden',
				'country_code'    => 'SE',
				'dial_code'       => '+46',
				'currency_name'   => 'Swedish krona',
				'currency_symbol' => 'kr',
				'currency_code'   => 'SEK'
			],
			[
				'name'            => 'Switzerland',
				'country_code'    => 'CH',
				'dial_code'       => '+41',
				'currency_name'   => 'Swiss franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'CHF'
			],
			[
				'name'            => 'Syrian Arab Republic',
				'country_code'    => 'SY',
				'dial_code'       => '+963',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Taiwan',
				'country_code'    => 'TW',
				'dial_code'       => '+886',
				'currency_name'   => 'New Taiwan dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'TWD'
			],
			[
				'name'            => 'Tajikistan',
				'country_code'    => 'TJ',
				'dial_code'       => '+992',
				'currency_name'   => 'Tajikistani somoni',
				'currency_symbol' => 'ЅМ',
				'currency_code'   => 'TJS'
			],
			[
				'name'            => 'Tanzania, United Rep',
				'country_code'    => 'TZ',
				'dial_code'       => '+255',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Thailand',
				'country_code'    => 'TH',
				'dial_code'       => '+66',
				'currency_name'   => 'Thai baht',
				'currency_symbol' => '฿',
				'currency_code'   => 'THB'
			],
			[
				'name'            => 'Timor-Leste',
				'country_code'    => 'TL',
				'dial_code'       => '+670',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Togo',
				'country_code'    => 'TG',
				'dial_code'       => '+228',
				'currency_name'   => 'West African CFA fra',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XOF'
			],
			[
				'name'            => 'Tokelau',
				'country_code'    => 'TK',
				'dial_code'       => '+690',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Trinidad and Tobago',
				'country_code'    => 'TT',
				'dial_code'       => '+1868',
				'currency_name'   => 'Trinidad and Tobago ',
				'currency_symbol' => '$',
				'currency_code'   => 'TTD'
			],
			[
				'name'            => 'Tunisia',
				'country_code'    => 'TN',
				'dial_code'       => '+216',
				'currency_name'   => 'Tunisian dinar',
				'currency_symbol' => 'د.ت',
				'currency_code'   => 'TND'
			],
			[
				'name'            => 'Turkey',
				'country_code'    => 'TR',
				'dial_code'       => '+90',
				'currency_name'   => 'Turkish lira',
				'currency_symbol' => '',
				'currency_code'   => 'TRY'
			],
			[
				'name'            => 'Turkmenistan',
				'country_code'    => 'TM',
				'dial_code'       => '+993',
				'currency_name'   => 'Turkmenistan manat',
				'currency_symbol' => 'm',
				'currency_code'   => 'TMT'
			],
			[
				'name'            => 'Turks and Caicos Isl',
				'country_code'    => 'TC',
				'dial_code'       => '+1649',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Tuvalu',
				'country_code'    => 'TV',
				'dial_code'       => '+688',
				'currency_name'   => 'Australian dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'AUD'
			],
			[
				'name'            => 'Uganda',
				'country_code'    => 'UG',
				'dial_code'       => '+256',
				'currency_name'   => 'Ugandan shilling',
				'currency_symbol' => 'Sh',
				'currency_code'   => 'UGX'
			],
			[
				'name'            => 'Ukraine',
				'country_code'    => 'UA',
				'dial_code'       => '+380',
				'currency_name'   => 'Ukrainian hryvnia',
				'currency_symbol' => '₴',
				'currency_code'   => 'UAH'
			],
			[
				'name'            => 'United Arab Emirates',
				'country_code'    => 'AE',
				'dial_code'       => '+971',
				'currency_name'   => 'United Arab Emirates',
				'currency_symbol' => 'د.إ',
				'currency_code'   => 'AED'
			],
			[
				'name'            => 'United Kingdom',
				'country_code'    => 'GB',
				'dial_code'       => '+44',
				'currency_name'   => 'British pound',
				'currency_symbol' => '£',
				'currency_code'   => 'GBP'
			],
			[
				'name'            => 'United States',
				'country_code'    => 'US',
				'dial_code'       => '+1',
				'currency_name'   => 'United States dollar',
				'currency_symbol' => '$',
				'currency_code'   => 'USD'
			],
			[
				'name'            => 'Uruguay',
				'country_code'    => 'UY',
				'dial_code'       => '+598',
				'currency_name'   => 'Uruguayan peso',
				'currency_symbol' => '$',
				'currency_code'   => 'UYU'
			],
			[
				'name'            => 'Uzbekistan',
				'country_code'    => 'UZ',
				'dial_code'       => '+998',
				'currency_name'   => 'Uzbekistani som',
				'currency_symbol' => '',
				'currency_code'   => 'UZS'
			],
			[
				'name'            => 'Vanuatu',
				'country_code'    => 'VU',
				'dial_code'       => '+678',
				'currency_name'   => 'Vanuatu vatu',
				'currency_symbol' => 'Vt',
				'currency_code'   => 'VUV'
			],
			[
				'name'            => 'Venezuela, Bolivaria',
				'country_code'    => 'VE',
				'dial_code'       => '+58',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Virgin Islands, Brit',
				'country_code'    => 'VG',
				'dial_code'       => '+1284',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Virgin Islands, U.S.',
				'country_code'    => 'VI',
				'dial_code'       => '+1340',
				'currency_name'   => '',
				'currency_symbol' => '',
				'currency_code'   => null
			],
			[
				'name'            => 'Wallis and Futuna',
				'country_code'    => 'WF',
				'dial_code'       => '+681',
				'currency_name'   => 'CFP franc',
				'currency_symbol' => 'Fr',
				'currency_code'   => 'XPF'
			],
			[
				'name'            => 'Yemen',
				'country_code'    => 'YE',
				'dial_code'       => '+967',
				'currency_name'   => 'Yemeni rial',
				'currency_symbol' => '﷼',
				'currency_code'   => 'YER'
			],
			[
				'name'            => 'Zambia',
				'country_code'    => 'ZM',
				'dial_code'       => '+260',
				'currency_name'   => 'Zambian kwacha',
				'currency_symbol' => 'ZK',
				'currency_code'   => 'ZMW'
			],
			[
				'name'            => 'Zimbabwe',
				'country_code'    => 'ZW',
				'dial_code'       => '+263',
				'currency_name'   => 'Botswana pula',
				'currency_symbol' => 'P',
				'currency_code'   => 'BWP'
			],
		];

		Countries::insert($countries);
	}
}
