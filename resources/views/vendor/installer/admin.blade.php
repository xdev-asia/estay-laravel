@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.admin.title'))
@section('style')
    <link href="{{ asset('installer/froiden-helper/helper.css') }}" rel="stylesheet"/>
    <style>
        .form-control{
            height: 14px;
            width: 100%;
        }
        .has-error{
            color: red;
        }
        .has-error input{
            color: black;
            border:1px solid red;
        }
    </style>
@endsection
@section('container')
    <form method="post" action="{{ route('LaravelInstaller::adminSave') }}" id="env-form">
        <div class="help-block" style="display: none; color: red;"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Admin Username</label>
            <div class="col-sm-10">
                <input type="text" required name="username" class="form-control" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Admin Email</label>
            <div class="col-sm-10">
                <input type="email" required name="email" class="form-control" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Admin Password</label>
            <div class="col-sm-10">
                <input type="password" required name="password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">Password Confirmation</label>
            <div class="col-sm-10">
                <input type="password" required class="form-control" name="password_confirmation">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Site Name</label>
            <div class="col-sm-10">
                <input type="text" required name="site_name" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Site Description</label>
            <div class="col-sm-10">
                <input type="text" name="site_description" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Contact Email</label>
            <div class="col-sm-10">
                <input type="email" required name="contact_email" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Site Curency</label>
            <div class="col-sm-10">
                <select class="category-select form-control" required name="currency_code" style="    height: auto;background: white; border-radius: 0;font-size: 16px;">
                    <option value="AFN">Afghanistan Afghani</option>
                    <option value="ALL">Albania Lek</option>
                    <option value="AMD">Armenia Dram</option>
                    <option value="ANG">Netherlands Antilles Guilder</option>
                    <option value="AOA">Angola Kwanza</option>
                    <option value="ARS">Argentina Peso</option>
                    <option value="AUD">Australia Dollar</option>
                    <option value="AWG">Aruba Guilder</option>
                    <option value="AZN">Azerbaijan New Manat</option>
                    <option value="BAM">Bosnia and Herzegovina Convertible Marka</option>
                    <option value="BBD">Barbados Dollar</option>
                    <option value="BDT">Bangladesh Taka</option>
                    <option value="BGN">Bulgaria Lev</option>
                    <option value="BHD">Bahrain Dinar</option>
                    <option value="BIF">Burundi Franc</option>
                    <option value="BMD">Bermuda Dollar</option>
                    <option value="BND">Brunei Darussalam Dollar</option>
                    <option value="BOB">Bolivia Boliviano</option>
                    <option value="BRL">Brazil Real</option>
                    <option value="BSD">Bahamas Dollar</option>
                    <option value="BTN">Bhutan Ngultrum</option>
                    <option value="BWP">Botswana Pula</option>
                    <option value="BYR">Belarus Ruble</option>
                    <option value="BZD">Belize Dollar</option>
                    <option value="CAD">Canada Dollar</option>
                    <option value="CDF">Congo/Kinshasa Franc</option>
                    <option value="CHF">Switzerland Franc</option>
                    <option value="CLP">Chile Peso</option>
                    <option value="CNY">China Yuan Renminbi</option>
                    <option value="COP">Colombia Peso</option>
                    <option value="CRC">Costa Rica Colon</option>
                    <option value="CUC">Cuba Convertible Peso</option>
                    <option value="CUP">Cuba Peso</option>
                    <option value="CVE">Cape Verde Escudo</option>
                    <option value="CZK">Czech Republic Koruna</option>
                    <option value="DJF">Djibouti Franc</option>
                    <option value="DKK">Denmark Krone</option>
                    <option value="DOP">Dominican Republic Peso</option>
                    <option value="DZD">Algeria Dinar</option>
                    <option value="EGP">Egypt Pound</option>
                    <option value="ERN">Eritrea Nakfa</option>
                    <option value="ETB">Ethiopia Birr</option>
                    <option value="EUR">Euro Member Countries</option>
                    <option value="FJD">Fiji Dollar</option>
                    <option value="FKP">Falkland Islands (Malvinas) Pound</option>
                    <option value="GBP">United Kingdom Pound</option>
                    <option value="GEL">Georgia Lari</option>
                    <option value="GGP">Guernsey Pound</option>
                    <option value="GHS">Ghana Cedi</option>
                    <option value="GIP">Gibraltar Pound</option>
                    <option value="GMD">Gambia Dalasi</option>
                    <option value="GNF">Guinea Franc</option>
                    <option value="GTQ">Guatemala Quetzal</option>
                    <option value="GYD">Guyana Dollar</option>
                    <option value="HKD">Hong Kong Dollar</option>
                    <option value="HNL">Honduras Lempira</option>
                    <option value="HRK">Croatia Kuna</option>
                    <option value="HTG">Haiti Gourde</option>
                    <option value="HUF">Hungary Forint</option>
                    <option value="IDR">Indonesia Rupiah</option>
                    <option value="ILS">Israel Shekel</option>
                    <option value="IMP">Isle of Man Pound</option>
                    <option value="INR">India Rupee</option>
                    <option value="IQD">Iraq Dinar</option>
                    <option value="IRR">Iran Rial</option>
                    <option value="ISK">Iceland Krona</option>
                    <option value="JEP">Jersey Pound</option>
                    <option value="JMD">Jamaica Dollar</option>
                    <option value="JOD">Jordan Dinar</option>
                    <option value="JPY">Japan Yen</option>
                    <option value="KES">Kenya Shilling</option>
                    <option value="KGS">Kyrgyzstan Som</option>
                    <option value="KHR">Cambodia Riel</option>
                    <option value="KMF">Comoros Franc</option>
                    <option value="KPW">Korea (North) Won</option>
                    <option value="KRW">Korea (South) Won</option>
                    <option value="KWD">Kuwait Dinar</option>
                    <option value="KYD">Cayman Islands Dollar</option>
                    <option value="KZT">Kazakhstan Tenge</option>
                    <option value="LAK">Laos Kip</option>
                    <option value="LBP">Lebanon Pound</option>
                    <option value="LKR">Sri Lanka Rupee</option>
                    <option value="LRD">Liberia Dollar</option>
                    <option value="LSL">Lesotho Loti</option>
                    <option value="LYD">Libya Dinar</option>
                    <option value="MAD">Morocco Dirham</option>
                    <option value="MDL">Moldova Leu</option>
                    <option value="MGA">Madagascar Ariary</option>
                    <option value="MKD">Macedonia Denar</option>
                    <option value="MMK">Myanmar (Burma) Kyat</option>
                    <option value="MNT">Mongolia Tughrik</option>
                    <option value="MOP">Macau Pataca</option>
                    <option value="MRO">Mauritania Ouguiya</option>
                    <option value="MUR">Mauritius Rupee</option>
                    <option value="MVR">Maldives (Maldive Islands) Rufiyaa</option>
                    <option value="MWK">Malawi Kwacha</option>
                    <option value="MXN">Mexico Peso</option>
                    <option value="MYR">Malaysia Ringgit</option>
                    <option value="MZN">Mozambique Metical</option>
                    <option value="NAD">Namibia Dollar</option>
                    <option value="NGN">Nigeria Naira</option>
                    <option value="NIO">Nicaragua Cordoba</option>
                    <option value="NOK">Norway Krone</option>
                    <option value="NPR">Nepal Rupee</option>
                    <option value="NZD">New Zealand Dollar</option>
                    <option value="OMR">Oman Rial</option>
                    <option value="PAB">Panama Balboa</option>
                    <option value="PEN">Peru Nuevo Sol</option>
                    <option value="PGK">Papua New Guinea Kina</option>
                    <option value="PHP">Philippines Peso</option>
                    <option value="PKR">Pakistan Rupee</option>
                    <option value="PLN">Poland Zloty</option>
                    <option value="PYG">Paraguay Guarani</option>
                    <option value="QAR">Qatar Riyal</option>
                    <option value="RON">Romania New Leu</option>
                    <option value="RSD">Serbia Dinar</option>
                    <option value="RUB">Russia Ruble</option>
                    <option value="RWF">Rwanda Franc</option>
                    <option value="SAR">Saudi Arabia Riyal</option>
                    <option value="SBD">Solomon Islands Dollar</option>
                    <option value="SCR">Seychelles Rupee</option>
                    <option value="SDG">Sudan Pound</option>
                    <option value="SEK">Sweden Krona</option>
                    <option value="SGD">Singapore Dollar</option>
                    <option value="SHP">Saint Helena Pound</option>
                    <option value="SLL">Sierra Leone Leone</option>
                    <option value="SOS">Somalia Shilling</option>
                    <option value="SPL">Seborga Luigino</option>
                    <option value="SRD">Suriname Dollar</option>
                    <option value="STD">São Tomé and Príncipe Dobra</option>
                    <option value="SVC">El Salvador Colon</option>
                    <option value="SYP">Syria Pound</option>
                    <option value="SZL">Swaziland Lilangeni</option>
                    <option value="THB">Thailand Baht</option>
                    <option value="TJS">Tajikistan Somoni</option>
                    <option value="TMT">Turkmenistan Manat</option>
                    <option value="TND">Tunisia Dinar</option>
                    <option value="TOP">Tonga Pa'anga</option>
                    <option value="TRY">Turkey Lira</option>
                    <option value="TTD">Trinidad and Tobago Dollar</option>
                    <option value="TVD">Tuvalu Dollar</option>
                    <option value="TWD">Taiwan New Dollar</option>
                    <option value="TZS">Tanzania Shilling</option>
                    <option value="UAH">Ukraine Hryvnia</option>
                    <option value="UGX">Uganda Shilling</option>
                    <option value="USD">United States Dollar</option>
                    <option value="UYU">Uruguay Peso</option>
                    <option value="UZS">Uzbekistan Som</option>
                    <option value="VEF">Venezuela Bolivar</option>
                    <option value="VND">Viet Nam Dong</option>
                    <option value="VUV">Vanuatu Vatu</option>
                    <option value="WST">Samoa Tala</option>
                    <option value="XAF">Communauté Financière Africaine (BEAC) CFA Franc BEAC</option>
                    <option value="XCD">East Caribbean Dollar</option>
                    <option value="XDR">International Monetary Fund (IMF) Special Drawing Rights</option>
                    <option value="XOF">Communauté Financière Africaine (BCEAO) Franc</option>
                    <option value="XPF">Comptoirs Français du Pacifique (CFP) Franc</option>
                    <option value="YER">Yemen Rial</option>
                    <option value="ZAR">South Africa Rand</option>
                    <option value="ZMW">Zambia Kwacha</option>
                    <option value="ZWD">Zimbabwe Dollar</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Currency Symbol</label>
            <div class="col-sm-10">
                <input type="text" required name="currency_symbol" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <div class="buttons">
                <a href="#" class="button submit-form">
                    {{ trans('installer_messages.next') }}
                </a>
            </div>
        </div>
        {{  csrf_field() }}
    </form>
