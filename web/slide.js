(function() {
    $(document).ready(function(){
        $('.slide').slick({
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 5000,
          pauseOnHover: false,
          pauseOnFocus: false,
          speed: 500,
          fade: true,
          cssEase: 'linear'
        });
    });
}());
