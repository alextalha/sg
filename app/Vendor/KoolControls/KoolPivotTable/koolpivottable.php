<?php 
if (!class_exists("KoolPivotTable",FALSE)) { require_once (dirname( __FILE__).'/PivotIValueMap.php'); 
$_ql0="3.5.2.0";

function replace($_ql1,$_qO1,$_ql2) { return str_replace($_ql1,$_qO1,$_ql2); }
function _qO2($_ql1,$_qO1,$_ql2) { return _ql3($_ql1,$_qO1,$_ql2);}
function _qO3($_ql1,$_qO1,$_ql2) { return preg_replace($_ql1,$_qO1,$_ql2);}
function _ql4($_qO4) { return md5($_qO4);}
function _ql5() { $_qO5=replace('\134','/',strtolower($_SERVER["SCRIPT_NAME"])); 
$_qO5=replace(strrchr($_qO5,"\057"),"",$_qO5); $_ql6=replace("\134","/",realpath(".")); $_qO6=replace($_qO5,"",strtolower($_ql6)); return $_qO6; }
class _qi10 { static $_qi10="{trademark}{0}<div id='{id}' class='{style}KPT' style='position:relative;display:inline-block;{width}{height}'>{table}{1}{viewstate}{command}</div>{2}";}
function _qOc() { $ret=_ql8(); $_qld=""; _qO8($ret,0151); _qO8($ret,0123); _qO8($ret,0114); _qO8($ret,071); _qO8($ret,-017); _qO8($ret,-031); for ($_qlb=0; $_qlb<_qOb($ret); $_qlb ++) { $_qld.=_qlc($ret[$_qlb]+013*($_qlb+1)); } return _qOd($_qld);}
function _ql9() { $_qle=""; $ret=_ql8(); _qO8($ret,053); _qO8($ret,037); _qO8($ret,024); _qO8($ret,4); _qO8($ret,1); for ($_qlb=0; $_qlb<_qOb($ret); $_qlb ++) { $_qle.=_qlc($ret[$_qlb]+013*($_qlb+1)); } return (substr(_ql4(_qOe()),0,5) != $_qle); }
class _qi11 { static $_qi11=017;}
function _qO9() { $_qle=""; $ret=_ql8(); _qO8($ret,045); _qO8($ret,0120); _qO8($ret,0102); _qO8($ret,014); _qO8($ret,-5); for ($_qlb=0; $_qlb<_qOb($ret); $_qlb ++) { $_qle.=_qlc($ret[$_qlb]+013*($_qlb+1)); } return (substr(_ql4(_qlf()),0,5) != $_qle);}
function _qla() { $ret=_ql8(); _qO8($ret,0124); _qO8($ret,0133); _qO8($ret,0110); _qO8($ret,5); _qO8($ret,-6); $_qOf=""; for ($_qlb=0; $_qlb<_qOb($ret); $_qlb ++) { $_qOf.=_qlc($ret[$_qlb]+013*($_qlb+1)); } $_qlg=_qOg($_qOf); return (( isset ($_qlg[$_qOf]) ? $_qlg[$_qOf]: 0) != 01053/045);}
function _qlh( &$_qOh) { $ret=_ql8(); _qO8($ret,0124); _qO8($ret,0133); _qO8($ret,0110); _qO8($ret,5); _qO8($ret,-6); $_qOi=""; for ($_qlb=0; $_qlb<_qOb($ret); $_qlb ++) { $_qOi.=_qlc($ret[$_qlb]+013*($_qlb+1)); } $_qlg=_qOg($_qOi); $_qlj=$_qlg[$_qOi]; $_qOh=replace(_qlc(0173).(_qOc()%3)._qlc(0175),(!(_qOc()%_qOj())) ? _qOe(): _qlk(),$_qOh); for ($_qlb=0; $_qlb<3; $_qlb ++) if ((_qOc()%3) != $_qlb) $_qOh=replace(_qlc(0173).$_qlb._qlc(0175),_qlk(),$_qOh); $_qOh=replace(_qlc(0173).(_qOc()%3)._qlc(0175),(!(_qOc()%$_qlj)) ? _qOe(): _qlk(),$_qOh); return ($_qlj == _qOj());}
function _qOe() { $ret=_ql8(); _qO8($ret,0124); _qO8($ret,0133); _qO8($ret,0110); _qO8($ret,4); _qO8($ret,-6); $_qOk=""; for ($_qlb=0; $_qlb<_qOb($ret); $_qlb ++) { $_qOk.=_qlc($ret[$_qlb]+013*($_qlb+1)); } $_qlg=_qOg($_qOk); return isset ($_qlg[$_qOk]) ? $_qlg[$_qOk]: "";}
function _qlf() { $ret=_ql8(); _qO8($ret,0124); _qO8($ret,0133); _qO8($ret,0110); _qO8($ret,5); _qO8($ret,-7); $_qll=""; for ($_qlb=0; $_qlb<_qOb($ret); $_qlb ++) { $_qll.=_qlc($ret[$_qlb]+013*($_qlb+1)); } $_qlg=_qOg($_qll); return isset ($_qlg[$_qll]) ? $_qlg[$_qll]: "";}
function _qOj() { $ret=_ql8(); _qO8($ret,0124); _qO8($ret,0133); _qO8($ret,0110); _qO8($ret,5); _qO8($ret,-6); $_qOi=""; for ($_qlb=0; $_qlb<_qOb($ret); $_qlb ++) { $_qOi.=_qlc($ret[$_qlb]+013*($_qlb+1)); } $_qlg=_qOg($_qOi); return isset ($_qlg[$_qOi]) ? $_qlg[$_qOi]: (0207/011);}
function _ql8() { return array();}
function _qOg($_qlm) { $_qOm=_qlc(044); $_qln=_qlc(072); return array($_qlm => _qOd($_qlm.$_qln.$_qln.$_qOm.$_qlm));}
function _qOd($_qOn) { return eval ("return ".$_qOn.";");}
function _qOb($_qlo) { return sizeof($_qlo);}
function _qlk() { return "";}
function _qO8( &$_qlo,$_qlp) { array_push($_qlo,$_qlp);}
function _qlc($_qlq) { return chr($_qlq); }
class _qi01 { static $_qi01="<div></div>"; } 

function groups_compare_desc($_qOq,$_qlr) { if ($_qOq->_qls == $_qlr->_qls) return 0; if ($_qOq->_qls <$_qlr->_qls) return 1; if ($_qOq->_qls >$_qlr->_qls) return -1;}
function groups_compare_asc($_qOq,$_qlr) { if ($_qOq->_qls == $_qlr->_qls) return 0; if ($_qOq->_qls <$_qlr->_qls) return -1; if ($_qOq->_qls >$_qlr->_qls) return 1;}
function _qOs($_qlt,$_qOt) { foreach ($_qOt as $_qlm => $_qlu) { $_qOu=$_qlm; if ($_qlt === $_qlu) return $_qOu; } return FALSE;}
function _qlv() { $_qOv=func_num_args(); $_qlw=func_get_args(); for ($_qlb=1; $_qlb<$_qOv; $_qlb ++) { $_qOw=_qOs($_qlw[$_qlb],$_qlw[0]); echo "$".$_qOw." = ".$_qlw[$_qlb]."<br />\n";   }
}
function _qlx() { $_qOx='<<'; $_qly='>>'; $_qOv=func_num_args(); $_qlw=func_get_args(); for ($_qlb=1; $_qlb<$_qOv; $_qlb ++) { $_qOw=_qOs($_qlw[$_qlb],$_qlw[0]); echo $_qOx." $".$_qOw." = "; print_r($_qlw[$_qlb]); echo $_qly."<br>";   }
}
function _qOy() { $_qOx='<<'; $_qly='>>'; $_qOv=func_num_args(); $_qlw=func_get_args(); for ($_qlb=2; $_qlb<$_qOv; $_qlb ++) { $_qOw=_qOs($_qlw[$_qlb],$_qlw[0]); echo $_qOx." $".$_qOw."->".$_qlw[1]." = "; print_r($_qlw[$_qlb]->$_qlw[1]); echo $_qly."<br>";   }
}

class _qlz { public static function _qOz($_ql10) { if ($_ql10 == _qlz::_qO10) return _qlz::_ql11; else if ($_ql10 == _qlz::_ql11) return _qlz::_qO10; else return NULL; } const _qO11="grand"; const _ql12="|->grand<-|"; const _qO12="'grand'"; const _ql13="|->Default Last Field<-|"; const _qO13="name"; const _ql14="data"; const _qO14="filter"; const _ql15="column"; const _qO15="row"; const _qO10="asc"; const _ql11="desc"; const busca_valor_por_indice="field"; const class_field="pivotField"; const _ql17="value"; const _qO17="comparison operator"; const _ql18="alias"; const _qO18="Direction"; const _ql19="SortValue"; const _qO19="select"; const _ql1a="condition"; const _qO1a="group"; const _ql1b="GroupValue"; const _qO1b="FieldName"; const _ql1c="FieldId"; const _qO1c="tabledata"; const _ql1d="Command"; const _qO1d="Expand"; const _ql1e="Collapse"; const _qO1e="SortGroup"; const _ql1f="Refresh"; const _qO1f="MoveField"; const _ql1g="cache values"; const _qO1g="cache filters"; const _ql1h="cache filter conditions"; const _qO1h="cache headers"; const _ql1i="Level"; const _qO1i="Depth"; const num_valores="Length"; const _qO1j="Sort"; const _ql1k="SortStatus"; const _qO1k="ExceptionList"; const _ql1l="IncludeAll"; const _qO1l="AllowReorder"; const _ql1m="FilterPanelOpen"; const _qO1m="_field_type"; const _ql1n="PanelWidth"; const _qO1n="PanelHeight"; const _ql1o="equal_to"; const _qO1o="not_equal_to"; const _ql1p="less_than"; const _qO1p="greater_than"; const _ql1q="less_than_or_equal_to"; const _qO1q="greater_than_or_equal_to"; const _ql1r="between"; const _qO1r="not_between"; const _ql1s="contain"; const _qO1s="start_with"; const _ql1t="end_with"; const _qO1t="Expandable"; const _ql1u="ValueChain"; const _qO1u="SQLCondition"; const _ql1v="nestedSQLCondition"; const _qO1v="sqlValues"; const _ql1w="allConditions"; const _qO1w="allNestedConditions"; const _ql1x="UniqueID"; const _qO1x="SubGroupIds"; const _qlz="Key"; const _ql1y="none"; const _qO1y="PageIndex"; const _ql1z="PageSize"; const _qO1z="TotalRows"; const _ql20="TotalPages"; const _qO20="GoPage"; const _ql21="Args"; const _qO21="ChangePageSize"; const _ql22="PVField_Ids"; const _qO22="CacheID"; const _ql23="HorizontalScrolling"; const _qO23="VerticalScrolling"; const _ql24="ScrollTop"; const _qO24="ScrollLeft"; const _ql25="ClientEvents"; const _qO25="GroupsToSort"; const _ql26="KPTSort"; const _qO26="From"; const _ql27="To"; const _qO27="FromPosition"; const _ql28="ToPosition"; const _qO28="_viewstate"; const _ql29="Go"; const _qO29="Next"; const _ql2a="Prev"; const _qO2a="Last"; const _ql2b="First"; const _qO2b="Ok"; const _ql2c="ok"; const _qO2c="Cancel"; const _ql2d="Includes"; const _qO2d="Excludes"; const _ql2e="Select_All"; const _qO2e="Grand_Total"; const _ql2f="Category_Total"; const _qO2f="Category_Sum"; const _ql2g="Category_Count"; const _qO2g="Category_Min"; const _ql2h="Category_Max"; const _qO2h="Category_Average"; const _ql2i="Category_PercentageSum"; const _qO2i="Category_PercentageCount"; const _ql2j="PageInfoTemplate"; const _qO2j="ManualPagerTemplate"; const _ql2k="PageSizeText"; const _qO2k="NextPageToolTip"; const _ql2l="PrevPageToolTip"; const _qO2l="FirstPageToolTip"; const _ql2m="LastPageToolTip"; const _qO2m="SortHeaderToolTip"; const _ql2n="SortAscToolTip"; const _qO2n="SortDescToolTip"; const _ql2o="SortNoneToolTip"; const _qO2o="ColumnZoneEmptyMessage"; const _ql2p="RowZoneEmptyMessage"; const _qO2p="FilterZoneEmptyMessage"; const _ql2q="DataZoneEmptyMessage"; const _qO2q="Drag_To_Reorder"; const _ql2r="Done"; const _qO2r="Loading"; const _ql2s="and"; const _qO2s="Sorted_Asc"; const _ql2t="Sorted_Desc"; const _qO2t="Filtering"; const _ql2u="DataFieldToSort"; const _qO2u="ChangeSortData"; const _ql2v="Check"; const _qO2v="checked"; const _ql2w="unchecked"; const _qO2w="Width"; const _ql2x="Height"; const _qO2x="OpenFilterPanel"; const _ql2y="CloseFilterPanel"; const _qO2y="FilterBy"; const _ql2z="Expression"; const _qO2z="aggregateFunction"; const _ql30="nestedField"; const _qO30="value1"; const _ql31="value2"; const _qO31="Options"; const _ql32="Values"; const _qO32="r"; const _ql33="c"; const _qO33="sortState"; const _ql34="initSort"; const _qO34="groupSort"; const _ql35="fieldSort"; const _qO35="top_N"; const _ql36="bottom_N"; const _qO36="top_percent"; const _ql37="bottom_percent"; }
class _qO37 { 	const _ql15=0; const _qO15=1; const _qO14=2; const _ql14=3; 	
	public static $_ql38=array(_qlz::_ql15 => _qO37::_ql15,_qlz::_qO15 => _qO37::_qO15,_qlz::_qO14 => _qO37::_qO14,_qlz::_ql14 => _qO37::_ql14); 	public static $_qO38=array(_qO37::_ql15 => _qlz::_ql15,_qO37::_qO15 => _qlz::_qO15,_qO37::_qO14 => _qlz::_qO14,_qO37::_ql14 => _qlz::_ql14); 	public static $_ql39=array("table" => "kptTableEx","cell" => "kptCellEx","expandedCell" => "kptExpandedCellEx","dataCell" => "kptDataCellEx","emptyDataCell" => "kptEmptyDataCellEx","columnHeader" => "kptColumnHeaderEx","rowHeader" => "kptRowHeaderEx","totalColumn" => "kptColumnTotalCellEx","totalRow" => "kptRowTotalCellEx","columnHeaderTotal" => "kptColumnHeaderTotalEx","rowHeaderTotal" => "kptRowHeaderTotalEx","dataDesc" => "kptDataDescCellEx","filterZone" => "kptFilterZoneEx","dataZone" => "kptDataZoneEx","columnZone" => "kptColumnZoneEx","rowZone" => "kptRowZoneEx","horizontalScroll" => "kptHorizontalScrollingEx","verticalScroll" => "kptVerticalScrollingEx","fieldItem" => "kptFieldItemEx",);
	public static function _qO39($_ql3a) { $_qO3a=""; if (is_string($_ql3a)) { $_ql3b=explode(" ",trim($_ql3a)); foreach ($_ql3b as $_qO3b) if (!empty($_qO3b)) { if ( isset (_qO37::$_ql39[$_qO3b])) $_qO3a.=_qO37::$_ql39[$_qO3b]." "; else $_qO3a.=$_qO3b." ";   }
} return $_qO3a; }
public static function _ql3c($_qlp) { $ret=array(); if (is_array($_qlp)) foreach ($_qlp as $_qO3c => $_ql3d) $ret[_qO37::$_ql39[$_qO3c]]=$_ql3d; return $ret; }
public static function _qOz($_qO3d) { if ($_qO3d == _qO37::_qO15) return _qO37::_ql15; else if ($_qO3d == _qO37::_ql15) return _qO37::_qO15; else return NULL;   }
}
class _ql3e { 
	const _ql2s=" AND "; const _qO3e=" OR "; const _ql3f=" XOR "; const _qO3f="AVG"; const _ql3g="SUM"; const _qO3g="COUNT"; const _ql3h="MIN"; 
	const _qO3h="MAX"; const _ql3i="="; const _qO3i="!="; const _ql3j="<"; const _qO3j=">"; const _ql3k="<="; const _qO3k=">="; const _ql3l=" LIKE "; 
	const _qO3l="%"; const _ql3m=TRUE; const _qO3m=FALSE; 
} 
interface _ql3n { 
	function insere_valor_na_posicao($_qlp);
	function busca_valor_por_indice();
	function _qO3o();
	function valores_vazio(); 
}
class _qO3p implements _ql3n { 
	private $_ql3q=array();
	function insere_valor_na_posicao($_qlp) { array_push($this->_ql3q ,$_qlp); }
	function busca_valor_por_indice() { $_qlp=array_pop($this->_ql3q); return $_qlp; }
	function _qO3o() { $this->_ql3q =array(); }
	function valores_vazio() { return empty($this->_ql3q); }
	function _qO3q() {   }
}
class _ql3r implements _ql3n { 
	private $_qO3r=array();
	function insere_valor_na_posicao($_qlp) { array_push($this->_qO3r ,$_qlp); }
	function busca_valor_por_indice() { $_qlp=array_splice($this->_qO3r ,0,1); if (!empty($_qlp)) return $_qlp[0]; else return NULL; }
	function _qO3o() { $this->_qO3r =array(); }
	function valores_vazio() { return empty($this->_qO3r); }
	function _qO3q() {   }
}
class _ql3s implements _ql3n { 
	private $_qO3s=array();
	function insere_valor_na_posicao($_qlp) { foreach ($this->_qO3s as $_qO3c => $_ql3d) { if ($_qlp<$_ql3d) { array_splice($this->_qO3s ,$_qO3c,0,$_qlp); return $this; } else if ($_qlp == $_ql3d) return $this; } array_push($this->_qO3s ,$_qlp); return $this; }
	function busca_valor_por_indice() { return array_pop($this->_qO3s); }
	function _qO3o() { $this->_qO3s =array(); }
	function valores_vazio() { return empty($this->_qO3s);   }
}
class _ql3t { var $Expand=FALSE; var $_qO3t; var $_ql3u; var $Value; protected $_qO3u=1; protected $_ql3v=0; protected $_qO3v=1; protected $_ql3w=0; protected $_qO3w; protected $_ql3x=TRUE;
	function _qO3x($_ql3y) { $_ql3y->_qO3t =$this; $this->_ql3u[strtolower($_ql3y->Value)]=$_ql3y; if ($this->Expand) { $_qO3y=$_ql3y->_qO3v; $_ql3z=$_ql3y->_ql3w; $_qO3z=$_ql3y; $_ql40=$this; while ($_ql40 != NULL) { $_qO40=$_qO3z->_ql3v -$_ql40->_ql3v +1; if ($_qO40>0) $_ql40->_ql3v += $_qO40; $_ql40->_qO3v += $_qO3y; $_ql40->_ql3w += $_ql3z; $_qO3z=$_ql40; $_ql40=$_ql40->_qO3t;   }
} $this->_ql41($_ql3y,$this->_qO3u); }
function _qO41($_qlp="") { if (!empty($_qlp)) { if (is_string($_qlp)) return isset ($this->_ql3u[strtolower($_qlp)]); else if (is_int($_qlp)) { $ret=array_values($this->_ql3u); return isset ($ret[$_qlp]) && $ret[$_qlp]->_ql42(); } else return FALSE; } else { return (!empty($this->_ql3u));   }
}
function _qO42($_qlp="") { if ($this->Expand) { if (!empty($_qlp)) { if (is_string($_qlp)) return isset ($this->_ql3u[strtolower($_qlp)]); else if (is_int($_qlp)) { $ret=array_values($this->_ql3u); return isset ($ret[$_qlp]) && $ret[$_qlp]->_ql42(); } else return FALSE; } else { return (!empty($this->_ql3u));   }
} else return FALSE; }
function _ql43($_qlp=0) { if ($this->_qO41($_qlp)) { if (is_string($_qlp)) return $this->_ql3u[strtolower($_qlp)]; else if (is_int($_qlp)) { $ret=array_values($this->_ql3u); return $ret[$_qlp]; } else return NULL; } else return NULL; }
function _qO43() { $ret=array(); foreach ($this->_ql3u as $_ql44) if ($_ql44->_ql42()) array_push($ret,$_ql44); return $ret; }
function _qO44() { return $this->_qO3t; }
function _ql41($_ql3y,$_ql45) { $_qO3s=new _qO3p(); $_qO3s->insere_valor_na_posicao($_ql3y); while (!$_qO3s->valores_vazio()) { $_qO45=$_qO3s->busca_valor_por_indice(); $_qO45->_qO3u += $_ql45; foreach ($_qO45->_ql3u as $_ql46) $_qO3s->insere_valor_na_posicao($_ql46);   }
}
function _qO46($_qlu) { $this->_qO3u =$_qlu; return $this; }
function _ql47() { return $this->_qO3u -3; }
function _qO47() { return $this->_qO3u; }
function _ql48($_qlu) { $this->_ql3v =$_qlu; return $this; }
function _qO48() { return $this->_ql3v; }
function _ql49($_qlu) { $this->_qO3v =$_qlu; return $this; }
function _qO49($_qlu) { $this->_qO3v += $_qlu; return $this; }
function _ql4a() { return $this->_qO3v; }
function _qO4a() { return $this->_ql3w; }
function _ql4b() { return $this->_qO3w; }
function _qO4b($_qlp) { $this->_qO3w =$_qlp; return $this; }
function _ql4c($_qlu=TRUE) { $this->_ql3x =$_qlu; return $this; }
function _ql42() { return $this->_ql3x; }
function _qO4c( &$_ql4d,&$_qO4d,&$_ql4e,&$_qO4e,&$_ql4f) { $_ql4d=$this->_ql47(); $_qO4d=$this->_qO48(); $_ql4e=$this->_ql4a(); $_qO4e=$this->_qO4a(); $_ql4f=$this->_ql4b();   }
}
class _qO4f { private $_ql4g=array(); private function __construct() { }
public static function constroi() { $_ql4h=new _qO4f(); return $_ql4h; }
function _qO4h($_qlp) { if (is_array($_qlp)) { foreach ($_qlp as $_ql4i => $_qO4i) if (!empty($_qO4i)) { if (! isset ($this->_ql4g[$_ql4i])) $this->_ql4g[$_ql4i]=""; if (!strpos($this->_ql4g[$_ql4i],$_qO4i)) $this->_ql4g[$_ql4i].=$_qO4i.";";   }
} return $this; }
function _ql4j() { $_qO4j=""; foreach ($this->_ql4g as $_ql4i => $_qO4i) { $_qO4j.=".".$_ql4i."\n { ".$_qO4i." } \n"; } return '<style type="text/css">'.$_qO4j."</style>";   }
}
class _ql4k { private $_qO4k; private $_ql3d; private function __construct() { }
public static function constroi($_qOw=NULL,$_qlu=NULL) { $_ql4l=new _ql4k(); if ( isset ($_qOw)) $_ql4l->_qO4k =$_qOw; if ( isset ($_qlu)) $_ql4l->_ql3d =$_qlu; return $_ql4l; }
function _qO4l($_ql4m='"') { if ( isset ($this->_qO4k) && isset ($this->_ql3d)) return $this->_qO4k.'='.$_ql4m.$this->_ql3d.$_ql4m; else return ""; }
function _qO4m() { if ( isset ($this->_qO4k)) return $this->_qO4k; else return ""; }
function _ql4n() { if ( isset ($this->_ql3d)) return $this->_ql3d; else return "";   }
}
class _qO4n { protected $_ql4o="<{tag} {properties}>{content}</{tag}>"; protected $_qO4o; protected $_ql4p; protected $_qO4p=array(); protected $_ql4q=array();
function __construct() { $this->_ql4p =_qO4f::constroi(); }
public static function constroi($_qlp) { $_qO45=new _qO4n(); $_qO45->_qO4q($_qlp); return $_qO45; }
function _ql4r($_qlp) { if (is_array($_qlp)) $this->_ql4p->_qO4h($_qlp); return $this; }
function _qO4r() { return $this->_ql4p->_ql4j(); }
function _qO4q($_qlp) { $this->_ql4o =replace("{tag}",$_qlp,$this->_ql4o); return $this; }
function _ql4s($_qlp) { $_ql4l=_ql4k::constroi("colspan",$_qlp); $this->_qO4p["cs"]=$_ql4l; return $this; }
function _qO4s() { if ( isset ($this->_qO4p["cs"])) return $this->_qO4p["cs"]->_ql4n(); else return 1; }
function _ql4t($_qlp) { $_ql4l=_ql4k::constroi("rowspan",$_qlp); $this->_qO4p["rs"]=$_ql4l; return $this; }
function _qO4t() { if ( isset ($this->_qO4p["rs"])) return $this->_qO4p["rs"]->_ql4n(); else return 1; }
function _ql4u($_qlp) { $_ql4l=_ql4k::constroi("align",$_qlp); $this->_qO4p["al"]=$_ql4l; return $this; }
function _qO2w($_qlp) { $_ql4l=_ql4k::constroi("width",$_qlp); $this->_qO4p["w"]=$_ql4l; return $this; }
function _qO4h($_qlp) { $_ql4l=_ql4k::constroi("style",$_qlp); $this->_qO4p["st"]=$_ql4l; return $this; }
function _qO4u() { $_qO3b=""; $_qOv=func_num_args(); $_qlw=func_get_args(); for ($_qlb=0; $_qlb<$_qOv; $_qlb ++) $_qO3b.=$_qlw[$_qlb]." "; $_ql4l=_ql4k::constroi("class",$_qO3b); $this->_qO4p["cl"]=$_ql4l; return $this; }
function _ql4v($_qlp) { $_ql4l=_ql4k::constroi("id",$_qlp); $this->_qO4p["id"]=$_ql4l; return $this; }
function _qO4v($_qlp) { $this->_qO4o =$_qlp; return $this; }
function _ql4w($_qO3a,$_ql4l) { $_ql3b=explode(" ",trim($_qO3a)); foreach ($_ql3b as $_qO3b) { if ( isset ($_ql4l[$_qO3b])) { foreach ($_ql4l[$_qO3b] as $_qO4k => $_ql3d) { $_qO4w=_ql4k::constroi($_qO4k,$_ql3d); array_push($this->_qO4p ,$_qO4w);   }
}
} return $this; }
function _ql4x($_qlp) { if ($_qlp instanceof _ql4k) array_push($this->_qO4p ,$_qlp); else if (is_array($_qlp)) { foreach ($_qlp as $_qO4k => $_ql3d) { $_ql4l=_ql4k::constroi($_qO4k,$_ql3d); array_push($this->_qO4p ,$_ql4l);   }
} return $this; }
function _qO4x($_qlp) { $this->_qO4p =$_qlp; return $this; }
function _qO4c() { return $this->_qO4p; }
function _ql4y($_ql4m='"') { $_qO4j=""; foreach ($this->_qO4p as $_ql4l) if ( isset ($_ql4l)) $_qO4j.=$_ql4l->_qO4l($_ql4m)." "; return $_qO4j; }
function _qO3x($_qlp,$_qO4y=-1) { return $this->_ql4z(array($_qlp),$_qO4y); }
function _ql4z($_qlp,$_qO4y=-1) { $_qO4e=count($this->_ql4q); if (($_qO4y<0) || ($_qO4y>$_qO4e)) $_qO4y=$_qO4e; array_splice($this->_ql4q ,$_qO4y,0,array($_qlp)); return $this; }
function _qO4z($_qlp,$_qO4y) { return $this->_ql50(array($_qlp),$_qO4y); }
function _ql50($_qlp,$_qO4y) { if ($_qO4y>-1) $this->_ql4q[$_qO4y]=$_qlp; return $this; }
function _qO50() { ksort($this->_ql4q); }
function _ql51() { $ret=array(); foreach ($this->_ql4q as $_qO51) foreach ($_qO51 as $_qO3z) if ( isset ($_qO3z) && $_qO3z->_ql52() != "") { array_push($ret,$_qO3z); } return $ret; }
function _ql52() { $_qO4j=$this->_qO4o; foreach ($this->_ql4q as $_qO51) foreach ($_qO51 as $_qO3z) if ( isset ($_qO3z)) $_qO4j.=$_qO3z->_qO52(); return $_qO4j; }
function _qO52() { $_ql53=$this->_ql52(); if (!empty($_ql53)) { $_qO4j=$this->_ql4o; $_qO4j=replace("{properties}",$this->_ql4y(),$_qO4j); $_qO4j=replace("{content}",$_ql53,$_qO4j); return $_qO4j; } else return ""; }
function _qO53($_ql54=array(),$_qO54=TRUE) { $_qO4j=$this->_ql55($_ql54,$this->_qO4o ,$_qO54); foreach ($this->_ql4q as $_qO51) foreach ($_qO51 as $_qO3z) if ( isset ($_qO3z)) $_qO4j.=$_qO3z->_qO53($_ql54,$_qO54); return $_qO4j; }
function _qO55($_ql54,$_qO54=TRUE) { $_qO4j=$this->_ql55($_ql54,$this->_qO4o ,$_qO54); foreach ($this->_ql4q as $_qO51) foreach ($_qO51 as $_qO3z) if ( isset ($_qO3z)) $_qO4j.=$_qO3z->_ql56($_ql54,$_qO54); return $_qO4j; }
function _ql56($_ql54,$_qO54=TRUE,$_ql4m='"') { $_ql53=$this->_qO55($_ql54,$_qO54); if (!empty($_ql53)) { $_qO4j=$this->_ql4o; $_qO4j=replace("{properties}",$this->_ql4y($_ql4m),$_qO4j); $_qO4j=replace("{content}",$_ql53,$_qO4j); return $_qO4j; } else return ""; }
function _ql55($_ql54,$_ql3a,$_qO54=TRUE) { foreach ($_ql54 as $_qlm => $_qO56) { if ($_qO54) $_ql3a=replace($_qlm,$_qO56,$_ql3a); else $_ql3a=_qO2($_qlm,$_qO56,$_ql3a); } return $_ql3a;   }
}
class _ql57 extends _qO4n { }
class _qO57 extends _qO4n { }
class _ql58 extends _qO4n { function _qO58() { $_ql59=_qO59::_ql5a()->_qO4v("blank"); $_qO5a=$this->_ql51(); $ret=array(); $_ql5b=0; foreach ($_qO5a as $_qO5b => $fetch) { $_qO5c=$fetch->_ql51(); $ret[$_qO5b]=$_qO5c; $_ql5d=1; foreach ($_qO5c as $_qO5d => $_ql5e) { $_qO5e=$_ql5e->_qO4s(); for ($_ql5f=1; $_ql5f<$_qO5e; $_ql5f ++) array_splice($ret[$_qO5b],$_qO5d+$_ql5d,0,array($_ql59)); $_ql5d += $_qO5e-1; } $_qO5f=count($ret[$_qO5b]); if ($_qO5f>$_ql5b) $_ql5b=$_qO5f; } $_ql5g=count($ret); $_qO4y=0; while ($_qO4y<$_ql5g*$_ql5b) { $_qO5b=$_qO4y%$_ql5g; $_qO5d= (int) $_qO4y/$_ql5g; if ( isset ($ret[$_qO5b][$_qO5d])) { $_ql5e=$ret[$_qO5b][$_qO5d]; $_qO5e=$_ql5e->_qO4s(); $_qO5g=$_ql5e->_qO4t(); for ($_ql5h=1; $_ql5h<$_qO5g; $_ql5h ++) { for ($_ql5f=0; $_ql5f<$_qO5e; $_ql5f ++) array_splice($ret[$_qO5b+$_ql5h],$_qO5d,0,array($_ql59)); $_qO5f=count($ret[$_qO5b+$_ql5h]); if ($_qO5f>$_ql5b) $_ql5b=$_qO5f;   }
} $_qO4y ++; } return $ret;   }
}
class _qO59 { public static function _ql5a() { $_qO45=new _ql57(); return $_qO45->_qO4q("td"); }
public static function _qO5h() { $_qO45=new _qO57(); return $_qO45->_qO4q("tr"); }
public static function _ql5i() { $_qO45=new _ql58(); return $_qO45->_qO4q("table"); }
public static function _qO5i() { $_qO45=_qO4n::constroi("div"); return $_qO45; }
public static function _ql5j() { $_qO45=_qO4n::constroi("span"); return $_qO45;   }
}
class _qO1u { protected $_qO5j; private function __construct() { $this->_qO5j =""; }
public static function _ql5k($_qO5k="") { $_ql5l=new _qO1u(); if ($_qO5k instanceof _qO1u) $_ql5l->_qO5j =$_qO5k->_qO5l(); else if (is_string($_qO5k)) $_ql5l->_qO5j =$_qO5k; return $_ql5l; }
function _ql2z($_ql5m) { if (is_string($_ql5m)) $this->_qO5j =$_ql5m; return $this; }
function _qO5m() { $this->_qO5j ="(".$this->_qO5j.")"; return $this; }
function _ql5n($_qO5k,$_qO5n=_ql3e::_ql2s,$_ql5o=_ql3e::_ql3m) { $_ql5m=$this->_qO5j; if ($_qO5k instanceof _qO1u) $_qO5o=$_qO5k->_qO5l(); else if (is_string($_qO5k)) $_qO5o=$_qO5k; else return NULL; if ($_qO5o != "") { if ($this->_qO5j != "") { if ($_ql5o == _ql3e::_ql3m) $_ql5m=$_ql5m.$_qO5n."(".$_qO5o.")"; else if ($_ql5o == _ql3e::_qO3m) $_ql5m=$_ql5m.$_qO5n.$_qO5o; } else { if ($_ql5o == _ql3e::_ql3m) $_ql5m="(".$_qO5o.")"; else if ($_ql5o == _ql3e::_qO3m) $_ql5m=$_qO5o;   }
} $this->_qO5j =$_ql5m; return $this; }
function _qO5l() { return $this->_qO5j;   }
}
class _ql5p { public $_qO5p; public $Link; protected $_ql5q; protected $_qO5q; protected $_ql5r; protected $_qO5r; protected $_ql5s; protected $_qO5s; protected $_ql5t; protected $_qO5t; protected $_ql5u=0;
	function __construct($_qO5u) { $this->Link =$_qO5u; $this->_ql5t =0; $this->_qO5q =FALSE; $this->_ql5u =0; }
	function setquerysize($_qlp) { if (is_int($_qlp)) $this->_ql5u =$_qlp; return $this; }
	function getquerysize() { return $this->_ql5u; }
	function select($_ql5q) { if (is_string($_ql5q)) { $this->_ql5q =$_ql5q; $obj_valores=explode(",",$_ql5q); if (is_array($obj_valores)) foreach ($obj_valores as $_qO5v) if (!empty($_qO5v)) { $_ql5h=strripos($_qO5v,' as '); if ($_ql5h>0) { $this->_qO5s[$this->_ql5t ]["expression"]=trim(substr($_qO5v,0,$_ql5h)); $this->_qO5s[$this->_ql5t ]["alias"]=trim(substr($_qO5v,$_ql5h+4)); } else { $this->_qO5s[$this->_ql5t ]["expression"]=trim($_qO5v); $this->_qO5s[$this->_ql5t ]["alias"]=trim($_qO5v); } $this->_ql5t ++;   }
} else if (is_array($_ql5q)) { foreach ($_ql5q as $_qO5v) if (!empty($_qO5v)) { $_ql5h=strripos($_qO5v,' as '); if ($_ql5h>0) { $this->_qO5s[$this->_ql5t ]["expression"]=trim(substr($_qO5v,0,$_ql5h)); $this->_qO5s[$this->_ql5t ]["alias"]=trim(substr($_qO5v,$_ql5h+4)); } else { $this->_qO5s[$this->_ql5t ]["expression"]=trim($_qO5v); $this->_qO5s[$this->_ql5t ]["alias"]=trim($_qO5v); } $this->_ql5t ++;   }
} return $this; }
function _ql5w() { return $this->_qO5s; }
function _qO5w($_qlp) { $this->_qO5q =$_qlp; return $this; }
function selectcommand($_ql3a) { $this->_qO5t =$_ql3a; return $this; }
function from($_ql3a) { $this->_ql5r =$_ql3a; return $this; }
function join($_ql5x) { $this->_ql5r =" (".$this->_ql5r." JOIN ".$_ql5x; return $this; }
function fulljoin($_ql5x) { $this->_ql5r =" (".$this->_ql5r." FULL JOIN ".$_ql5x; return $this; }
function leftjoin($_ql5x) { $this->_ql5r =" (".$this->_ql5r." LEFT JOIN ".$_ql5x; return $this; }
function rightjoin($_ql5x) { $this->_ql5r =" (".$this->_ql5r." RIGHT JOIN ".$_ql5x; return $this; }
function innerjoin($_ql5x) { $this->_ql5r =" (".$this->_ql5r." INNER JOIN ".$_ql5x; return $this; }
function on($_ql5l) { $this->_ql5r .=" ON ".$_ql5l.") "; return $this; }
function where($_ql3a) { $this->_qO5r =$_ql3a; return $this; }
function groupby($_ql5s) { $this->_ql5s =$_ql5s; return $this; }
function _qO5x($obj_valores,$_ql5y,$_qO5y) { $_ql5z=_qlz::busca_valor_por_indice; $_qO5z=_qlz::_ql1w; if (!empty($this->_qO5t)) { $_ql5z=_qlz::_ql30; $_qO5z=_qlz::_qO1w; } $_ql5q=""; if (!empty($obj_valores)) { foreach ($obj_valores as $_qO5v) { $_qO4j=trim($_qO5v[$_ql5z]); if ( isset ($_qO5v[_qlz::_qO2z])) $_qO4j=$_qO5v[_qlz::_qO2z]."(".$_qO4j.")"; $_ql5q.=$_qO4j." AS ".$this->_ql60($_qO5v[_qlz::_ql18]).", "; } $_ql5q=trim($_ql5q,", "); } $_qO5q=($this->_qO5q) ? "DISTINCT ": ""; if ($_ql5q != "") $_ql5q="SELECT ".$_qO5q.$_ql5q; $_qO5r=""; if ( isset ($_ql5y)) $_qO5r=trim($_ql5y[$_qO5z]->_qO5l()); if (empty($this->_qO5t)) if (!empty($this->_qO5r)) { if ($_qO5r != "") $_qO5r.=" AND ".$this->_qO5r; else $_qO5r=$this->_qO5r; } if ($_qO5r != "") $_qO5r=" WHERE ".$_qO5r; $_ql3y=""; if (!empty($_qO5y)) { foreach ($_qO5y as $_qO60) { $_ql3y.=$_qO60[$_ql5z].", "; } $_ql3y=trim($_ql3y,", "); } if (empty($this->_qO5t)) if (!empty($this->_ql5s)) { if ($_ql3y != "") $_ql3y.=" , ".$this->_ql5s; else $_ql3y=$this->_ql5s; } if ($_ql3y != "") $_ql3y=" GROUP BY ".$_ql3y; $_ql5r=" FROM "; if (empty($this->_qO5t)) $_ql5r.=$this->_ql5r; else $_ql5r.="(".$this->_qO5t.") tmp "; $query=$_ql5q.$_ql5r.$_qO5r.$_ql3y; return $query; }
function _qO61($_ql3a) { return replace("'","''",$_ql3a); }
function _ql62($_ql3a) { $_qO62=$this->_qO61($_ql3a); $_qO62=replace(htmlentities("&"),"&",$_qO62); return $_qO62; }
function _ql63($_ql3a) { return "'".$_ql3a."'"; }
function _ql60($_ql3a) { return '"'.$_ql3a.'"'; }
function _qO63($_ql3a) { switch (strtolower($_ql3a)) { case "year": return "year"; case "quarter": return "quarter"; case "month": return "month"; case "day": return ""; default : return "error";  }			 }
}			
class pdopivotdatasource extends _ql5p { 
	function _ql64($query) { 
		$ret=array(); 
		$_qO64=$this->Link->prepare($query); 
		if ($_qO64) {
			$_qO64->execute(); 
			while ($fetch=$_qO64->fetch(pdo::FETCH_ASSOC)) { 
				array_push($ret,$fetch); 
			} 
		}
		return $ret; 
	}
	function _ql65($query,$_ql5d,$_ql5u) { 
		$query.=" LIMIT ".$_ql5d.",".$_ql5u; $ret=array(); 
		$_qO64=$this->Link->prepare($query); 
		$_qO64->execute(); 
		while ($fetch=$_qO64->fetch(pdo::FETCH_ASSOC)) { 
			array_push($ret,$fetch); 
		} return $ret;  
	}		
}		

class postgresqlpivotdatasource extends _ql5p { function _ql64($query) { $ret=array(); $res=pg_query($this->Link ,$query); while ($fetch=pg_fetch_assoc($res)) { array_push($ret,$fetch); } return $ret; }
function _ql65($query,$_ql5d,$_ql5u) { $query.= " LIMIT $_ql5u OFFSET $_ql5d"; $ret=array(); $res=pg_query($this->Link ,$query); while ($fetch=pg_fetch_assoc($res)) { array_push($ret,$fetch); } return $ret;  }	}	
class mysqlipivotdatasource extends _ql5p { function _ql64($query) { $ret=array(); $res=mysqli_query($this->Link ,$query); $ret=mysqli_fetch_all($res,MYSQLI_ASSOC); return $ret; }
function _ql65($query,$_ql5d,$_ql5u) { $query.=" LIMIT ".$_ql5d.",".$_ql5u; $ret=array(); $res=mysqli_query($this->Link ,$query); $ret=mysqli_fetch_all($res,MYSQLI_ASSOC); return $ret;   }
}
class mysqlpivotdatasource extends _ql5p { function _ql64($query) { $ret=array(); $res=mysql_query($query,$this->Link); while ($fetch=mysql_fetch_assoc($res)) { array_push($ret,$fetch); } return $ret; }
function _ql65($query,$_ql5d,$_ql5u) { $query.=" LIMIT ".$_ql5d.",".$_ql5u; $ret=array(); $res=mysql_query($query,$this->Link); while ($fetch=mysql_fetch_assoc($res)) { array_push($ret,$fetch); } return $ret;   }
}
class odbcpivotdatasource extends _ql5p { function _ql64($query) { $ret=array(); $res=odbc_exec($this->Link ,$query); while ($fetch=odbc_fetch_array($res)) { array_push($ret,$fetch); } return $ret;   }
}
class mssqlpivotdatasource extends _ql5p { function _ql64($query) { $ret=array(); $res=mssql_query($query,$this->Link); while ($fetch=mssql_fetch_array($res)) { array_push($ret,$fetch); } return $ret; }
function _ql65($query,$_ql5d,$_ql5u) { $_ql66=strpos($query,"SELECT "); $_qO66=strpos($query," AS "); $_qO5v=substr($query,$_ql66+7,$_qO66-$_ql66-7); $query=substr_replace($query,"ROW_NUMBER() OVER (ORDER BY $_qO5v) AS RowNumber, " ,$_ql66+7,0); $query= "SELECT * FROM ($query) tmp2 WHERE RowNumber BETWEEN $_ql5d AND $_ql5u "; $ret=array(); $res=mssql_query($query,$this->Link); while ($fetch=mssql_fetch_assoc($res)) { array_push($ret,$fetch); } return $ret;   }
}

class sqlsrvpivotdatasource extends _ql5p { 
	function _ql64($query) { $ret=array(); 
		$res=sqlsrv_query($this->Link ,$query); 
		if ($res !== false) {
			while ($fetch=sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC)) { 
				array_push($ret,$fetch); 
			} 
		}
		return $ret; 
		
	}
	function _ql65($query,$_ql5d,$_ql5u) { 
		$_ql66=strpos($query,"SELECT "); $_qO66=strpos($query," AS "); 
		$_qO5v=substr($query,$_ql66+7,$_qO66-$_ql66-7); 
		$query=substr_replace($query,"ROW_NUMBER() OVER (ORDER BY $_qO5v) AS RowNumber, " ,$_ql66+7,0); 
		$query= "SELECT * FROM ($query) tmp2 WHERE RowNumber BETWEEN $_ql5d AND $_ql5u "; 
		$ret=array(); 
		$res=sqlsrv_query($this->Link ,$query); 
		while ($fetch=sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC)) { array_push($ret,$fetch); } 
		return $ret;   
	}
}
class oraclepivotdatasource extends _ql5p { function _ql64($query) { $ret=array(); $_qO64=oci_parse($this->Link ,$query); oci_execute($_qO64); while ($fetch=oci_fetch_array($_qO64)) { array_push($ret,$fetch); } return $ret; }
function _ql65($query,$_ql5d,$_ql5u) { $_ql66=strpos($query,"SELECT "); $_qO66=strpos($query," AS "); $_qO5v=substr($query,$_ql66+7,$_qO66-$_ql66-7); $query=substr_replace($query,"ROW_NUMBER() OVER (ORDER BY $_qO5v) AS RowNumber, " ,$_ql66+7,0); $query= "SELECT * FROM ($query) tmp2 WHERE RowNumber BETWEEN $_ql5d AND ".($_ql5d+$_ql5u); $ret=array(); $_qO64=oci_parse($this->Link ,$query); oci_execute($_qO64); while ($fetch=oci_fetch_array($_qO64)) { array_push($ret,$fetch); } return $ret;   }
}
class _ql67 { public $_qO67; public $_ql68; public $_qO68=FALSE; public $_ql69=FALSE;
	function _qO69($_ql6a) { $this->_qO67 =$_ql6a; $this->_ql69 =$_ql6a->KeepViewStateInSession; $_qO6a=( isset ($_POST[$this->_qO67->_ql6b._qlz::_qO28])) ? $_POST[$this->_qO67->_ql6b._qlz::_qO28]: ""; if ($this->_ql69 && $_qO6a == "") { $_qO6a=( isset ($_SESSION[$this->_qO67->_ql6b._qlz::_qO28])) ? $_SESSION[$this->_qO67->_ql6b._qlz::_qO28]: ""; } if ($_qO6a != "" && $this->_qO68) { $_qO6a=base64_decode($_qO6a); } $_qO6a=replace("\134","",$_qO6a); $this->_ql68 =json_decode($_qO6a,TRUE); }
	function _qO3o() { $this->_ql68 =array(); }
	function _qO6b() { $_ql6c=json_encode($this->_ql68); if ($this->_qO68) { $_ql6c=base64_encode($_ql6c); } if ($this->_ql69) { $_SESSION[$this->_qO67->_ql6b._qlz::_qO28]=$_ql6c; } $_qO6c="<input id='{id}' name='{id}' type='hidden' value='{value}' autocomplete='off' />"; $_ql6d=replace("{id}",$this->_qO67->_ql6b._qlz::_qO28,$_qO6c); $_ql6d=replace("{value}",$_ql6c,$_ql6d); return $_ql6d;   }
}
class _qO6d { var $_ql6e; var $_qO6e;
	function __construct() { 
		$this->_ql6e =array(_qlz::_ql29 => "Go",_qlz::_qO29 => "Next",_qlz::_ql2a => "Next",_qlz::_qO2a => "Last",_qlz::_ql2b => "First",_qlz::_ql1y => "[No Filter]",_qlz::_ql1o => " is equal to",_qlz::_qO1o => " is NOT equal to",_qlz::_ql1p => "is less than",_qlz::_qO1p => " is greater than",_qlz::_ql1q => " is less than or equal to",_qlz::_qO1q => " is greater than or equal to",_qlz::_ql1r => " is between",_qlz::_qO1r => " is NOT between",_qlz::_ql1s => " contains",_qlz::_qO1s => " starts with",_qlz::_ql1t => " ends with",_qlz::_qO35 => " top N",_qlz::_ql36 => " bottom N",_qlz::_qO36 => " top percent",_qlz::_ql37 => " bottom percent",_qlz::_qO2b => "Ok",_qlz::_qO2c => "Cancel",_qlz::_ql2d => "Includes",_qlz::_qO2d => "Excludes",_qlz::_ql2e => "(Select All)",_qlz::_qO2e => "Grand Total",_qlz::_ql2f => "{category} Total",_qlz::_qO2f => "Sum of {category}",_qlz::_ql2g => "Count of {category}",_qlz::_qO2g => "{category} Min",_qlz::_ql2h => "{category} Max",_qlz::_qO2h => "Average of {category}",_qlz::_ql2i => "Percentage of sum of {category}",_qlz::_qO2i => "Percentage of count of {category}",); $this->_qO6e =array(_qlz::_ql2j => "Page <strong>{PageIndex}</strong> in <strong>{TotalPages}</strong>, items <strong>{FirstIndexInPage}</strong> to <strong>{LastIndexInPage}</strong> of <strong>{TotalRows}</strong>.",_qlz::_qO2j => "Change page: {TextBox} (of {TotalPage} pages) {GoPageButton}",_qlz::_ql2k => "Page Size:",_qlz::_qO2k => "Next Page",_qlz::_ql2l => "Previous Page",_qlz::_qO2l => "First Page",_qlz::_ql2m => "Last Page",_qlz::_qO2m => "Click here to sort",_qlz::_ql2n => "Sort Asc",_qlz::_qO2n => "Sort Desc",_qlz::_ql2o => "No sort",_qlz::_qO2o => "[Column Fields]",_qlz::_ql2p => "[Row Fields]",_qlz::_qO2p => "Drag the filter field here.",_qlz::_ql2q => "[Data Fields]",_qlz::_qO2q => "Drag to order",_qlz::_ql2r => _qlz::_ql2r,_qlz::_qO2r => "Loading..",_qlz::_ql2s => _qlz::_ql2s,_qlz::_qO2s => "Sorted asc",_qlz::_ql2t => "Sorted desc",_qlz::_qO2t => "Fitlering",); }
	
