@extends('layouts.app')

@section('content')
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-7 my-auto">
                    <div class="header-content mx-auto">
                        <h1 class="mb-5">WallR biedt je de mogelijkheid makkelijk een SMS-wall op te zetten, zodat jij
                            tijd hebt voor de moeilijke zaken.</h1>
                        <a href="#about" class="btn btn-outline btn-xl js-scroll-trigger">Over WallR</a>
                    </div>
                </div>
                <div class="col-lg-5 my-auto">
                    <div class="device-container">
                        <div class="device" data-device="Pixel" data-orientation="portrait" data-color="black">
                            <div class="screen">
                                <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                                <img src="{{ asset('img/demo-screen-1.jpg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="button">
                                <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="about bg-primary jn-yellow text-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h2 class="section-heading">Over</h2>
                    <p>WallR maakt het opzetten van een SMS-wall op een fuif, event of conferentie voor jou ietsje
                        makkelijker. Jij hoeft enkel een event aan te maken via de app en je toestel verbonden te houden
                        met het internet. Wij doen de rest voor jou.</p>
                    <p>Zo krijg je bij het aanmaken van een event onmiddelijk een link, die jij op een beamer of scherm
                        naar keuze kan vertonen. Hierop worden de laatste 10 berichten vertoond die naar de praatmuur
                        werden gestuurd.</p>
                    <a href="#download" class="btn btn-outline btn-xl js-scroll-trigger">Download de app gratis!</a>
                </div>
            </div>
        </div>
    </section>

    <section class="download bg-primary jn-green text-center" id="download">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h2 class="section-heading">Ontdek de app!</h2>
                    <p>Onze app is beschikbaar op elk mobiel apparaat! Download de app om te starten.</p>
                    <!--
                    <div class="badges">
                        <a class="badge-link" href="http://play.google.com/store/search?q=wallr&c=apps" target="_blank"><img
                                    src="asset('img/google-play-badge.svg')" alt=""></a>
                    </div>
                    -->
                    <br>
                    <a class="btn btn-outline jn-green btn-xl" href="{{ asset('download/wallr-1.0.0.apk') }}" target="_blank">Download the .apk</a>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Onbegrensde functies.</h2>
                <p class="text-muted">Ontdek zelf wat je met de app kan doen!</p>
                <hr>
            </div>
            <div class="row">
                <div class="col-lg-4 my-auto">
                    <div class="device-container">
                        <div class="device" data-device="Pixel" data-orientation="portrait" data-color="black">
                            <div class="screen">
                                <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                                <img src="{{ asset('img/demo-screen-1.jpg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="button">
                                <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 my-auto">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="feature-item">
                                    <i class="icon-cloud-upload text-primary"></i>
                                    <h3>Cloudopslag</h3>
                                    <p class="text-muted">Ontvangen berichten worden online opgeslagen, zodat je niet
                                        altijd verbonden hoeft te zijn.</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="feature-item">
                                    <i class="icon-envelope text-primary"></i>
                                    <h3>Snel en gemakklijk</h3>
                                    <p class="text-muted">Ontvang en toon berichten onmiddelijk op groot scherm na
                                        ontvangst</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="feature-item">
                                    <i class="icon-lock-open text-primary"></i>
                                    <h3>Helemaal gratis</h3>
                                    <p class="text-muted">De app is volledig open-source en gratis in gebruik. Handig
                                        als je een persoonlijk aanpak wil.</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="feature-item">
                                    <i class="icon-bubbles text-primary"></i>
                                    <h3>Communicatie</h3>
                                    <p class="text-muted">Wordt interactief en sta je gasten toe om de converseren met
                                        al je bezoekers via 1 app.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="cta-content">
            <div class="container">
                <h2>Start nu.<br>Gebruik WallR</h2>
                <a href="#download" class="btn btn-outline btn-xl js-scroll-trigger">Download de app gratis!</a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>

    <section class="contact bg-primary jn-blue" id="contact">
        <div class="container">
            <h2>We
                <i class="fa fa-heart"></i>
                our users!</h2>
            <p>Bezoek ons en help mee via Github!</p>
            <ul class="list-inline list-social">
                <li class="list-inline-item social-github">
                    <a href="https://github.com/df-jonas" target="_blank">
                        <i class="fa fa-github-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </section>
@endsection
