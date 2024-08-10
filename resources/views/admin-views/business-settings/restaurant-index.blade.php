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
                                    <option value="DZ">Algeria</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label">{{translate('time_zone')}}</label>
                                <select name="time_zone" id="time_zone" data-maximum-selection-length="3" class="form-control js-select2-custom">
                                <option value='Africa/Lagos'>(UTC+01:00) West Central Africa</option>                                   
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
