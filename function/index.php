<?php // include 'library.php'; ?>
<?php include 'db.php'; ?>
<h2>正三角形</h2>
<style>
    *{
        font-family:'Courier New', Courier, monospace;
    }
</style>
<?php

/* $rows= all('sales');
dd($rows);

$sales=all('sales'," where quantity >=2");
dd($sales);

$all=q("select name ,price from items order by price");
dd($all); */

//dd(find('items',3));
//dd(find('items',['name'=>'蛋餅','stock'=>50]));

/* stars('正三角形', 15);
stars('菱形', 15);
stars('矩形', 15);
stars('倒三角形', 15); */

/* $row=find('items',5);
dd($row);

$row['cost']=15;
$row['price']=45;

dd($row);

update("items", $row); */

$data=[
        'name'=>'饅頭夾蛋',
       'cost'=>20,
       'stock'=>20,
       'price'=>35];
save('items',$data);
