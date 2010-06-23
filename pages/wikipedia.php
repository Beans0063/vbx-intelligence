<? $call = json_decode(stripslashes($_REQUEST['call']), true); ?>

<?


function abbrstate($state){
if($state == "AL"){$state = "Alabama";}
if($state == "AK"){$state = "Alaska";}
if($state == "AZ"){$state = "Arizona";}
if($state == "AR"){$state = "Arkansas";}
if($state == "AF"){$state = "Armed Forces Africa";}
if($state == "AA"){$state = "Armed Forces Americas (Except Canada)";}
if($state == "AC"){$state = "Armed Forces Canada";}
if($state == "AE"){$state = "Armed Forces Europe";}
if($state == "AM"){$state = "Armed Forces Middle East";}
if($state == "AP"){$state = "Armed Forces Pacific";}
if($state == "CA"){$state = "California";}
if($state == "CO"){$state = "Colorado";}
if($state == "CT"){$state = "Connecticut";}
if($state == "DE"){$state = "Delaware";}
if($state == "DC"){$state = "Dist. of Columbia";}
if($state == "FL"){$state = "Florida";}
if($state == "GA"){$state = "Georgia";}
if($state == "GU"){$state = "Guam";}
if($state == "ID"){$state = "Idaho";}
if($state == "IL"){$state = "Illinois";}
if($state == "IN"){$state = "Indiana";}
if($state == "IA"){$state = "Iowa";}
if($state == "KY"){$state = "Kansas";}
if($state == "KS"){$state = "Kentucky";}
if($state == "LA"){$state = "Louisiana";}
if($state == "ME"){$state = "Maine";}
if($state == "MD"){$state = "Maryland";}
if($state == "MA"){$state = "Massachusetts";}
if($state == "MI"){$state = "Michigan";}
if($state == "MN"){$state = "Minnesota";}
if($state == "MS"){$state = "Mississippi";}
if($state == "MO"){$state = "Missouri";}
if($state == "MT"){$state = "Montana";}
if($state == "NE"){$state = "Nebraska";}
if($state == "NV"){$state = "Nevada";}
if($state == "NH"){$state = "New Hampshire";}
if($state == "NJ"){$state = "New Jersey";}
if($state == "NM"){$state = "New Mexico";}
if($state == "NY"){$state = "New York";}
if($state == "NC"){$state = "North Carolina";}
if($state == "ND"){$state = "North Dakota";}
if($state == "OH"){$state = "Ohio";}
if($state == "OK"){$state = "Oklahoma";}
if($state == "OR"){$state = "Oregon";}
if($state == "PA"){$state = "Pennsylvania";}
if($state == "PR"){$state = "Puerto Rico";}
if($state == "RI"){$state = "Rhode Island";}
if($state == "SC"){$state = "South Carolina";}
if($state == "SD"){$state = "South Dakota";}
if($state == "TN"){$state = "Tennessee";}
if($state == "TX"){$state = "Texas";}
if($state == "UT"){$state = "Utah";}
if($state == "VT"){$state = "Vermont";}
if($state == "VA"){$state = "Virginia";}
if($state == "VI"){$state = "Virgin Islands";}
if($state == "WA"){$state = "Washington";}
if($state == "WV"){$state = "West Virginia";}
if($state == "WI"){$state = "Wisconsin";}
if($state == "WY"){$state = "Wyoming";}
echo"$state";
}

function  titleCase($string)  { 
        $len=strlen($string); 
        $i=0; 
        $last= ""; 
        $new= ""; 
        $string=strtoupper($string); 
        while  ($i<$len): 
                $char=substr($string,$i,1); 
                if  (ereg( "[A-Z]",$last)): 
                        $new.=strtolower($char); 
                else: 
                        $new.=strtoupper($char); 
                endif; 
                $last=$char; 
                $i++; 
        endwhile; 
        return($new); 
};


?>
<div class="gradient-box" style="position:relative; height:300px; width:200px;">
<iframe src="http://en.wikipedia.org/w/index.php?title=<?= titleCase($call["city"]) ?>,_<?= abbrstate($call["state"]) ?>&printable=yes" width="200" height="300"></iframe>
</div>