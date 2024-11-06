<?php
namespace App\Classes;
use PDO;
class Objectclass{
var $host;
var $dbname;
var $dbuser;
var $dbpass;
var $baseurl;
var $con;
var $my_key;



var $country_array=array('AF' => 'Afghanistan','AX' => 'Aland Islands','AL' => 'Albania','DZ' => 'Algeria','AS' => 'American Samoa','AD' => 'Andorra','AO' => 'Angola','AI' => 'Anguilla','AQ' => 'Antarctica','AG' => 'Antigua And Barbuda','AR' => 'Argentina','AM' => 'Armenia','AW' => 'Aruba','AU' => 'Australia','AT' => 'Austria','AZ' => 'Azerbaijan','BS' => 'Bahamas','BH' => 'Bahrain','BD' => 'Bangladesh','BB' => 'Barbados','BY' => 'Belarus','BE' => 'Belgium','BZ' => 'Belize','BJ' => 'Benin','BM' => 'Bermuda','BT' => 'Bhutan','BO' => 'Bolivia','BA' => 'Bosnia And Herzegovina','BW' => 'Botswana','BV' => 'Bouvet Island','BR' => 'Brazil','IO' => 'British Indian Ocean Territory','BN' => 'Brunei Darussalam','BG' => 'Bulgaria','BF' => 'Burkina Faso','BI' => 'Burundi','KH' => 'Cambodia','CM' => 'Cameroon','CA' => 'Canada','CV' => 'Cape Verde','KY' => 'Cayman Islands','CF' => 'Central African Republic','TD' => 'Chad','CL' => 'Chile','CN' => 'China','CX' => 'Christmas Island','CC' => 'Cocos (Keeling) Islands','CO' => 'Colombia','KM' => 'Comoros','CG' => 'Congo','CD' => 'Congo, Democratic Republic','CK' => 'Cook Islands','CR' => 'Costa Rica','CI' => 'Cote D\'Ivoire','HR' => 'Croatia','CU' => 'Cuba','CY' => 'Cyprus','CZ' => 'Czech Republic','DK' => 'Denmark','DJ' => 'Djibouti','DM' => 'Dominica','DO' => 'Dominican Republic','EC' => 'Ecuador','EG' => 'Egypt','SV' => 'El Salvador','GQ' => 'Equatorial Guinea','ER' => 'Eritrea','EE' => 'Estonia','ET' => 'Ethiopia','FK' => 'Falkland Islands (Malvinas)','FO' => 'Faroe Islands','FJ' => 'Fiji','FI' => 'Finland','FR' => 'France','GF' => 'French Guiana','PF' => 'French Polynesia','TF' => 'French Southern Territories','GA' => 'Gabon','GM' => 'Gambia','GE' => 'Georgia','DE' => 'Germany','GH' => 'Ghana','GI' => 'Gibraltar','GR' => 'Greece','GL' => 'Greenland','GD' => 'Grenada','GP' => 'Guadeloupe','GU' => 'Guam','GT' => 'Guatemala','GG' => 'Guernsey','GN' => 'Guinea','GW' => 'Guinea-Bissau','GY' => 'Guyana','HT' => 'Haiti','HM' => 'Heard Island & Mcdonald Islands','VA' => 'Holy See (Vatican City State)','HN' => 'Honduras','HK' => 'Hong Kong','HU' => 'Hungary','IS' => 'Iceland','IN' => 'India','ID' => 'Indonesia','IR' => 'Iran, Islamic Republic Of','IQ' => 'Iraq','IE' => 'Ireland','IM' => 'Isle Of Man','IL' => 'Israel','IT' => 'Italy','JM' => 'Jamaica','JP' => 'Japan','JE' => 'Jersey','JO' => 'Jordan','KZ' => 'Kazakhstan','KE' => 'Kenya','KI' => 'Kiribati','KR' => 'Korea','KW' => 'Kuwait','KG' => 'Kyrgyzstan','LA' => 'Lao People\'s Democratic Republic','LV' => 'Latvia','LB' => 'Lebanon','LS' => 'Lesotho','LR' => 'Liberia','LY' => 'Libyan Arab Jamahiriya','LI' => 'Liechtenstein','LT' => 'Lithuania','LU' => 'Luxembourg','MO' => 'Macao','MK' => 'Macedonia','MG' => 'Madagascar','MW' => 'Malawi','MY' => 'Malaysia','MV' => 'Maldives','ML' => 'Mali','MT' => 'Malta','MH' => 'Marshall Islands','MQ' => 'Martinique','MR' => 'Mauritania','MU' => 'Mauritius','YT' => 'Mayotte','MX' => 'Mexico','FM' => 'Micronesia, Federated States Of','MD' => 'Moldova','MC' => 'Monaco','MN' => 'Mongolia','ME' => 'Montenegro','MS' => 'Montserrat','MA' => 'Morocco','MZ' => 'Mozambique','MM' => 'Myanmar','NA' => 'Namibia','NR' => 'Nauru','NP' => 'Nepal','NL' => 'Netherlands','AN' => 'Netherlands Antilles','NC' => 'New Caledonia','NZ' => 'New Zealand','NI' => 'Nicaragua','NE' => 'Niger','NG' => 'Nigeria','NU' => 'Niue','NF' => 'Norfolk Island','MP' => 'Northern Mariana Islands','NO' => 'Norway','OM' => 'Oman','PK' => 'Pakistan','PW' => 'Palau','PS' => 'Palestinian Territory, Occupied','PA' => 'Panama','PG' => 'Papua New Guinea','PY' => 'Paraguay','PE' => 'Peru','PH' => 'Philippines','PN' => 'Pitcairn','PL' => 'Poland','PT' => 'Portugal','PR' => 'Puerto Rico','QA' => 'Qatar','RE' => 'Reunion','RO' => 'Romania','RU' => 'Russian Federation','RW' => 'Rwanda','BL' => 'Saint Barthelemy','SH' => 'Saint Helena','KN' => 'Saint Kitts And Nevis','LC' => 'Saint Lucia','MF' => 'Saint Martin','PM' => 'Saint Pierre And Miquelon','VC' => 'Saint Vincent And Grenadines','WS' => 'Samoa','SM' => 'San Marino','ST' => 'Sao Tome And Principe','SA' => 'Saudi Arabia','SN' => 'Senegal','RS' => 'Serbia','SC' => 'Seychelles','SL' => 'Sierra Leone','SG' => 'Singapore','SK' => 'Slovakia','SI' => 'Slovenia','SB' => 'Solomon Islands','SO' => 'Somalia','ZA' => 'South Africa','GS' => 'South Georgia And Sandwich Isl.','ES' => 'Spain','LK' => 'Sri Lanka','SD' => 'Sudan','SR' => 'Suriname','SJ' => 'Svalbard And Jan Mayen','SZ' => 'Swaziland','SE' => 'Sweden','CH' => 'Switzerland','SY' => 'Syrian Arab Republic','TW' => 'Taiwan','TJ' => 'Tajikistan','TZ' => 'Tanzania','TH' => 'Thailand','TL' => 'Timor-Leste','TG' => 'Togo','TK' => 'Tokelau','TO' => 'Tonga','TT' => 'Trinidad And Tobago','TN' => 'Tunisia','TR' => 'Turkey','TM' => 'Turkmenistan','TC' => 'Turks And Caicos Islands','TV' => 'Tuvalu','UG' => 'Uganda','UA' => 'Ukraine','AE' => 'United Arab Emirates','GB' => 'United Kingdom','US' => 'United States','UM' => 'United States Outlying Islands','UY' => 'Uruguay','UZ' => 'Uzbekistan','VU' => 'Vanuatu','VE' => 'Venezuela','VN' => 'Viet Nam','VG' => 'Virgin Islands, British','VI' => 'Virgin Islands, U.S.','WF' => 'Wallis And Futuna','EH' => 'Western Sahara','YE' => 'Yemen','ZM' => 'Zambia','ZW' => 'Zimbabwe');



var $currency_array=array ('ALL' => 'Albania Lek','AFN' => 'Afghanistan Afghani','ARS' => 'Argentina Peso','AWG' => 'Aruba Guilder','AUD' => 'Australia Dollar','AZN' => 'Azerbaijan New Manat','BSD' => 'Bahamas Dollar','BBD' => 'Barbados Dollar','BDT' => 'Bangladeshi taka','BYR' => 'Belarus Ruble','BZD' => 'Belize Dollar','BMD' => 'Bermuda Dollar','BOB' => 'Bolivia Boliviano','BAM' => 'Bosnia and Herzegovina Convertible Marka','BWP' => 'Botswana Pula','BGN' => 'Bulgaria Lev','BRL' => 'Brazil Real','BND' => 'Brunei Darussalam Dollar','KHR' => 'Cambodia Riel','CAD' => 'Canada Dollar','KYD' => 'Cayman Islands Dollar','CLP' => 'Chile Peso','CNY' => 'China Yuan Renminbi','COP' => 'Colombia Peso','CRC' => 'Costa Rica Colon','HRK' => 'Croatia Kuna','CUP' => 'Cuba Peso','CZK' => 'Czech Republic Koruna','DKK' => 'Denmark Krone','DOP' => 'Dominican Republic Peso','XCD' => 'East Caribbean Dollar','EGP' => 'Egypt Pound','SVC' => 'El Salvador Colon','EEK' => 'Estonia Kroon','EUR' => 'Euro Member Countries','FKP' => 'Falkland Islands (Malvinas) Pound','FJD' => 'Fiji Dollar','GHC' => 'Ghana Cedis','GIP' => 'Gibraltar Pound','GTQ' => 'Guatemala Quetzal','GGP' => 'Guernsey Pound','GYD' => 'Guyana Dollar','HNL' => 'Honduras Lempira','HKD' => 'Hong Kong Dollar','HUF' => 'Hungary Forint','ISK' => 'Iceland Krona','INR' => 'India Rupee','IDR' => 'Indonesia Rupiah','IRR' => 'Iran Rial','IMP' => 'Isle of Man Pound','ILS' => 'Israel Shekel','JMD' => 'Jamaica Dollar','JPY' => 'Japan Yen','JEP' => 'Jersey Pound','KZT' => 'Kazakhstan Tenge','KPW' => 'Korea (North) Won','KRW' => 'Korea (South) Won','KGS' => 'Kyrgyzstan Som','LAK' => 'Laos Kip','LVL' => 'Latvia Lat','LBP' => 'Lebanon Pound','LRD' => 'Liberia Dollar','LTL' => 'Lithuania Litas','MKD' => 'Macedonia Denar','MYR' => 'Malaysia Ringgit','MUR' => 'Mauritius Rupee','MXN' => 'Mexico Peso','MNT' => 'Mongolia Tughrik','MZN' => 'Mozambique Metical','NAD' => 'Namibia Dollar','NPR' => 'Nepal Rupee','ANG' => 'Netherlands Antilles Guilder','NZD' => 'New Zealand Dollar','NIO' => 'Nicaragua Cordoba','NGN' => 'Nigeria Naira','NOK' => 'Norway Krone','OMR' => 'Oman Rial','PKR' => 'Pakistan Rupee','PAB' => 'Panama Balboa','PYG' => 'Paraguay Guarani','PEN' => 'Peru Nuevo Sol','PHP' => 'Philippines Peso','PLN' => 'Poland Zloty','QAR' => 'Qatar Riyal','RON' => 'Romania New Leu','RUB' => 'Russia Ruble','SHP' => 'Saint Helena Pound','SAR' => 'Saudi Arabia Riyal','RSD' => 'Serbia Dinar','SCR' => 'Seychelles Rupee','SGD' => 'Singapore Dollar','SBD' => 'Solomon Islands Dollar','SOS' => 'Somalia Shilling','ZAR' => 'South Africa Rand','LKR' => 'Sri Lanka Rupee','SEK' => 'Sweden Krona','CHF' => 'Switzerland Franc','SRD' => 'Suriname Dollar','SYP' => 'Syria Pound','TWD' => 'Taiwan New Dollar','THB' => 'Thailand Baht','TTD' => 'Trinidad and Tobago Dollar','TRY' => 'Turkey Lira','TRL' => 'Turkey Lira','TVD' => 'Tuvalu Dollar','UAH' => 'Ukraine Hryvna','GBP' => 'United Kingdom Pound','USD' => 'United States Dollar','UYU' => 'Uruguay Peso','UZS' => 'Uzbekistan Som','VEF' => 'Venezuela Bolivar','VND' => 'Viet Nam Dong','YER' => 'Yemen Rial','ZWD' => 'Zimbabwe Dollar');


var $currency_symbol_array=array(	'AED' => '&#1583;.&#1573;','AFN' => '&#65;&#102;','ALL' => '&#76;&#101;&#107;','AMD' => '','ANG' => '&#402;','AOA' => '&#75;&#122;','ARS' => '&#36;','AUD' => '&#36;','AWG' => '&#402;','AZN' => '&#1084;&#1072;&#1085;','BAM' => '&#75;&#77;','BBD' => '&#36;','BDT' => '&#2547;','BGN' => '&#1083;&#1074;','BHD' => '.&#1583;.&#1576;','BIF' => '&#70;&#66;&#117;','BMD' => '&#36;','BND' => '&#36;','BOB' => '&#36;&#98;','BRL' => '&#82;&#36;','BSD' => '&#36;','BTN' => '&#78;&#117;&#46;','BWP' => '&#80;','BYR' => '&#112;&#46;','BZD' => '&#66;&#90;&#36;','CAD' => '&#36;','CDF' => '&#70;&#67;','CHF' => '&#67;&#72;&#70;','CLF' => '','CLP' => '&#36;','CNY' => '&#165;','COP' => '&#36;','CRC' => '&#8353;','CUP' => '&#8396;','CVE' => '&#36;','CZK' => '&#75;&#269;','DJF' => '&#70;&#100;&#106;','DKK' => '&#107;&#114;','DOP' => '&#82;&#68;&#36;','DZD' => '&#1583;&#1580;','EGP' => '&#163;','ETB' => '&#66;&#114;','EUR' => '&#8364;','FJD' => '&#36;','FKP' => '&#163;','GBP' => '&#163;','GEL' => '&#4314;','GHS' => '&#162;','GIP' => '&#163;','GMD' => '&#68;','GNF' => '&#70;&#71;','GTQ' => '&#81;','GYD' => '&#36;','HKD' => '&#36;','HNL' => '&#76;','HRK' => '&#107;&#110;','HTG' => '&#71;','HUF' => '&#70;&#116;','IDR' => '&#82;&#112;','ILS' => '&#8362;','INR' => '&#8377;','IQD' => '&#1593;.&#1583;','IRR' => '&#65020;','ISK' => '&#107;&#114;','JEP' => '&#163;','JMD' => '&#74;&#36;','JOD' => '&#74;&#68;','JPY' => '&#165;','KES' => '&#75;&#83;&#104;','KGS' => '&#1083;&#1074;','KHR' => '&#6107;','KMF' => '&#67;&#70;','KPW' => '&#8361;','KRW' => '&#8361;','KWD' => '&#1583;.&#1603;','KYD' => '&#36;','KZT' => '&#1083;&#1074;','LAK' => '&#8365;','LBP' => '&#163;','LKR' => '&#8360;','LRD' => '&#36;','LSL' => '&#76;','LTL' => '&#76;&#116;','LVL' => '&#76;&#115;','LYD' => '&#1604;.&#1583;','MAD' => '&#1583;.&#1605;.','MDL' => '&#76;','MGA' => '&#65;&#114;','MKD' => '&#1076;&#1077;&#1085;','MMK' => '&#75;','MNT' => '&#8366;','MOP' => '&#77;&#79;&#80;&#36;','MRO' => '&#85;&#77;','MUR' => '&#8360;','MVR' => '.&#1923;','MWK' => '&#77;&#75;','MXN' => '&#36;','MYR' => '&#82;&#77;','MZN' => '&#77;&#84;','NAD' => '&#36;','NGN' => '&#8358;','NIO' => '&#67;&#36;','NOK' => '&#107;&#114;','NPR' => '&#8360;','NZD' => '&#36;','OMR' => '&#65020;','PAB' => '&#66;&#47;&#46;','PEN' => '&#83;&#47;&#46;','PGK' => '&#75;','PHP' => '&#8369;','PKR' => '&#8360;','PLN' => '&#122;&#322;','PYG' => '&#71;&#115;','QAR' => '&#65020;','RON' => '&#108;&#101;&#105;','RSD' => '&#1044;&#1080;&#1085;&#46;','RUB' => '&#1088;&#1091;&#1073;','RWF' => '&#1585;.&#1587;','SAR' => '&#65020;','SBD' => '&#36;','SCR' => '&#8360;','SDG' => '&#163;','SEK' => '&#107;&#114;','SGD' => '&#36;','SHP' => '&#163;','SLL' => '&#76;&#101;','SOS' => '&#83;','SRD' => '&#36;','STD' => '&#68;&#98;','SVC' => '&#36;','SYP' => '&#163;','SZL' => '&#76;','THB' => '&#3647;','TJS' => '&#84;&#74;&#83;','TMT' => '&#109;','TND' => '&#1583;.&#1578;','TOP' => '&#84;&#36;','TRY' => '&#8356;','TTD' => '&#36;','TWD' => '&#78;&#84;&#36;','TZS' => '','UAH' => '&#8372;','UGX' => '&#85;&#83;&#104;','USD' => '&#36;','UYU' => '&#36;&#85;','UZS' => '&#1083;&#1074;','VEF' => '&#66;&#115;','VND' => '&#8363;','VUV' => '&#86;&#84;','WST' => '&#87;&#83;&#36;','XAF' => '&#70;&#67;&#70;&#65;','XCD' => '&#36;','XDR' => '','XOF' => '','XPF' => '&#70;','YER' => '&#65020;','ZAR' => '&#82;','ZMK' => '&#90;&#75;','ZWL' => '&#90;&#36;');



var $time_zone_array=array('(GMT-11:00) Midway Island'=>'Pacific/Midway','(GMT-11:00) Samoa'=>'Pacific/Samoa','(GMT-10:00) Hawaii'=>'Pacific/Honolulu','(GMT-09:00) Alaska'=>'US/Alaska','(GMT-08:00) Pacific Time (US &amp; Canada)'=>'America/Los_Angeles','(GMT-08:00) Tijuana'=>'America/Tijuana','(GMT-07:00) Arizona'=>'US/Arizona','(GMT-07:00) Chihuahua'=>'America/Chihuahua','(GMT-07:00) La Paz'=>'America/Chihuahua','(GMT-07:00) Mazatlan'=>'America/Mazatlan','(GMT-07:00) Mountain Time (US &amp; Canada)'=>'US/Mountain','(GMT-06:00) Central America'=>'America/Managua','(GMT-06:00) Central Time (US &amp; Canada)'=>'US/Central','(GMT-06:00) Guadalajara'=>'America/Mexico_City','(GMT-06:00) Mexico City'=>'America/Mexico_City','(GMT-06:00) Monterrey'=>'America/Monterrey','(GMT-06:00) Saskatchewan'=>'Canada/Saskatchewan','(GMT-05:00) Bogota'=>'America/Bogota','(GMT-05:00) Eastern Time (US &amp; Canada)'=>'US/Eastern','(GMT-05:00) Indiana (East)'=>'US/East-Indiana','(GMT-05:00) Lima'=>'America/Lima','(GMT-05:00) Quito'=>'America/Bogota','(GMT-04:00) Atlantic Time (Canada)'=>'Canada/Atlantic','(GMT-04:30) Caracas'=>'America/Caracas','(GMT-04:00) La Paz'=>'America/La_Paz','(GMT-04:00) Santiago'=>'America/Santiago','(GMT-03:30) Newfoundland'=>'Canada/Newfoundland','(GMT-03:00) Brasilia'=>'America/Sao_Paulo','(GMT-03:00) Buenos Aires'=>'America/Argentina/Buenos_Aires','(GMT-03:00) Georgetown'=>'America/Argentina/Buenos_Aires','(GMT-03:00) Greenland'=>'America/Godthab','(GMT-02:00) Mid-Atlantic'=>'America/Noronha','(GMT-01:00) Azores'=>'Atlantic/Azores','(GMT-01:00) Cape Verde Is.'=>'Atlantic/Cape_Verde','(GMT+00:00) Casablanca'=>'Africa/Casablanca','(GMT+00:00) Edinburgh'=>'Europe/London','(GMT+00:00) Greenwich Mean Time : Dublin'=>'Etc/Greenwich','(GMT+00:00) Lisbon'=>'Europe/Lisbon','(GMT+00:00) London'=>'Europe/London','(GMT+00:00) Monrovia'=>'Africa/Monrovia','(GMT+00:00) UTC'=>'UTC','(GMT+01:00) Amsterdam'=>'Europe/Amsterdam','(GMT+01:00) Belgrade'=>'Europe/Belgrade','(GMT+01:00) Berlin'=>'Europe/Berlin','(GMT+01:00) Bern'=>'Europe/Berlin','(GMT+01:00) Bratislava'=>'Europe/Bratislava','(GMT+01:00) Brussels'=>'Europe/Brussels','(GMT+01:00) Budapest'=>'Europe/Budapest','(GMT+01:00) Copenhagen'=>'Europe/Copenhagen','(GMT+01:00) Ljubljana'=>'Europe/Ljubljana','(GMT+01:00) Madrid'=>'Europe/Madrid','(GMT+01:00) Paris'=>'Europe/Paris','(GMT+01:00) Prague'=>'Europe/Prague','(GMT+01:00) Rome'=>'Europe/Rome','(GMT+01:00) Sarajevo'=>'Europe/Sarajevo','(GMT+01:00) Skopje'=>'Europe/Skopje','(GMT+01:00) Stockholm'=>'Europe/Stockholm','(GMT+01:00) Vienna'=>'Europe/Vienna','(GMT+01:00) Warsaw'=>'Europe/Warsaw','(GMT+01:00) West Central Africa'=>'Africa/Lagos','(GMT+01:00) Zagreb'=>'Europe/Zagreb','(GMT+02:00) Athens'=>'Europe/Athens','(GMT+02:00) Bucharest'=>'Europe/Bucharest','(GMT+02:00) Cairo'=>'Africa/Cairo','(GMT+02:00) Harare'=>'Africa/Harare','(GMT+02:00) Helsinki'=>'Europe/Helsinki','(GMT+02:00) Istanbul'=>'Europe/Istanbul','(GMT+02:00) Jerusalem'=>'Asia/Jerusalem','(GMT+02:00) Kyiv'=>'Europe/Helsinki','(GMT+02:00) Pretoria'=>'Africa/Johannesburg','(GMT+02:00) Riga'=>'Europe/Riga','(GMT+02:00) Sofia'=>'Europe/Sofia','(GMT+02:00) Tallinn'=>'Europe/Tallinn','(GMT+02:00) Vilnius'=>'Europe/Vilnius','(GMT+03:00) Baghdad'=>'Asia/Baghdad','(GMT+03:00) Kuwait'=>'Asia/Kuwait','(GMT+03:00) Minsk'=>'Europe/Minsk','(GMT+03:00) Nairobi'=>'Africa/Nairobi','(GMT+03:00) Riyadh'=>'Asia/Riyadh','(GMT+03:00) Volgograd'=>'Europe/Volgograd','(GMT+03:30) Tehran'=>'Asia/Tehran','(GMT+04:00) Abu Dhabi'=>'Asia/Muscat','(GMT+04:00) Baku'=>'Asia/Baku','(GMT+04:00) Moscow'=>'Europe/Moscow','(GMT+04:00) Muscat'=>'Asia/Muscat','(GMT+04:00) St. Petersburg'=>'Europe/Moscow','(GMT+04:00) Tbilisi'=>'Asia/Tbilisi','(GMT+04:00) Yerevan'=>'Asia/Yerevan','(GMT+04:30) Kabul'=>'Asia/Kabul','(GMT+05:00) Islamabad'=>'Asia/Karachi','(GMT+05:00) Karachi'=>'Asia/Karachi','(GMT+05:00) Tashkent'=>'Asia/Tashkent','(GMT+05:30) Chennai'=>'Asia/Calcutta','(GMT+05:30) Kolkata'=>'Asia/Kolkata','(GMT+05:30) Mumbai'=>'Asia/Calcutta','(GMT+05:30) New Delhi'=>'Asia/Calcutta','(GMT+05:30) Sri Jayawardenepura'=>'Asia/Calcutta','(GMT+05:45) Kathmandu'=>'Asia/Katmandu','(GMT+06:00) Almaty'=>'Asia/Almaty','(GMT+06:00) Astana'=>'Asia/Dhaka','(GMT+06:00) Dhaka'=>'Asia/Dhaka','(GMT+06:00) Ekaterinburg'=>'Asia/Yekaterinburg','(GMT+06:30) Rangoon'=>'Asia/Rangoon','(GMT+07:00) Bangkok'=>'Asia/Bangkok','(GMT+07:00) Hanoi'=>'Asia/Bangkok','(GMT+07:00) Jakarta'=>'Asia/Jakarta','(GMT+07:00) Novosibirsk'=>'Asia/Novosibirsk','(GMT+08:00) Beijing'=>'Asia/Hong_Kong','(GMT+08:00) Chongqing'=>'Asia/Chongqing','(GMT+08:00) Hong Kong'=>'Asia/Hong_Kong','(GMT+08:00) Krasnoyarsk'=>'Asia/Krasnoyarsk','(GMT+08:00) Kuala Lumpur'=>'Asia/Kuala_Lumpur','(GMT+08:00) Perth'=>'Australia/Perth','(GMT+08:00) Singapore'=>'Asia/Singapore','(GMT+08:00) Taipei'=>'Asia/Taipei','(GMT+08:00) Ulaan Bataar'=>'Asia/Ulan_Bator','(GMT+08:00) Urumqi'=>'Asia/Urumqi','(GMT+09:00) Irkutsk'=>'Asia/Irkutsk','(GMT+09:00) Osaka'=>'Asia/Tokyo','(GMT+09:00) Sapporo'=>'Asia/Tokyo','(GMT+09:00) Seoul'=>'Asia/Seoul','(GMT+09:00) Tokyo'=>'Asia/Tokyo','(GMT+09:30) Adelaide'=>'Australia/Adelaide','(GMT+09:30) Darwin'=>'Australia/Darwin','(GMT+10:00) Brisbane'=>'Australia/Brisbane','(GMT+10:00) Canberra'=>'Australia/Canberra','(GMT+10:00) Guam'=>'Pacific/Guam','(GMT+10:00) Hobart'=>'Australia/Hobart','(GMT+10:00) Melbourne'=>'Australia/Melbourne','(GMT+10:00) Port Moresby'=>'Pacific/Port_Moresby','(GMT+10:00) Sydney'=>'Australia/Sydney','(GMT+10:00) Yakutsk'=>'Asia/Yakutsk','(GMT+11:00) Vladivostok'=>'Asia/Vladivostok','(GMT+12:00) Auckland'=>'Pacific/Auckland','(GMT+12:00) Fiji'=>'Pacific/Fiji','(GMT+12:00) International Date Line West'=>'Pacific/Kwajalein','(GMT+12:00) Kamchatka'=>'Asia/Kamchatka','(GMT+12:00) Magadan'=>'Asia/Magadan','(GMT+12:00) Marshall Is.'=>'Pacific/Fiji','(GMT+12:00) New Caledonia'=>'Asia/Magadan','(GMT+12:00) Solomon Is.'=>'Asia/Magadan','(GMT+12:00) Wellington'=>'Pacific/Auckland','(GMT+13:00) Nuku\'alofa'=>'Pacific/Tongatapu');

var $user_type_array=array('0'=>'General','1'=>'Vendor','2'=>'Moderator','3'=>'Admin');
var $sex_array=array('Male','Female','Others');

var $withdraw_status_array=array('0'=>'Pending','1'=>'Processing','2'=>'Complete','3'=>'Cancel','4'=>'Block');
var $order_status_array=array('0'=>'Pending','1'=>'Confirmed','2'=>'Processing','3'=>'Complete','4'=>'Cancel');
var $payment_method_array=array('0'=>'Cash on delivery','1'=>'Online');
var $payment_status_array=array('0'=>'Pending','1'=>'Processing','2'=>'Paid');
var $shipping_method_array=array('0'=>'Normal','1'=>'Express');
var $vendor_status_array=array('0'=>'Unconfirm','1'=>'Confirm','2'=>'Block','3'=>'Canceled','4'=>'Interested','5'=>'Not interested','6'=>'Try later','7'=>'Reported');




function dataset($host,$dbname,$dbusername,$dbpassword,$baseurl,$key)
{
$this->host=$host;
$this->dbname=$dbname;
$this->dbuser=$dbusername;
$this->dbpass=$dbpassword;
$this->baseurl=$baseurl;
$this->my_key=$key;
}


function db_connect()
{
$this->con=new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->dbuser,$this->dbpass);
}


