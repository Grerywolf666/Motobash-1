<?php


function mongodb_connect_bezdna ()
{  

	$ur="mongodb://MotoBash:MR_xeniper993A_@mc.grosvold.ru:27117/motobashdb";
	//$ur="mongodb://wolfadmin:motoadmin@ds053090.mongolab.com:53090/motobashdb";
    $Connection = new Mongo($ur);
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

	

function post_page_bezdna($page_numb=0, $collect, $status, $show_admin=0)   // печатает посты бездны
{	
	$post_all=$collect[collect_bezdna]; 
	$post=postn_bezdna($page_numb, $collect[collect_bezdna], $status); // достаем из базы требуемое нам количество постов, и курсор с данной выборкой запихиваем $post

	while($post){
		
		$post_print=$post -> current();





		 
		$post_numb_on_page=$page_numb;
		$like_db=$collect[like];
		one_post($post_print, $page_numb, $like_db, $show_admin);
		
		if($post ->hasNext())   // печатаем пока можем
			{$post -> next();}
		else{break;}

	}
	
}

function one_post( $post_print, $page_numb, $like_db, $show_admin=0)  // функция которая рисует наш пост. выкинул сюда ибо надоело таскать кучу кода за собой
{

		?>
		<!--start QUITE BLOCK-->
        <div class="post">
            <header>
            <? $adr1="/post?number=";
            	$adr2="$post_print[numb]";
            	$adr3=$adr1.$adr2;?>

                <a href="<? echo $adr3; ?>" class="id item"><?php echo $post_print[numb];?></a>
                <time class="item" datetime="123"><? echo $post_print[postdate]; ?></time>
                <a class="share item" href="#">Поделиться</a>
                <span class="rate item">
                    <a class="cool item" href="#">+</a>
                    <span class="rating item"><?php echo $post_print[like]; ?></span>
                    <a class="crap item" href="#">-</a>
                </span>
            </header>
            <article><?php echo nl2br($post_print[posttext]);?>
            </article>
            <?php if ($show_admin)
            { ?>
            <div class="edit">
                <form  action="edit" method="POST">
                    <input name="post_numb_in_base" type="hidden" value="<?php echo $post_print[numb];?>">
                    <input name="Edit" type="submit" value="Edit">
                </form>
            </div>
            <?php }?>
        </div>
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
	$adr='/svalka?pagen=';
	if($page==0)
	{
		$page=$all_page_numb;
	}

	?>

	<!--start PAGINATION BLOCK-->
        <div class="pagination" role="navigation">
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
        </div>
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
	return $nn;
}
function best_post_today ($collect, $show_admin)
{
		$post_data_temp = date('d-m-Y');
        $filt=array(
        			postdate=>new MongoRegex ( "/{$post_data_temp}/i" ),
        			status=> "accepted");
        $post=$collect[collect_bezdna]->find($filt);                // создаем запрос для поиска
        $all_post_count = $post -> count();
        if($all_post_count>0)
        {
   		$post -> sort(array("like" => -1 ));
   		$post -> limit(25);                     // пока введу ограничение на поиск только из 50 пследних постов
   		$post-> rewind();
                


    while($post){
        $post_print=$post -> current();
        $like_db=$collect[like];
       one_post($post_print, $page_numb, $like_db, $show_admin);

        if($post ->hasNext())
            {$post -> next();

              }
       			 else{break;}

				}
			}
			else
			{
				echo "Сегодня еще небыло постов!";
			}

}
function best_post_month ($collect, $show_admin)
{
		$post_data_temp = date('m-Y');
        $filt=array(
        			postdate=>new MongoRegex ( "/{$post_data_temp}/i" ),
        			status=> "accepted");
        $post=$collect[collect_bezdna]->find($filt);                // создаем запрос для поиска
        $all_post_count = $post -> count();
        if($all_post_count>0)
        {
   		$post -> sort(array("like" => -1 ));
   		$post -> limit(25);                     // пока введу ограничение на поиск только из 50 пследних постов
   		$post-> rewind();
                


    while($post){

        $flagff=TRUE;
        $post_print=$post -> current();
        $like_db=$collect[like];
       one_post($post_print, $page_numb, $like_db, $show_admin);

        if($post ->hasNext())
            {$post -> next();
                $flagff=TRUE;}
        else{break;}
				}
			}
			else
			{
				echo "В этом месяце еще не было постов!";
			}

}
function best_post_year ($collect, $year, $show_admin)
{
		$post_data_temp = $year;
        $filt=array(
        			postdate=>new MongoRegex ( "/{$post_data_temp}/i" ),
        			status=> "accepted");
        $post=$collect[collect_bezdna]->find($filt);                // создаем запрос для поиска
         $all_post_count = $post -> count();
        if($all_post_count>0)
        {
   		$post -> sort(array("like" => -1 ));
   		$post -> limit(25);                     // пока введу ограничение на поиск только из 50 пследних постов
   		$post-> rewind();
                


    while($post){
        $flagff=TRUE;
        $post_print=$post -> current();
        $like_db=$collect[like];
       one_post($post_print, $page_numb, $like_db, $show_admin);

        if($post ->hasNext())
            {$post -> next();
                $flagff=TRUE;}
        else{break;}
				}
			}
			else
			{
				echo "В этом году еще не было постов!";
			}


}

function menu_top($collect, $page=0)
{
	?>
	<div class="pagination" role="navigation">
            <ul>


	<?php
	$addr_1="/best?page_top=";
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
				<li><a href="/best">Сегодня</a></li>
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
				<li><a href="/best">Сегодня</a></li>
				<li><a href="/best?page_top=month">За месяц</a></li>
                <?php 
		

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
					

                }while($n!=$page);

		
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
        </div>


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

function like_accept($coockie, $numb)
{
    if($numb==$coockie)
    {
        return(FALSE);
    }
    else
        return(TRUE);
}
?>