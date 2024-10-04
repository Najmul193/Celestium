(()=>{"use strict";const e=window.wp.blocks,t=window.wp.i18n,n=window.wp.blockEditor,r=window.wp.components,o=window.React;function a(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var r,o,a,i,l=[],c=!0,s=!1;try{if(a=(n=n.call(e)).next,0===t){if(Object(n)!==n)return;c=!1}else for(;!(c=(r=a.call(n)).done)&&(l.push(r.value),l.length!==t);c=!0);}catch(e){s=!0,o=e}finally{try{if(!c&&null!=n.return&&(i=n.return(),Object(i)!==i))return}finally{if(s)throw o}}return l}}(e,t)||function(e,t){if(e){if("string"==typeof e)return i(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?i(e,t):void 0}}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function i(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}var l="acf-frontend-form-element";const c=function(e){var n=a((0,o.useState)(null),2),i=n[0],c=n[1],s=a((0,o.useState)(!0),2),u=s[0],f=s[1];(0,o.useEffect)((function(){m()}),[]);var m=function(){wp.apiFetch({path:"frontend-admin/v1/frontend-forms"}).then((function(e){var n=[{value:0,label:(0,t.__)("Select a form",l),disabled:!0}].concat(e);c(n),f(!1)}))};return u?React.createElement("p",null,(0,t.__)("Loading forms...",l)):i.length<1?React.createElement("p",null,(0,t.__)("No forms found...",l)):React.createElement(r.SelectControl,{options:i,label:(0,t.__)("Form",l),labelPosition:"side",value:e.value,onChange:e.onChange,onClick:e.onClick})},s=window.wp.editor,u=function(e){return e.form?React.createElement(r.Disabled,{key:"fea-disabled-render"},React.createElement(s.ServerSideRender,{block:e.block,attributes:{formID:e.form,editMode:1}})):null},f=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"acf-frontend/submissions","title":"Frontend Admin Submissions","description":"Display frontend submissions so that site admins can update content from the frontend.","category":"frontend-admin","textdomain":"frontend-admin","supports":{"align":["wide"]},"attributes":{"formID":{"type":"number","default":0},"editMode":{"type":"boolean","default":true}},"editorScript":"file:../../submissions/index.js"}');(0,e.registerBlockType)(f,{edit:function(e){var o=e.attributes,a=e.setAttributes,i=(0,n.useBlockProps)();return React.createElement("div",i,React.createElement(n.InspectorControls,{key:"fea-inspector-controls"},React.createElement(r.PanelBody,{title:(0,t.__)("Form Settings","acf-frontend-form-element"),initialOpen:!0},React.createElement(r.PanelRow,null,React.createElement(c,{value:o.formID,onChange:function(e){return a({formID:parseInt(e)})}})))),React.createElement(c,{value:o.formID,onChange:function(e){return a({formID:parseInt(e)})}}),React.createElement(u,{form:o.formID,block:e.name}))},save:function(){return null}})})();