function db_close()
{
$this->con=null;
}


function redirect($url)
{
header("location:$url");
}


function data_delete($table,$where)
{
	$stmt =$this->con->prepare("DELETE FROM $table WHERE $where");
	if ($stmt->execute()==1)
	{return 1;}
	else
	{return 0;}
	
	}


function data_update($table,$value_array,$where)
{
	$set_column="";
	for($i=0;$i<count($value_array);$i++)
	{
		$key=key($value_array);
		$key_value=$this->string_data_input($value_array[$key]);
		next($value_array);
		
		if($set_column==""){$set_column="$key='$key_value'";}else{$set_column.=",$key='$key_value'";}
		
		}
		
		
    $query="UPDATE $table SET $set_column WHERE $where";
	$stmt =$this->con->prepare($query);
	if ($stmt->execute()==1)
	{return 1;}
	else
	{return 0;}
	}


function data_put($table,$value_array)
{
	$column="";
	$value="";
	for($i=0;$i<count($value_array);$i++)
	{
		$key=key($value_array);
		$key_value=$this->string_data_input($value_array[$key]);
		next($value_array);
		
		if($column==""){$column="$key";}else{$column.=",$key";}
		if($value==""){$value="'$key_value'";}else{$value.=",'$key_value'";}
		}
	
	$stmt =$this->con->prepare("INSERT INTO $table($column) VALUES($value)");
	if ($stmt->execute()==1)
		{return 1;}
	else
	{return 0;}
	
	}


