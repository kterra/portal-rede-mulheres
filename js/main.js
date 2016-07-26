jQuery(function ($) {

    $(function () {
        $('#conteudo.carousel').carousel({
            interval: 10000,
            pause: false
        });
    });

    //Ajax contact
    var form = $('.contact-form');
    form.submit(function () {
        // object do form (this)
        $this = $(this);
        // action do form - mail/contact.php
        var url = $this.attr('action');

        /* AJAX $.POST usa os Parametros na seguinte ordem  JQUERY/POST:
        *    url (pagina de envio),
        *    data (dados de envio),
        *    Callback (fun��o que retora o que o php processou)
        * */
        $.post(
            url,
            form.serialize(),
            // Callback
            function (data) {
                console.log(data.message);
                // Mensagem de retorno
                $('.alert-success').text(data.message).fadeIn().delay(5000).fadeOut();
            }
            , 'json'
        );

        return false;
    });


    //smooth scroll #1
    //$('.navbar-nav > li').click(function (event) {
    //
    //    event.preventDefault();
    //    var target = $(this).find('>a').prop('hash');
    //
    //    alert(target);
    //    $('html, body').animate({
    //        scrollTop: $(target).offset().top
    //    }, 500);
    //});

    //smooth scroll #2
    $(function () {
        $('a[href*="#"]:not([href="#"])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 750);
                    // Cancela todos os eventos (semelhantes a este) anteriores
                    // return false;
                }
            }
        });
    });

    //scrollspy
    $('[data-spy="scroll"]').each(function () {
        var $spy = $(this).scrollspy('refresh')
    });

    //PrettyPhoto
    $("a.preview").prettyPhoto({
        social_tools: false
    });

    //Isotope
    $(window).load(function () {
        $portfolio = $('.portfolio-items');
        $portfolio.isotope({
            itemSelector: 'li',
            layoutMode: 'fitRows'
        });
        $portfolio_selectors = $('.portfolio-filter >li>a');
        $portfolio_selectors.on('click', function () {
            $portfolio_selectors.removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            $portfolio.isotope({filter: selector});
            return false;
        });
    });
});