	function load($_ql6f) { $_qO6f=new domdocument(); $_qO6f->load($_ql6f); $_ql6g=$_qO6f->getelementsbytagname("commands"); if ($_ql6g->length >0) { foreach ($_ql6g->item(0)->attributes as $_qO6g) { $this->_ql6e[$_qO6g->name ]=$_qO6g->value;   }
} $_ql6g=$_qO6f->getelementsbytagname("messages"); if ($_ql6g->length >0) { foreach ($_ql6g->item(0)->attributes as $_qO6g) { $this->_qO6e[$_qO6g->name ]=$_qO6g->value;   }
}   }
}
class _ql6h { var $_qO6h; var $_ql6i; var $_ql6b;
	function __construct($_qO6i,$_ql6j) { $this->_qO6h =($_qO6i != NULL) ? $_qO6i: sys_get_temp_dir(); $this->_ql6i =($_ql6j != NULL) ? $_ql6j: 5*074; }
	function _qO6j($_qlm,$_qlo) { $_qO6a=json_encode($_qlo); file_put_contents($this->_qO6h."/".$this->_ql6b.$_qlm.".kpt",$_qO6a); return TRUE; }
	function _ql6k($_qlm) { $_qO6k=$this->_qO6h."/".$this->_ql6b.$_qlm.".kpt"; if (is_file($_qO6k) && (time()-filemtime($_qO6k)<$this->_ql6i)) { $_qO6a=file_get_contents($this->_qO6h."/".$this->_ql6b.$_qlm.".kpt"); return json_decode($_qO6a,TRUE); } return NULL;   }
}
class class_field { 
	var $_ql6l=FALSE; var $_qO67; var $_qO6l; var $_ql6m; var $_qO6m=array(); var $_ql6n; var $_qO6n; var $_ql6b; var $_ql6o=FALSE; var $_qO6o=0; 
	var $_ql6p=0; var $_qO6p=_ql3e::_ql3g; var $_ql6q; public $_qO6q; public $_ql6r; public $_qlm; public $_ql5q; private $_qO6r; 
	var $FieldName; var $Text; var $Sort; var $Expand; var $Filters; var $IncludeAll=TRUE; var $ExceptionList; var $AllowReorder; var $AllowSorting; 

