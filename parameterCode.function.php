//Create by Kenxox (24/12/2014) http://www.facebook.com/XOXcore
function encodeKX($_s)
{
  $_s = strtolower($_s);

  $_strCode = '9 3 0 4 6 5 7 1 8 2';
  $_azCode = 'q w n o p x y z r s c d e f g h i j k l m t u v a b';
  $_spCode = '? = & #';

  $_arStrCode= explode(' ',$_strCode);
  $_arAzCode= explode(' ',$_azCode);
  $_arSpCode= explode(' ',$_spCode);

  $_sleg = strlen($_s);
  $_sA = '';
  $_iV=0;
  $_c='';

  for($_i=0;$_i<$_sleg;$_i++)
  {
    $_c = substr($_s,($_i+1)*-1,1);
    echo $_c;
    if(is_numeric($_c )){
      $_iV = intval($_c);
      $_sA .= $_arStrCode[$_iV].'+';
    }else{

      $_iV = ord($_c)-97;

      if($_iV<0){
        for($_j=0;$_j<count($_arSpCode);$_j++){
          if($_c == $_arSpCode[$_j]){
            $_iV = $_j;
            break;
          }
      }

        $_iV = $_iV+count($_arAzCode);
        $_sA .= $_iV.'-';
      }else{
        $_sA .= $_arAzCode[$_iV].'-';
      }
    }

  }
  echo "<br>".$_sA;

  return base64_encode($_sA);
}

function decodeKX($_s)
{

  $_s = base64_decode($_s);

  $_strCode = '9 3 0 4 6 5 7 1 8 2';
  $_azCode = 'q w n o p x y z r s c d e f g h i j k l m t u v a b';
  $_spCode = '? = & #';

  $_arStrCode= explode(' ',$_strCode);
  $_arAzCode= explode(' ',$_azCode);
  $_arSpCode= explode(' ',$_spCode);

  $_sleg = strlen($_s);
  $_c = '';
  $_sc = '';
  $_sA = '';
  $_iV = 0;

  $_m = false;

  for($_i=0;$_i<$_sleg;$_i++){
    $_c = substr($_s,($_i+1)*-1,1);
    if($_c=='+'){
      $_m = true;
    }else if($_c=='-'){
      $_m = false;
    }else{
      if($_m){

        for($_j=0;$_j<count($_arStrCode);$_j++){
          if($_c == $_arStrCode[$_j]){
            $_sA .= $_j;
            break;
          }
        }

      }else{
        // max 99
        if(is_numeric($_c )){
          $_sc = $_c;
          $_i++;
          $_sc .= substr($_s,($_i+1)*-1,1);

          $_iV  = ((int)strrev($_sc))-count($_arAzCode);
          $_sA .=  $_arSpCode[$_iV];
        }else{
          for($_j=0;$_j<count($_arAzCode);$_j++){
            if($_c == $_arAzCode[$_j]){
              $_sA .= chr(97+$_j);
              break;
            }
          }
        }

      }
    }
  }

  return $_sA;
}
