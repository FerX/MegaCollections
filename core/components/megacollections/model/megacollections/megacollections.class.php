<?php


/**
 * summary
 */


class megaCollections
{
    
    public $modx;

    public function __construct(&$modx)
    {
      $this->modx=$modx;  
    }


    /**
     * Eseguo un test di confronto 
     * @param  string  $p1      Operando 1
     * @param  string  $p2      Operatore di confronto
     * @param  string  $p3      Operando 2
     * @param  string  $default valore di ritorno se operatore non riconosciuto
     * @return bool             ritorna valore true/false
     */
    public function test($p1,$p2="=",$p3=false,$default=null)
    {
        $result=$default;
        $p2=strtolower($p2);


        if (in_array($p2,array('empty','isempty'))!==false) {
           $result = empty($p1);     

        }elseif (in_array($p2,array('notempty','!empty'))!==false) {
           $result = !empty($p1);     

        }elseif (in_array($p2,array('null','isnull'))!==false) {
           $result = $p1==null || strtolower($p1)=="null";     

        }elseif (in_array($p2,array('notnull','!null'))!==false) {
           $result = $p1!==null || strtolower($p1)!="null";     

        }elseif (in_array($p2,array('notempty','!empty'))!==false) {
           $result = !empty($p1);     

        }elseif (in_array($p2,array('=','==','===','eq','is','equal','equals','equalto'))!==false) {
           $result = $p1 == $p3;     

        }elseif (in_array($p2,array('<','lt','less','lessthen'))!==false) {
           $result = $p1 < $p3;     

        }elseif (in_array($p2,array('>','gt','greater','greaterthan'))!==false) {
           $result = $p1 > $p3;     

        }elseif (in_array($p2,array('>=','gte','greaterthanequals','greaterthanequalto'))!==false) {
           $result = $p1 >= $p3;     

        }elseif (in_array($p2,array('<=','lte','lessthanequals','lessthanorequalto'))!==false) {
           $result = $p1 <= $p3;     
                    
        }elseif (in_array($p2,array('!=','<>','neq','not','isnot','isnt','unequal','notequal'))!==false) {
           $result = $p1 != $p3;     

        }elseif (in_array($p2,array('in'))!==false) {
           $result = strpos($p3,$p1)!==false;     

        }elseif (in_array($p2,array('start'))!==false) {
           $result = strpos($p3,$p1)===0;     

        }elseif (in_array($p2,array('end'))!==false) {
           $result = substr($p3,strlen($p1)*-1)==$p1;     

        }elseif (in_array($p2,array('inarray','inlist','injson'))!==false) {
           $aList=json_decode($p3,true);
           if (!is_array($aList)) $aList=explode(",", $p3);
           if (!is_array($aList)) $aList=explode("||", $p3);
           $result = in_array($p1,$aList);     
        }

        return $result;

    }


    /**
     * Filtra un array in base alle regole di filtro definite
     * @param  array/json $data   
     * @param  array/json $filter 
     * @return array          
     */
    function filter($data,$filter)
    {
      $aData=$data;
      $aFilter=$filter;

      if (!is_array($aData)) {
        $aData=$this->modx->fromJSON($aData);
      }
      if (!is_array($aFilter)) {
        $aFilter=$this->modx->fromJSON($aFilter);
      }

      if (!is_array($aData) || !is_array($aFilter)) {
        return $data;
      }

      $aRet=array();

      foreach ($aData as $key_element => $element) {
        
        $bIncludi=true;

        foreach ($aFilter as $key => $sTest) {
          
          @list($sCampo,$sOperatore) = explode(':', $key);
          if (empty($sOperatore)){$sOperatore="=";}
          $sValore = $element[$sCampo];
          $bTest = $this->test($sTest,$sOperatore,$sValore,true);

          if (!$bTest) {
            $bIncludi=false;
            break;
          }

        }

        if ($bIncludi) {
          $aRet[]=$element;
        }

      } 

      return $aRet;

    }


     /**
     * Ordina un array in base alle regole di ordine ricevute
     * @param  array/json $data   
     * @param  array/json $sort {"campo1":"ASC","campo2":"DESC","campo3","RANDOM"}
     * @return array          
     */
    function sort($data,$sort)
    {
      $aData=$data;
      $aSort=$sort;

      if (!is_array($aData)) {
        $aData=$this->modx->fromJSON($aData);
      }
      if (!is_array($aSort)) {
        $aSort=$this->modx->fromJSON($aSort);
      }

      if (!is_array($aData) || !is_array($aSort)) {
        return $data;
      }

      
      usort($aData, function($a,$b) use ($aSort){

        foreach ($aSort as $key => $order) {
          $order=strtoupper($order);
          
          //Se uguali passo al secondo confronto.
          if ($a[$key]==$b[$key]) {
            continue;
          }

          if (substr($order,0,4)=="RAND") { 
            $order="ASC";
            if(rand(1,2)==2) { $order="DESC";}
          }
          
          if ($order=="DESC") {
            return $a[$key] < $b[$key];

          //Di default ASC
          }else{
            return $a[$key] > $b[$key];
          }

        }

        return true;

      });

      return $this->modx->toJSON($aData);

    }

}        
