(window.webpackJsonp=window.webpackJsonp||[]).push([[16],{"/zUp":function(t,e,a){"use strict";a.r(e);var n=a("o0o1"),l=a.n(n),r=(a("ls82"),a("HaE+")),o=a("KUXq"),s={name:"WalletsPanelCreateForm",props:{typesForWalletAdding:{type:Array,required:!0},loading:{type:Boolean,required:!0}},data:function(){return{wallet:{typeId:"",number:null}}},methods:{create:function(){var t=this;return Object(r.a)(l.a.mark((function e(){var a;return l.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(!t.loading&&t.wallet.typeId&&t.wallet.number){e.next=2;break}return e.abrupt("return");case 2:a=Object(o.a)(t.wallet),t.$emit("create",a,t.clear);case 4:case"end":return e.stop()}}),e)})))()},clear:function(){this.wallet={typeId:"",number:null}}}},i=a("KHd+"),c=Object(i.a)(s,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"card"},[a("div",{staticClass:"card-body"},[a("h4",{directives:[{name:"t",rawName:"v-t",value:"create-wallet",expression:"'create-wallet'"}],staticClass:"card-title"}),t._v(" "),a("form",{staticClass:"mt-4"},[a("div",{staticClass:"input-group"},[a("select",{directives:[{name:"model",rawName:"v-model",value:t.wallet.typeId,expression:"wallet.typeId"}],staticClass:"custom-select",on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.wallet,"typeId",e.target.multiple?a:a[0])}}},[a("option",{directives:[{name:"t",rawName:"v-t",value:"select-wallet-type",expression:"'select-wallet-type'"}],key:"empty",attrs:{selected:"",value:""}}),t._v(" "),t._l(t.typesForWalletAdding,(function(e){return a("option",{key:e.id+"-type",domProps:{value:e.id,textContent:t._s(e.name)}})}))],2)]),t._v(" "),a("div",{staticClass:"input-group"},[a("app-transition",{attrs:{name:"collapse"}},[t.wallet.typeId?a("div",{staticClass:"mt-4",staticStyle:{width:"100%"}},[a("div",{staticClass:"form-group"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.wallet.number,expression:"wallet.number"}],staticClass:"form-control",attrs:{type:"text",placeholder:t.$t("enter-wallet-number")},domProps:{value:t.wallet.number},on:{input:function(e){e.target.composing||t.$set(t.wallet,"number",e.target.value)}}})])]):t._e()])],1),t._v(" "),a("div",{staticClass:"input-group"},[a("app-transition",{attrs:{name:"collapse"}},[t.wallet.typeId&&t.wallet.number?a("div",{staticClass:"mt-4 col",staticStyle:{display:"flex","justify-content":"center"}},[a("button",{directives:[{name:"t",rawName:"v-t",value:"create",expression:"'create'"}],staticClass:"btn btn-block btn-primary",staticStyle:{"max-width":"45%"},attrs:{type:"button"},on:{click:function(e){return t.create()}}}),t._v(" "),a("button",{directives:[{name:"t",rawName:"v-t",value:"cancel",expression:"'cancel'"}],staticClass:"btn btn-block btn-dark",staticStyle:{"max-width":"45%","margin-top":"0","margin-left":"5%"},attrs:{type:"button"},on:{click:function(e){return t.clear()}}})]):t._e()])],1)])])])}),[],!1,null,null,null);e.default=c.exports},KUXq:function(t,e,a){"use strict";function n(t){return JSON.parse(JSON.stringify(t))}function l(t){navigator.clipboard?navigator.clipboard.writeText(t).catch((function(t){console.error("[copyToClipboard]: Oops, unable to copy.\n",t)})):function(t){var e=document.createElement("textarea");e.value=t,e.style.position="fixed",e.style.top=0,e.style.left=0,e.style.width="2em",e.style.height="2em",e.style.padding=0,e.style.border="none",e.style.outline="none",e.style.boxShadow="none",e.style.background="transparent",document.body.appendChild(e),e.focus(),e.select();try{document.execCommand("copy")}catch(t){console.error("[copyToClipboard]: Oops, unable to copy.\n",t)}document.body.removeChild(e)}(t)}a.d(e,"a",(function(){return n})),a.d(e,"b",(function(){return l}))}}]);