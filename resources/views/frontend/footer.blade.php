<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo">
                        <h1><img src="{{ URL::asset(FRONTEND . '/assets/images/logo.svg') }}" />
                            Mech<span>Career</span></h1>
                    </div>
                    <div class="socialmedia-icons">
                        <h3>Follow Us</h3>
                        <ul>
                            @php
                                $socialMediaLink = getSocialMediaLinks();
                            @endphp
                            <li><a href="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_facebook : '#' }}"
                                    target="_blank">
                                    <img src="{{ URL::asset(FRONTEND . '/assets/images/home/socialicon1.svg') }}" />
                                </a></li>
                            <li>
                                <a href="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_linkedin : '#' }}"
                                    target="_blank">
                                    <img src="{{ URL::asset(FRONTEND . '/assets/images/home/socialicon2.svg') }}" />
                                </a>
                            </li>
                            <li><a href="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_instagram : '#' }}"
                                    target="_blank">
                                    <img src="{{ URL::asset(FRONTEND . '/assets/images/home/socialicon3.svg') }}" />
                                </a></li>
                            <li><a href="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_twitter : '#' }}"
                                    target="_blank">
                                    <img src="{{ URL::asset(FRONTEND . '/assets/images/home/socialicon4.svg') }}" />
                                </a></li>
                            <li><a href="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_youtube : '#' }}"
                                    target="_blank">
                                    <img src="{{ URL::asset(FRONTEND . '/assets/images/home/socialicon5.svg') }}" />
                                </a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-2">
                    <ul class="quick-links">
                        <li><a href="#" target="_blank">About Us</a></li>
                        <li><a href="#" target="_blank">Career</a></li>
                        <li><a href="#" target="_blank">Employer Home</a></li>
                        <li><a href="" target="_blank">Sitemap</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="quick-links">
                        <li><a href="#" target="_blank">Help center</a></li>
                        <li><a href="#" target="_blank">Free Courses</a></li>
                        <li><a href="#" target="_blank">Training partner</a></li>
                        <li><a href="#" target="_blank">Report issue</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="quick-links">
                        <li><a href="#" target="_blank"> Privacy policy</a></li>
                        <li><a href="#" target="_blank">Terms & conditions</a></li>
                        <li><a href="#" target="_blank">Fraud alert </a></li>
                        <li><a href="#" target="_blank">Trust & safety</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="apply-on">
                        <h3>Apply On</h3>
                        <p> Get real- time job updates on our App</p>
                    </div>
                    <div class="playstore-download">
                        <a href="#" target="_blank">
                            <embed src="{{ URL::asset(FRONTEND . '/assets/images/androidicon.svg') }}"
                                type="image/svg+xml" />
                        </a>
                        <a href="#" target="_blank">
                            <embed src="{{ URL::asset(FRONTEND . '/assets/images/appleicon.svg') }}"
                                type="image/svg+xml" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>All rights reserved © {{ SITENAME }} Pvt. Ltd.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ URL::asset(FRONTEND . '/assets/js/jquery.js') }}"></script>
<script src="{{ URL::asset(FRONTEND . '/assets/js/popper.min.js') }}"></script>
<script src="{{ URL::asset(FRONTEND . '/assets/js/bootstrap.js') }}"></script>
<script src="{{ URL::asset(FRONTEND . '/assets/js/owl.carousel.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script src="{{ URL::asset(FRONTEND . '/assets/js/custom.js') }}"></script>
<script src="{{ URL::asset(FRONTEND . '/assets/js/search.js') }}"></script>





<script>
    $(document).ready(function() {
        $('.loader').hide();
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 4,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 1300,
            autoplayHoverPause: true
        });
        $('.play').on('click', function() {
            owl.trigger('play.owl.autoplay', [1000])
        })
        $('.stop').on('click', function() {
            owl.trigger('stop.owl.autoplay')
        })
    })
</script>
