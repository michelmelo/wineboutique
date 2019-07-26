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
                                    <input type="text" name="legal_name" placeholder="Legal Name" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="legal_address" placeholder="Legal Address" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="legal_phone" placeholder="Legal Phone" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="legal_tin" placeholder="Tax ID" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="legal_website" placeholder="Website" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="legal_ownership_type" placeholder="Ownership type" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="dba_name" placeholder="DBA Name" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="dba_address" placeholder="DBA Address" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="owner1_fullname" placeholder="Owner's Name" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="owner1_dob" placeholder="Owner's DOB" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="owner1_email" placeholder="Owner's Email" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="owner1_phone" placeholder="Owner's Phone" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="owner1_address" placeholder="Owner's Address" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="owner1_ssn" placeholder="Owner's SSN" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="owner1_perc" placeholder="Owner's Percentage" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="bank_routingnumber" placeholder="Routing Number" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="bank_accountnumber" placeholder="Account Number" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="legal_years" placeholder="Legal Years" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="legal_productsold" placeholder="Product Sold" min="4" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                    <input type="text" name="legal_mmc" placeholder="Legal MMC" min="4" required>
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