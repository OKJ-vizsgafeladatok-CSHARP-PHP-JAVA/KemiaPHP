<?php
require 'Elem.php';
session_start();
$_SESSION['ok']=false;
function beolvas(){
    $tomb=array();
    $file=fopen("felfedezesek.csv","r") or die("A fájlt nem tudtam megnyitni. ");
    while (!feof($file)) {
        $sor= fgets($file);
        if(strlen($sor)>2){        //ha nem üres a sor
            $split= explode(";", $sor);
            $o=new Elem(
                    $split[0],
                    $split[1], 
                    $split[2], 
                    $split[3], 
                    trim($split[4],"\s\n")
               );
            $tomb[]=$o;
        }
        }//endofwhile
        array_shift($tomb);
    return $tomb;
}
$a=beolvas();
//print_r($a);
echo '3. feladat: Felfedezések száma: '. count($a).'<br>';

$szamlalo=0;
foreach ($a as $item) {
    if(!is_numeric($item->getEv())){
        $szamlalo++;
    }
}
echo'4. feladat: Felfedezések száma az ókorban: '.$szamlalo." db<br>";

$behuzas="&nbsp&nbsp&nbsp&nbsp&nbsp";
echo '5. feladat:<br>';
echo    '<form method="POST" action="#">'
            . '<input type="text" name="vegyjel">'
            . '<input type="submit" value="Vegyjel">'
       .'</form>';
do{

    if(isset($_POST['vegyjel'])&&!empty($_POST['vegyjel'])){
            $beker=$_POST['vegyjel'];
            unset($_POST['vegyjel']);
    }
    else
    {    
        die($behuzas."A vegyjel csak betűből állhat, max 2 karakter. ");
    }
}
while(
        !preg_match("/^[a-zA-Z]+$/",strtoupper($beker)) || 
        strlen($beker)>2
      );

echo '6. feladat: Keresés: <br>';
$valasz=$behuzas."Nincs ilyen elem az adatforrásban!<br>";
    foreach ($a as $item){
        if(strcmp(strtoupper($beker), strtoupper($item->getVegyjel()))==0){
            $valasz=$behuzas.'Az elem vegyjele: '.$item->getVegyjel()."<br>";
            $valasz.=$behuzas.'Az elem neve: '.$item->getElem().'<br>';
            $valasz.=$behuzas.'Rendszáma: '.$item->getRndszam().'<br>';
            $valasz.=$behuzas.'Felfedezés éve: '.$item->getEv().'<br>';
            $valasz.=$behuzas.'Felfedező: '.$item->getFelfedezo().'<br>';
        }
    }
echo $valasz;
//7. feladat:
$maxtav=0;
$elozoev=0;
$elsovolt=false;
foreach ($a as $item) {
    if(!strcmp($item->getEv(), "Ókor")==0){ 
        if($elsovolt==false){
            $elsovolt=true;
            $elozoev=$item->getEv();
        }else{
            if(($item->getEv()-$elozoev)>$maxtav){
                $maxtav=$item->getEv()-$elozoev;
            }
            $elozoev=$item->getEv();
        }
    }
}
echo '7. feladat: '.$maxtav.' év volt a leghosszabb időszak két elem felfedezése között. <br>';
echo '8. feladat: <br>';

$evenkent=array();
foreach ($a as $item) {
    if(strcmp("Ókor", $item->getEv())!=0){
        $evenkent[]=$item->getEv();
    }
}

$uj= array_count_values($evenkent);//itt az új tömbbe átkerülnek az értékek ->key lesz belőlük. a value pedig azt az értéket fogja tárolni, hogy a value hányszor szerepelt az eredeti tömbben. 
foreach ($uj as $key => $value) {
    if($value>3){
        echo $behuzas.$key.': '.$value." db<br>";
    }
}



