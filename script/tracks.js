
//----------------------Scrollbar------------------------//
let leftScroll = document.getElementById('left_scroll');
let rightScroll = document.getElementById('right_scroll');
let sliderContent = document.getElementsByClassName('slider_content')[0];

leftScroll.addEventListener('click', ()=>{
    sliderContent.scrollLeft -= 300;
})
rightScroll.addEventListener('click', ()=>{
    sliderContent.scrollLeft += 300;
})