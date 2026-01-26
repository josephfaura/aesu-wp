/* Autoplay Home Page Banner Video on Desktop and Click to Play in Frame on Mobile */
(function($){

    const video = $('.banner_video').get(0);
    const playBtn = $('.play_banner_video');

    if (!video) return; // safety

    // Lazy-load when visible
    const observer = new IntersectionObserver((entries)=>{
        entries.forEach(entry=>{
            if(entry.isIntersecting){
                video.load();

                // Desktop autoplay
                if(window.innerWidth >= 768){
                    video.play();
                }

                observer.disconnect();
            }
        });
    });
    observer.observe(video);

    // MOBILE: click to play
    playBtn.on('click', function(){
        video.play();
        $(this).fadeOut();
    });

})(jQuery);