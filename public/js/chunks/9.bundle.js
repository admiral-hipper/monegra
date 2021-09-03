(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{"2A9W":function(t,e,n){"use strict";n("qePV"),n("SYor");var a={name:"AmountInput",components:{CurrencyInput:n("1BPP").a},props:{value:{required:!0},min:{type:Number,default:0},max:{type:Number,default:999999999999999},precision:{type:Number,default:8},placeholder:{type:String,default:""},required:{type:Boolean,default:!0},disabled:{type:Boolean,default:!1},suffix:{type:String,default:null}},data:function(){return{focused:!1}},computed:{currency:function(){return this.suffix?{suffix:" "+this.suffix.trim()}:null}},methods:{inputHandler:function(t){this.focused&&this.$emit("input",t)}}},r=n("KHd+"),o=Object(r.a)(a,(function(){var t=this,e=t.$createElement;return(t._self._c||e)("currency-input",{staticClass:"form-control",attrs:{value:t.value,placeholder:t.placeholder,required:t.required,disabled:t.disabled,precision:t.precision,"value-range":{min:t.min,max:t.max},"allow-negative":!1,currency:t.currency},on:{focusin:function(e){t.focused=!0},focusout:function(e){t.focused=!1},input:t.inputHandler}})}),[],!1,null,null,null);e.a=o.exports},UHwg:function(t,e,n){"use strict";var a=n("uuqX");n.n(a).a},Wnky:function(t,e,n){"use strict";n.r(e),n("ma9I"),n("oVuX"),n("sMBO"),n("B6y2");var a=n("o0o1"),r=n.n(a),o=(n("ls82"),n("HaE+")),s=n("hMhp"),l=n("FjSL"),i=n("2A9W"),c=n("PdH4"),u=n.n(c),p=(n("QVta"),{name:"PurchasePanel",mixins:[s.a],components:{AppTable:l.a,AmountInput:i.a},props:{walletTypes:{type:Array,required:!0},quotes:{type:Object,required:!0}},data:function(){return{tableQueryURL:"/purchase/get-transactions",loading:!1,amount:null,amountInToken:null,selectedWalletType:{}}},computed:{locationOrigin:function(){return location.origin},selectedCurrencyCode:function(){return this.selectedWalletType.currency?this.selectedWalletType.currency.code:null},selectedCurrencyQuote:function(){return this.selectedCurrencyCode&&this.quotes[this.selectedCurrencyCode+"/RTL"]||1}},watch:{selectedWalletType:function(){this.amount&&this.amountInputHandler("amountInToken")}},methods:{amountInputHandler:function(t){"amount"===t?this.amountInToken=this.amount*this.selectedCurrencyQuote:this.amount=this.amountInToken/this.selectedCurrencyQuote},selectWalletType:function(t){this.loading||(this.selectedWalletType=t)},getInfoForTransaction:function(){var t=this;return Object(o.a)(r.a.mark((function e(){var n,a,o,s,l,i,c,p,d,m,f,y;return r.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(!t.loading&&t.selectedWalletType&&t.amount){e.next=2;break}return e.abrupt("return");case 2:return t.loading=!0,n=JSON.parse(JSON.stringify(t.selectedWalletType)),a=t.amount,u.a.fire({title:t.$t("loading"),text:t.$t("receiving-data"),timer:0,timerProgressBar:!0,allowOutsideClick:!1,allowEscapeKey:!1,onBeforeOpen:function(){return u.a.showLoading()}}),e.prev=6,e.next=9,axios.get("/purchase/get-info-for-transaction",{params:{wallet_type_id:n.id,amount:a}});case 9:s=e.sent,o=s.data,t.amount=a=o.amount,t.amountInputHandler("amount"),e.next=22;break;case 15:return e.prev=15,e.t0=e.catch(6),l=e.t0.response,i="string"==typeof l.data?l.data:Object.values(l.data.errors).join("<br>"),u.a.fire(t.$t("error"),i,"error"),t.loading=!1,e.abrupt("return");case 22:if(t.loading=!1,o.user_wallet){e.next=27;break}return c="<div>\n                    <div>".concat(t.$t("messages.wallet-for-payment-system-is-required",{paymentSystem:n.name}),"</div>\n                    <br>\n                    <small>").concat(t.$t("hints.you-can-create-it-in-the-section"),' <a href="').concat(o.link_to_wallets,'">').concat(t.$t("wallets"),"</a></small>\n                    </div>"),u.a.fire({title:t.$t("replenishment"),html:c,icon:"info"}),e.abrupt("return");case 27:p=o.currency_rate?"<div>".concat(t.$t("currency-rate"),": <strong>").concat(o.currency_rate,"</strong></div>"):"",d=o.system_wallet?"<div>".concat(t.$t("number-of-wallet",{wallet:n.name}),": <strong>").concat(o.system_wallet.number,"</strong></div>\n                   ").concat(o.system_wallet.public_key?"<div>".concat(t.$t("public-key-of-wallet",{wallet:n.name}),": <strong>").concat(o.system_wallet.public_key,"</strong></div>"):""):"",m="<div>".concat(p,"\n                <div>").concat(t.$t("transfer-amount"),": <strong>").concat(o.amount_to_transfer,"</strong></div>\n                ").concat(d,'\n                <div style="margin-top: 20px;">').concat(t.$t("balance-will-be-replenished-in-the-amount"),": <strong>").concat(o.internal_currency_amount,"</strong></div>\n                </div>"),f="<div><strong>"+t.$t("instruction")+'</strong><br><ul style="padding: 8px 12px; list-style-type: decimal;"><li>'+t.$t("instructions-for-replenishment.first")+"</li><li>"+t.$t("instructions-for-replenishment.second")+"</li><li>"+t.$t("instructions-for-replenishment.third")+"</li><li>"+t.$t("instructions-for-replenishment.fourth")+"</li><li>"+t.$t("instructions-for-replenishment.fifth")+"</li></ul></div>",y="<div>\n                <div>".concat(t.$t("we-found-your-wallet",{wallet:n.name}),'</div>\n                <div style="margin-top: 10px;"><input type="text" class="form-control" readonly value="').concat(o.user_wallet.number,'" style="background-color:#fff;"/></div>\n                </div>'),o.auto_payment?u.a.mixin({focusConfirm:!1,showCloseButton:!0,showCancelButton:!0,allowOutsideClick:!1,allowEscapeKey:!1,allowEnterKey:!1,cancelButtonText:t.$t("cancel"),progressSteps:[1,2,3]}).queue([{grow:"column",title:t.$t("replenishment-step",{step:1}),html:y,footer:"<small>".concat(t.$t("hints.wallet-details-change"),' <a href="').concat(o.link_to_wallets,'">').concat(t.$t("wallets"),"</a></small>"),confirmButtonText:t.$t("further")+" &rarr;"},{grow:"row",title:t.$t("replenishment-step",{step:2}),html:m,allowOutsideClick:!1,allowEscapeKey:!1,confirmButtonText:t.$t("further")+" &rarr;"}]).then((function(e){e.dismiss||t.createTransaction({amount:a,userWallet:o.user_wallet,autoPayment:o.auto_payment})})):u.a.mixin({focusConfirm:!1,showCloseButton:!0,showCancelButton:!0,allowOutsideClick:!1,allowEscapeKey:!1,allowEnterKey:!1,cancelButtonText:t.$t("cancel"),progressSteps:[1,2]}).queue([{grow:"column",title:t.$t("replenishment-step",{step:1}),html:y,footer:"<small>".concat(t.$t("hints.wallet-details-change"),' <a href="').concat(o.link_to_wallets,'">').concat(t.$t("wallets"),"</a></small>"),confirmButtonText:t.$t("pay")+" &rarr;"},{grow:"row",title:t.$t("replenishment-step",{step:2}),html:m,footer:f,allowOutsideClick:!1,allowEscapeKey:!1,confirmButtonText:t.$t("i-paid"),confirmButtonColor:"#2cce6d"}]).then((function(e){e.dismiss||t.createTransaction({amount:a,userWallet:o.user_wallet})}));case 33:case"end":return e.stop()}}),e,null,[[6,15]])})))()},createTransaction:function(t){var e=this;return Object(o.a)(r.a.mark((function n(){var a,o,s,l,i,c,p,d,m,f,y,h;return r.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:if(!e.loading){n.next=2;break}return n.abrupt("return");case 2:return e.loading=!0,a={wallet_id:t.userWallet.id,amount:t.amount},u.a.fire({title:e.$t("payment"),text:e.$t("transaction-creating"),timer:0,timerProgressBar:!0,allowOutsideClick:!1,allowEscapeKey:!1,onBeforeOpen:function(){return u.a.showLoading()}}),n.prev=5,n.next=8,axios.post("/purchase/create-transaction",a);case 8:return o=n.sent,s=o.data,l=s.link_for_payment,i=s.form_for_payment,c=s.link_to_transactions,p=s.internal_currency_code,d=s.internal_currency_amount,t.autoPayment?(u.a.fire({title:e.$t("payment"),html:"<div>".concat(e.$t("messages.payment-transaction-created-without-payment")," <strong>").concat(d," ").concat(p,"</strong></div>").concat(i||""),footer:"<small>"+e.$t("hints.payment-redirect")+"</small>",confirmButtonText:e.$t("go-to-payment"),confirmButtonColor:"#2cce6d",showConfirmButton:Boolean(l),showCancelButton:!1,allowOutsideClick:!1,allowEscapeKey:!1,allowEnterKey:!1,preConfirm:l?function(){return window.open(l,"_blank")}:Function}),i&&(m=document.querySelector("button[name=PAYMENT_METHOD]"),f=function t(){u.a.isVisible()&&u.a.close(),m.removeEventListener("click",t,!1)},m.addEventListener("click",f,!1))):u.a.fire({title:e.$t("transaction-creating"),html:"<div>\n                        <div>".concat(e.$t("messages.payment-transaction-created")," <strong>").concat(d," ").concat(p,"</strong></div>\n                        <br>\n                        <small>").concat(e.$t("hints.monitor-transaction-status"),' <a href="').concat(c,'">').concat(e.$t("transactions"),"</a></small>\n                        </div>"),icon:"success"}),n.next=13,e.getTableData();case 13:n.next=20;break;case 15:n.prev=15,n.t0=n.catch(5),y=n.t0.response,h="string"==typeof y.data?y.data:Object.values(y.data.errors).join("<br>"),u.a.fire(e.$t("error"),h,"error");case 20:e.selectedWalletType={},e.amount=e.amountInToken=null,e.loading=!1;case 23:case"end":return n.stop()}}),n,null,[[5,15]])})))()}}}),d=(n("UHwg"),n("KHd+")),m=Object(d.a)(p,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"row"},[n("div",{staticClass:"col-12"},[n("app-transition",{attrs:{name:"collapse",appear:""}},[n("div",{staticClass:"card"},[n("div",{staticClass:"card-body"},[n("h4",{directives:[{name:"t",rawName:"v-t",value:"rtl-buy",expression:"'rtl-buy'"}],staticClass:"card-title"}),t._v(" "),n("p",{directives:[{name:"t",rawName:"v-t",value:"choosing-payment-system",expression:"'choosing-payment-system'"}],staticClass:"card-text"}),t._v(" "),n("div",{staticStyle:{display:"flex","flex-direction":"column"}},[n("div",{staticClass:"wallet-types"},t._l(t.walletTypes,(function(e){return n("div",{key:e.id,class:{active:t.selectedWalletType.id===e.id},on:{click:function(n){return t.selectWalletType(e)}}},[n("span",{staticStyle:{"margin-right":"5px"},domProps:{textContent:t._s(e.name)}}),t._v(" "),n("img",{attrs:{src:t.locationOrigin+"/"+e.image_path,alt:e.name,height:"40"}})])})),0),t._v(" "),n("app-transition",{attrs:{name:"collapse"}},[t.selectedWalletType.id?n("div",{staticClass:"form-body mt-4"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",[t._v(t._s(t.$t("purchase-amount-in"))+" "+t._s(t.selectedCurrencyCode))]),t._v(" "),n("amount-input",{attrs:{suffix:t.selectedCurrencyCode,placeholder:t.selectedCurrencyCode},on:{input:function(e){return t.amountInputHandler("amount")}},model:{value:t.amount,callback:function(e){t.amount=e},expression:"amount"}})],1)]),t._v(" "),n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",[t._v(t._s(t.$t("purchase-amount-in"))+" RTL")]),t._v(" "),n("amount-input",{attrs:{suffix:"RTL",placeholder:"RTL"},on:{input:function(e){return t.amountInputHandler("amountInToken")}},model:{value:t.amountInToken,callback:function(e){t.amountInToken=e},expression:"amountInToken"}})],1)])])]):t._e()]),t._v(" "),n("app-transition",{attrs:{name:"collapse"}},[t.amount?n("div",[n("button",{directives:[{name:"t",rawName:"v-t",value:"buy-rtl",expression:"'buy-rtl'"}],staticClass:"btn btn-primary",staticStyle:{"max-width":"50%"},attrs:{type:"button"},on:{click:function(e){return t.getInfoForTransaction()}}})]):t._e()])],1)])])])],1)]),t._v(" "),t.isTableFilled?n("app-table",t._b({attrs:{title:t.$t("transactions")},on:{"load-page":t.getTableData}},"app-table",t.tableData,!1)):t._e()],1)}),[],!1,null,null,null);e.default=m.exports},m88U:function(t,e,n){(t.exports=n("I1BE")(!1)).push([t.i,".wallet-types{display:flex;align-items:center;flex-wrap:wrap}.wallet-types>div{white-space:nowrap;margin:5px 10px 5px 0;padding:10px 15px;border:3px solid transparent;color:#424242;border-radius:10px;box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.04),0 1px 5px 0 rgba(0,0,0,.1);transition:border-color .2s ease-in-out,box-shadow .2s ease-in-out;will-change:border-color,box-shadow;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:pointer}.wallet-types>div.active{border-color:#6976e9}.wallet-types>div:hover:not(:active){box-shadow:0 3px 5px -2px rgba(0,0,0,.3),0 2px 2px 0 rgba(0,0,0,.07),0 1px 5px 0 rgba(0,0,0,.15)}",""])},uuqX:function(t,e,n){var a=n("m88U");"string"==typeof a&&(a=[[t.i,a,""]]);n("aET+")(a,{hmr:!0,transform:void 0,insertInto:void 0}),a.locals&&(t.exports=a.locals)}}]);