@stop
@section('scripts')
    <script src="{{ asset('installer/js/jQuery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('installer/froiden-helper/helper.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.submit-form').click(function(e){
                e.preventDefault();
                var email = $('[name="email"]').val(), password = $('[name="password"]').val(), password_confirmation = $('[name="password_confirmation"]').val(), site_name = $('[name="site_name"]').val(), site_description = $('[name="site_description"]').val(), contact_email = $('[name="contact_email"]').val(), username = $('[name="username"]').val(), currency_code = $('[name="currency_code"]').val(), currency_symbol = $('[name="currency_symbol"]').val();
                $.easyAjax({
                    url: "{!! route('LaravelInstaller::adminSave') !!}",
                    type: "post",
                    data: {email:email, username: username, password: password, password_confirmation:password_confirmation, site_name:site_name, site_description:site_description, currency_code: currency_code, currency_symbol: currency_symbol, contact_email:contact_email, _token:$('[name="_token"]').val()},
                    container: "#env-form",
                    messagePosition: "inline",
                    beforeSend: function(){
                        $('.help-block').hide();
                    },
                    success: function(data){
                        location.href  = '{{  url('install/final') }}';
                    }, error: function(data){
                        $('.help-block').html(data.responseJSON).show();
                    }
                });
            });
        });
    </script>
@endsection