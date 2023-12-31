function dt_custom_view(e, t, n, i) {
    var a;
    a = void 0 === n ? "custom_view" : n, void 0 !== i && ($("._filters input").val(""), $("._filter_data li.active").removeClass("active"));
    do_filter_active(a) != a && (e = ""), $('input[name="' + a + '"]').val(e)
}

function do_filter_active(e, t) {
    if ("" != e && void 0 !== e) {
        $('[data-cview="all"]').parents("li").removeClass("active");
        var n = $('[data-cview="' + e + '"]');
        if (void 0 !== t && (n = $(t + ' [data-cview="' + e + '"]')), n.parents("li").not(".dropdown-submenu").hasClass("active")) {
            n.parents("li").not(".dropdown-submenu").removeClass("active");
            var i = n.parents("li.dropdown-submenu");
            i.length > 0 && 0 == i.find("li.active").length && i.removeClass("active"), e = ""
        } else n.parents("li").addClass("active");
        return e
    }
    return $("._filters input").val(""), $("._filter_data li.active").removeClass("active"), $('[data-cview="all"]').parents("li").addClass("active"), ""
}

$(window).load(function () {
    $("#loader-wrapper").delay(250).fadeOut(function () {
        $("#loader-wrapper").remove()
    })
}), function (e, t, n, i) {
    n(function () {
        n('[data-toggle="popover"]').popover(), n(".offsidebar.hide").removeClass("hide"), n('[data-toggle="tooltip"]').tooltip({container: "body"}), n(".dropdown input").on("click focus", function (e) {
            e.stopPropagation()
        })
    })
}(window, document, window.jQuery), function (e, t, n) {
    "use strict";
    e(n).on("click", "[data-reset-key]", function (n) {
        n.preventDefault();
        var i = e(this).data("resetKey");
        i ? (e.localStorage.remove(i), t.location.reload()) : e.error("No storage key specified for reset.")
    })
}(jQuery, window, document), function (e, t, n, i) {
    e.APP_COLORS = {
        primary: "#5d9cec",
        success: "#27c24c",
        info: "#23b7e5",
        warning: "#ff902b",
        danger: "#f05050",
        inverse: "#131e26",
        green: "#37bc9b",
        pink: "#f532e5",
        purple: "#7266ba",
        dark: "#1e1e2d",
        yellow: "#fad732",
        "gray-darker": "#232735",
        "gray-dark": "#1e1e2d",
        gray: "#dde6e9",
        "gray-light": "#e4eaec",
        "gray-lighter": "#edf1f2"
    }, e.APP_MEDIAQUERY = {desktopLG: 1200, desktop: 992, tablet: 768, mobile: 480}
}(window, document, window.jQuery), function (e, t, n, i) {
    var a, o, r, s;

    function l(e) {
        e.siblings("li").removeClass("open").end().toggleClass("open")
    }

    function d() {
        n(".sidebar-subnav.nav-floating").remove(), n(".dropdown-backdrop").remove(), n(".sidebar li.open").removeClass("open")
    }

    function c() {
        return r.hasClass("aside-hover")
    }

    n(function () {
        a = n(e), o = n("html"), r = n("body"), s = n(".sidebar"), APP_MEDIAQUERY;
        var t = s.find(".collapse");
        t.on("show.bs.collapse", function (e) {
            e.stopPropagation(), 0 === n(this).parents(".collapse").length && t.filter(".in").collapse("hide")
        });
        var i = n(".sidebar .active").parents("li");
        c() || i.addClass("active").children(".collapse").collapse("show"), s.find("li > a + ul").on("show.bs.collapse", function (e) {
            c() && e.preventDefault()
        });
        var u = o.hasClass("touch") ? "click" : "mouseenter", f = n();
        s.on(u, ".nav > li", function () {
            (r.hasClass("aside-collapsed") || c()) && (f.trigger("mouseleave"), f = function (e) {
                d();
                var t = e.children("ul");
                if (!t.length) return n();
                if (e.hasClass("open")) return l(e), n();
                var i = n(".aside"), o = n(".aside-inner"),
                    c = parseInt(o.css("padding-top"), 0) + parseInt(i.css("padding-top"), 0),
                    u = t.clone().appendTo(i);
                l(e);
                var f = e.position().top + c - s.scrollTop(), m = a.height();
                return u.addClass("nav-floating").css({
                    position: r.hasClass("layout-fixed") ? "fixed" : "absolute",
                    top: f,
                    bottom: u.outerHeight(!0) + f > m ? 0 : "auto"
                }), u.on("mouseleave", function () {
                    l(e), u.remove()
                }), u
            }(n(this)), n("<div/>", {class: "dropdown-backdrop"}).insertAfter(".aside").on("click mouseenter", function () {
                d()
            }))
        }), void 0 !== s.data("sidebarAnyclickClose") && n(".wrapper").on("click.sidebar", function (e) {
            if (r.hasClass("aside-toggled")) {
                var t = n(e.target);
                t.parents(".aside").length || t.is("#user-block-toggle") || t.parent().is("#user-block-toggle") || r.removeClass("aside-toggled")
            }
        })
    })
}(window, document, window.jQuery), function (e, t, n, i) {
    n(function () {
        var t = n("body");
        toggle = new StateToggler, n("[data-toggle-state]").on("click", function (i) {
            i.stopPropagation();
            var a = n(this), o = a.data("toggleState"), r = a.data("target"), s = void 0 !== a.attr("data-no-persist"),
                l = r ? n(r) : t;
            o && (l.hasClass(o) ? (l.removeClass(o), s || toggle.removeState(o)) : (l.addClass(o), s || toggle.addState(o))), n(e).resize()
        })
    }), e.StateToggler = function () {
        var e = {
            hasWord: function (e, t) {
                return new RegExp("(^|\\s)" + t + "(\\s|$)").test(e)
            }, addWord: function (e, t) {
                if (!this.hasWord(e, t)) return e + (e ? " " : "") + t
            }, removeWord: function (e, t) {
                if (this.hasWord(e, t)) return e.replace(new RegExp("(^|\\s)*" + t + "(\\s|$)*", "g"), "")
            }
        };
        return {
            addState: function (t) {
                var i = n.localStorage.get("jq-toggleState");
                i = i ? e.addWord(i, t) : t, n.localStorage.set("jq-toggleState", i)
            }, removeState: function (t) {
                var i = n.localStorage.get("jq-toggleState");
                i && (i = e.removeWord(i, t), n.localStorage.set("jq-toggleState", i))
            }, restoreState: function (e) {
                var t = n.localStorage.get("jq-toggleState");
                t && e.addClass(t)
            }
        }
    }
}(window, document, window.jQuery), function (e, t, n) {
    "use strict";
    var i, a, o = e("html"), r = e(t);
    e.support.transition = (i = function () {
        var e, t = n.body || n.documentElement, i = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        };
        for (e in i) if (void 0 !== t.style[e]) return i[e]
    }()) && {end: i}, e.support.animation = (a = function () {
        var e, t = n.body || n.documentElement, i = {
            WebkitAnimation: "webkitAnimationEnd",
            MozAnimation: "animationend",
            OAnimation: "oAnimationEnd oanimationend",
            animation: "animationend"
        };
        for (e in i) if (void 0 !== t.style[e]) return i[e]
    }()) && {end: a}, e.support.requestAnimationFrame = t.requestAnimationFrame || t.webkitRequestAnimationFrame || t.mozRequestAnimationFrame || t.msRequestAnimationFrame || t.oRequestAnimationFrame || function (e) {
        t.setTimeout(e, 1e3 / 60)
    }, e.support.touch = "ontouchstart" in t && navigator.userAgent.toLowerCase().match(/mobile|tablet/) || t.DocumentTouch && document instanceof t.DocumentTouch || t.navigator.msPointerEnabled && t.navigator.msMaxTouchPoints > 0 || t.navigator.pointerEnabled && t.navigator.maxTouchPoints > 0 || !1, e.support.mutationobserver = t.MutationObserver || t.WebKitMutationObserver || t.MozMutationObserver || null, e.Utils = {}, e.Utils.debounce = function (e, t, n) {
        var i;
        return function () {
            var a = this, o = arguments, r = n && !i;
            clearTimeout(i), i = setTimeout(function () {
                i = null, n || e.apply(a, o)
            }, t), r && e.apply(a, o)
        }
    }, e.Utils.removeCssRules = function (e) {
        var t, n, i, a, o, r, s, l, d, c;
        e && setTimeout(function () {
            try {
                for (c = document.styleSheets, a = 0, s = c.length; a < s; a++) {
                    for (i = c[a], n = [], i.cssRules = i.cssRules, t = o = 0, l = i.cssRules.length; o < l; t = ++o) i.cssRules[t].type === CSSRule.STYLE_RULE && e.test(i.cssRules[t].selectorText) && n.unshift(t);
                    for (r = 0, d = n.length; r < d; r++) i.deleteRule(n[r])
                }
            } catch (e) {
            }
        }, 0)
    }, e.Utils.isInView = function (t, n) {
        var i = e(t);
        if (!i.is(":visible")) return !1;
        var a = r.scrollLeft(), o = r.scrollTop(), s = i.offset(), l = s.left, d = s.top;
        return n = e.extend({
            topoffset: 0,
            leftoffset: 0
        }, n), d + i.height() >= o && d - n.topoffset <= o + r.height() && l + i.width() >= a && l - n.leftoffset <= a + r.width()
    }, e.Utils.options = function (t) {
        if (e.isPlainObject(t)) return t;
        var n = t ? t.indexOf("{") : -1, i = {};
        if (-1 != n) try {
            i = new Function("", "var json = " + t.substr(n) + "; return JSON.parse(JSON.stringify(json));")()
        } catch (e) {
        }
        return i
    }, e.Utils.events = {}, e.Utils.events.click = e.support.touch ? "tap" : "click", e.langdirection = "rtl" == o.attr("dir") ? "right" : "left", e(function () {
        e.support.mutationobserver && new e.support.mutationobserver(e.Utils.debounce(function (t) {
            e(n).trigger("domready")
        }, 300)).observe(document.body, {childList: !0, subtree: !0})
    }), o.addClass(e.support.touch ? "touch" : "no-touch")
}(jQuery, window, document), function (e, t, n, i) {
    "undefined" != typeof screenfull && n(function () {
        var i = n(t), a = n("[data-toggle-fullscreen]"), o = e.navigator.userAgent;

        function r(e) {
            screenfull.isFullscreen ? e.children("em").removeClass("fa-expand").addClass("fa-compress") : e.children("em").removeClass("fa-compress").addClass("fa-expand")
        }

        (o.indexOf("MSIE ") > 0 || o.match(/Trident.*rv\:11\./)) && a.addClass("hide"), a.is(":visible") && (a.on("click", function (e) {
            e.preventDefault(), screenfull.enabled ? (screenfull.toggle(), r(a)) : console.log("Fullscreen not enabled")
        }), screenfull.raw && screenfull.raw.fullscreenchange && i.on(screenfull.raw.fullscreenchange, function () {
            r(a)
        }))
    })
}(window, document, window.jQuery), $(function () {
    $(".start_date").datepicker({
        autoclose: !0,
        format: "yyyy-mm-dd",
        todayBtn: "linked"
    }).on("changeDate", function () {
        $(".end_date").datepicker("setStartDate", new Date($(this).val()))
    }), $(".end_date").datepicker({
        autoclose: !0,
        format: "yyyy-mm-dd",
        todayBtn: "linked"
    }).on("changeDate", function () {
        $(".start_date").datepicker("setEndDate", new Date($(this).val()))
    }), $(".datepicker").datepicker({
        autoclose: !0,
        format: "yyyy-mm-dd",
        todayBtn: "linked"
    }), $(".monthyear").datepicker({
        autoclose: !0,
        startView: 1,
        format: "yyyy-mm",
        minViewMode: 1
    }), $(".years").datepicker({
        startView: 2,
        format: "yyyy",
        minViewMode: 2,
        autoclose: !0
    }), $(".textarea").summernote({codemirror: {theme: "monokai"}}), $("div.note-insert,div.note-group-select-from-files,.note-toolbar .note-fontsize,.note-toolbar .note-help,.note-toolbar .note-fontname,.note-toolbar .note-height,.note-toolbar .note-table").remove(), $(".textarea_").summernote({
        height: 200,
        codemirror: {theme: "monokai"}
    }), $("div.note-insert,div.note-group-select-from-files,.note-toolbar .note-fontsize,.note-toolbar .note-help,.note-toolbar .note-fontname,.note-toolbar .note-height,.note-toolbar .note-table").remove(), $(".textarea_lg").summernote({
        height: 300,
        codemirror: {theme: "monokai"}
    }), $("div.note-insert,div.note-group-select-from-files,.note-toolbar .note-fontsize,.note-toolbar .note-help,.note-toolbar .note-fontname,.note-toolbar .note-height,.note-toolbar .note-table").remove(), $(".textarea-md").summernote({
        height: 90,
        codemirror: {theme: "monokai"}
    }), $("div.note-insert,div.note-group-select-from-files,.note-toolbar .note-fontsize,.note-toolbar .note-help,.note-toolbar .note-fontname,.note-toolbar .note-height,.note-toolbar .note-table").remove(), $(".timepicker").timepicker(), $(".timepicker2").timepicker({
        minuteStep: 1,
        showSeconds: !1,
        showMeridian: !1,
        defaultTime: !1
    })
}), function (e, t, n, i) {
    n(function () {
        var t = n(e), i = "js-is-in-view";

        function a(e, t) {
            !e.hasClass(i) && n.Utils.isInView(e, {topoffset: -20}) && o(e, t)
        }

        function o(e, t) {
            e.ClassyLoader(t).addClass(i)
        }

        n("[data-classyloader]").each(function () {
            var e = n(this), i = e.data();
            i && (i.triggerInView ? (t.scroll(function () {
                a(e, i)
            }), a(e, i)) : o(e, i))
        })
    })
}(window, document, window.jQuery), function (e, t, n, i) {
    n(function () {
        if (n.fn.easyPieChart) {
            var e = {
                animate: {duration: 800, enabled: !0},
                barColor: APP_COLORS.success,
                trackColor: !1,
                scaleColor: !1,
                lineWidth: 10,
                lineCap: "circle"
            };
            n(".easypiechart").easyPieChart(e);
            var t = {
                animate: {duration: 800, enabled: !0},
                barColor: APP_COLORS.warning,
                trackColor: !1,
                scaleColor: !1,
                lineWidth: 4,
                lineCap: "circle"
            };
            n("#easypie2").easyPieChart(t);
            var i = {
                animate: {duration: 800, enabled: !0},
                barColor: APP_COLORS.danger,
                trackColor: APP_COLORS["gray-light"],
                scaleColor: APP_COLORS.gray,
                size: 200,
                lineWidth: 15,
                lineCap: "circle"
            };
            n("#easypie3").easyPieChart(i);
            var a = {
                animate: {duration: 800, enabled: !0},
                barColor: APP_COLORS.danger,
                trackColor: APP_COLORS.yellow,
                scaleColor: APP_COLORS["gray-dark"],
                lineWidth: 10,
                lineCap: "circle"
            };
            n("#easypie4").easyPieChart(a)
        }
    })
}(window, document, window.jQuery), function (e, t, n, i) {
    n(function () {
        var e = n("#maincss"), t = n("#bscss");
        n("#chk-rtl").on("change", function () {
            e.attr("href", this.checked ? "../../assets/css/app-rtl.css" : "../../assets/css/app.css"), t.attr("href", this.checked ? "../../assets/css/bootstrap-rtl.css" : "../../assets/css/bootstrap.css")
        })
    })
}(window, document, window.jQuery), function (e, t, n, i) {
    n(function () {
        n("[data-load-css]").on("click", function (e) {
            var t = n(this);
            t.is("a") && e.preventDefault();
            var i = t.data("loadCss");
            i ? function (e) {
                var t = "autoloaded-stylesheet", i = n("#" + t).attr("id", t + "-old");
                n("head").append(n("<link/>").attr({id: t, rel: "stylesheet", href: e})), i.length && i.remove();
                return n("#" + t)
            }(i) || n.error("Error creating stylesheet link element.") : n.error("No stylesheet location defined.")
        })
    })
}(window, document, window.jQuery), function (e, t, n, i) {
    n(function () {
        n("[data-check-all]").on("change", function () {
            var e = n(this), t = e.index() + 1, i = e.find('input[type="checkbox"]');
            e.parents("table").find("tbody > tr > td:nth-child(" + t + ') input[type="checkbox"]').prop("checked", i[0].checked)
        })
    }), n(function () {
        n("#parent_present").on("change", function () {
            n(".child_present").prop("checked", n(this).prop("checked"))
        }), n(".child_present").on("change", function () {
            n(".child_present").prop(!!n(".child_present:checked").length)
        }), n("#parent_absent").on("change", function () {
            n(".child_absent").prop("checked", n(this).prop("checked"))
        }), n(".child_absent").on("change", function () {
            n(".child_absent").prop(!!n(".child_absent:checked").length)
        })
    }), n("#check_related").change(function () {
        n(".company").hide(), n(".company").attr("disabled", "disabled")
    }), "2" == n("#client_stusus").val() ? n(".company").removeAttr("disabled") : (n(".company").attr("disabled", "disabled"), n(".company").hide()), n(function () {
        n('input[id="use_postmark"]').on("click", function () {
            this.checked ? n("div#postmark_config").show() : n("div#postmark_config").hide()
        }), n('input[id="for_leads"]').on("click", function () {
            this.checked ? n("div#imap_search_for_leads").show() : n("div#imap_search_for_leads").hide()
        }), n('input[id="for_tickets"]').on("click", function () {
            this.checked ? n("div#imap_search_for_tickets").show() : n("div#imap_search_for_tickets").hide()
        }), n("#protocol").change(function () {
            "smtp" == n("#protocol").val() ? n("#smtp_config").show() : n("#smtp_config").hide()
        }), n("#new_departments").change(function () {
            "" != n("#new_departments").val() ? (n(".new_departments").hide(), n(".new_departments").attr("disabled", "disabled")) : (n(".new_departments").show(), n(".new_departments").removeAttr("disabled"))
        }), n("#search_type").change(function () {
            "employee" == n("#search_type").val() ? (n(".by_employee").show().attr("required", !0), n(".by_month").hide().removeAttr("required"), n(".by_period").hide().removeAttr("required"), n(".by_activities").hide().removeAttr("required")) : "month" == n("#search_type").val() ? (n(".by_employee").hide().removeAttr("required"), n(".by_month").show().attr("required", !0), n(".by_period").hide().removeAttr("required"), n(".by_activities").hide().removeAttr("required")) : "period" == n("#search_type").val() ? (n(".by_employee").hide().removeAttr("required"), n(".by_month").hide().removeAttr("required"), n(".by_period").show().attr("required", !0), n(".by_activities").hide().removeAttr("required")) : (n(".by_employee").hide().removeAttr("required"), n(".by_month").hide().removeAttr("required"), n(".by_period").hide().removeAttr("required"), n(".by_activities").hide().removeAttr("required"), n(".all_payment_history").hide())
        }), n("#goal_type_id").change(function () {
            "2" == n("#goal_type_id").val() || "4" == n("#goal_type_id").val() ? (n("#account").show(), t.getElementById("account_id").disabled = !1) : (n("#account").hide(), t.getElementById("account_id").disabled = !0)
        }), n("input.select_one").on("change", function () {
            n("input.select_one").not(this).prop("checked", !1)
        }), n(".select_box").select2({}), n(".select_2_to").select2({
            tags: !0,
            allowClear: !0,
            tokenSeparators: [",", " "]
        }), n(".select_multi").select2({
            allowClear: !0,
            placeholder: "Select Multiple",
            tokenSeparators: [",", " "]
        }), n('input[id="same_as_company"]').on("click", function () {
            this.checked && (n("input[name='billing_phone']").val(n("input[name='phone']").val()), n("input[name='billing_email']").val(n("input[name='email']").val()), n("textarea[name='billing_address']").val(n("textarea[name='address']").val()), n("input[name='billing_city']").val(n("input[name='city']").val()), n("input[name='billing_state']").val(n("input[name='state']").val()), n("input[name='billing_country']").val(n("input[name='country']").val()))
        }), n('input[id="same_as_billing"]').on("click", function () {
            this.checked && (n("input[name='shipping_phone']").val(n("input[name='billing_phone']").val()), n("input[name='shipping_email']").val(n("input[name='billing_email']").val()), n("textarea[name='shipping_address']").val(n("textarea[name='billing_address']").val()), n("input[name='shipping_city']").val(n("input[name='billing_city']").val()), n("input[name='shipping_state']").val(n("input[name='billing_state']").val()), n("input[name='shipping_country']").val(n("input[name='billing_country']").val()))
        }), n('input[id="same_time"]').on("click", function () {
            this.checked ? (n(".same_time").show(), n(".different_time").hide(), n(".different_time_input").attr("disabled", "disabled"), n(".disabled").attr("disabled", "disabled"), n(".same_time").removeAttr("disabled")) : (n(".same_time").hide(), n(".same_time").attr("disabled", "disabled"))
        }), n('input[id="different_time"]').on("click", function () {
            this.checked ? (n(".same_time").hide(), n(".different_time").show(), n(".different_time_input").removeAttr("disabled"), n(".same_time").attr("disabled", "disabled")) : (n(".same_time").hide(), n(".different_time_input").attr("disabled", "disabled"), n(".same_time").attr("disabled", "disabled"))
        }), n(".disabled").attr("disabled", "disabled"), n(".different_time_input").on("click", function () {
            var e = n(this).val();
            this.checked ? (n("#different_time_" + e).show(), n(".different_time_hours_" + e).removeAttr("disabled"), n(".different_time_hours_" + e).removeClass("disabled")) : (n("#different_time_" + e).hide(), n(".different_time_hours_" + e).attr("disabled", "disabled"))
        }), n('input[id="fixed_rate"]').on("click", function () {
            this.checked ? (n("div.fixed_price").show(), n("div.hourly_rate").hide(), n("div.hourly_rate").removeClass("hidden")) : (n("div.fixed_price").hide(), n("div.hourly_rate").show(), n("div.fixed_price").removeClass("hidden"), n("div.hourly_rate").removeClass("hidden"))
        })
    })
}(window, document, window.jQuery), function (e, t, n, i) {
    n(function () {
        n("[data-sparkline]").each(function () {
            var t = n(this), i = t.data(), a = i.values && i.values.split(",");
            i.type = i.type || "bar", i.disableHiddenCheck = !0, t.sparkline(a, i), i.resize && n(e).resize(function () {
                t.sparkline(a, i)
            })
        })
    }), n("body").on("click", "[data-act=ajax-request]", function () {
        if (1 == confirm(ldelete_confirm)) {
            var e = {}, t = n(this), i = t.attr("data-action-url"), a = t.attr("data-remove-on-success"),
                o = t.attr("data-remove-on-click"), r = t.attr("data-fade-out-on-success"),
                s = t.attr("data-fade-out-on-click"),
                l = (t.attr("data-inline-loader"), t.attr("data-reload-on-success")), d = "";
            if (t.attr("data-real-target") ? d = n(t.attr("data-real-target")) : t.attr("data-closest-target") && (d = t.closest(t.attr("data-closest-target"))), !i) return console.log("Ajax Request: Set data-action-url!"), !1;
            o && n(o).length && n(o).remove(), s && n(s).length && n(s).fadeOut(function () {
                n(this).remove()
            }), t.each(function () {
                n.each(this.attributes, function () {
                    if (this.specified && this.name.match("^data-post-")) {
                        var t = this.name.replace("data-post-", "");
                        e[t] = this.value
                    }
                })
            }), ajaxRequestXhr = n.ajax({
                url: i, data: e, cache: !1, type: "POST", success: function (e) {
                    var t = JSON.parse(e);
                    toastr[t.status](t.message), l && location.reload(), "success" == t.status && (a && n(a).length && n(a).remove(), r && n(r).length && n(r).fadeOut(function () {
                        n(this).remove()
                    }), d.length && d.html(e))
                }, statusCode: {
                    404: function () {
                        toastr.error("404: Page not found.")
                    }
                }, error: function () {
                    toastr.error("500: Internal Server Error.")
                }
            })
        }
    })
}(window, document, window.jQuery), $(function () {
    $("#parent_present").on("change", function () {
        $(".child_present").prop("checked", $(this).prop("checked"))
    }), $(".child_present").on("change", function () {
        $(".child_present").prop(!!$(".child_present:checked").length)
    }), $("#parent_absent").on("change", function () {
        $(".child_absent").prop("checked", $(this).prop("checked"))
    }), $(".child_absent").on("change", function () {
        $(".child_absent").prop(!!$(".child_absent:checked").length)
    })
}), $(document).ready(function () {
    $("#add_more_comments_attachement").on("click", function () {
        var e = $('<div class="form-group" style="margin-bottom: 0px">\n        <div class="col-sm-8">\n        <div class="fileinput fileinput-new" data-provides="fileinput">\n<span class="btn btn-default btn-file"><span class="fileinput-new" >Select file</span><span class="fileinput-exists" >Change</span><input type="file" name="comments_attachment[]" ></span> <span class="fileinput-filename"></span><a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a></div></div>\n<div class="col-sm-4">\n<strong>\n<a href="javascript:void(0);" class="c_remCF"><i class="fa fa-times"></i>&nbsp;Remove</a></strong></div>');
        $("#new_comments_attachement").append(e)
    }), $("#new_comments_attachement").on("click", ".c_remCF", function () {
        $(this).parent().parent().parent().remove()
    })
});
var doc_title = document.title;

