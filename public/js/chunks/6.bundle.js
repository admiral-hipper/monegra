(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{"0xK4":function(t,e,n){"use strict";n.r(e),n("TeQF"),n("x0AG"),n("QWBl"),n("yq1k"),n("E9XD"),n("JTJg"),n("FZtP");var i=n("rePB"),a=n("o0o1"),r=n.n(a),o=n("uFwe"),s=(n("ls82"),n("HaE+")),c=(n("ma9I"),n("J30X"),n("Rfxz"),n("sMBO"),n("R5XZ"),n("U8pU"));var u={inserted:function(t,e,n){if(!e.value||"function"!=typeof e.value&&"function"!=typeof e.value.callback)console.error("[click-outside:] provided expression '".concat(e.expression,"' is not a function - in component '").concat(n.context.$options.name,"'"));else{"object"===Object(c.a)(e.value)?e.args={callback:e.value.callback,delay:e.value.delay,include:e.value.include}:e.args={callback:e.value};var i=function(n){return function(t,e,n,i){if(!("isTrusted"in t&&!t.isTrusted||"pointerType"in t&&!t.pointerType)){var a=(n.args.include||function(){return[]})(e,t);Array.isArray(a)||a instanceof HTMLElement&&a.nodeType&&(a=[a]),a.push(e),!a.some((function(e){return e.contains(t.target)}))&&setTimeout((function(){(function(t){var e=window.getComputedStyle(t),n=e.display,i=e.visibility;return"none"!==n&&"hidden"!==i})(e)&&n.args.callback&&n.args.callback(t)}),n.args.delay||0)}}(n,t,e)};document.body.addEventListener("click",i,!0),t._clickOutside=i}},unbind:function(t){if(t._clickOutside){var e=document.body;e&&e.removeEventListener("click",t._clickOutside,!0),delete t._clickOutside}}},l=n("PdH4"),d=n.n(l),f=(n("QVta"),{name:"Notifications",directives:{ClickOutside:u},data:function(){return{loading:!1,notifications:[],idsOfReadNotifications:[],countOfUnread:0,currentPage:0,hasMore:!1,showPanel:!1}},computed:{idsOfNotificationsToRead:function(){return this.notifications.reduce((function(t,e){return e.read_at||t.push(e.id),t}),[])}},methods:{getNotifications:function(){var t=this;return Object(s.a)(r.a.mark((function e(){var n,i,a,s,c,u,l,d;return r.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(!t.loading){e.next=2;break}return e.abrupt("return");case 2:return t.loading=!0,i={page:t.currentPage+1},e.next=6,axios.get("/user/get-notifications",{params:i});case 6:a=e.sent,s=a.data,c=[],u=Object(o.a)(s.notifications),e.prev=10,d=function(){var e=l.value;if(-1!==t.notifications.findIndex((function(t){return t.id===e.id})))return"continue";e.timestamp=moment(e.created_at).calendar(),c.push(e)},u.s();case 13:if((l=u.n()).done){e.next=19;break}if("continue"!==d()){e.next=17;break}return e.abrupt("continue",17);case 17:e.next=13;break;case 19:e.next=24;break;case 21:e.prev=21,e.t0=e.catch(10),u.e(e.t0);case 24:return e.prev=24,u.f(),e.finish(24);case 27:return(n=t.notifications).push.apply(n,c),t.currentPage=s.current_page,t.countOfUnread=s.count_of_unread,t.hasMore=s.has_more,e.next=33,t.$nextTick();case 33:t.loading=!1;case 34:case"end":return e.stop()}}),e,null,[[10,21,24,27]])})))()},readNotifications:function(){var t=arguments,e=this;return Object(s.a)(r.a.mark((function n(){var a,o,s;return r.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:if(a=t.length>0&&void 0!==t[0]?t[0]:[],!e.loading&&(a.length||e.idsOfNotificationsToRead.length)){n.next=3;break}return n.abrupt("return");case 3:if((a=a?a.filter((function(t){return e.idsOfNotificationsToRead.includes(t)})):e.idsOfNotificationsToRead).length){n.next=6;break}return n.abrupt("return");case 6:return e.loading=!0,n.next=9,axios.post("/user/bulk-read-notifications",Object(i.a)({},"notification_ids",a));case 9:return o=n.sent,s=o.data,e.countOfUnread=s.count_of_unread,e.currentPage=0,e.notifications.forEach((function(t){!t.read_at&&a.includes(t.id)&&(t.read_at="now")})),n.next=16,e.$nextTick();case 16:e.loading=!1;case 17:case"end":return n.stop()}}),n)})))()},closeNotificationsPanel:function(t){var e=t.target;!this.showPanel||document.querySelector(".swal2-shown")&&document.querySelector(".swal2-shown").contains(e)||(this.showPanel=!1)},openNotification:function(t){var e=t.id,n=t.data;d.a.fire({title:this.$t("notification"),html:n.message,timer:0,confirmButtonText:this.$t("close")}),this.readNotifications([e])}},created:function(){var t=this;return Object(s.a)(r.a.mark((function e(){return r.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.getNotifications();case 2:case"end":return e.stop()}}),e)})))()}}),p=(n("tMQ5"),n("KHd+")),v=Object(p.a)(f,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{directives:[{name:"click-outside",rawName:"v-click-outside",value:t.closeNotificationsPanel,expression:"closeNotificationsPanel"}],staticStyle:{display:"inline-flex","margin-right":"4px"},on:{focusin:function(e){t.showPanel=!0}}},[n("a",{staticClass:"nav-link dropdown-toggle pl-md-3 position-relative",attrs:{href:"javascript:void(0)",role:"button","aria-haspopup":"true","aria-expanded":"false"}},[t._m(0),t._v(" "),t.countOfUnread?n("span",{staticClass:"badge badge-primary notify-no rounded-circle",staticStyle:{position:"absolute",top:"0",right:"-5px",padding:"4px 7px"},domProps:{textContent:t._s(t.countOfUnread)}}):t._e()]),t._v(" "),n("div",{class:["dropdown-menu dropdown-menu-left mailbox animated bounceInDown",{show:t.showPanel}],staticStyle:{padding:"0"}},[n("ul",{staticClass:"list-style-none",staticStyle:{overflow:"auto","max-height":"65vh"}},[n("li",[n("div",{staticClass:"message-center notifications position-relative ps-container ps-theme-default",staticStyle:{width:"300px"}},[t._l(t.notifications,(function(e){return n("a",{key:e.id,staticClass:"message-item d-flex align-items-center border-bottom px-3 py-2",style:{opacity:e.read_at?.6:1},attrs:{href:"javascript:void(0)"},on:{click:function(n){return t.openNotification(e)}}},[n("div",{staticClass:"w-100 d-inline-block v-middle pl-2"},[n("h6",{directives:[{name:"t",rawName:"v-t",value:"notification",expression:"'notification'"}],staticClass:"message-title mb-0 mt-1"}),t._v(" "),n("i",{staticClass:"font-12 d-block text-muted notification-message",domProps:{innerHTML:t._s(e.data.message)}}),t._v(" "),n("span",{staticClass:"font-12 text-nowrap d-block text-muted text-left",domProps:{textContent:t._s(e.timestamp)}})])])})),t._v(" "),t.notifications.length?t._e():n("a",{key:"empty-notifications",staticClass:"message-item d-flex align-items-center border-bottom px-3 py-2",staticStyle:{"pointer-events":"none",padding:"12px 0!important","text-align":"center"},attrs:{href:"javascript:void(0)"}},[n("div",{staticClass:"w-100 d-inline-block v-middle pl-2"},[n("span",{directives:[{name:"t",rawName:"v-t",value:"no-notifications",expression:"'no-notifications'"}],staticClass:"font-12 d-block text-muted"})])])],2)])]),t._v(" "),t.hasMore?n("span",{staticClass:"nav-link pt-3 text-center text-dark",staticStyle:{cursor:"pointer","padding-bottom":"1rem","user-select":"none"},on:{click:function(e){return t.getNotifications()}}},[n("strong",{directives:[{name:"t",rawName:"v-t",value:"more",expression:"'more'"}]}),t._v(" "),n("i",{staticClass:"fa fa-angle-down"})]):t._e(),t._v(" "),t.idsOfNotificationsToRead.length?n("span",{staticClass:"nav-link pt-3 text-center text-dark",staticStyle:{cursor:"pointer","padding-bottom":"1rem","user-select":"none"},on:{click:function(e){return t.readNotifications(t.idsOfNotificationsToRead)}}},[n("strong",{directives:[{name:"t",rawName:"v-t",value:"read-all",expression:"'read-all'"}]})]):t._e()])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("span",[e("i",{staticClass:"far fa-bell",staticStyle:{"font-size":"17px"}})])}],!1,null,null,null);e.default=v.exports},"1Y/n":function(t,e,n){var i=n("HAuM"),a=n("ewvW"),r=n("RK3t"),o=n("UMSQ"),s=function(t){return function(e,n,s,c){i(n);var u=a(e),l=r(u),d=o(u.length),f=t?d-1:0,p=t?-1:1;if(s<2)for(;;){if(f in l){c=l[f],f+=p;break}if(f+=p,t?f<0:d<=f)throw TypeError("Reduce of empty array with no initial value")}for(;t?f>=0:d>f;f+=p)f in l&&(c=n(c,l[f],f,u));return c}};t.exports={left:s(!1),right:s(!0)}},BsWD:function(t,e,n){"use strict";n.d(e,"a",(function(){return a}));var i=n("a3WO");function a(t,e){if(t){if("string"==typeof t)return Object(i.a)(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?Object(i.a)(t,e):void 0}}},E9XD:function(t,e,n){"use strict";var i=n("I+eb"),a=n("1Y/n").left,r=n("pkCn"),o=n("rkAj"),s=r("reduce"),c=o("reduce",{1:0});i({target:"Array",proto:!0,forced:!s||!c},{reduce:function(t){return a(this,t,arguments.length,arguments.length>1?arguments[1]:void 0)}})},R5XZ:function(t,e,n){var i=n("I+eb"),a=n("2oRo"),r=n("NC/Y"),o=[].slice,s=function(t){return function(e,n){var i=arguments.length>2,a=i?o.call(arguments,2):void 0;return t(i?function(){("function"==typeof e?e:Function(e)).apply(this,a)}:e,n)}};i({global:!0,bind:!0,forced:/MSIE .\./.test(r)},{setTimeout:s(a.setTimeout),setInterval:s(a.setInterval)})},Rfxz:function(t,e,n){"use strict";var i=n("I+eb"),a=n("tycR").some,r=n("pkCn"),o=n("rkAj"),s=r("some"),c=o("some");i({target:"Array",proto:!0,forced:!s||!c},{some:function(t){return a(this,t,arguments.length>1?arguments[1]:void 0)}})},TeQF:function(t,e,n){"use strict";var i=n("I+eb"),a=n("tycR").filter,r=n("Hd5f"),o=n("rkAj"),s=r("filter"),c=o("filter");i({target:"Array",proto:!0,forced:!s||!c},{filter:function(t){return a(this,t,arguments.length>1?arguments[1]:void 0)}})},a3WO:function(t,e,n){"use strict";function i(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,i=new Array(e);n<e;n++)i[n]=t[n];return i}n.d(e,"a",(function(){return i}))},dXYb:function(t,e,n){(t.exports=n("I1BE")(!1)).push([t.i,".list-style-none::-webkit-scrollbar{width:8px}.list-style-none::-webkit-scrollbar-track{box-shadow:inset 0 0 2px rgba(0,0,0,.2)}.list-style-none::-webkit-scrollbar-thumb{background-color:#7274e9}.notification-message{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;height:16px}",""])},tMQ5:function(t,e,n){"use strict";var i=n("zNr1");n.n(i).a},uFwe:function(t,e,n){"use strict";n.d(e,"a",(function(){return a}));var i=n("BsWD");function a(t,e){var n;if("undefined"==typeof Symbol||null==t[Symbol.iterator]){if(Array.isArray(t)||(n=Object(i.a)(t))||e&&t&&"number"==typeof t.length){n&&(t=n);var a=0,r=function(){};return{s:r,n:function(){return a>=t.length?{done:!0}:{done:!1,value:t[a++]}},e:function(t){throw t},f:r}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var o,s=!0,c=!1;return{s:function(){n=t[Symbol.iterator]()},n:function(){var t=n.next();return s=t.done,t},e:function(t){c=!0,o=t},f:function(){try{s||null==n.return||n.return()}finally{if(c)throw o}}}}},x0AG:function(t,e,n){"use strict";var i=n("I+eb"),a=n("tycR").findIndex,r=n("RNIs"),o=n("rkAj"),s=!0,c=o("findIndex");"findIndex"in[]&&Array(1).findIndex((function(){s=!1})),i({target:"Array",proto:!0,forced:s||!c},{findIndex:function(t){return a(this,t,arguments.length>1?arguments[1]:void 0)}}),r("findIndex")},zNr1:function(t,e,n){var i=n("dXYb");"string"==typeof i&&(i=[[t.i,i,""]]);n("aET+")(i,{hmr:!0,transform:void 0,insertInto:void 0}),i.locals&&(t.exports=i.locals)}}]);