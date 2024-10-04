(()=>{"use strict";const e=window.wp.blocks,t=window.wp.i18n,n=window.wp.blockEditor,a=window.wp.components,l=function(e){var a=e.attributes,l=e.setAttributes,r=a.label,c=a.hide_label,i=a.required,o=a.instructions;return React.createElement("div",{className:"acf-field"},React.createElement("div",{className:"acf-label"},React.createElement("label",null,!c&&React.createElement(n.RichText,{tagName:"label",onChange:function(e){return l({label:e})},withoutInteractiveFormatting:!0,placeholder:(0,t.__)("Text Field","acf-frontend-form-element"),value:r}),i&&React.createElement("span",{className:"acf-required"},"*"))),React.createElement("div",{className:"acf-input"},o&&React.createElement(n.RichText,{tagName:"p",className:"description",onChange:function(e){return l({instructions:e})},withoutInteractiveFormatting:!0,value:o}),React.createElement("div",{className:"acf-input-wrap",style:{display:"flex",width:"100%"}},e.children)))};var r="acf-frontend-form-element";const c=function(e){var l,c=e.attributes,i=e.setAttributes,o=c.label,u=c.hide_label,s=c.required,m=c.instructions;return React.createElement(n.InspectorControls,{key:"fea-inspector-controls"},React.createElement(a.PanelBody,{title:(0,t.__)("General",r),initialOpen:!0},React.createElement(a.TextControl,{label:(0,t.__)("Label",r),value:o,onChange:function(e){return i({label:e})}}),React.createElement(a.ToggleControl,{label:(0,t.__)("Hide Label",r),checked:u,onChange:function(e){return i({hide_label:e})}}),"name"in c&&React.createElement(a.TextControl,{label:(0,t.__)("Name",r),value:c.name||(l=o,l.toLowerCase().replace(/[^a-z0-9 ]/g,"").replace(/\s+/g,"_")),onChange:function(e){return i({name:e})}}),React.createElement(a.TextareaControl,{label:(0,t.__)("Instructions",r),rows:"3",value:m,onChange:function(e){return i({instructions:e})}}),React.createElement(a.ToggleControl,{label:(0,t.__)("Required",r),checked:s,onChange:function(e){return i({required:e})}}),e.children))};var i="acf-frontend-form-element";const o=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"frontend-admin/range-field","title":"Range Field","description":"Displays a range field.","category":"frontend-admin","textdomain":"frontend-admin","supports":{"align":["wide"]},"attributes":{"name":{"type":"string","default":""},"label":{"type":"string","default":"Range Field"},"hide_label":{"type":"boolean","default":""},"required":{"type":"boolean","default":""},"default_value":{"type":"number","default":""},"placeholder":{"type":"string","default":""},"instructions":{"type":"string","default":""},"prepend":{"type":"string","default":""},"append":{"type":"string","default":""},"min":{"type":"number","default":"1"},"max":{"type":"number","default":"100"},"step":{"type":"number","default":""}},"editorScript":"file:../../range/index.js"}');(0,e.registerBlockType)(o,{edit:function(e){var r=e.attributes,o=e.setAttributes,u=r.default_value,s=r.placeholder,m=r.prepend,d=r.append,p=r.min,f=r.max,b=r.step,g=(0,n.useBlockProps)();return React.createElement("div",g,React.createElement(c,e,React.createElement(a.RangeControl,{min:p,max:f,step:b,label:(0,t.__)("Default Value",i),value:u,onChange:function(e){return o({default_value:e})}}),React.createElement(a.TextControl,{label:(0,t.__)("Placeholder",i),value:s,onChange:function(e){return o({placeholder:e})}}),React.createElement(a.TextControl,{label:(0,t.__)("Prepend",i),value:m,onChange:function(e){return o({prepend:e})}}),React.createElement(a.TextControl,{label:(0,t.__)("Append",i),value:d,onChange:function(e){return o({append:e})}}),React.createElement(a.TextControl,{type:"number",label:(0,t.__)("Minimum Value",i),max:f,value:p,onChange:function(e){return o({min:Math.min(e,f)})}}),React.createElement(a.TextControl,{type:"number",label:(0,t.__)("Maximum Value",i),min:p,value:f,onChange:function(e){return o({max:Math.max(e,p)})}}),React.createElement(a.TextControl,{type:"number",label:(0,t.__)("Step",i),value:b,onChange:function(e){return o({step:e})}})),React.createElement(l,e,m&&React.createElement("span",{className:"acf-input-prepend"},m),React.createElement("div",{style:{width:"auto",flexGrow:1}},React.createElement(a.RangeControl,{min:p,max:f,step:b,hideLabelFromVision:!0,value:u,onChange:function(e){return o({default_value:e})}})),d&&React.createElement("span",{className:"acf-input-append"},d)))},save:function(){return null}})})();