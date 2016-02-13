$(function () {

    // Toggle script ------------------------------------------------------------------------
    $(".toggle-nav").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    // Resize event to check browser viewport ----------------------------------------------
    var wrapper = $("#wrapper");
    $(window).resize(function () {
        if($(window).height() < 450){
            $(".login-footer").hide();
        }

        if($(window).height() < 500){
            $(".copyright").css('position', 'relative');
        }

        if($(window).width() < 767){
            if(!wrapper.hasClass('toggled')){
                wrapper.addClass('toggled');
            }
        }
        else{
            if(wrapper.hasClass('toggled')){
                wrapper.removeClass('toggled');
            }
        }
    });

    $("html").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });

    if($("#wrapper").height() < $(window).height()){
        $("#wrapper").css('position', 'absolute').css('height', '100%').css('width', '100%');
        $(".content").css('min-height', $(window).height() - $('header').height() - $('breadcrumb-wrapper').height() - 40 - 40);
    }

    $("#sidebar-wrapper").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });

    $(".chart .fill").each(function(){
        $(this).height($(this).data('value'));
    });

    $("tbody .css-checkbox").change(function(){
        if($(this).is(':checked')){
            $(this).closest("tr").addClass('success');
        }
        else{
            $(this).closest("tr").removeClass('success');
        }
        checkboxs_check();
    });

    $("thead .css-checkbox").change(function(){
        if($(this).is(':checked')){
            $("tbody .css-checkbox").prop('checked', true);
            $("tbody").find("tr").addClass('success');
        }
        else{
            $("tbody .css-checkbox").prop('checked', false);
            $("tbody").find("tr").removeClass('success');
        }
        checkboxs_check();
    });

    function checkboxs_check(){
        var isChecked = false;
        $("tbody .css-checkbox").each(function(index, count){
            if($(this).is(':checked')){
                isChecked = true;
            }
        });

        if(isChecked){
            $('.group-control').fadeIn(200);
        }
        else{
            $('.group-control').fadeOut(200);
        }
    }

    $(".dropdown.select a").click(function(e){
        e.preventDefault();
        var text = $(this).text().toUpperCase()+" <span class='caret'></span>";
        $(this).closest(".dropdown").find("button.dropdown-toggle").html(text);
    });

    // RATING ------------------------------------------------------------------------
    renderRate();
    function renderRate() {
        $('.rating-wrapper').each(function () {
            var rating = $(this).data('rating');

            $(this).html("");

            for (var index = 0; index < 5; index++) {
                if (index < rating) {
                    $(this).append("<i class='fa fa-circle rated'></i>")
                }
                else {
                    $(this).append("<i class='fa fa-circle unrated'></i>")
                }
            }
        });
    }


    // APPROVE
    $(".approve").click(function(e){
        e.preventDefault();
        $(this).closest("tr").find(".label")
            .removeClass()
            .addClass("label")
            .addClass("label-success")
            .text("PUBLISHED");
    });
    $(".suspend").click(function(e){
        e.preventDefault();
        $(this).closest("tr").find(".label")
            .removeClass()
            .addClass("label")
            .addClass("label-danger")
            .text("SUSPEND");
    });
});