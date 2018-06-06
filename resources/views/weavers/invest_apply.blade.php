@extends('layouts.public_form')
@section('custom_style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<style>
    input[type=text],{ width: 100%; height: 20px;}
</style>
@stop
@section('content')
    @if ($errors->any())
        <div >
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('formErrorStatus'))
    <div class="alert alert-danger"><center><b>{{ session('formErrorStatus') }}</b></center></div>
    @endif
    @if (session('formSuccessStatus'))
    <div class="alert alert-success"><center><b>{{ session('formSuccessStatus') }}</b></center></div>
    @endif
    <h2 align="center"> Department of Handlooms &amp; TextilesGovernment of KarnatakaNuthana javali Neethi 2013-2018</h2>
    <h3 class="text-center"><u>Common Application Form-A</u></h3>
    <div class="form-content" style="background: #f2f2f2; max-width: 1000px; padding: 15px; margin: 0 auto;">
        <form action="{{url('weavers/invest-apply')}}" id="formThree" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table style="width:100%" class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td width="10px">1.</td>
                        <td>Registration Number (As provided by DH&amp;T,GoK): </td>
                        <td width="30px">
                            {{ Form::text('regno') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Name of the unit: </td>
                        <td>
                            {{ Form::text('unit_name') }}
                            <span class="error"></span>
            
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Registered Address of Company: </td>
                        <td>
                            {{ Form::text('company_address') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Address of the Unit: </td>
                        <td>
                            {{ Form::text('unit_address') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>a.&nbsp; &nbsp; City/Town: </td>
                        <td>
                            {{ Form::text('unit_city') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>b.&nbsp; &nbsp;Pin Code:
                        </td>
                        <td>
                            {{ Form::text('unit_pin') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Zone (Annexure 10)
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>New Unit
                        </td>
                        <td>
                        {{ Form::checkbox('zone_new[]', 'Zone1','',array('id'=>'Zone1')) }} {{ Form::label('Zone1', 'Zone1', array('for' => 'Zone1')) }}
                        {{ Form::checkbox('zone_new[]', 'Zone2','',array('id'=>'Zone2')) }} {{ Form::label('Zone2', 'Zone2', array('for' => 'Zone2')) }}
                        {{ Form::checkbox('zone_new[]', 'Zone3','',array('id'=>'Zone3')) }} {{ Form::label('Zone3', 'Zone3', array('for' => 'Zone3')) }}
                        {{ Form::checkbox('zone_new[]', 'BTZ','',array('id'=>'BTZ')) }} {{ Form::label('BTZ', 'BTZ', array('for' => 'BTZ')) }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Existing Unit
                        </td>
                        <td>
                        {{ Form::checkbox('zone_old[]', 'Zone1','',array('id'=>'Zone1o')) }} {{ Form::label('Zone1o', 'Zone1') }}
                        {{ Form::checkbox('zone_old[]', 'Zone2','',array('id'=>'Zone2o')) }} {{ Form::label('Zone2o', 'Zone2') }}
                        {{ Form::checkbox('zone_old[]', 'Zone3','',array('id'=>'Zone3o')) }} {{ Form::label('Zone3o', 'Zone3') }}
                        </td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Registration<br>(As mentioned Entrepreneur Memorandum (EM))
                        </td>
                        <td>
                            <table class="table">
                                <tr>
                                    <td>Regno</td>
                                    <td>{{ Form::text('em_regno') }}<span class="error"></span></td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>{{ Form::text('em_regdate') }}<span class="error"></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>VAT Registration No and Date:(Copy Enclose)
                        </td>
                        <td>
                        <table class="table">
                                <tr>
                                    <td>Regno</td>
                                    <td>{{ Form::text('vat_regno') }}<span class="error"></span></td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>{{ Form::text('vat_regdate') }}<span class="error"></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td> Nature of Industry: (Spinning/Weaving/RMG/Processing/Technical Textile/Others)
                        </td>
                        <td>
                            {{ Form::text('industry_nature') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>Products Manufactured:
                        </td>
                        <td>
                            {{ Form::text('products_man') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>Constitution of Industry (proprietary / Partnership /Company /Others Specify):
                        </td>
                        <td>
                            {{ Form::text('constitution_ind_type') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>11.</td>
                        <td>Category of the Entrepreneur (SC/ST/PH/Women/Ex-Servicemen/Minority/General):
                        </td>
                        <td>
                            {{ Form::text('ent_category') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>12.</td>
                        <td>Whether unit situated in Designated Textile Park:
                        </td>
                        <td>
                        {{ Form::radio('unit_park', 'Yes','',array('id'=>'unit_park1')) }} {{ Form::label('unit_park1', 'Yes') }}
                        {{ Form::radio('unit_park', 'No','',array('id'=>'unit_park2')) }} {{ Form::label('unit_park2', 'No') }}
                        </td>
                    </tr>
                    <tr>
                        <td>13.</td>
                        <td>Is it New Industry or Existing Industry Undertaken Expansion/Modernization/Diversification:
                        </td>
                        <td>
                            {{ Form::text('ind_ex_type') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>14.</td>
                        <td>Project Cost(Rs. In Number):
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>a.&nbsp; &nbsp;land:
                        </td>
                        <td>
                            {{ Form::text('procost_land') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>b.&nbsp; &nbsp;Building:
                        </td>
                        <td>
                            {{ Form::text('procost_build') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>c.&nbsp; &nbsp;Plant &amp; Machinery:
                        </td>
                        <td>
                            {{ Form::text('procost_machin') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>d.&nbsp; &nbsp;Others:
                        </td>
                        <td>
                            {{ Form::text('other') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>e.&nbsp; &nbsp;Total:
                        </td>
                        <td>
                            {{ Form::text('total') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>15.</td>
                        <td>Name of the Term Loan Lending Institution / Bank / FI:
                        </td>
                        <td>
                            {{ Form::text('loan_inst_name') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>a.&nbsp; &nbsp;Date of Loan Sanctioned:
                        </td>
                        <td>
                            {{ Form::text('loan_date') }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>b.&nbsp; &nbsp;Amount of Loan Sanctioned(Rs.In Lakhs):
                        </td>
                        <td>
                            {{ Form::text('loan_amount') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>16.</td>
                        <td>Employment Provided in the New unit (Please Furnish in the Prescribed Formate) OR
                        </td>
                        <td>
                        {{ Form::textarea('employment_newunit_a', '',['size' => '30x5']) }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>a.&nbsp; &nbsp;Additional Employment Created: (Please Furnish in the Prescribed Formate after Expansion / Modernization
                            / Diversification) AND
                        </td>
                        <td>
                        {{ Form::textarea('employment_newunit_b', '',['size' => '30x5']) }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <p>b.&nbsp; &nbsp;form of declaration Regarding</p>
                            <p>Employment of "Local Persons"(Annexure 9)
                                <a href="#" style="color: #333">(Annexure 9)</a>
                            </p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>17.</td>
                        <td>Contact Person Details:
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>a.&nbsp; &nbsp;Name:
                        </td>
                        <td>
                            {{ Form::text('cont_name') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>b.&nbsp; &nbsp;Phone:
                        </td>
                        <td>
                            {{ Form::text('cont_phone') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>c.&nbsp; &nbsp;E-mail Address:
                        </td>
                        <td>
                            {{ Form::text('cont_email') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>18.</td>
                        <td>Bank Account Details:
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>a.&nbsp; &nbsp;Name of Account Holders:
                        </td>
                        <td>
                            {{ Form::text('bank_acname') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>b.&nbsp; &nbsp;Name of the Bank &amp; Branch:
                        </td>
                        <td>
                            {{ Form::text('bank_name') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>c.&nbsp; &nbsp;Account Number:
                        </td>
                        <td>
                            {{ Form::text('bank_acno') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>d.&nbsp; &nbsp;IFSC Code:
                        </td>
                        <td>
                            {{ Form::text('bank_ifsc') }}
                            <span class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <b>Please Tick the Incentive You would like to Claim</b>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td>{{ Form::label('f1', 'Credit Linked Capital Subsidy-', array('for' => 'f1')) }} <a href="#" style="color: #333"> Form 1 </a>
                        </td>
                        <td>
                        {{ Form::checkbox('incentive_list[]', 'Form 1','',array('id'=>'f1')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td>{{ Form::label('f2', 'Interest Subsidy-', array('for' => 'f2')) }} <a href="#" style="color: #333"> Form 2 </a>
                        </td>
                        <td>
                        {{ Form::checkbox('incentive_list[]', 'Form 2','',array('id'=>'f2')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>21</td>
                        <td>{{ Form::label('f3', 'Reimbursement of Entry Tax-', array('for' => 'f3')) }} <a href="#" style="color: #333"> Form 3 </a>
                        </td>
                        <td>
                        {{ Form::checkbox('incentive_list[]', 'Form 3','',array('id'=>'f3')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>22</td>
                        <td>{{ Form::label('f4', 'Reimbursement of Stamp Duty-', array('for' => 'f4')) }} <a href="#" style="color: #333"> Form 4 </a>
                        </td>
                        <td>
                        {{ Form::checkbox('incentive_list[]', 'Form 4','',array('id'=>'f4')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>23</td>
                        <td>{{ Form::label('f5', 'Reimbursement of Power Subsidy-', array('for' => 'f5')) }} <a href="#" style="color: #333"> Form 5 </a>
                        </td>
                        <td>
                        {{ Form::checkbox('incentive_list[]', 'Form 5','',array('id'=>'f5')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>{{ Form::label('f6', 'Reimbursement for Capacity Building Support-', array('for' => 'f6')) }} <a href="#" style="color: #333"> Form 6 </a>
                        </td>
                        <td>
                        {{ Form::checkbox('incentive_list[]', 'Form 6','',array('id'=>'f6')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>25</td>
                        <td>{{ Form::label('f7', 'Assistance for Resource Conservation &amp; Environmental Compliances-', array('for' => 'f7')) }} <a href="#" style="color: #333"> Form 7 </a>
                        </td>
                        <td>
                        {{ Form::checkbox('incentive_list[]', 'Form 7','',array('id'=>'f7')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>26</td>
                        <td>Attach necessary forms(Form 1 to Form 7)</td>
                        <td>
                            {{ Form::file('forms') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <input class="btn btn-info" type="submit" value="Submit" name="Submit">
            </div>
        </form>
    </div>
@stop
@section('custom_scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
// datepick age calculator
$( document ).ready(function() {
    $("input[name='em_regdate'], input[name='vat_regdate'], input[name='loan_date']").datepicker({
        onSelect: function(value, ui) {
            var today = new Date(), 
                age = today.getFullYear() - ui.selectedYear;
            $('#age').val(age);
        },
        changeMonth: true,
        changeYear: true,
        yearRange: "1908:2018",
        dateFormat: 'dd-mm-yy',
    });    
});
</script>
@stop