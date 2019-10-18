<footer class="justify-content-center">
<p href="#top-icons" id="back-to-top" class="d-none"><i class="fas fa-angle-double-up"></i></p>
    @if(Auth::guest())
        @if(Request::url() !== url('/register/sell'))
            <div class="footer-banner">
                <a href="{{route('register.sell')}}" class="white-button button">SELL ON WB</a>
            </div>
        @endif
    @endif
    <div class="container">
        <div class="footer-social">
            <h4>CONNECT WITH US</h4>
            <a href="https://www.facebook.com/wineboutiqueus/"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/wineboutiqueus/"><i class="fab fa-instagram"></i></a>
            <a href="https://twitter.com/WineBoutique_?lang=en"><i class="fab fa-twitter"></i></a>
        </div>
    </div>

    <div class="footer-about">
        <div class="container">
            <h4>ABOUT US</h4>
            <p class="text-center">
                Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this...
            </p>

            <ul class="footer-nav">
                <h4 class="mb-4">SUBSCRIBE TO OUR NEWSLETTER</h4>
                <li><newsletter-form></newsletter-form></li>
                <li><a href="">Sign Up</a></li>
                <li><a href="/faq">FAQ</a></li>
                <li><a href="">Order Status</a></li>
                <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
            </ul>
        </div>
    </div>
    <div class="copyright text-center">© 2018 - Wine Boutique | All Rights Reserved | <a href="https://executive-digital.com/" class="color-r" target="_blank">Web Development</a> by Executive Digital</div>
</footer>