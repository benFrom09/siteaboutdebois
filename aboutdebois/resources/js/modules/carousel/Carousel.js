import './Carousel.css';
export default class Carousel {
    constructor(container = null, options = {}) {
        this.container = container;
        this.items = [].slice.call(this.container.children);
        this.slideIndex = 0;
        this.dots = this.createDots();
        this.container.appendChild(this.dots);

    }

    createDots(className = 'dotsContainer') {
        let dotsContainer = document.createElement('div');
        dotsContainer.className = className;
        this.items.forEach((item, i) => {
            let dot = document.createElement('span');
            dot.classList.add('dots');
            dot.dataset.index = i;
            dotsContainer.appendChild(dot);
            this.setDotsListeners(dot);
        });
        return dotsContainer;
    }

    setDotsListeners(item) {
        item.addEventListener('click', (e) => {
            this.setCurrentSlide(item.dataset.index);
            this.showSlide();
        });
    }

    setCurrentSlide(index) {
        this.slideIndex = index;
    }
    showSlide() {
        let len = this.items.length
        for (let i = 0; i < len; i++) {
            this.items[i].classList.remove('showing');
            this.dots.children[i].classList.remove('dot-active');
        }

        if (this.slideIndex >= len) {
            this.slideIndex = 0;
        }
        else if (this.slideIndex < 0) {
            this.slideIndex = len - 1;
        }
        this.items[this.slideIndex].classList.add('showing');
        this.dots.children[this.slideIndex].classList.add('dot-active');
    }

    next() {
        this.slideIndex++;
        this.showSlide();
    }
    previous() {
        this.slideIndex--;
        this.showSlide();
    }

    destroy() {
        this.container = null;
        this.items = null;
        this.dots.remove();
        this.slideIndex = 0;
    }




}