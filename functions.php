<?php


function mongodb_connect_bezdna ()
{
	$Connection = new Mongo("mongodb://localhost:27017");
	$db = $Connection -> motobashdb;
	$collect = $db -> newposttest;

	return ($collect);


} 
function get_date_day($date) //функция получения номера дня из даты
{
	$a=$date[0];
	if ($date[1]!='-') {
		$a=$a.$date[1];
	}
	return($a);

} 
function get_date_month($date) // функция получения номера месяца из даты
{

	if ($date[2]!='-') 
	{
		$d1=$date[2];
		if ($date[3]!='-') 
		{
			$d1=$d1.$date[3];
		}
		
	}
	else {
			$d1=$date[3];
			if ($date[4]!='-') {
				$d1=$d1.$date[4];
			}

		}
	return($d1);
}
function get_date_year ($date) // функция получения года из даты
{
	if ($date[3]=='-') 
	{
		$y=$date[4].$date[5].$date[6].$date[7];
	}
	elseif($date[4]=='-')
	{
		$y=$date[5].$date[6].$date[7].$date[8];
	}
	elseif($date[5]=='-')
	{
		$y=$date[6].$date[7].$date[8].$date[9];
	}
	return($y);
}
function get_date_time($date) // функция получения времени из даты
{
	$i=3;
	while ($date[$i]!=':') 
	{ $i++;	if(!$date[$i]){break;}}
	if ($date[$i]) 
	{
		
		if ($date[$i-2]!=' ') 
		{
			$t1=$date[$i-2].$date[$i-1];
		} else
			{$t1=$date[$i-1];}
		if ($date[$i+2]) 
		{
			$t2=$date[$i+1].$date[$i+2];
		} else
			{$t2=$date[$i+1];}

		$t=$t1.':'.$t2;
		return($t);

	}

}

function postn_bezdna ($page, $collect) // функция которая достает нужное количество постов из БД для бездны
{
	//$Connection = new Mongo("mongodb://localhost:27017");
	//$db = $Connection -> motobashdb;

	
	$all_post_count = $collect -> count();    // находим количество постов. позже переписать на ГЛОБАЛ
	$all_page_numb = intval ($all_post_count/50);
	$j=$all_post_count%10;
	//echo "$j <br>";
	if ($j) 
	{
		$all_page_numb++;
	}
	if($page!=0)
	{
	$k=($all_page_numb-$page)*50;
	}

	$post = $collect -> find(); 
	$post -> sort(array("numb" => -1 ));
	$post -> skip($k);
	$post -> limit(50);   // тут указываешь сколько постов будет на странице
	$post -> rewind();
	return($post);
}	

