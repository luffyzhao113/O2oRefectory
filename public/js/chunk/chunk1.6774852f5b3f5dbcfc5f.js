webpackJsonp([1],{"+pFx":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=u(n("HtL/")),o=u(n("6NqX")),s=u(n("nf43")),i=u(n("OcB2")),r=u(n("RGLJ")),l=u(n("P26H"));function u(t){return t&&t.__esModule?t:{default:t}}e.default={name:"show",components:{Reason:l.default,Detail:r.default,Box:i.default,ComponentModal:a.default},mixins:[o.default,s.default],data:function(){return{auditingModal:!1,seller:{},columns:[{title:"序号",render:function(t,e){var n=e.index;return t("span",null,[++n])},width:75},{title:"操作内容",key:"remark"},{title:"时间",key:"created_at"}]}},mounted:function(){var t=this;this.$nextTick(function(){t.$http.get("seller/auditing/"+t.data.id).then(function(e){t.seller=e.data.data}).catch(function(e){t.formatErrors(e)})})}}},"0mXR":function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("component-modal",{attrs:{title:"查看店铺",width:750}},[n("box",{attrs:{title:"店铺详情"}},[n("detail",{attrs:{title:"店铺名称"}},[t._v(t._s(t.seller.name))]),t._v(" "),n("detail",{attrs:{title:"商家姓名"}},[t.seller.certificates?n("span",[t._v(t._s(t.seller.certificates.name))]):t._e()])],1),t._v(" "),n("div",{attrs:{slot:"footer"},slot:"footer"},[n("Poptip",{attrs:{confirm:"",title:"确定此操作吗？",transfer:"",loading:t.loading},on:{"on-ok":t.auditingSuccess}},[n("Button",{attrs:{type:"primary",size:"large"}},[t._v("审核通过")])],1),t._v(" "),n("Button",{attrs:{type:"error",size:"large"},on:{click:function(e){t.auditingModal=!0}}},[t._v("审核不通过")])],1),t._v(" "),n("reason",{attrs:{title:"审核不通过理由",label:"理由"},on:{"on-submit":t.auditingFail},model:{value:t.auditingModal,callback:function(e){t.auditingModal=e},expression:"auditingModal"}})],1)},staticRenderFns:[]}},"19yw":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"true-or-false",props:{value:[String,Number],trueValue:{type:String,default:"是"},falseValue:{type:String,default:"否"}},data:function(){return{model:this.value,trueValueModel:this.trueValue,falseValueModel:this.falseValue}},methods:{setValue:function(t){this.$emit("input",t)}},watch:{value:function(t){this.model=t},falseValue:function(t){this.falseValueModel=t},trueValue:function(t){this.trueValueModel=t}}}},"1cvf":function(t,e,n){var a=n("lH1f");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("11476d4c",a,!0,{})},"5qdt":function(t,e,n){var a=n("I+Y0");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("7fbe8502",a,!0,{})},"6NqX":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:{data:{}},data:function(){return{loading:!1}},methods:{change:function(t){!1===t&&this.$emit("on-change")}}}},"6oAl":function(t,e,n){var a=n("VU/8")(n("McxL"),n("KHZr"),!1,function(t){n("qPe6")},"data-v-75eec931",null);t.exports=a.exports},"73gk":function(t,e){t.exports={render:function(){var t=this.$createElement,e=this._self._c||t;return e("Modal",{attrs:{title:this.title,value:!0,transfer:!1,loading:this.loading,"mask-closable":!1,width:this.width},on:{"on-visible-change":this.change}},[e("div",{staticClass:"modal-body"},[this._t("default")],2),this._v(" "),e("div",{attrs:{slot:"footer"},slot:"footer"},[this._t("footer")],2)])},staticRenderFns:[]}},"7mIX":function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("my-lists",{attrs:{columns:t.columns},on:{change:t.search},model:{value:t.data,callback:function(e){t.data=e},expression:"data"}},[n("Card",[n("p",{attrs:{slot:"title"},slot:"title"},[n("span",[t._v("搜索")])]),t._v(" "),n("Form",{ref:"searchForm",attrs:{model:t.searchForm,"label-width":80,inline:""}},[n("FormItem",{attrs:{prop:"name",label:"店铺名称"}},[n("seller-select",{attrs:{auditing:0}})],1),t._v(" "),n("FormItem",{attrs:{prop:"auditing_status",label:"审核状态"}},[n("Select",{staticStyle:{width:"150px"},attrs:{clearable:""},model:{value:t.searchForm.auditing_status,callback:function(e){t.$set(t.searchForm,"auditing_status",e)},expression:"searchForm.auditing_status"}},[n("Option",{attrs:{value:0}},[t._v("待审核")]),t._v(" "),n("Option",{attrs:{value:2}},[t._v("审核不通过")])],1)],1),t._v(" "),n("FormItem",{attrs:{"label-width":1}},[n("Button",{attrs:{type:"primary"},on:{click:function(e){t.search(1)}}},[t._v("搜索")])],1)],1)],1),t._v(" "),n(t.component.current,{tag:"components",attrs:{data:t.component.data},on:{"on-change":t.hideComponent}})],1)},staticRenderFns:[]}},A7nL:function(t,e,n){var a=n("EmQ5");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("0d56213c",a,!0,{})},CWGP:function(t,e){t.exports={render:function(){var t=this.$createElement;return(this._self._c||t)("Col",{attrs:{span:this.span}},[this._v("\n    "+this._s(this.title)+" : "),this._t("default")],2)},staticRenderFns:[]}},"D+SF":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a,o=n("nf43"),s=(a=o)&&a.__esModule?a:{default:a};e.default={name:"reason",mixins:[s.default],props:{title:{type:String,default:"标题"},value:{type:Boolean,default:!1},label:{type:String,default:"说明"}},data:function(){return{reason:{}}},computed:{show:{get:function(){return this.value},set:function(t){this.$emit("input",t)}}},methods:{submit:function(t){var e=this;this.$refs[t].validate(function(n){n&&e.$emit("on-submit",e.unObserver(e.$refs[t].model))})}}}},DrOM:function(t,e,n){var a=n("y9dp");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("695fe5c0",a,!0,{})},EmQ5:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,".tr[data-v-ae3918ce]{text-align:right}",""])},FmDQ:function(t,e){t.exports={render:function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"box"},[e("div",{staticClass:"box-header"},[this._v(this._s(this.title))]),this._v(" "),e("Row",{staticClass:"box-detail"},[this._t("default")],2)],1)},staticRenderFns:[]}},"HtL/":function(t,e,n){var a=n("VU/8")(n("i1uw"),n("73gk"),!1,function(t){n("meQ0")},"data-v-68564942",null);t.exports=a.exports},"I+Y0":function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,"",""])},IDkG:function(t,e,n){var a=n("VU/8")(n("+pFx"),n("zZ95"),!1,function(t){n("A7nL")},"data-v-ae3918ce",null);t.exports=a.exports},JtOP:function(t,e,n){var a=n("VU/8")(n("19yw"),n("mG19"),!1,function(t){n("PsCL")},"data-v-d60f0872",null);t.exports=a.exports},KHZr:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("Select",{staticStyle:{width:"150px"},attrs:{filterable:"",remote:"","remote-method":t.remoteMethod,loading:t.loading},model:{value:t.model,callback:function(e){t.model=e},expression:"model"}},t._l(t.options,function(e,a){return n("Option",{key:a,attrs:{value:e.id}},[t._v(t._s(e.name))])}))},staticRenderFns:[]}},"LR+P":function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,"",""])},McxL:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a,o=n("nf43"),s=(a=o)&&a.__esModule?a:{default:a};e.default={name:"seller-select",mixins:[s.default],props:{value:{},auditing:{type:Number,default:null},status:{type:Number,default:null}},data:function(){return{options:[]}},computed:{model:{get:function(){return this.value},set:function(t){this.$emit("input",t)}}},methods:{remoteMethod:function(t){""!==t&&(this.loading=!0,this.$http.get("seller/select",{params:{name:t,auditing_status:this.auditing,status:this.status}}).then(function(t){console.log(t.data)}))}}}},NFHk:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,"",""])},NU3c:function(t,e,n){var a=n("VU/8")(n("bIst"),n("7mIX"),!1,function(t){n("OcVj")},"data-v-5b0dfc32",null);t.exports=a.exports},OcB2:function(t,e,n){var a=n("VU/8")(n("j34L"),n("FmDQ"),!1,function(t){n("zk5K")},"data-v-73c0ca92",null);t.exports=a.exports},OcVj:function(t,e,n){var a=n("NFHk");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("39d7d834",a,!0,{})},P26H:function(t,e,n){var a=n("VU/8")(n("D+SF"),n("h3on"),!1,function(t){n("rOUZ")},"data-v-3bffb588",null);t.exports=a.exports},PsCL:function(t,e,n){var a=n("ey/G");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("5cdf7541",a,!0,{})},"Q/YR":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"my-lists",props:{value:{type:Object,default:function(){return{data:[],page:{total:100,current:1,page_size:20}}}},columns:{type:Array,default:function(){return[]}}},data:function(){return{leftCol:[{title:"序号",render:function(t,e){var n=e.index;return t("span",null,[++n])},width:75}],rightCol:[]}},computed:{tableCol:function(){return this.leftCol.concat(this.columns,this.rightCol)}},methods:{change:function(t){this.$emit("change",t)},rowClassName:function(t,e){}}}},RGLJ:function(t,e,n){var a=n("VU/8")(n("q2Z3"),n("CWGP"),!1,function(t){n("5qdt")},"data-v-761f75d5",null);t.exports=a.exports},Rx5O:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[t._t("default"),t._v(" "),n("div",{staticClass:"box-flex-list"},[n("Card",{attrs:{"dis-hover":""}},[n("p",{attrs:{slot:"title"},slot:"title"},[t._t("title",[n("span",[t._v("列表")])]),t._v(" "),t._t("button")],2),t._v(" "),n("Table",{ref:"table",attrs:{columns:t.tableCol,data:t.value.data,size:"small","row-class-name":t.rowClassName}}),t._v(" "),n("Page",{attrs:{total:t.value.page.total,size:"small",current:t.value.page.current,"page-size":t.value.page.page_size,"show-total":""},on:{"on-change":t.change}})],1)],1)],2)},staticRenderFns:[]}},X4sS:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,"",""])},YY0G:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=u(n("HtL/")),o=u(n("6NqX")),s=u(n("nf43")),i=u(n("OcB2")),r=u(n("RGLJ")),l=u(n("P26H"));function u(t){return t&&t.__esModule?t:{default:t}}e.default={name:"show",components:{Reason:l.default,Detail:r.default,Box:i.default,ComponentModal:a.default},mixins:[o.default,s.default],data:function(){return{auditingModal:!1,seller:{},columns:[{title:"序号",render:function(t,e){var n=e.index;return t("span",null,[++n])},width:75},{title:"操作内容",key:"remark"},{title:"时间",key:"created_at"}]}},mounted:function(){var t=this;this.$nextTick(function(){t.$http.get("seller/auditing/"+t.data.id).then(function(e){t.seller=e.data.data}).catch(function(e){t.formatErrors(e)})})},methods:{auditingFail:function(t){var e=this;this.loading=!0,this.$http.put("seller/auditing/"+this.data.id+"/fail",t).then(function(t){e.$Message.success("Success!"),e.change(!1)}).catch(function(t){e.formatErrors(t)}).finally(function(){e.loading=!1})},auditingSuccess:function(){var t=this;this.loading=!0,this.$http.put("seller/auditing/"+this.data.id).then(function(e){t.$Message.success("Success!"),t.change(!1)}).catch(function(e){t.formatErrors(e)}).finally(function(){t.loading=!1})}}}},bIst:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=u(n("dSCJ")),o=u(n("h7KM")),s=u(n("JtOP")),i=u(n("IDkG")),r=u(n("bqZC")),l=u(n("6oAl"));function u(t){return t&&t.__esModule?t:{default:t}}e.default={components:{SellerSelect:l.default,MyLists:a.default,TrueOrFalse:s.default,Show:i.default,Auditing:r.default},name:"index",mixins:[o.default],data:function(){var t=this;return{columns:[{title:"商店名称",key:"name"},{title:"审核状态",render:function(t,e){switch(e.row.auditing_status){case 0:return t("span",null,["待审核"]);case 1:return t("span",null,["已审核"]);case 2:return t("span",null,["审核不通过"])}}},{title:"操作",render:function(e,n){var a=n.row;return e("div",null,[e("i-button",{directives:[{name:"show",value:0===a.auditing_status}],attrs:{size:"small"},on:{click:function(){t.showComponent("Auditing",a)}}},["审核"]),e("i-button",{directives:[{name:"show",value:2===a.auditing_status}],attrs:{size:"small"},on:{click:function(){t.showComponent("Show",a)}}},["查看"])])}}]}},methods:{search:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;this.$http.get("seller/auditing",{params:this.request(e)}).then(function(e){t.assignmentData(e.data.data)}).catch(function(e){t.formatErrors(e)})}}}},bqZC:function(t,e,n){var a=n("VU/8")(n("YY0G"),n("0mXR"),!1,function(t){n("DrOM")},"data-v-074babba",null);t.exports=a.exports},dSCJ:function(t,e,n){var a=n("VU/8")(n("Q/YR"),n("Rx5O"),!1,function(t){n("1cvf")},"data-v-54fd0e4f",null);t.exports=a.exports},"ey/G":function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,"",""])},h3on:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("Modal",{attrs:{title:t.title,width:400,"mask-closable":!1},model:{value:t.show,callback:function(e){t.show=e},expression:"show"}},[n("Row",[n("Col",{attrs:{span:20}},[n("Form",{ref:"reason",attrs:{model:t.reason,"label-width":80}},[n("FormItem",{attrs:{label:t.label,rules:{required:!0,message:"必须填写",trigger:"blur"},prop:"remark"}},[n("Input",{attrs:{type:"textarea",autosize:{minRows:5,maxRows:5},placeholder:"Enter something..."},model:{value:t.reason.remark,callback:function(e){t.$set(t.reason,"remark",e)},expression:"reason.remark"}})],1)],1)],1)],1),t._v(" "),n("div",{attrs:{slot:"footer"},slot:"footer"},[n("Button",{attrs:{type:"primary",size:"large"},on:{click:function(e){t.submit("reason")}}},[t._v("确定")])],1)],1)},staticRenderFns:[]}},h7KM:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a,o=n("nf43"),s=(a=o)&&a.__esModule?a:{default:a};e.default={mixins:[s.default],data:function(){return{searchForm:{},data:{data:[],page:{total:0,current:1,page_size:20}},component:{current:"",data:{}}}},mounted:function(){this.search()},methods:{search:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0]},assignmentData:function(t){this.data.data=t.data,this.data.page.total=t.total,this.data.page.current=t.current_page,this.data.page.page_size=t.per_page},showComponent:function(t,e){this.component.current=t,this.component.data=e},hideComponent:function(){this.component.current="",this.component.data={},this.search()},destroyItem:function(t,e){var n=this;this.$http.delete(e).then(function(t){n.search()}).catch(function(t){n.formatErrors(t)})},request:function(t){var e=JSON.parse(JSON.stringify(this.searchForm));return e.page=t,e}}}},i1uw:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"component-modal",props:{title:{type:String,default:"弹窗"},width:{type:Number,default:520}},computed:{loading:function(){return this.$parent.loading}},methods:{change:function(t){this.$parent.$emit("on-change")}}}},j34L:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"box",props:{title:{type:String,default:"标题"}}}},lH1f:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,".ivu-table .table-info-row td[data-v-54fd0e4f]{background-color:#2db7f5;color:#fff}",""])},mG19:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("Select",{staticStyle:{width:"150px"},attrs:{clearable:""},on:{"on-change":t.setValue},model:{value:t.model,callback:function(e){t.model=e},expression:"model"}},[n("Option",{attrs:{value:1}},[t._v(t._s(t.trueValueModel))]),t._v(" "),n("Option",{attrs:{value:0}},[t._v(t._s(t.falseValueModel))]),t._v(" "),t._t("default")],2)},staticRenderFns:[]}},meQ0:function(t,e,n){var a=n("vq5g");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("404d3896",a,!0,{})},pSs9:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,".box[data-v-73c0ca92]{margin-bottom:10px;border:1px solid #dddee1;border-radius:5px}.box[data-v-73c0ca92]:last-child{margin-bottom:0}.box-header[data-v-73c0ca92]{padding:8px 48px 8px 16px;color:#495060;font-size:12px;line-height:16px;border-bottom:1px solid #dddee1}.box-detail[data-v-73c0ca92]{padding:10px}",""])},q2Z3:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"detail",props:{title:{type:String,default:"标题"},span:{type:Number,default:8}}}},qPe6:function(t,e,n){var a=n("X4sS");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("5b235962",a,!0,{})},rOUZ:function(t,e,n){var a=n("LR+P");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("17020ab4",a,!0,{})},vq5g:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,".modal-body[data-v-68564942]{max-height:500px;overflow-y:auto}",""])},y9dp:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,".tr[data-v-074babba]{text-align:right}",""])},zZ95:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("component-modal",{attrs:{title:"查看店铺",width:750}},[n("box",{attrs:{title:"店铺详情"}},[n("detail",{attrs:{title:"店铺名称"}},[t._v(t._s(t.seller.name))]),t._v(" "),n("detail",{attrs:{title:"商家姓名"}},[t.seller.certificates?n("span",[t._v(t._s(t.seller.certificates.name))]):t._e()])],1)],1)},staticRenderFns:[]}},zk5K:function(t,e,n){var a=n("pSs9");"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);n("rjj0")("6d57b419",a,!0,{})}});