function data_get($column,$table,$where,$sort_by,$sort,$limit,$start)
{
	$a='';$b='';$c='';$d='';$e='';$f='';
	$query='';
	
	if ($column!='')
	{$a="$column";}
	else
	{$a="*";}
	if ($where!='')
	{$b="WHERE $where";}
	if ($sort_by!='')
	{$c="ORDER BY $sort_by";}
	if ($sort_by!='' and $sort!='')
	{$d="$sort";}
	else
	{
		if ($sort_by!='' and $sort=='')
		{$d="ASC";}
	}
	if ($limit!='')
	{$f="$limit";}
	if ($limit!='' and $start!='')
	{$e="LIMIT $start,";}
	else
	{
		if ($limit!='' and $start=='')
		{$e="LIMIT 0,";}
	}
		
	if ($table!='')
	{

		$stmt =$this->con->prepare("SELECT $a FROM $table $b $c $d $e $f");
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
		}
	
	}



function data_get_num($column,$table,$where)
{
	if ($column!='')
	{$column=$column;}
	else
	{$column="*";}
	
	if($where=='')
	{$wherer='';}
	else
	{$wherer=" WHERE $where";}
	
		$stmt =$this->con->prepare("SELECT $column FROM $table$wherer");
		$stmt->execute();
		$res=$stmt->fetchAll();
		return count($res);
	}




function get_node($string,$tag,$identity)
{
	$count_0=0;
	$output=array();
	$output_tmp='';
	$tag_start=''.$tag;
	$tag_end=''.$tag.'';
	
	$replace_array=array('< ',' >','< /','</ ');
	$replace_by_array=array('<','>','</','</');
	$string=str_replace($replace_array,$replace_by_array,$string);
	$replace_array=array('<','>');
	$replace_by_array=array('**split**<','>**split**');
	$string=str_replace($replace_array,$replace_by_array,$string);
	$string=str_replace('/$\R?^/m',' ',$string);
	//$expole=preg_split ('/$\R?^/m', $string);
	
	$expole=explode('**split**',$string);
	
	for($i=0;$i<count($expole);$i++)
	{
		$value=$expole[$i];
		
		
		if($count_0>0)
		{
			if(strpos($value,$tag_start)==1)
			{$count_0=$count_0+1;}
		}
		
		if($count_0==0){
		if(strpos($value,$tag_start)==1)
		{
			if(strpos($value,$identity)>0)
			{$count_0=$count_0+1;}
			}
		}
			
		
			
			if($count_0!=0)
			{
				$output_tmp.=$value;
				if(strpos($value,$tag_end)==2)
				{$count_0=$count_0-1;}
					
					if($count_0==0 and $output_tmp!='')
					{
						$output[]=$output_tmp;
						$output_tmp='';
						}
			}
		
		
		}
	
	return $output;
	}
	
	
	
function get_inner_element($string,$tag,$identity)
{
	$tag=$tag;
	$count_0=0;
	$output=array();
	
	$replace_array=array('< ',' >','< /','</ ','>','<');
	$replace_by_array=array('<','>','</','</','>*split*','*split*<');
	$string=str_replace($replace_array,$replace_by_array,$string);
	$expole=explode('*split*',$string);
	
	for($i=0;$i<count($expole);$i++)
	{
		$value=$expole[$i];
		
		
		if($count_0>0)
		{
			if(strpos($value,$tag)==2)
			{$count_0=$count_0-1;}
			}
		
		
		if($count_0>0)
		{$output[]=$value;}
		
		if(strpos($value,$tag)==1)
		{
			if(strpos($value,$identity)>0)
			{$count_0=1;}
			}

		}
	
	return $output;
	}
	
	

function get_element_attribute($string,$attribute)
{
	$count_0=0;
	$output_tmp='';
	$output=array();
	$replace_array=array('< ',' >','< /','</ ','"',' ',$attribute.' =','= "','=*split*"');
	$replace_by_array=array('<','>','</','</','*split*"*split*','*split*',$attribute.'=','="','="');
	$string=str_replace($replace_array,$replace_by_array,$string);
	$expole=explode('*split*',$string);
	
	for($i=0;$i<count($expole);$i++)
	{
		$value=trim($expole[$i]);
		
		if($count_0==0){
		if($value==$attribute.'="')
		{$count_0=$count_0+1;}
		}
		if($count_0>0)
		{
			if($output_tmp=='')
			{$output_tmp.=$value;}
			else
			{$output_tmp.=' '.$value;}
			
			}
		
		if($count_0!=0){
		if($value=='"')
		{
			$count_0=$count_0-1;
			
			if($count_0==0 and $output_tmp!='')
			{
				$rep_arr=array($attribute.'="','"');
				$rep_by_array=array('','');
				
				$output[]=str_replace($rep_arr,$rep_by_array,$output_tmp);
				$output_tmp='';
				}
		}
		}
	
		
		}
	
	return $output;
	}

  
 
 function web_request($url)
 {
	 $ch = curl_init();
	 curl_setopt($ch,CURLOPT_URL,$url);
	 curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	 curl_setopt($ch,CURLOPT_POST, 0);                //0 for a get request
	 //curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
	 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	 curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
	 curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	 $response = curl_exec($ch);
	 curl_close ($ch);
	 return $response;
  }
	


function zip_unzip($zip_path,$unzip_to)
{
		$unzip = new ZipArchive;
		$out = $unzip->open($zip_path);
		if ($out === TRUE)
		{
		  $unzip->extractTo($unzip_to);
		  $unzip->close();
		  return 1;
		}
		else
		{
		 return 0;
		}
	
	}
	
	


function delete_all($path)
{
	$del_path=glob($path.'/*');
	foreach($del_path as $del_file)
	{
		if(is_dir($del_file))
		{
			$this->delete_all($del_file);
			
			}
			else
			{
		if(is_file($del_file))
		{
			unlink($del_file);
			}
				}
		}
	rmdir($path);
	
	}
	
	
	

function string_data_input($string)
{
	$rep=array("'",'"');
	$repby=array("\'",'\"');
	$string=str_ireplace($rep,$repby,trim($string));
	return $string;
	}	
	
	