	var $AllowFiltering; var $Tooltip; var $HeaderTextWrap=TRUE;
	function __construct($_ql6s) { 
		$this->FieldName =$_ql6s; 
		$this->_qO6s($_ql6s); 
		$this->ExceptionList =array(); 
		if ($this->_ql5q === NULL) 
			$this->_ql5q =array(); 
		$this->Filters =array(); 
	}
	public static function constroi($name,$type) { 
		switch ($type) { 
			case "sum": return new pivotsumfield($name); 
			case "average": return new pivotaveragefield($name); 
			case "percentage sum": return new pivotpercentagesumfield($name); 
			case "percentage count": return new pivotpercentagecountfield($name); 
			case "min": return new pivotminfield($name); 
			case "max": return new pivotmaxfield($name); 
			case "count": return new pivotcountfield($name); 
			case "pivot": default : return new pivotfield($name);   
		}
	}
	function _qO6s($_ql3a) { $this->_ql6q =$_ql3a; return $this; }
	function setvaluemap($_qO6r) { $this->_qO6r =$_qO6r; return $this; }
	function getvaluemap() { return $this->_qO6r; }
	function _ql6u($_qlu) { if ( isset ($this->_qO6r)) $_qlu=$this->_qO6r->map($_qlu); if (is_array($_qlu)) $_qlu=$_qlu[$this->FieldName ]; return $_qlu; }
	function _qO4c( &$name,&$_qO6u,&$_ql6v,&$_qO6v,&$_ql6w) { $name=$this->FieldName; $_qO6u=$this->_ql6b; $_ql6v=$this->_ql6q; $_qO6v=$this->_qO6q; $_ql6w=$this->_qO6p; }
	function _qO69($_ql6a,$_ql38) { $this->_qO67 =$_ql6a; $this->_qO6l =$_ql6a->_qO6l; $this->_ql6b =$this->_qO67->_ql6b."_".md5( "$_ql38"); $this->_qO6q ='f'.$_ql38; if ($this->Text === NULL) $this->Text =$this->FieldName; $this->_ql6n =array(); if ($this->Expand === NULL) $this->Expand =FALSE; if ($this->_qO6m === NULL) $this->_qO6m =array(); if ($this->AllowReorder === NULL) $this->AllowReorder =$this->_qO67->AllowReorder; if ($this->AllowSorting === NULL) $this->AllowSorting =$this->_qO67->AllowSorting; if ($this->AllowFiltering === NULL) $this->AllowFiltering =$this->_qO67->AllowFiltering; if ($this->Sort === NULL && $this->AllowSorting) $this->Sort =_qlz::_qO10; }
	function _qO6w() { if ( isset ($this->_qO6l->_ql68[$this->_ql6b ])) { $_ql6x=$this->_qO6l->_ql68[$this->_ql6b ]; $this->Sort =$_ql6x[_qlz::_qO1j]; $_qO6x=$_ql6x[_qlz::_qO14]; $this->IncludeAll =$_ql6x[_qlz::_ql1l]; $_ql6y=$_ql6x[_qlz::_qO1k]; $this->_ql6o =$_ql6x[_qlz::_ql1m]; $this->_ql6r =$_ql6x[_qlz::_qO1m]; for ($_qlb=0; $_qlb<count($_qO6x); $_qlb ++) { $_qO6x[$_qlb][1]=urldecode($_qO6x[$_qlb][1]); if ( isset ($_qO6x[$_qlb][2])) $_qO6x[$_qlb][2]=urldecode($_qO6x[$_qlb][2]); } $this->Filters =$_qO6x; for ($_qlb=0; $_qlb<count($_ql6y); $_qlb ++) $_ql6y[$_qlb]=(urldecode($_ql6y[$_qlb])); $this->ExceptionList =$_ql6y; if ($this->_ql6o) { $this->_qO6o =$_ql6x[_qlz::_ql1n]; $this->_ql6p =$_ql6x[_qlz::_qO1n];   }
	}
	}
	function _qO6y($_qOn) { $_ql6z=$this->_qO67; $_qO6z=$_ql6z->DataSource; if ( isset ($_qOn->_ql6e[$this->_ql6b ])) { $_qO5d=$_qOn->_ql6e[$this->_ql6b ]; $_ql70=$_qO5d[_qlz::_ql1d]; $ret0=$_qO5d[_qlz::_ql21]; switch ($_ql70) { case _qlz::_qO1j: if ($_ql6z->EventHandler->onbeforefieldsort($this,array()) == TRUE) { $this->Sort =$ret0[_qlz::_qO1j]; $_ql6z->EventHandler->onfieldsort($this,array()); $_ql71=$this->_ql6r; $_ql6z->ret1[_qO37::_qOz($_ql71)]=NULL; $_ql6z->_ql72 =$_ql71; $_ql6z->setsortstate(_qlz::_ql35); } break; case _qlz::_qO2x: if ($_ql6z->EventHandler->onbeforefilterpanelopen($this,array()) == TRUE) { $this->_ql6o =TRUE; $this->_qO6o =$ret0[_qlz::_qO2w]; $this->_ql6p =$ret0[_qlz::_ql2x]; if (empty($this->_ql6n)) $this->ret2(); $_ql6z->EventHandler->onfilterpanelopen($this,array()); } break; case _qlz::_ql2y: $this->_ql6o =FALSE; switch ($ret0[_qlz::_ql1d]) { case _qlz::_ql2c: if ($_ql6z->EventHandler->onbeforefieldfilter($this,array()) == TRUE) { if ($ret0[_qlz::_qO2y] == _qlz::_ql32) { $this->Filters =array(); $this->IncludeAll =TRUE; $this->ExceptionList =array(); $this->addfilter(array($ret0[_qlz::_ql2z],$_qO6z->_ql62(urldecode($ret0[_qlz::_qO30])),$_qO6z->_ql62(urldecode($ret0[_qlz::_ql31])))); } else if ($ret0[_qlz::_qO2y] == _qlz::_qO31) { $this->Filters =array(); $this->IncludeAll =$ret0[_qlz::_ql1l]; $this->ExceptionList =($ret0[_qlz::_qO1k] != NULL) ? $ret0[_qlz::_qO1k]: array(); for ($_qlb=0; $_qlb<count($this->ExceptionList); $_qlb ++) $this->ExceptionList[$_qlb]=$_qO6z->_ql62(urldecode($this->ExceptionList[$_qlb])); } $_ql6z->_ql73 =TRUE; $_ql6z->EventHandler->onfieldfilter($this,array()); } break; case _qlz::_qO2c: break; } break; case _qlz::_ql1e: if ($_ql6z->EventHandler->onbeforefieldcollapse($this,array()) == TRUE) { $this->Expand =FALSE; $_ql6z->EventHandler->onfieldcollapse($this,array()); } break; case _qlz::_qO1d: if ($_ql6z->EventHandler->onbeforefieldexpand($this,array()) == TRUE) { $this->Expand =TRUE; $_ql6z->EventHandler->onfieldexpand($this,array()); } break;   }
	} foreach ($this->ExceptionList as $ret3) $this->_qO6n[$ret3]=1; if ($this->AllowFiltering && $this->_ql6o) $_ql6z->_ql74 =$this; }
	function ret4() { $_ql6y=$this->ExceptionList; for ($_qlb=0; $_qlb<count($_ql6y); $_qlb ++) $_ql6y[$_qlb]=urlencode($_ql6y[$_qlb]); $_qO6x=$this->Filters; for ($_qlb=0; $_qlb<count($_qO6x); $_qlb ++) { $_qO6x[$_qlb][1]=urlencode($_qO6x[$_qlb][1]); if ( isset ($_qO6x[$_qlb][2])) $_qO6x[$_qlb][2]=urlencode($_qO6x[$_qlb][2]); } $this->_qO6l->_ql68[$this->_ql6b ]=array(_qlz::_qO1b => urlencode($this->FieldName),_qlz::_qO1j => $this->Sort ,_qlz::_qO1k => $_ql6y,_qlz::_ql1l => $this->IncludeAll ,_qlz::_qO14 => $_qO6x,_qlz::_qO1l => $this->AllowReorder ,_qlz::_ql1m => $this->_ql6o ,_qlz::_qO1m => $this->_ql6r ,); if ($this->_ql6o) { $this->_qO6l->_ql68[$this->_ql6b ]=array_merge($this->_qO6l->_ql68[$this->_ql6b ],array(_qlz::_ql1n => $this->_qO6o ,_qlz::_qO1n => $this->_ql6p ,));   }
	}
	function addfilter($_ql75) { array_push($this->Filters ,$_ql75); }
	function addexception($_qlu) { array_push($this->ExceptionList ,$_qlu); }
	function ret5() { $_ql76=(!empty($this->Filters) || !empty($this->ExceptionList)); if (empty($this->ExceptionList) && $this->IncludeAll == FALSE) $_ql76=TRUE; return $_ql76; }
	function ret6($_qlu) { $this->_ql6n[$_qlu]=1; }
	function ret2() { $_ql6z=$this->_qO67; $_qO6z=$_ql6z->DataSource; $this->_qO4c($name,$_qO6u,$_ql6v,$_qO6v,$_ql6w); $query=$_qO6z->_qO5w(TRUE)->_qO5x(array(array(_qlz::busca_valor_por_indice => $_ql6v,_qlz::_ql30 => $name,_qlz::_ql18 => $_qO6v)),NULL,NULL); $_qO5a=$_qO6z->_ql64($query); foreach ($_qO5a as $fetch) { $_qlu=$this->_ql6u($fetch[$_qO6v]); $this->ret6($_qlu); } ksort($this->_ql6n); }
	function _ql77($ret7) { foreach ($ret7 as $_ql78) $this->ret6($_ql78); return $this; }
	function ret8() { $ret7=array(); foreach (array_keys($this->_ql6n) as $_ql78) array_push($ret7,$_ql78); return $ret7; }
	function _ql79($_qlu) { if ($this->IncludeAll && in_array(($_qlu),$this->ExceptionList)) return FALSE; if ($this->IncludeAll == FALSE && !in_array(($_qlu),$this->ExceptionList)) return FALSE; foreach ($this->Filters as $_ql75) { switch ($_ql75[0]) { case _qlz::_ql1o: if (!($_qlu == $_ql75[1])) return FALSE; break; case _qlz::_qO1o: if (!($_qlu != $_ql75[1])) return FALSE; break; case _qlz::_ql1p: if (!($_qlu<$_ql75[1])) return FALSE; break; case _qlz::_qO1p: if (!($_qlu>$_ql75[1])) return FALSE; break; case _qlz::_ql1q: if (!($_qlu<=$_ql75[1])) return FALSE; break; case _qlz::_qO1q: if (!($_qlu>=$_ql75[1])) return FALSE; break; case _qlz::_ql1r: if (!(($_qlu>$_ql75[1]) && ($_qlu<$_ql75[2]))) return FALSE; break; case _qlz::_qO1r: if (!(($_qlu<$_ql75[1]) || ($_qlu>$_ql75[2]))) return FALSE; break; case _qlz::_ql1s: if (strpos(strtolower($_qlu),strtolower($_ql75[1])) === FALSE) return FALSE; break; case _qlz::_qO1s: if (strpos(strtolower($_qlu),strtolower($_ql75[1])) !== 0) return FALSE; break; case _qlz::_ql1t: if (strpos(strrev(strtolower($_qlu)),strrev(strtolower($_ql75[1]))) !== 0) return FALSE; break;   }
	} return TRUE; }
	function ret9() { foreach ($this->_qO6m as $_ql7a) { foreach ($this->Filters as $_ql75) { $_ql7a->reta($_ql75[0],$_ql75[1]);   }
	} return TRUE; }
	function _ql7b() { 
		$retb="<div id='{id}' class='kptFilterPanel' style='width:{width}px;height:{height}px;'>{function_panel}<div class='kptScrollPanel' style='height:200px;overflow-y:scroll;overflow-x:auto;'>{valuefilter}<div></div><div  id='{id}_filterwithoptions' class='kptFilterWithOptions'>{include_exclude}{list}</div></div>{hidden}</div>"; 
		$_ql7c="<div class='kptFunctionPanel'>{ok}{cancel}</div>"; 
		$retc="<input id='{id}' type='button' value='{text}' class='kpt{type}Button' />"; 
		$_ql7d="<div id='{id}_filterwithvalues' class='kptFilterWithValues'>{field}<select id='{id}_select' name='{id}_select'>{options}</select><input id='{id}_value1' name='{id}_value1' value='{value1}' style='display:none' /><span style='display:none'> {and} <input id='{id}_value2' name='{id}_value2' value='{value2}' /></span></div>"; 
		$retd="<option value='{value}' {selected}>{text}</option>"; 
		$_ql7e="<div class='kptIncludeExclude'>{include}{exclude}</div>"; 
		$rete="<span class='kptInExOption'><input id='{id}' class='kptRadio' type='radio' name='{name}' {checked} value='{value}'/><label class='kptLabel' for='{id}'>{text}</label></span>"; 
		$_ql7f="<div class='kptList'>{items}</div>"; $retf="<div class='kptListOption'><input id='{id}' class='kptCheck' type='checkbox' name='{id}' {checked} /><label class='kptLabel' for='{id}'>{text}</label></div>"; 
		$_ql7g="<input type='hidden' id='{id}_hidden' name='{id}_hidden' value='{value}' />"; 
		$retg=FALSE; 
		if (! isset ($_POST[$this->_ql6b."_hidden"])) { 
			$_POST[$this->_ql6b."_include_exclude"]=_qlz::_ql2d; 
			if (count($this->Filters)>0) { 
				$_POST[$this->_ql6b."_select"]=$this->Filters[0][0]; $_POST[$this->_ql6b."_value1"]=$this->Filters[0][1]; 
				if ( isset ($this->Filters[0][2])) $_POST[$this->_ql6b."_value2"]=$this->Filters[0][2]; $_POST[$this->_ql6b."_hidden"]="vl"; 
			} 
			else { 
				$_POST[$this->_ql6b."_hidden"]="ie"; 
			} 
			$retg=TRUE; 
		} 
		$_ql7h=replace("{id}",$this->_ql6b."_cancel",$retc); 
		$_ql7h=replace("{text}",$this->_qO67->Localization->_ql6e[_qlz::_qO2c],$_ql7h); 
		$_ql7h=replace("{type}",_qlz::_qO2c,$_ql7h); $reth=replace("{id}",$this->_ql6b."_ok",$retc); 
		$reth=replace("{text}",$this->_qO67->Localization->_ql6e[_qlz::_qO2b],$reth); 
		$reth=replace("{type}",_qlz::_qO2b,$reth); $_ql7i=replace("{ok}",$reth,$_ql7c); 
		$_ql7i=replace("{cancel}",$_ql7h,$_ql7i); $reti=replace("{id}",$this->_ql6b ,$_ql7d); 
		$reti=replace("{value1}",isset ($_POST[$this->_ql6b."_value1"]) ? $_POST[$this->_ql6b."_value1"]: "",$reti); 
		$reti=replace("{value2}",isset ($_POST[$this->_ql6b."_value2"]) ? $_POST[$this->_ql6b."_value2"]: "",$reti); 
		$_ql7j=array(_qlz::_ql1y,_qlz::_ql1o,_qlz::_qO1o,_qlz::_ql1p,_qlz::_qO1p,_qlz::_ql1q,_qlz::_qO1q,_qlz::_ql1r,_qlz::_qO1r,_qlz::_ql1s,_qlz::_qO1s,_qlz::_ql1t,); 
		$retj=array(_qlz::_qO35,_qlz::_ql36,_qlz::_qO36,_qlz::_ql37); $_ql7k=""; 
		foreach ($_ql7j as $_qlu) { 
			$retk=replace("{value}",$_qlu,$retd); $retk=replace("{text}",$this->_qO67->Localization->_ql6e[$_qlu],$retk); 
			$retk=replace("{selected}",( isset ($_POST[$this->_ql6b."_select"]) && $_POST[$this->_ql6b."_select"] == $_qlu) ? "selected='selected'": "",$retk); 
			$_ql7k.=$retk; 
		} 
		if (count($this->_qO6m)>0) 
			foreach ($retj as $_qlu) { 
				$retk=replace("{value}",$_qlu,$retd); 
				$retk=replace("{text}",$this->_qO67->Localization->_ql6e[$_qlu],$retk); 
				$retk=replace("{selected}",( isset ($_POST[$this->_ql6b."_select"]) && $_POST[$this->_ql6b."_select"] == $_qlu) ? "selected='selected'": "",$retk); 
				$_ql7k.=$retk; 
			}
		$reti=replace("{options}",$_ql7k,$reti); 
		$reti=replace("{field}",$this->Text ,$reti); 
		$reti=replace("{and}",$this->_qO67->Localization->_qO6e[_qlz::_ql2s],$reti); $_ql7l=replace("{id}",$this->_ql6b."_include",$rete); 
		$_ql7l=replace("{name}",$this->_ql6b."_include_exclude",$_ql7l); 
		$_ql7l=replace("{text}",$this->_qO67->Localization->_ql6e[_qlz::_ql2d],$_ql7l); 
		$_ql7l=replace("{value}",_qlz::_ql2d,$_ql7l); 
		$_ql7l=replace("{checked}",( isset ($_POST[$this->_ql6b."_include_exclude"]) && $_POST[$this->_ql6b."_include_exclude"] == _qlz::_ql2d) ? "checked='checked'": "",$_ql7l); 
		$retl=replace("{id}",$this->_ql6b."_exclude",$rete); $retl=replace("{name}",$this->_ql6b."_include_exclude",$retl); 
		$retl=replace("{text}",$this->_qO67->Localization->_ql6e[_qlz::_qO2d],$retl); $retl=replace("{value}",_qlz::_qO2d,$retl); 
		$retl=replace("{checked}",( isset ($_POST[$this->_ql6b."_include_exclude"]) && $_POST[$this->_ql6b."_include_exclude"] == _qlz::_qO2d) ? "checked='checked'": "",$retl); 
		$_ql7m=replace("{include}",$_ql7l,$_ql7e); $_ql7m=replace("{exclude}",$retl,$_ql7m); $ret7=""; 
		$retm=replace("{id}",$this->_ql6b."_selectall",$retf); $retm=replace("{text}",$this->_qO67->Localization->_ql6e[_qlz::_ql2e],$retm); 
		$retm=replace("{checked}","",$retm); $ret7.=$retm; $_qlb=0; 
		foreach ($this->_ql6n as $_qO3c => $_ql3d) { 
			$_ql78=replace("{id}",$this->_ql6b."_".$_qlb,$retf); 
			$_ql78=replace("{text}",$_qO3c,$_ql78); 
			if (!$retg) { 
				$_ql78=replace("{checked}",isset ($_POST[$this->_ql6b."_".$_qlb]) ? "checked='checked'": "",$_ql78); 
			} else { 
				$_ql78=replace("{checked}",$this->_ql79($_qO3c) ? "checked='checked'": "",$_ql78); 
			} 
			$_qlb ++; $ret7.=$_ql78; 
		} 
		$valores=replace("{items}",$ret7,$_ql7f); 
		$retn=replace("{id}",$this->_ql6b ,$_ql7g); 
		$retn=replace("{value}",$_POST[$this->_ql6b."_hidden"],$retn); 
		$_qOh=replace("{id}",$this->_ql6b ,$retb); 
		$_qOh=replace("{width}",$this->_qO6o ,$_qOh); 
		$_qOh=replace("{height}",$this->_ql6p ,$_qOh); 
		$_qOh=replace("{function_panel}",$_ql7i,$_qOh); 
		$_qOh=replace("{include_exclude}",$_ql7m,$_qOh); 
		$_qOh=replace("{valuefilter}",$reti,$_qOh); 
		$_qOh=replace("{list}",$valores,$_qOh); 
		$_qOh=replace("{hidden}",$retn,$_qOh); 
		return $_qOh; 
	}
	function _ql7o($reto=FALSE) { 
		$retf="<span id='{id}' class='kptFieldItem{dragable}' title='{tooltip}'>{text}{sort}{filter}</span>"; 
		$_ql7p="<span class='kptDesc'>{text}</span>"; $retp="<span class='kptFilterButton filtro' title='{tooltip}'></span>"; 
		$_ql7q="<span class='kptSortButton kptSort{direction}{status}' title='{tooltip}' onclick='pivot_sort_toggle(this)'></span>"; 
		$_ql78=replace("{id}",$this->_ql6b ,$retf); 
		$_ql78=replace("{dragable}",$this->AllowReorder ? " kptDragable": "",$_ql78); 
		$_ql78=replace("{tooltip}",($this->Tooltip != NULL) ? $this->Tooltip : (($this->AllowReorder) ? $this->_qO67->Localization->_qO6e[_qlz::_qO2q]: ""),$_ql78); 
		$_ql78=replace("{text}",$this->Text ,$_ql78); 
		if ($reto) { $_ql78=replace("{sort}{filter}","",$_ql78); } 
		else { 
			switch (strtolower($this->Sort)) { 
				case _qlz::_qO10: 
				$retq=replace("{direction}","Asc",$_ql7q); 
				$retq=replace("{tooltip}",$this->_qO67->Localization->_qO6e[_qlz::_qO2s],$retq); 
				break; 
				case _qlz::_ql11: 
				$retq=replace("{direction}","Desc",$_ql7q); 
				$retq=replace("{tooltip}",$this->_qO67->Localization->_qO6e[_qlz::_ql2t],$retq); 
				break; 
				case _qlz::_ql1y: 
				default: 
				$retq="";
				break; 
			} 
			$_ql7r=($this->_ql6l) ? "On": "Off"; 
			$retq=replace("{status}",$_ql7r,$retq); 
			$_ql78=replace("{sort}",$this->AllowSorting ? $retq: "",$_ql78); 
			$_ql75=replace("{tooltip}",$this->_qO67->Localization->_qO6e[_qlz::_qO2t],$retp); 
			$_ql78=replace("{filter}",$this->AllowFiltering ? $_ql75: "",$_ql78); 
		} 
		return $_ql78; 
	}
	function renderheader($_qlu) { return $_qlu; }
	function renderheadertotal($_qlu,$value='[Campo]') { return replace("{value}",'[Campo]',replace("{category}",$_qlu,$this->_qO67->Localization->_ql6e[_qlz::_ql2f])); }
	function retr($_qlu,$_qO4j) { return replace("{value}",'[Campo]',replace("{category}",$_qlu,$this->_qO67->Localization->_ql6e[_qlz::_ql2f])).$_qO4j; }
	function dataprocess($_qlu) { return $_qlu; }
	function _ql7s($_ql7j) { return $_ql7j; }
	function dataaggregate($_qlu,$rets) { return (($rets === NULL) ? 0: $rets)+$_qlu; }
	function displayformat($_qlu) { return $_qlu;   }
}
class pivotfield extends class_field { 
	var $_ql7t; var $rett; var $NoMatchValue; var $ConvertToPercent=FALSE;
	function __construct($_ql6s) { 
		parent:: __construct($_ql6s); 
		$this->_ql7t =array(); 
		$this->rett =array(); 
	}
	function _ql7s($_ql7j) { 
		if ($this->ConvertToPercent) { 
			$_ql7u=$this->_qO67->retu[_qO37::_ql15]->_ql7v(0); 
			$retv=$this->_qO67->retu[_qO37::_qO15]->_ql7v(0); 
			$this->_qO67->_ql7w($_ql7u,$retv,$retw,$_ql7x,$_qlm); 
			$retx=$this->_qO6q; 
			$_ql7y=$_ql7j[$retw][$_ql7x][$_qlm][$retx]; 
			foreach ($_ql7j as $rety => $_ql7z) 
				foreach ($_ql7z as $retz => $_ql80) 
					foreach ($_ql80 as $_qO3c => $_qO80) { 
						$_ql7j[$rety][$retz][$_qO3c][$retx]*=0144/$_ql7y;   
					}
		} 
		return $_ql7j;   
	}
}
class pivotdatefield extends pivotfield { 
	private static $_ql81=array("year","quarter","month","day"); 
	private $_qO81=array("year" => FALSE,"quarter" => FALSE,"month" => FALSE,"day" => TRUE); 
	public function setdatefields($_qlp) { 
		if (is_array($_qlp)) { 
			foreach ($_qlp as $_qO3c => $_ql3d) 
				if (in_array(strtolower($_qO3c),_ql82::$_ql81)) 
					$this->_qO81[strtolower($_qO3c)]=$_ql3d; 
		} 
		return $this; 
	} 
	public function getdatefields() { return $this->_qO81;   }
}
class pivotsumfield extends pivotfield { 
	var $ValueForNull=0; var $DecimalNumber=0; var $DecimalPoint="."; var $ThousandSeperate=","; var $FormatString="{n}";
	function renderheadertotal($_qlu,$value='[Campo]') { return replace("{value}",$value,replace("{category}",$_qlu,$this->_qO67->Localization->_ql6e[_qlz::_qO2f]));  }
	function dataprocess($_qlu) { $_qlu=parent::dataprocess($_qlu); if ($_qlu == NULL) return $this->ValueForNull; else return $_qlu; }
	function displayformat($num) { 
		$double= (double) $num; 
		return replace("{n}",number_format($double,$this->DecimalNumber ,$this->DecimalPoint ,$this->ThousandSeperate),$this->FormatString);   
	}
}
class pivotaveragefield extends pivotsumfield { 
	var $DecimalNumber=2; var $DecimalPoint=","; var $ThousandSeperate=""; var $_qO6p=_ql3e::_qO3f;
	function renderheadertotal($_qlu,$value='[Campo]') { 
		return replace("{value}",$value,replace("{category}",$_qlu,$this->_qO67->Localization->_ql6e[_qlz::_qO2h]));    
	}
}
class pivotpercentagesumfield extends pivotsumfield { 
	var $DecimalNumber=2; var $FormatString="{n}%"; var $ConvertToPercent=TRUE; var $_qO6p=_ql3e::_ql3g;
	function renderheadertotal($_qlu,$value='[Campo]') { 
		return replace("{value}",$value,replace("{category}",$_qlu,$this->_qO67->Localization->_ql6e[_qlz::_ql2i]));   
	}
}
class pivotpercentagecountfield extends pivotsumfield { 
	var $DecimalNumber=2; 
	var $FormatString="{n}%"; 
	var $ConvertToPercent=TRUE; 
	var $_qO6p=_ql3e::_qO3g;
	function renderheadertotal($_qlu,$value='[Campo]') { 
		return replace("{value}",$value,replace("{category}",$_qlu,$this->_qO67->Localization->_ql6e[_qlz::_qO2i]));    
	}
}
class pivotminfield extends pivotsumfield { 
	var $_qO6p=_ql3e::_ql3h;
	function renderheadertotal($_qlu,$value='[Campo]') { 
		return replace("{value}",$value,replace("{category}",$_qlu,$this->_qO67->Localization->_ql6e[_qlz::_qO2g])); 
	}
}
class pivotmaxfield extends pivotsumfield { 
	var $_qO6p=_ql3e::_qO3h;
	function renderheadertotal($_qlu,$value='[Campo]') { 
		return replace("{value}",$value,replace("{category}",$_qlu,$this->_qO67->Localization->_ql6e[_qlz::_ql2h]));    
	}
}
class pivotcountfield extends pivotsumfield { 
	var $_qO6p=_ql3e::_qO3g;
	function renderheadertotal($_qlu,$value='[Campo]') { 
		return replace("{value}",$value,replace("{category}",$_qlu,$this->_qO67->Localization->_ql6e[_qlz::_ql2g]));    
	}
}
class _ql83 extends pivotfield { 
	var $FieldName; var $Expand; var $_ql6r;
	public static function _qO83() { $_qO5v=new class_field(_qlz::_qO12); $_qO5v->Expand =TRUE; $_qO5v->_qO6s(_qlz::_qO12); return $_qO5v;   }
}
class _ql84 extends _ql3t { 
	var $_qO84; var $_ql85=FALSE; var $_qO85; var $_ql86=""; public $_qO86; public $_ql87; public $_qO87=array(); var $_qO67; var $_qO6l; 
	var $_ql6b; var $_ql88; var $_qO88; var $_qls;
	function __construct($_qlu,$_qO5v) { 
		$this->Value =$_qlu; $this->_ql3w =strlen($this->Value); $this->_ql3u =array(); 
		if ( isset ($_qO5v)) { 
			$this->_qO84 =$_qO5v; $this->Expand =$_qO5v->Expand; $this->_qO67 =$_qO5v->_qO67;   
		}
	}
	public static function _ql89($_qlu,$_qO5v) { $_ql3y=new _ql84($_qlu,$_qO5v); return $_ql3y; }
	public static function _qO89($_qlu,$_qO5v) { $_ql3y=new _ql8a($_qlu,$_qO5v); return $_ql3y; }
	function _qO8a($_qlp="") { return parent::_qO41($_qlp); }
	function _ql8b($_qlp="") { return parent::_qO42($_qlp); }
	function _ql7v($_qlp=0) { return parent::_ql43($_qlp); }
	function _qO8b() { return parent::_qO43(); }
	function _ql8c($_ql40) { $this->_ql86 =($_ql40 != NULL) ? $_ql40->_ql86."_".$this->Value : $this->Value; $this->_qO85 =md5($this->_ql86); $this->_ql6b =$this->_qO67->_ql6b."_".$this->_qO85; }
	function _qO69($_ql6a) { $this->_qO67 =$_ql6a; $this->_qO6l =$_ql6a->_qO6l; $this->_ql8c($this->_qO3t); if ($this->_qO88 === NULL) $this->_qO88 =$this->_qO67->AllowSortingData; if ($this->_ql88 === NULL) $this->_ql88 =_qlz::_qO10; if ($this->_qO86 === NULL) $this->_qO86 =""; if ($this->_ql87 === NULL) $this->_ql87 =""; }
	function ret4() { 
		if ($this->Expand != $this->_qO84->Expand || $this->_ql88 == _qlz::_ql11) { 
			$this->_qO6l->_ql68[$this->_ql6b ]=array(_qlz::_qO1d => $this->Expand ,_qlz::_qO1j => $this->_ql88 ,);   
		}
	}
	function _qO6w() { 
		if ( isset ($this->_qO6l->_ql68[$this->_ql6b ])) { $_ql6x=$this->_qO6l->_ql68[$this->_ql6b ]; $this->Expand =$_ql6x[_qlz::_qO1d]; $this->_ql88 =$_ql6x[_qlz::_qO1j];   }
	}
	function reta($_ql75,$_qlu) { 
		$_qO8c=count($this->_ql3u); $_ql5h=0; switch ($_ql75) { case _qlz::_qO35: foreach ($this->_ql3u as $_ql44) { if ($_ql5h<$_qlu) $_ql44->_ql4c(TRUE); else $_ql44->_ql4c(FALSE); $_ql5h ++; } break; case _qlz::_ql36: foreach ($this->_ql3u as $_ql44) { if ($_qO8c-$_ql5h-1<$_qlu) $_ql44->_ql4c(TRUE); else $_ql44->_ql4c(FALSE); $_ql5h ++; } break; case _qlz::_qO36: foreach ($this->_ql3u as $_ql44) { if (0144*$_ql5h/$_qO8c<$_qlu) $_ql44->_ql4c(TRUE); else $_ql44->_ql4c(FALSE); $_ql5h ++; } break; case _qlz::_ql37: foreach ($this->_ql3u as $_ql44) { if (0144*($_qO8c-$_ql5h-1)/$_qO8c<$_qlu) $_ql44->_ql4c(TRUE); else $_ql44->_ql4c(FALSE); $_ql5h ++; } break;   }
	}
	function _ql8d($_qlu) { $this->_ql88 =$_qlu; return $this; }
	function _qO8d($_qlu) { $this->Expand =$_qlu; return $this; }
	function _ql8e($_qlu) { $this->_qls =$_qlu; return $this; }
	function _qO6y($_qOn) { 
		if ( isset ($_qOn->_ql6e[$this->_ql6b ])) { 
			$_qO5d=$_qOn->_ql6e[$this->_ql6b ]; $_ql6z=$this->_qO67; 
			switch ($_qO5d[_qlz::_ql1d]) { 
				case _qlz::_qO1d: 
					if ($_ql6z->EventHandler->onbeforegroupexpand($this,array()) == TRUE) { 
						$this->_qO8d(TRUE); $_ql6z->EventHandler->ongroupexpand($this,array()); 
					} 
					break; 
				case _qlz::_ql1e: 
					if ($_ql6z->EventHandler->onbeforegroupcollapse($this,array()) == TRUE) { 
						$this->_qO8d(FALSE); $_ql6z->EventHandler->ongroupcollapse($this,array()); 
					} 
					break; 
				case _qlz::_qO1e: 
					if ($_ql6z->EventHandler->_qO8e($this,array()) == TRUE) { 
						$this->_ql8d($_qO5d[_qlz::_ql21][_qlz::_qO1j])->_ql8f(); $_ql6z->setsortstate(_qlz::_qO34); 
						$_ql6z->EventHandler->_qO8f($this,array()); 
					} 
					break;   
			}
		}
	}
	function _ql8f() { $_ql8g=array(_qlz::_ql1x => $this->_ql6b ,_qlz::_qO18 => $this->_ql88); $this->_qO67->ret1[$this->_qO84->_ql6r ]=$_ql8g; return $this; }
	function _qO8g() { $_ql8h=array(); foreach ($this->_ql3u as $_qO8h) array_push($_ql8h,$_qO8h->_ql6b); return array(_qlz::_qO1d => $this->Expand ,_qlz::_ql17 => urlencode($this->Value),_qlz::_qO1t => $this->_ql85 ,_qlz::_ql1u => $this->_ql86 ,_qlz::_qO1u => $this->_qO86 ,_qlz::_ql1v => $this->_ql87 ,_qlz::_ql1x => $this->_ql6b ,_qlz::_qO1x => $_ql8h,_qlz::_qlz => $this->_qO85 ,_qlz::_qO1j => $this->_ql88 ,_qlz::_ql19 => $this->_qls ,_qlz::_qO1v => $this->_qO87 ,); }
	function _ql8i($_ql10) { 
		if (count($this->_ql3u)>0) { switch ($_ql10) { case _qlz::_qO10: uasort($this->_ql3u ,'Groups_Compare_asc'); break; case _qlz::_ql11: uasort($this->_ql3u ,'Groups_Compare_desc'); break; } foreach ($this->_ql3u as $_qO8h) $_qO8h->_ql8i($_ql10);   }
	}
function _qO8i() { if (!empty($this->_ql3u)) { foreach ($this->_ql3u as $_ql46) { $_qO5v=$_ql46->_qO84; $_ql10=($_qO5v->Sort != NULL) ? $_qO5v->Sort : $this->_qO67->_ql8j[$_qO5v->_ql6r ]; break; } switch ($_ql10) { case _qlz::_qO10: uasort($this->_ql3u ,'Groups_Compare_asc'); break; case _qlz::_ql11: uasort($this->_ql3u ,'Groups_Compare_desc'); break; } foreach ($this->_ql3u as $_qO8h) $_qO8h->_qO8i();   }
}
function _qO8j() { $_ql8k=0; $_qO8k=2; $ret=array(); if ($this->Expand) { $_qO3s=new _qO3p(); $this->_qO46($_qO8k); $this->_ql49(1); $this->_ql48(0); $_qO3s->insere_valor_na_posicao($this); $_ql8l=new _qO3p(); while (!$_qO3s->valores_vazio()) { $_ql3y=$_qO3s->busca_valor_por_indice(); $_ql3y->_qO4b($_ql8k ++); $_ql8l->insere_valor_na_posicao($_ql3y); if ($_ql3y->Expand) { foreach ($_ql3y->_ql3u as $_ql46) if ($_ql46->_ql42()) { $_ql46->_qO46($_ql3y->_qO47()+1); $_ql46->_ql49(1); $_ql46->_ql48(0); $_qO3s->insere_valor_na_posicao($_ql46);   }
}
} while (!$_ql8l->valores_vazio()) { $_ql3y=$_ql8l->busca_valor_por_indice(); $_ql40=$_ql3y->_qO44(); if ($_ql3y->_qO48()>=$_ql40->_qO48()) $_ql40->_ql48($_ql3y->_qO48()+1); $_ql40->_qO49($_ql3y->_ql4a()); array_push($ret,$_ql3y);   }
} return $ret; }
function _qO8l() { $retb="{sign}{text}{sort}"; $_ql8m="<span class='{status}' onclick='pivot_group_toggle(this)'></span>"; $_ql7p="<span class='kptDesc'>{text}</span>"; $_ql7q="<span class='kptSortButton kptSort{direction}{status}' title='{tooltip}' onclick='pivot_group_sort_toggle(this)'></span>"; if ($this->_qO67->AllowSortingData) { switch (strtolower($this->_ql88)) { case _qlz::_qO10: $retq=replace("{direction}","Asc",$_ql7q); $retq=replace("{tooltip}",$this->_qO67->Localization->_qO6e[_qlz::_qO2s],$retq); break; case _qlz::_ql11: $retq=replace("{direction}","Desc",$_ql7q); $retq=replace("{tooltip}",$this->_qO67->Localization->_qO6e[_qlz::_ql2t],$retq); break; case _qlz::_ql1y: default : $retq=""; break; } $_ql7r="Off"; if (!empty($this->_qO67->ret1)) foreach ($this->_qO67->ret1 as $_qO3d => $_ql8g) if (!empty($_ql8g) && $_ql8g[_qlz::_ql1x] == $this->_ql6b) $_ql7r="On"; $retq=replace("{status}",$_ql7r,$retq); } else $retq=""; $retb=replace("{sort}",$this->_qO67->AllowSortingData ? $retq: "",$retb); $_qO8m=""; if ($this->_ql85) $_qO8m=replace("{status}",$this->Expand ? "kptExpand": "kptCollapse",$_ql8m); $_qO4j=""; $_qOh=replace("{text}",$this->_qO84->renderheader($this->Value,'bla').$_qO4j,$retb); $_qOh=replace("{sign}",$_qO8m,$_qOh); return $_qOh; }
function _ql8n() { return $this->_qO84->renderheadertotal($this->Value,'ble'); }
function _qO6b() { return "";   }
}
class _qO8n extends _ql84 { var $Expand=TRUE; }
class _ql8o extends _ql84 { var $Expand=TRUE; }
class _ql8a extends _ql84 { var $Expand=TRUE;
	function _qO8l() { return "<b>".$this->_qO67->Localization->_ql6e[_qlz::_qO2e]."</b>";   }
}
class _qO8o extends _ql8a { }
class _ql8p extends _ql8a { }
class _qO8p { 
	var $_ql6b; var $_qO67; var $_ql6e;
	function _qO69($_ql6a) { $this->_qO67 =$_ql6a; $this->_ql6b =$_ql6a->_ql6b."_cmd"; $this->_ql8q(); }
	function _ql8q() { 
		if ( isset ($_POST[$this->_ql6b ])) { $_qO6a=$_POST[$this->_ql6b ]; $_qO6a=replace("\134","",$_qO6a); $this->_ql6e =json_decode($_qO6a,TRUE);   }
	}
function _qO6b() { 
	$_qO8q="<input id='{id}' name='{id}' type='hidden' value='' />"; 
	$_qOn=replace("{id}",$this->_ql6b ,$_qO8q); return $_qOn;   
}
}
class _ql8r { var $LoadingText; var $DoneText;
	function _qO69($_ql6a) { if ($this->LoadingText === NULL) $this->LoadingText =$_ql6a->Localization->_qO6e[_qlz::_qO2r]; if ($this->DoneText === NULL) $this->DoneText =$_ql6a->Localization->_qO6e[_qlz::_ql2r]; }
	function _qO6b() { $_qO8r="<div class='kptStatus'><span class='kptDoneText'>{donetext}</span><span class='kptLoadingText'>{loadingtext}</span></div>"; $_ql7r=replace("{donetext}",$this->DoneText ,$_qO8r); $_ql7r=replace("{loadingtext}",$this->LoadingText ,$_ql7r); return $_ql7r;   }
}
class pivotpager { var $PageSize=012; var $PageIndex=0; var $ShowPageSize=FALSE; var $PageSizeText; var $PageSizeOptions="5,10,20,40"; var $ShowPageInfo=TRUE; var $PageInfoTemplate; var $_ql8s; var $_qO8s; var $_ql6b; var $_qO67; var $_qO6l;
function _qO69($_ql6a) { $this->_qO67 =$_ql6a; $this->_qO6l =$_ql6a->_qO6l; $this->_ql6b =$_ql6a->_ql6b."_pg"; if ($this->PageInfoTemplate === NULL) $this->PageInfoTemplate =$_ql6a->Localization->_qO6e[_qlz::_ql2j]; if ($this->PageSizeText === NULL) $this->PageSizeText =$_ql6a->Localization->_qO6e[_qlz::_ql2k]; }
function _qO6w() { if ( isset ($this->_qO6l->_ql68[$this->_ql6b ])) { $_ql6x=$this->_qO6l->_ql68[$this->_ql6b ]; $this->PageIndex =$_ql6x[_qlz::_qO1y]; $this->PageSize =$_ql6x[_qlz::_ql1z]; $this->_ql8s =$_ql6x[_qlz::_qO1z]; $this->_qO8s =$_ql6x[_qlz::_ql20];   }
}
function _qO6y($_qOn) { if ( isset ($_qOn->_ql6e[$this->_ql6b ])) { $_qO5d=$_qOn->_ql6e[$this->_ql6b ]; $_ql70=$_qO5d[_qlz::_ql1d]; $ret0=$_qO5d[_qlz::_ql21]; switch ($_ql70) { case _qlz::_qO20: if ($this->_qO67->EventHandler->onbeforepagechange($this,array(_qlz::_qO1y => $ret0[_qlz::_qO1y])) == TRUE) { $this->PageIndex =$ret0[_qlz::_qO1y]; $this->_qO67->EventHandler->onpagechange($this,array(_qlz::_qO1y => $ret0[_qlz::_qO1y])); } break; case _qlz::_qO21: if ($this->_qO67->EventHandler->onbeforepagesizechange($this,array(_qlz::_ql1z => $ret0[_qlz::_ql1z])) == TRUE) { $this->PageSize =$ret0[_qlz::_ql1z]; $this->_qO67->EventHandler->onpagesizechange($this,array(_qlz::_ql1z => $ret0[_qlz::_ql1z])); } break;   }
} $this->_qO8s =ceil($this->_ql8s /$this->PageSize); if ($this->PageIndex >=$this->_qO8s) $this->PageIndex =$this->_qO8s -1; if ($this->PageIndex <0) $this->PageIndex =0; }
function ret4() { $this->_qO6l->_ql68[$this->_ql6b ]=array(_qlz::_qO1y => $this->PageIndex ,_qlz::_ql1z => $this->PageSize ,_qlz::_qO1z => $this->_ql8s ,_qlz::_ql20 => $this->_qO8s); }
function _ql8t() { $_qO8t="<div class='kptInfo'>{text}</div>"; $_qO4=replace("{PageIndex}",($this->_qO8s >0) ? ($this->PageIndex +1): 0,$this->PageInfoTemplate); $_qO4=replace("{TotalPages}",$this->_qO8s ,$_qO4); $_ql8u=($this->_qO8s >0) ? ($this->PageIndex *$this->PageSize +1): 0; $_qO8u=($this->PageIndex +1)*$this->PageSize; if ($_qO8u>$this->_ql8s) $_qO8u=$this->_ql8s; $_qO4=replace("{FirstIndexInPage}",$_ql8u,$_qO4); $_qO4=replace("{LastIndexInPage}",$_qO8u,$_qO4); $_qO4=replace("{TotalRows}",$this->_ql8s ,$_qO4); $_ql8v=replace("{text}",$_qO4,$_qO8t); return $_ql8v; }
function _qO8v() { $_ql8w="<div class='kptPageSize'>{text}{select}</div>"; $_qO8w="<select onchange='pivot_pagesize_select_onchange(this)'>{options}</select>"; $retd="<option value='{value}' {selected}>{value}</option>"; $_ql7k=""; $_ql7j=explode(',',$this->PageSizeOptions); for ($_qlb=0; $_qlb<sizeof($_ql7j); $_qlb ++) { $retk=replace("{value}",$_ql7j[$_qlb],$retd); $retk=replace("{selected}",($this->PageSize == (int) $_ql7j[$_qlb]) ? "selected": "",$retk); $_ql7k.=$retk; } $_ql5q=replace("{options}",$_ql7k,$_qO8w); $_ql8x=replace("{text}",$this->PageSizeText ,$_ql8w); $_ql8x=replace("{select}",$_ql5q,$_ql8x); return $_ql8x; }
function render() { return "[pager zone]";   }
}
class pivotprevnextandnumericpager extends pivotpager { var $Range=012; var $FirstPageText; var $FirstPageToolTip; var $PrevPageText; var $PrevPageToolTip; var $NextPageText; var $NextPageToolTip; var $LastPageText; var $LastPageToolTip;
	function _qO69($_ql6a) { parent::_qO69($_ql6a); $_qO5d=$_ql6a->Localization->_ql6e; $_qO8x=$_ql6a->Localization->_qO6e; if ($this->FirstPageText === NULL) $this->FirstPageText =$_qO5d[_qlz::_ql2b]; if ($this->FirstPageToolTip === NULL) $this->FirstPageToolTip =$_qO8x[_qlz::_qO2l]; if ($this->PrevPageText === NULL) $this->PrevPageText =$_qO5d[_qlz::_ql2a]; if ($this->PrevPageToolTip === NULL) $this->PrevPageToolTip =$_qO8x[_qlz::_ql2l]; if ($this->NextPageText === NULL) $this->NextPageText =$_qO5d[_qlz::_qO29]; if ($this->NextPageToolTip === NULL) $this->NextPageToolTip =$_qO8x[_qlz::_qO2k]; if ($this->LastPageText === NULL) $this->LastPageText =$_qO5d[_qlz::_qO2a]; if ($this->LastPageToolTip === NULL) $this->LastPageToolTip =$_qO8x[_qlz::_ql2m]; }
	function render() { $_ql8y="<div class='kptPager kptNextPrevAndNumericPager'>{nav}{pagesize}{info}<div style='clear:both'></div></div>"; $_qO8y="<div class='kptNav'>{first} {prev} {numbers} {next} {last}</div>"; $_ql8z="<a class='kptNum {selected}' {href} {onclick}><span>{number}</span></a> "; $retc="<input type='button' onclick='{onclick}' title='{title}' class='nodecor'/>"; $_qO8z="<a href='javascript:void 0' onclick='{onclick}' title='{title}'>{text}</a>"; $_ql90="<span class= '{class}'>{button}</span>"; $_qO90=floor($this->PageIndex /$this->Range)*$this->Range; $_ql91=""; if ($_qO90>0) { $_qO82=replace("{href}","href='javascript:void 0'",$_ql8z); $_qO82=replace("{onclick}","onclick='pivot_gopage(this,".($_qO90-1).")'",$_qO82); $_qO82=replace("{number}","...",$_qO82); $_ql91.=$_qO82; } for ($_qlb=$_qO90; $_qlb<$_qO90+$this->Range && $_qlb<$this->_qO8s; $_qlb ++) { $_qO82=replace("{number}",($_qlb+1),$_ql8z); if ($_qlb == $this->PageIndex) { $_qO82=replace("{selected}","kptNumSelected",$_qO82); $_qO82=replace("{href}","",$_qO82); $_qO82=replace("{onclick}","",$_qO82); } else { $_qO82=replace("{selected}","",$_qO82); $_qO82=replace("{href}","href='javascript:void 0'",$_qO82); $_qO82=replace("{onclick}","onclick='pivot_gopage(this,".$_qlb.")'",$_qO82); } $_ql91.=$_qO82; } if ($_qO90+$this->Range <$this->_qO8s) { $_qO82=replace("{href}","href='javascript:void 0'",$_ql8z); $_qO82=replace("{onclick}","onclick='pivot_gopage(this,".($_qO90+$this->Range).")'",$_qO82); $_qO82=replace("{number}","...",$_qO82); $_qO82=replace("{selected}","",$_qO82); $_ql91.=$_qO82; } $_qO91=replace("{onclick}",($this->PageIndex >0) ? "pivot_gopage(this,0)": "",$retc); $_qO91=replace("{title}",$this->FirstPageToolTip ,$_qO91); $_ql92=replace("{onclick}",($this->PageIndex >0 && $this->FirstPageText !== NULL) ? "pivot_gopage(this,0)": "",$_qO8z); $_ql92=replace("{text}",$this->FirstPageText ,$_ql92); $_ql92=replace("{title}",$this->FirstPageToolTip ,$_ql92); $_qO92=replace("{button}",$_qO91.$_ql92,$_ql90); $_qO92=replace("{class}","kptFirst",$_qO92); $_ql93=replace("{onclick}",($this->PageIndex >0) ? "pivot_gopage(this,".($this->PageIndex -1).")": "",$retc); $_ql93=replace("{title}",$this->PrevPageToolTip ,$_ql93); $_qO93=replace("{onclick}",($this->PageIndex >0 && $this->PrevPageText !== NULL) ? "pivot_gopage(this,".($this->PageIndex -1).")": "",$_qO8z); $_qO93=replace("{text}",$this->PrevPageText ,$_qO93); $_qO93=replace("{title}",$this->PrevPageToolTip ,$_qO93); $_ql94=replace("{button}",$_ql93.$_qO93,$_ql90); $_ql94=replace("{class}","kptPrev",$_ql94); $_qO94=replace("{onclick}",($this->PageIndex <$this->_qO8s -1) ? "pivot_gopage(this,".($this->PageIndex +1).")": "",$retc); $_qO94=replace("{title}",$this->NextPageToolTip ,$_qO94); $_ql95=replace("{onclick}",(($this->PageIndex <$this->_qO8s -1) && $this->NextPageText !== NULL) ? "pivot_gopage(this,".($this->PageIndex +1).")": "",$_qO8z); $_ql95=replace("{text}",$this->NextPageText ,$_ql95); $_ql95=replace("{title}",$this->NextPageToolTip ,$_ql95); $_qO95=replace("{button}",$_ql95.$_qO94,$_ql90); $_qO95=replace("{class}","kptNext",$_qO95); $_ql96=replace("{onclick}",($this->PageIndex <$this->_qO8s -1) ? "pivot_gopage(this,".($this->_qO8s -1).")": "",$retc); $_ql96=replace("{title}",$this->LastPageToolTip ,$_ql96); $_qO96=replace("{onclick}",(($this->PageIndex <$this->_qO8s -1) && $this->LastPageText !== NULL) ? "pivot_gopage(this,".($this->_qO8s -1).")": "",$_qO8z); $_qO96=replace("{text}",$this->LastPageText ,$_qO96); $_qO96=replace("{title}",$this->LastPageToolTip ,$_qO96); $_ql97=replace("{button}",$_qO96.$_ql96,$_ql90); $_ql97=replace("{class}","kptLast",$_ql97); $_qO97=replace("{numbers}",$_ql91,$_qO8y); $_qO97=replace("{prev}",$_ql94,$_qO97); $_qO97=replace("{next}",$_qO95,$_qO97); $_qO97=replace("{first}",$_qO92,$_qO97); $_qO97=replace("{last}",$_ql97,$_qO97); $_ql8x=($this->ShowPageSize) ? $this->_qO8v(): ""; $_ql8v=($this->ShowPageInfo) ? $this->_ql8t(): ""; $_ql98=replace("{nav}",$_qO97,$_ql8y); $_ql98=replace("{info}",$_ql8v,$_ql98); $_ql98=replace("{pagesize}",$_ql8x,$_ql98); return $_ql98;   }
}
class pivotprevnextpager extends pivotpager { var $FirstPageText; var $FirstPageToolTip; var $PrevPageText; var $PrevPageToolTip; var $NextPageText; var $NextPageToolTip; var $LastPageText; var $LastPageToolTip;
	function _qO69($_qO98) { parent::_qO69($_ql6a); $_qO5d=$_ql6a->Localization->_ql6e; $_qO8x=$_ql6a->Localization->_qO6e; if ($this->FirstPageText === NULL) $this->FirstPageText =$_qO5d[_qlz::_ql2b]; if ($this->FirstPageToolTip === NULL) $this->FirstPageToolTip =$_qO8x[_qlz::_qO2l]; if ($this->PrevPageText === NULL) $this->PrevPageText =$_qO5d[_qlz::_ql2a]; if ($this->PrevPageToolTip === NULL) $this->PrevPageToolTip =$_qO8x[_qlz::_ql2l]; if ($this->NextPageText === NULL) $this->NextPageText =$_qO5d[_qlz::_qO29]; if ($this->NextPageToolTip === NULL) $this->NextPageToolTip =$_qO8x[_qlz::_qO2k]; if ($this->LastPageText === NULL) $this->LastPageText =$_qO5d[_qlz::_qO2a]; if ($this->LastPageToolTip === NULL) $this->LastPageToolTip =$_qO8x[_qlz::_ql2m]; }
	function render() { $_ql8y="<div class='kptPager kptNextPrevNextPager'>{pagesize}{nav}{info}<div style='clear:both'></div></div>"; $_qO8y="<div class='kptNav'>{first} {prev} {next} {last}</div>"; $retc="<input type='button' onclick='{onclick}' title='{title}' class='nodecor'/>"; $_qO8z="<a href='javascript:void 0' onclick='{onclick}' title='{title}'>{text}</a>"; $_ql90="<span class= '{class}'>{button}</span>"; $_qO91=replace("{onclick}",($this->PageIndex >0) ? "pivot_gopage(this,0)": "",$retc); $_qO91=replace("{title}",$this->FirstPageToolTip ,$_qO91); $_ql92=replace("{onclick}",($this->PageIndex >0 && $this->FirstPageText !== NULL) ? "pivot_gopage(this,0)": "",$_qO8z); $_ql92=replace("{text}",$this->FirstPageText ,$_ql92); $_ql92=replace("{title}",$this->FirstPageToolTip ,$_ql92); $_qO92=replace("{button}",$_qO91.$_ql92,$_ql90); $_qO92=replace("{class}","kptFirst",$_qO92); $_ql93=replace("{onclick}",($this->PageIndex >0) ? "pivot_gopage(this,".($this->PageIndex -1).")": "",$retc); $_ql93=replace("{title}",$this->PrevPageToolTip ,$_ql93); $_qO93=replace("{onclick}",($this->PageIndex >0 && $this->PrevPageText !== NULL) ? "pivot_gopage(this,".($this->PageIndex -1).")": "",$_qO8z); $_qO93=replace("{text}",$this->PrevPageText ,$_qO93); $_qO93=replace("{title}",$this->PrevPageToolTip ,$_qO93); $_ql94=replace("{button}",$_ql93.$_qO93,$_ql90); $_ql94=replace("{class}","kptPrev",$_ql94); $_qO94=replace("{onclick}",($this->PageIndex <$this->_qO8s -1) ? "pivot_gopage(this,".($this->PageIndex +1).")": "",$retc); $_qO94=replace("{title}",$this->NextPageToolTip ,$_qO94); $_ql95=replace("{onclick}",(($this->PageIndex <$this->_qO8s -1) && $this->NextPageText !== NULL) ? "pivot_gopage(this,".($this->PageIndex +1).")": "",$_qO8z); $_ql95=replace("{text}",$this->NextPageText ,$_ql95); $_ql95=replace("{title}",$this->NextPageToolTip ,$_ql95); $_qO95=replace("{button}",$_ql95.$_qO94,$_ql90); $_qO95=replace("{class}","kptNext",$_qO95); $_ql96=replace("{onclick}",($this->PageIndex >0) ? "pivot_gopage(this,".($this->_qO8s -1).")": "",$retc); $_ql96=replace("{title}",$this->LastPageToolTip ,$_ql96); $_qO96=replace("{onclick}",(($this->PageIndex <$this->_qO8s -1) && $this->LastPageText !== NULL) ? "pivot_gopage(this,".($this->_qO8s -1).")": "",$_qO8z); $_qO96=replace("{text}",$this->LastPageText ,$_qO96); $_qO96=replace("{title}",$this->LastPageToolTip ,$_qO96); $_ql97=replace("{button}",$_qO96.$_ql96,$_ql90); $_ql97=replace("{class}","kptLast",$_ql97); $_qO97=replace("{prev}",$_ql94,$_qO8y); $_qO97=replace("{next}",$_qO95,$_qO97); $_qO97=replace("{first}",$_qO92,$_qO97); $_qO97=replace("{last}",$_ql97,$_qO97); $_ql8x=($this->ShowPageSize) ? $this->_qO8v(): ""; $_ql8v=($this->ShowPageInfo) ? $this->_ql8t(): ""; $_ql98=replace("{nav}",$_qO97,$_ql8y); $_ql98=replace("{info}",$_ql8v,$_ql98); $_ql98=replace("{pagesize}",$_ql8x,$_ql98); return $_ql98;   }
}

