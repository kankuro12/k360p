<div>
    <h4 style="font-weight: 600">Shipping Details</h4>
    <hr>
    <div>
        <?php 
            $option=\App\VendorOptions::where('vendor_id',$vendordetails->id)->first();
            
        ?>
        @if($option!=null)

            <div>
                <table  class="table">
                    <tr>
                        <td>
                            <strong>Province</strong>
                        </td>
                        <td>
                            {{$option->province->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>District</strong>
                        </td>
                        <td>
                            {{$option->district->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Municipality</strong>
                        </td>
                        <td>
                            {{$option->Municipality->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Shipping Area</strong>
                        </td>
                        <td>
                            {{$option->shippingarea!=null?$option->shippingarea->name:"--"}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Deliver Range</strong>
                        </td>
                        <td>
                            {{ \App\Setting\VendorOption::deliverrange[$option->deliver_range]}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>LandMark</strong>
                        </td>
                        <td>
                            {{$option->landmark}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Bulk Buy</strong>
                        </td>
                        <td>
                            {{$option->bulkbuy==1?"Yes":"No"}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Bulk Sell</strong>
                        </td>
                        <td>
                            {{$option->bulksell==1?"Yes":"No"}}
                        </td>
                    </tr>
                </table>
            </div>
        @endif
    </div>
</div>