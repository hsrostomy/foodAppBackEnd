@extends('layouts.admin.app')

@section('title', translate('Business Settings'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/icons/business_setup2.png')}}" alt="">
                <span class="page-header-title">
                    {{translate('business_setup')}}
                </span>
            </h2>
        </div>

        @include('admin-views.business-settings.partials._business-setup-inline-menu')

        <div class="card my-3">
            <div class="card-body" >
                <div class="d-flex justify-content-between align-items-center border rounded mb-2 px-3 py-2">
                    @php($config=\App\CentralLogics\Helpers::get_business_settings('maintenance_mode'))
                    <h5 class="mb-0 c1">
                        {{translate('maintenance_mode')}}
                    </h5>

                    <label class="switcher ml-auto mb-0">
                        <input type="checkbox" class="switcher_input" onclick="maintenance_mode()"
                            {{isset($config) && $config?'checked':''}}>
                        <span class="switcher_control"></span>
                    </label>
                </div>
                <p class="fz-12 mb-0">*{{ translate('By turning on maintenance mode, all your app and customer side website will be off. Only admin panel and seller panel will be functional') }}</p>
            </div>
        </div>

        <form action="{{route('admin.business-settings.restaurant.update-setup')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="tio-user"></i>
                        {{translate('Company Information')}}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php($restaurant_name=\App\CentralLogics\Helpers::get_business_settings('restaurant_name'))
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label text-capitalize">{{translate('Company Name')}}</label>
                                <input type="text" value="{{$restaurant_name}}"
                                       name="restaurant_name" class="form-control" placeholder="{{translate('Ex: ABC Company')}}">
                            </div>
                        </div>

                        @php($phone=\App\CentralLogics\Helpers::get_business_settings('phone'))
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label text-capitalize">{{translate('phone')}}</label>
                                <input type="text" value="{{$phone}}"
                                       name="phone" class="form-control" placeholder="{{translate('Ex: +9xxx-xxx-xxxx')}}">
                            </div>
                        </div>

                        @php($email=\App\CentralLogics\Helpers::get_business_settings('email_address'))
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label text-capitalize">{{translate('email')}}</label>
                                <input type="email" value="{{$email}}"
                                       name="email" class="form-control" placeholder="{{translate('Ex: contact@company.com')}}">
                            </div>
                        </div>

                        @php($address=\App\CentralLogics\Helpers::get_business_settings('address'))
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label text-capitalize">{{translate('address')}}</label>
                                <textarea name="address" class="form-control" placeholder="{{translate('Ex: ABC Company')}}">{{$address}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            @php($logo=\App\Model\BusinessSetting::where('key','logo')->first()->value)
                            <div class="form-group">
                                <label class="text-dark">{{translate('logo')}}</label><small style="color: red">*
                                    ( {{translate('ratio')}} 3:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="logo" id="customFileEg1" class="custom-file-input"
                                           accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label"
                                           for="customFileEg1">{{translate('choose_File')}}</label>
                                </div>

                                <div class="text-center mt-3">
                                    <img style="height: 100px;border: 1px solid; border-radius: 10px;" id="viewer"
                                         onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'"
                                         src="{{asset('storage/app/public/restaurant/'.$logo)}}" alt="logo image"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            @php($fav_icon=\App\Model\BusinessSetting::where('key','fav_icon')->first()->value)
                            <div class="form-group">
                                <label class="text-dark">{{translate('Fav Icon')}}</label><small style="color: red">*
                                    ( {{translate('ratio')}} 1:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="fav_icon" id="customFileEg2" class="custom-file-input"
                                           accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label"
                                           for="customFileEg2">{{translate('choose_File')}}</label>
                                </div>

                                <div class="text-center mt-3">
                                    <img style="height: 100px;border: 1px solid; border-radius: 10px;" id="viewer_2"
                                         onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'"
                                         src="{{asset('storage/app/public/restaurant/'.$fav_icon)}}" alt="fav"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="tio-briefcase mr-1"></i>
                        {{translate('Business Information')}}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="country">{{translate('country')}}</label>
                                <select id="country" name="country" class="form-control js-select2-custom">
                                    <option value="AF">Afghanistan</option>
                                    <option value="AX">Åland Islands</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AQ">Antarctica</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia, Plurinational State of</option>
                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BV">Bouvet Island</option>
                                    <option value="BR">Brazil</option>
                                    <option value="IO">British Indian Ocean Territory</option>
                                    <option value="BN">Brunei Darussalam</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CV">Cape Verde</option>
                                    <option value="KY">Cayman Islands</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CX">Christmas Island</option>
                                    <option value="CC">Cocos (Keeling) Islands</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CG">Congo</option>
                                    <option value="CD">Congo, the Democratic Republic of the</option>
                                    <option value="CK">Cook Islands</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Côte d'Ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CW">Curaçao</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                    <option value="FO">Faroe Islands</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="GF">French Guiana</option>
                                    <option value="PF">French Polynesia</option>
                                    <option value="TF">French Southern Territories</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GR">Greece</option>
                                    <option value="GL">Greenland</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GP">Guadeloupe</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GG">Guernsey</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="GY">Guyana</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HM">Heard Island and McDonald Islands</option>
                                    <option value="VA">Holy See (Vatican City State)</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IR">Iran, Islamic Republic of</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IM">Isle of Man</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JE">Jersey</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                    <option value="KR">Korea, Republic of</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Lao People's Democratic Republic</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macao</option>
                                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="YT">Mayotte</option>
                                    <option value="MX">Mexico</option>
                                    <option value="FM">Micronesia, Federated States of</option>
                                    <option value="MD">Moldova, Republic of</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="NC">New Caledonia</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NU">Niue</option>
                                    <option value="NF">Norfolk Island</option>
                                    <option value="MP">Northern Mariana Islands</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau</option>
                                    <option value="PS">Palestinian Territory, Occupied</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PN">Pitcairn</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RE">Réunion</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russian Federation</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="BL">Saint Barthélemy</option>
                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                    <option value="KN">Saint Kitts and Nevis</option>
                                    <option value="LC">Saint Lucia</option>
                                    <option value="MF">Saint Martin (French part)</option>
                                    <option value="PM">Saint Pierre and Miquelon</option>
                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome and Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                    <option value="SS">South Sudan</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                    <option value="SZ">Swaziland</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syrian Arab Republic</option>
                                    <option value="TW">Taiwan, Province of China</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania, United Republic of</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TL">Timor-Leste</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TC">Turks and Caicos Islands</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="UM">United States Minor Outlying Islands</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                    <option value="VN">Viet Nam</option>
                                    <option value="VG">Virgin Islands, British</option>
                                    <option value="VI">Virgin Islands, U.S.</option>
                                    <option value="WF">Wallis and Futuna</option>
                                    <option value="EH">Western Sahara</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label">{{translate('time_zone')}}</label>
                                <select name="time_zone" id="time_zone" data-maximum-selection-length="3" class="form-control js-select2-custom">
                                    <option value='Pacific/Midway'>(UTC-11:00) Midway Island</option>
                                    <option value='Pacific/Samoa'>(UTC-11:00) Samoa</option>
                                    <option value='Pacific/Honolulu'>(UTC-10:00) Hawaii</option>
                                    <option value='US/Alaska'>(UTC-09:00) Alaska</option>
                                    <option value='America/Los_Angeles'>(UTC-08:00) Pacific Time (US &amp; Canada)</option>
                                    <option value='America/Tijuana'>(UTC-08:00) Tijuana</option>
                                    <option value='US/Arizona'>(UTC-07:00) Arizona</option>
                                    <option value='America/Chihuahua'>(UTC-07:00) Chihuahua</option>
                                    <option value='America/Chihuahua'>(UTC-07:00) La Paz</option>
                                    <option value='America/Mazatlan'>(UTC-07:00) Mazatlan</option>
                                    <option value='US/Mountain'>(UTC-07:00) Mountain Time (US &amp; Canada)</option>
                                    <option value='America/Managua'>(UTC-06:00) Central America</option>
                                    <option value='US/Central'>(UTC-06:00) Central Time (US &amp; Canada)</option>
                                    <option value='America/Mexico_City'>(UTC-06:00) Guadalajara</option>
                                    <option value='America/Mexico_City'>(UTC-06:00) Mexico City</option>
                                    <option value='America/Monterrey'>(UTC-06:00) Monterrey</option>
                                    <option value='Canada/Saskatchewan'>(UTC-06:00) Saskatchewan</option>
                                    <option value='America/Bogota'>(UTC-05:00) Bogota</option>
                                    <option value='US/Eastern'>(UTC-05:00) Eastern Time (US &amp; Canada)</option>
                                    <option value='US/East-Indiana'>(UTC-05:00) Indiana (East)</option>
                                    <option value='America/Lima'>(UTC-05:00) Lima</option>
                                    <option value='America/Bogota'>(UTC-05:00) Quito</option>
                                    <option value='Canada/Atlantic'>(UTC-04:00) Atlantic Time (Canada)</option>
                                    <option value='America/Caracas'>(UTC-04:30) Caracas</option>
                                    <option value='America/La_Paz'>(UTC-04:00) La Paz</option>
                                    <option value='America/Santiago'>(UTC-04:00) Santiago</option>
                                    <option value='Canada/Newfoundland'>(UTC-03:30) Newfoundland</option>
                                    <option value='America/Sao_Paulo'>(UTC-03:00) Brasilia</option>
                                    <option value='America/Argentina/Buenos_Aires'>(UTC-03:00) Buenos Aires</option>
                                    <option value='America/Argentina/Buenos_Aires'>(UTC-03:00) Georgetown</option>
                                    <option value='America/Godthab'>(UTC-03:00) Greenland</option>
                                    <option value='America/Noronha'>(UTC-02:00) Mid-Atlantic</option>
                                    <option value='Atlantic/Azores'>(UTC-01:00) Azores</option>
                                    <option value='Atlantic/Cape_Verde'>(UTC-01:00) Cape Verde Is.</option>
                                    <option value='Africa/Casablanca'>(UTC+00:00) Casablanca</option>
                                    <option value='Europe/London'>(UTC+00:00) Edinburgh</option>
                                    <option value='Etc/Greenwich'>(UTC+00:00) Greenwich Mean Time : Dublin</option>
                                    <option value='Europe/Lisbon'>(UTC+00:00) Lisbon</option>
                                    <option value='Europe/London'>(UTC+00:00) London</option>
                                    <option value='Africa/Monrovia'>(UTC+00:00) Monrovia</option>
                                    <option value='UTC'>(UTC+00:00) UTC</option>
                                    <option value='Europe/Amsterdam'>(UTC+01:00) Amsterdam</option>
                                    <option value='Europe/Belgrade'>(UTC+01:00) Belgrade</option>
                                    <option value='Europe/Berlin'>(UTC+01:00) Berlin</option>
                                    <option value='Europe/Berlin'>(UTC+01:00) Bern</option>
                                    <option value='Europe/Bratislava'>(UTC+01:00) Bratislava</option>
                                    <option value='Europe/Brussels'>(UTC+01:00) Brussels</option>
                                    <option value='Europe/Budapest'>(UTC+01:00) Budapest</option>
                                    <option value='Europe/Copenhagen'>(UTC+01:00) Copenhagen</option>
                                    <option value='Europe/Ljubljana'>(UTC+01:00) Ljubljana</option>
                                    <option value='Europe/Madrid'>(UTC+01:00) Madrid</option>
                                    <option value='Europe/Paris'>(UTC+01:00) Paris</option>
                                    <option value='Europe/Prague'>(UTC+01:00) Prague</option>
                                    <option value='Europe/Rome'>(UTC+01:00) Rome</option>
                                    <option value='Europe/Sarajevo'>(UTC+01:00) Sarajevo</option>
                                    <option value='Europe/Skopje'>(UTC+01:00) Skopje</option>
                                    <option value='Europe/Stockholm'>(UTC+01:00) Stockholm</option>
                                    <option value='Europe/Vienna'>(UTC+01:00) Vienna</option>
                                    <option value='Europe/Warsaw'>(UTC+01:00) Warsaw</option>
                                    <option value='Africa/Lagos'>(UTC+01:00) West Central Africa</option>
                                    <option value='Europe/Zagreb'>(UTC+01:00) Zagreb</option>
                                    <option value='Europe/Athens'>(UTC+02:00) Athens</option>
                                    <option value='Europe/Bucharest'>(UTC+02:00) Bucharest</option>
                                    <option value='Africa/Cairo'>(UTC+02:00) Cairo</option>
                                    <option value='Africa/Harare'>(UTC+02:00) Harare</option>
                                    <option value='Europe/Helsinki'>(UTC+02:00) Helsinki</option>
                                    <option value='Europe/Istanbul'>(UTC+02:00) Istanbul</option>
                                    <option value='Asia/Jerusalem'>(UTC+02:00) Jerusalem</option>
                                    <option value='Europe/Helsinki'>(UTC+02:00) Kyiv</option>
                                    <option value='Africa/Johannesburg'>(UTC+02:00) Pretoria</option>
                                    <option value='Europe/Riga'>(UTC+02:00) Riga</option>
                                    <option value='Europe/Sofia'>(UTC+02:00) Sofia</option>
                                    <option value='Europe/Tallinn'>(UTC+02:00) Tallinn</option>
                                    <option value='Europe/Vilnius'>(UTC+02:00) Vilnius</option>
                                    <option value='Asia/Baghdad'>(UTC+03:00) Baghdad</option>
                                    <option value='Asia/Kuwait'>(UTC+03:00) Kuwait</option>
                                    <option value='Europe/Minsk'>(UTC+03:00) Minsk</option>
                                    <option value='Africa/Nairobi'>(UTC+03:00) Nairobi</option>
                                    <option value='Asia/Riyadh'>(UTC+03:00) Riyadh</option>
                                    <option value='Europe/Volgograd'>(UTC+03:00) Volgograd</option>
                                    <option value='Asia/Tehran'>(UTC+03:30) Tehran</option>
                                    <option value='Asia/Muscat'>(UTC+04:00) Abu Dhabi</option>
                                    <option value='Asia/Baku'>(UTC+04:00) Baku</option>
                                    <option value='Europe/Moscow'>(UTC+04:00) Moscow</option>
                                    <option value='Asia/Muscat'>(UTC+04:00) Muscat</option>
                                    <option value='Europe/Moscow'>(UTC+04:00) St. Petersburg</option>
                                    <option value='Asia/Tbilisi'>(UTC+04:00) Tbilisi</option>
                                    <option value='Asia/Yerevan'>(UTC+04:00) Yerevan</option>
                                    <option value='Asia/Kabul'>(UTC+04:30) Kabul</option>
                                    <option value='Asia/Karachi'>(UTC+05:00) Islamabad</option>
                                    <option value='Asia/Karachi'>(UTC+05:00) Karachi</option>
                                    <option value='Asia/Tashkent'>(UTC+05:00) Tashkent</option>
                                    <option value='Asia/Calcutta'>(UTC+05:30) Chennai</option>
                                    <option value='Asia/Kolkata'>(UTC+05:30) Kolkata</option>
                                    <option value='Asia/Calcutta'>(UTC+05:30) Mumbai</option>
                                    <option value='Asia/Calcutta'>(UTC+05:30) New Delhi</option>
                                    <option value='Asia/Calcutta'>(UTC+05:30) Sri Jayawardenepura</option>
                                    <option value='Asia/Katmandu'>(UTC+05:45) Kathmandu</option>
                                    <option value='Asia/Almaty'>(UTC+06:00) Almaty</option>
                                    <option value='Asia/Dhaka'>(UTC+06:00) Dhaka</option>
                                    <option value='Asia/Yekaterinburg'>(UTC+06:00) Ekaterinburg</option>
                                    <option value='Asia/Rangoon'>(UTC+06:30) Rangoon</option>
                                    <option value='Asia/Bangkok'>(UTC+07:00) Bangkok</option>
                                    <option value='Asia/Bangkok'>(UTC+07:00) Hanoi</option>
                                    <option value='Asia/Jakarta'>(UTC+07:00) Jakarta</option>
                                    <option value='Asia/Novosibirsk'>(UTC+07:00) Novosibirsk</option>
                                    <option value='Asia/Hong_Kong'>(UTC+08:00) Beijing</option>
                                    <option value='Asia/Chongqing'>(UTC+08:00) Chongqing</option>
                                    <option value='Asia/Hong_Kong'>(UTC+08:00) Hong Kong</option>
                                    <option value='Asia/Krasnoyarsk'>(UTC+08:00) Krasnoyarsk</option>
                                    <option value='Asia/Kuala_Lumpur'>(UTC+08:00) Kuala Lumpur</option>
                                    <option value='Australia/Perth'>(UTC+08:00) Perth</option>
                                    <option value='Asia/Singapore'>(UTC+08:00) Singapore</option>
                                    <option value='Asia/Taipei'>(UTC+08:00) Taipei</option>
                                    <option value='Asia/Ulan_Bator'>(UTC+08:00) Ulaan Bataar</option>
                                    <option value='Asia/Urumqi'>(UTC+08:00) Urumqi</option>
                                    <option value='Asia/Irkutsk'>(UTC+09:00) Irkutsk</option>
                                    <option value='Asia/Tokyo'>(UTC+09:00) Osaka</option>
                                    <option value='Asia/Tokyo'>(UTC+09:00) Sapporo</option>
                                    <option value='Asia/Seoul'>(UTC+09:00) Seoul</option>
                                    <option value='Asia/Tokyo'>(UTC+09:00) Tokyo</option>
                                    <option value='Australia/Adelaide'>(UTC+09:30) Adelaide</option>
                                    <option value='Australia/Darwin'>(UTC+09:30) Darwin</option>
                                    <option value='Australia/Brisbane'>(UTC+10:00) Brisbane</option>
                                    <option value='Australia/Canberra'>(UTC+10:00) Canberra</option>
                                    <option value='Pacific/Guam'>(UTC+10:00) Guam</option>
                                    <option value='Australia/Hobart'>(UTC+10:00) Hobart</option>
                                    <option value='Australia/Melbourne'>(UTC+10:00) Melbourne</option>
                                    <option value='Pacific/Port_Moresby'>(UTC+10:00) Port Moresby</option>
                                    <option value='Australia/Sydney'>(UTC+10:00) Sydney</option>
                                    <option value='Asia/Yakutsk'>(UTC+10:00) Yakutsk</option>
                                    <option value='Asia/Vladivostok'>(UTC+11:00) Vladivostok</option>
                                    <option value='Pacific/Auckland'>(UTC+12:00) Auckland</option>
                                    <option value='Pacific/Fiji'>(UTC+12:00) Fiji</option>
                                    <option value='Pacific/Kwajalein'>(UTC+12:00) International Date Line West</option>
                                    <option value='Asia/Kamchatka'>(UTC+12:00) Kamchatka</option>
                                    <option value='Asia/Magadan'>(UTC+12:00) Magadan</option>
                                    <option value='Pacific/Fiji'>(UTC+12:00) Marshall Is.</option>
                                    <option value='Asia/Magadan'>(UTC+12:00) New Caledonia</option>
                                    <option value='Asia/Magadan'>(UTC+12:00) Solomon Is.</option>
                                    <option value='Pacific/Auckland'>(UTC+12:00) Wellington</option>
                                    <option value='Pacific/Tongatapu'>(UTC+13:00) Nuku'alofa</option>
                                </select>
                            </div>
                        </div>
                        @php($time_format=\App\CentralLogics\Helpers::get_business_settings('time_format') ?? '24')
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label text-capitalize">{{translate('time_format')}}</label>
                                <select name="time_format" class="form-control js-select2-custom">
                                    <option value="12" {{$time_format=='12'?'selected':''}}>{{translate('12_hour')}}</option>
                                    <option value="24" {{$time_format=='24'?'selected':''}}>{{translate('24_hour')}}</option>
                                </select>
                            </div>
                        </div>

                        @php($currency_code=\App\Model\BusinessSetting::where('key','currency')->first()->value)
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label">{{translate('currency')}}</label>
                                <select name="currency" class="form-control js-select2-custom">
                                    @foreach(\App\Model\Currency::orderBy('currency_code')->get() as $currency)
                                        <option value="{{$currency['currency_code']}}" {{$currency_code==$currency['currency_code']?'selected':''}}>
                                            {{$currency['currency_code']}} ( {{$currency['currency_symbol']}} )
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label">{{translate('Currency_Position')}}</label>
                                <div class="">
                                    @php($config=\App\CentralLogics\Helpers::get_business_settings('currency_symbol_position'))
                                    <!-- Custom Radio -->
                                    <div class="form-control d-flex flex-column-2">
                                        <div class="custom-radio d-flex gap-2 align-items-center"
                                             onclick="currency_symbol_position('{{route('admin.business-settings.currency-position',['left'])}}')">
                                            <input type="radio" class=""
                                                   name="projectViewNewProjectTypeRadio"
                                                   id="projectViewNewProjectTypeRadio1" {{(isset($config) && $config=='left')?'checked':''}}>
                                            <label class="media align-items-center mb-0"
                                                   for="projectViewNewProjectTypeRadio1">
                                                    <span class="media-body">
                                                        ({{\App\CentralLogics\Helpers::currency_symbol()}}) {{translate('Left')}}
                                                    </span>
                                            </label>
                                        </div>

                                        <div class="custom-radio d-flex gap-2 align-items-center"
                                             onclick="currency_symbol_position('{{route('admin.business-settings.currency-position',['right'])}}')">
                                            <input type="radio" class=""
                                                   name="projectViewNewProjectTypeRadio"
                                                   id="projectViewNewProjectTypeRadio2" {{(isset($config) && $config=='right')?'checked':''}}>
                                            <label class="media align-items-center mb-0"
                                                   for="projectViewNewProjectTypeRadio2">
                                                    <span class="media-body">
                                                        Right ({{\App\CentralLogics\Helpers::currency_symbol()}})
                                                    </span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End Custom Radio -->
                                </div>
                            </div>
                        </div>
                        @php($decimal_point_settings=\App\CentralLogics\Helpers::get_business_settings('decimal_point_settings'))
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label text-capitalize">{{translate('digit_After_Decimal_Point ')}}({{translate(' ex: 0.00')}})</label>
                                <input type="number" value="{{$decimal_point_settings}}"
                                       name="decimal_point_settings" class="form-control" placeholder="{{translate('Ex: 2')}}"
                                       required>
                            </div>
                        </div>
                        @php($footer_text=\App\Model\BusinessSetting::where('key','footer_text')->first()->value)
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="input-label">{{translate('Company_Copyright_Text')}}</label>
                                <input type="text" value="{{$footer_text}}" name="footer_text" class="form-control"
                                       placeholder="{{translate('Ex: Copyright@efood.com')}}" required>
                            </div>
                        </div>
                        @php($pagination_limit=\App\Model\BusinessSetting::where('key','pagination_limit')->first()->value)
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="input-label">{{translate('pagination')}}</label>
                                <input type="number" value="{{$pagination_limit}}" min="0"
                                       name="pagination_limit" class="form-control" placeholder="{{translate('Ex: 10')}}" required>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4">
                            @php($sp=\App\CentralLogics\Helpers::get_business_settings('self_pickup'))
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <label class="text-dark mb-0">{{translate('self_pickup')}}
                                        <i class="tio-info-outined"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ translate('When this option is enabled the user may pick up their own order. ') }}">
                                        </i>
                                    </label>
                                </div>
                                <label class="switcher">
                                    <input class="switcher_input" type="checkbox" name="self_pickup" {{$sp == null || $sp == 0? '' : 'checked'}} id="self_pickup_btn">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4">
                            @php($del=\App\CentralLogics\Helpers::get_business_settings('delivery'))
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <label class="text-dark mb-0">{{translate('delivery')}}
                                        <i class="tio-info-outined"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ translate('If this option is turned off, the user will not receive home delivery.') }}">
                                        </i>
                                    </label>
                                </div>
                                <label class="switcher">
                                    <input readonly class="switcher_input" type="checkbox" name="delivery"  {{$del == null || $del == 0? '' : 'checked'}} id="delivery_btn">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-4">
                            @php($vnv_status=\App\CentralLogics\Helpers::get_business_settings('toggle_veg_non_veg'))
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <label class="text-dark mb-0">{{translate('Veg / Non Veg Option')}}
                                        <i class="tio-info-outined"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ translate('The system will not display any categories based on veg and non veg products if this option is disabled') }}">
                                        </i>
                                    </label>
                                </div>
                                <label class="switcher">
                                    <input class="switcher_input" type="checkbox" name="toggle_veg_non_veg" {{$vnv_status == null || $vnv_status == 0? '' : 'checked'}} id="toggle_veg_non_veg">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4">
                            @php($ev=\App\Model\BusinessSetting::where('key','email_verification')->first()->value)
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <label class="text-dark mb-0">{{translate('email verification')}}
                                        <i class="tio-info-outined"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ translate('If this field is active customers have to verify their email verification through an OTP.') }}">
                                        </i>
                                    </label>
                                </div>
                                <label class="switcher">
                                    <input name="email_verification" class="switcher_input" type="checkbox" {{$ev == 1? 'checked' : ''}} id="email_verification_on">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-4">
                            @php($pv=\App\CentralLogics\Helpers::get_business_settings('phone_verification'))
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <label class="text-dark mb-0">{{translate('phone verification ( OTP )')}}
                                        <i class="tio-info-outined"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ translate('If this field is active customers have to verify their phone number through an OTP.') }}">
                                        </i>
                                    </label>
                                </div>

                                <label class="switcher">
                                    <input class="switcher_input" type="checkbox" name="phone_verification" {{$pv == 1? 'checked' : ''}} id="phone_verification_on">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4">
                            @php($dm_status=\App\CentralLogics\Helpers::get_business_settings('dm_self_registration'))
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <label class="text-dark mb-0">{{translate('Deliveryman Self Registration')}}
                                        <i class="tio-info-outined"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ translate('When this field is active  delivery men can register themself using the delivery man app.') }}">
                                        </i>
                                    </label>
                                </div>
                                <label class="switcher">
                                    <input class="switcher_input" type="checkbox" name="dm_self_registration" {{$dm_status == null || $dm_status == 0? '' : 'checked'}} id="dm_self_registration">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4">
                            @php($guest_checkout=\App\CentralLogics\Helpers::get_business_settings('guest_checkout'))
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <label class="text-dark mb-0">{{translate('Guest Checkout')}}
                                        <i class="tio-info-outined"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ translate('When this option is active, users may place orders as guests without logging in.') }}">
                                        </i>
                                    </label>
                                </div>
                                <label class="switcher">
                                    <input class="switcher_input" type="checkbox" name="guest_checkout" {{$guest_checkout == null || $guest_checkout == 0? '' : 'checked'}} id="guest_checkout">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4">
                            @php($partial_payment=\App\CentralLogics\Helpers::get_business_settings('partial_payment'))
                            <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <label class="text-dark mb-0">{{translate('Partial Payment')}}
                                        <i class="tio-info-outined"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ translate('When this option is enabled, users may pay up to a certain amount using their wallet balance.') }}">
                                        </i>
                                    </label>
                                </div>
                                <label class="switcher">
                                    <input class="switcher_input" type="checkbox" name="partial_payment" {{$partial_payment == null || $partial_payment == 0? '' : 'checked'}} id="partial_payment">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            @php($combine_with=\App\CentralLogics\Helpers::get_business_settings('partial_payment_combine_with'))
                            <div class="form-group">
                                <label class="input-label">{{translate('Combine Payment With')}}
                                    <i class="tio-info-outined"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{ translate('The wallet balance will be combined with the chosen payment method to complete the transaction.') }}">
                                    </i>
                                </label>
                                <select name="partial_payment_combine_with" class="form-control">
                                    <option value="COD" {{(isset($combine_with) && $combine_with=='COD')?'selected':''}}>COD</option>
                                    <option value="digital_payment" {{(isset($combine_with) && $combine_with=='digital_payment')?'selected':''}}>Digital Payment</option>
                                    <option value="offline_payment" {{(isset($combine_with) && $combine_with=='offline_payment')?'selected':''}}>Offline Payment</option>
                                    <option value="all" {{(isset($combine_with) && $combine_with=='all')?'selected':''}}>All</option>
                                </select>
                            </div>
                        </div>
                        @php($footer_text=\App\Model\BusinessSetting::where('key','footer_description_text')->first()->value)
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="input-label">{{translate('footer_description_text')}}</label>
                                <input type="text" value="{{$footer_text}}" name="footer_description_text" class="form-control"
                                       placeholder="{{translate('Ex: description')}}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn--container mt-4">
                <button type="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                        class="btn btn-primary call-demo">{{translate('submit')}}</button>
            </div>
        </form>
    </div>
