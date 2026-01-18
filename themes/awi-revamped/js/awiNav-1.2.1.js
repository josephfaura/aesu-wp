(function($){

var nav = $(".awiNav"),
  submenus = $(".awiNav ul"),
  hasSubmenu = $(".awiNav ul").parent("li"),
  hasSubmenuLink = $(".awiNav ul").siblings("a");

nav.wrap('<div class="awiNav-wrap">');
var navWrap = $(".awiNav-wrap");

$('<div class="awiNav-cover">').insertBefore(navWrap);

$(
  '<button class="awiNav__trigger"><span></span><span></span><span></span></button>'
).insertBefore(navWrap);
var navTrigger = $(".awiNav__trigger");

navWrap.prepend(
  '<button class="awiNav__close"><span></span><span></span></button>'
);
var navClose = $(".awiNav__close");

var isMobile = (navWrap.css("position") === "fixed" && navTrigger.css("display") !== "none"),
  isCollapsable = nav.hasClass("collapsable");

$(window).on("load", function() {
  isMobile = (navWrap.css("position") === "fixed" && navTrigger.css("display") !== "none");
});

$(window).resize(function() {
  isMobile = (navWrap.css("position") === "fixed" && navTrigger.css("display") !== "none");
});

hasSubmenu.each(function() {
  var theLink = $(this).children("a");
  var theParent = $(this);
  theLink.wrap('<div class="awiNav__links">');
  $('<a href="#" class="awiNav__togglesub">Open Dropdown</a>').insertAfter(
    theLink
  );
  if (theLink.attr("href") === "#") {
    theLink.addClass("awiNav__alsotoggle");
  }
});

var submenuTriggers = $(".awiNav__togglesub, .awiNav__alsotoggle");

function toggleNav() {
  $(".awiNav-cover").fadeToggle(300);
  if ("ontransitionend" in document.documentElement) {
    navWrap.one("transitionend", function() {
      if (!navWrap.hasClass("nav-shown")) {
        nav
          .find("li")
          .removeAttr("style")
          .removeClass("nav-shown nav-hidden sub-shown");
        submenus.removeAttr("style").removeClass("nav-shown nav-hidden");
        nav.find("a").removeClass("sub-shown nav-hidden").removeAttr("style");
      }
    });
  } else {
    if (!navWrap.hasClass("nav-shown")) {
      nav
        .find("li")
        .removeAttr("style")
        .removeClass("nav-shown nav-hidden sub-shown");
      submenus.removeAttr("style").removeClass("nav-shown nav-hidden");
      nav.find("a").removeClass("sub-shown nav-hidden").removeAttr("style");
    }
  }

  navWrap.toggleClass("nav-shown");
}
navTrigger.click(toggleNav);
navClose.click(toggleNav);
$(".awiNav-cover").click(toggleNav);

function toggleSubNav(e) {
  if (!isMobile) return;

  e.preventDefault();
  var el = $(this);
  var parentSibs = el.parent("div").parent("li").siblings("li");
  var theSub = el.parent("div").siblings("ul");

  el.parent("div").parent("li").toggleClass("sub-shown");

  theSub.slideToggle(300, function() {
    if (theSub.css("display") === "none") {
      theSub
        .removeClass("nav-shown")
        .addClass("nav-hidden")
        .removeAttr("style");
    } else {
      theSub
        .removeClass("nav-hidden")
        .addClass("nav-shown")
        .removeAttr("style");
    }
  });
}

submenuTriggers.click(toggleSubNav);

// Begin collapsable

var containerWidth = $(".awiNav").width(),
  navWidth = getNavWidth($(".awiNav > li")),
  isCollapsed = 0;

if (!isMobile) {
  $(".awiNav > li").each(function() {
    $(this).data("width", $(this).outerWidth());
  });
}

$(window).on('load', function(){
  if (!isMobile) {
    $(".awiNav > li").each(function() {
      $(this).data("width", $(this).outerWidth());
    });
  }
});

function getNavWidth(els) {
  var totalWidth = 0;
  els.each(function() {
    if ($(this).data("width")) {
      totalWidth += $(this).data("width");
    } else {
      totalWidth += $(this).outerWidth();
    }
  });

  return totalWidth;
}

function updateNav() {
  containerWidth = $(".awiNav").width();
  navWidth = getNavWidth($(".awiNav > li"));
  originalNavWidth =
    getNavWidth($(".awiNav > li:not(.more-links)")) +
    getNavWidth($(".awiNav .more-links > ul > li"));
  if (
    $(".awiNav .more-links > ul > li").length <= 2 &&
    originalNavWidth < containerWidth
  ) {
    navWidth = getNavWidth($(".awiNav > li:not(.more-links)"));
  }

  if (!isMobile) {
    if (!$(".awiNav > li").data("width")) {
      $(".awiNav > li").each(function() {
        $(this).data("width", $(this).outerWidth());
      });
    }

    if (navWidth < containerWidth && isCollapsed) {
      if ($(".awiNav .more-links > ul > li").length > 2) {
        if (
          $(".awiNav .more-links > ul > li").first().data("width") + navWidth <
          containerWidth
        ) {
          $(".awiNav .more-links > ul > li")
            .first()
            .insertBefore($(".awiNav .more-links"));
        }
      } else {
        var allChildWidth = getNavWidth($(".awiNav .more-links > ul > li"));

        if (allChildWidth + navWidth < containerWidth) {
          $(".awiNav .more-links > ul > li").insertBefore(
            $(".awiNav .more-links")
          );
          $(".awiNav .more-links").detach();
          isCollapsed = 0;
        }
      }
    } else if (navWidth > containerWidth) {
      if (!isCollapsed) {
        isCollapsed = 1;

        var diff = navWidth - containerWidth;
        var i = 0;

        $(".awiNav > li").each(function() {
          if (diff > 0) {
            diff -= $(this).data("width");
            i++;
          }
        });

        i++;

        $(".awiNav").append(
          '<li class="more-links"><a href="#">More...</a><ul></ul></li>'
        );
        $(".awiNav .more-links").data(
          "width",
          $(".awiNav .more-links").outerWidth()
        );
        $(".awiNav > li:not(.more-links)")
          .slice(0 - i)
          .prependTo($(".awiNav .more-links > ul"));
      } else {
        $(".awiNav > li:not(.more-links)")
          .last()
          .prependTo($(".awiNav .more-links > ul"));
      }
    }
  } else {
    if (isCollapsed) {
      $(".awiNav .more-links > ul > li").insertBefore($(".awiNav .more-links"));
      $(".awiNav .more-links").detach();
      isCollapsed = 0;
    }
  }
}

if (isCollapsable) {
  updateNav();
  updateNav();
  $('window').on('load', function(){
    updateNav();
    updateNav();
  });
  $(window).on("resize", updateNav);
}

}(jQuery))
