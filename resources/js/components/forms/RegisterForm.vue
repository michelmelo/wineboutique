<template>
<div>
    <form class="form-inline" v-on:submit="onSubmit" method="post" action="/register">
        <input type="hidden" name="_token" v-model="csrf">
        <input type="hidden" name="type" value="CUSTOMER">
        <input type="text" v-model.trim="firstName" :class="{ 'invalid': isInvalid('firstName') }" name="firstName" placeholder="First Name">
        <span class="help-block" v-if="isInvalid('firstName')">
            <strong>First Name is required.</strong>
        </span>
        <input type="text" v-model.trim="lastName" :class="{ 'invalid': isInvalid('lastName') }" name="lastName" placeholder="Last Name">
        <span class="help-block" v-if="isInvalid('lastName')">
            <strong>Last Name is required.</strong>
        </span>
        <input type="email" v-model.trim="email" :class="{ 'invalid': isInvalid('email') || validEmail===false, 'valid': validEmail }" name="email" placeholder="Email">
        <span class="help-block" v-if="isInvalid('email')">
            <strong>Email is invalid.</strong>
        </span>
        <span class="help-block" v-if="validEmail == false">
            <strong>Email already used.</strong>
        </span>
        <input type="password" v-model="password" :class="{ 'invalid': isInvalid('password') }" name="password" placeholder="Password">
        <span class="help-block" v-if="isInvalid('password')">
            <strong>Password is invalid.</strong>
        </span>
        <div class="form-check">
            <input class="form-check-input" v-model="acceptTerms" type="checkbox" name="acceptTerms" id="defaultCheck1">
            <label class="form-check-label" :class="{ 'invalid': isInvalid('acceptTerms') }" for="defaultCheck1">
            I agree to <a href="#" @click="activePopup = !activePopup">Terms and Conditions.</a> of the Wine Boutique*
            </label>
        </div>
        <span class="help-block" v-if="isInvalid('acceptTerms')">
            <strong>You must accept Terms and Conditions.</strong>
        </span>
        <div class="form-check">
            <input class="form-check-input" v-model="acceptAge" type="checkbox" name="acceptAge" id="defaultCheck2">
            <label class="form-check-label" :class="{ 'invalid': (isInvalid('acceptAge') || isInvalid('birthday')) }" for="defaultCheck2">
                I am at least 21 years of age.*
            </label>
        </div>
        <span class="help-block" v-if="isInvalid('acceptAge')">
            <strong>You must be 21 or older.</strong>
        </span>
        <div id="over-21" v-if="acceptAge">
            <input type="date" name="birthday" v-model="birthday"  :max="initialDate()"/>
        </div>
        <input type="submit" name="submit" class="button red-button full-width" value="CREATE A WINERY">
    </form>
    <transition name="fade">
        <div class="terms-popup is-visible" role="alert" v-if="activePopup">
           <div class="popup-container">
            <a href="#0" class="popup-close img-replace" @click="activePopup = !activePopup">Close</a>
            <div class="popup-head">
              <h2 class="text-center"><strong>Terms and Conditions</strong></h2>
              <p class="text-center">Last updated: January 14, 2019</p>
            </div>
            <div class="popup-body">
                <div class="mb-4">
                    <p>Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the https://wineboutique.com website (the "Service") operated by Wine Boutique Technologies LLC ("us", "we", or "our").Your access to and use of the Service is conditioned upon your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who wish to access or use the Service.By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you do not have permission to access the Service.</p>

                    <h3 class="text-center">Purchases</h3>
                    <p>If you wish to purchase any product or service made available through the Service ("Purchase"), you may be asked to supply certain information relevant to your Purchase including, without limitation, your credit card number, the expiration date of your credit card, your billing address, and your shipping information.You represent and warrant that: (i) you havethe legal right to use any credit card(s) or other payment method(s) in connection with any Purchase; and that (ii) the information you supply to us is true, correct and complete.The service may employ the use of third party services for the purpose of facilitating payment and the completion of Purchases. By submitting your information, you grant us the right to provide the information to these third parties subject to our Privacy Policy.We reserve the right to refuse or cancel your order at any time forreasons including but not limited to: product or service availability, errors in the description or price of the product or service, error in your order or other reasons.We reserve the right to refuse or cancel your order if fraud or an unauthorized or illegal transaction is suspected.</p>

                    <h3 class="text-center">Availability, Errors and Inaccuracies</h3>
                    <p>We are constantly updating product and service offerings on the Service. We may experience delays in updating information on the Service and in our advertising on other web sites. The information found on the Service may contain errors or inaccuracies and may not be complete or current. Products or services may be mispriced, described inaccurately, or unavailable on the Service and we cannot guarantee the accuracy or completeness of any information found on the Service.We therefore reserve the right to change or update information and to correct errors, inaccuracies, or omissions at any time without prior notice.</p>

                    <h3 class="text-center">Contests, Sweepstakes and Promotions</h3>
                    <p>Any contests, sweepstakes or other promotions (collectively, "Promotions") made available through the Service may be governed by rules that are separate from these Terms Conditions. If you participate in any Promotions, please review the applicable rules as well as our Privacy Policy. If the rules for a Promotion conflict with these Terms and Conditions, the Promotion rules will apply.</p>

                    <h3 class="text-center">Accounts</h3>
                    <p>When you create an account with us, you guarantee that you are above the age of 18, and that the information you provide us is accurate, complete, and current at all times. Inaccurate, incomplete, or obsolete information may result in the immediate termination of your account on the Service.You are responsible for maintaining the confidentiality of your account and password, including but not limited to the restriction of access to your computer and/or account. You agree to accept responsibility for any and all activities or actions that occur under your account and/or password, whether your password is with our Service or a third-party service. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.We reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders in our sole discretion.</p>

                    <h3 class="text-center">Copyright Policy</h3>
                    <p>We respect the intellectual property rights of others. It is our policy to respond to any claim that Content posted on the Service infringes on the copyright or other intellectual property rights ("Infringement") of any person or entity.If you are a copyright owner, or authorized on behalf of one, and you believe that the copyrighted work has been copied in a way that constitutes copyright infringement, please submit your claim via email to dmca@wineboutique.com, with the subject line: "Copyright Infringement" and include in your claim a detailed description of the alleged Infringement as detailed below, under "DMCA Notice and Procedure for Copyright Infringement Claims"You may be held accountable for damages (including costs and attorneys' fees) for misrepresentation or bad-faith claims on the infringement of any Content found on and/or through the Service on your copyright.</p>

                    <h3 class="text-center">DMCA Notice and Procedure for Copyright Infringement Claims</h3>
                    <p>You may submit a notification pursuant to the Digital Millennium Copyright Act (DMCA) by providing our Copyright Agent with the following information in writing (see 17 U.S.C 512(c)(3) for further detail):</p>
                    <ul>
                        <li>an electronic or physical signature of the person authorized to act on behalf of the owner of the copyright's interest;</li>
                        <li>a description of the copyrighted work that you claim has been infringed, including the URL (i.e., web page address) of the location where the copyrighted work exists or a copy of the copyrighted work;</li>
                        <li>identification of the URL or other specific location on the Service where the material that you claim is infringing is located;</li>
                        <li>your address, telephone number, and email address;</li>
                        <li>a statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law;</li>
                        <li>a statement by you, made under penalty of perjury, that the above information in your notice is accurate and that you are the copyright owner or authorized to act on the copyright owner's behalf.</li>
                    </ul>
                    <p>You can contact our Copyright Agent via email at dmca@wineboutique.com</p>

                    <h3 class="text-center">Intellectual Property</h3>
                    <p>The Service and its original content, features and functionality are and will remain the exclusive property of Wine Boutique Technologies LLC and its licensors. The Service is protected by copyright, trademark, and otherlaws of both the United States and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of Wine Boutique Technologies LLC.</p>

                    <h3 class="text-center">Links To Other Web Sites</h3>
                    <p>Our Service may contain links to third party web sites or services that are not owned or controlled by Wine Boutique Technologies LLCWine Boutique Technologies LLC has no control over, and assumes no responsibility for the content, privacy policies, or practices of any third party web sites or services. We do not warrant the offerings of any of these entities/individuals or their websites.You acknowledge and agree that Wine Boutique Technologies LLC shall not be responsible or liable, directly or indirectly, for any damageor loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such third party web sites or services.We strongly advise you to read the terms and conditions and privacy policies of any third party web sites or services that you visit.</p>

                    <h3 class="text-center">Termination</h3> 
                    <p>We may terminate or suspend your account and bar access to the Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever andwithout limitation, including but not limited to a breach of the Terms.

                    If you wish to terminate your account, you may simply discontinue using the Service.

                    All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>

                    <h3 class="text-center">Indemnification</h3>
                    <p>You agree to defend, indemnify and hold harmless Wine Boutique Technologies LLC and its licensee and licensors, and their employees, contractors, agents, officers and directors, from and against any and all claims, damages, obligations, losses, liabilities, costs or debt, and expenses (including but not limited to attorney's fees), resulting from or arising out of a) your use and access of the Service, by you or any person using your account and password, or b) a breach of these Terms.</p>

                    <h3 class="text-center">Limitation Of Liability</h3>
                    <p>In no event shall Wine Boutique Technologies LLC, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from (i) your access to or use of or inability to access or use the Service; (ii) any conduct or content of any third party on the Service; (iii) any content obtained from the Service; and (iv) unauthorized access, use or alteration of your transmissions or content, whether based on warranty, contract, tort (including negligence) or any other legal theory, whether or not we have been informed of the possibility of such damage, and even if a remedy set forth herein is found to have failed of its essential purpose.</p>

                    <h3 class="text-center">Disclaimer</h3>
                    <p>Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement or course of performance.

                    Wine Boutique Technologies LLC its subsidiaries, affiliates, and its licensors do not warrant that a) the Service will function uninterrupted, secure or available at any particular time or location; b) any errors or defects will be corrected; c) the Service is free of viruses or other harmful components; or d) the results of using the Service will meet your requirements.</p>

                    <h3 class="text-center">Exclusions</h3>
                    <p>Some jurisdictions do not allow the exclusion of certain warranties or the exclusion or limitation of liability for consequential or incidental damages, so the limitations above may not apply to you.</p>

                    <h3 class="text-center">Governing Law</h3>
                    <p>These Terms shall be governed and construed in accordance with the laws of Florida, United States, withoutregard to its conflict of law provisions.

                    Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have had between us regarding the Service.</p>

                    <h3 class="text-center">Changes</h3>
                    <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.By continuing to access or use our Service after any revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, you are no longer authorized to use the Service.</p>

                    <h3 class="text-center">Contact Us</h3>
                    <p>If you have any questions about these Terms, please contact us.</p>
                </div>
                <div class="text-center py-4">
                    <span href="#0" class="button red-button" @click="acceptTermsFn"><i class="fas fa-check"></i> ACCEPT</span>
                    <span href="#0" class="button red-button" @click="activePopup = !activePopup"><i class="fas fa-times"></i> CLOSE</span>
                </div>
            </div>
           </div>
        </div>
    </transition>