function string_data_edit($string)
{
	$rep=array("<",'>','\\');
	$repby=array("&lt;",'&gt;','');
	$string=str_replace($rep,$repby,trim($string));
	return $string;
	}	

function short_text($text,$limit)
{
	$limit2=$limit;
	$string=strip_tags($text);


	$expol=explode(' ',$string);
	if(count($expol)<$limit)
	{$limit2=count($expol);}
	$tex='';
	for($i=0;$i<$limit2;$i++)
	{
	$tex.=$expol[$i].' ';
	}
	return stripslashes($tex);
}




function long_text($text)
{
	$string=stripslashes(nl2br(str_replace(' ','&nbsp;',$text)));
	return $string;
}


function text_replace($text,$replace,$replaceby)
{
	$replace_data=array($replace);
	$replaceby_data=array($replaceby);
	$string=stripslashes($text);
	$print=str_replace($replace_data,$replaceby_data,$string);
	return stripslashes($print);
}



function admin_login($mail,$password)
{
	$output='';
	if($mail=='' or $password=='')
	{$output='Your Mail or Password is empty';}
	else
	{
		$password=md5(trim($password));
		$table='tbluser';
		$where="nib_mail='$mail' and nib_password='$password' and (nib_user_type=3 or nib_user_type=2)";
		$check_1=$this->data_get_num('*',$table,$where);
		
		if($check_1==1)
		{
			
			$_SESSION['admin']=$mail;
			
			setcookie('admin',$mail, time() + 86400, "/");
			
			$output=1;
			}
		else
		{$output='Your Mail or Password is wrong';}
		
		}
	return $output;
	}



function user_login($mail,$password,$login_key,$device_id)
{
	$output='';
	if($mail=='' or $password=='')
	{$output=5; /*Mail or password is empty*/}
	else
	{
		$password=md5(trim($password));
		$table='tbluser';
		$where="nib_phone_1='$mail' and nib_password='$password' and (nib_user_type=0 or nib_user_type=1)";
		$where_1="nib_phone_1='$mail' and nib_password='$password' and nib_account_confirm=0 and (nib_user_type=0 or nib_user_type=1)";
		$where_2="nib_phone_1='$mail' and nib_password='$password' and nib_account_confirm=2 and (nib_user_type=0 or nib_user_type=1)";
		$where_3="nib_phone_1='$mail' and nib_password='$password' and nib_account_confirm=1 and (nib_user_type=0 or nib_user_type=1)";
		
		$check_1=$this->data_get_num('*',$table,$where);
		$check_2=$this->data_get_num('*',$table,$where_1);
		$check_3=$this->data_get_num('*',$table,$where_2);
		$check_4=$this->data_get_num('*',$table,$where_3);
		
		if($check_1==1)
		{
			if($check_2==1)
			{$output=2; /*Account Unconfirmed*/}
			else if($check_3==1)
			{$output=3; /*Account is blocked*/ }
			else if($check_4==1)
			{
				
				$_SESSION['user']=$mail;
				setcookie('user',$mail, time() + 86400, "/");
				$output=1; /*Login Success*/

				$login_ip=$_SERVER['REMOTE_ADDR'];
				$date=date('Y-m-d');
				$time=date('h:i:s a');

				$table='tbluser';
				$where="nib_phone_1='$mail' and nib_password='$password'";
				$values=array(
					'nib_device_id'=>$device_id,
					'nib_login_key'=>$login_key,
					'nib_login_ip'=>$login_ip,
					'nib_login_date'=>$date,
					'nib_login_time'=>$time,
					'nib_login_device_info'=>''
				);

				$this->data_update($table,$values,$where);

				}
		
			
			}
		else
		{$output=4; /*Username or password is wrong*/}
		
		}
	return $output;
	
	}



function admin_login_check()
{
	if(isset($_SESSION['admin']) and isset($_COOKIE['admin']) and $_SESSION['admin']!='' and $_COOKIE['admin']!='' and $_SESSION['admin']==$_COOKIE['admin'])
	{return 1;}
	else
	{return 0;}
	
	}



function user_login_check($user_login,$login_key,$device_id)
{

	if($user_login!='' and $login_key!='' and $device_id!=''){
	$table='tbluser';
	$where="nib_phone_1='$user_login' and nib_login_key='$login_key' and nib_device_id='$device_id'";
	$check=$this->data_get_num('*',$table,$where);
	
	if($check==1)
	{
		$_SESSION['user']=$user_login;
		return 1;
	}
	else
	{return 0;}
	}
	else{return 0;}
	
	}



function admin_logout()
{
	$_SESSION['admin']='';
	unset($_SESSION['admin']);
	setcookie('admin','', time() - 86400, "/");
	
	}
	
	

function user_logout($user_login,$login_key,$device_id)
{
	if($user_login!='' and $login_key!='' and $device_id!=''){
	$table='tbluser';
	$where="nib_phone_1='$user_login' and nib_login_key='$login_key' and nib_device_id='$device_id'";
	$values=array('nib_login_key'=>'');
	if($this->data_update($table,$values,$where)==1)
	{return 1;}
	else
	{return 0;}

	$_SESSION['user']='';
	unset($_SESSION['user']);
	setcookie('user','', time() - 86400, "/");
	}
	
	}
	
	
	
	
function change_password_admin($old_password,$new_password,$confirm_password)
{
	$status=0;
	$message='';
	$user=$_SESSION['admin'];
	
	if($old_password=='')
	{$message='Your old password is empty';}
	else if($new_password=='')
	{$message='Your new password is empty';}
	else if($confirm_password=='')
	{$message='Your confirm password is empty';}
	else if($new_password!=$confirm_password)
	{$message='Your new password and confirm password are not matching';}
	else if(strlen($new_password)<6 or strlen($new_password)>20)
	{$message='Your password will be within 6 to 20 digits';}
	else
	{
		$old_password=md5($old_password);
		$column="*";
		$table="tbluser";
		$where="nib_mail='$user' and nib_password='$old_password'";
		$check_password=$this->data_get_num($column,$table,$where);
		
		if($check_password==1)
		{
			$new_password=md5($new_password);
			$values=array("nib_password"=>$new_password);
			
			if($this->data_update($table,$values,$where)==1)
			{$status=1;$message='Changed successfully';}
			else{$message='Error try again';}
			
			}
		else
		{$message='Your old password is wrong';}
		
		}
	
	return array($status,$message);
	}
	
	
	
function change_password_user($old_password,$new_password,$confirm_password)
{
	$status=0;
	$message='';
	$user=$_SESSION['user'];
	
	if($old_password=='')
	{$message='Your old password is empty';}
	else if($new_password=='')
	{$message='Your new password is empty';}
	else if($confirm_password=='')
	{$message='Your confirm password is empty';}
	else if($new_password!=$confirm_password)
	{$message='Your new password and confirm password are not matching';}
	else if(strlen($new_password)<6 or strlen($new_password)>20)
	{$message='Your password will be within 6 to 20 digits';}
	else
	{
		$old_password=md5($old_password);
		$column="*";
		$table="tbluser";
		$where="nib_phone_1='$user' and nib_password='$old_password'";
		$check_password=$this->data_get_num($column,$table,$where);
		
		if($check_password==1)
		{
			$new_password=md5($new_password);
			$values=array("nib_password"=>$new_password);
			
			if($this->data_update($table,$values,$where)==1)
			{$status=1;$message='Changed successfully';}
			else{$message='Error try again';}
			
			}
		else
		{$message='Your old password is wrong';}
		
		}
	
	return array($status,$message);
	}
	
	
function change_password_by_admin($uid,$new_password,$confirm_password)
{
	$status=0;
	$message='';
	
	if($new_password=='')
	{$message='Your new password is empty';}
	else if($confirm_password=='')
	{$message='Your confirm password is empty';}
	else if($new_password!=$confirm_password)
	{$message='Your new password and confirm password are not matching';}
	else if(strlen($new_password)<6 or strlen($new_password)>20)
	{$message='Your password will be within 6 to 20 digits';}
	else
	{
		$table="tbluser";
		$where="UserUUID='$uid'";
		$new_password=md5($new_password);
		$values=array("nib_password"=>$new_password);
			
		if($this->data_update($table,$values,$where)==1)
		{$status=1;$message='Changed successfully';}
		else{$message='Error try again';}
			

		}
	
	return array($status,$message);
	}
	
	
function all_category($uid,$edit_url,$delete_url)
{
	$output='';
	$column="*";
	$table="tblcategory";
	$where="CategoryUUID='$uid'";
	$sort_by="";
	$sort="";
	$limit="";
	$start="";
	$result_category=$this->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
	
	if(count($result_category)>0)
	{
		$category_name=$result_category[0]['nib_name'];
		$category_uid=$result_category[0]['CategoryUUID'];
		$where_sub="nib_parent_uid='$uid'";
		$result_category_sub=$this->data_get($column,$table,$where_sub,$sort_by,$sort,$limit,$start);
		
		
		if(count($result_category_sub)>0)
		{
			$output.='<li><span class="caretr">'.$category_name.' -- <a href="'.$edit_url.'&uid='.$category_uid.'">Edit</a> <a href="'.$delete_url.'&uid='.$category_uid.'" onclick="var result=confirm(\'Want to Delete?\');if(result==true){return true;}else{return false;}">Delete</a></span><ul class="nested">';
		for($i=0;$i<count($result_category_sub);$i++)
		{
			$uid_sub=$result_category_sub[$i]['CategoryUUID'];
			$output.=$this->all_category($uid_sub,$edit_url,$delete_url);
			}
			
			$output.='</ul></li>';
		}
		else
		{$output.='<li>'.$category_name.' -- <a href="'.$edit_url.'&uid='.$category_uid.'">Edit</a> <a href="'.$delete_url.'&uid='.$category_uid.'" onclick="var result=confirm(\'Want to Delete?\');if(result==true){return true;}else{return false;}">Delete</a></li>';}
		
		}
	
	return $output;
	}
	
	
	


function all_category_for_sub($uid)
{
	$output='';
	$column="*";
	$table="tblcategory";
	$where="CategoryUUID='$uid'";
	$sort_by="";
	$sort="";
	$limit="";
	$start="";
	$result_category=$this->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
	
	if(count($result_category)>0)
	{
		$category_name=$result_category[0]['nib_name'];
		$category_uid=$result_category[0]['CategoryUUID'];
		$where_sub="nib_parent_uid='$uid'";
		$result_category_sub=$this->data_get($column,$table,$where_sub,$sort_by,$sort,$limit,$start);
		
		
		if(count($result_category_sub)>0)
		{
			$output.='<li><span class="caretr" onclick="_sub_menu_uid(\''.$category_uid.'\',\''.$category_name.'\')">'.$category_name.'</span><ul class="nested">';
		for($i=0;$i<count($result_category_sub);$i++)
		{
			$uid_sub=$result_category_sub[$i]['CategoryUUID'];
			$output.=$this->all_category_for_sub($uid_sub);
			}
			
			$output.='</ul></li>';
		}
		else
		{$output.='<li onclick="_sub_menu_uid(\''.$category_uid.'\',\''.$category_name.'\')">'.$category_name.'</li>';}
		
		}
	
	return $output;
	}
	
	
	
	
	
function all_category_for_service($uid)
{
	$output='';
	$column="*";
	$table="tblcategory";
	$where="CategoryUUID='$uid'";
	$sort_by="";
	$sort="";
	$limit="";
	$start="";
	$result_category=$this->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
	
	if(count($result_category)>0)
	{
		$category_name=$result_category[0]['nib_name'];
		$category_uid=$result_category[0]['CategoryUUID'];
		$where_sub="nib_parent_uid='$uid'";
		$result_category_sub=$this->data_get($column,$table,$where_sub,$sort_by,$sort,$limit,$start);
		
		
		if(count($result_category_sub)>0)
		{
			$output.='<li><span class="caretr" style="color:#CCC;">'.$category_name.'</span><ul class="nested">';
		for($i=0;$i<count($result_category_sub);$i++)
		{
			$uid_sub=$result_category_sub[$i]['CategoryUUID'];
			$output.=$this->all_category_for_sub($uid_sub);
			}
			
			$output.='</ul></li>';
		}
		else
		{$output.='<li onclick="_sub_menu_uid(\''.$category_uid.'\',\''.$category_name.'\')" style="color:#333 !important;">'.$category_name.'</li>';}
		
		}
	
	return $output;
	}
	
	