class pivotnumericpager extends pivotpager { var $Range=012;	
	function render() { $_ql8y="<div class='kptPager kptNumericPager'>{pagesize}{nav}{info}<div style='clear:both'></div></div>"; $_qO8y="<div class='kptNav'>{numbers}</div>"; $_ql8z="<a class='kptNum {selected}' {href} {onclick}><span>{number}</span></a> "; $_qO90=floor($this->PageIndex /$this->Range)*$this->Range; $_ql91=""; if ($_qO90>0) { $_qO82=replace("{href}","href='javascript:void 0'",$_ql8z); $_qO82=replace("{onclick}","onclick='grid_gopage(this,".($_qO90-1).")'",$_qO82); $_qO82=replace("{number}","...",$_qO82); $_ql91.=$_qO82; } for ($_qlb=$_qO90; $_qlb<$_qO90+$this->Range && $_qlb<$this->_qO8s; $_qlb ++) { $_qO82=replace("{number}",($_qlb+1),$_ql8z); if ($_qlb == $this->PageIndex) { $_qO82=replace("{selected}","kptNumSelected",$_qO82); $_qO82=replace("{href}","",$_qO82); $_qO82=replace("{onclick}","",$_qO82); } else { $_qO82=replace("{selected}","",$_qO82); $_qO82=replace("{href}","href='javascript:void 0'",$_qO82); $_qO82=replace("{onclick}","onclick='grid_gopage(this,".$_qlb.")'",$_qO82); } $_ql91.=$_qO82; } if ($_qO90+$this->Range <$this->_qO8s) { $_qO82=replace("{href}","href='javascript:void 0'",$_ql8z); $_qO82=replace("{onclick}","onclick='grid_gopage(this,".($_qO90+$this->Range).")'",$_qO82); $_qO82=replace("{number}","...",$_qO82); $_qO82=replace("{selected}","",$_qO82); $_ql91.=$_qO82; } $_qO97=replace("{numbers}",$_ql91,$_qO8y); $_ql8x=($this->ShowPageSize) ? $this->_qO8v(): ""; $_ql8v=($this->ShowPageInfo) ? $this->_ql8t(): ""; $_ql98=replace("{nav}",$_qO97,$_ql8y); $_ql98=replace("{info}",$_ql8v,$_ql98); $_ql98=replace("{pagesize}",$_ql8x,$_ql98); return $_ql98;  }
}
class pivotmanualpager extends pivotpager { var $ManualPagerTemplate; var $ButtonType="Button"; var $GoPageButtonText; var $TextBoxWidth="25px";
function _qO69($_ql6a) { parent::_qO69($_ql6a); if ($this->ManualPagerTemplate === NULL) $this->ManualPagerTemplate =$_ql6a->Localization->_qO6e[_qlz::_qO2j]; if ($this->GoPageButtonText === NULL) $this->GoPageButtonText =$_ql6a->Localization->_ql6e[_qlz::_ql29]; }
function _ql99($_qOn) { parent::_ql99($_qOn); if ( isset ($_qOn->_ql6e[$this->_ql6b ])) { $_qO5d=$_qOn->_ql6e[$this->_ql6b ]; $this->PageIndex =( (int) $_POST[$this->_ql6b."_input"])-1; if ($this->PageIndex >=$this->_qO8s) $this->PageIndex =$this->_qO8s -1; if ($this->PageIndex <0) $this->PageIndex =0;   }
}
function render() { $_ql8y="<div class='kptPager kptManualPager'>{pagesize}{nav}{info}<div style='clear:both'></div></div>"; $_qO8y="<div class='kptNav'>{main}</div>"; $_qO99="<input id='{id}' name='{id}' type='textbox' style='width:{width};' value='{text}'/>"; $retb=$this->ManualPagerTemplate; $_ql9a=""; switch (strtolower($this->ButtonType)) { case "link": $_ql9a="<a class='kptGoButton' href='javascript:void 0' onclick='grid_gopage(this,0)'>{text}</a>"; break; case "image": $_ql9a="<input class='kptGoButton kptGoImage' type='button' onclick='grid_gopage(this,0)' />"; break; case "button": default : $_ql9a="<input class='kptGoButton' type='button' onclick='grid_gopage(this,0)' value='{text}' />"; break; } $_qO9a=replace("{id}",$this->_ql6b."_input",$_qO99); $_qO9a=replace("{width}",$this->TextBoxWidth ,$_qO9a); $_qO9a=replace("{text}",$this->PageIndex +1,$_qO9a); $_ql9b=replace("{text}",$this->GoPageButtonText ,$_ql9a); $_qOh=replace("{TextBox}",$_qO9a,$retb); $_qOh=replace("{GoPageButton}",$_ql9b,$_qOh); $_qOh=replace("{TotalPage}",$this->_qO8s ,$_qOh); $_qO97=replace("{main}",$_qOh,$_qO8y); $_ql8x=($this->ShowPageSize) ? $this->_qO8v(): ""; $_ql8v=($this->ShowPageInfo) ? $this->_ql8t(): ""; $_ql98=replace("{nav}",$_qO97,$_ql8y); $_ql98=replace("{info}",$_ql8v,$_ql98); $_ql98=replace("{pagesize}",$_ql8x,$_ql98); return $_ql98;   }
}
class pivoteventhandler { 	function onbeforefieldmove($_qO9b,$_ql9c) { return TRUE; }
function onfieldmove($_qO9b,$_ql9c) { }
function onbeforefieldsort($_qO9b,$_ql9c) { return TRUE; }
function onfieldsort($_qO9b,$_ql9c) { }
function _qO8e($_qO9b,$_ql9c) { return TRUE; }
function _qO8f($_qO9b,$_ql9c) { }
function onbeforefieldfilter($_qO9b,$_ql9c) { return TRUE; }
function onfieldfilter($_qO9b,$_ql9c) { }
function onbeforefieldcollapse($_qO9b,$_ql9c) { return TRUE; }
function onfieldcollapse($_qO9b,$_ql9c) { }
function onbeforefieldexpand($_qO9b,$_ql9c) { return TRUE; }
function onfieldexpand($_qO9b,$_ql9c) { }
function onbeforegroupexpand($_qO9b,$_ql9c) { return TRUE; }
function ongroupexpand($_qO9b,$_ql9c) { }
function onbeforegroupcollapse($_qO9b,$_ql9c) { return TRUE; }
function ongroupcollapse($_qO9b,$_ql9c) { }
function onbeforepagechange($_qO9b,$_ql9c) { return TRUE; }
function onpagechange($_qO9b,$_ql9c) { }
function onbeforepagesizechange($_qO9b,$_ql9c) { return TRUE; }
function onpagesizechange($_qO9b,$_ql9c) { }
function onbeforefilterpanelopen($_qO9b,$_ql9c) { return TRUE; }
function onfilterpanelopen($_qO9b,$_ql9c) { }
function onrefresh($_qO9b,$_ql9c) { }
function onbeforecellrender($_qO9b,$_ql9c) { }
function _qO9c($_qO9b,$_ql9c) { return TRUE; }
function _ql9d($_qO9b,$_ql9c) {   }
}
class _qO9d { var $RowHeaderMinWidth; }
class _ql9e { public $IgnorePaging=FALSE; protected $_qO9e=array(); protected $_ql54=array(); protected $_ql9f=array(); protected $_qO4i=array(); protected $_qO9f=array();	function __construct() { $this->_qO9f["config"]["pdf"]=array("pageOrientation" => "L","pageDimension" => array(01130,0620),"font" => array("family" => 'FreeSans',"style" => "","size" => 012),); $this->_qO9f["properties"]["table"]=array("border" => "1","cellspacing" => "0",); $this->config(array("fileName" => "KoolPivotTableExport","template" => "{KoolPivotTable}","showFilterZone" => TRUE,"caseSensitive" => TRUE,"pdf" => $this->_qO9f["config"]["pdf"],)); $this->htmlstyle(array("table" => "border:1px solid grey;"."border-collapse:collapse;color:black;","totalRow" => "background-color:lightblue; font-weight:bold;","totalColumn" => "background-color:lightblue; font-weight:bold;","dataCell" => "text-align:right;","emptyDataCell" => "text-align:center;","expandedCell" => "vertical-align:top;","cell" => "padding:5px; border:1px solid grey;",)); $this->htmlproperty(array("table" => $this->_qO9f["properties"]["table"],)); }
function config($_qlp) { if (is_array($_qlp)) $this->_qO9e =array_merge($this->_qO9e ,$_qlp); return $this; }
function _ql9g() { if ( isset ($this->_qO9e["pdf"]["font"]) && is_array($this->_qO9e["pdf"]["font"])) $this->_qO9e["pdf"]["font"]=array_merge($this->_qO9f["config"]["pdf"]["font"],$this->_qO9e["pdf"]["font"]); if ( isset ($this->_qO9e["pdf"]) && is_array($this->_qO9e["pdf"])) $this->_qO9e["pdf"]=array_merge($this->_qO9f["config"]["pdf"],$this->_qO9e["pdf"]); return $this->_qO9e; }
function htmlstyle($_qlp) { if (is_array($_qlp)) $this->_ql9f =array_merge($this->_ql9f ,$_qlp); return $this; }
function _qO9g() { return $this->_ql9f; }
function htmlproperty($_qlp) { if (is_array($_qlp)) $this->_qO4i =array_merge($this->_qO4i ,$_qlp); return $this; }
function _qO4c() { if ( isset ($this->_qO4i["table"]) && is_array($this->_qO4i["table"])) $this->_qO4i["table"]=array_merge($this->_qO9f["properties"]["table"],$this->_qO4i["table"]); return $this->_qO4i; }
function changetext($_qlp) { if (is_array($_qlp)) $this->_ql54 =array_merge($this->_ql54 ,$_qlp); return $this; }
function _ql9h() { return $this->_ql54;   }
}

