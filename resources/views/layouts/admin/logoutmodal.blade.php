<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close btn" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Select "Logout" below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="my-cart-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modal title</h4> 
                <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-responsive" id="my-cart-table">
                    <tbody>
                        <tr title="summary 1" data-id="1" data-price="10">
                            <td class="text-center" style="width: 30px;"><img width="30px" height="30px"
                                    src="images/img_1.png"></td>
                            <td>product 1</td>
                            <td title="Unit Price" class="text-right">$10.00</td>
                            <td title="Quantity"><input type="number" min="1" style="width: 70px;"
                                    class="my-product-quantity" value="1"></td>
                            <td title="Total" class="text-right my-product-total">$10.00</td>
                            <td title="Remove from Cart" class="text-center" style="width: 30px;"><a
                                    href="javascript:void(0);" class="btn btn-xs btn-danger my-product-remove">X</a>
                            </td>
                        </tr>
                        <tr title="summary 2" data-id="2" data-price="20">
                            <td class="text-center" style="width: 30px;"><img width="30px" height="30px"
                                    src="images/img_2.png"></td>
                            <td>product 2</td>
                            <td title="Unit Price" class="text-right">$20.00</td>
                            <td title="Quantity"><input type="number" min="1" style="width: 70px;"
                                    class="my-product-quantity" value="2"></td>
                            <td title="Total" class="text-right my-product-total">$40.00</td>
                            <td title="Remove from Cart" class="text-center" style="width: 30px;"><a
                                    href="javascript:void(0);" class="btn btn-xs btn-danger my-product-remove">X</a>
                            </td>
                        </tr>
                        <tr title="summary 3" data-id="3" data-price="30">
                            <td class="text-center" style="width: 30px;"><img width="30px" height="30px"
                                    src="images/img_3.png"></td>
                            <td>product 3</td>
                            <td title="Unit Price" class="text-right">$30.00</td>
                            <td title="Quantity"><input type="number" min="1" style="width: 70px;"
                                    class="my-product-quantity" value="1"></td>
                            <td title="Total" class="text-right my-product-total">$30.00</td>
                            <td title="Remove from Cart" class="text-center" style="width: 30px;"><a
                                    href="javascript:void(0);" class="btn btn-xs btn-danger my-product-remove">X</a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong id="my-cart-grand-total">$80.00</strong></td>
                            <td></td>
                        </tr>
                        <tr style="color: red">
                            <td></td>
                            <td><strong>Total (including discount)</strong></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong id="my-cart-discount-price">$40.00</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary my-cart-checkout">Checkout</button>
            </div>
        </div>
    </div>
</div> --}}