<!-- Modal -->

<style>
    tr:nth-child(even) {background-color: #f2f2f2;}
</style>
<div id="invoice_view_details" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Invoice View</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="25%">Property</th>
                        <th>Values</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Invoice No</td>
                        <td class="inv_no"></td>
                    </tr>
                    <tr>
                        <td>RCM</td>
                        <td class="rcm"></td>
                    </tr>
                    <tr>
                        <td>Transport Mode</td>
                        <td class="transport_mode"></td>
                    </tr>
                    <tr>
                        <td>Vehicle No</td>
                        <td class="vehicle_no"></td>
                    </tr>
                    <tr>
                        <td>Date of Supply</td>
                        <td class="date_of_supply"></td>
                    </tr>
                    <tr>
                        <td>Invoice Date</td>
                        <td class="inv_date"></td>
                    </tr>
                    <tr>
                        <td>Place of Supply</td>
                        <td class="place_of_supply"></td>
                    </tr>
                    <tr>
                        <td>Invoice Address</td>
                        <td class="inv_address"></td>
                    </tr>
                    <tr>
                        <td>Shipping Address</td>
                        <td class="inv_shipping_address"></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td class="total"></td>
                    </tr>
                    <tr>
                        <td>CGST</td>
                        <td class="cgst"></td>
                    </tr>
                    <tr>
                        <td>SGST</td>
                        <td class="sgst"></td>
                    </tr>
                    <tr>
                        <td>IGST</td>
                        <td class="igst"></td>
                    </tr>
                    <tr>
                        <td>GST</td>
                        <td class="gst"></td>
                    </tr>
                    <tr>
                        <td>Total Tax</td>
                        <td class="total_tax"></td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td class="net_amount"></td>
                    </tr>
                    <tr>
                        <td>RCGST</td>
                        <td class="rcgst"></td>
                    </tr>
                    <tr>
                        <td>RSGST</td>
                        <td class="rsgst"></td>
                    </tr>
                    <tr>
                        <td>RIGST</td>
                        <td class="rigst"></td>
                    </tr>
                    <tr>
                        <td>RGST</td>
                        <td class="rgst"></td>
                    </tr>
                    <tr>
                        <td>ERF No</td>
                        <td class="erf_no"></td>
                    </tr>
                    <tr>
                        <td>Bill Generator Name</td>
                        <td class="bill_generator_name"></td>
                    </tr>
                    <tr>
                        <td>Auth Sign Name</td>
                        <td class="auth_sign_name"></td>
                    </tr>
                    <tr>
                        <td>Auth Sign Designation</td>
                        <td class="auth_sign_designation"></td>
                    </tr>
                    <tr>
                        <td>Amount In Words</td>
                        <td class="amount_in_words"></td>
                    </tr>
                    <tr>
                        <td>Payment Type</td>
                        <td class="payment_type"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="copydocmentbill" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delivery Challan Copy</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label>DC Copy</label>
                        <select name="dccopy" id="dccopy" class="form-control selectpicker" title="Select Document Bill Copy">
                            <option value="Original-for-Recipient">Original for Recipient</option>
                            <option value="Duplicate-for-Transporter">Duplicate for Transporter</option>
                            <option value="Triplicate-for-Transporter">Triplicate for Transporter</option>
                            <option value="Quadruplicate">Quadruplicate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info pull-right">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