@endsection

@push('script_2')
    <script>
        $(document).on('ready', function () {
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    <script>
        @php($time_zone=\App\Model\BusinessSetting::where('key','time_zone')->first())
        @php($time_zone = $time_zone->value ?? null)
        $('[name=time_zone]').val("{{$time_zone}}");

        @php($language=\App\Model\BusinessSetting::where('key','language')->first())
        @php($language = $language->value ?? null)
        let language = <?php echo($language); ?>;
        $('[id=language]').val(language);

        function readURL(input, viewer) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + viewer).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this, 'viewer');
        });

        $("#customFileEg2").change(function() {
            readURL(this, 'viewer_2');
        });

        $("#language").on("change", function () {
            $("#alert_box").css("display", "block");
        });
    </script>

    <script>
        @if(env('APP_MODE')=='demo')
        function maintenance_mode() {
            toastr.info('{{translate('Disabled for demo version!')}}')
        }
        @else
        function maintenance_mode() {
            Swal.fire({
                title: '{{translate('Are you sure?')}}',
                text: '{{translate('Be careful before you turn on/off maintenance mode')}}',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#377dff',
                cancelButtonText: '{{translate('No')}}',
                confirmButtonText:'{{translate('Yes')}}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.get({
                        url: '{{route('admin.business-settings.maintenance-mode')}}',
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            $('#loading').show();
                        },
                        success: function (data) {
                            toastr.success(data.message);
                        },
                        complete: function () {
                            $('#loading').hide();
                        },
                    });
                } else {
                    location.reload();
                }
            })
        };
        @endif

        function currency_symbol_position(route) {
            $.get({
                url: route,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    toastr.success(data.message);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        $(document).on('ready', function () {
            @php($country=\App\CentralLogics\Helpers::get_business_settings('country')??'BD')
            $("#country option[value='{{$country}}']").attr('selected', 'selected').change();
        })
    </script>

    <script>
        $(document).ready(function () {
            const message = "{{translate('Both Phone & Email verification can not be active at a time')}}";
            $("#phone_verification_on").click(function () {
                if ($('#phone_verification_on').prop("checked") === true) {
                    $('#email_verification_on').prop("checked") === true ? toastr.info(message) : '';
                    $('#email_verification_on').prop("checked", false);
                }
            });
            $("#email_verification_on").click(function () {
                if ($('#email_verification_on').prop("checked") === true) {
                    $('#phone_verification_on').prop("checked") === true ? toastr.info(message) : '';
                    $('#phone_verification_on').prop("checked", false);
                }
            });
        });

        $(document).ready(function() {
            function validateCheckboxes() {
                if (!$('#self_pickup_btn').prop('checked') && !$('#delivery_btn').prop('checked')) {
                    if (event.target.id === 'self_pickup_btn') {
                        $('#delivery_btn').prop('checked', true);
                    } else {
                        $('#self_pickup_btn').prop('checked', true);
                    }
                }
            }

            $('#self_pickup_btn').change(validateCheckboxes);
            $('#delivery_btn').change(validateCheckboxes);
        });
    </script>
@endpush
