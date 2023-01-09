<!DOCTYPE html>
<html lang="en">
@include('frontend.head')

<body>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BQPVCKPM2F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-BQPVCKPM2F');
    </script>


    <script type="application/ld+json">

    {
      "@context": "https://schema.org/",
      "@type": "WebSite",
      "name": "MechCareer",
      "url": "https://www.mechcareer.com/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://www.mechcareer.com/mechanical-jobs?{search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }


                [{
                "@context": "https://schema.org",
                "@type": "BreadcrumbList",
                "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Registration - Job Seekers",
                    "item": "https://www.mechcareer.com/jobseeker-registration",
                    "description": "Free registration to get access for apply jobs in mechanical industry in india, get notification for relavat jobs and walkin jobs in mechanical fields"
                },{
                    "@type": "ListItem",
                    "position": 2,
                    "name": "Login - Job Seekers",
                    "item": "https://www.mechcareer.com/jobseeker-login",
                    "description": "Login and get access to your mechanical job portal account and fill profile details to apply for top companies jobs"
                },{
                    "@type": "ListItem",
                    "position": 3,
                    "name": "For Employers",
                    "item": "https://www.mechcareer.com/employer-home",
                    "description": "ISOPARA leading brand in domain training. We help to engineers to grow and start their careers in press tool & mould design with industry needed project."

                },{
                    "@type": "ListItem",
                    "position": 4,
                    "name": "For College TPO",
                    "item": "https://www.mechcareer.com/college-tpo-home",
                    "description": "ISOPARA provides fixture design courses in different fields like checking fixture, welding fixture and more. Online and offline courses available"
                }]
                }]
            </script>

    @include('frontend.loader')
    @include('frontend.navbar')
    @yield('content')
    @include('frontend.footer')
</body>

</html>