class classe_valores { 
	private $valores;
	public static function constroi() { 
		$_ql9i=new classe_valores();
		 $_ql9i->valores =array(); 
		 return $_ql9i; 
	} 
	public function _qO9i($_qO45) { 
		if ( isset ($_qO45)) { 
			if (!is_array($_qO45)) $_ql9j=array($_qO45); 
			else $_ql9j=$_qO45; 
			foreach ($_ql9j as $_qO45) array_push($this->valores ,$_qO45);   
		}
	} 

	public function pop_valor() { 
		$_qO45=array_pop($this->valores); 
		return $_qO45; 
	} 

	public function insere_valor_na_posicao($_qO45,$_ql5h=-1) { 
		if ( isset ($_qO45)) { 
			if (!is_array($_qO45)) $_ql9j=array($_qO45); 
			else $_ql9j=$_qO45; 
			if ($_ql5h<0 || $_ql5h>count($this->valores)) $_ql5h=count($this->valores); 
			array_splice($this->valores ,$_ql5h,0,$_ql9j);   
		}
	} 

	public function busca_valor_por_indice($_ql5h=-1) { 
		if ($_ql5h<0 || $_ql5h>count($this->valores)-1) $_ql5h=count($this->valores)-1; 
		$_ql9j=array_slice($this->valores ,$_ql5h,1); 
		if (isset ($_ql9j[0])) return $_ql9j[0]; 
		else return NULL; 
	} 

	public function remove_valor_no_indice($_ql5h=-1) { 
		if ($_ql5h<0) $_ql5h=0; 
		else if ($_ql5h>count($this->valores)-1) $_ql5h=count($this->valores)-1; 
		$_ql9j=array_splice($this->valores ,$_ql5h,1); 
		if (isset ($_ql9j[0])) return $_ql9j[0];
		else return NULL; 
	}

	function valores() { return $this->valores; }
	function valores_vazio() { return empty($this->valores); }
	function num_valores() { return count($this->valores);   }
}

class classe_classe_valores { 
	private $obj_valores; 
	private function __construct() { }
	public static function constroi() {
		$_qO9l=new classe_classe_valores(); 
		$_qO9l->obj_valores =classe_valores::constroi(); 
		return $_qO9l; 
	}
	function insere_valor_na_posicao($rety,$_ql5h=-1) {
		$this->obj_valores->insere_valor_na_posicao($rety,$_ql5h); 
		return $this; 
	}

	function busca_valor_por_fieldname($_qlp) {
		if (is_string($_qlp)) { 
			$obj_valores=$this->slice_valores(); 
			foreach ($obj_valores as $_qO5v) 
				if ($_qO5v->FieldName == $_qlp) 
					return $_qO5v; 
		} 
		return NULL; 
	}
	function remove_valor_no_indice($_ql5h=-1) { $rety=$this->obj_valores->remove_valor_no_indice($_ql5h); return $rety; }
	function busca_valor_por_indice($_ql5h=-1) { $rety=$this->obj_valores->busca_valor_por_indice($_ql5h); return $rety; }
	function slice_valores($_ql5h=0) { return array_slice($this->obj_valores->valores(),$_ql5h); }
	function _ql9o($_ql5h=0) { $_qO4j=""; foreach ($this->slice_valores($_ql5h) as $_qO5v) $_qO4j.=$_qO5v->Text.">>>"; return rtrim($_qO4j,">"); }
	function num_valores() { return $this->obj_valores->num_valores(); }
	function _qO9o() { $_ql9p=""; foreach ($this->obj_valores->valores() as $_qO5v) { $_ql9p.="_".$_qO5v->_ql6b; $_qO5v->_qlm =$_ql9p; } return $this; }
	
	function _qO9p($_ql5h=0) { 
		$obj_valores=$this->slice_valores($_ql5h); 
		foreach ($obj_valores as $_qO5v) { 
			$_qO5v->_ql5q =array(
				_qlz::busca_valor_por_indice => $_qO5v->_ql6q ,
				_qlz::_ql30 => $_qO5v->FieldName ,
				_qlz::_ql18 => $_qO5v->_qO6q ,
				_qlz::class_field => $_qO5v
			); 
			if ($_qO5v->_ql6r == _qO37::_ql14) $_qO5v->_ql5q[_qlz::_qO2z]=$_qO5v->_qO6p; 
		} 
		return $this;   
	}
}

