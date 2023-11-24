document.addEventListener("DOMContentLoaded", function(){
    scrollNav();
});

function scrollNav(){
    const links = document.querySelectorAll(".links a");
    links.forEach(l => {
        l.addEventListener("click", function(e){
            e.preventDefault();
            const section = document.querySelector(e.target.attributes.href.value);
            section.scrollIntoView({behavior: "smooth"});
        })
    })
}