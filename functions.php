<?php


function mongodb_connect_bezdna ()
{
	$Connection = new Mongo("mongodb://localhost:27017");
	$db = $Connection -> motobashdb;
	$collect_bezdna = $db -> newdb;   //база данных постов бездны
	$collect_count = $db -> count;			//количество постов бездны
	$collect_count_new = $db -> count_new;  //количество постов на главной странице. (одобреных постов)
	$like=$db-> like;						//база данных лайков
	$ret=array(collect_bezdna=> $collect_bezdna,	
				collect_count=> $collect_count,
				like=> $like,
				collect_count_new=> $collect_count_new);



	return ($ret);


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

function postn_bezdna ($page, $collect, $status) // функция которая достает нужное количество постов из БД для бездны

{
	//$Connection = new Mongo("mongodb://localhost:27017");
	//$db = $Connection -> motobashdb;

	
	$all_post_count = $collect -> count();    // находим количество постов. позже переписать на ГЛОБАЛ
	$all_page_numb = intval ($all_post_count/50);
	$j=$all_post_count%50;
	//echo "$j <br>";
	if ($j) 
	{
		$all_page_numb++;
	}
	if($page!=0)
	{
	$k=($all_page_numb-$page)*50;
	}

	$post = $collect -> find(array(status =>$status  )); 
	if($status=="accepted")
		$post -> sort(array("numb_new" => -1 ));
	else
		$post -> sort(array("numb" => -1 ));
	
	$post -> skip($k);
	$post -> limit(50);   // тут указываешь сколько постов будет на странице
	$post -> rewind();
	return($post);
}	
function postn_bezdna_top ($page, $collect, $status) // функция которая достает нужное количество постов из БД для бездны

{
	//$Connection = new Mongo("mongodb://localhost:27017");
	//$db = $Connection -> motobashdb;

	
	$all_post_count = $collect -> count();    // находим количество постов. позже переписать на ГЛОБАЛ
	$all_page_numb = intval ($all_post_count/50);
	$j=$all_post_count%50;
	//echo "$j <br>";
	if ($j) 
	{
		$all_page_numb++;
	}
	if($page!=0)
	{
	$k=($all_page_numb-$page)*50;
	}

	$post = $collect -> find(array(status =>$status  )); 
	$post -> sort(array("like" => -1 ));
	$post -> skip($k);
	$post -> limit(50);   // тут указываешь сколько постов будет на странице
	$post -> rewind();
	return($post);
}	

	

function post_page_bezdna($page_numb=0, $collect, $status)   // печатает посты бездны
{	
	$post_all=$collect[collect_bezdna]; 
	$post=postn_bezdna($page_numb, $collect[collect_bezdna], $status); // достаем из базы требуемое нам количество постов, и курсор с данной выборкой запихиваем $post

	while($post){
		
		$post_print=$post -> current();





		 
		$post_numb_on_page=$page_numb;
		$like_db=$collect[like];
		one_post($post_print, $page_numb, $like_db);
		
		if($post ->hasNext())   // печатаем пока можем
			{$post -> next();}
		else{break;}

	}
	
}

function one_post( $post_print, $page_numb, $like_db)  // функция которая рисует наш пост. выкинул сюда ибо надоело таскать кучу кода за собой
{

		?>
		<!--start QUITE BLOCK-->
        <figure id="quote-<?php echo $post_print[numb]; ?>" class="quote">
            <figcaption class="actions">
                <div class="id">#<?php echo $post_print[numb]; ?></div>
                <div class="rating">
                    <div class="grade">
                        <form  action="up_down_likes.php" method="POST">
                            <input name="number" type="hidden" value="<?php echo $post_print[numb]; ?>">
                            <input name="submit" type="submit" value="+">
                        </form>
                    </div>
                    <span class="value"><?php echo $post_print[like]; ?> </span>
                    <div class="downgrade">
                        <form  action="up_down_likes.php" method="POST">
                            <input name="number" type="hidden" value="<?php echo $post_print[numb]; ?>">
                            <input name="submit" type="submit" value="-">
                        </form>
                    </div>
                </div>
                <div class="share" id="s1">Поделиться</div>
                <div class="pubdate">
                    <time datetime="<?php echo '$post_print[postdate]'; ?>" pubdate>
                    	<span class="day"><?php echo get_date_day($post_print[postdate]); ?></span>-<span class="month"><?php echo get_date_month($post_print[postdate]); ?></span>-<span class="year"><?php echo get_date_year($post_print[postdate]); ?></span> <span class="time"><?php echo get_date_time($post_print[postdate]); ?></span>
                    </time>
                </div>
            </figcaption>
            <article class="content" role="article">
                <?php echo nl2br($post_print[posttext]);?>
            </article>
            <div class="edit">
                <form  action="edit.php" method="POST">
                    <input name="post_numb_in_base" type="hidden" value="<?php echo $post_print[numb];?>">
                    <input name="Edit" type="submit" value="Edit">
                </form>
            </div>
        </figure>

        <!--end QUOTE BLOCK-->
        <?php


}
function page_count_number($page=0, $collect, $status)     // функция переключения страниц. меню переключения страниц в БЕЗДНЕ
{
	
	/*if ($ma==1)
		{$collect=$collection[collect_bezdna];}
	else if($ma=="main")
		$collect=$collection[collect_main];
		*/
	$all_post_numb = $collect -> find(array(status =>$status  )); 		//находим ВСЕ посты базы
	$all_post_numb = $collect -> count();		// считаем сколько их
	
	$all_page_numb= intval ($all_post_numb/50);  // по 50 постов на страницу планируется пока
	$j=$all_post_numb%50;
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


<?php function Whatpagenumber($collect, $pagen, $status)  // функция втыкает на какой мы странице
{


		$collect = $collect -> find(array(status =>$status  )); 
		$all_post_count = $collect -> count();
		//echo "количесво всех постов $all_post_count <br>";
		$all_page_numb = intval ($all_post_count/50);
		//echo "количесво $all_post_count <br>";
		$j=$all_post_count%50;
		//echo "две переменные $all_page_numb <br> $j<br>";
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
		//echo "вывод $all_post_count<br>";
	
	return ($all_page_numb);

	}

}



function up_like($post_number, $collect, $updown)  //функция лайков. Если третий аргумент TRUE то тогда апаем, если FALSE то видать пост говно
{	
	$post_n=(int) $post_number;
	$filt=array(numb=> $post_n,);
	$post=$collect-> findOne($filt);
	if($post)
		{
			if($post[like]){
			$n=$post[like];
			if($updown==TRUE)
			{
				
				$nn=$n+1;
			}
			elseif ($updown==FALSE) {
				$nn=$n-1;
			}
			if($post[numb_new])
			{

			$new_like=array( postdate => $post[postdate],   						
   							postemail => $post[postemail],
  							posttext => $post[posttext],
							numb=> $post_n,
							numb_new=> $post[numb_new],
							status =>$post[status],
							like=>$nn,);
			}
			else
			{

			$new_like=array( postdate => $post[postdate],   						
   							postemail => $post[postemail],
  							posttext => $post[posttext],
							numb=> $post_n,
							status =>$post[status],
							like=>$nn,);
			}



			$filt=array( numb=> $post_n,
				like=>$n,);
			$collect->update($filt,$new_like);
			}
				else
		{
			

			if($updown==TRUE)
			{
				$nn=1;
			}
			elseif ($updown==FALSE) {
				$nn=-1;
			}

			if($post[numb_new])
			{

			$new_like=array( postdate => $post[postdate],   						
   							postemail => $post[postemail],
  							posttext => $post[posttext],
							numb=> $post_n,
							numb_new=> $post[numb_new],
							status =>$post[status],
							like=>$nn,);
			}
			else
			{

			$new_like=array( postdate => $post[postdate],   						
   							postemail => $post[postemail],
  							posttext => $post[posttext],
							numb=> $post_n,
							status =>$post[status],
							like=>$nn,);
			}

			$filt=array( numb=> $post_n,);
			$collect->update($filt,$new_like);
	/**/

			}


		}
	
}
function best_post_today ($collect)
{
		$post_data_temp = date('d-m-Y');
        $filt=array(
        			postdate=>new MongoRegex ( "/{$post_data_temp}/i" ),
        			status=> "accepted");
        $post=$collect[collect_bezdna]->find($filt);                // создаем запрос для поиска
   		$post -> sort(array("like" => -1 ));
   		$post -> limit(25);                     // пока введу ограничение на поиск только из 50 пследних постов
   		$post-> rewind();
                


    while($post){
        $flagff=TRUE;
        $post_print=$post -> current();
        $like_db=$collect[like];
       one_post($post_print, $page_numb, $like_db);
        if($post ->hasNext())
            {$post -> next();
                $flagff=TRUE;}
        else{break;}
				}

}
function best_post_month ($collect)
{
		$post_data_temp = date('m-Y');
        $filt=array(
        			postdate=>new MongoRegex ( "/{$post_data_temp}/i" ),
        			status=> "accepted");
        $post=$collect[collect_bezdna]->find($filt);                // создаем запрос для поиска
   		$post -> sort(array("like" => -1 ));
   		$post -> limit(25);                     // пока введу ограничение на поиск только из 50 пследних постов
   		$post-> rewind();
                


    while($post){

        $flagff=TRUE;
        $post_print=$post -> current();
        $like_db=$collect[like];
       one_post($post_print, $page_numb, $like_db);
        if($post ->hasNext())
            {$post -> next();
                $flagff=TRUE;}
        else{break;}
				}

}
function best_post_year ($collect, $year)
{
		$post_data_temp = $year;
        $filt=array(
        			postdate=>new MongoRegex ( "/{$post_data_temp}/i" ),
        			status=> "accepted");
        $post=$collect[collect_bezdna]->find($filt);                // создаем запрос для поиска
   		$post -> sort(array("like" => -1 ));
   		$post -> limit(25);                     // пока введу ограничение на поиск только из 50 пследних постов
   		$post-> rewind();
                


    while($post){
        $flagff=TRUE;
        $post_print=$post -> current();
        $like_db=$collect[like];
       one_post($post_print, $page_numb, $like_db);
        if($post ->hasNext())
            {$post -> next();
                $flagff=TRUE;}
        else{break;}
				}

}

function menu_top($collect, $page=0)
{
	?>
	<nav class="pagination" role="navigation">
            <ul>


	<?php
	$addr_1="/best.php?page_top=";
	$addr_2="month";
	$addr_3=$addr_1.$addr_2;
	if (!$page)
	{
		?>
                <li><span class="this-page">Сегодня</span></li>
                <li><a href="<?php echo $addr_3; ?>" rel="next">За месяц</a></li>



                <?php 
                $this_year = date('Y');
                $n=2100;
                do
                {
                	
                	$postyear=$collect[collect_bezdna]->findOne(array(postdate=>new MongoRegex ( "/{$n}/i" ),
        			status=> "accepted"));
					if($postyear)
					{
						$addr_3=$addr_1.$n;

						?>
						<li><a href="<?php echo $addr_3;?>"><?php echo $n;?></a></li>
						<?
					}
					$n--;
					

                }while($n!=2010);              

	}

	elseif($page=="month")

	{
		?>		
				<li><a href="/best.php">Сегодня</a></li>
                <li><span class="this-page">За месяц</span></li>




                <?php 
                $this_year = date('Y');
                $n=2100;
                do
                {
                	$postyear=$collect[collect_bezdna]->findOne(array(postdate=>new MongoRegex ( "/{$n}/i" ),
        			status=> "accepted"));
					if($postyear)
					{
						$addr_3=$addr_1.$n;
						?>
						<li><a href="<?php echo $addr_3;?>"><?php echo $n;?></a></li>
						<?
					}
					$n--;
					

                }while($n!=2010);



   	}
	else
	{
		$this_year = date('Y');
		?>		
				<li><a href="/best.php">Сегодня</a></li>
				<li><a href="/best.php?page_top=month">За месяц</a></li>
                <?php 
		if($this_year>$page)
		{

                $n=2100;
                do
                {
                	$postyear=$collect[collect_bezdna]->findOne(array(postdate=>new MongoRegex ( "/{$n}/i" ),
        			status=> "accepted"));
					if($postyear)
					{
						$addr_3=$addr_1.$n;
						?>
						<li><a href="<?php echo $addr_3;?>"><?php echo $n;?></a></li>
						<?
					}
					$n--;
					

                }while($n==$this_year);

		}
				?>		
                <li><span class="this-page"><?php echo $page; ?></span></li>
    
                <?php 
                $this_year = date('Y');
                $n=$page;
                $n--;
                do
                {
                	$postyear=$collect[collect_bezdna]->findOne(array(postdate=>new MongoRegex ( "/{$n}/i" ),
        			status=> "accepted"));
					if($postyear)
					{
						$addr_3=$addr_1.$n;
						?>
						<li><a href="<?php echo $addr_3;?>"><?php echo $n;?></a></li>
						<?
					}
					$n--;
					

                }while($n!=2010);

	}
	  ?>
            </ul>
        </nav>


	<?php
}



 function what_page_on_top($collect, $pagen, $status)  // функция втыкает на какой мы странице
{


		$collect = $collect -> find(array(status =>$status  )); 
		$all_post_count = $collect -> count();
		//echo "количесво всех постов $all_post_count <br>";
		$all_page_numb = intval ($all_post_count/50);
		//echo "количесво $all_post_count <br>";
		$j=$all_post_count%50;
		//echo "две переменные $all_page_numb <br> $j<br>";
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
		//echo "вывод $all_post_count<br>";
	
	return ($all_page_numb);

	}

}

?>