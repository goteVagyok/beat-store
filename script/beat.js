var swiper = new Swiper(".slide_content", {
    slidesPerView: 3,    //egy slide-on hány elem legyen
    spaceBetween: 7,    //elemek közti hely
    //slidesPerGroup: 1,   //hány elem legyen csoportosítva == lapozásnál hány elemet ugorjon
    loop: true,
    centerSlide: 'true',    //középen legyen a slide (jelen esetben a pöttyök)
    fade: 'true',
    grabCursor: 'true',  //'megfogva' is lehet lapozni
    pagination: {        //pöttyök alul (lapszámozás)
        el: ".swiper-pagination",   //el=element, ez rakja be a kis pöttyöket alulra
        clickable: true,    //kattinthatóak legyenek a pöttyök
        dynamicBullets: true,    //az alsó pontok lapozása lesz dinamikus
    },
    navigation: {
        nextEl: ".swiper-button-next",   //lapozás előre
        prevEl: ".swiper-button-prev",   //lapozás hátra
    },

    breakpoints:{       //a weboldal méret csökkenésekkor kevesebb elem látható egyszerre
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
});