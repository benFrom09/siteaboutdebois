<section id="s-contact">
    <div class="section-title">
        <h2 class="title-center">Contact</h2>
    </div>
    <hr>
    <div class="form-container">
        <div class="contact-p">
            <p>Vous avez un besoin, une envie, un souhait, ou vous désirez tout simplement en savoir plus?
                Contactez moi pour toute information supplémentaire. Devis gratuit.</p>
        </div>
        <div class="local-infos" itemprop itemscope="http://schema.org/Postaladdress">
            <p><i class="fas fa-map-marker-alt fa-2x"></i>
                <span itemprop="postalcode">09100-</span>
                <span itemprop="addressLocality"> PAMIERS</span>
            </p>
            <p><i class="fas fa-envelope fa-fw pull-left fa-2x"></i><span>aboutdebois09@gmail.com</span></p>
            <p><i class="fas fa-phone fa-2x"></i><span itemprop="telephone">06 76 83 44 28</span></p>
        </div>
        <div class="contact-form">
            <form id="contact-form" action="" method="POST">
                @csrf
                <div class="form-input">
                    <input type="text" name="object" id="object" value="Objet: besoin de renseignements">
                </div>
                <div class="form-input">
                    <input type="email" name="email" id="email" placeholder="Votre Email">
                </div>
                <div class="form-input">
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Votre message"></textarea>
                </div>
                <button type="submit" id="contact-form-button" class="button">Envoyer</button>
            </form>
        </div>
    </div>
</section>