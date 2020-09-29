<div>
    <h4 style="font-weight: 600">Verification Details</h4>
    <hr>
    <div>
        <?php $verification = \App\VendorVerification::where('vendor_id', $vendordetails->id)->first();
        ?>
        @if ($verification != null)

            <table class="table">
                <tr>
                    <td> <strong>Bank</strong> </td>
                    <td>{{ $verification->bankname }}</td>
                </tr>
                <tr>
                    <td> <strong>Bank</strong> </td>
                    <td>{{ $verification->bankaccount }}</td>
                </tr>
            </table>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div><strong>Registration Document</strong> </div>
                    <img src="{{url($verification->registration)}}" style="width: 100%;">
                </div>
                <div class="col-md-6">
                    <div><strong>Citizenship</strong> </div>
                    <img src="{{url($verification->citizenship)}}" style="width: 100%;">
                </div>
            </div>

        @endif
    </div>
</div>
