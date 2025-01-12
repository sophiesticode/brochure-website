
/* le carousel */
var carousels = document.getElementsByClassName("carousel-container");
console.log(carousels);

var indicators = true;
var controls = true;
var autoSlide = true;
var slideInterval = 4000; // Default to 4 sec

var selectedIndex = 0;

// autoslide
if (autoSlide) {
    autoSlideImages();
}

// changes slide in every 4 sec
function autoSlideImages() {
    setInterval(() => {
        if (autoSlide) {
            for (let item of carousels) {
                next(item);
            }
        };
    }, slideInterval);
}

function next(parentElement){
    var divEnfants = document.querySelectorAll('#' + parentElement.id + '> div');

    for(i = 0; i < divEnfants.length; i++){
        if(divEnfants[i].classList.contains('image-active')){
            divEnfants[i].classList.remove('image-active');
            break;
        }
    }
    if(i === divEnfants.length-1){
        divEnfants[0].classList.add('image-active');
    } else {
        divEnfants[i+1].classList.add('image-active');
    }
}

function onPrevClick() {
    var parentDiv = event.target.parentNode.parentNode;
    var divEnfants = document.querySelectorAll('#' + parentDiv.id + '> div');

    for(i = divEnfants.length-1; i >= 0; i--){
        if(divEnfants[i].classList.contains('image-active')){
            divEnfants[i].classList.remove('image-active');
            break;
        }
    }
    if(i === 0){
        divEnfants[divEnfants.length-1].classList.add('image-active');
        console.log(divEnfants[divEnfants.length-1]);
    } else {
        divEnfants[i-1].classList.add('image-active');
    }
}

function onNextClick() {
    var parentDiv = event.target.parentNode.parentNode;
    next(parentDiv);
}