function read_inline(e) {
    $.get(base_url + "admin/common/read_inline/" + e, function () {
        var t = $("body").find('.notification-li[data-notification-id="' + e + '"]');
        t.find(".n-link,.n-box-all").removeClass("unread"), t.find(".mark-as-read-inline").tooltip("destroy").remove()
    })
}

function mark_all_as_read() {
    $.get(base_url + "admin/common/mark_all_as_read/", function () {
        var e = $("body").find(".notification-li");
        e.find(".n-link,.n-box-all").removeClass("unread"), e.find(".mark-as-read-inline").tooltip("destroy").remove()
    })
}

function fetch_notifications(e) {
    $.get(base_url + "admin/common/get_notification", function (e) {
        var t = $("li.notifications");
        t.html(e.html);
        var n = t.find(".notifications-list").attr("data-total-unread");
        document.title = n > 0 ? "(" + n + ") " + doc_title : doc_title, setTimeout(function () {
            var n = e.notificationsIds;
            n.length > 0 && $.each(n, function (e, n) {
                var i = 'li[data-notification-id="' + n + '"]', a = t.find(i);
                $.notify("", {
                    title: new_notification,
                    body: a.find(".n-title").text(),
                    requireInteraction: !0,
                    icon: a.find(".n-image").attr("src"),
                    tag: n
                }).close(function () {
                    $.get(base_url + "admin/common/mark_desktop_notification_as_read/" + n, function () {
                        var e = t.find(".unraed-total");
                        t.find('li[data-notification-id="' + n + '"] .n-box').removeClass("unread");
                        var i = e.text();
                        i = i.trim(), (i -= 1) > 0 ? (document.title = "(" + i + ") " + doc_title, e.html(i)) : (document.title = doc_title, e.addClass("hide"))
                    })
                }).click(function (e) {
                    parent.focus(), window.focus(), setTimeout(function () {
                        t.find(i + " .n-link").addClass("desktopClick").click(), e.target.close()
                    }, 70)
                })
            })
        }, 200)
    }, "json")
}