</div>
</template>

<script>
    import { required, minLength, email, numeric } from 'vuelidate/lib/validators';
    import { isTrue } from "../../customValidators";
    import moment from 'moment';

    const formFields = [
        'firstName',
        'lastName',
        'email',
        'password',
        'acceptTerms',
        'acceptAge',
        'birthday'
    ];

    export default {
        data: () => ({

            firstName: '',
            lastName: '',
            email: '',
            password: '',
            acceptTerms: false,
            acceptAge: false,
            birthday: '',
            csrf: window.Laravel.csrfToken,
            showErrors: false,
            validEmail: null,
            activePopup: false
        }),
        watch: {
            'email': 'checkEmail'
        },
        methods: {
            acceptTermsFn(){
                this.acceptTerms = true;
                this.activePopup = false;
            },
            checkEmail() {
                this.validEmail = null;
                if(this.email.length > 0 && email(this.email)) {
                    axios.post(`/api/auth/check-email`, {email: this.email})
                        .then(() => {
                            this.validEmail = true;
                        })
                        .catch(() => {
                            this.validEmail = false;
                        });
                }
            },
            onSubmit(event) {
                this.showErrors = true;

                if(this.$v.$invalid) {
                    event.preventDefault();
                    formFields.some(formField => {
                        if(this.$v[formField].$invalid) {
                            document.querySelector(`[name="${formField}"]`).focus();
                            return true;
                        }
                        return false;
                    });
                }

                if(!this.validEmail){
                    event.preventDefault();
                    return false;
                }
            },
            isInvalid(name) {
                console.log(name, this.$v[name]);
                return this.$v[name].$invalid && this.showErrors;
            },
            initialDate(){
                let date = new Date();
                date.setFullYear(date.getFullYear() - 21);

                return moment(date).format('Y-MM-DD');
            }
        },
        validations: {
            firstName: {
                required,
                minLength: minLength(4)
            },
            lastName: {
                required,
                minLength: minLength(4)
            },
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: minLength(6)
            },
            acceptTerms: {
                isTrue
            },
            acceptAge: {
                isTrue
            },
            birthday: {
                required
            }
        }
    }
</script>
