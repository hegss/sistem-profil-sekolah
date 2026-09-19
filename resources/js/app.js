import './bootstrap';

import Alpine from 'alpinejs';

import ApexCharts from 'apexcharts';

window.ApexCharts = ApexCharts;

window.Alpine = Alpine;

Alpine.start();

/* LOGIN IMAGE SLIDER */
document.addEventListener("DOMContentLoaded",function(){
    const sliderArea=document.querySelector(".login-slider");
    const slider=document.querySelector(".login-slider-list");
    const slides=document.querySelectorAll(".login-slide");
    const dots=document.querySelectorAll(".login-slider-dot .login-dot");
    if(!sliderArea||!slider||slides.length===0)return;
    let currentSlide=0;
    let autoSlideTimer;
    let isDragging=false;
    let startX=0;
    let currentTranslate=0;
    let previousTranslate=0;
    const totalSlides=slides.length;
    function getMoveDistance(index){
        return index*sliderArea.offsetWidth;
    }
    function showSlide(index){
        currentSlide=Math.max(0,Math.min(index,totalSlides-1));
        const moveDistance=getMoveDistance(currentSlide);
        currentTranslate=-moveDistance;
        previousTranslate=currentTranslate;
        slider.style.transition="transform 0.6s ease";
        slider.style.transform=`translateX(${currentTranslate}px)`;
        dots.forEach(function(dot){
            dot.classList.remove("active-login-dot");
        });
        if(dots[currentSlide]){
            dots[currentSlide].classList.add("active-login-dot");
        }
    }
    function nextSlide(){
        currentSlide++;
        if(currentSlide>=totalSlides){
            currentSlide=0;
        }
        showSlide(currentSlide);
    }
    function startAutoSlide(){
        clearInterval(autoSlideTimer);
        autoSlideTimer=setInterval(function(){
            nextSlide();
        },4000);
    }
    function stopAutoSlide(){
        clearInterval(autoSlideTimer);
    }
    dots.forEach(function(dot,index){
        dot.addEventListener("click",function(){
            currentSlide=index;
            showSlide(currentSlide);
            startAutoSlide();
        });
    });
    sliderArea.addEventListener("mousedown",function(event){
        isDragging=true;
        startX=event.clientX;
        stopAutoSlide();
        slider.style.transition="none";
        sliderArea.classList.add("dragging");
    });
    sliderArea.addEventListener("mousemove",function(event){
        if(!isDragging)return;
        const difference=event.clientX-startX;
        currentTranslate=previousTranslate+difference;
        const maxTranslate=0;
        const minTranslate=-getMoveDistance(totalSlides-1);
        if(currentTranslate>maxTranslate){
            currentTranslate=maxTranslate;
        }
        if(currentTranslate<minTranslate){
            currentTranslate=minTranslate;
        }
        slider.style.transform=`translateX(${currentTranslate}px)`;
    });
    sliderArea.addEventListener("mouseup",finishDrag);
    sliderArea.addEventListener("mouseleave",function(){
        if(isDragging){
            finishDrag();
        }else{
            startAutoSlide();
        }
    });
    function finishDrag(){
        if(!isDragging)return;
        isDragging=false;
        sliderArea.classList.remove("dragging");
        const slideWidth=sliderArea.offsetWidth;
        currentSlide=Math.round(Math.abs(currentTranslate)/slideWidth);
        currentSlide=Math.max(0,Math.min(currentSlide,totalSlides-1));
        showSlide(currentSlide);
        startAutoSlide();
    }
    sliderArea.addEventListener("mouseenter",function(){
        stopAutoSlide();
    });
    window.addEventListener("resize",function(){
        showSlide(currentSlide);
    });
    showSlide(currentSlide);
    startAutoSlide();
});
