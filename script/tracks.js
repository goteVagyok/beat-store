
//----------------------Scrollbars------------------------//
let leftScroll = document.getElementById('left_scroll');
let rightScroll = document.getElementById('right_scroll');
let sliderContent = document.getElementsByClassName('slider_content')[0];

leftScroll.addEventListener('click', ()=>{
    sliderContent.scrollLeft -= 300;
})
rightScroll.addEventListener('click', ()=>{
    sliderContent.scrollLeft += 300;
})

let leftScroll2 = document.getElementById('left_scroll2');
let rightScroll2 = document.getElementById('right_scroll2');
let sliderContent2 = document.getElementsByClassName('slider_content2')[0];

leftScroll2.addEventListener('click', ()=>{
    sliderContent2.scrollLeft -= 300;
})
rightScroll2.addEventListener('click', ()=>{
    sliderContent2.scrollLeft += 300;
})

let leftScroll3 = document.getElementById('left_scroll3');
let rightScroll3 = document.getElementById('right_scroll3');
let sliderContent3 = document.getElementsByClassName('slider_content3')[0];

leftScroll3.addEventListener('click', ()=>{
    sliderContent3.scrollLeft -= 300;
})
rightScroll3.addEventListener('click', ()=>{
    sliderContent3.scrollLeft += 300;
})