 function _qO(_qo){return document.getElementById(_qo); }
 function _qY(_qy){return (_qy!=null); }
 function _qI(_qi,_qA){return _qA.indexOf(_qi); }
 function _qa(_qE,_qe){var _qU=document.createElement(_qE); _qe.appendChild(_qU); return _qU; }
 function _qu(_qy,_qZ){if (!_qY(_qZ))_qZ=1; for (var i=0; i<_qZ; i++)_qy=_qy.nextSibling; return _qy; }
 function _qz(){return (typeof(_qiO1)=="undefined");}
 function _qX(_qy,_qZ){if (!_qY(_qZ))_qZ=1; for (var i=0; i<_qZ; i++)_qy=_qy.parentNode; return _qy; }
 function _qx(_qy,_qZ){if (!_qY(_qZ))_qZ=1; for (var i=0; i<_qZ; i++)_qy=_qy.firstChild; return _qy; }
 function _qW(_qy,_qw){_qy.style.height=_qw+"px"; }
 function _qV(_qy,_qw){_qy.style.width=_qw+"px"; }
 function _qv(_qy){return parseInt(_qy.style.width); }
 function _qT(_qy){return parseInt(_qy.style.height); }
 function _qt(_qS,_qs,_qR){_qR=_qY(_qR)?_qR:document.body; var _qr=_qR.getElementsByTagName(_qS); var _qQ=new Array(); for (var i=0; i<_qr.length; i++)if (_qr[i].className.indexOf(_qs)>=0){_qQ.push(_qr[i]); }return _qQ; }
 function _qq(_qS,_qs,_qR){var _qP=_qt(_qS,_qs,_qR); if (_qP.length>0){return _qP[0]; }return false; }
 function _qp(_qy,_qw){_qy.style.display=(_qw)?"": "none"; }
 function _qN(_qy){return (_qy.style.display!="none"); }
 function _qn(_qy){return _qy.className; }
 function _qM(_qy,_qw){_qy.className=_qw; }
 function _qm(_qi,_qL,_ql){_qM(_ql,_qn(_ql).replace(_qi,_qL)); }
 function addClass(_qy,_qs){if (_qy.className.indexOf(_qs)<0){var _qk=_qy.className.split(" "); _qk.push(_qs); _qy.className=_qk.join(" "); }}
 function _qJ(_qy,_qs){if (_qy.className.indexOf(_qs)>-1){_qm(_qs,"",_qy);var _qk=_qy.className.split(" "); _qy.className=_qk.join(" "); }}
 function _qj(_qH,_qh,_qG,_qg){if (_qH.addEventListener){_qH.addEventListener(_qh,_qG,_qg); return true; }else if (_qH.attachEvent){if (_qg){return false; }else {var _qF= function (){_qG.apply(_qH,[window.event]); };if (!_qH["ref"+_qh])_qH["ref"+_qh]=[]; else {for (var _qf in _qH["ref"+_qh]){if (_qH["ref"+_qh][_qf]._qG === _qG)return false; }}var _qD=_qH.attachEvent("on"+_qh,_qF); if (_qD)_qH["ref"+_qh].push( {_qG:_qG,_qF:_qF } ); return _qD; }}else {return false; }}
 function _qd(_qH,_qh,_qG,_qg){if (_qH.removeEventListener){_qH.removeEventListener(_qh,_qG,_qg); return true; }else if (_qH.detachEvent){if (_qH["ref"+_qh]){for (var _qf in _qH["ref"+_qh]){if (_qH["ref"+_qh][_qf]._qG === _qG){_qH.detachEvent("on"+_qh,_qH["ref"+_qh][_qf]._qF); _qH["ref"+_qh][_qf]._qG=null; _qH["ref"+_qh][_qf]._qF=null; delete _qH["ref"+_qh][_qf]; return true; }}}return false; }else {return false; }}
 function _qC(_qc){if (_qc.stopPropagation)_qc.stopPropagation(); else _qc.cancelBubble= true; }
 function _qB(_qc){if (_qc.preventDefault)_qc.preventDefault(); else event.returnValue= false; return false; }
 function _qb(){return false; }
 function _qo0(_ql){var _qO0=""; var _ql0=(_ql instanceof Array); for (var _qi0 in _ql){switch (typeof(_ql[_qi0])){case "string":_qO0+=(_ql0)?"\""+_ql[_qi0]+"\",": "\""+_qi0+"\":\""+_ql[_qi0]+"\","; break; case "number":_qO0+=(_ql0)?_ql[_qi0]+",": "\""+_qi0+"\":"+_ql[_qi0]+","; break; case "boolean":_qO0+=(_ql0)?(_ql[_qi0]?"true": "false")+",": "\""+_qi0+"\":"+(_ql[_qi0]?"true": "false")+","; break; case "object":_qO0+=(_ql0)?_qo0(_ql[_qi0])+",": "\""+_qi0+"\":"+_qo0(_ql[_qi0])+","; break; }}if (_qO0.length>0)_qO0=_qO0.substring(0,_qO0.length-1); _qO0=(_ql0)?"["+_qO0+"]": "{"+_qO0+"}"; if (_qO0=="{}")_qO0="null"; return _qO0; }
 function _qI0(_qo1){if (_qo1.pageX || _qo1.pageY){return {_qO1:_qo1.pageX,_ql1:_qo1.pageY } ; }else if (_qo1.clientX || _qo1.clientY){return {_qO1:_qo1.clientX+(document.documentElement.scrollLeft?document.documentElement.scrollLeft:document.body.scrollLeft),_ql1:_qo1.clientY+(document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop)} ; }else {return {_qO1:null,_ql1:null } ; }}var _qi1=null; var _qI1=null; function _qo2(_qc){if (_qi1!=null){ (new _qO2(_qi1))._ql2(_qc); }}
 function _qi2(_qc){if (_qi1!=null){ (new _qO2(_qi1))._qI2(_qc); }}
 function _qO2(_qo){ this._qo=_qo; this._qo3(); }
 _qO2.prototype= {_qo3:function (){} ,_qO3:function (){var _ql3=_qO(this._qo); addClass(_ql3,"dragobject"); _qj(_ql3,"mousedown",_qi3, false); _ql3.onselectstart=_qb; _ql3.ondragstart=_qb; _ql3.onmousedown=_qb; } ,_qI3:function (){var _ql3=_qO(this._qo); addClass(_ql3,"dragDisable"); } ,_qo4:function (){var _ql3=_qO(this._qo); _qJ(_ql3,"dragDisable"); } ,_qO4:function (_qc){var _ql3=_qO(this._qo); _qi1=this._qo; _qj(document,"mousemove",_qo2, false); _qj(document,"mouseup",_qi2, false); var _ql4=_qi4(_ql3); _ql4._qI4(_qi1); _qI1= false; } ,_ql2:function (_qc){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); var _qo5=_qO("_dragdummy");if (_qo5==null){_qo5=_ql3.cloneNode( true); _qo5.id="_dragdummy"; _qM(_qo5,_ql4._qO5()+"DragDummy"); document.body.appendChild(_qo5); _qo5.style.position="absolute"; }var _ql5=_qI0(_qc); _qo5.style.left=(_ql5._qO1+5)+"px"; _qo5.style.top=(_ql5._ql1+5)+"px"; } ,_qI2:function (_qc){var _qo5=_qO("_dragdummy"); if (_qo5)document.body.removeChild(_qo5); _qi1=null; _qd(document,"mousemove",_qo2, false); _qd(document,"mouseup",_qi2, false); _qI1= true; }};function _qi3(_qc){ (new _qO2(this.id))._qO4(_qc); }
 function _qi5(_qo){ this._qo=_qo; this._qo3(); }
 _qi5.prototype= {_qo3:function (){} ,_qO3:function (){var _ql3=_qO(this._qo); addClass(_ql3,"dropobject"); _qj(_ql3,"mouseover",_qI5, false); _qj(_ql3,"mouseout",_qo6, false); _qj(_ql3,"mouseup",_qO6, false); } ,_qI3:function (){var _ql3=_qO(this._qo); addClass(_ql3,"dragDisable"); } ,_qo4:function (){var _ql3=_qO(this._qo); _qJ(_ql3,"dragDisable"); } ,_ql6:function (_qc){if (_qi1!=null && _qi1!=this._qo){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); _ql4._qi6(this._qo); }return _qC(_qc); } ,_qI6:function (_qc){if (_qi1!=null && _qi1!=this._qo){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); _ql4._qo7(this._qo); }return _qC(_qc); } ,_qO7:function (_qc){if (_qI1== false){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); _ql4._ql7(_qi1,this._qo); _qI1= true; }}};function _qI5(_qc){return (new _qi5(this.id))._ql6(_qc); }
 function _qo6(_qc){return (new _qi5(this.id))._qI6(_qc); }
 function _qO6(_qc){return (new _qi5(this.id))._qO7(_qc); }
 function PivotField(_qo){ this._qo=_qo; this.id=_qo; }
 PivotField.prototype= {sort:function (_qi7){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); if (!_ql4._qI7("OnBeforeFieldSort", { "Sort":_qi7 } ,this ))return; _ql4._qo8(this._qo,"Sort", { "Sort":_qi7 } ); _ql4._qO8("OnFieldSort", { "Sort":_qi7 } ,this ); } ,_ql8:function (_qi7){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); if (!_ql4._qI7("OnBeforeGroupSort", { "Sort":_qi7 } ,this ))return; _ql4._qo8(this._qo,"SortGroup", { "Sort":_qi7 } ); _ql4._qO8("OnGroupSort", { "Sort":_qi7 } ,this ); } ,_qi8:function (_qi7){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); if (!_ql4._qI7("OnBeforeGroupSort", { "Sort":_qi7 } ,this ))return; _ql4._qo8(this._qo,"SortGroup", { "Sort":_qi7 } ); _ql4._qO8("OnGroupSort", { "Sort":_qi7 } ,this ); } ,_qI8:function (_qo9,_qO9){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); if (!_ql4._qI7("OnBeforeChangeSortData", { "FieldName":_qo9,"Check":_qO9 } ,this ))return; _ql4._qo8(_ql4._qo,"ChangeSortData", { "FieldName":_qo9,"Check":_qO9 } ); _ql4._qO8("OnChangeSortData", { "FieldName":_qo9,"Check":_qO9 } ,this ); } ,filter_by_expression:function (_ql9,_qi9,_qI9){if (!_qY(_qI9))_qI9=null; var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); if (!_ql4._qI7("OnBeforeFieldFilter", { "FilterBy": "Values","Expression":_ql9,"value1":_qi9,"value2":_qI9 } ,this ))return; _ql4._qo8(this._qo,"CloseFilterPanel", { "Command": "ok","FilterBy": "Values","Expression":_ql9,"value1":_qi9,"value2":_qI9 } ); _ql4._qO8("OnFieldFilter", { "FilterBy": "Values","Expression":_ql9,"value1":_qi9,"value2":_qI9 } ,this ); } ,filter_by_selection:function (_qoa,_qOa){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); if (!_ql4._qI7("OnBeforeFieldFilter", { "FilterBy": "Options","IncludeAll":_qoa,"ExceptionList":_qOa } ,this ))return; _ql4._qo8(this._qo,"CloseFilterPanel", { "Command": "ok","FilterBy": "Options","IncludeAll":_qoa,"ExceptionList":_qOa } ); _ql4._qO8("OnFieldFilter", { "FilterBy": "Options","IncludeAll":_qoa,"ExceptionList":_qOa } ,this ); } ,open_filter_panel:function (){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); var _qla=_qx(_qO(_ql4._qo)); if (!_ql4._qI7("OnBeforeFilterPanelOpen", {} ,this ))return; _ql4._qo8(this._qo,"OpenFilterPanel", { "Width":_qla.offsetWidth,"Height":_qla.offsetHeight } ); _ql4._qO8("OnFilterPanelOpen", {} ,this ); } ,
 expand:function (){
 	var _ql3=_qO(this._qo); 
 	var _ql4=_qi4(_ql3);  
 	if (!_ql4._qI7("OnBeforeFieldExpand", {} ,this )) return; 
 	_ql4._qo8(this._qo,"Expand", {} ); 
 	_ql4._qO8("OnFieldExpand", {} ,this ); 
 } ,
 collapse:function (){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); if (!_ql4._qI7("OnBeforeFieldCollapse", {} ,this ))return; _qia._qo8(this._qo,"Collapse", {} ); _ql4._qO8("OnFieldCollapse", {} ,this ); }};
 function PivotGroup(_qo){ this._qo=_qo; this.id=_qo; }
 PivotGroup.prototype= {
 	expand:function (){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); console.log("expand"+_ql4); 
 	if (!_ql4._qI7("OnBeforeGroupExpand", {} ,this )) { console.log("OnBeforeGroupExpand"); return; }
 	_ql4._qo8(this._qo,"Expand", {} ); 
 	_ql4._qo8(_ql4._qo,"Expand", {} ); 
 	_ql4._qO8("OnGroupExpand", {} ,this ); } ,
 	collapse:function (){var _ql3=_qO(this._qo); var _ql4=_qi4(_ql3); if (!_ql4._qI7("OnBeforeGroupCollapse", {} ,this ))return; _ql4._qo8(this._qo,"Collapse", {} ); _ql4._qo8(_ql4._qo,"Collapse", {} ); _ql4._qO8("OnGroupCollapse", {} ,this ); }};
 function KoolPivotTable(_qo,_qIa,_qob){ this._qo=_qo; this.id=_qo; this._qIa=_qIa; this._qob=_qob; this._qo3(); }var _qOb=0; var _qlb=1; var _qib=2; var _qIb=3; 
 KoolPivotTable.prototype= {
 	_qo3:function (){var _ql3=_qO(this._qo); var _qoc=this._qOc(); if (_qn(_qx(_ql3))=="kptFilterPanel"){var _qlc=_qx(_ql3); var _qic=_qx(_qlc); var _qIc=_qu(_qic); _qW(_qIc,_qT(_qlc)-_qic.offsetHeight); var _qod=_qlc.id; var _qOd=_qO(_qod+"_ok"); var _qld=_qO(_qod+"_cancel"); _qj(_qOd,"click",_qid, false); _qj(_qld,"click",_qId, false); var _qoe=_qO(_qod+"_select"); var _qi9=_qO(_qod+"_value1"); var _qI9=_qO(_qod+"_value2"); var _qOe=_qX(_qI9); switch (_qoe.options[_qoe.selectedIndex].value){case "none":_qp(_qi9,0); _qp(_qOe,0); break; case "between":case "not_between":_qp(_qi9,1); _qp(_qOe,1); break; default:_qp(_qi9,1); _qp(_qOe,0); break; }_qj(_qoe,"change",_qle, false); _qj(_qO(_qod+"_include"),"change",_qie, false); _qj(_qO(_qod+"_exclude"),"change",_qie, false); var _qIe=_qt("input","kptCheck",_ql3); for (var i=0; i<_qIe.length; i++){_qj(_qIe[i],"change",_qof, false); }_qj(_qi9,"focus",_qOf, false); _qj(_qI9,"focus",_qOf, false); _qj(_qO(_qod+"_selectall"),"change",_qIf, false); var _qog= true; for (i=1; i<_qIe.length; i++){if (!_qIe[i].checked)_qog= false; }_qO(_qod+"_selectall").checked=_qog; if (_qO(_qod+"_hidden").value=="ie"){addClass(_qO(_qod+"_filterwithoptions"),"kptHighlight"); }else {addClass(_qO(_qod+"_filterwithvalues"),"kptHighlight"); }}else {
 	if (_qoc[this._qo]["AllowReorder"]){var _qOg=new _qi5(this._qo+"_filterzone"); if (_qOg)_qOg._qO3(); var _qOg=new _qi5(this._qo+"_datazone"); if (_qOg)_qOg._qO3(); var _qOg=new _qi5(this._qo+"_columnzone"); if (_qOg)_qOg._qO3(); var _qOg=new _qi5(this._qo+"_rowzone"); if (_qOg)_qOg._qO3(); var _qlg=_qt("span","kptFieldItem",_ql3); for (i=0; i<_qlg.length; i++){if (_qoc[_qlg[i].id]["AllowReorder"]){ (new _qO2(_qlg[i].id))._qO3(); } (new _qi5(_qlg[i].id))._qO3(); }}var _qig=_qt("span","kptFilterButton",_ql3); for (i=0; i<_qig.length; i++){_qj(_qig[i],"click",_qIg, false); _qj(_qig[i],"mousedown",_qC, false); }var _qoh=_qt("span","kptSortButton",_ql3); for (i=0; i<_qoh.length; i++){_qj(_qoh[i],"mousedown",_qC, false); }if (_qOh[this._qo]){ this.redraw(); }else {_qj(window,"load",eval("__=function(){pivot_redraw(\""+this._qo+"\");}"), false); }}if (_qOh[this._qo]){ this._qI7("OnLoad", {} ,this ); }else { this._qI7("OnInit", {} ,this ); this._qI7("OnLoad", {} ,this ); }if (_qOh[this._qo]){_qlh=_qOh[this._qo]["PostLoadEvent"]; for (_qi0 in _qlh){if (typeof _qlh[_qi0]!="function"){try { this._qI7(_qi0,_qlh[_qi0]); }catch (_qih){}}}}_qOh[this._qo]= { "PostLoadEvent":{}} ; } ,go_page:function (_qIh){ this._qo8(this._qo+"_pg","GoPage", { "PageIndex":_qIh } ); } ,change_page_size:function (_qoi){ this._qo8(this._qo+"_pg","ChangePageSize", { "PageSize":_qoi } ); } ,_qO5:function (){var _ql3=_qO(this._qo); return (_qn(_ql3)).replace("KPT",""); } ,
 	_qo8:function (_qo,_qOi,_qli){
 		var _qii=_qO(this._qo+"_cmd"); 
 		var _qIi=new Object(); 
 		if (_qii.value!=""){
 			_qIi=eval("__="+_qii.value); 
 			console.log("aqui"+_qii.value);
 		}
 		_qIi[_qo]= { "Command":_qOi,"Args":_qli } ; 
 		_qii.value=_qo0(_qIi); 
 		console.log("cmd"+_qii.value); 
 	} ,
 	_qOc:function (){var _qoj=_qO(this._qo+"_viewstate"); return eval("__="+_qoj.value); } ,
 	_qOj:function (_qoc){var _qoj=_qO(this._qo+"_viewstate"); _qoj.value=_qo0(_qoc); } ,
 	_qI4:function (_qlj){} ,
 	_qij:function (_qi0){if (_qi0.toLowerCase()=="column")return _qOb; if (_qi0.toLowerCase()=="row")return _qlb; if (_qi0.toLowerCase()=="filter")return _qib; if (_qi0.toLowerCase()=="data")return _qIb; } ,_ql7:function (_qlj,_qIj){if (_qlj==_qIj)return; var _ql3=_qO(this._qo); var _qoc=this._qOc(); var _qok=[]; var _qOk=null; var _qlk=null; var _qik=null; var _qIk=null; for (i=0; i<_qoc[this._qo]["PVField_Ids"][_qib].length; i++){_qok[_qoc[this._qo]["PVField_Ids"][_qib][i]]="Filter"; }for (i=0; i<_qoc[this._qo]["PVField_Ids"][_qIb].length; i++){_qok[_qoc[this._qo]["PVField_Ids"][_qIb][i]]="Data"; }for (i=0; i<_qoc[this._qo]["PVField_Ids"][_qlb].length; i++){_qok[_qoc[this._qo]["PVField_Ids"][_qlb][i]]="Row"; }for (i=0; i<_qoc[this._qo]["PVField_Ids"][_qOb].length; i++){_qok[_qoc[this._qo]["PVField_Ids"][_qOb][i]]="Column"; }_qOk=_qok[_qlj]; for (i=0; i<_qoc[this._qo]["PVField_Ids"][this._qij(_qOk)].length; i++)if (_qlj==_qoc[this._qo]["PVField_Ids"][this._qij(_qOk)][i]){_qik=i; }
 	if (_qI("_filterzone",_qIj)>0){_qlk="filter"; _qIk=_qoc[this._qo]["PVField_Ids"][_qib].length; }else if (_qI("_datazone",_qIj)>0){_qlk="data"; _qIk=_qoc[this._qo]["PVField_Ids"][_qIb].length; }else if (_qI("_columnzone",_qIj)>0){_qlk="column"; _qIk=_qoc[this._qo]["PVField_Ids"][_qOb].length; }else if (_qI("_rowzone",_qIj)>0){_qlk="row"; _qIk=_qoc[this._qo]["PVField_Ids"][_qlb].length; }else {var _qlk=_qok[_qIj]; for (i=0; i<_qoc[this._qo]["PVField_Ids"][this._qij(_qlk)].length; i++)if (_qIj==_qoc[this._qo]["PVField_Ids"][this._qij(_qlk)][i]){_qIk=i; }} this.move_field(_qOk,_qik,_qlk,_qIk); this.commit(); } ,_qi6:function (_qIj){if (_qz())return; var _ql3=_qO(this._qo); var _qoc=this._qOc(); var _qol=null; if (_qI("zone",_qIj)>0){var _qi0=_qIj.replace("zone","").replace(this._qo+"_",""); _qi0=_qi0.substring(0,1).toUpperCase()+_qi0.substring(1); if (_qoc[this._qo]["PVField_Ids"][this._qij(_qi0)].length>1){_qol=_qoc[this._qo]["PVField_Ids"][this._qij(_qi0)][_qoc[this._qo]["PVField_Ids"][this._qij(_qi0)].length-1]; }}else {}var _qll=_qO(this._qo+"_topindicator"); var _qil=_qO(this._qo+"_bottomindicator"); if (_qll==null || _qil==null){_qll=_qa("div",_ql3); _qll.id=this._qo+"_topindicator"; _qll.style.position="absolute"; _qM(_qll,"kptTopIndicator"); _qil=_qa("div",_ql3); _qil.id=this._qo+"_bottomindicator"; _qil.style.position="absolute"; _qM(_qil,"kptBottomIndicator"); }_qp(_qll,1); _qp(_qil,1); _qIl=_qll.offsetHeight; _qom=_qll.offsetWidth; var _qOm=_qO(((_qol)?_qol:_qIj)); var _qR=_qOm; var _qIm=0,_qon=0; var _qOn=_qOm.offsetWidth; while (_qR.id!=this._qo){_qIm+=_qR.offsetTop; _qon+=_qR.offsetLeft; _qR=_qR.offsetParent; }var _qIn=_qOm.offsetHeight; if (_qol){_qll.style.top=(_qIm-_qIl)+"px"; _qll.style.left=(_qon+_qOn+3-_qom/2)+"px"; _qil.style.top=(_qIm+_qIn)+"px"; _qil.style.left=(_qon+_qOn+3-_qom/2)+"px"; }else {_qll.style.top=(_qIm-_qIl)+"px"; _qll.style.left=(_qon-_qom/2-3)+"px"; _qil.style.top=(_qIm+_qIn)+"px"; _qil.style.left=(_qon-_qom/2-3)+"px"; }} ,_qo7:function (_qIj){var _qll=_qO(this._qo+"_topindicator"); var _qil=_qO(this._qo+"_bottomindicator"); if (_qll){_qp(_qll,0); _qp(_qil,0); }} ,
 	get_field:function (_qoo){var _ql3=_qO(this._qo); var _qoc=this._qOc(); _qOo=_qt("span","kptFieldItem",_ql3); for (i=0; i<_qOo.length; i++){if (_qoc[_qOo[i].id]["FieldName"]==_qoo){return new PivotField(_qOo[i].id); }}return false; } ,move_field:function (_qOk,_qik,_qlk,_qIk){if (!this._qI7("OnBeforeFieldMove", { "From":_qOk,"FromPosition":_qik,"To":_qlk,"ToPosition":_qIk } ,this ))return; this._qo8(this._qo,"MoveField", { "From":_qOk,"FromPosition":_qik,"To":_qlk,"ToPosition":_qIk } ); this._qO8("OnFieldMove", { "From":_qOk,"FromPosition":_qik,"To":_qlk,"ToPosition":_qIk } ,this ); this.commit(); } ,
 	commit:function (){
 		if (!this._qI7("OnBeforeCommit", {} ,this )) return; 
 		if (_qz()) return; 
 		if (this._qIa){ 
 			console.log("this._qob="+this._qob); 
 			var _qIo=eval(this._qo+"_updatepanel"); 
 			_qIo.update((this._qob!="")?this._qob:null); 
 		} else { 
 			console.log("submit"); 
 			var _qop=_qO(this._qo); 
 			while (_qop.nodeName!="FORM"){
 				if (_qop.nodeName=="BODY") return; 
 				_qop=_qX(_qop); 
 			}
 			_qop.submit(); 
 		}
 		var _qOp=_qq("div","kptStatus",_qO(this._qo)); 
 		if (_qOp)addClass(_qOp,"kptLoading"); 
 		this._qI7("OnCommit", {} ,this ); 
 	} ,
 	attach_data:function (_qi0,_qO9){if (this._qIa){var _qIo=eval(this._qo+"_updatepanel"); _qIo.attachData(_qi0,_qO9); }} ,
 	_qlp:function (){ this._qo8(this._qo,"Refresh", {} ); } ,
 	redraw:function (){var _ql3=_qO(this._qo); var _qip=_qq("div","kptContentDiv",_ql3); var _qIp=_qx(_qip); var _qoq=_qq("div","kptColumnHeaderDiv",_ql3); var _qOq=_qx(_qoq); var _qlq=_qq("div","kptRowHeaderDiv",_ql3); var _qiq=_qx(_qlq); var _qF=_qt("div","kptColumnHeaderDiv",_ql3); if (_qF.length>0){var _qoq=_qF[0]; _qW(_qx(_qoq),_qX(_qoq).offsetHeight); }var _qoc=this._qOc(); if (_qoc[this._qo]["HorizontalScrolling"]){var _qIq=_qX(_qip); var _qor=_qq("td","kptRowHeaderZone",_ql3); var _qOr=_qq("div","kptHorizontalScrollDiv",_ql3); var _qlr=_qx(_qOr); var _qir=_qt("col","",_qoq); var _qIr=_qt("col","",_qip); var _qos=_qt("td","",_qoq.firstChild.lastChild.lastChild); var _qOs=_qt("td","",_qip.firstChild.lastChild.lastChild); for (i=0; i<_qIr.length; i++){var _qls=(_qOs[i].offsetWidth>_qos[i].offsetWidth)?_qOs[i].offsetWidth:_qos[i].offsetWidth; _qV(_qIr[i],_qls); _qV(_qir[i],_qls); }var _qis=(_qIp.offsetWidth>_qIq.offsetWidth)?_qIp.offsetWidth:_qIq.offsetWidth; _qIp.style.tableLayout="fixed"; _qOq.style.tableLayout="fixed"; _qV(_qIp,_qis); _qV(_qOq,_qis); var _qIs=_qv(_ql3); var _qot=_qIs-_qor.offsetWidth-((_qoc[this._qo]["VerticalScrolling"])?18: 0); _qV(_qip,_qot); _qV(_qoq,_qot); _qV(_qOr,_qOr.offsetWidth); _qV(_qlr,(_qIp.offsetWidth/_qot)*_qOr.offsetWidth); _qj(_qOr,"scroll",_qOt, false); _qOr.scrollLeft=_qoc[this._qo]["ScrollLeft"]; }_qIp.style.tableLayout="fixed"; _qOq.style.tableLayout="fixed"; var _qF=_qt("div","kptRowHeaderDiv",_ql3); if (_qF.length>0){var _qlq=_qF[0]; var _qlt=_qt("tr","",_qlq); var _qit=_qt("tr","",_qip); for (var i=0; i<_qlt.length; i++){_qIt=_qlt[i].lastChild.offsetHeight; if (_qIt<_qit[i].offsetHeight){_qIt=_qit[i].offsetHeight; }_qW(_qlt[i],_qIt); _qW(_qit[i],_qIt); }}if (_qoc[this._qo]["VerticalScrolling"]){var _qou=_qT(_ql3); var _qla=_qx(_ql3); var _qOu=_qq("div","kptVerticalScrollDiv",_ql3); var _qlu=_qx(_qOu); var _qiu=_qX(_qOu); var _qIt=_qip.offsetHeight-(_qla.offsetHeight-_ql3.offsetHeight); _qW(_qip,_qIt); _qW(_qlq,_qIt); _qW(_qOu,_qiu.offsetHeight); _qW(_qlu,(_qIp.offsetHeight/_qIt)*_qiu.offsetHeight); _qj(_qOu,"scroll",_qIu, false); _qj(_qip,"mousewheel",_qov, false); _qj(_qip,"DOMMouseScroll",_qov, false); _qj(_qlq,"mousewheel",_qov, false); _qj(_qlq,"DOMMouseScroll",_qov, false); _qOu.scrollTop=_qoc[this._qo]["ScrollTop"]; }} ,_qOv:function (_qOr){var _ql3=_qO(this._qo); var _qoc=this._qOc(); var _qip=_qq("div","kptContentDiv",_ql3); var _qIp=_qx(_qip); var _qoq=_qq("div","kptColumnHeaderDiv",_ql3); var _qOq=_qx(_qoq); var _qlv=(_qOr.scrollLeft/_qOr.scrollWidth)*_qIp.offsetWidth; _qIp.style.left=(-_qlv)+"px"; _qIp.style.left=(-_qlv)+"px"; _qOq.style.left=(-_qlv)+"px"; _qOq.style.left=(-_qlv)+"px"; _qoc[this._qo]["ScrollLeft"]=parseInt(_qOr.scrollLeft); this._qOj(_qoc); } ,_qiv:function (_qOu){var _ql3=_qO(this._qo); var _qoc=this._qOc(); var _qip=_qq("div","kptContentDiv",_ql3); var _qIp=_qx(_qip); var _qlq=_qq("div","kptRowHeaderDiv",_ql3); var _qiq=_qx(_qlq); var _qIv=(_qOu.scrollTop/_qOu.scrollHeight)*_qIp.offsetHeight; _qIp.style.top=(-_qIv)+"px"; _qIp.style.top=(-_qIv)+"px"; _qiq.style.top=(-_qIv)+"px"; _qiq.style.top=(-_qIv)+"px"; _qoc[this._qo]["ScrollTop"]=parseInt(_qOu.scrollTop); this._qOj(_qoc); } ,_qow:function (_qc){var _qOw=0; if (_qc.wheelDelta){_qOw=_qc.wheelDelta/120; }else if (_qc.detail){_qOw=_qc.detail/-3; }var _ql3=_qO(this._qo); var _qOu=_qq("div","kptVerticalScrollDiv",_ql3); var _qlw=_qOu.scrollTop; _qOu.scrollTop=_qOu.scrollTop-_qOw*38; } ,_qiw:function (_ql3,_qc){var _qod=_qX(_ql3).id; (new PivotField(_qod)).open_filter_panel(); this.commit(); } ,_qIw:function (_qc){var _ql3=_qO(this._qo); var _qox=_qx(_ql3).id; var _qOx=_qO(_qox+"_hidden"); if (_qOx.value=="vl"){var _qoe=_qO(_qox+"_select"); var _ql9=_qoe.options[_qoe.selectedIndex].value; var _qi9=encodeURIComponent(_qO(_qox+"_value1").value); var _qI9=encodeURIComponent(_qO(_qox+"_value2").value); if (!this._qI7("OnBeforeFieldFilter", { "FilterBy": "Values","Expression":_ql9,"value1":_qi9,"value2":_qI9 } ,this ))return; this._qo8(_qox,"CloseFilterPanel", { "Command": "ok","FilterBy": "Values","Expression":_ql9,"value1":_qi9,"value2":_qI9 } ); this._qO8("OnFieldFilter", { "FilterBy": "Values","Expression":_ql9,"value1":_qi9,"value2":_qI9 } ,this ); }else {var _qoa= true; var _qOa=[]; var _qlg=_qt("input","kptCheck",_ql3); var _qlx=_qlg[0]; var _qix=_qO(_qox+"_include").checked; _qlg.splice(0,1); if (_qlx.checked){if (_qix){_qoa= true; _qIx=[]; }else {_qoa= false; _qOa=[]; }}else {var _qoy=0; var _qOy=[]; var _qly=[]; var _qiy; for (var i=0; i<_qlg.length; i++){if (_qlg[i].checked){_qOy.push(_qlg[i]); }else {_qly.push(_qlg[i]); }}if (_qix){if (_qOy.length>_qly.length){_qoa= true; _qiy=_qly; }else {_qoa= false; _qiy=_qOy; }}else {if (_qOy.length>_qly.length){_qoa= false; _qiy=_qly; }else {_qoa= true; _qiy=_qOy; }}for (var i=0; i<_qiy.length; i++){var _qIy=_qu(_qiy[i]); _qOa.push(encodeURIComponent(_qIy.innerHTML)); }}if (!this._qI7("OnBeforeFieldFilter", { "FilterBy": "Options","IncludeAll":_qoa,"ExceptionList":_qOa } ,this ))return; this._qo8(_qox,"CloseFilterPanel", { "Command": "ok","FilterBy": "Options","IncludeAll":_qoa,"ExceptionList":_qOa } ); this._qO8("OnFieldFilter", { "FilterBy": "Options","IncludeAll":_qoa,"ExceptionList":_qOa } ,this ); } this.commit(); } ,_qoz:function (_qc){var _ql3=_qO(this._qo); this._qo8(_qx(_ql3).id,"CloseFilterPanel", { "Command": "cancel" } ); this.commit(); } ,_qOz:function (_qlz){var _qod=_qX(_qlz).id; (new PivotField(_qod)).sort((_qI("SortAsc",_qn(_qlz))>0)?"desc": "asc"); this.commit(); } ,_qiz:function (_qlz){var _qod=_qX(_qlz).id; (new PivotField(_qod))._ql8((_qI("SortAsc",_qn(_qlz))>0)?"desc": "asc"); this.commit(); } ,_qIz:function (_qlz){var _qod=_qX(_qlz).id; (new PivotField(_qod))._qi8((_qI("SortAsc",_qn(_qlz))>0)?"desc": "asc"); this.commit(); } ,_qo10:function (_qO10){var _qod=_qX(_qO10).id; (new PivotField(_qod))._qI8(_qO10.value,_qO10.checked?"checked": "unchecked"); this.commit(); } ,_qI7:function (_qi0,_ql10,_qi10){var _qoc=this._qOc(); if (_qY(_qoc[this._qo]["ClientEvents"]) && _qY(_qoc[this._qo]["ClientEvents"][_qi0])){var _qI10=eval(_qoc[this._qo]["ClientEvents"][_qi0]); return _qI10((_qi10!=null)?_qi10: this,_ql10); }else {return true; }} ,_qO8:function (_qi0,_ql10){_qOh[this._qo]["PostLoadEvent"][_qi0]=_ql10; }};
 function _qIg(_qc){ (_qi4(this ))._qiw(this,_qc); }
 function _qid(_qc){ (_qi4(this ))._qIw(_qc); }
 function _qId(_qc){ (_qi4(this ))._qoz(_qc); }
 function _qi4(_ql3){var _qo11=_qX(_ql3); while (_qo11.nodeName!="DIV" || _qI("KPT",_qn(_qo11))<0){_qo11=_qX(_qo11); if (_qo11.nodeName=="BODY")return null; }return eval(_qo11.id); }
 function get_pivot(_ql3){return _qi4(_ql3); }
 function pivot_gopage(_ql3,_qO11){var _ql4=_qi4(_ql3); _ql4.go_page(_qO11); _ql4.commit(); }
 function pivot_group_toggle(_ql3){
 	var _ql11=_qX(_ql3,1); 
 	var _qi11=_qt("span","kptExpand",_ql11); 
 	if (_qi11.length>0){ 
 		(new PivotGroup(_ql11.id)).collapse(); 
 	} else { 
 		console.log("PivotGroup id="+_ql11.id); 
 		(new PivotGroup(_ql11.id)).expand(); 
 	}
 	_qi4(_ql3).commit(); 
 }
 function _qle(_qc){var _qod=this.id.replace("_select",""); var _qi9=_qO(_qod+"_value1"); var _qOe=_qX(_qO(_qod+"_value2")); switch (this.options[this.selectedIndex].value){case "none":_qp(_qi9,0); _qp(_qOe,0); break; case "between":case "not_between":_qp(_qi9,1); _qp(_qOe,1); _qi9.focus(); break; default:_qp(_qi9,1); _qp(_qOe,0); _qi9.focus(); break; }_qO(_qod+"_hidden").value="vl"; _qJ(_qO(_qod+"_filterwithoptions"),"kptHighlight"); addClass(_qO(_qod+"_filterwithvalues"),"kptHighlight"); }
 function _qOf(){var _qod=this.id.replace("_value1","").replace("_value2",""); _qO(_qod+"_hidden").value="vl"; _qJ(_qO(_qod+"_filterwithoptions"),"kptHighlight"); addClass(_qO(_qod+"_filterwithvalues"),"kptHighlight"); }
 function _qie(_qc){var _qod=this.id.replace("_include","").replace("_exclude",""); _qO(_qod+"_hidden").value="ie"; addClass(_qO(_qod+"_filterwithoptions"),"kptHighlight"); _qJ(_qO(_qod+"_filterwithvalues"),"kptHighlight"); }
 function _qof(_qc){var _ql4=_qi4(this ); var _qod=_qx(_qO(_ql4._qo)).id; _qO(_qod+"_hidden").value="ie"; addClass(_qO(_qod+"_filterwithoptions"),"kptHighlight"); _qJ(_qO(_qod+"_filterwithvalues"),"kptHighlight"); if (_qI("_selectall",this.id)<0){var _ql3=_qO(_qod); var _qlg=_qt("input","kptCheck",_ql3); var _qog= true; for (i=1; i<_qlg.length; i++){if (!_qlg[i].checked)_qog= false; }_qO(_qod+"_selectall").checked=_qog; }}
 function _qIf(_qc){var _qo=this.id.replace("_selectall",""); var _ql3=_qO(_qo); var _qlg=_qt("input","kptCheck",_ql3); for (i=0; i<_qlg.length; i++){if (_qlg[i]!=this ){_qlg[i].checked=this.checked; }}}
 function _qOt(_qc){ (_qi4(this ))._qOv(this ); }
 function _qIu(_qc){ (_qi4(this ))._qiv(this ); }
 function _qov(_qc){ (_qi4(this ))._qow(_qc); return _qB(_qc); }
 function pivot_redraw(_qo){ (eval(_qo)).redraw(); }
 function pivot_sort_toggle(_ql3){ (_qi4(_ql3))._qOz(_ql3); }
 function pivot_group_sort_toggle(_ql3){ (_qi4(_ql3))._qiz(_ql3); }
 function _qI11(_ql3){ (_qi4(_ql3))._qIz(_ql3); }
 function _qo12(_ql3){ (_qi4(_ql3))._qo10(_ql3); }
 function pivot_pagesize_select_onchange(_ql3){var _qO12=_ql3.options[_ql3.selectedIndex].value; var _ql4=_qi4(_ql3); _ql4.change_page_size(_qO12); _ql4.commit(); }var _qOh=new Array(); if (typeof(__KPTInits)!="undefined" && _qY(__KPTInits)){for (var i=0; i<__KPTInits.length; i++){__KPTInits[i](); }}
 var _qiO1=0;