$(window).load(function () {
    $(".preloader").fadeOut(function () {
    //  $(".centerLogo").addClass('show-logo');
    });
});


$(document).ready(function () {
    AOS.init({
        once:true,
    });
    $('.gallery-content').magnificPopup({
        type:'inline',
        midClick: true,
        delegate: 'a',
        gallery: {
            enabled: true
        },
    });
        $(".menu-btn").click(function(){
          $(".menu-res").toggle();
          $(".close-menu-btn").toggleClass("active-close");
          $(".menu-toggle-icon").toggleClass("menu-toggle-icon-close");
          
        });
       

});

var Eventswiper = new Swiper(".eventSwiper", {
  navigation: {
    nextEl: ".event-button-next",
    prevEl: ".event-button-prev",
  },
    breakpoints: {
        600: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        991: {
          slidesPerView: 3,
        },
    1200: {
        slidesPerView: 3,
        spaceBetween: 50,
        }
        
      },
  });

      //the team tab

        const navLinks = document.querySelectorAll('.tab-btn a');

        const windowPathname = window.location.href;
        navLinks.forEach(navLink => {
            if (windowPathname.includes(navLink.href)) {
                navLink.classList.add('active-tab-btn');
              const contentId=  navLink.href.split("/").splice(-1)[0]
              const content = document.querySelector(contentId)
              if(content){
              content.style.display="flex"
              }
                
            }
        //     navLink.addEventListener('click',(event)=>{
        //       for(let i=0;i<navLinks.length;i++){
        //         document.querySelectorAll(".team-box-wrap")[i].style.display="none"
        //         document.querySelectorAll(".tab-btn a")[i].classList.remove("active-tab-btn")
        //       }
        //       const contentId =   event.target.href.split("/").splice(-1)[0]
        //      const content = document.querySelector(contentId)
        //     content.style.display="flex"
        //     event.target.classList.add("active-tab-btn")
        //     })
        // })
        navLink.addEventListener('click', (event) => {
          const teamBoxes = document.querySelectorAll(".team-box-wrap");
          const tabBtns = document.querySelectorAll(".tab-btn a");
          for (let i = 0; i < navLinks.length; i++) {
              const teamBox = teamBoxes[i];
              const tabBtn = tabBtns[i];
              if (teamBox) {
                  teamBox.style.display = "none";
              }
              if (tabBtn) {
                  tabBtn.classList.remove("active-tab-btn");
              }
          }
      
          const contentId = event.target.href.split("/").splice(-1)[0];
          const content = document.querySelector(contentId);
          if (content) {
              content.style.display = "flex";
          }
          event.target.classList.add("active-tab-btn");
      });
    })
      
        
//search animation
const searchBox = document.querySelector(".searchBox");
const searchBtn = document.querySelector(".search-icon-part");
const closeBtn = document.querySelector(".close");

searchBtn.addEventListener("click", (e) => {
  e.preventDefault()
  searchBox.classList.add("active");
  document.getElementById("search-input").focus()
});
closeBtn.addEventListener("click", () => {
  searchBox.classList.remove("active");
});


