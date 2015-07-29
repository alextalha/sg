<?php 
if (!class_exists("KoolScripting",FALSE)) { 	
	class koolscripting { 		
		static function start() { ob_start(); return ""; } 		
		static function end() { $content=ob_get_clean(); $_aO0=""; $_al1=new domdocument(); $_al1->loadxml($content); $_aO1=$_al1->documentElement; $_al2=$_aO1->getattribute("id"); $_aO2=$_aO1->nodeName; $_al2=($_al2 == "") ? "dump": $_al2; if (class_exists($_aO2,FALSE)) { eval ("$".$_al2." = new ".$_aO2."('".$_al2."');"); $$_al2->loadxml($_aO1); $_aO0=$$_al2->render(); } else { $_aO0.=$content; } return $_aO0; } 	
	} 
}
if (!class_exists("KoolAjax",FALSE)) { 			
	function _al3($_aO3,$_al4,$_aO4) { return str_replace($_aO3,$_al4,$_aO4); } 			
	function _al5() { $_aO5=_al3("\\","/",strtolower($_SERVER["SCRIPT_NAME"])); $_aO5=_al3(strrchr($_aO5,"/"),"",$_aO5); $_al6=_al3("\\","/",realpath(".")); $_aO6=_al3($_aO5,"",strtolower($_al6)); return $_aO6; } 			
	function _al7($_aO7) { if ( isset ($_POST[$_aO7])) return $_POST[$_aO7]; if ( isset ($_GET[$_aO7])) return $_GET[$_aO7]; return NULL; } 			
	function _al8($_aO8,$_al9) { $_aO9=""; foreach ($_aO8->childNodes as $_ala) { $_aO9.=$_al9->savexml($_ala); } return trim($_aO9); } 			
	function _aOa($_alb) { return _al3("+"," ",urlencode($_alb)); } 			
	function _aOb($_alc) { $_aOc="null"; $_ald=gettype($_alc); switch ($_ald) { case "integer": case "double": $_aOc=$_alc; break; case "boolean": $_aOc=($_alc) ? "true": "false"; break; case "string": $_aOc="'"._aOa($_alc)."'"; break; case "array": case "object": $_aOc="{"; if ($_ald == "object") $_alc=get_object_vars($_alc); foreach ($_alc as $_aOd => $_ale) $_aOc.=((is_numeric($_aOd)) ? $_aOd: "'"._aOa($_aOd)."'").":"._aOb($_ale).","; if (count($_alc)) $_aOc=substr($_aOc,0,-1); $_aOc.="}"; break; } return $_aOc; } 
	class _aOe { var $_alf; var $_aOf; 				
		function __construct($_alf,$_aOf) { $this->_alf =$_alf; $this->_aOf =$_aOf; } 
	} 
	class _alg { var $_aOg="white"; var $_alh=062; var $_aOh; } 				
	class updatepanel { var $_al2; var $content; var $rendermode="block"; var $cssclass; var $_aOi; var $_alj=NULL; static $koolajax; 				
			function __construct($_al2) { $this->_al2 =$_al2; $this->_aOi =array(); } 				
			function loadxmlfile($_aOj) { } 				
			function loadxml($_alk) { if (gettype($_alk) == "string") { $_al1=new domdocument(); $_al1->loadxml($_alk); $_alk=$_al1->documentElement; } $_al2=$_alk->getattribute("id"); if ($_al2 != "") $this->_al2 =$_al2; $this->cssclass =$_alk->getattribute("cssclass"); if ($this->cssclass == "") { $this->cssclass =$_alk->getattribute("class"); } $_aOk=$_alk->getattribute("rendermode"); $this->rendermode =($_aOk != "") ? $_aOk: "block"; foreach ($_alk->childNodes as $_all) { switch (strtolower($_all->nodeName)) { case "content": $_alm=_al8($_all,$_alk->parentNode); $_alm=trim($_alm); if (substr($_alm,0,011) == "<![CDATA[") { $_alm=substr($_alm,011); } if (substr($_alm,-3) == "]]>") { $_alm=substr($_alm,0,-3); } $this->content =$_alm; break; case "triggers": foreach ($_all->childNodes as $_aOm) { if (strtolower($_aOm->nodeName) == "trigger") { $this->addtrigger($_aOm->getattribute("elementid"),$_aOm->getattribute("event")); } } break; case "loading": $this->_alj =new _alg(); $this->_alj->_aOh =$_all->getattribute("image"); $_aOg=$_all->getattribute("backColor"); if ($_aOg != "") $this->_alj->_aOg =$_aOg; $_alh=$_all->getattribute("opacity"); if ($_alh != "") $this->_alj->_alh =intval($_alh); break; } } } 				
			function setloading($_aOh,$_aOg="white",$_alh=062) { $this->_alj =new _alg(); $this->_alj->_aOh =$_aOh; $this->_alj->_aOg =$_aOg; $this->_alj->_alh =$_alh; } 				
			function addtrigger($_alf,$_aOf) { array_push($this->_aOi ,new _aOe($_alf,$_aOf)); } 				
			function render() { 
				$koolajax=updatepanel::$koolajax; 
				if ($koolajax->isCallback && _al7("__updatepanel") == $this->_al2) { 
					$_aln=0; while (ob_get_level()>0 && $_aln<012) { 
						ob_end_clean(); $_aln ++; 
					} echo "<updatepanel>".$this->content."</updatepanel>".(($koolajax->_aOn == "") ? "": "[!@s>".$koolajax->_aOn); exit (); 
				} else { 
					$_alo="<div id='{id}' class='_kup {class}' style='position:relative;'><div>{content}</div>{loading}</div>"; 
					$_aOo="<span id='{id}' {class}>{content}</span>"; 
					$_alp="<div id='{id}_loading' style='position:absolute;display:none;background:url({image}) no-repeat 50% 50%;background-color:{backColor};filter:alpha(opacity={opacity});-moz-opacity:{opacity/100};opacity:{opacity/100};'><img src='{image}' style='display:none' alt='' /></div>"; 
					$_aOp="<script type='text/javascript'>var {id} = new KoolUpdatePanel('{id}',{loading});{triggers}</script>"; 
					$_alq="{id}.addTrigger();"; $_aOq=($this->rendermode == "inline") ? $_aOo: $_alo; $_aOq=_al3("{id}",$this->_al2 ,$_aOq); $_aOq=_al3("{content}",$this->content ,$_aOq); $_aOq=_al3("{class}",($this->cssclass != "") ? $this->cssclass : "",$_aOq); $_alr=$_aOp; $_alr=_al3("{id}",$this->_al2 ,$_alr); if ($this->_alj != NULL) { $_alj=_al3("{id}",$this->_al2 ,$_alp); $_alj=_al3("{image}",$this->_alj->_aOh ,$_alj); $_alj=_al3("{opacity}",$this->_alj->_alh ,$_alj); $_alj=_al3("{opacity/100}",$this->_alj->_alh /0144,$_alj); $_alj=_al3("{backColor}",$this->_alj->_aOg ,$_alj); $_aOq=_al3("{loading}",$_alj,$_aOq); $_alr=_al3("{loading}","1",$_alr); } else { $_aOq=_al3("{loading}","",$_aOq); $_alr=_al3("{loading}","0",$_alr); } $_aOi=""; for ($_als=0; $_als<sizeof($this->_aOi); $_als ++) { $_aOi.=$this->_al2.".addTrigger('".$this->_aOi[$_als]->_alf."','".$this->_aOi[$_als]->_aOf."');"; } $_alr=_al3("{triggers}",$_aOi,$_alr); $_aOq.=$_alr; return $_aOq; 
				} 
			} 
	} 					
	class koolajax {  var $_aOs; var $_alt; var $isCallback=FALSE; var $_aOt; var $_aOn=""; var $scriptFolder=""; var $CharSet; 					
		function __construct() { $this->_aOs =array(); $this->_alt =array(); if (_al7("__koolajax") != NULL) { $this->isCallback =TRUE; } $this->_aOt =array(); } 					
		function enablefunction($_alu) { array_push($this->_aOs ,$_alu); } 					
		function registerclientscript($_aOu) { $this->_aOn .=$_aOu.";"; } 					
		function render() { 
			if ($this->isCallback) { if (_al7("__func") != NULL) { $_aln=0; while (ob_get_level()>0 && $_aln<012) { ob_end_clean(); $_aln ++; } $_alv=_al7("__func"); $_aOv=_al7("__args"); $_alc="null"; $_alw="null"; try { $_alc=_aOb(call_user_func_array($_alv,($_aOv !== NULL) ? $_aOv: array())); } catch (_aOw $_alx) { $_alw="'".$_alx._aOx()."'"; } $_aly="<callback>{'r':{result},'e':{error}}</callback>{js}"; $_aOy="[!@s>{js}"; $_aly=_al3("{result}",$_alc,$_aly); $_aly=_al3("{error}",$_alw,$_aly); $_aly=_al3("{js}",($this->_aOn == "") ? "": _al3("{js}",$this->_aOn ,$_aOy),$_aly); echo $_aly; exit (); } } else { $_aOq=""; $_aOq="\n"; 
			$_aOq.=""; if ($this->CharSet !== NULL) { $_aOq.="<script type='text/javascript'>koolajax.charset='".$this->CharSet."';</script>"; } if (sizeof($this->_aOs)>0 || sizeof($this->_alt)>0) { $_aOq.="\n<script type='text/javascript'>\n"; for ($_als=0; $_als<sizeof($this->_aOs); $_als ++) { $_aOq.="function ".$this->_aOs[$_als]."()\n"; $_aOq.="{\n"; $_aOq.="return koolajax.funcRequest('".$this->_aOs[$_als]."',arguments);\n"; $_aOq.="}\n"; } $_aOq.="</script>\n"; } if ($this->_aOn != "") { $_aOq.="\n<script type='text/javascript'>\n"; $_aOq.=$this->_aOn.";"; $_aOq.="\n</script>\n"; } return $_aOq; } 
		} 
		function _alz() { if ($this->scriptFolder == "") { $_aO6=_al5(); $_aOz=substr(_al3("\\","/",__FILE__),strlen($_aO6)); return $_aOz; } else { $_aOz=_al3("\\","/",__FILE__); $_aOz=$this->scriptFolder.substr($_aOz,strrpos($_aOz,"/")); return $_aOz; } } 
	} 

	if (! isset ($koolajax)) { 
		$koolajax=new koolajax(); if ($koolajax->isCallback) { ob_start(); } 
		updatepanel::$koolajax=$koolajax; 
	} 
} ?>