function add_category($uid,$title,$description,$image_input_file_name,$category_type,$parent_uid,$category_for)
{
	$output='';
	$status=0;
	$image='';
	$image_file_dir='upload/category/';
	
	if($uid=='')
	{$output='You uid is empty';}
	else
	{
		$table="tblcategory";
		$uid_check=$this->data_get_num('*',$table,"CategoryUUID='$uid'");
		if($uid_check==0)
		{
		if($title=='')
		{$output='You category name is empty';}
		else
		{
			$table="tblcategory";
			$title_check=$this->data_get_num('*',$table,"nib_name='$title'");
			if($title_check==1)
			{$output='The category name already exists';}
			else
			{
					
				if($_FILES[$image_input_file_name]['name']!='')
				{
					$image_type=$_FILES[$image_input_file_name]['type'];
					$image=time().'.'.pathinfo($_FILES[$image_input_file_name]['name'], PATHINFO_EXTENSION);
					
					if($image_type=='image/jpg' or $image_type=='image/jpeg' or $image_type=='image/png' or $image_type=='image/gif')
					{
						move_uploaded_file($_FILES[$image_input_file_name]['tmp_name'],$image_file_dir.$image);
						
						}
					
					}
				
				
				$date=date('Y-m-d');
				$time=date('h:i:s a');
				$values=array(
				'CategoryUUID'=>$uid,
				'nib_name'=>$title,
				'nib_description'=>$description,
				'nib_image'=>$image,
				'nib_type'=>$category_type,
				'nib_parent_uid'=>$parent_uid,
				'nib_category_for'=>$category_for,
				'nib_date'=>$date,
				'nib_time'=>$time,
				'DateInserted'=>$date.' '.$time
				);
				
				$insert_result=$this->data_put($table,$values);
				
				if($insert_result==1)
				{$status=1;$output='Category Added successfully';}
				else
				{
					 if($_FILES[$image_input_file_name]['name']!='' and file_exists($image_file_dir.$image)==1)
					 {unlink($image_file_dir.$image);}
					 
					$output='Error Try again';
					}
				
				}
		}
		}
	}
	
	return array($status,$output);
	
	}





function delete_category($uid)
{
	$output='';
	$column="*";
	$table="tblcategory";
	$where="CategoryUUID='$uid'";
	$sort_by="";
	$sort="";
	$limit="";
	$start="";
	$result=$this->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
	
	if(count($result)>0)
	{
		$image='upload/category/'.$result[0]['nib_image'];
		
		$where_sub="nib_parent_uid='$uid'";
		$result_sub=$this->data_get($column,$table,$where_sub,$sort_by,$sort,$limit,$start);
		
		for($i=0;$i<count($result_sub);$i++)
		{
			$sub_uid=$result_sub[0]['CategoryUUID'];
			
			$this->delete_category($sub_uid);
			
			}
		
		
		if($this->data_delete($table,$where)==1)
		{
			if(file_exists($image)==1 and $result[0]['nib_image']!='')
			{
				unlink($image);
				}
			$output=1;
			}
		else
		{$output=0;}
		
		
		}
	
	
	return $output;
	}



function edit_category($uid,$title,$description,$image_input_file_name,$category_type,$parent_uid)
{
	$output='';
	$status=0;
	$image='';
	$image_file_dir='upload/category/';
	
	$column="*";
	$table="tblcategory";
	$where="CategoryUUID='$uid'";
	$sort_by="";
	$sort="";
	$limit="";
	$start="";
	$category_image=$this->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
	$image=$category_image[0]['nib_image'];
	
	if($uid=='')
	{$output='You uid is empty';}
	else
	{
		
		$uid_check=$this->data_get_num('*',$table,"CategoryUUID='$uid'");
		if($uid_check==1)
		{
		if($title=='')
		{$output='You category name is empty';}
		else
		{
			
			$title_check=$this->data_get_num('*',$table,"nib_name='$title' and CategoryUUID!='$uid'");
			if($title_check==1)
			{$output='The category name already exists';}
			else
			{
				
					
				if($_FILES[$image_input_file_name]['name']!='')
				{
					$image_type=$_FILES[$image_input_file_name]['type'];
					$image=time().'.'.pathinfo($_FILES[$image_input_file_name]['name'], PATHINFO_EXTENSION);
					
					if($image_type=='image/jpg' or $image_type=='image/jpeg' or $image_type=='image/png' or $image_type=='image/gif')
					{
						if(move_uploaded_file($_FILES[$image_input_file_name]['tmp_name'],$image_file_dir.$image)==1)
						{
							if(file_exists($image_file_dir.$category_image[0]['nib_image'])==1 and $category_image[0]['nib_image']!='')
					 		{unlink($image_file_dir.$category_image[0]['nib_image']);}
							}
						
						
						
						}
					
					}
				
				
				$values=array(
				'nib_name'=>$title,
				'nib_description'=>$description,
				'nib_image'=>$image,
				'nib_type'=>$category_type,
				'nib_parent_uid'=>$parent_uid
				);
				$where="CategoryUUID='$uid'";
				$update_result=$this->data_update($table,$values,$where);
				
				if($update_result==1)
				{$status=1;$output='Update successfully';}
				else
				{
					 if($_FILES[$image_input_file_name]['name']!='' and file_exists($image_file_dir.$image)==1)
					 {unlink($image_file_dir.$image);}
					 
					$output='Error Try again';
					}
				
				}
		}
		}
	}
	
	return array($status,$output);
	
	}



function get_all_sub_category_id($uid)
{
	$output.=$uid;
	$column="*";
	$table="tblcategory";
	$where="CategoryUUID='$uid'";
	$sort_by="";
	$sort="";
	$limit="";
	$start="";
	$result_category=$this->data_get($column,$table,$where,$sort_by,$sort,$limit,$start);
	
	if(count($result_category)>0)
	{
		$category_name=$result_category[0]['nib_name'];
		$category_uid=$result_category[0]['CategoryUUID'];
		$where_sub="nib_parent_uid='$category_uid'";
		$result_category_sub=$this->data_get($column,$table,$where_sub,$sort_by,$sort,$limit,$start);
		
	

		if(count($result_category_sub)>0)
		{
		for($i=0;$i<count($result_category_sub);$i++)
		{
			$uid_sub=$result_category_sub[$i]['CategoryUUID'];
			

			$where_sub_sub="nib_parent_uid='$uid_sub'";
			$result_category_sub_sub=$this->data_get($column,$table,$where_sub_sub,$sort_by,$sort,$limit,$start);
			if(count($result_category_sub_sub)>0){$output.=','.$this->get_all_sub_category_id($uid_sub);}
			else{$output.=','.$uid_sub;}

			
			}
			
		
		}
		
		
		
		}
	
	return $output;
	}




function add_admin($uid,$first_name,$last_name,$mail,$password,$confirm_password,$type)
{
	$status=0;
	$message='';
	if($uid!=''){
		
		$column="*";
		$table="tbluser";
		$where="UserUUID='$uid'";
		$uid_check=$this->data_get_num($column,$table,$where);
	if($uid_check==0)
	{
	if($mail==''){$message='Your mail is empty';}
	else if(filter_var($mail, FILTER_VALIDATE_EMAIL)!=$mail){$message='Please use a valid mail address';}
	else if($first_name==''){$message='Your First name is empty';}
	else if($last_name==''){$message='Your Last name is empty';}
	else if($password==''){$message='Your Password is empty';}
	else if($confirm_password==''){$message='Your Confirm password is empty';}
	else if($type==''){$message='Please select a Type';}
	else if($password!=$confirm_password){$message='Your Password and Confirm password are not matching';}
	else if(strlen($password)<6 or strlen($password)>20){$message='Your password will be within 6 to 20 digits';}
	else
	{
		$where="nib_mail='$mail'";
		$mail_check=$this->data_get_num($column,$table,$where);
		
		if($mail_check==1)
		{$message='The mail "'.$mail.'" already exists in your user list';}
		else
		{
			$password=md5($password);
			$date=date('Y-m-d');
			$time=date('h:i:s a');
			$values=array(
			'UserUUID'=>$uid,
			'nib_mail'=>$mail,
			'nib_first_name'=>$first_name,
			'nib_last_name'=>$last_name,
			'nib_password'=>$password,
			'nib_user_type'=>$type,
			'nib_date'=>$date,
			'nib_time'=>$time,
			'DateInserted'=>$date.' '.$time
			);
			
			if($this->data_put($table,$values)==1)
			{
				$status=1;
				$message='Added Successfully';
				
				}
			else
			{$message='Error Try again';}
			
			}
		
		
		}
	}
	}
	
	return array($status,$message);
	
	}
	
	
	

function add_user_by_admin($uid,$mail,$password,$confirm_password,$first_name,$last_name,$sex,$country,$city,$zip,$phone,$image,$address,$note,$type,$account_status)
{
	if($account_status=='' or strlen($account_status)==0 or preg_match('/[^0-9]/',$account_status)==1){$account_status=0;}

	$status=0;
	$message='';
	if($uid!=''){
		
		$column="*";
		$table="tbluser";
		$where="UserUUID='$uid'";
		$uid_check=$this->data_get_num($column,$table,$where);
	if($uid_check==0)
	{
	if($mail=='' and $type!=0){$message='Your mail is empty';}
	else if(isset($mail) and $mail!='' and filter_var($mail, FILTER_VALIDATE_EMAIL)!=$mail){$message='Please use a valid mail address';}
	else if($password==''){$message='Your Password is empty';}
	else if($confirm_password==''){$message='Your Confirm password is empty';}
	else if($password!=$confirm_password){$message='Your Password and Confirm password are not matching';}
	else if(strlen($password)<6 or strlen($password)>20){$message='Your password will be within 6 to 20 digits';}
	else if($first_name==''){$message='Your first name is empty';}
	else if($last_name==''){$message='Your last name is empty';}
	else if($phone==''){$message='Your phone is empty';}
	else if(strlen($phone)<11 or strlen($phone)>11){$message='Your phone number is wrong';}
	else
	{
		$mail_check=0;

		if($mail!=''){
		$where="nib_mail='$mail'";
		$mail_check=$this->data_get_num($column,$table,$where);
		}

		$where="nib_phone_1='$phone'";
		$phone_check=$this->data_get_num($column,$table,$where);
		
		if($mail_check==1)
		{$message='The mail "'.$mail.'" already used';}
		else if($phone_check==1){$message='The phone number "'.$phone.'" already used';}
		else
		{
			if($image==''){$image='default_profile.png';}

			$password=md5($password);
			$date=date('Y-m-d');
			$time=date('h:i:s a');
			$values=array(
			'UserUUID'=>$uid,
			'nib_mail'=>$mail,
			'nib_password'=>$password,
			'nib_first_name'=>$first_name,
			'nib_last_name'=>$last_name,
			'nib_sex'=>$sex,
			'nib_country'=>$country,
			'nib_city'=>$city,
			'nib_zip'=>$zip,
			'nib_image'=>$image,
			'nib_address'=>$address,
			'nib_note'=>$note,
			'nib_phone_1'=>$phone,
			'nib_user_type'=>$type,
			'nib_account_confirm'=>$account_status,
			'nib_date'=>$date,
			'nib_time'=>$time,
			'DateInserted'=>$date.' '.$time
			);
			
			if($this->data_put($table,$values)==1)
			{
				$status=1;
				$message='Added Successfully';
				
				}
			else
			{$message='Error Try again';}
			
			}
		
		
		}
	}
	}
	
	return array($status,$message);
	
	}
	
	


