<?php 
function debug($var){

	if(Conf::$debug > 0){
		$debug = debug_backtrace(); 
		echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].' </strong> l.'.$debug[0]['line'].'</a></p>'; 
		echo '<ol style="display:none;">'; 
		foreach($debug as $k=>$v){ if($k>0){
			echo '<li><strong>'.$v['file'].' </strong> l.'.$v['line'].'</li>'; 
		}}
		echo '</ol>'; 
		echo '<pre>';
		print_r($var);
		echo '</pre>'; 
	}
	
}

function debugDie($var){

	if(Conf::$debug > 0){
		$debug = debug_backtrace(); 
		echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].' </strong> l.'.$debug[0]['line'].'</a></p>'; 
		echo '<ol style="display:none;">'; 
		foreach($debug as $k=>$v){ if($k>0){
			echo '<li><strong>'.$v['file'].' </strong> l.'.$v['line'].'</li>'; 
		}}
		echo '</ol>'; 
		echo '<pre>';
		print_r($var);
		echo '</pre>'; 
		die();
	}
}

function trashNavIteme($itmes){

	$objet = new stdClass();
	$objet->domaine = 'boutique';
}
// Le calcul de la distance entre deux points géographiques peut être effectué en utilisant la formule de la haversine pour la distance à vol d'oiseau. Pour le calcul de la distance à pied, à vélo, en voiture, en moto ou par avion, différentes approches peuvent être utilisées, en fonction des besoins spécifiques.
function haversine($lat1, $lon1, $lat2, $lon2) {
    $R = 6371; // Rayon de la Terre en kilomètres

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $R * $c; // Distance en kilomètres

    return $distance;
}

function utilisation_haversine(){

	// Exemple d'utilisation
	$lat1 = 48.8566; // Latitude point 1 (par exemple, Paris)
	$lon1 = 2.3522;  // Longitude point 1

	$lat2 = 51.5098; // Latitude point 2 (par exemple, Londres)
	$lon2 = -0.1180; // Longitude point 2

	$distance = haversine($lat1, $lon1, $lat2, $lon2);

	echo "La distance à vol d'oiseau entre les deux points est d'environ " . round($distance, 2) . " kilomètres.";
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
	if (($lat1 == $lat2) && ($lon1 == $lon2)) {
	  return 0;
	}
	else {
	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);
  
	  if ($unit == "KM") {
		$km = $miles * 1.609344;
		return $km;
	  } else {
		return $miles;
	  }
	}
  }
  
$distance = distance(39.916668,116.383331,48.856613,2.352222,"KM");
  $prix = $distance * 1;

