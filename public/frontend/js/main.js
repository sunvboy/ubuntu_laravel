$(document).ready(function () {
    $(".js_menu_wrap").click(function (e) {
        e.preventDefault();
        $(".menu-wrap").toggleClass("hidden");
    });
    $(".js_menu_footer").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("active");
        $(this).parent().find("ul").toggleClass("hidden");
    });
    $(".js_menu_top").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("active");
        $(this).parent().find(".js_megamenu").toggleClass("hidden");
    });
    $(".js_menu_child").click(function (e) {
        var id = $(this).attr("data-id");
        e.preventDefault();
        $(".js_menu_child").removeClass("active");
        $(this).toggleClass("active");
        $(".js_group_child").addClass("hidden");
        $(".js_group_child_" + id).removeClass("hidden");
    });
    $(document).on("click", ".js_view_category", function (e) {
        e.preventDefault();
        var type = $(this).attr("data-type");
        $(".view_category a").removeClass("active");
        $(this).addClass("active");
        if (type == "row") {
            $(".grid_category_product")
                .removeClass("lg:grid-cols-2")
                .addClass("lg:grid-cols-1");
        } else {
            $(".grid_category_product")
                .removeClass("lg:grid-cols-1")
                .addClass("lg:grid-cols-2");
        }
    });
    $(document).on("click", ".js_tab_accordion", function (e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        $(this).find(".tab-accordion-title").toggleClass("plus");
        $(".tab-content-" + id).toggleClass("hidden");
    });
    $(".js-tp-search,.js-btnCloseSearch").click(function () {
        $(".js-header-search").toggleClass("hidden");
    });
    $(".tp-cart").click(function () {
        $(".offcanvas-overlay").toggleClass("hidden");
        $("#offcanvas-cart").toggleClass("hidden");
    });
    $(".offcanvas-close, .offcanvas-overlay").on("click", function (e) {
        e.preventDefault();
        $(".offcanvas-overlay").addClass("hidden");
        $("#offcanvas-cart").addClass("hidden ");
    });
});
/*tp-custom*/
$(".js_show_language").on("click", function (e) {
    e.preventDefault();
    $(".js_box_language_mobile").toggleClass("hidden");
});
$(function () {
    $(".lazy").Lazy();
});
var swiper = new Swiper(".mySwiper-productHeader", {
    slidesPerView: 5,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".mySwiper-productHeader .swiper-button-next",
        prevEl: ".mySwiper-productHeader .swiper-button-prev",
    },
});