function edit_user_by_admin($uid,$mail,$first_name,$last_name,$sex,$country,$city,$zip,$phone,$image,$address,$note,$account_status)
{
	if($account_status=='' or strlen($account_status)==0 or preg_match('/[^0-9]/',$account_status)==1){$account_status=0;}

	$status=0;
	$message='';
	if($uid!=''){
		
		$column="*";
		$table="tbluser";
		$where="UserUUID='$uid'";
		$uid_check=$this->data_get_num($column,$table,$where);
	if($uid_check==1)
	{
	/* if($mail==''){$message='Your mail is empty';} */
	if($phone==''){$message='Your phone is empty';}
	else if(strlen($phone)<11 or strlen($phone)>11){$message='Your phone number is wrong';}
	else if(isset($mail) and $mail!='' and filter_var($mail, FILTER_VALIDATE_EMAIL)!=$mail){$message='Please use a valid mail address';}
	else if($first_name==''){$message='Your first name is empty';}
	else if($last_name==''){$message='Your last name is empty';}
	else
	{
		$mail_check=0;
		if($mail!=''){
		$where="nib_mail='$mail' and UserUUID!='$uid'";
		$mail_check=$this->data_get_num($column,$table,$where);
		}

		$where="nib_phone_1='$phone' and UserUUID!='$uid'";
		$phone_check=$this->data_get_num($column,$table,$where);
		
		if($mail_check==1)
		{$message='The mail "'.$mail.'" already used';}
		else if($phone_check==1){$message='The phone number "'.$phone.'" already used';}
		else
		{
			$column="*";
			$table="tbluser";
			$where="UserUUID='$uid'";
			$user_info=$this->data_get($column,$table,$where,"","","","");
			$image_old=$user_info[0]['nib_image'];
	
			if($image!='')
			{
				if(file_exists('upload/user/'.$image_old)==1){unlink('upload/user/'.$image_old);}
			}
			else{$image=$image_old;}
			
			$values=array(
			'nib_mail'=>$mail,
			'nib_first_name'=>$first_name,
			'nib_last_name'=>$last_name,
			'nib_sex'=>$sex,
			'nib_country'=>$country,
			'nib_city'=>$city,
			'nib_zip'=>$zip,
			'nib_image'=>$image,
			'nib_address'=>$address,
			'nib_note'=>$note,
			'nib_phone_1'=>$phone,
			'nib_account_confirm'=>$account_status
			);
			$where="UserUUID='$uid'";
			if($this->data_update($table,$values,$where)==1)
			{
				$status=1;
				$message='Update Successfully';
				
				}
			else
			{$message='Error Try again';}
			
			}
		
		
		}
	}
	}
	
	return array($status,$message);
	
	}



function add_service_by_admin($uid,$vendor_uid,$service_name,$service_description,$country,$state,$city,$road,$house_no,$floor,$address,$mail_1,$mail_2,$phone_1,$phone_2,$category_uid,$image,$latitude,$longitude)
{
	$status=0;
	$message='';
	$image_file_dir='upload/service/'; 
	
	if($uid!=''){
		
	$column="*";
	$table="tblservice";
	$where="ServiceUUID='$uid'";
	$uid_check=$this->data_get_num($column,$table,$where);
		
	if($uid_check==0)
	{
	if($vendor_uid==''){$message='Please select a vendor';}
	else if($service_name==''){$message='Your service name is empty';}
	else if($service_description==''){$message='Your service description is empty';}
	else if($category_uid==''){$message='Please select a category';}
	else if($image['name']==''){$message='Please select an image for your service';}
	else if($country==''){$message='Please select a country';}
	else if($state==''){$message='Your State/Province/District is empty';}
	else if($mail_1==''){$message='Your service mail 1 is empty';}
	else if(filter_var($mail_1, FILTER_VALIDATE_EMAIL)!=$mail_1){$message='Please use a valid Service mail 1';}
	else if($phone_1==''){$message='Your service phone 1 is empty';}
	else
	{
		
			$image_type=$image['type'];
			$image_file=time().'.'.pathinfo($image['name'], PATHINFO_EXTENSION);
					
			if($image_type=='image/jpg' or $image_type=='image/jpeg' or $image_type=='image/png' or $image_type=='image/gif')
			{move_uploaded_file($image['tmp_name'],$image_file_dir.$image_file);}
			
			$date=date('Y-m-d');
			$time=date('h:i:s a');
			$values=array(
			'ServiceUUID'=>$uid,
			'nib_vendor_uid'=>$vendor_uid,
			'nib_service_name'=>$service_name,
			'nib_service_description'=>$service_description,
			'nib_country'=>$country,
			'nib_state'=>$state,
			'nib_city'=>$city,
			'nib_road'=>$road,
			'nib_house_no'=>$house_no,
			'nib_floor'=>$floor,
			'nib_address'=>$address,
			'nib_mail_1'=>$mail_1,
			'nib_mail_2'=>$mail_2,
			'nib_phone_1'=>$phone_1,
			'nib_phone_2'=>$phone_2,
			'nib_category_uid'=>$category_uid,
			'nib_image'=>$image_file,
			'nib_latitude'=>$latitude,
			'nib_longitude'=>$longitude,
			'nib_status'=>'1',
			'nib_date'=>$date,
			'nib_time'=>$time,
			'DateInserted'=>$date.' '.$time
			);
			
			if($this->data_put($table,$values)==1)
			{
				$status=1;
				$message='Created Successfully';
				
				}
			else
			{
				if($image['name']!='' and file_exists($image_file_dir.$image_file)==1)
				{unlink($image_file_dir.$image_file);}
					 
				$message='Error Try again';}
		
		}
	}
	}
	
	return array($status,$message);
	
	}
	
	
	
	
function edit_service_by_admin($uid,$vendor_uid,$service_name,$service_description,$country,$state,$city,$road,$house_no,$floor,$address,$mail_1,$mail_2,$phone_1,$phone_2,$category_uid,$image,$latitude,$longitude)
{
	$status=0;
	$message='';
	$image_file_dir='upload/service/'; 
	
	if($uid!=''){
		
	$column="*";
	$table="tblservice";
	$where="ServiceUUID='$uid'";
	$uid_check=$this->data_get_num($column,$table,$where);
		
	if($uid_check==1)
	{
	if($vendor_uid==''){$message='Please select a vendor';}
	else if($service_name==''){$message='Your service name is empty';}
	else if($service_description==''){$message='Your service description is empty';}
	else if($category_uid==''){$message='Please select a category';}
	else if($country==''){$message='Please select a country';}
	else if($state==''){$message='Your State/Province/District is empty';}
	else if($mail_1==''){$message='Your service mail 1 is empty';}
	else if(filter_var($mail_1, FILTER_VALIDATE_EMAIL)!=$mail_1){$message='Please use a valid Service mail 1';}
	else if($phone_1==''){$message='Your service phone 1 is empty';}
	else
	{
		$service_old_image=$this->data_get("nib_image",$table,$where,"","","","");
		$image_file=$service_old_image[0]['nib_image'];
		$image_file_del=$service_old_image[0]['nib_image'];
		if($image['name']!='')
		{
			$image_type=$image['type'];
			$image_file=time().'.'.pathinfo($image['name'], PATHINFO_EXTENSION);
					
			if($image_type=='image/jpg' or $image_type=='image/jpeg' or $image_type=='image/png' or $image_type=='image/gif')
			{move_uploaded_file($image['tmp_name'],$image_file_dir.$image_file);}
		}
		
			$date=date('Y-m-d');
			$time=date('h:i:s a');
			$values=array(
			'nib_vendor_uid'=>$vendor_uid,
			'nib_service_name'=>$service_name,
			'nib_service_description'=>$service_description,
			'nib_country'=>$country,
			'nib_state'=>$state,
			'nib_city'=>$city,
			'nib_road'=>$road,
			'nib_house_no'=>$house_no,
			'nib_floor'=>$floor,
			'nib_address'=>$address,
			'nib_mail_1'=>$mail_1,
			'nib_mail_2'=>$mail_2,
			'nib_phone_1'=>$phone_1,
			'nib_phone_2'=>$phone_2,
			'nib_category_uid'=>$category_uid,
			'nib_image'=>$image_file,
			'nib_latitude'=>$latitude,
			'nib_longitude'=>$longitude,
			
			);
			
			if($this->data_update($table,$values,$where)==1)
			{
				if($image_file_del!='' and file_exists($image_file_dir.$image_file_del)==1)
				{unlink($image_file_dir.$image_file_del);}
				
				$status=1;
				$message='Updated Successfully';
				
				}
			else
			{
				if($image['name']!='' and file_exists($image_file_dir.$image_file)==1)
				{unlink($image_file_dir.$image_file);}
					 
				$message='Error Try again';}
		
		}
	}
	}
	
	return array($status,$message);
	
	}



function uid_to_mail($uid)
{
	$output='';
	
	if($uid!='')
	{
		$result=$this->data_get("*","tbluser","UserUUID='$uid'","","","","");
		if(count($result)==1)
		{$output=$result[0]['nib_mail'];}
		else
		{$output=false;}
		}
	else
	{$output=false;}
	return $output;
	}



function mail_to_uid($mail)
{
	$output='';
	
	if($mail!='')
	{
		$result=$this->data_get("*","tbluser","nib_mail='$mail'","","","","");
		if(count($result)==1)
		{$output=$result[0]['UserUUID'];}
		else
		{$output=false;}
		}
	else
	{$output=false;}
	return $output;
	}
	

function uid_to_phone($uid)
{
	$output='';
	
	if($uid!='')
	{
		$result=$this->data_get("*","tbluser","UserUUID='$uid'","","","","");
		if(count($result)==1)
		{$output=$result[0]['nib_phone_1'];}
		else
		{$output=false;}
		}
	else
	{$output=false;}
	return $output;
	}
	


function phone_to_uid($phone)
{
	$output='';
	
	if($phone!='')
	{
		$result=$this->data_get("*","tbluser","nib_phone_1='$phone'","","","","");
		if(count($result)==1)
		{$output=$result[0]['UserUUID'];}
		else
		{$output=false;}
		}
	else
	{$output=false;}
	return $output;
	}
	
	
	
function category_name_by_uid($uid)
{
	$output='';
	
	if($uid!='')
	{
		$result=$this->data_get("*","tblcategory","CategoryUUID='$uid'","","","","");
		if(count($result)==1)
		{$output=$result[0]['nib_name'];}
		else
		{$output=false;}
		}
	else
	{$output=false;}
	return $output;
	}


function service_name_by_uid($uid)
{
	$output='';
	
	if($uid!='')
	{
		$result=$this->data_get("*","tblservice","ServiceUUID='$uid'","","","","");
		if(count($result)==1)
		{$output=$result[0]['nib_service_name'];}
		else
		{$output=false;}
		}
	else
	{$output=false;}
	return $output;
	}

	
function add_product_by_admin($uid,$product_name,$product_description,$category_uid,$product_unit,$product_price,$product_vat,$product_stock,$product_stock_limit,$product_virtual,$product_image,$product_type)
{
	if($uid!='')
	{
		$column="*";
		$table="tblproduct";
		$where="ProductUUID='$uid'";
		$uid_check=$this->data_get_num($column,$table,$where);
		
		if($uid_check==0)
		{
			$status=0;
			$message='';
			
			if($product_name=='')
			{$message='Your product name is empty';}
			else if($product_description=='')
			{$message='Your product description is empty';}
			else if($category_uid=='')
			{$message='Please select a Category';}
			else if($product_unit=='')
			{$message='Your product unit is empty';}
			else if($product_price=='')
			{$message='Your product price is empty';}
			else if($product_vat=='')
			{$message='Your product vat is empty';}
			else if($product_stock=='')
			{$message='Please select a stock';}
			else if($product_stock==1 and $product_stock_limit=='')
			{$message='Your stock limit is empty';}
			else if($product_virtual=='')
			{$message='Please select a product type';}
			else if($product_image=='')
			{$message='Please select minimum a image for product';}
			else
			{
				
				
				$date=date('Y-m-d');
				$time=date('h:i:s a');
				
				$values=array(
				'ProductUUID'=>$uid,
				'nib_title'=>$product_name,
				'nib_description'=>$product_description,
				'nib_category_uid'=>$category_uid,
				'nib_unit'=>$product_unit,
				'nib_price'=>$product_price,
				'nib_stock'=>$product_stock,
				'nib_stock_limit'=>$product_stock_limit,
				'nib_virtual'=>$product_virtual,
				'nib_vat'=>$product_vat,
				'nib_type'=>1,
				'nib_status'=>1,
				'nib_date'=>$date,
				'nib_time'=>$time,
				'DateInserted'=>$date.' '.$time
				);
				
				if($this->data_put($table,$values)==1)
				{
					for($i=0;$i<count($product_image['name']);$i++)
					{
						$image=time().$i.'.'.pathinfo($product_image['name'][$i], PATHINFO_EXTENSION);
						$upload_image_file='upload/product/'.$image;
						
						if(move_uploaded_file($product_image['tmp_name'][$i],$upload_image_file))
						{
							$img_uid=uniqid();
							$values=array('ImageUUID'=>$img_uid,'nib_product_uid'=>$uid,'nib_file'=>$image,'nib_date'=>$date,'nib_time'=>$time);
							$this->data_put("tblimage",$values);
							}
						
						}
					
					$status=1; $message='Added Successfully';
					
					}
				else
				{$message='Error, Try again';}
				
				
				}
			
			}

		}
	
	return array($status,$message);
	}
	
	