class koolpivottable { var $_ql0="3.5.2.0"; var $_ql6b; var $_ql4h; var $_ql9q; var $_qO9q; var $retu; var $_ql9r; var $_qO9r; var $_ql9s=0; var $_qO9s=0; var $_qO6l; var $_ql9t; var $_qO9t=FALSE; var $_ql73=FALSE; var $_ql9u=FALSE; var $_qO9u=FALSE; var $_ql9v; var $_ql74; var $ret1=array(); var $_qO9v; var $_ql8j=array(_qO37::_qO15 => _qlz::_qO10,_qO37::_ql15 => _qlz::_qO10); var $_ql72=NULL; var $_ql9w; private $_qO9w=array(_qlz::_qO13 => "",_qlz::_qO18 => _qlz::_ql11); private $_ql9x=_qlz::_ql34; var $id; var $scriptFolder; var $styleFolder; var $HorizontalScrolling=FALSE; var $VerticalScrolling=FALSE; var $Pager; var $Width; var $Height; var $AjaxEnabled=FALSE; var $AjaxLoadingImage=NULL; var $AjaxHandlePage; var $ShowColumnZone=TRUE; var $ShowRowZone=TRUE; var $ShowDataZone=TRUE; var $ShowFilterZone=TRUE; var $EmptyValue="-"; var $ErrorValue="-"; var $ShowStatus=TRUE; var $KeepViewStateInSession=FALSE; var $Localization; var $AllowCaching=FALSE; var $CacheFolder; var $CacheTime; var $AllowSorting=FALSE; var $AllowSortingData=FALSE; var $AllowReorder=FALSE; var $AllowFiltering=FALSE; var $Status; var $ClientEvents; var $EventHandler; var $Appearance; var $DataSource; var $ExportSettings; var $_qO5p="UTF-8";
function __construct($_qO9x) { 
	$this->id =$_qO9x; $this->_ql6b =$_qO9x; 
	foreach (_qO37::$_ql38 as $_qO3d) 
		$this->_qO9r[$_qO3d]=classe_classe_valores::constroi(); 
	$this->_ql9q =array(); 
	foreach (array(_qO37::_ql15 => _qlz::_ql33,_qO37::_qO15 => _qlz::_qO32) as $_qO3d => $_qlu) { 
		$_ql3y=_ql84::_qO89($_qlu,NULL); 
		$_ql3y->_qO69($this); 
		$this->retu[$_qO3d]=$_ql3y; 
		$_ql9y=_ql83::_qO83(); 
		$this->_qO9r[$_qO3d]->insere_valor_na_posicao($_ql9y); 
	} 
	$this->_qO6l =new _ql67($this); 
	$this->Localization =new _qO6d(); 
	$this->_ql9t =new _qO8p(); $this->Status =new _ql8r(); $this->ClientEvents =array(); $this->EventHandler =new pivoteventhandler(); 
	$this->Appearance =new _qO9d(); $this->ExportSettings =new _ql9e(); 
}
function adddatafield($_qO5v) { $this->_qO9y($_qO5v,_qO37::_ql14); return $this; }
function addfilterfield($_qO5v) { $this->_qO9y($_qO5v,_qO37::_qO14); return $this; }
function addrowfield($_qO5v) { $this->_qO9y($_qO5v,_qO37::_qO15); return $this; }
function addcolumnfield($_qO5v) { $this->_qO9y($_qO5v,_qO37::_ql15); return $this; }
function _qO9y($_qO5v,$_qO3d) { $name=$_qO5v->FieldName; $_ql71=$_qO5v->Text; $_ql9z=$name; $_qO6z=$this->DataSource; $_qO5s=$_qO6z->_ql5w(); if (!empty($_qO5s)) foreach ($_qO5s as $_qO9z) if ($_qO9z["alias"] == $name) $_ql9z=$_qO9z["expression"]; if ($_qO5v instanceof pivotdatefield) { $_qO81=$_qO5v->getdatefields(); foreach ($_qO81 as $_ql81 => $_qla0) if ($_qla0) { $_qOa0=$name."_".$_ql81; $_qla1=$_qO6z->_qO63($_ql81)."(".$_ql9z.")"; $_qOa1=$_ql71."'s ".ucfirst($_ql81); $_qO9z=array("alias" => $_qOa0,"expression" => $_qla1); array_push($_qO5s,$_qO9z); $_qla2=new pivotfield($_qOa0); $_qla2->Text =$_qOa1; $_qla2->_qO6s($_qla1); $this->_qO9r[$_qO3d]->insere_valor_na_posicao($_qla2);   }
} else { $_qO6r=$_qO5v->getvaluemap(); if ( isset ($_qO6r)) { $_qOa2=$_qO6r->getmapfields(); foreach ($_qOa2 as $type => $_qOa0) { if (empty($_qOa0) || $_qOa0 == $name) { $_qOa0=$name; $_qOa1=$_ql71; } else { $_qOa1=$_qOa0; } $_qla2=class_field::constroi($_qOa0,$type); $_qla2->setvaluemap($_qO6r); $_qla2->Text =$_qOa1; $_qla2->_qO6s($_ql9z); $this->_qO9r[$_qO3d]->insere_valor_na_posicao($_qla2);   }
} else { $_qO5v->_qO6s($_ql9z); $this->_qO9r[$_qO3d]->insere_valor_na_posicao($_qO5v);   }
} return $this; }
function getfilterfield($name) { return $this->busca_valor_por_fieldname($name,_qO37::_qO14); }
function getdatafield($name) { return $this->busca_valor_por_fieldname($name,_qO37::_ql14); }
function getrowfield($name) { return $this->busca_valor_por_fieldname($name,_qO37::_qO15); }
function getcolumnfield($name) { return $this->busca_valor_por_fieldname($name,_qO37::_ql15); }
function busca_valor_por_fieldname($name,$_qO3d) { return $this->_qO9r[$_qO3d]->busca_valor_por_fieldname($name); }
function _qla3($_qO3d,$_qOa3) { $_qO5v=$this->busca_valor_por_fieldname($_qO3d,$_qOa3); $ret=array(); foreach ($_qO5v->_qO6m as $_ql3y) if ($_ql3y->_ql8b()) { $_qla4=$_ql3y->_qO8b(); foreach ($_qla4 as $_ql44) array_push($ret,$_ql44); } return $ret; }
function _qOa4($_qO3d,$_qOa3) { $_qO5v=$this->busca_valor_por_fieldname($_qO3d,$_qOa3); $ret=array(); foreach ($_qO5v->_qO6m as $_ql3y) if ($_ql3y->_ql8b()) { $_qla4=$_ql3y->_qO8b(); foreach ($_qla4 as $_ql44) array_push($ret,$_ql44->Value); } return $ret; }
function setdatafieldforsorting($_qO5v) { $this->_qO9v =$_qO5v; return $this; }
function setinitsortedgroup($_qOw,$retq=_qlz::_ql11) { $this->_qO9w[_qlz::_qO13]=$_qOw; $this->_qO9w[_qlz::_qO18]=$retq; return $this; }
function setsortstate($_qlu) { $this->_ql9x =$_qlu; return $this; }
function _qO69() { $this->_qO6l->_qO69($this); $_ql38=0; foreach (_qO37::$_ql38 as $_qO3d) foreach ($this->_qO9r[$_qO3d]->slice_valores() as $_qO5v) { $_qO5v->_qO69($this,$_ql38 ++); $_qO5v->_ql6r =$_qO3d; } if ( isset ($this->Pager)) $this->Pager->_qO69($this); $this->_ql9t->_qO69($this); $this->Status->_qO69($this); }
function _qla5() { unset ($_POST[$this->_qO67->_ql6b._qlz::_qO28]); }
function _qO6w() { foreach (_qO37::$_ql38 as $_qO3d) foreach ($this->_qO9r[$_qO3d]->slice_valores() as $_qO5v) $_qO5v->_qO6w(); if ( isset ($this->Pager)) $this->Pager->_qO6w(); if ( isset ($this->_qO6l->_ql68[$this->_ql6b ])) { $_ql6x=$this->_qO6l->_ql68[$this->_ql6b ]; $_qOa5=$_ql6x[_qlz::_ql22]; $this->_ql9s =$_ql6x[_qlz::_ql24]; $this->_qO9s =$_ql6x[_qlz::_qO24]; $this->_ql9v =$_ql6x[_qlz::_qO22]; $this->ret1 =$_ql6x[_qlz::_qO25]; $this->_ql9x =$_ql6x[_qlz::_qO33]; $_qla6=array(); foreach (_qO37::$_ql38 as $_qO3d) foreach ($this->_qO9r[$_qO3d]->slice_valores() as $_qO5v) $_qla6[$_qO5v->_ql6b ]=$_qO5v; foreach (_qO37::$_ql38 as $_qO3d) { $this->_qO9r[$_qO3d]=classe_classe_valores::constroi(); foreach ($_qOa5[$_qO3d] as $_ql6b) $this->_qO9r[$_qO3d]->insere_valor_na_posicao($_qla6[$_ql6b]);   }
} else $this->_ql9v =uniqid(); }
function ret4() { $this->_qO6l->_qO3o(); foreach (_qO37::$_ql38 as $_qO3d) { $_qOa5[$_qO3d]=array(); foreach ($this->_qO9r[$_qO3d]->slice_valores() as $_qO5v) { $_qO5v->ret4(); array_push($_qOa5[$_qO3d],$_qO5v->_ql6b);   }
} foreach ($this->_ql9r[_qO37::_ql15] as $_ql3y) $_ql3y->ret4(); foreach ($this->_ql9r[_qO37::_qO15] as $_ql3y) $_ql3y->ret4(); if ( isset ($this->Pager)) $this->Pager->ret4(); $this->_qO6l->_ql68[$this->_ql6b ]=array(_qlz::_ql22 => $_qOa5,_qlz::_qO22 => $this->_ql9v ,_qlz::_qO1l => $this->AllowReorder ,_qlz::_ql23 => $this->HorizontalScrolling ,_qlz::_qO23 => $this->VerticalScrolling ,_qlz::_ql24 => $this->_ql9s ,_qlz::_qO24 => $this->_qO9s ,_qlz::_ql25 => $this->ClientEvents ,_qlz::_qO25 => $this->ret1 ,_qlz::_qO33 => $this->_ql9x ,); }
function _qOa6($_qla7,$_qOa7) { $_qla8=$this->ExportSettings; $_qO9e=$_qla8->_ql9g(); $_qOa8=$_qla8->_qO9g(); $_ql4l=$_qla8->_qO4c(); $_qla9=$this->retu[_qO37::_ql15]->_ql7v(0); $_qOa9=$this->retu[_qO37::_qO15]->_ql7v(0); $_qla9->_qO4c($_qlaa,$_qOaa,$_qlab,$_qOab,$_qlac); $_qOa9->_qO4c($_qOac,$_qlad,$_qOad,$_qlae,$_qOae); $_qOaa=($_qOaa>0) ? $_qOaa: 1; $_qlad=($_qlad>0) ? $_qlad: 1; $_qlaf=$this->_qO9r[_qO37::_ql14]->num_valores(); $_qOaf=($_qlaf>1) ? 1: 0; $_qlag="Filter fields: ".$this->_qO9r[_qO37::_qO14]->_ql9o(); 
	$_qOag="Data fields: ".$this->_qO9r[_qO37::_ql14]->_ql9o(); 
	$_qlah="Column fields: ".$this->_qO9r[_qO37::_ql15]->_ql9o(1); 
	$_qOah="Row fields: ".$this->_qO9r[_qO37::_qO15]->_ql9o(1); $_ql3b="table"; $_ql3b.=($this->HorizontalScrolling ? " horizontalScroll": "").($this->VerticalScrolling ? " verticalScroll": ""); $_qlai=_qO59::_ql5i()->_qO4u(_qO37::_qO39($_ql3b))->_ql4w($_ql3b,$_ql4l)->_ql4r(_qO37::_ql3c($_qOa8)); $_qOai=_qO59::_ql5j()->_qO4u(_qO37::$_ql39["fieldItem"])->_qO4v($_qlag); $_qlaj=_qO59::_qO5i()->_ql4v($this->_ql6b."_filterzoneEx")->_qO4u(_qO37::$_ql39["filterZone"])->_qO3x($_qOai); $_qOaj=_qO59::_ql5a()->_qO4u(_qO37::$_ql39["cell"])->_ql4w("cell",$_ql4l)->_ql4s($_qlab*$_qlaf+$_qlad)->_qO3x($_qlaj); $_qlak=_qO59::_qO5h()->_qO3x($_qOaj); if ($_qO9e["showFilterZone"]) $_qlai->_qO3x($_qlak); $_qOai=_qO59::_ql5j()->_qO4u(_qO37::$_ql39["fieldItem"])->_qO4v($_qOag); $_qlaj=_qO59::_qO5i()->_ql4v($this->_ql6b."_datazoneEx")->_qO4u(_qO37::$_ql39["dataZone"])->_qO3x($_qOai); $_qOaj=_qO59::_ql5a()->_qO4u(_qO37::$_ql39["cell"])->_ql4w("cell",$_ql4l)->_ql4s($_qlad)->_qO3x($_qlaj); $_qlak=_qO59::_qO5h()->_qO3x($_qOaj); $_qOai=_qO59::_ql5j()->_qO4u(_qO37::$_ql39["fieldItem"])->_qO4v($_qlah); $_qlaj=_qO59::_qO5i()->_ql4v($this->_ql6b."_columnzoneEx")->_qO4u(_qO37::$_ql39["columnZone"])->_qO3x($_qOai); $_qOaj=_qO59::_ql5a()->_qO4u(_qO37::$_ql39["cell"])->_ql4w("cell",$_ql4l)->_ql4s($_qlab*$_qlaf)->_qO3x($_qlaj); $_qlak->_qO3x($_qOaj); $_qlai->_qO3x($_qlak); $_qOak=array(); for ($_ql5h=0; $_ql5h<$_qOaa+1; $_ql5h ++) $_qOak[$_ql5h]=_qO59::_qO5h(); $_qOai=_qO59::_ql5j()->_qO4u(_qO37::$_ql39["fieldItem"])->_qO4v($_qOah); $_qlaj=_qO59::_qO5i()->_ql4v($this->_ql6b."_rowzoneEx")->_qO4u(_qO37::$_ql39["rowZone"])->_qO3x($_qOai); $_qOaj=_qO59::_ql5a()->_ql4s($_qlad)->_ql4t($_qOaa+$_qOaf)->_qO3x($_qlaj)->_qO4u(_qO37::$_ql39["cell"])->_ql4w("cell",$_ql4l); $_qOak[0]->_qO4z($_qOaj,0); foreach ($this->_ql9r[_qO37::_ql15] as $_ql3y) { $_ql3y->_qO4c($_ql4d,$_qO4d,$_ql4e,$_qO4e,$_ql4f); $_ql4e=($_ql4e>1) ? $_ql4e-1: $_ql4e; $_ql4f=$_qlab-1-$_ql4f; $_qlal=($_ql4d<0) ? 0: $_ql4d; $_qOaj=_qO59::_ql5a(); if ($_ql4d>=0) $_qOaj->_ql4s($_ql4e*$_qlaf)->_ql4t(($_qO4d>0) ? 1: ($_qOaa-$_qlal))->_qO4v($_ql3y->Value)->_qO4u(_qO37::_qO39("columnHeader cell"))->_ql4w("columnHeader cell",$_ql4l)->_ql4v($_ql3y->_ql6b."Ex"); $_qOal=_qO59::_ql5a(); if ($_ql3y->_ql8b() || $_ql4d<0) { if ($_ql4d<0) $_ql53=$_ql3y->Value; else $_ql53=$_ql3y->_ql8n(); $_qOal->_ql4s($_qlaf)->_ql4t($_qOaa-$_qlal)->_qO4v($_ql53)->_qO4u(_qO37::_qO39("columnHeader columnHeaderTotal totalColumn expandedCell cell"))->_ql4w("columnHeader columnHeaderTotal totalColumn expandedCell cell",$_ql4l); } $_qOak[$_qlal]->_ql50(array($_qOaj,$_qOal),$_ql4f+1); } if ($_qOaf>0) for ($_qO5d=0; $_qO5d<$_qlab; $_qO5d ++) { $_qlam=$this->_ql9r[_qO37::_ql15][$_qO5d]; $_ql3b=(!$_qlam->_ql8b()) ? "": "totalColumn"; $ret=array(); 
	for ($_qO4d=0; $_qO4d<$_qlaf; $_qO4d ++) 
		array_push($ret,_qO59::_ql5a()->_qO4u(_qO37::_qO39($_ql3b." cell dataDesc"))->_ql4w($_ql3b." cell dataDesc",$_ql4l)->_qO4v($this->_qO9r[_qO37::_ql14]->busca_valor_por_indice($_qO4d)->renderheadertotal($this->_ql9r[_qO37::_ql15][$_qO5d]->Value,$this->_qO9r[_qO37::_ql14]->busca_valor_por_indice($_qO4d)->FieldName))); $_qOak[$_qOaa]->_ql50($ret,$_qO5d+1); } $_qOak[$_qOaa]->_qO4u(_qO37::$_ql39["dataDesc"])->_ql4w("dataDesc",$_ql4l); for ($_ql5h=0; $_ql5h<$_qOaa+1; $_ql5h ++) $_qOak[$_ql5h]->_qO50(); $_qlai->_ql4z($_qOak); $_qOak=array(); $_qO3s=new _ql3s(); $_qOam=array(); if ($_qla7<0) $_qla7=0; if ($_qOa7<0) $_qOa7=$_qOad-1; for ($_qO5b=$_qla7; $_qO5b<$_qla7+$_qOa7; $_qO5b ++) array_push($_qOam,$_qO5b); if ($_qOa7>=0) array_push($_qOam,$_qOad-1); foreach ($_qOam as $_qO5b) { $_qOak[$_qO5b]=_qO59::_qO5h(); $_ql3y=$this->_ql9r[_qO37::_qO15][$_qO5b]; $_ql3y->_qO4c($_ql4d,$_qO4d,$_ql4e,$_qO4e,$_ql4f); $_ql4e=($_ql4e>1) ? $_ql4e-1: $_ql4e; $_ql4f=$_qOad-1-$_ql4f; if ($_ql4d>=0 && !$_ql3y->_ql8b()) { $_qOaj=_qO59::_ql5a()->_ql4s(($_qO4d>0) ? 1: ($_qlad-$_ql4d))->_ql4t($_ql4e)->_qO4v($_ql3y->Value)->_qO4u(_qO37::_qO39("cell rowHeader"))->_ql4w("cell rowHeader",$_ql4l)->_ql4v($_ql3y->_ql6b."Ex"); $_qOak[$_ql4f]->_qO4z($_qOaj,$_ql4d); } if ($_ql3y->_ql8b() || $_ql4d<0) { if ($_ql4d<0) $_ql53=$_ql3y->Value; else $_ql53=$_ql3y->_ql8n(); $_ql4d=($_ql4d<0) ? 0: $_ql4d; $_qOal=_qO59::_ql5a()->_ql4s($_qlad-$_ql4d)->_qO4v($_ql53)->_qO4u(_qO37::_qO39("cell rowHeader rowHeaderTotal"))->_ql4w("cell rowHeader rowHeaderTotal",$_ql4l); $_qOak[$_ql4f]->_qO4z($_qOal,$_ql4d)->_qO4u(_qO37::$_ql39["totalRow"])->_ql4w("totalRow",$_ql4l); } $_qlan=$_ql3y; if ($_qlan !== $_qOa9) while ($_qlan->_qO3t !== $_qOa9) { $_qlan=$_qlan->_qO3t; $_qO3s->insere_valor_na_posicao($_qOad-1-$_qlan->_ql4b());   }
} while (!$_qO3s->valores_vazio()) { $_ql3y=$this->_ql9r[_qO37::_qO15][$_qO3s->busca_valor_por_indice()]; $_ql3y->_qO4c($_ql4d,$_qO4d,$_ql4e,$_qO4e,$_ql4f); $_ql4e=($_ql4e>1) ? $_ql4e-1: $_ql4e; $_qOan=$_ql3y; while (reset($_qOan->_ql3u)) $_qOan=reset($_qOan->_ql3u); $_ql4f=$_qOad-1-$_qOan->_ql4b(); $_qlao=0; if ($_ql4f<$_qla7) { $_qlao=$_qla7-$_ql4f; $_ql4f=$_qla7; } $_ql4e=min($_ql4e-$_qlao,$_qla7+$_qOa7-$_ql4f); $_qOaj=_qO59::_ql5a()->_ql4t($_ql4e)->_qO4v($_ql3y->Value)->_qO4u(_qO37::_qO39("cell expandedCell"))->_ql4w("cell expandedCell",$_ql4l)->_ql4v($_ql3y->_ql6b."Ex"); $_qOak[$_ql4f]->_qO4z($_qOaj,$_ql4d); } foreach ($_qOam as $_qO5b) { $ret=array(); for ($_qO5d=0; $_qO5d<$_qlab; $_qO5d ++) { $_qlam=$this->_ql9r[_qO37::_ql15][$_qO5d]; $_qOao=$this->_ql9r[_qO37::_qO15][$_qO5b]; $this->_ql7w($_qlam,$_qOao,$retw,$_qlap,$_qlm); $_ql3b="cell"; if ($_qlam->_ql8b()) { $_ql3b.=" totalColumn"; } if ($_qOao->_ql8b()) { $_ql3b.=" totalRow"; } for ($_qO4d=0; $_qO4d<$_qlaf; $_qO4d ++) { $_qOap=$this->_qO9r[_qO37::_ql14]->busca_valor_por_indice($_qO4d); $retx=$_qOap->_qO6q; if (! isset ($this->_ql9q[$retw][$_qlap][$_qlm][$retx])) { $_qlaq=$this->EmptyValue; $_ql3b.=" emptyDataCell"; } else { $_qlaq=$_qOap->displayformat($this->_ql9q[$retw][$_qlap][$_qlm][$retx]); $_ql3b.=" dataCell"; } $_qOaj=_qO59::_ql5a()->_qO4v($_qlaq)->_qO4u(_qO37::_qO39($_ql3b))->_ql4w($_ql3b,$_ql4l); array_push($ret,$_qOaj);   }
} $_qOak[$_qO5b]->_ql50($ret,$_qlad); } foreach ($_qOam as $_qO5b) $_qOak[$_qO5b]->_qO50(); $_qlai->_ql4z($_qOak); return $_qlai; }
function exporttohtml() { $_qla8=$this->ExportSettings; $_qO9e=$_qla8->_ql9g(); $_qOaq=$_qO9e["template"]; ob_end_clean(); header("Pragma: public"); header("Expires: 0"); header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); header("Cache-Control: public"); header("Content-Description: File Transfer"); header("Content-Type: application/force-download; charset=utf-8"); header("Content-Disposition: attachment; filename='".$_qO9e["fileName"].".html'"); header("Content-Transfer-Encoding: binary"); $_qla7=-1; $_qOa7=-1; if ( isset ($this->Pager) && !$_qla8->IgnorePaging) { $_qla7=$this->Pager->PageIndex *$this->Pager->PageSize; $_qOa7=($_qla7+$this->Pager->PageSize <$this->Pager->_ql8s) ? $this->Pager->PageSize : ($this->Pager->_ql8s -$_qla7); } $_qlai=$this->_qOa6($_qla7,$_qOa7); $_qlar=$_qlai->_qO4r().$_qlai->_ql56($_qla8->_ql9h(),$_qO9e["caseSensitive"]); $_qOar=replace("{KoolPivotTable}",$_qlar,$_qOaq); echo $_qOar; exit (); }
function exporttopdf() { error_reporting(0); if (!class_exists("TCPDF",FALSE)) { $_qlas=dirname(dirname( __FILE__)); require_once $_qlas."/library/tcpdf/config/lang/eng.php"; require_once $_qlas."/library/tcpdf/tcpdf.php"; } $_qla8=$this->ExportSettings; $_qO9e=$_qla8->_ql9g(); $_qOaq=$_qO9e["template"]; $_qOas=new tcpdf(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,TRUE,$this->_qO5p ,FALSE); $_qlat=$_qO9e["pdf"]["font"]; $_qOas->setfont($_qlat["family"],$_qlat["style"],$_qlat["size"]); $_qOas->setautopagebreak(TRUE); $_qOas->addpage($_qO9e["pdf"]["pageOrientation"],$_qO9e["pdf"]["pageDimension"]); $_qla7=-1; $_qOa7=-1; if ( isset ($this->Pager) && !$_qla8->IgnorePaging) { $_qla7=$this->Pager->PageIndex *$this->Pager->PageSize; $_qOa7=($_qla7+$this->Pager->PageSize <$this->Pager->_ql8s) ? $this->Pager->PageSize : ($this->Pager->_ql8s -$_qla7); } $_qlai=$this->_qOa6($_qla7,$_qOa7); $_qlar=$_qlai->_qO4r().$_qlai->_ql56($_qla8->_ql9h(),$_qO9e["caseSensitive"]); $_qOar=replace("{KoolPivotTable}",$_qlar,$_qOaq); ob_end_clean(); $_qOas->writehtml($_qOar,TRUE,FALSE,FALSE,FALSE,''); $_qOas->output($_qO9e["fileName"].".pdf","D"); exit (); }
function exporttoexcel() { 
	error_reporting(0); if (!class_exists("PHPExcel",FALSE)) { $_qlas=dirname(dirname( __FILE__)); require_once $_qlas.'/library/PHPExcel/Classes/PHPExcel.php'; require_once $_qlas.'/library/PHPExcel/Classes/PHPExcel/Cell.php'; require_once $_qlas.'/library/PHPExcel/Classes/PHPExcel/IOFactory.php'; } $_qla8=$this->ExportSettings; $_qO9e=$_qla8->_ql9g(); $_qOat=new phpexcel(); $_qOat->setactivesheetindex(0); $_qla7=-1; $_qOa7=-1; if ( isset ($this->Pager) && !$_qla8->IgnorePaging) { $_qla7=$this->Pager->PageIndex *$this->Pager->PageSize; $_qOa7=($_qla7+$this->Pager->PageSize <$this->Pager->_ql8s) ? $this->Pager->PageSize : ($this->Pager->_ql8s -$_qla7); } $_qlai=$this->_qOa6($_qla7,$_qOa7); $ret=$_qlai->_qO58(); $_qlau=0; $_qOau=1; foreach ($ret as $_qO5c) { foreach ($_qO5c as $_ql5e) { $_qO4=$_ql5e->_qO53($_qla8->_ql9h(),$_qO9e["caseSensitive"]); $_qO4=$_ql5e->_qO53(); if ($_qO4 != "blank") { $_qO5e=$_ql5e->_qO4s(); $_qO5g=$_ql5e->_qO4t(); $_qlav=phpexcel_cell::stringfromcolumnindex($_qlau).$_qOau; $_qOav=phpexcel_cell::stringfromcolumnindex($_qlau+$_qO5e-1).($_qOau+$_qO5g-1); $_qOat->getactivesheet()->setcellvalue($_qlav,$_qO4); if ($_qlav != $_qOav) { $_qOat->getactivesheet()->mergecells($_qlav.":".$_qOav); $_qOat->getactivesheet()->getstyle($_qlav)->getalignment()->setvertical(phpexcel_style_alignment::VERTICAL_CENTER);   }
	} $_qlau += 1; } 
	$_qOau ++; $_qlau=0; } 
	$_qOat->getactivesheet()->settitle($_qO9e["fileName"]); $_qOat->setactivesheetindex(0); 
	ob_end_clean(); header('Content-Type: application/vnd.ms-excel'); header('Content-Disposition: attachment;filename="'.$_qO9e["fileName"].'.xls"'); 
	header('Cache-Control: max-age=0'); header('Cache-Control: max-age=1'); header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
	header('Cache-Control: cache, must-revalidate'); header('Pragma: public'); $_qlaw=phpexcel_iofactory::createwriter($_qOat,'Excel5'); 
	$_qlaw->save('php://output'); exit; }
