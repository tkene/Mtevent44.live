
//  <!===========================================================================================>
//  <!=============================EFFET PARALLAX SUR LA PAGE IDEE===============================>
//  <!===========================================================================================>

var controller = new ScrollMagic.Controller();

var scene = new ScrollMagic.Scene({

    //triggerElement: '.box1',
    reverse: false


})

    .setClassToggle('.box1', 'fade-in')
    // //.addIndicators({
    //     //name: 'INDICATIONS',
    //     indent: 200,
    //     colorStart: '#fff'
    // })
    .addTo(controller);


var scene2 = new ScrollMagic.Scene({

    //triggerElement: '.box2',
    reverse: false


})

    .setClassToggle('.box2', 'fade-in')
    // .addIndicators({
    //     //name: 'INDICATIONS',
    //     indent: 200,
    //     colorStart: '#fff'
    // })
    .addTo(controller);

var scene3 = new ScrollMagic.Scene({

    //triggerElement: '.box3',
    reverse: false


})

    .setClassToggle('.box3', 'fade-in')
    // .addIndicators({
    //     //name: 'INDICATIONS',
    //     indent: 200,
    //     colorStart: '#fff'
    // })
    .addTo(controller);



//  <!===================================================================================================>
//  <!======================================Animation photo accueil======================================>
//  <!===================================================================================================>


/* Demo purposes only */
$(".hover").mouseleave(
    function () {
        $(this).removeClass("hover");
    }
);




//  <!===================================================================================================>
//  <!======================================Animation password ===========================================>
//  <!===================================================================================================>

/* Password strength indicator */
function passwordStrength(password) {



    //var msg = ['not acceptable', 'very weak', 'weak', 'standard', 'looks good', 'yeahhh, strong mate.'];

    var desc = ['0%', '20%', '40%', '60%', '80%', '100%'];

    var descClass = ['', 'bg-danger', 'bg-warning', 'bg-warning', 'bg-success', 'bg-success'];

    var score = 0;

    // if mot de passe contient + de 5 caractères attribuer 1 point
    if (password.length > 5) score++;

    // if mot de passe contient une miniscule attribuer 1 point
    if (password.match(/[a-z]/)) score++;

    // if mot de passe contient une majuscule attribuer 1 point
    if (password.match(/[A-Z]/)) score++;

    // if mot de passe à au moins un chiffre attribuer 1 point
    if (password.match(/[0-9]/)) score++;

    // if mot de passe contient un caractères spéciaux attribuer 1 point
    if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) score++;

    // if mot de passe contient + de 10 caractères attribuer 1 point
    if (password.length > 10) score++;

    // Affiche l'indicateur
    $(".jak_pstrength").removeClass(descClass[score - 1]).addClass(descClass[score]).css("width", desc[score]);

    // Indicateur avec un texte
    // $("#jak_pstrength_text").html(msg[score]);

    // La sortie du score dans le journal de la console peut être supprimée lorsqu'elle est utilisée en direct.
    console.log(desc[score]);
}






//  <!===================================================================================================>
//  <!========================script pour bouton remonter en haut de la page ============================>
//  <!===================================================================================================>



document.addEventListener('DOMContentLoaded', function () {
    window.onscroll = function (ev) {
        document.getElementById("cRetour").className = (window.pageYOffset > 100) ? "cVisible" :
            "cInvisible";
    };
});


// http://trucsweb.com/tutoriels/javascript/defilement_doux
document.addEventListener('DOMContentLoaded', function () {
    var aLiens = document.querySelectorAll('a[href*="#"]');
    for (var i = 0, len = aLiens.length; i < len; i++) {
        aLiens[i].onclick = function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = this.getAttribute("href").slice(1);
                if (target.length) {
                    scrollTo(document.getElementById(target).offsetTop, 1000);
                    return false;
                }
            }
        };
    }
});
//Exemple de : Forestrf
// http://jsfiddle.net/forestrf/tPQSv/2/
function scrollTo(element, duration) {
    var e = document.documentElement;
    if (e.scrollTop === 0) {
        var t = e.scrollTop;
        ++e.scrollTop;
        e = t + 1 === e.scrollTop-- ? e : document.body;
    }
    scrollToC(e, e.scrollTop, element, duration);
}

function scrollToC(element, from, to, duration) {
    if (duration < 0) return;
    if (typeof from === "object") from = from.offsetTop;
    if (typeof to === "object") to = to.offsetTop;
    scrollToX(element, from, to, 0, 1 / duration, 20, easeOutCuaic);
}

function scrollToX(element, x1, x2, t, v, step, operacion) {
    if (t < 0 || t > 1 || v <= 0) return;
    element.scrollTop = x1 - (x1 - x2) * operacion(t);
    t += v * step;
    setTimeout(function () {
        scrollToX(element, x1, x2, t, v, step, operacion);
    }, step);
}

function easeOutCuaic(t) {
    t--;
    return t * t * t + 1;
}








