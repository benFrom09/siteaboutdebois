@extends('layouts.front')
@section('content')
@include('Front.partials.header')
<section id="cover">
    <div class="cover-image">
        <img src="/img/cover.jpg" alt="photo de couverture etablit rabeaux et copeaux de bois" class="image">
    </div>
    <!--
    <div class="arrow-down">
        <div id="down">
            <i class="fas fa-angle-down "></i>
        </div>

    </div>
-->
</section>
<section id="presentation">
    <div class="section-title">
        <h2 class="title-center">Présentation</h2>
    </div>
    <hr>
    <div class="presentation-subtitle">
        <h3>"Un savoir-faire artisanal valorisant l'économie locale et l'environnement."</h3>
    </div>

    <div class="service-items-container">
        <div class="service-item" itemscope itemtype="http://schema.org/Service">
            <h3 itemprop="serviceType"><span>C</span>réation en bois massif</h3>
            <p>Issues de ma propre inspiration ou de la vôtre; pour un usage intérieur ou extérieur,
                en simple <strong>décoration</strong> ou bien plus fonctionnel,
                ces créations seront des pièces uniques.</p>
        </div>
        <div class="service-item" itemscope itemtype="http://schema.org/Service">
            <h3 itemprop="serviceType"><span>A</span>gencement sur mesure</h3>
            <p>
                En massif ou en dérivés du <strong>bois</strong>; <strong>agencement</strong> de cuisine, dressing,
                salle de
                bains, bibliothèque...
                Un <strong>mobilier</strong> fabriqué sur mesure pour répondre à vos besoins et
                s'intégrer parfaitement à votre univers.
            </p>
        </div>
        <div class="service-item" itemscope itemtype="http://schema.org/Service">
            <h3 itemprop="serviceType"><span>R</span>elooking mobilier</h3>
            <p>
                Un <strong>meuble</strong> vous paraît triste et démodé ? Il est possible de lui redonner vie en le
                modifiant,
                en le relookant: laque, patine, céruse, placage, cuir, métal...
            </p>
        </div>
        <div class="service-item" itemscope itemtype="http://schema.org/Service">
            <h3 itemprop="serviceType"><span>M</span>enuiserie et pose</h3>
            <p>
                <strong>Menuiserie</strong> traditionnelle, pose de parquet, cuisine, et autres divers petits travaux...
            </p>
        </div>
    </div>
</section>
@include('Front.partials.realisation')
<section id="s-about">
    <div class="section-title">
        <h2 class="title-center title-about"><span>a</span> propos</h2>
    </div>
    <hr>
    <div class="about-container">
        <div class="about-header">
            <p> Installé en Ariège,
                l'entreprise A BOUT DE BOIS vous propose ses services,
                de la conception à la réalisation. </p>
        </div>
        <div class="about-body">
            <div class="about-content">
                <p>Dans un souci de respect de la nature, les essences utilisées sont
                    essentiellement locales, châtaignier, chêne, hêtre, frêne, noyer, peuplier,
                    robinier, cèdre, mélèze, douglas.... Une variété de couleurs, et de caractéristiques
                    pour répondre aux besoins de l'ouvrage, et au désir du client !</p>
            </div>
            <div class="about-content">
                <img class="about-work" src="/img/vuedehaut.jpg" alt="">
                <p>A l'heure d'une obsolescence programmée quasiment généralisée,
                    A BOUT DE BOIS vous propose du mobilier durable, écologique, et en
                    accord avec vos souhaits.</p>
            </div>
            <div class="about-content">
                <img class="about-work" src="/img/tetelit.jpg" alt="">
            </div>
        </div>
    </div>
</section>
@include('Front.partials.contact')
<footer>
    <div class="footer-content-before"></div>
    <div class="footer-content">
        <p>Jean-Laurent TOMAS</p>
        <p>Artisan diplômé et qualifié en menuiserie traditionnelle <br>
            et ameublement aéronautique de luxe</p>
        <p>aboutdebois09@gmail.com</p>
        <p>SIRET: 442 381 802 00036</p>
    </div>
    <div class="footer-content-after"></div>
</footer>
<div class="cpy text-center">
    <p>©2019 ben09-developer-fullstack
        <span class="references"><i class="fas fa-at"></i> ben09.dev@gmail.com</span>
        <a class="references" href="https://github.com/benFrom09/ben09">github <i class="fab fa-github"></i></a>
    </p>
</div>
@include('Front.partials.slideshowmodal')
@endsection