function add_service_product_by_admin($uid,$vendor_uid,$service_uid,$product_name,$product_description,$product_unit,$product_price,$product_vat,$product_stock,$product_stock_limit,$product_virtual,$product_image)
{
	if($uid!='')
	{
		$column="*";
		$table="tblproduct";
		$where="ProductUUID='$uid'";
		$uid_check=$this->data_get_num($column,$table,$where);
		
		if($uid_check==0)
		{
			$status=0;
			$message='';
			
			if($vendor_uid=='')
			{$message='Please select a vendor';}
			else if($service_uid=='')
			{$message='Please select a service';}
			else if($product_name=='')
			{$message='Your product name is empty';}
			else if($product_description=='')
			{$message='Your product description is empty';}
			else if($product_unit=='')
			{$message='Your product unit is empty';}
			else if($product_price=='')
			{$message='Your product price is empty';}
			else if($product_vat=='')
			{$message='Your product vat is empty';}
			else if($product_stock=='')
			{$message='Please select a stock';}
			else if($product_stock==1 and $product_stock_limit=='')
			{$message='Your stock limit is empty';}
			else if($product_virtual=='')
			{$message='Please select a product type';}
			else if($product_image=='')
			{$message='Please select minimum a image for product';}
			else
			{
				
				
				$date=date('Y-m-d');
				$time=date('h:i:s a');
				
				$values=array(
				'ProductUUID'=>$uid,
				'nib_vendor_uid'=>$vendor_uid,
				'nib_service_uid'=>$service_uid,
				'nib_title'=>$product_name,
				'nib_description'=>$product_description,
				'nib_unit'=>$product_unit,
				'nib_price'=>$product_price,
				'nib_stock'=>$product_stock,
				'nib_stock_limit'=>$product_stock_limit,
				'nib_virtual'=>$product_virtual,
				'nib_vat'=>$product_vat,
				'nib_type'=>0,
				'nib_status'=>1,
				'nib_date'=>$date,
				'nib_time'=>$time,
				'DateInserted'=>$date.' '.$time
				);
				
				if($this->data_put($table,$values)==1)
				{
					for($i=0;$i<count($product_image['name']);$i++)
					{
						$image=time().$i.'.'.pathinfo($product_image['name'][$i], PATHINFO_EXTENSION);
						$upload_image_file='upload/product/'.$image;
						
						if(move_uploaded_file($product_image['tmp_name'][$i],$upload_image_file))
						{
							$img_uid=uniqid();
							$values=array('ImageUUID'=>$img_uid,'nib_product_uid'=>$uid,'nib_file'=>$image,'nib_date'=>$date,'nib_time'=>$time);
							$this->data_put("tblimage",$values);
							}
						
						}
					
					$status=1; $message='Added Successfully';
					
					}
				else
				{$message='Error, Try again';}
				
				
				}
			
			}

		}
	
	return array($status,$message);
	}
	
	

	
	
	
	
function edit_product_by_admin($uid,$product_name,$product_description,$category_uid,$product_unit,$product_price,$product_vat,$product_stock,$product_stock_limit,$product_virtual,$product_image)
{
	if($uid!='')
	{
		$column="*";
		$table="tblproduct";
		$where="ProductUUID='$uid'";
		$uid_check=$this->data_get_num($column,$table,$where);
		
		if($uid_check==1)
		{
			$status=0;
			$message='';
			
			if($product_name=='')
			{$message='Your product name is empty';}
			else if($product_description=='')
			{$message='Your product description is empty';}
			else if($category_uid=='')
			{$message='Please select a Category';}
			else if($product_unit=='')
			{$message='Your product unit is empty';}
			else if($product_price=='')
			{$message='Your product price is empty';}
			else if($product_vat=='')
			{$message='Your product vat is empty';}
			else if($product_stock=='')
			{$message='Please select a stock';}
			else if($product_stock==1 and $product_stock_limit=='')
			{$message='Your stock limit is empty';}
			else if($product_virtual=='')
			{$message='Please select a product type';}
			else
			{
				
				
				$date=date('Y-m-d');
				$time=date('h:i:s a');
				
				$values=array(
				'nib_title'=>$product_name,
				'nib_description'=>$product_description,
				'nib_category_uid'=>$category_uid,
				'nib_unit'=>$product_unit,
				'nib_price'=>$product_price,
				'nib_stock'=>$product_stock,
				'nib_stock_limit'=>$product_stock_limit,
				'nib_virtual'=>$product_virtual,
				'nib_vat'=>$product_vat
				);
				$where="ProductUUID='$uid'";
				if($this->data_update($table,$values,$where)==1)
				{
					for($i=0;$i<count($product_image['name']);$i++)
					{
						$image=time().$i.'.'.pathinfo($product_image['name'][$i], PATHINFO_EXTENSION);
						$upload_image_file='upload/product/'.$image;
						
						if(move_uploaded_file($product_image['tmp_name'][$i],$upload_image_file))
						{
							$img_uid=uniqid();
							$values=array('ImageUUID'=>$img_uid,'nib_product_uid'=>$uid,'nib_file'=>$image,'nib_date'=>$date,'nib_time'=>$time);
							$this->data_put("tblimage",$values);
							}
						
						}
					
					$status=1; $message='Update Successfully';
					
					}
				else
				{$message='Error, Try again';}
				
				
				}
			
			}

		}
	
	return array($status,$message);
	}
	
	
	
function edit_service_product_by_admin($uid,$vendor_uid,$service_uid,$product_name,$product_description,$product_unit,$product_price,$product_vat,$product_stock,$product_stock_limit,$product_virtual,$product_image)
{
	if($uid!='')
	{
		$column="*";
		$table="tblproduct";
		$where="ProductUUID='$uid'";
		$uid_check=$this->data_get_num($column,$table,$where);
		
		if($uid_check==1)
		{
			$status=0;
			$message='';
			
			if($vendor_uid=='')
			{$message='Please select a vendor';}
			else if($service_uid=='')
			{$message='Please select a service';}
			else if($product_name=='')
			{$message='Your product name is empty';}
			else if($product_description=='')
			{$message='Your product description is empty';}
			else if($product_unit=='')
			{$message='Your product unit is empty';}
			else if($product_price=='')
			{$message='Your product price is empty';}
			else if($product_vat=='')
			{$message='Your product vat is empty';}
			else if($product_stock=='')
			{$message='Please select a stock';}
			else if($product_stock==1 and $product_stock_limit=='')
			{$message='Your stock limit is empty';}
			else if($product_virtual=='')
			{$message='Please select a product type';}
			else
			{
				
				
				$date=date('Y-m-d');
				$time=date('h:i:s a');
				
				$values=array(
				'nib_vendor_uid'=>$vendor_uid,
				'nib_service_uid'=>$service_uid,
				'nib_title'=>$product_name,
				'nib_description'=>$product_description,
				'nib_unit'=>$product_unit,
				'nib_price'=>$product_price,
				'nib_stock'=>$product_stock,
				'nib_stock_limit'=>$product_stock_limit,
				'nib_virtual'=>$product_virtual,
				'nib_vat'=>$product_vat
				);
				$where="ProductUUID='$uid'";
				if($this->data_update($table,$values,$where)==1)
				{
					for($i=0;$i<count($product_image['name']);$i++)
					{
						$image=time().$i.'.'.pathinfo($product_image['name'][$i], PATHINFO_EXTENSION);
						$upload_image_file='upload/product/'.$image;
						
						if(move_uploaded_file($product_image['tmp_name'][$i],$upload_image_file))
						{
							$img_uid=uniqid();
							$values=array('ImageUUID'=>$img_uid,'nib_product_uid'=>$uid,'nib_file'=>$image,'nib_date'=>$date,'nib_time'=>$time);
							$this->data_put("tblimage",$values);
							}
						
						}
					
					$status=1; $message='Update Successfully';
					
					}
				else
				{$message='Error, Try again';}
				
				
				}
			
			}

		}
	
	return array($status,$message);
	}
	
		

function order_delete($order_uid)
{
	$output=0;
	$order_check=$this->data_get_num("*","tblorder","OrderUUID='$order_uid'");
	
	if($order_check==1)
	{
		$order_product=$this->data_get("*","tblorder_product","nib_order_uid='$order_uid'","","","","");
		for($i=0;$i<count($product);$i++)
		{
			$item_uid=$order_product[$i]['Order_productUUID'];
			$product_uid=$order_product[$i]['nib_product_uid'];
			$product_quantity=$order_product[$i]['nib_product_quantity'];
			
			$product=$this->data_get("*","tblproduct","ProductUUID='$product_uid'","","","","");
			if(count($product)==1)
			{
				$stock=$product[0]['nib_stock'];
				$stock_limit=$product[0]['nib_stock_limit'];
				
				if($stock==1)
				{
					$stock_update=(int)$stock_limit+(int)$product_quantity;
					
					$values=array('nib_stock_limit'=>$stock_update);
					$this->data_update("tblproduct",$values,"ProductUUID='$product_uid'");
					
					}
				
				}			
			}
			
			if($this->data_delete("tblorder","OrderUUID='$order_uid'")==1)
			{
				$this->data_delete("tblorder_product","nib_order_uid='$order_uid'");
				$output=1;
				}
			
		}
	
	return $output;
	}
	

function order_cancel($order_uid)
{
	$output=0;
	$order_check=$this->data_get_num("*","tblorder","OrderUUID='$order_uid'");
	
	if($order_check==1)
	{
		$order_product=$this->data_get("*","tblorder_product","nib_order_uid='$order_uid'","","","","");
		for($i=0;$i<count($product);$i++)
		{
			$item_uid=$order_product[$i]['Order_productUUID'];
			$product_uid=$order_product[$i]['nib_product_uid'];
			$product_quantity=$order_product[$i]['nib_product_quantity'];
			
			$product=$this->data_get("*","tblproduct","ProductUUID='$product_uid'","","","","");
			if(count($product)==1)
			{
				$stock=$product[0]['nib_stock'];
				$stock_limit=$product[0]['nib_stock_limit'];
				
				if($stock==1)
				{
					$stock_update=(int)$stock_limit+(int)$product_quantity;
					
					$values=array('nib_stock_limit'=>$stock_update);
					$this->data_update("tblproduct",$values,"ProductUUID='$product_uid'");
					
					}
				
				}			
			}
			
			if($this->data_update("tblorder",array('nib_order_status'=>'4'),"OrderUUID ='$order_uid'")==1)
			{
				$this->data_update("tblorder_product",array('nib_status'=>'1'),"nib_order_uid='$order_uid'");
				$output=1;
				}
			
		}
	
	return $output;
	}



function item_delete($item_uid)
{
	$output=0;
	$item_check=$this->data_get_num("*","tblorder_product","Order_productUUID='$item_uid'");
	
	if($order_check==1)
	{
		$order_product=$this->data_get("*","tblorder_product","nib_order_uid='$order_uid'","","","","");
		$product_uid=$order_product[$i]['nib_product_uid'];
		$product_quantity=$order_product[$i]['nib_product_quantity'];
		$product_total_amount=$order_product[$i]['nib_total_amount'];
		$order_uid=$order_product[$i]['nib_order_uid'];
		
		$result_order=$this->data_get("*","tblorder","OrderUUID='$order_uid'","","","","");
		$order_amount=$result_order[0]['nib_amount'];
		$order_total_amount=$result_order[0]['nib_payable_amount'];
		
		$update_order_amount=(float)$order_amount-(float)$product_total_amount;
		$update_order_total_amount=(float)$order_total_amount-(float)$product_total_amount;
		
			$product=$this->data_get("*","tblproduct","ProductUUID='$product_uid'","","","","");
			if(count($product)==1)
			{
				$stock=$product[0]['nib_stock'];
				$stock_limit=$product[0]['nib_stock_limit'];
				
				if($stock==1)
				{
					$stock_update=(int)$stock_limit+(int)$product_quantity;
					$values=array('nib_stock_limit'=>$stock_update);
					$this->data_update("tblproduct",$values,"ProductUUID='$product_uid'");
					}			
			}
			
			if($this->data_delete("tblorder_product","Order_productUUID='$item_uid'")==1)
			{
				$values=array('nib_amount'=>$update_order_amount,'nib_payable_amount'=>$update_order_total_amount);
				$this->data_update("tblorder",$values,"OrderUUID='$order_uid'");
				$output=1;}
			}
	
	return $output;
	}
	