function exporttoword() { error_reporting(0); $_qla8=$this->ExportSettings; $_qO9e=$_qla8->_ql9g(); $_qOaq=$_qO9e["template"]; ob_end_clean(); header("Pragma: public"); header("Expires: 0"); header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); header("Cache-Control: public"); header("Content-Description: File Transfer"); header("Content-Type: application/msword"); header("Content-Disposition: attachment; filename='".$_qO9e["fileName"].".doc'"); header("Content-Transfer-Encoding: binary"); $_qla7=-1; $_qOa7=-1; if ( isset ($this->Pager) && !$_qla8->IgnorePaging) { $_qla7=$this->Pager->PageIndex *$this->Pager->PageSize; $_qOa7=($_qla7+$this->Pager->PageSize <$this->Pager->_ql8s) ? $this->Pager->PageSize : ($this->Pager->_ql8s -$_qla7); } $_qlai=$this->_qOa6($_qla7,$_qOa7); $_qlar=$_qlai->_qO4r().$_qlai->_ql56($_qla8->_ql9h(),$_qO9e["caseSensitive"],"'"); $_qOar=replace("{KoolPivotTable}",$_qlar,$_qOaq); echo $_qOar; exit (); }
function _ql7w($_qlam,$_qOao,&$retw,&$_qlap,&$_qlm) { $_qlap=$_qlam->_qO3t->_ql6b.$_qOao->_qO3t->_ql6b; $_qlm=$_qlam->_qO85.$_qOao->_qO85; $retw=$_qlam->_qO84->_qlm.$_qOao->_qO84->_qlm; }
function _qOaw($_qO3d,$_ql3y) { $_ql3y->_qO69($this); $_ql3y->_qO6w(); if ($this->_ql9x == _qlz::_ql34 && $_ql3y->Value == $this->_qO9w[_qlz::_qO13]) { $_ql3y->_ql8d($this->_qO9w[_qlz::_qO18]); $_ql3y->_ql8f(); } $_ql3y->_qO6y($this->_ql9t); $this->_ql9w[$_qO3d][$_ql3y->_ql6b ]=$_ql3y; return $this; }
function _qlax($_qO3d,&$_qOax) { $_qO6z=$this->DataSource; $_qO9l=$this->_qO9r[$_qO3d]; $_qlay=$_qO9l->busca_valor_por_indice(0); $_qlu=$this->Localization->_ql6e[_qlz::_qO2e]; $_qOay=_ql84::_qO89($_qlu,$_qlay); $_qlaz=$this->retu[$_qO3d]; $_qlaz->_qO3x($_qOay); $this->_qOaw($_qO3d,$_qOay); $_qO3s=new _qO3p(); $_qO3s->insere_valor_na_posicao($_qOay); array_push($_qlay->_qO6m ,$_qlaz); while (!$_qO3s->valores_vazio()) { $_ql3y=$_qO3s->busca_valor_por_indice(); $_ql4d=$_ql3y->_ql47()+2; if ($_ql4d<$_qO9l->num_valores()) { $_qO5v=$_qO9l->busca_valor_por_indice($_ql4d); $_qOaz=$_qO9l->busca_valor_por_indice($_ql4d+1); $_qlb0=$_qO9l->busca_valor_por_indice($_ql4d-1); array_push($_qO5v->_qO6m ,$_ql3y); $_qO5v->_qO4c($name,$_qO6u,$_ql6v,$_qO6v,$_qOb0); $_ql5l=$_ql3y->_qO86; $_qlb1=$_ql3y->_ql87; $_qOb1=array(); $_qlb2=FALSE; if (!empty($_qOax[$_qO5v->_qlm ][$_ql3y->_ql6b ][_qlz::_qO1x]) && !$this->_qO9u) { $_qOb2=$_qOax[$_qO5v->_qlm ]; $_ql8h=$_qOb2[$_ql3y->_ql6b ][_qlz::_qO1x]; foreach ($_ql8h as $_qlb3) { $_qOb3=$_qOb2[$_qlb3]; array_push($_qOb1,array(_qlz::_ql17 => urldecode($_qOb3[_qlz::_ql17]),_qlz::_qO1d => $_qOb3[_qlz::_qO1d],_qlz::_qO1j => $_qOb3[_qlz::_qO1j],_qlz::_ql19 => $_qOb3[_qlz::_ql19],_qlz::_qO1u => $_qOb3[_qlz::_qO1u],_qlz::_ql1v => $_qOb3[_qlz::_ql1v],_qlz::_qO1v => $_qOb3[_qlz::_qO1v]));   }
} else if ($_qO5v->_ql6q == $_qlb0->_ql6q) { foreach ($_ql3y->_qO87 as $_qlu) array_push($_qOb1,array(_qlz::_ql17 => $_qlu,_qlz::_ql19 => $_qlu)); $_qlb2=TRUE; } else { $_qO5s=array($_qO5v->_ql5q); $_qlb4=array(_qlz::_ql1w => _qO1u::_ql5k($_ql5l),_qlz::_qO1w => _qO1u::_ql5k($_qlb1)); $query=$_qO6z->_qO5w(TRUE)->_qO5x($_qO5s,$_qlb4,NULL); $_qO5a=$_qO6z->_ql64($query); foreach ($_qO5a as $fetch) array_push($_qOb1,array(_qlz::_ql17 => $fetch[$_qO6v],_qlz::_ql19 => $fetch[$_qO6v])); $_qlb2=TRUE; } foreach ($_qOb1 as $_qOb4) { $_qlu=$_qOb4[_qlz::_ql17]; if ($_qlb2) $_qlu=$_qO5v->_ql6u($_qlu); if ($_qO5v->_ql79($_qlu)) { $_ql44=$_ql3y->_ql7v($_qlu); if (empty($_ql44)) { $_ql44=_ql84::_ql89($_qlu,$_qO5v); $_ql3y->_qO3x($_ql44); if ( isset ($_qOb4[_qlz::_qO1d])) $_ql44->_qO8d($_qOb4[_qlz::_qO1d]); if ( isset ($_qOb4[_qlz::_qO1j])) $_ql44->_ql8d($_qOb4[_qlz::_qO1j]); $_ql44->_ql8e($_qOb4[_qlz::_ql19]); $this->_qOaw($_qO3d,$_ql44); $_ql44->_qO86 =_qO1u::_ql5k(); $_ql44->_ql87 =_qO1u::_ql5k(); if ($_ql4d<$_qO9l->num_valores()-1) $_ql44->_ql85 =TRUE; if ($_ql44->Expand || $_qO5v->_ql6q == $_qOaz->_ql6q) $_qO3s->insere_valor_na_posicao($_ql44); } if ($_qlb2) { $_qlb5=$_qO6z->_ql63($_qO6z->_ql62($_qOb4[_qlz::_ql17])); $_ql44->_qO86->_ql5n($_ql6v._ql3e::_ql3i.$_qlb5,_ql3e::_qO3e); $_ql44->_ql87->_ql5n($name._ql3e::_ql3i.$_qlb5,_ql3e::_qO3e); array_push($_ql44->_qO87 ,$_qOb4[_qlz::_ql17]); } else { $_ql44->_qO86 =$_qOb4[_qlz::_qO1u]; $_ql44->_ql87 =$_qOb4[_qlz::_ql1v]; $_ql44->_qO87 =$_qOb4[_qlz::_qO1v];   }
}
} foreach ($_ql3y->_ql3u as $_ql44) { if ($_ql44->_qO86 instanceof _qO1u) $_ql44->_qO86 =$_ql44->_qO86->_ql5n($_ql5l)->_qO5l(); if ($_ql44->_ql87 instanceof _qO1u) $_ql44->_ql87 =$_ql44->_ql87->_ql5n($_qlb1)->_qO5l(); } if ($this->AllowCaching) { $_qOax[$_qO5v->_qlm ][$_ql3y->_ql6b ]=$_ql3y->_qO8g(); foreach ($_ql3y->_ql3u as $_ql44) { $_qOax[$_qO5v->_qlm ][$_ql44->_ql6b ]=$_ql44->_qO8g();   }
}   }
} return $_qlaz; }
function process() { 
	$this->_qO69(); $this->_qO6w(); if (! isset ($this->_qO6l->_ql68[$this->_ql6b ])) $this->_qO9t =TRUE; $_qOn=$this->_ql9t; $_qOb5=round(microtime(TRUE)*01750); { if ( isset ($_qOn->_ql6e[$this->_ql6b ])) { $_qO5d=$_qOn->_ql6e[$this->_ql6b ]; $_ql70=$_qO5d[_qlz::_ql1d]; $ret0=$_qO5d[_qlz::_ql21]; switch ($_ql70) { case _qlz::_qO1f: if ($this->EventHandler->onbeforefieldmove($this,array()) == TRUE) { $_qlb6=_qO37::$_ql38[strtolower($ret0[_qlz::_qO26])]; $_qOb6=_qO37::$_ql38[strtolower($ret0[_qlz::_ql27])]; $_qO5v=$this->_qO9r[$_qlb6]->remove_valor_no_indice($ret0[_qlz::_qO27]); $this->_qO9r[$_qOb6]->insere_valor_na_posicao($_qO5v,$ret0[_qlz::_ql28]); $this->EventHandler->onfieldmove($this,array()); } break; case _qlz::_ql1f: if ($this->EventHandler->_qlb7($this,array()) == TRUE) { $this->_qO9t =TRUE; $this->EventHandler->onrefresh($this,array()); } break; case _qlz::_qO2u: if ($this->EventHandler->_qO9c($this,array()) == TRUE) { if ($ret0[_qlz::_ql2v] == _qlz::_qO2v) $this->_qO9v =$this->_qO9r[_qO37::_ql14]->busca_valor_por_indice(0); $this->EventHandler->_ql9d($this,array()); } break;   }
}
} $_qOb7=round(microtime(TRUE)*01750); $_qO6z=$this->DataSource; foreach (_qO37::$_ql38 as $_qO3d) { $this->_qO9r[$_qO3d]->_qO9o()->_qO9p(); $obj_valores[$_qO3d]=$this->_qO9r[$_qO3d]->slice_valores(); } $_qlb8=$obj_valores[_qO37::_ql15]; $_qOb8=$obj_valores[_qO37::_qO15]; $_qlb9=$obj_valores[_qO37::_ql14]; $_qOb5=round(microtime(TRUE)*01750); { $_qOb9=NULL; $this->_qO9q =array(); $this->_ql9q =array(); if ($this->AllowCaching) { $_qOb2=new _ql6h($this->CacheFolder ,$this->CacheTime); $_qOb2->_ql6b =$this->_ql9v; if (!$this->_qO9t) { $_qOb9=$_qOb2->_ql6k(_qlz::_qO1c); if ( isset ($_qOb9[_qlz::_qO1g]) && (!$this->_ql73)) { $_qlba=$_qOb9[_qlz::_qO1g]; foreach (_qO37::$_ql38 as $_qO3d) if ($_qO3d != _qO37::_ql14) foreach ($obj_valores[$_qO3d] as $_qO5v) $_qO5v->_ql77($_qlba[$_qO5v->_ql6b ]); } else $this->_ql73 =TRUE; if (!$this->_ql73) { if ( isset ($_qOb9[_qlz::_ql1g])) $this->_qO9q =$_qOb9[_qlz::_ql1g];   }
}
} else $this->_qO9t =TRUE; } $_qOb7=round(microtime(TRUE)*01750); foreach (_qO37::$_ql38 as $_qO3d) foreach ($obj_valores[$_qO3d] as $_qO5v) $_qO5v->_qO6y($_qOn); $_qOb5=round(microtime(TRUE)*01750); { if ($this->_qO9t) { $_qO6z->_qO5p =$this->_qO5p; $this->_ql73 =TRUE; } if ($this->_ql73) { if ( isset ($_qOb9[_qlz::_qO1h])) $_qOb9[_qlz::_qO1h]=NULL; $this->_qO9q =NULL;   }
} $_qOb7=round(microtime(TRUE)*01750); $_qOb5=round(microtime(TRUE)*01750); { if (! isset ($_qOb9[_qlz::_qO1h])) $_qOb9[_qlz::_qO1h]=array(); foreach (array(_qO37::_ql15,_qO37::_qO15) as $_qO3d) $this->_qlax($_qO3d,$_qOb9[_qlz::_qO1h]); } $_qOb7=round(microtime(TRUE)*01750); foreach (array(_qO37::_ql15,_qO37::_qO15) as $_qO3d) { $_qOba[$_qO3d]=$this->retu[$_qO3d]->_ql7v(0); } $_ql7u=$_qOba[_qO37::_ql15]; $retv=$_qOba[_qO37::_qO15]; $_qOb5=round(microtime(TRUE)*01750); { $_qlbb=array(); $_qObb=array(); foreach (_qO37::$_ql38 as $_qO3d) if ($_qO3d != _qO37::_ql14) foreach ($obj_valores[$_qO3d] as $_qO5v) if ($_qO5v->ret5()) array_push($_qlbb,$_qO5v->_ql5q); foreach ($_qlb9 as $_qO5v) array_push($_qObb,$_qO5v->_ql5q); foreach ($_qlb8 as $_qO5d => $_qlbc) foreach ($_qOb8 as $_qO5b => $_qObc) { $retw=$_qlbc->_qlm.$_qObc->_qlm; $_qlbd=array(); $_qObd=array(); for ($_ql5h=1; $_ql5h<=$_qO5d; $_ql5h ++) array_push($_qlbd,$_qlb8[$_ql5h]->_ql5q); for ($_ql5h=1; $_ql5h<=$_qO5b; $_ql5h ++) array_push($_qObd,$_qOb8[$_ql5h]->_ql5q); $_qlbe=array(); $_qObe=array(); foreach (array($_qlbb,$_qlbd,$_qObd) as $_qlbf) foreach ($_qlbf as $_ql5q) if (!in_array($_ql5q[_qlz::_ql18],$_qObe)) { array_push($_qObe,$_ql5q[_qlz::_ql18]); array_push($_qlbe,$_ql5q); } $_qObf=array_merge($_qlbe,$_qObb); $_qlbg=FALSE; $_qObg=_qO1u::_ql5k(); $_qlbh=_qO1u::_ql5k(); foreach ($_qlbc->_qO6m as $_qObh) foreach ($_qObc->_qO6m as $_qlbi) { $_qlap=$_qObh->_ql6b.$_qlbi->_ql6b; if (! isset ($this->_qO9q[$retw][$_qlap])) { $_qObg->_ql5n(_qO1u::_ql5k($_qObh->_qO86)->_ql5n($_qlbi->_qO86),_ql3e::_qO3e); $_qlbh->_ql5n(_qO1u::_ql5k($_qObh->_ql87)->_ql5n($_qlbi->_ql87),_ql3e::_qO3e); $_qlbg=TRUE;   }
} if ($_qlbg) { $_ql5y=array(_qlz::_ql1w => $_qObg,_qlz::_qO1w => $_qlbh); $query=$_qO6z->_qO5w(FALSE)->_qO5x($_qObf,$_ql5y,$_qlbe); $_ql5d=0; $_ql5u=$_qO6z->getquerysize(); while (TRUE) { if ($_ql5u == 0) { $_qO5a=$_qO6z->_ql64($query); $_ql5u=PHP_INT_MAX; } else if ($_ql5u>0) { $_qO5a=$_qO6z->_ql65($query,$_ql5d,$_ql5u); $_ql5d += $_ql5u; } $_qOb5=round(microtime(TRUE)*01750); foreach ($_qO5a as $fetch) { $_ql75=TRUE; foreach ($_qlbb as $_qObi) { $rety=$_qObi[_qlz::class_field]; $_qlu=$rety->_ql6u($fetch[$_qObi[_qlz::_ql18]]); if (!$rety->_ql79($_qlu)) { $_ql75=FALSE; break;   }
} if ($_ql75) { $_qlam=$_ql7u; foreach ($_qlbd as $_qlbj) { $rety=$_qlbj[_qlz::class_field]; $_qlu=$rety->_ql6u($fetch[$_qlbj[_qlz::_ql18]]); $_qlam=$_qlam->_ql7v($_qlu); } $_qOao=$retv; foreach ($_qObd as $_qObj) { $rety=$_qObj[_qlz::class_field]; $_qlu=$rety->_ql6u($fetch[$_qObj[_qlz::_ql18]]); $_qOao=$_qOao->_ql7v($_qlu); } if ( isset ($_qlam) && isset ($_qOao)) { $_qlbk=array($_qlam); $_ql5h=$_qO5d+1; while ( isset ($_qlb8[$_ql5h]) && $_qlb8[$_ql5h]->_ql6q == $_qlbc->_ql6q) { $_ql5q=end($_qObd); $_qlu=$_qlb8[$_ql5h]->_ql6u($fetch[$_ql5q[_qlz::_ql18]]); $_qlam=$_qlam->_ql7v($_qlu); array_push($_qlbk,$_qlam); $_ql5h ++; } $_qObk=array($_qOao); $_ql5h=$_qO5b+1; while ( isset ($_qOb8[$_ql5h]) && $_qOb8[$_ql5h]->_ql6q == $_qObc->_ql6q) { $_ql5q=end($_qObd); $_qlu=$_qOb8[$_ql5h]->_ql6u($fetch[$_ql5q[_qlz::_ql18]]); $_qOao=$_qOao->_ql7v($_qlu); array_push($_qObk,$_qOao); $_ql5h ++; } foreach ($_qlbk as $_qlam) foreach ($_qObk as $_qOao) { foreach ($_qObb as $_qlbl) { $this->_qObl($_qlam,$_qOao,$_qlbl[_qlz::_ql18],0); $rety=$_qlbl[_qlz::class_field]; $_qlu=$rety->_ql6u($fetch[$_qlbl[_qlz::_ql18]]); $this->_qlbm($_qlam,$_qOao,$_qlbl[_qlz::_ql18],$_qlu);   }
}   }
}
} $_qOb7=round(microtime(TRUE)*01750); if (count($_qO5a)<$_ql5u) break;   }
}
} $this->_ql9q =$this->_qO9q; foreach ($_qlb9 as $_qOap) $this->_ql9q =$_qOap->_ql7s($this->_ql9q); } $_qOb7=round(microtime(TRUE)*01750); foreach (array(_qO37::_ql15,_qO37::_qO15) as $_qO3d) $this->_ql9r[$_qO3d]=$_qOba[$_qO3d]->_qO8j(); $_qOb5=round(microtime(TRUE)*01750); if ($this->AllowSorting || $this->AllowSortingData) { $_qObm=array(_qO37::_qO15 => FALSE,_qO37::_ql15 => FALSE); $_qlbn=array(_qO37::_qO15 => FALSE,_qO37::_ql15 => FALSE); if ( isset ($this->_ql72)) { $this->_qObn($this->_ql72); $_qObm[$this->_ql72 ]=TRUE; } if (!empty($this->ret1)) foreach ($this->ret1 as $_qO3d => $_ql8g) if (!empty($_ql8g)) { $_qlbo=_qO37::_qOz($_qO3d); if ( isset ($this->_ql9w[$_qO3d][$_ql8g[_qlz::_ql1x]])) { $_ql3y=$this->_ql9w[$_qO3d][$_ql8g[_qlz::_ql1x]]; $this->_qObo($_qlbo,$_ql3y); $_qObm[$_qlbo]=TRUE; } $_qlbn[$_qlbo]=TRUE; $_qOba[$_qlbo]->_ql8i($_ql8g[_qlz::_qO18]); } foreach ($_qlbn as $_qO3d => $_qlbp) if ($_qlbp == FALSE) { foreach ($obj_valores[$_qO3d] as $_qO5v) $_qO5v->_ql6l =TRUE; $_qOba[$_qO3d]->_qO8i(); } foreach ($_qlb8 as $_qO5d => $_qlbc) $_qlbc->ret9(); foreach ($_qOb8 as $_qO5b => $_qObc) $_qObc->ret9(); } $_qOb7=round(microtime(TRUE)*01750); foreach (array(_qO37::_ql15,_qO37::_qO15) as $_qO3d) $this->_ql9r[$_qO3d]=$_qOba[$_qO3d]->_qO8j(); foreach ($this->_ql9r[_qO37::_ql15] as $_qlam) foreach ($this->_ql9r[_qO37::_qO15] as $_qOao) { foreach ($_qObb as $_qlbl) { if ($_qlam->_ql8b()) { $this->_qObp($_qlam,$_qOao,$_qlbl[_qlz::_ql18],0); $_qla4=$_qlam->_qO8b(); foreach ($_qla4 as $_ql44) { $_qlu=$this->_ql4n($_ql44,$_qOao,$_qlbl[_qlz::_ql18]); $this->_qlbm($_qlam,$_qOao,$_qlbl[_qlz::_ql18],$_qlu);   }
} else if ($_qOao->_ql8b()) { $this->_qObp($_qlam,$_qOao,$_qlbl[_qlz::_ql18],0); $_qla4=$_qOao->_qO8b(); foreach ($_qla4 as $_ql44) { $_qlu=$this->_ql4n($_qlam,$_ql44,$_qlbl[_qlz::_ql18]); $this->_qlbm($_qlam,$_qOao,$_qlbl[_qlz::_ql18],$_qlu);   }
}
} $this->_ql9q =$this->_qO9q; foreach ($_qlb9 as $_qOap) $this->_ql9q =$_qOap->_ql7s($this->_ql9q); } $_qOb5=round(microtime(TRUE)*01750); if ($this->AllowCaching) { $_qlba=array(); foreach (_qO37::$_ql38 as $_qO3d) if ($_qO3d != _qO37::_ql14) foreach ($obj_valores[$_qO3d] as $_qO5v) $_qlba[$_qO5v->_ql6b ]=$_qO5v->ret8(); $_qOb9[_qlz::_qO1g]=$_qlba; foreach ($_qlb8 as $_qlbc) foreach ($_qOb8 as $_qObc) { $retw=$_qlbc->_qlm.$_qObc->_qlm; if ( isset ($this->_qO9q[$retw])) $_qOb9[_qlz::_ql1g][$retw]=$this->_qO9q[$retw]; } $_qOb2->_qO6j(_qlz::_qO1c,$_qOb9); } $_qOb7=round(microtime(TRUE)*01750); $_qOb5=round(microtime(TRUE)*01750); if ( isset ($this->Pager)) { $this->Pager->_ql8s =$_qOba[_qO37::_qO15]->_ql4a()-1; $this->Pager->_qO6y($_qOn); } $this->ret4(); $_qOb7=round(microtime(TRUE)*01750); }
function _qObl($_qlam,$_qOao,$_qlbq,$_qlu) { $this->_ql7w($_qlam,$_qOao,$retw,$_qlap,$_qlm); if (! isset ($this->_qO9q[$retw][$_qlap][$_qlm][$_qlbq])) $this->_qO9q[$retw][$_qlap][$_qlm][$_qlbq]=$_qlu; return $this; }
function _qObp($_qlam,$_qOao,$_qlbq,$_qlu) { $this->_ql7w($_qlam,$_qOao,$retw,$_qlap,$_qlm); $this->_qO9q[$retw][$_qlap][$_qlm][$_qlbq]=$_qlu; return $this; }
function _qlbm($_qlam,$_qOao,$_qlbq,$_qlu) { $this->_ql7w($_qlam,$_qOao,$retw,$_qlap,$_qlm); $this->_qO9q[$retw][$_qlap][$_qlm][$_qlbq] += $_qlu; return $this; }
function _ql4n($_qlam,$_qOao,$_qlbq) { $this->_ql7w($_qlam,$_qOao,$retw,$_qlap,$_qlm); if ( isset ($this->_qO9q[$retw][$_qlap][$_qlm][$_qlbq])) return $this->_qO9q[$retw][$_qlap][$_qlm][$_qlbq]; else return 0; }
function _qObq($_qO5b,$_qO5d,$_qO4d) { $ret=array(); $_qObk=$this->_qla3($_qO5b[0],$_qO5b[1]); $_qlbk=$this->_qla3($_qO5d[0],$_qO5d[1]); $_qOag=$this->busca_valor_por_fieldname(_qO37::_ql14,$_qO4d); $_qO4j=$_qOag->_ql5q; foreach ($_qlbk as $_qlam) { $_qlbr=array(); foreach ($_qObk as $_qOao) { $_qlu=$this->_ql4n($_qlam,$_qOao,$_qO4j[_qlz::_ql18]); array_push($_qlbr,$_qlu); } array_push($ret,$_qlbr); } return $ret; }
function _qObn($_qObr) { foreach ($this->_ql9r[$_qObr] as $_ql3y) $_ql3y->_ql8e($_ql3y->Value); }
function _qObo($_qObr,$_ql8g) { foreach ($this->_ql9r[$_qObr] as $_ql3y) { if ($_qObr == _qO37::_ql15) { $_qlam=$_ql3y; $_qOao=$_ql8g; } else if ($_qObr == _qO37::_qO15) { $_qlam=$_ql8g; $_qOao=$_ql3y; } else return FALSE; $this->_ql7w($_qlam,$_qOao,$retw,$_qlap,$_qlm); if (empty($this->_qO9v)) $this->_qO9v =$this->_qO9r[_qO37::_ql14]->busca_valor_por_indice(0); $retx=$this->_qO9v->_qO6q; if ( isset ($this->_ql9q[$retw][$_qlap][$_qlm][$retx])) $_ql3y->_qls =$this->_ql9q[$retw][$_qlap][$_qlm][$retx]; else $_ql3y->_qls =0;   }
}
function _filterzone() { $retb="<div id='{id}_filterzone' class='kptFilterZoneDiv'>{items}</div>"; $_ql7p="<span class='kptDesc'>{text}</span>"; $ret7=""; foreach ($this->_qO9r[_qO37::_qO14]->slice_valores() as $_qO5v) { $ret7.=$_qO5v->_ql7o(); } if ($ret7 != "") { $_qOh=replace("{items}",$ret7,$retb); } else { $_qObs=replace("{text}",$this->Localization->_qO6e[_qlz::_qO2p],$_ql7p); $_qOh=replace("{items}",$_qObs,$retb); } $_qOh=replace("{id}",$this->_ql6b ,$_qOh); return $_qOh; }
function _columnzone() { $retb="<div id='{id}_columnzone' class='kptColumnZoneDiv'>{items}</div>"; $_ql7p="<span class='kptDesc'>{text}</span>"; $ret7=""; foreach ($this->_qO9r[_qO37::_ql15]->slice_valores(1) as $_qO5v) { $ret7.=$_qO5v->_ql7o(); } if ($ret7 != "") { $_qOh=replace("{items}",$ret7,$retb); } else { $_qObs=replace("{text}",$this->Localization->_qO6e[_qlz::_qO2o],$_ql7p); $_qOh=replace("{items}",$_qObs,$retb); } $_qOh=replace("{id}",$this->_ql6b ,$_qOh); return $_qOh; }
function _rowzone() { $retb="<div id='{id}_rowzone' class='kptRowZoneDiv'><table cellspacing='0'style='border:0px;'><tbody>{items}</tbody></table></div>"; $_ql7p="<span class='kptDesc'>{text}</span>"; $retf="<td>{field}</td>"; $ret7=""; foreach ($this->_qO9r[_qO37::_qO15]->slice_valores(1) as $_qO5v) { $_ql78=replace("{field}",$_qO5v->_ql7o(),$retf); $ret7.=$_ql78; } if ($ret7 != "") { $_qOh=replace("{items}",$ret7,$retb); } else { $_qObs=replace("{text}",$this->Localization->_qO6e[_qlz::_ql2p],$_ql7p); $_qOh=replace("{items}",$_qObs,$retb); } $_qOh=replace("{id}",$this->_ql6b ,$_qOh); return $_qOh; }
function _datazone() { $retb="<div id='{id}_datazone' class='kptDataZoneDiv'>{items}</div>"; $_ql7p="<span class='kptDesc'>{text}</span>"; $ret7=""; foreach ($this->_qO9r[_qO37::_ql14]->slice_valores() as $_qO5v) { $ret7.=$_qO5v->_ql7o(TRUE); } if ($ret7 != "") { $_qOh=replace("{items}",$ret7,$retb); } else { $_qObs=replace("{text}",$this->Localization->_qO6e[_qlz::_ql2q],$_ql7p); $_qOh=replace("{items}",$_qObs,$retb); } $_qOh=replace("{id}",$this->_ql6b ,$_qOh); return $_qOh; }


