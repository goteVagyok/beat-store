
//----------------------Scrollbar------------------------//
let leftScroll = document.getElementById('left_scroll');
let rightScroll = document.getElementById('right_scroll');
let sliderContent = document.getElementsByClassName('slider_content')[0];

leftScroll.addEventListener('click', ()=>{
    sliderContent.leftScroll -= 300;
})
rightScroll.addEventListener('click', ()=>{
    sliderContent.rightScroll += 300;
})