import DomElement from './DomElement';

/******************************************
 * ********** expand menu on scroll ******** 
********************************************/
window.onscroll = (event) => {
    if (document.body.getBoundingClientRect().top < -1) {
        DomElement.nav.style.background = "#fff";
        DomElement.nav.style.opacity = 1;
        DomElement.nav.style.padding = "20px 0 20px 0";
    } else {
        DomElement.nav.style.background = "#fff";
        DomElement.nav.style.opacity = 0.8;
        DomElement.nav.style.padding = "0";
    }
}

