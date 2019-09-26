@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row padding-row startup">
            <div class="col-md-12 col-sm-12">
                <form method="post" action="/sub-merchant-setup">
                    @csrf

                    <div class="shadow-box row">
                        <div class="col-xs-12">
                            <h2>SUB MERCHANT SETUP</h2>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <label for="ssn">SSN last 4 digits</label>
                                    <input type="number" name="ssn" id="ssn" type="text" min="1000" max="9999" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <label for="webpage">Shops website</label>
                                    <input type="url" name="webpage" id="webpage" type="text" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="red-button button float-right">FINISH</button>
                </form>
            </div>
        </div>
    </div>
@endsection