function _qObu() { $retb="<div class='kptColumnHeaderDiv'><table class='kptTable' cellspacing='0' style='table-layout: auto;'><colgroup>{cols}</colgroup><tbody>{trs}</tbody></table></div>"; $_qlbv="<tr>{tds}</tr>"; $_qObv="<td{id} class='kptColumnHeader{wraptext}'{colspan}{rowspan}>{text}</td>"; $_qlbw="<td class='kptColumnHeaderTotal{wraptext}'{colspan}{rowspan}>{text}</td>"; $_qObw="<td {id} class='kptColumnHeaderTotal{wraptext}'{colspan}{rowspan}>{text}{sort}</td>"; $_qlbx="<col/>"; $_qObx="<tr class='kptDimensionRow'>{tds}</tr>"; $_qlby="<td></td>"; $_qOby=$this->retu[_qO37::_ql15]->_ql7v(0); $_qlbz=$_qOby->_qO48(); $_qObz=$_qOby->_ql4a(); $_qlc0=$this->_qO9r[_qO37::_ql14]->num_valores(); $_qOak=array(); for ($_qlb=0; $_qlb<$_qlbz; $_qlb ++) { array_push($_qOak,$_qlbv); } $_qOc0=""; if ($_qlc0>1) { $_qOc0=$_qlbv; } $_qlc1=$this->_ql9r[_qO37::_ql15]; $_qO5c=""; for ($_qlb=0; $_qlb<count($_qlc1); $_qlb ++) { if ($_qlc1[$_qlb]->_qO84->FieldName == _qlz::_qO12) { $_qOc1=replace("{text}",$_qlc1[$_qlb]->_qO8l(),$_qObw); $_qOc1=replace("{rowspan}",($_qlbz>1) ? " rowspan='{rowspan}'": "",$_qOc1); $_qOc1=replace("{rowspan}",$_qlbz,$_qOc1); $_qOc1=replace("{wraptext}",$_qlc1[$_qlb]->_qO84->HeaderTextWrap ? "": " kptNoWrap",$_qOc1); $_qOc1=replace("{id}"," id='{id}'",$_qOc1); $_qOc1=replace("{id}",$_qOby->_ql6b ,$_qOc1); $_ql7q="<span class='kptSortButton kptSort{direction}{status}' title='{tooltip}' onclick='pivot_group_sort_toggle(this)'></span>"; if ($this->AllowSortingData) { switch (strtolower($_qOby->_ql88)) { case _qlz::_qO10: $retq=replace("{direction}","Asc",$_ql7q); $retq=replace("{tooltip}",$this->Localization->_qO6e[_qlz::_qO2s],$retq); break; case _qlz::_ql11: $retq=replace("{direction}","Desc",$_ql7q); $retq=replace("{tooltip}",$this->Localization->_qO6e[_qlz::_ql2t],$retq); break; case _qlz::_ql1y: default : $retq=replace("{direction}","Asc",$_ql7q); $retq=replace("{tooltip}",$this->Localization->_qO6e[_qlz::_qO2s],$retq); break; } $_ql7r="Off"; if (!empty($this->ret1)) foreach ($this->ret1 as $_qO3d => $_ql8g) if (!empty($_ql8g) && $_ql8g[_qlz::_ql1x] == $_qOby->_ql6b) $_ql7r="On"; $retq=replace("{status}",$_ql7r,$retq); } else $retq=""; $_qOc1=replace("{sort}",$this->AllowSortingData ? $retq: "",$_qOc1); if ($_qlc0>1) { $_qOc1=replace("{colspan}"," colspan='{colspan}'",$_qOc1); $_qOc1=replace("{colspan}",$_qlc0,$_qOc1); } else { $_qOc1=replace("{colspan}","",$_qOc1); } if (! isset ($_qOak[0])) { array_push($_qOak,$_qlbv); } $_qOak[0]=replace("{tds}",$_qOc1,$_qOak[0]); } else { $_qlc2=$_qlc1[$_qlb]->_ql4a(); $_qOc2=$_qlc1[$_qlb]->_qO48(); $_qO8k=$_qlc1[$_qlb]->_ql47(); $_qOaj=replace("{id}"," id='{id}'",$_qObv); $_qOaj=replace("{id}",$_qlc1[$_qlb]->_ql6b ,$_qOaj); $_qOaj=replace("{text}",$_qlc1[$_qlb]->_qO8l(),$_qOaj); $_qOaj=replace("{wraptext}",$_qlc1[$_qlb]->_qO84->HeaderTextWrap ? "": " kptNoWrap",$_qOaj); if ($_qlc0>1) { $_qOaj=replace("{colspan}"," colspan='{colspan}'",$_qOaj); $_qOaj=replace("{colspan}",(($_qlc2>1) ? $_qlc2-1: $_qlc2)*$_qlc0,$_qOaj); } else { $_qOaj=replace("{colspan}",($_qlc2>1) ? " colspan='{colspan}'": "",$_qOaj); $_qOaj=replace("{colspan}",$_qlc2-1,$_qOaj); } if ($_qO8k<$_qlbz-1&$_qlc2<=1) { $_qOaj=replace("{rowspan}"," rowspan='{rowspan}'",$_qOaj); $_qOaj=replace("{rowspan}",$_qlbz-$_qO8k,$_qOaj); } else { $_qOaj=replace("{rowspan}","",$_qOaj); } $_qOak[$_qO8k]=replace("{tds}",$_qOaj."{tds}",$_qOak[$_qO8k]); if ($_qlc2>1) { $_qOal=replace("{text}",$_qlc1[$_qlb]->_ql8n(),$_qlbw); $_qOal=replace("{wraptext}",$_qlc1[$_qlb]->_qO84->HeaderTextWrap ? "": " kptNoWrap",$_qOal); $_qOal=replace("{rowspan}"," rowspan='{rowspan}'",$_qOal); $_qOal=replace("{rowspan}",$_qlbz,$_qOal); if ($_qlc0>1) { $_qOal=replace("{colspan}"," colspan='{colspan}'",$_qOal); $_qOal=replace("{colspan}",$_qlc0,$_qOal); } else { $_qOal=replace("{colspan}","",$_qOal); } $_qOak[$_qO8k]=replace("{tds}",$_qOal."{tds}",$_qOak[$_qO8k]);   }
} if ($_qlc0>1) { $_qlc3=""; 
for ($_qOc3=0; $_qOc3<$_qlc0; $_qOc3 ++) { 
	$_ql7q="<span class='kptSortButton kptSort{direction}' title='{tooltip}' onclick='pivot_group_sort_toggle(this)'></span>"; 
	$campo_valor = $this->_qO9r[_qO37::_ql14]->busca_valor_por_indice($_qOc3);
	$_qlc4= $campo_valor->renderheadertotal($_qlc1[$_qlb]->Value,$campo_valor->FieldName); 

$_qOaj=replace("{id}"," id='{id}'",$_qObv); $_qOaj=replace("{id}",$_qlc1[$_qlb]->_ql6b.$_qlc4,$_qOaj); $_qOaj=replace("{colspan}","",$_qOaj); $_qOaj=replace("{rowspan}","",$_qOaj); $_qOaj=replace("{text}",$_qlc4,$_qOaj); $_qlc3.=$_qOaj; $_qO5c.=$_qlbx; } $_qOc0=replace("{tds}",$_qlc3."{tds}",$_qOc0); } else { $_qO5c.=$_qlbx;   }
} $_qOc4=""; for ($_qlb=0; $_qlb<$_qObz*$_qlc0; $_qlb ++) { $_qOc4.=$_qlby; } $_qlc5=replace("{tds}",$_qOc4,$_qObx); for ($_qlb=0; $_qlb<$_qlbz; $_qlb ++) { $_qOak[$_qlb]=replace("{tds}","",$_qOak[$_qlb]); } $_qOc0=replace("{tds}","",$_qOc0); $_qOh=replace("{trs}",implode("",$_qOak).$_qOc0.$_qlc5,$retb); $_qOh=replace("{cols}",$_qO5c,$_qOh); return $_qOh; }
function _qOc5() { $retb="<div class='kptRowHeaderDiv'{minwidth}><table class='kptTable' cellspacing='0' ><colgroup>{cols}</colgroup><tbody>{trs}</tbody></table></div>"; $_qlbv="<tr>{tds}</tr>"; $_qObv="<td id='{id}' class='kptRowHeader{wraptext}'{colspan}{rowspan}>{text}</td>"; $_qlbw="<td class='{class}{wraptext}' scope='col'{colspan}{rowspan}>{text}</td>"; $_qObw="<td id='{id}' class='{class}{wraptext}' scope='col'{colspan}{rowspan}>{text}{sort}</td>"; $_qlbx="<col/>"; $_qOby=$this->retu[_qO37::_qO15]->_ql7v(0); $_qlbz=$_qOby->_qO48(); $_qObz=$_qOby->_ql4a(); $_qlc0=$this->_qO9r[_qO37::_ql14]->num_valores(); $_qlc6=$this->_ql9r[_qO37::_qO15]; $_qla7=0; $_qOa7=count($_qlc6)-1; if ( isset ($this->Pager)) { $_qla7=$this->Pager->PageIndex *$this->Pager->PageSize; $_qOa7=($_qla7+$this->Pager->PageSize <$this->Pager->_ql8s) ? $this->Pager->PageSize : ($this->Pager->_ql8s -$_qla7); } $_qOak=array(); for ($_qlb=0; $_qlb<$_qOa7; $_qlb ++) { array_push($_qOak,$_qlbv); } $_qOc6=array(); $_qO5c=""; for ($_qlc7=0; $_qlc7<$_qlbz; $_qlc7 ++) { $_qOc7=0; for ($_qlc8=0; $_qlc8<count($_qlc6)-1; $_qlc8 ++) { $_qlc2=$_qlc6[$_qlc8]->_ql4a(); $_qOc2=$_qlc6[$_qlc8]->_qO48(); $_qO8k=$_qlc6[$_qlc8]->_ql47(); if ($_qO8k == $_qlc7) { if ($_qlc2>1) { if ($_qOc7>=$_qla7 && $_qOc7<$_qla7+$_qOa7) { $_qOaj=replace("{id}",$_qlc6[$_qlc8]->_ql6b ,$_qObv); $_qOaj=replace("{text}",$_qlc6[$_qlc8]->_qO8l(),$_qOaj); $_qOaj=replace("{wraptext}",$_qlc6[$_qlc8]->_qO84->HeaderTextWrap ? "": " kptNoWrap",$_qOaj); $_qOaj=replace("{colspan}","",$_qOaj); $_qOaj=replace("{rowspan}"," rowspan='{rowspan}'",$_qOaj); $_qOaj=replace("{rowspan}",($_qOc7+$_qlc2-1<$_qla7+$_qOa7) ? ($_qlc2-1): ($_qla7+$_qOa7-$_qOc7),$_qOaj); $_qOak[$_qOc7-$_qla7]=replace("{tds}",$_qOaj."{tds}",$_qOak[$_qOc7-$_qla7]); } else if ($_qOc7<$_qla7 && $_qOc7+$_qlc2-1>$_qla7) { $_qOaj=replace("{id}",$_qlc6[$_qlc8]->_ql6b ,$_qObv); $_qOaj=replace("{text}",$_qlc6[$_qlc8]->_qO8l(),$_qOaj); $_qOaj=replace("{wraptext}",$_qlc6[$_qlc8]->_qO84->HeaderTextWrap ? "": " kptNoWrap",$_qOaj); $_qOaj=replace("{colspan}","",$_qOaj); $_qOaj=replace("{rowspan}"," rowspan='{rowspan}'",$_qOaj); $_qOaj=replace("{rowspan}",($_qOc7+$_qlc2-1<$_qla7+$_qOa7) ? ($_qOc7+$_qlc2-1-$_qla7): ($_qOa7),$_qOaj); $_qOak[0]=replace("{tds}",$_qOaj."{tds}",$_qOak[0]); } $_qOc7 += ($_qlc2-1); if ($_qOc7>=$_qla7 && $_qOc7<$_qla7+$_qOa7) { $_qOal=replace("{text}",$_qlc6[$_qlc8]->_ql8n(),$_qlbw); $_qOal=replace("{wraptext}",$_qlc6[$_qlc8]->_qO84->HeaderTextWrap ? "": " kptNoWrap",$_qOal); $_qOal=replace("{rowspan}","",$_qOal); $_qOal=replace("{colspan}"," colspan='{colspan}'",$_qOal); $_qOal=replace("{colspan}",$_qlbz,$_qOal); +$_qOal=replace("{class}","kptRowHeaderTotal",$_qOal); $_qOak[$_qOc7-$_qla7]=replace("{tds}",$_qOal,$_qOak[$_qOc7-$_qla7]); } $_qOc6[$_qOc7]=1; $_qOc7 ++; } else { while ( isset ($_qOc6[$_qOc7])) { $_qOc7 ++; } if ($_qOc7>=$_qla7 && $_qOc7<$_qla7+$_qOa7) { $_qOaj=replace("{id}",$_qlc6[$_qlc8]->_ql6b ,$_qObv); $_qOaj=replace("{text}",$_qlc6[$_qlc8]->_qO8l(),$_qOaj); $_qOaj=replace("{wraptext}",$_qlc6[$_qlc8]->_qO84->HeaderTextWrap ? "": " kptNoWrap",$_qOaj); $_qOaj=replace("{rowspan}","",$_qOaj); $_qOaj=replace("{colspan}"," colspan='{colspan}'",$_qOaj); $_qOaj=replace("{colspan}",$_qlbz-$_qO8k,$_qOaj); $_qOak[$_qOc7-$_qla7]=replace("{tds}",$_qOaj."{tds}",$_qOak[$_qOc7-$_qla7]); } $_qOc6[$_qOc7]=1; $_qOc7 ++;   }
} elseif ($_qO8k<$_qlc7) { $_qOc7 ++;   }
} $_qO5c.=$_qlbx; } for ($_qlb=0; $_qlb<$_qOa7; $_qlb ++) { $_qOak[$_qlb]=replace("{tds}","",$_qOak[$_qlb]); } $_qOc8=replace("{tds}",$_qObw,$_qlbv); $_qOc8=replace("{rowspan}","",$_qOc8); $_qOc8=replace("{colspan}"," colspan='{colspan}'",$_qOc8); $_qOc8=replace("{colspan}",$_qlbz,$_qOc8); $_qOc8=replace("{class}","kptRowHeaderGrandTotal",$_qOc8); $_qOc8=replace("{text}",$_qOby->_qO8l(),$_qOc8); $_qOc8=replace("{id}",$_qOby->_ql6b ,$_qOc8); $_ql7q="<span class='kptSortButton kptSort{direction}{status}' title='{tooltip}' onclick='pivot_group_sort_toggle(this)'></span>"; if ($this->AllowSortingData) { switch (strtolower($_qOby->_ql88)) { case _qlz::_qO10: $retq=replace("{direction}","Asc",$_ql7q); $retq=replace("{tooltip}",$this->Localization->_qO6e[_qlz::_qO2s],$retq); break; case _qlz::_ql11: $retq=replace("{direction}","Desc",$_ql7q); $retq=replace("{tooltip}",$this->Localization->_qO6e[_qlz::_ql2t],$retq); break; case _qlz::_ql1y: default : $retq=replace("{direction}","Asc",$_ql7q); $retq=replace("{tooltip}",$this->Localization->_qO6e[_qlz::_qO2s],$retq); break; } $_ql7r="Off"; if (!empty($this->ret1)) foreach ($this->ret1 as $_qO3d => $_ql8g) { if (!empty($_ql8g) && $_ql8g[_qlz::_ql1x] == $_qOby->_ql6b) $_ql7r="On"; } $retq=replace("{status}",$_ql7r,$retq); } else $retq=""; $_qOc8=replace("{sort}",$this->AllowSortingData ? $retq: "",$_qOc8); $_qOh=replace("{trs}",implode("",$_qOak).$_qOc8,$retb); $_qOh=replace("{cols}",$_qO5c,$_qOh); $_qOh=replace("{minwidth}",($this->Appearance->RowHeaderMinWidth !== NULL) ? " style='min-width:".$this->Appearance->RowHeaderMinWidth."'": "",$_qOh); return $_qOh; }
function _qlc9() { $retb="<div class='kptContentDiv'><table cellspacing='0' class='kptTable' style='table-layout: auto;'><colgroup>{cols}</colgroup><tbody>{trs}</tbody></table></div>"; $_qlbv="<tr>{tds}</tr>"; $_qObv="<td class='kptDataCell{css}'>{text}</td>"; $_qlbx="<col />"; $_qOc9=$this->_ql9r[_qO37::_ql15]; $_qlca=$this->_ql9r[_qO37::_qO15]; $_qla7=0; $_qOa7=count($_qlca)-1; if ( isset ($this->Pager)) { $_qla7=$this->Pager->PageIndex *$this->Pager->PageSize; $_qOa7=($_qla7+$this->Pager->PageSize <$this->Pager->_ql8s) ? $this->Pager->PageSize : ($this->Pager->_ql8s -$_qla7); } $_qO5c=""; for ($_qlc7=0; $_qlc7<count($_qOc9)*$this->_qO9r[_qO37::_ql14]->num_valores(); $_qlc7 ++) { $_qO5c.=$_qlbx; } $_qOak=""; for ($_qlc8=$_qla7; $_qlc8<$_qla7+$_qOa7+1; $_qlc8 ++) { if ($_qlc8 == $_qla7+$_qOa7) { $_qlc8=count($_qlca)-1; } $_qlc3=""; for ($_qlc7=0; $_qlc7<count($_qOc9); $_qlc7 ++) { $this->_ql7w($_qOc9[$_qlc7],$_qlca[$_qlc8],$retw,$_qlap,$_qlm); for ($_qlb=0; $_qlb<$this->_qO9r[_qO37::_ql14]->num_valores(); $_qlb ++) { $_qOap=$this->_qO9r[_qO37::_ql14]->busca_valor_por_indice($_qlb); $retx=$_qOap->_qO6q; $_qlu=( isset ($this->_ql9q[$retw][$_qlap][$_qlm][$retx])) ? $_qOap->displayformat($this->_ql9q[$retw][$_qlap][$_qlm][$retx]): $this->EmptyValue; $_qOaj=replace("{text}",$_qlu,$_qObv); if ($_qlca[$_qlc8]->_qO84->FieldName == _qlz::_qO12) { $_qOaj=replace("{css}"," kptRowGrandTotalDataCell{css}",$_qOaj); } else if ($_qlca[$_qlc8]->_qO48()>0) { $_qOaj=replace("{css}"," kptRowTotalDataCell{css}",$_qOaj); } if ($_qOc9[$_qlc7]->_qO84->FieldName == _qlz::_qO12) { $_qOaj=replace("{css}"," kptColumnGrandTotalDataCell",$_qOaj); } else if ($_qOc9[$_qlc7]->_qO48()>0) { $_qOaj=replace("{css}"," kptColumnTotalDataCell",$_qOaj); } else { $_qOaj=replace("{css}","",$_qOaj); } $_qlc3.=$_qOaj;   }
} $_qlak=replace("{tds}",$_qlc3,$_qlbv); $_qOak.=$_qlak; } $_qOh=replace("{trs}",$_qOak,$retb); $_qOh=replace("{cols}",$_qO5c,$_qOh); return $_qOh; }
function _qOca() { $retb="<div class='kptVerticalScrollDiv' style='width:17px;overflow-y: scroll; overflow-x: hidden;'><div style='width:17px'></div></div>"; return $retb; }
function _qlcb() { $retb="<div class='kptHorizontalScrollDiv' style='height:17px;overflow-x: scroll; overflow-y: hidden;'><div style='height:17px'></div></div>"; return $retb; }
function _qOcb() { return $this->Status->_qO6b(); }
function renderpivottable() { 
	$this->_qlcc(); 
	$_qOcc="\n"; 
	if ( isset ($this->_ql74)) { $_ql5x=$this->_ql74->_ql7b(); } 
	else { 
		$_qlcd="<table class='kptTable{horizontalscrolling}{verticalscrolling}' cellspacing='0'><colgroup>{cols}</colgroup><tbody>{filter_zone}{data_and_column_zone}{row_and_columnheader_and_vertical_scrolling_zone}{rowheader_and_content_zone}{horizontal_scrolling_zone}{pager_zone}{status_zone}</tbody></table>"; 
		$_qOcd="<tr><td colspan='{total_colspan}' class='kptFilterZone'>{zone}</td></tr>"; 
		//$_qOcd="<div class='kptFilterZone'>{zone}</div>"; 
		$_qlce="<tr><td colspan='{data_colspan}' class='kptDataZone'>{data_zone}</td><td class='kptColumnZone' colspan='{column_colspan}'>{column_zone}</td></tr>"; 
		$_qOce="{zone}"; $_qlcf="{zone}"; $_qOcf="<tr><td colspan='{row_colspan}' class='kptRowZone'>{row_zone}</td><td colspan='{columnheader_colspan}' class='kptColumnHeaderZone'>{columnheader_zone}</td>{vertical_scrolling_zone}</tr>"; 
		$_qlcg="{zone}"; $_qOcg="{zone}"; $_qlch="<td rowspan='2' class='kptVerticalScrollingZone' style='width:17px'>{zone}</td>"; 
		$_qOch="<tr><td colspan='{rowheader_colspan}' class='kptRowHeaderZone'>{rowheader_zone}</td><td colspan='{content_colspan}' class='kptContentZone'>{content_zone}</td></tr>"; 
		$_qlci="{zone}"; $_qOci="{zone}"; $_qlcj="<tr><td colspan='{total_colspan}' class='kptHorizontalScrollingZone'>{zone}</td></tr>"; 
		$_qOcj="<tr><td colspan='{total_colspan}' class='kptPagerZone'>{zone}</td></tr>"; 
		$_qlck="<tr><td colspan='{total_colspan}' class='kptStatusZone'>{zone}</td></tr>"; 
		if ($this->VerticalScrolling) { $_qOck=3; $_qlcl=1; $_qOcl=2; $_qlcm=$_qOcm=1; $_qlcn=$_qOcn=1; $_qO5c="<col /><col /><col style='width:17px' />"; } 
		else { $_qOck=2; $_qlcl=$_qOcl=1; $_qlcm=$_qOcm=1; $_qlcn=$_qOcn=1; $_qO5c="<col /><col />"; } 
		$_ql5x=$_qlcd; $_qlco=""; 
		if ($this->ShowStatus) { $_qlco=replace("{zone}",$this->_qOcb(),$_qlck); $_qlco=replace("{total_colspan}",$_qOck,$_qlco); } $_qOco=""; 
		if ($this->Pager !== NULL) { $_qOco=replace("{zone}",$this->Pager->render(),$_qOcj); $_qOco=replace("{total_colspan}",$_qOck,$_qOco); } $_qlcp=""; 
		if ($this->HorizontalScrolling) { $_qlcp=replace("{zone}",$this->_qlcb(),$_qlcj); $_qlcp=replace("{total_colspan}",$_qOck,$_qlcp); } 
		$_qOcp=replace("{zone}",$this->_qlc9(),$_qOci); $_qlcq=replace("{zone}",$this->_qOc5(),$_qlci); $_qOcq=replace("{rowheader_zone}",$_qlcq,$_qOch); $_qOcq=replace("{content_zone}",$_qOcp,$_qOcq); $_qOcq=replace("{rowheader_colspan}",$_qlcn,$_qOcq); $_qOcq=replace("{content_colspan}",$_qOcn,$_qOcq); $_qlcr=""; 
		if ($this->VerticalScrolling) { $_qlcr=replace("{zone}",$this->_qOca(),$_qlch); } $_qOcr=replace("{zone}",$this->_qObu(),$_qOcg); $showRowZone=""; 
		if ($this->ShowRowZone) { 
			$showRowZone=replace("{zone}",$this->_rowzone(),$_qlcg); 
			//$showRowZone2=replace("{zone}",$this->_rowzone2(),$_qlcg); 
		} 
		$_qOcs=replace("{vertical_scrolling_zone}",$_qlcr,$_qOcf); 
		$_qOcs=replace("{columnheader_zone}",$_qOcr,$_qOcs); 
		$_qOcs=replace("{row_zone}",$showRowZone,$_qOcs); 
		$_qOcs=replace("{columnheader_colspan}",$_qOcm,$_qOcs); 
		$_qOcs=replace("{row_colspan}",$_qlcm,$_qOcs); $showColumnZone=""; 
		if ($this->ShowColumnZone) { 
			$showColumnZone=replace("{zone}",$this->_columnzone(),$_qlcf); 
			//$showColumnZone2=replace("{zone}",$this->_columnzone2(),$_qlcf); 
		} $_qOct=""; 
		if ($this->ShowDataZone) { 
			$_qOct=replace("{zone}",$this->_datazone(),$_qOce);
			//$showDataZone2=replace("{zone}",$this->_datazone2(),$_qOce); 
		} 
		$_qlcu=""; if ($_qOct != "" && $showColumnZone != "") { 
			$_qlcu=replace("{data_zone}",$_qOct,$_qlce); 
			$_qlcu=replace("{column_zone}",$showColumnZone,$_qlcu); 
			$_qlcu=replace("{data_colspan}",$_qlcl,$_qlcu); 
			$_qlcu=replace("{column_colspan}",$_qOcl,$_qlcu); 
		} $_qOcu=""; 
		if ($this->ShowFilterZone) { $_qOcu=replace("{zone}",$this->_filterzone(),$_qOcd); $_qOcu=replace("{total_colspan}",$_qOck,$_qOcu); } 

		$_ql5x=replace("{filter_zone}",$_qOcu,$_qlcd); 
		//$_ql5x=replace("{row_zone}",$showRowZone2,$_ql5x);
		//$_ql5x=replace("{column_zone}",$showColumnZone2,$_ql5x);
		//$_ql5x=replace("{data_zone}",$showDataZone2,$_ql5x);

		$_ql5x=replace("{data_and_column_zone}",$_qlcu,$_ql5x); 
		$_ql5x=replace("{row_and_columnheader_and_vertical_scrolling_zone}",$_qOcs,$_ql5x); 
		$_ql5x=replace("{rowheader_and_content_zone}",$_qOcq,$_ql5x); 
		$_ql5x=replace("{horizontal_scrolling_zone}",$_qlcp,$_ql5x); 
		$_ql5x=replace("{pager_zone}",$_qOco,$_ql5x); 
		$_ql5x=replace("{status_zone}",$_qlco,$_ql5x); 
		$_ql5x=replace("{cols}",$_qO5c,$_ql5x); 
		$_ql5x=replace("{horizontalscrolling}",$this->HorizontalScrolling ? " kptHorizontalScrolling": "",$_ql5x); 
		$_ql5x=replace("{verticalscrolling}",$this->VerticalScrolling ? " kptVerticalScrolling": "",$_ql5x); } 

		$_qOh=replace("{id}",$this->id ,_qlf()); if (_qlh($_qOh)) { $_qOh=replace("{width}",($this->Width === NULL) ? "": "width:".$this->Width.";",$_qOh); $_qOh=replace("{height}",($this->Height === NULL) ? "": "height:".$this->Height.";",$_qOh); $_qOh=replace("{style}",$this->_ql4h ,$_qOh); $_qOh=replace("{trademark}",$_qOcc,$_qOh); $_qOh=replace("{table}",$_ql5x,$_qOh); $_qOh=replace("{viewstate}",$this->_qO6l->_qO6b(),$_qOh); $_qOh=replace("{command}",$this->_ql9t->_qO6b(),$_qOh); $_qOh=replace("{version}",$this->_ql0 ,$_qOh); } return $_qOh; 
	}
	function render() { 
		//$_qlcv=$this->registercss(); 
		$_qlcv='';
		$_qlcv.=$this->renderpivottable(); 
		//$_qOcv= isset ($_POST["__koolajax"]) || isset ($_GET["__koolajax"]); 
		//$_qlcv.=($_qOcv) ? "": $this->registerscript(); 
		$_qlcv.="<script type='text/javascript'>"; $_qlcv.=$this->startupscript(); $_qlcv.="</script>"; 
		if ($this->AjaxEnabled && class_exists("UpdatePanel")) { 
			$_qlcw=new updatepanel($this->id."_updatepanel"); $_qlcw->content =$_qlcv; $_qlcw->cssclass =$this->_ql4h."KPT_UpdatePanel"; 
			if ($this->AjaxLoadingImage) { $_qlcw->setloading($this->AjaxLoadingImage); } $_qlcv=$_qlcw->render(); 
		} return $_qlcv; 
	}
		function _qlcc() { $this->styleFolder =replace("\134","/",$this->styleFolder); $_qOcw=trim($this->styleFolder ,"/"); $_qlcx=strrpos($_qOcw,"/"); $this->_ql4h =substr($_qOcw,($_qlcx ? $_qlcx: -1)+1); }
		function registercss() { 
	//$this->_qlcc(); $_qOcx="<script type='text/javascript'>if (document.getElementById('__{style}KPT')==null){var _head = document.getElementsByTagName('head')[0];var _link = document.createElement('link'); _link.id = '__{style}KPT';_link.rel='stylesheet'; _link.href='{stylepath}/{style}/{style}.css';_head.appendChild(_link);}</script>"; $_qlcv=replace("{style}",$this->_ql4h ,$_qOcx); $_qlcv=replace("{stylepath}",$this->_qlcy(),$_qlcv); return $_qlcv; 
		}
		function registerscript() { 
	//$_qOcx="<script type='text/javascript'>if(typeof _libKPT=='undefined'){document.write(unescape('<script type=text/javascript src={src}> </script>'));_libKPT=1;}</script>"; $_qlcv=replace("{src}",$this->_qOcy()."?".md5("js"),$_qOcx); return $_qlcv; 
		}
		
	function startupscript() { 
		$_qOcx="var {id}; function {id}_init(){ {id} = new KoolPivotTable('{id}',{AjaxEnabled},'{AjaxHandlePage}');}"; 
		$_qOcx.="if (typeof(KoolPivotTable)=='function'){{id}_init();}"; 
		$_qOcx.="else{if(typeof(__KPTInits)=='undefined'){__KPTInits=new Array();} __KPTInits.push({id}_init);}"; 
		//$_qlcz="if(typeof(_libKPT)=='undefined'){var _head = document.getElementsByTagName('head')[0];var _script = document.createElement('script'); _script.type='text/javascript'; _script.src='{src}';_libKPT=1;}"; 
		//$_qOcz=replace("{src}",'',$_qlcz); 
		$_qlcv=replace("{id}",$this->id ,$_qOcx); 
		$_qlcv=replace("{AjaxEnabled}",$this->AjaxEnabled ? "1": "0",$_qlcv); 
		$_qlcv=replace("{AjaxHandlePage}",$this->AjaxHandlePage ,$_qlcv); 
		//$_qlcv=replace("{register_script}",$_qOcz,$_qlcv); 
		return $_qlcv; 
	}
	
	function _qOcy() { if ($this->scriptFolder == "") { $_qO6=_ql5(); $_qld0=substr(replace("\134","/",__FILE__),strlen($_qO6)); return $_qld0; } else { $_qld0=replace("\134","/",__FILE__); $_qld0=$this->scriptFolder.substr($_qld0,strrpos($_qld0,"/")); return $_qld0;   }
}
function _qlcy() { $_qOd0=$this->_qOcy(); $_qld1=replace(strrchr($_qOd0,"/"),"",$_qOd0)."/styles"; return $_qld1;   }
}
}

?>