function order_complete($order_uid)
{
	$output=0;
	$my_mail=$_SESSION['admin'];
	
	$check_order=$this->data_get_num("*","tblorder","OrderUUID='$order_uid' and nib_order_type=2 and nib_order_status=2");
	if($check_order==1)
	{
		$values=array('nib_order_status'=>'3','nib_approved_by'=>$my_mail);
			
		if($this->data_update("tblorder",$values,"OrderUUID='$order_uid'")==1)
		{
			$order_product=$this->data_get("*","tblorder_product","nib_order_uid='$order_uid'","","","","");
			
			for($i=0;$i<count($order_product);$i++)
			{
				$vendor_uid=$order_product[$i]['nib_vendor_uid'];
				$product_total_amount=$order_product[$i]['nib_total_amount'];
				$commission_amount=$order_product[$i]['nib_commission_amount'];
				$update_amount=number_format(((float)$product_total_amount-(float)$commission_amount),2);
				
				$vendor_info=$this->data_get("*","tbluser","UserUUID='$vendor_uid'","","","","");
				
				$vendor_amount=$vendor_info[0]['nib_amount'];
				
				$vendor_update_amount=(float)$vendor_amount+(float)$update_amount;
				
				$values=array('nib_amount'=>$vendor_update_amount);
				$this->data_update("tbluser",$values,"UserUUID='$vendor_uid'");
				
				$this->calculation_vendor_account_update($vendor_uid,$update_amount);
				$this->calculation_admin_account_update($commission_amount);
							
				}
			
			$output=1;	
			}
			}
			
			return $output;	
	}
	
	
	
	
	
function calculation_vendor_account_update($vendor_uid,$amount)
{
	$day=date('d');
	$month=date('m');
	$year=date('Y');
	$time=date('h:i:s a');
	
	if(strlen($day)==1){$day='0'.$day;}
	
	if(strlen($month)==1){$month='0'.$month;}
	
	$vendor_check_day=$this->data_get_num("*","tblaccount_day","nib_vendor_uid='$vendor_uid' and nib_year='$year' and nib_month='$month' and nib_day='$day'");
	$vendor_check_month=$this->data_get_num("*","tblaccount_month","nib_vendor_uid='$vendor_uid' and nib_year='$year' and nib_month='$month'");
	$vendor_check_year=$this->data_get_num("*","tblaccount_year","nib_vendor_uid='$vendor_uid' and nib_year='$year'");
	
	
	$table="tblaccount_day";
	$where="nib_vendor_uid='$vendor_uid' and nib_year='$year' and nib_month='$month' and nib_day='$day'";
		
	if($vendor_check_day==1)
	{
		$vendor_info_day=$this->data_get("*",$table,$where,"","","","");
		$vendor_amount=$vendor_info_day[0]['nib_amount'];
		$vendor_items=$vendor_info_day[0]['nib_items'];
		
		$update_amount=(float)$vendor_amount+(float)$amount;
		$update_items=(int)$vendor_items+1;
		
		$values=array('nib_amount'=>$update_amount,'nib_items'=>$update_items);
		$this->data_update($table,$values,$where);
		
		}
	else
	{
		$values=array('Account_dayUUID'=>uniqid(),'nib_vendor_uid'=>$vendor_uid,'nib_amount'=>$amount,'nib_items'=>1,'nib_year'=>$year,'nib_month'=>$month,'nib_day'=>$day);
		$this->data_put($table,$values);
		
		}
	
	
	
	
	$table="tblaccount_month";
	$where="nib_vendor_uid='$vendor_uid' and nib_year='$year' and nib_month='$month'";
		
	if($vendor_check_month==1)
	{
		$vendor_info_day=$this->data_get("*",$table,$where,"","","","");
		$vendor_amount=$vendor_info_day[0]['nib_amount'];
		
		$update_amount=(float)$vendor_amount+(float)$amount;
		
		$values=array('nib_amount'=>$update_amount);
		$this->data_update($table,$values,$where);
		
		}
	else
	{
		$values=array('Account_monthUUID'=>uniqid(),'nib_vendor_uid'=>$vendor_uid,'nib_amount'=>$amount,'nib_year'=>$year,'nib_month'=>$month);
		$this->data_put($table,$values);
		
		}
		
		
		
		
	$table="tblaccount_year";
	$where="nib_vendor_uid='$vendor_uid' and nib_year='$year'";
		
	if($vendor_check_year==1)
	{
		$vendor_info_day=$this->data_get("*",$table,$where,"","","","");
		$vendor_amount=$vendor_info_day[0]['nib_amount'];
		
		$update_amount=(float)$vendor_amount+(float)$amount;
		
		$values=array('nib_amount'=>$update_amount);
		$this->data_update($table,$values,$where);
		
		}
	else
	{
		$values=array('Account_yearUUID'=>uniqid(),'nib_vendor_uid'=>$vendor_uid,'nib_amount'=>$amount,'nib_year'=>$year);
		$this->data_put($table,$values);
		
		}

	
	}
	
	
	
	
	
	
	
	
	
	
function calculation_admin_account_update($amount)
{
	$day=date('d');
	$month=date('m');
	$year=date('Y');
	$time=date('h:i:s a');
	
	if(strlen($day)==1){$day='0'.$day;}
	
	if(strlen($month)==1){$month='0'.$month;}
	
	$vendor_check_day=$this->data_get_num("*","tbladminaccount_day","nib_year='$year' and nib_month='$month' and nib_day='$day'");
	$vendor_check_month=$this->data_get_num("*","tbladminaccount_month","nib_year='$year' and nib_month='$month'");
	$vendor_check_year=$this->data_get_num("*","tbladminaccount_year","nib_year='$year'");
	
	
	$table="tbladminaccount_day";
	$where="nib_year='$year' and nib_month='$month' and nib_day='$day'";
		
	if($vendor_check_day==1)
	{
		$vendor_info_day=$this->data_get("*",$table,$where,"","","","");
		$vendor_amount=$vendor_info_day[0]['nib_amount'];
		
		
		$update_amount=(float)$vendor_amount+(float)$amount;
		
		
		$values=array('nib_amount'=>$update_amount);
		$this->data_update($table,$values,$where);
		
		}
	else
	{
		$values=array('Adminaccount_dayUUID'=>uniqid(),'nib_amount'=>$amount,'nib_year'=>$year,'nib_month'=>$month,'nib_day'=>$day);
		$this->data_put($table,$values);
		
		}
	
	
	
	
	$table="tbladminaccount_month";
	$where="nib_year='$year' and nib_month='$month'";
		
	if($vendor_check_month==1)
	{
		$vendor_info_day=$this->data_get("*",$table,$where,"","","","");
		$vendor_amount=$vendor_info_day[0]['nib_amount'];
		
		$update_amount=(float)$vendor_amount+(float)$amount;
		
		$values=array('nib_amount'=>$update_amount);
		$this->data_update($table,$values,$where);
		
		}
	else
	{
		$values=array('Adminaccount_monthUUID'=>uniqid(),'nib_amount'=>$amount,'nib_year'=>$year,'nib_month'=>$month);
		$this->data_put($table,$values);
		
		}
		
		
		
		
	$table="tbladminaccount_year";
	$where="nib_year='$year'";
		
	if($vendor_check_year==1)
	{
		$vendor_info_day=$this->data_get("*",$table,$where,"","","","");
		$vendor_amount=$vendor_info_day[0]['nib_amount'];
		
		$update_amount=(float)$vendor_amount+(float)$amount;
		
		$values=array('nib_amount'=>$update_amount);
		$this->data_update($table,$values,$where);
		
		}
	else
	{
		$values=array('Adminaccount_yearUUID'=>uniqid(),'nib_amount'=>$amount,'nib_year'=>$year);
		$this->data_put($table,$values);
		
		}

	
	}
	
	

function payment_module_setting($module_uid,$column,$value)
{
	$uid=uniqid();
	$table='tblpayment_module_setting';
	$where="Payment_module_settingUUID='$module_uid' and nib_setting_name='$column'";
	if($this->data_get_num("*",$table,$where)==1)
	{
		$value=array('nib_value'=>$value);
		if($this->data_update($table,$update_value,$where)==1)
		{return 1;}
		else
		{return 0;}
		
		}
	else
	{
		$value=array(
		'Payment_module_settingUUID'=>$uid,
		'nib_module_uid'=>$module_uid,
		'nib_setting_name'=>$column,
		'nib_value'=>$value
		);
		
		if($this->data_put($table,$value)==1)
		{return 1;}
		else
		{return 0;}
		}
	}
	
	
	
	
	
	

function get_payment_module_setting($module_uid,$setting_name)
{
	$result=$this->data_get("*","tblpayment_module_setting","nib_module_uid='$module_uid' and nib_setting_name='$setting_name'","","","","");
	if(count($result)>0)
	{return $result['0']['ik_value'];}
	else
	{return false;}
}






function update_order_payment($order_uid,$user_uid,$txn_id,$val_id,$bank_txn_id,$currency,$request_amount,$paid_amount,$payment_method_type,$getway)
{
	$table='tblorder';
	$where="OrderUUID='$order_uid' and nib_user_uid='$user_uid'";
	$date=date('Y-m-d');
	$time=date('h:i:s a');
	
	$value=array(
	'nib_payment_txn_id'=>$txn_id,
	'nib_payment_val_id'=>$val_id,
	'nib_payment_bank_tran_id'=>$bank_txn_id,
	'nib_payment_pay_currency'=>$currency,
	'nib_payment_request_amount'=>$request_amount,
	'nib_payment_store_amount'=>$paid_amount,
	'nib_payment_method_type'=>$payment_method_type,
	'nib_payment_date'=>$date,
	'nib_payment_time'=>$time,
	'nib_payment_status'=>1,
	'nib_payment_gateway'=>$getway,
	'nib_order_status'=>1
	);
	
	if($this->data_update($table,$value,$where)==1)
	{return 1;}
	else
	{return 0;}
	
	
	
	}
	



function store_raw_payment_data($txn_id,$order_uid,$user_uid,$user_mail,$seller_mail,$buyer_mail,$pay_price,$currency,$raw_data)
{
	$date=date('Y-m-d');
	$time=date('H:i:s a');
	
	$uid=uniqid();
	$table='tblpayment_raw_data';
	$colu="ik_uid,ik_txn_id,ik_order_uid,ik_user_uid,ik_user_mail,ik_seller_mail,ik_buyer_mail,ik_pay_price,ik_currency,ik_raw_data,ik_date,ik_time";
	$value="'$uid','$txn_id','$order_uid','$user_uid','$user_mail','$seller_mail','$buyer_mail','$pay_price','$currency','$raw_data','$date','$time'";
	$value=array(
	'Payment_raw_dataUUID'=>$uid,
	'nib_txn_id'=>$txn_id,
	'nib_order_uid'=>$order_uid,
	'nib_user_uid'=>$user_uid,
	'nib_user_mail'=>$user_mail,
	'nib_seller_mail'=>$seller_mail,
	'nib_buyer_mail'=>$buyer_mail,
	'nib_pay_price'=>$pay_price,
	'nib_currency'=>$currency,
	'nib_raw_data'=>$raw_data,
	'nib_date'=>$date,
	'nib_time'=>$time
	);
	if($this->data_get_num($table,"ik_txn_id='$txn_id'")==0)
	{
		if($this->data_put($table,$colu,$value)=='true')
		{return 1;}
		else
		{return 0;}
		}
	}

	
	
	
	
	
	
	
	

//end
}

?>