function post_page_bezdna($page_numb=0, $collect)   // печатает посты бездны
{
	$post=postn_bezdna($page_numb, $collect);
	
	/*if($page_numb==0)
	{
		$i=1;
	}
	else
	{
	$i=($page_numb-1)*50+1;
	}*/
	while($post){
		$post_print=$post -> current();
		
		$post_numb_on_page=$page_numb+i;
		
		?>


		<!--start QUITE BLOCK-->
        <figure id="quote-1">
            <figcaption class="actions">
                <div class="rating">
                    <a class="grade" href="#">+</a><span class="value">1000</span><a class="downgrade" href="#">-</a>
                </div>
                <div class="share" id="s1">Поделиться</div>
                <div class="pubdate">
                    <time datetime="<?php echo '$post_print[postdate]'; ?>" pubdate>
                    	<span class="day"><?php echo get_date_day($post_print[postdate]); ?></span>-<span class="month"><?php echo get_date_month($post_print[postdate]); ?></span>-<span class="year"><?php echo get_date_year($post_print[postdate]); ?></span> <span class="time"><?php echo get_date_time($post_print[postdate]); ?></span>
                    </time>
                </div>
                <div class="id">#<?php echo $post_print[numb]; ?></div>
            </figcaption>
            <article class="content" role="article"><?php echo $post_print[posttext];?>
            </article>
        </figure>
        <!--end QUOTE BLOCK-->






<?php
		//$i++;
		if($post ->hasNext())
			{$post -> next();}
		else{break;}

	}
	
}
function page_count_number($page=0, $collect)     // функция переключения страниц. меню переключения страниц в БЕЗДНЕ
{
	
	
	$all_post_numb = $collect -> find(); 
	$all_post_numb = $collect -> count();
	//var_dump($all_page_numb);
	//$all_post_numb=2351;
	$all_page_numb= intval ($all_post_numb/50);
	$j=$all_post_numb%10;
	//echo "$j <br>";
	if ($j) 
	{
		$all_page_numb++;
	}
	//echo "$all_page_numb <br>";
	$adr='/garaj.php?pagen=';
	if($page==0)
	{
		$page=$all_page_numb;
	}

	?>

	<!--start PAGINATION BLOCK-->
        <nav class="pagination" role="navigation">
            <ul>

	<?php 
	if (($all_page_numb-$page)>=1) 
	{
		$adr_temp1=$page+1;
		$adr_temp=$adr.$adr_temp1;

		?>
			<li><a href="<?php echo $adr_temp; ?>" rel="prev">&larr;</a></li>

		<?php

	}

	if (($all_page_numb-$page)>3)
	{
		

		$adr_temp1=$all_page_numb;
		$adr_temp=$adr.$adr_temp1;
		?>
		<li><a href="<?php echo $adr_temp; ?>" rel="next"><?php echo $adr_temp1; ?></a></li>
		<li><span>...</span></li>

		<?php


	}


	if (($all_page_numb-$page)==3)
	{
		

		$adr_temp1=$page+3;
		$adr_temp=$adr.$adr_temp1;
		?>
		<li><a href="<?php echo $adr_temp; ?>" rel="next"><?php echo $adr_temp1; ?></a></li>

		<?php


	}

	if (($all_page_numb-$page)>=2)
	{
		

		$adr_temp1=$page+2;
		$adr_temp=$adr.$adr_temp1;
		?>
		<li><a href="<?php echo $adr_temp; ?>" rel="next"><?php echo $adr_temp1; ?></a></li>

		<?php


	}

	if (($all_page_numb-$page)>=1)
	{
		

		$adr_temp1=$page+1;
		$adr_temp=$adr.$adr_temp1;
		?>
		<li><a href="<?php echo $adr_temp; ?>" rel="next"><?php echo $adr_temp1; ?></a></li>

		<?php


	}
	


	/*<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<текущая страница>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/
	?> 
	<li><span class="this-page"><?php echo $page;?> </span></li>
	<?php

	$k=($all_page_numb-$page)*50;

	if ((($all_post_numb>50) and (($all_post_numb-$k)>50)) )
	{
		$adr_temp1=$page-1;
		$adr_temp=$adr.$adr_temp1;
		?>
		<li><a href="<?php echo $adr_temp; ?>" rel="next"><?php echo $adr_temp1; ?></a></li>

		<?php
		//echo "походу пашет.";

	}
	if ((($all_post_numb>100) and (($all_post_numb-$k)>100)) )
	{
		$adr_temp1=$page-2;
		$adr_temp=$adr.$adr_temp1;
		?>
		<li><a href="<?php echo $adr_temp; ?>" rel="next"><?php echo $adr_temp1; ?></a></li>

		<?php
		//echo "походу пашет.";

	}
	if(($page==4) and ($all_post_numb>150))
	{
		$adr_temp1=1;
		$adr_temp=$adr.$adr_temp1;
		?>
		<li><a href="<?php echo $adr_temp; ?>" rel="next"><?php echo $adr_temp1; ?></a></li>

		<?php

	}
	if (($page>4) and ($all_post_numb>200))
	{
		$adr_temp1=1;
		$adr_temp=$adr.$adr_temp1;
		?>
		<li><span>...</span></li>
		<li><a href="<?php echo $adr_temp; ?>" rel="next"><?php echo $adr_temp1; ?></a></li>

		<?php
	}
	if ((($all_post_numb>50) and (($all_post_numb-$k)>50)) )
	{
		$adr_temp1=$page-1;
		$adr_temp=$adr.$adr_temp1;
		?>
		 <li><a href="<?php echo $adr_temp; ?>" rel="next">&rarr;</a></li>

		<?php
		//echo "походу пашет.";

	}
		?>

 			</ul>
        </nav>
        <!--end PAGINATION BLOCK-->
	<?php 



}


?>


<?php function Whatpagenumber($collect, $pagen)
{
		$all_post_count = $collect -> count();
		$all_page_numb = intval ($all_post_count/50);
		$j=$all_post_count%10;
	//echo "$j <br>";
	if ($j) 
	{
		$all_page_numb++;
	}
	if ($pagen)
	{
		if($all_page_numb<$pagen)
			{return ('PageError!');}
		else
		{
		return ($pagen);
		}
		//$_REQUEST['pagen']==3;
		//echo $_REQUEST['pagen'];

	}
	else 
	{
	
	return ($all_page_numb);

	}

}