function goBack() {
    window.history.back()
}

$(function () {
    total_unread_notifications > 0 && (document.title = "(" + total_unread_notifications + ") " + doc_title), $("body").on("click", ".notification_link", function () {
        var e = $(this).data("link");
        e.split("#")[1] || (window.location.href = e)
    }), $("body").on("click", ".notifications a.n-top, .notification_link", function (e) {
        e.preventDefault();
        var t, n = $(this);
        t = (t = n.hasClass("notification_link") ? n.data("link") : e.currentTarget.href).split("#");
        n.hasClass("desktopClick") || n.parent("li").find(".mark-as-read-inline").click(), setTimeout(function () {
            window.location.href = t
        }, 50)
    }), $(".notifications").on("show.bs.dropdown", function () {
        clearInterval(autocheck_notifications_timer_id), $("li.notifications").find(".notifications-list").attr("data-total-unread") > 0 && $.post(base_url + "admin/common/mark_as_read").done(function (e) {
            1 == (e = JSON.parse(e)).success && (document.title = doc_title, $(".icon-notifications").addClass("hide"))
        })
    }), "Notification" in window && "1" == desktop_notifications && Notification.requestPermission(), 0 != auto_check_for_new_notifications && (autocheck_notifications_timer_id = setInterval(function () {
        fetch_notifications()
    }, 1e3 * auto_check_for_new_notifications))
}), function (e) {
    e.fn.appForm = function (t) {
        var n = e.extend({}, {
            ajaxSubmit: !0, isModal: !0, dataType: "json", onModalClose: function () {
            }, onSuccess: function () {
            }, onError: function () {
                return !0
            }, onSubmit: function () {
            }, onAjaxSuccess: function () {
            }, beforeAjaxSubmit: function (e, t, n) {
            }
        }, t);

        function i(t, n) {
            e.validator.addMethod("greaterThanOrEqual", function (t, n, i) {
                var a = i;
                return !i || 0 !== i.indexOf("#") && 0 !== i.indexOf(".") || (a = e(i).val()), /Invalid|NaN/.test(new Date(t)) ? isNaN(t) && isNaN(a) || Number(t) >= Number(a) : new Date(t) >= new Date(a)
            }, "Must be greater than {0}."), e(t).validate({
                submitHandler: function (e) {
                    if (!n) return !0;
                    n(e)
                },
                highlight: function (t) {
                    e(t).closest(".form-group").addClass("has-error")
                },
                unhighlight: function (t) {
                    e(t).closest(".form-group").removeClass("has-error")
                },
                errorElement: "span",
                errorClass: "help-block",
                ignore: ":hidden:not(.validate-hidden)",
                errorPlacement: function (e, t) {
                    t.parent(".input-group").length ? e.insertAfter(t.parent()) : e.insertAfter(t)
                }
            }), e(".validate-hidden").on("click", function () {
                e(this).closest(".form-group").removeClass("has-error").find(".help-block").hide()
            })
        }

        this.each(function () {
            n.ajaxSubmit ? i(e(this), function (t) {
                n.onSubmit(), n.isModal && function (t) {
                    var n = t.height() - 80;
                    n > 0 && (n = Math.floor(n / 2));
                    t.append("<div class='modal-mask'><div class='circle-loader'></div></div>");
                    var i = t.outerHeight();
                    e(".modal-mask").css({
                        width: t.width() + 30 + "px",
                        height: i + "px",
                        "padding-top": n + "px"
                    }), t.closest(".modal-dialog").find('[type="submit"]').attr("disabled", "disabled")
                }(e("#ajaxModalContent").find(".modal-body")), e(t).ajaxSubmit({
                    dataType: n.dataType,
                    beforeSubmit: function (e, t, i) {
                        n.beforeAjaxSubmit(e, t, i)
                    },
                    success: function (t) {
                        n.onAjaxSuccess(t), "success" == t.status ? (n.onSuccess(t), n.isModal && function (t) {
                            t && (e(".modal-mask").html("<div class='circle-done'><i class='fa fa-check'></i></div>"), setTimeout(function () {
                                e(".modal-mask").find(".circle-done").addClass("ok")
                            }, 30));
                            setTimeout(function () {
                                e(".modal-mask").remove(), e("#ajaxModal").modal("toggle"), n.onModalClose()
                            }, 1e3)
                        }(!0)) : n.onError(t) && (n.isModal ? (e(".modal-body").closest(".modal-dialog").find('[type="submit"]').removeAttr("disabled"), e(".modal-mask").remove(), t.message && toastr[t.status](t.message)) : t.message && toastr[t.status](t.message))
                    }
                })
            }) : i(e(this))
        })
    }
}(jQuery), jQuery.fn.replaceClass = function (e, t) {
    return this.removeClass(e).addClass(t)
}, initScrollbar = function (e, t) {
    t || (t = {});
    var n = $.extend({}, {
        theme: "minimal-dark",
        autoExpandScrollbar: !0,
        keyboard: {enable: !0, scrollType: "stepless", scrollAmount: 40},
        mouseWheelPixels: 300,
        scrollInertia: 60,
        mouseWheel: {scrollAmount: 188, normalizeDelta: !0}
    }, t);
    $.fn.mCustomScrollbar && $(e).mCustomScrollbar(n)
}, $("#s-menu").keyup(function () {
    var e = this, t = $("ul.s-menu > li"), n = t.filter(function (t, n) {
        var i = $(n).text().toUpperCase(), a = e.value.toUpperCase();
        return ~i.indexOf(a)
    });
    t.hide(), n.show()
});