@extends('retailer.retailerD')
@section('retailer')
    <div class="container">
        <div class="py-5 text-center">
            <h2>Checkout</h2>
            <p class="lead">Complete your payment using the options below.</p>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Order Summary</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <span class="text-muted">{{ $order[0]->total }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BDT)</span>
                        <strong>{{ $order[0]->total }} TK</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Payment Options</h4>
                <form action="{{ route('retailer.pay') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order[0]->id }}">
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input"
                                value="1" checked required onchange="togglePaymentFields()">
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input"
                                value="2" required onchange="togglePaymentFields()">
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="mobile" name="paymentMethod" type="radio" class="custom-control-input"
                                value="3" required onchange="togglePaymentFields()">
                            <label class="custom-control-label" for="mobile">Mobile Payment</label>
                        </div>
                    </div>

                    <!-- Credit Card Info -->
                    <div id="creditCardInfo" class="payment-info">
                        <div class="mb-3">
                            <label for="cc-number">Credit Card Number</label>
                            <input type="text" class="form-control" id="cc-number" name="cc-number">
                        </div>
                        <div class="mb-3">
                            <label for="cc-expiration">Expiration Date</label>
                            <input type="text" class="form-control" id="cc-expiration" name="cc-expiration">
                        </div>
                        <div class="mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" name="cc-cvv">
                        </div>
                    </div>

                    <!-- Debit Card Info -->
                    <div id="debitCardInfo" class="payment-info" style="display: none;">
                        <div class="mb-3">
                            <label for="dc-number">Debit Card Number</label>
                            <input type="text" class="form-control" id="dc-number" name="dc-number">
                        </div>
                        <div class="mb-3">
                            <label for="dc-expiration">Expiration Date</label>
                            <input type="text" class="form-control" id="dc-expiration" name="dc-expiration">
                        </div>
                        <div class="mb-3">
                            <label for="dc-cvv">CVV</label>
                            <input type="text" class="form-control" id="dc-cvv" name="dc-cvv">
                        </div>
                    </div>

                    <!-- Mobile Payment Options -->
                    <div id="mobilePaymentOptions" class="payment-info" style="display: none;">
                        <div class="mb-3">
                            <label for="mobile-provider">Select Provider</label>
                            <select class="form-control" id="mobile-provider" name="mobile-provider">
                                <option value="bkash">Bkash</option>
                                <option value="nagad">Nagad</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mobile-number">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile-number" name="mobile-number">
                        </div>
                        <div class="mb-3">
                            <label for="transaction-id">Transaction ID</label>
                            <input type="text" class="form-control" id="transaction-id" name="transaction-id">
                        </div>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Payment</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePaymentFields() {
            var creditCardInfo = document.getElementById('creditCardInfo');
            var debitCardInfo = document.getElementById('debitCardInfo');
            var mobilePaymentOptions = document.getElementById('mobilePaymentOptions');

            creditCardInfo.style.display = 'none';
            debitCardInfo.style.display = 'none';
            mobilePaymentOptions.style.display = 'none';

            if (document.getElementById('credit').checked) {
                creditCardInfo.style.display = 'block';
            } else if (document.getElementById('debit').checked) {
                debitCardInfo.style.display = 'block';
            } else if (document.getElementById('mobile').checked) {
                mobilePaymentOptions.style.display = 'block';
            }
        }
    </script>
@endsection
