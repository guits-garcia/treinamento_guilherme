/*
 * Copyright (C) 2009, Nokia gate5 GmbH Berlin
 *
 * These coded instructions, statements, and computer programs contain
 * unpublished proprietary information of Nokia gate5 GmbH, and are
 * copy protected by law. They may not be disclosed to third parties
 * or copied or duplicated in any form, in whole or in part, without
 * the specific, prior written permission of Nokia gate5 GmbH.
 */

this.nokia = this.nokia || {};
nokia.places = nokia.places || {
    comm: {},
    data: {},
    utils: {},
    search: {},
    widgets: {},
    ui: {
        modules: {},
        templates: {
            blue: {},
            general: {},
            mobileHTML5: {},
            wordpress: {},
            st: {}
        }
    }
};
nokia.places.utils.enums = {
    CssUrlModes: {
        NONE: "none",
        AGGREGATED: "aggregated",
        NON_AGGREGATED: "nonAggregated"
    }
};
nokia.places.utils.util = function() {
    function g(a, d) {
        var e = a, c;
        for (c in d)
            d.hasOwnProperty(c) && (e = e.replace("{" + c + "}", d[c]));
        return e
    }
    function k(a, d) {
        return function() {
            return a.apply(d, arguments)
        }
    }
    function h(a, d, e) {
        var c = new Date;
        e && c.setDate(c.getDate() + e);
        document.cookie = g("{NAME}={VALUE}{EXPIRES}", {
            NAME: a,
            VALUE: encodeURI(d),
            EXPIRES: e ? "" : "; expires=" + c.toUTCString()
        })
    }
    function i(a) {
        if (document.cookie.length) {
            var d = document.cookie.indexOf(a + "=");
            if (-1 !== d)
                return d = d + a.length + 1,
                a = document.cookie.indexOf(";", d),
                -1 === a && (a = document.cookie.length),
                decodeURI(document.cookie.substring(d, a))
        }
        return ""
    }
    var f = {
        en: "gb",
        da: "dk",
        cs: "cz",
        el: "gr",
        hi: "in",
        ko: "kr",
        sv: "se",
        zh: "cn"
    };
    return {
        mixin: function(a, d) {
            for (var e = Array.prototype.slice.call(arguments, 1), c = e.shift(); c; ) {
                for (var b in c)
                    c.hasOwnProperty(b) && (a[b] = c[b]);
                c = e.shift()
            }
            return a
        },
        replace: g,
        inherit: function(a, d, e) {
            var c = function() {};
            c.prototype = a.prototype;
            d.prototype = new c;
            for (var b in e)
                e.hasOwnProperty(b) && (d.prototype[b] = e[b])
        },
        trim: function(a) {
            return a.replace(/(^\s+)|(\s+$)/g, "")
        },
        setCookie: h,
        getCookie: i,
        clearCookie: function(a) {
            h(a, "", -1)
        },
        createTempUserId: function() {
            var a = i("ppTmpUser");
            a || (a = Math.floor(1E8 * Math.random()) + "" + (new Date).getTime(),
            h("ppTmpUser", a, 360));
            return a
        },
        addProtocolToUrl: function(a) {
            0 !== a.indexOf("http://") && 0 !== a.indexOf("https://") && (a = "http://" + a);
            return a
        },
        ensureReplaced: function(a, d) {
            return 0 === a.indexOf("$") ? d : a
        },
        removeTags: function(a) {
            return "string" === typeof a ? a.replace(/<([a-zA-Z0-9]*|\n)+>/g, "").replace(/<\/([a-zA-Z0-9]*|\n)+>/g, "") : a
        },
        escapeTags: function(a) {
            return "string" === typeof a ? a.replace(/</g, "&lt;").replace(/>/g, "&gt;") : a
        },
        extendWith: function(a, d) {
            for (var e in d)
                d.hasOwnProperty(e) && typeof ("function" === d[e]) && (a[e] = k(d[e], a))
        },
        getBrowserLanguage: function() {
            var a = "undefined" === typeof window ? "en" : window.navigator.userLanguage || window.navigator.language || "en";
            if (2 === a.length) {
                var d = f[a];
                return d ? [a, d].join("-") : [a, a].join("-")
            }
            return a
        },
        getDefaultDialect: function(a) {
            return f[a] ? f[a] : a
        },
        toArray: function(a) {
            return a instanceof Array ? a : [a]
        }
    }
}();
nokia.places.settings = function() {
    function g() {
        var a = this.jslocation || nokia.maps;
        if (a && a.util && a.util.services)
            return a.util.services
    }
    function k(a) {
        a = a.replace(r, o ? "." + o : "");
        return a = a.replace(m, j ? "https" : "http")
    }
    function h(d) {
        var f = g()
          , d = a(d, {
            S_URL: k(e),
            APPID: c,
            TOKEN: b,
            LANG: p
        });
        return f ? f.addNlpParams(d) : d
    }
    var i = nokia.places.utils.util
      , f = nokia.Settings
      , a = i.replace
      , d = i.ensureReplaced
      , e = "{protocol}://places{serviceMode}.api.here.com/places/v1"
      , c = ""
      , b = ""
      , r = "{serviceMode}"
      , m = "{protocol}"
      , o = ""
      , j = !1
      , q = d("${cnContext}", !1)
      , n = "&app_id={APPID}&app_code={TOKEN}"
      , l = [];
    l.push("callback=nokia.places.comm.data.clb['{CALLBACK_ID}']");
    g() ? n = "" : l.push(n);
    l.push("Accept-Language={LANG}");
    var l = l.join("&")
      , s = "{S_URL}/discover/search/?" + l + "&"
      , t = "{S_URL}/suggest/?" + l + "&"
      , u = "{S_URL}/discover/explore/places?" + l + "&"
      , q = q ? "" : "&int=true"
      , v = "{S_URL}/places/{PLACE_ID}?" + l
      , w = "{S_URL}/places/{PLACE_ID}/media/images?offset={START}&size={LIMIT}&" + l
      , x = "{S_URL}/places/{PLACE_ID}/media/reviews?offset={START}&size={LIMIT}&" + l
      , y = "{S_URL}/places/{PLACE_ID}/related/recommended?size={LIMIT}&" + l
      , z = "{S_URL}/reversegeocode.json?prox={LAT},{LONG},1000&gen=1&mode=retrieveAddresses&jsoncallback=nokia.places.comm.data.clb['{CALLBACK_ID}']" + n + "&language={LANG}" + q
      , A = "{S_URL}/geocode.json?gen=1&searchtext={LOC}&jsoncallback=nokia.places.comm.data.clb['{CALLBACK_ID}']" + n + "&language={LANG}" + q
      , p = i.getBrowserLanguage();
    f && (c = f.app_id,
    b = f.app_code,
    p = f.defaultLanguage,
    o = f.serviceMode,
    j = "force" === f.secureConnection || "prefer" === f.secureConnection,
    f.addObserver("app_id", function(a) {
        c = a || c
    }),
    f.addObserver("appId", function(a) {
        c = a || c
    }),
    f.addObserver("app_code", function(a) {
        b = a || b
    }),
    f.addObserver("authenticationToken", function(a) {
        b = a || b
    }),
    f.addObserver("defaultLanguage", function(a) {
        p = a || p
    }),
    f.addObserver("serviceMode", function(a) {
        o = a
    }),
    f.addObserver("secureConnection", function(a) {
        j = "force" === a || "prefer" === a
    }));
    i = function() {}
    ;
    i.prototype = {
        getPlaceUrl: function(b) {
            var c = h(v);
            return a(c, {
                PLACE_ID: b
            })
        },
        getPlaceImagesUrl: function(b, c, e) {
            var d = h(w);
            return a(d, {
                PLACE_ID: b,
                START: c || 0,
                LIMIT: e || 5
            })
        },
        getReviewsUrl: function(b, c) {
            var e = h(x);
            return a(e, {
                PLACE_ID: b,
                LIMIT: c.limit || "5",
                START: c.start || "0"
            })
        },
        getRecommendationsUrl: function(b, c) {
            var e = h(y);
            return a(e, {
                PLACE_ID: b,
                LIMIT: c || 5
            })
        },
        getSearchUrl: function() {
            return h(s) + "&"
        },
        getCategorySearchUrl: function() {
            return h(u) + "&"
        },
        getSuggestUrl: function() {
            return h(t) + "&"
        },
        getLocale: function() {
            return p
        },
        getClbTemplate: function() {
            return "callback=nokia.places.comm.data.clb['{CALLBACK_ID}']"
        },
        getReverseGeoUrl: function(e, d) {
            var f = a(z, {
                LAT: e,
                LONG: d,
                S_URL: k("{protocol}://{service}{serviceMode}.api.here.com/6.2").replace("{service}", "reverse.geocoder"),
                APPID: c,
                TOKEN: b,
                LANG: p
            })
              , r = g();
            return r ? r.addNlpParams(f) : f
        },
        getGeoCodeUrl: function(e) {
            var e = a(A, {
                LOC: e,
                S_URL: k("{protocol}://{service}{serviceMode}.api.here.com/6.2").replace("{service}", "geocoder"),
                APPID: c,
                TOKEN: b,
                LANG: p
            })
              , d = g();
            return d ? d.addNlpParams(e) : e
        },
        setPlacesServerUrl: function(a) {
            e = a
        },
        getPlacesServerUrl: function() {
            return e
        },
        getServices: g,
        setLocale: function(a) {
            p = a
        },
        setAppContext: function(a) {
            a = a || {};
            c = a.appId || a.app_id;
            b = a.authenticationToken || a.app_code;
            if (f) {
                f.set("app_id", c);
                f.set("app_code", b)
            }
        },
        setServiceMode: function(a) {
            o = a;
            f && f.set("serviceMode", a)
        },
        setSecureConnection: function(a) {
            (j = a) && f && f.set("secureConnection", "force")
        },
        isSecure: function() {
            return j
        },
        getServiceMode: function() {
            return o
        },
        getAppContext: function() {
            return {
                app_id: c,
                app_code: b
            }
        },
        commTimeout: 1E4,
        revision: d("-1", "0"),
        version: d("beta5-SNAPSHOT", "0")
    };
    i.prototype.constructor = i;
    return new i
}();
nokia.places.comm.core = function() {
    function g(h) {
        h && h.parentNode && h.parentNode.removeChild(h)
    }
    var k = document;
    return {
        get: function(h, i) {
            var f = k.getElementsByTagName("head")[0]
              , a = k.createElement("script");
            a.setAttribute("src", h);
            a.setAttribute("type", "text/javascript");
            "Microsoft Internet Explorer" === navigator.appName ? a.onreadystatechange = function() {
                if ("loaded" === this.readyState || "complete" === this.readyState)
                    g(this),
                    "function" === typeof i && i()
            }
            : a.onload = function() {
                g(this);
                "function" === typeof i && i()
            }
            ;
            f.appendChild(a);
            return a
        },
        post: function(h, i, f, a) {
            var d = k.getElementsByTagName("head")[0]
              , e = k.createElement("iframe");
            e.style.display = "none";
            d.appendChild(e);
            setTimeout(function() {
                var c = e.contentWindow || e.contentDocument;
                e.doc = c.document ? c.document : c;
                c = e.doc.createElement("form");
                c.method = "post";
                c.action = h;
                c.setAttribute("accept-charset", "utf-8");
                c.setAttribute("enctype", "multipart/form-data");
                c.setAttribute("encoding", "multipart/form-data");
                var b = e.doc.createElement("input");
                b.type = "text";
                b.name = "user-id";
                b.value = a || "";
                c.appendChild(b);
                b = e.doc.createElement("input");
                b.type = "text";
                b.name = "entity";
                b.value = i;
                c.appendChild(b);
                e.doc.body.appendChild(c);
                var d = function() {
                    setTimeout(function() {
                        g(e)
                    }, 1);
                    "function" === typeof f && f()
                };
                e.onload = function() {
                    d()
                }
                ;
                e.onreadystatechange = function() {
                    "complete" === this.readyState && d()
                }
                ;
                c.submit()
            }, 1)
        }
    }
}();
nokia.places.comm.data = function() {
    function g() {
        return "" + ++d
    }
    function k(e, c) {
        var b = function(d, f) {
            d && 400 <= d.status && (d = {
                responseStatus: d.status,
                message: d.error_description || d.message
            },
            f = "ERROR",
            window.console && "function" === typeof window.console.error && window.console.error("Error " + d.responseStatus + " - " + d.message));
            "function" === typeof c && c(d, f || "OK");
            clearTimeout(b.timeout);
            delete a[e]
        };
        b.timeout = setTimeout(function() {
            window.console && "function" === typeof window.console.error && window.console.error("Timeout - cannot connect to the server");
            b(null, "ERROR")
        }, f.commTimeout);
        return b
    }
    var h = nokia.places
      , i = h.comm.core
      , f = h.settings
      , a = {}
      , d = 100;
    return {
        performRequest: function(e, c, b) {
            b = b || g();
            e = e.replace("{CALLBACK_ID}", b);
            a[b] = k(b, c);
            i.get(e, null, b);
            return b
        },
        performNoCbRequest: function(a) {
            i.get(a)
        },
        performPostRequest: function(a, c, b, d) {
            i.post(a, c, b, d)
        },
        abortRequest: function(e) {
            if ("undefinded" === typeof e || !a[e])
                return !1;
            a[e].timeout && clearTimeout(a[e].timeout);
            a[e] = function() {
                delete a[e]
            }
        },
        getCallBackId: g,
        getSeed: function() {
            return d
        },
        clb: a
    }
}();
(function(g) {
    g.ovi = this.ovi || {};
    g.ovi.player = {};
    g.ovi.player.places = {};
    g.ovi.player.places.Com = {};
    g.ovi.player.places.Com.data = function(g, h) {
        nokia.places.comm.data.clb["" + g.callback](h)
    }
}
)(this);
nokia.places.data.dataTransformer = function() {
    function g(a) {
        return {
            latitude: a[0],
            longitude: a[1]
        }
    }
    function k(a) {
        if (a instanceof Array)
            return {
                topLeft: {
                    latitude: a[3],
                    longitude: a[0]
                },
                bottomRight: {
                    latitude: a[1],
                    longitude: a[2]
                }
            }
    }
    function h(a) {
        if (a)
            return {
                name: a.title,
                categoryId: a.id,
                icon: a.icon
            }
    }
    function i(c) {
        var b;
        if (!c)
            return !1;
        if ((b = c.results) && b.next) {
            var f = c.results.next;
            c.results.getNext = function(b) {
                if (b && b.onComplete) {
                    var c = b.onComplete;
                    f += "&" + d.getClbTemplate();
                    return a(f, function(a, b) {
                        "function" === typeof c && (b === e && (a = i(a)),
                        c(a, b))
                    })
                }
            }
        }
        delete c.next;
        b = c.items || c.results.items;
        if (c.search) {
            c.search.context && (c.search.location = c.search.context.location,
            delete c.search.context);
            var m = c.search.location;
            m.position && (m.position = g(m.position));
            m.bbox && (m.boundingBox = k(m.bbox),
            delete m.bbox)
        }
        if (b)
            for (var m = 0, o = b.length; m < o; m++) {
                var j = b[m]
                  , q = j.href.match(/([\w\d]{8}-[\w\d]{32})/)
                  , n = j.category;
                n.icon = j.icon.replace(/(_\d{2})?\.icon/, ".icon");
                j.id ? (j.placeId = j.id,
                delete j.id) : q && q[1] && (j.placeId = q[1]);
                j.position = g(j.position);
                j.bbox && (j.boundingBox = k(j.bbox),
                delete j.bbox);
                j.category = h(n);
                delete j.refId;
                delete j.type
            }
        return c
    }
    function f(c) {
        if (!c)
            return !1;
        if (c.next) {
            var b = c.next;
            c.getNext = function(c) {
                if (c && c.onComplete) {
                    var j = c.onComplete;
                    b += "&" + d.getClbTemplate();
                    return a(b, function(a, b) {
                        "function" === typeof j && (b === e && (a = f(a)),
                        j(a, b))
                    })
                }
            }
        }
        delete c.next;
        delete c.create;
        if (c.items)
            for (var g = 0, m = c.items.length; g < m; g++) {
                var h = c.items[g];
                if (h) {
                    var j = h.supplier;
                    h.supplier = {
                        name: j.title,
                        supplierId: j.id,
                        icon: j.icon
                    };
                    delete h.id
                }
            }
        return c
    }
    var a = nokia.places.comm.data.performRequest
      , d = nokia.places.settings
      , e = "OK";
    return {
        transformPlace: function(a) {
            if (!a)
                return !1;
            a.location.position = g(a.location.position);
            a.location.bbox && (a.location.bbox = k(a.location.bbox));
            if (a.media) {
                var b = a.media;
                b.reviews && (b.reviews.available ? b.reviews = f(b.reviews) : delete b.reviews);
                b.editorials && (b.editorials = f(b.editorials));
                b.images && (b.images.available ? b.images = f(b.images) : delete b.images);
                b.links && (b.links = f(b.links));
                b.images || b.editorials || b.reviews || b.links ? a.media = b : delete a.media
            }
            if (b = a.supplier)
                a.supplier = {
                    name: b.title,
                    supplierId: b.id
                };
            for (var b = 0, e = a.categories.length; b < e; b++)
                a.categories[b] = h(a.categories[b]);
            delete a.refId;
            return a
        },
        transformSearchResults: i,
        transformReverseGeo: function(a) {
            if (a) {
                var b = {
                    location: {}
                };
                b.location.position = {
                    latitude: parseFloat(a.Location.DisplayPosition.Latitude),
                    longitude: parseFloat(a.Location.DisplayPosition.Longitude)
                };
                var e = b.location, a = a.Location.Address, d = {}, f, j, g;
                for (g in a)
                    if (a.hasOwnProperty(g))
                        if (j = a[g],
                        "AdditionalData" !== g)
                            f = "Label" === g ? "text" : "Country" === g ? "countryCode" : g.charAt(0).toLowerCase() + g.substr(1),
                            d[f] = j;
                        else {
                            f = 0;
                            for (var h = j.length; f < h; f++) {
                                var i = j[f];
                                "CountryName" === i.key ? d.country = i.value : "StateName" === i.key && (d.state = i.value)
                            }
                        }
                e.address = d;
                b.name = b.location.address.text;
                return b
            }
        },
        transformMediaObject: f
    }
}();
nokia.places.manager = function() {
    var g = nokia.places
      , k = this.console || {}
      , h = g.settings
      , i = g.comm.data.performRequest
      , f = g.data.dataTransformer;
    return {
        getPlaceData: function(a) {
            if (a) {
                var d = a.onComplete;
                if ((a.placeId || a.href) && "function" === typeof d)
                    return a = a.href ? a.href + "&" + h.getClbTemplate() : h.getPlaceUrl(a.placeId),
                    i(a, function(a, c) {
                        "OK" === c && (a = f.transformPlace(a));
                        "function" === typeof d && d(a, c)
                    })
            }
        },
        getRating: function(a) {
            k.warn && k.warn("nokia.places.manager.getRating is deprecated use getPlaceData to read rating");
            if (a.onComplete)
                a.onComplete({
                    average: 0,
                    count: 0
                }, "ERROR")
        },
        getReviews: function(a) {
            if (a) {
                var d = a.placeId
                  , e = a.onComplete;
                if (d && "function" === typeof e)
                    return a = h.getReviewsUrl(d, a),
                    i(a, function(a, b) {
                        "function" === typeof e && ("OK" === b && (a = f.transformMediaObject(a)),
                        e(a, b))
                    })
            }
        },
        getImages: function(a) {
            if (a) {
                var d = a.placeId
                  , e = a.onComplete;
                if (d && "function" === typeof e)
                    return a = h.getPlaceImagesUrl(d, a.start, a.limit),
                    i(a, function(a, b) {
                        "OK" === b && (a = f.transformMediaObject(a));
                        e(a, b)
                    })
            }
        }
    }
}();
nokia.places.search.nsp = function() {
    function g(a) {
        var c = []
          , d = a.searchCenter;
        a.limit && c.push("size=" + encodeURIComponent(a.limit));
        a.searchTerm && c.push("q=" + encodeURIComponent(a.searchTerm));
        a.category && c.push("cat=" + encodeURIComponent(a.category));
        "object" === typeof a.boundingBox && "object" === typeof a.boundingBox.topLeft && "object" === typeof a.boundingBox.bottomRight ? c.push("X-Map-Viewport=" + a.boundingBox.topLeft.longitude + "," + a.boundingBox.bottomRight.latitude + "," + a.boundingBox.bottomRight.longitude + "," + a.boundingBox.topLeft.latitude) : d && ("number" === typeof d.longitude && "number" === typeof d.latitude) && c.push("at=" + d.latitude + "," + d.longitude);
        return c.join("&")
    }
    function k(b, f) {
        var h = e.getSearchUrl() + g(b);
        return a.performRequest(h, function(a, e) {
            e === c && (a = d.transformSearchResults(a),
            b.onComplete(a, e))
        }, f)
    }
    function h(b, f) {
        var h = e.getCategorySearchUrl() + g(b);
        return a.performRequest(h, function(a, e) {
            e === c && (a = d.transformSearchResults(a),
            b.onComplete(a, e))
        }, f)
    }
    function i(b, d) {
        var f = e.getSuggestUrl() + g(b);
        return a.performRequest(f, function(a, d) {
            if (d === c)
                b.onComplete(a, d)
        }, d)
    }
    var f = nokia.places
      , a = f.comm.data
      , d = f.data.dataTransformer
      , e = f.settings
      , c = "OK";
    return {
        search: function(b, c) {
            var d = b.useGeoLocation, e, f, g = {
                latitude: 0,
                longitude: 0
            }, n = a.getCallBackId(), l = !0 === c ? i : b.category ? h : k;
            try {
                e = navigator ? navigator.geolocation : null
            } catch (s) {}
            !f && d && e ? (e.getCurrentPosition(function(a) {
                f = {
                    latitude: a.coords.latitude,
                    longitude: a.coords.longitude
                };
                b.searchCenter = f;
                l(b, n)
            }, function() {
                b.searchCenter = g;
                l(b, n)
            }, {
                timeout: 6E3
            }),
            f = g) : (b.searchCenter = f || b.searchCenter || g,
            l(b, n));
            return n
        }
    }
}();
nokia.places.search.manager = function() {
    var g = nokia.places
      , k = g.settings
      , h = g.search.nsp
      , i = g.comm.data.performRequest
      , f = g.data.dataTransformer;
    return {
        findPlaces: function(a) {
            if (a && a.searchTerm && a.onComplete)
                return h.search(a)
        },
        findPlacesByCategory: function(a) {
            if (a && a.category && a.onComplete)
                return h.search(a)
        },
        suggestPlaces: function(a) {
            if (a && a.searchTerm && a.onComplete)
                return h.search(a, !0)
        },
        findRecommendations: function(a) {
            if (a) {
                var d = a.placeId
                  , e = a.onComplete;
                if (d && "function" === typeof e)
                    return a = k.getRecommendationsUrl(d, a.limit),
                    i(a, function(a, b) {
                        "OK" === b ? e(f.transformSearchResults(a), b) : e({}, b)
                    })
            }
        },
        reverseGeoCode: function(a) {
            var a = a || {}
              , d = a.latitude
              , e = a.longitude
              , c = a.onComplete
              , a = k.getReverseGeoUrl(a.latitude, a.longitude);
            if (d && e && "function" === typeof c)
                return i(a, function(a) {
                    a && a.Response && a.Response.View ? a.Response.View.length ? c(f.transformReverseGeo(a.Response.View[0].Result[0]), "OK") : c("", "OK") : c(a ? a.Details : "", "ERROR")
                })
        },
        geoCode: function(a) {
            var a = a || {}, d = a.address, e = a.searchTerm, c = a.onComplete, b, g = [];
            if (a.onComplete && (e || d)) {
                if (d)
                    for (b in d)
                        d.hasOwnProperty(b) && g.push(d[b]);
                else
                    g.push(e);
                e = encodeURIComponent(g.join(","));
                a = k.getGeoCodeUrl(e);
                return i(a, function(a) {
                    a && a.Response ? a.Response.View && a.Response.View[0] && a.Response.View[0].Result ? c(f.transformReverseGeo(a.Response.View[0].Result[0]), "OK") : c(null, "OK") : c(a, "ERROR")
                })
            }
        }
    }
}();