function codeList(){
	return '<option value="1">+1</option><option value="7">+7</option><option value="20">+20</option><option value="27">+27</option><option value="30">+30</option><option value="31">+31</option><option value="32">+32</option><option value="33">+33</option><option value="34">+34</option><option value="36">+36</option><option value="39">+39</option><option value="40">+40</option><option value="41">+41</option><option value="43">+43</option><option value="44">+44</option><option value="45">+45</option><option value="46">+46</option><option value="47">+47</option><option value="48">+48</option><option value="49">+49</option><option value="51">+51</option><option value="52">+52</option><option value="54">+54</option><option value="55">+55</option><option value="56">+56</option><option value="57">+57</option><option value="58">+58</option><option value="60">+60</option><option value="61">+61</option><option value="62">+62</option><option value="63">+63</option><option value="64">+64</option><option value="65">+65</option><option value="66">+66</option><option value="81">+81</option><option value="82">+82</option><option value="84">+84</option><option value="86">+86</option><option value="90">+90</option><option value="91">+91</option><option value="92">+92</option><option value="93">+93</option><option value="94">+94</option><option value="95">+95</option><option value="212">+212</option><option value="213">+213</option><option value="216">+216</option><option value="218">+218</option><option value="220">+220</option><option value="221">+221</option><option value="222">+222</option><option value="223">+223</option><option value="224">+224</option><option value="225">+225</option><option value="226">+226</option><option value="227">+227</option><option value="228">+228</option><option value="229">+229</option><option value="230">+230</option><option value="231">+231</option><option value="232">+232</option><option value="233">+233</option><option value="234">+234</option><option value="235">+235</option><option value="236">+236</option><option value="237">+237</option><option value="238">+238</option><option value="239">+239</option><option value="240">+240</option><option value="241">+241</option><option value="242">+242</option><option value="243">+243</option><option value="244">+244</option><option value="245">+245</option><option value="246">+246</option><option value="248">+248</option><option value="250">+250</option><option value="251">+251</option><option value="252">+252</option><option value="253">+253</option><option value="254">+254</option><option value="255">+255</option><option value="256">+256</option><option value="257">+257</option><option value="258">+258</option><option value="260">+260</option><option value="261">+261</option><option value="262">+262</option><option value="263">+263</option><option value="264">+264</option><option value="265">+265</option><option value="266">+266</option><option value="267">+267</option><option value="268">+268</option><option value="269">+269</option><option value="290">+290</option><option value="291">+291</option><option value="297">+297</option><option value="298">+298</option><option value="299">+299</option><option value="350">+350</option><option value="351">+351</option><option value="352">+352</option><option value="353">+353</option><option value="354">+354</option><option value="355">+355</option><option value="356">+356</option><option value="357">+357</option><option value="358">+358</option><option value="359">+359</option><option value="370">+370</option><option value="371">+371</option><option value="372">+372</option><option value="373">+373</option><option value="374">+374</option><option value="375">+375</option><option value="376">+376</option><option value="377">+377</option><option value="378">+378</option><option value="380">+380</option><option value="381">+381</option><option value="382">+382</option><option value="385">+385</option><option value="386">+386</option><option value="387">+387</option><option value="389">+389</option><option value="420">+420</option><option value="421">+421</option><option value="423">+423</option><option value="500">+500</option><option value="501">+501</option><option value="502">+502</option><option value="503">+503</option><option value="504">+504</option><option value="505">+505</option><option value="506">+506</option><option value="507">+507</option><option value="508">+508</option><option value="509">+509</option><option value="590">+590</option><option value="591">+591</option><option value="592">+592</option><option value="593">+593</option><option value="594">+594</option><option value="595">+595</option><option value="596">+596</option><option value="597">+597</option><option value="598">+598</option><option value="599">+599</option><option value="670">+670</option><option value="672">+672</option><option value="673">+673</option><option value="674">+674</option><option value="675">+675</option><option value="676">+676</option><option value="677">+677</option><option value="678">+678</option><option value="679">+679</option><option value="680">+680</option><option value="681">+681</option><option value="682">+682</option><option value="683">+683</option><option value="685">+685</option><option value="686">+686</option><option value="687">+687</option><option value="688">+688</option><option value="689">+689</option><option value="690">+690</option><option value="691">+691</option><option value="692">+692</option><option value="852">+852</option><option value="853">+853</option><option value="855">+855</option><option value="856">+856</option><option value="870">+870</option><option value="880">+880</option><option value="886">+886</option><option value="960">+960</option><option value="961">+961</option><option value="962">+962</option><option value="964">+964</option><option value="965">+965</option><option value="966">+966</option><option value="967">+967</option><option value="968">+968</option><option value="970">+970</option><option value="971">+971</option><option value="972">+972</option><option value="973">+973</option><option value="974">+974</option><option value="975">+975</option><option value="976">+976</option><option value="977">+977</option><option value="992">+992</option><option value="993">+993</option><option value="994">+994</option><option value="995">+995</option><option value="996">+996</option><option value="998">+998</option>';
}

function countryList(){
	return '<option value="AF">Afghanistan</option><option value="AX">Aland Islands</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BQ">Bonaire, Sint Eustatius and Saba</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="CV">Cabo Verde</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CD">Congo, Democratic Republic of</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote D\'Ivoire</option><option value="HR">Croatia (Hrvatska)</option><option value="CW">Curacao</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French S Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard and McDonald Isls</option><option value="VA">Holy See (Vatican City State)</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IM">Isle of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KR">Korea (South)</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Lao People\'s Democratic Republic</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macau</option><option value="MK">Macedonia</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MP">Northern Mariana Isls</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PS">Palestinian Territory, Occupied</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russian Federation</option><option value="RW">Rwanda</option><option value="GS">S. Georgia and S. Sandwich Islands</option><option value="BL">Saint Barthelemy</option><option value="SH">Saint Helena, Ascension and Tristan da Cunha</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="MF">Saint Martin (French part)</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="ST">Sao Tome and Principe</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia, Republic of</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SX">Sint Maarten (Dutch part)</option><option value="SK">Slovak Republic</option><option value="SI">Slovenia</option><option value="Sb">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="PM">St. Pierre and Miquelon</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen Islands</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TL">Timor-Leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="US">United States</option><option value="UY">Uruguay</option><option value="UM">US Minor Outlying Isls</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VE">Venezuela</option><option value="VN">Viet Nam</option><option value="VG">Virgin Islands (British)</option><option value="VI">Virgin Islands (U.S.)</option><option value="WF">Wallis and Futuna Isls</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option>';
}

function calculerDistanceGoogleMaps($origine, $destination, $mode) {
    $api_key = 'VOTRE_CLE_API'; // Remplacez par votre clé API Google Maps

    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origine&destinations=$destination&mode=$mode&key=$api_key";

    $response = file_get_contents($url);
    $data = json_decode($response);

    $distance = $data->rows[0]->elements[0]->distance->text;
    $duree = $data->rows[0]->elements[0]->duration->text;

    return array('distance' => $distance, 'duree' => $duree);
}

function utilisation_calculerDistanceGoogleMaps(){
	// Exemple d'utilisation pour la distance à pied
	$origine = 'Paris, France';
	$destination = 'Londres, Royaume-Uni';
	$mode = 'walking';

	$resultat = calculerDistanceGoogleMaps($origine, $destination, $mode);

	echo "Distance à pied entre $origine et $destination : " . $resultat['distance'] . "\n";
	echo "Durée estimée : " . $resultat['duree'] . "\n";
}