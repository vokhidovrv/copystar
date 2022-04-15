<?php 
session_start();
$cart=$_SESSION['cart'];
require_once "php/connect.php";
require_once "blocks/header.php";
$allprice=0;
?>
<main>
    <div class="container">
    <div class="cart__inner">
            <?php
            if($cart!=null){
            ?>
            <table class="carttable">
                <thead>
                    <tr>
                        <td colspan="2">Наименование</td>
                        <td>Вес</td>
                        <td>Количество</td>
                        <td>Сумма</td>
                        <td></td>
                    </tr>
                </thead>
                <tr></tr>
                <?php

                
                foreach ($cart as $key => $value){

                $sql="SELECT * FROM `dish` WHERE `id_dish`='$value[id_dish]'";
                $dish=$mysql->query($sql);
                $dish=$dish->fetch_assoc();
                $dish['img_dish']=base64_encode($dish['img_dish']);

                $allprice+=$dish['price']*$value['count'];
            ?>
            <tr class="cart__item" data-oneprice="<?=$dish['price']?>" data-iditem="<?=$dish['id_dish']?>">
                <td><img src="data:image/*;base64,<?=$dish['img_dish']?>" alt="">  </td>
                <td><?=$dish['name']?></td>
                <td><?=$dish['weight']?>г</td>
                <td>
                    <span class="control" data-iditem="<?=$dish['id_dish']?>">
                        <a href="#"><span class="addcount minus" data-oneprice="<?=$dish['price']?>" data-bind="minus">-</span></a>
                        <span class="count"><?=$value['count']?></span>
                        <a href="#"><span class="addcount plus" data-oneprice="<?=$dish['price']?>"  data-bind="plus">+</span></a>
                    </span>
                </td>
                <td class="price">
                    <?=$dish['price']*$value['count']?>
                </td>
                <td class="delitemcart">Удалить</td>
            </tr>
            
            
            <?php
            }
            ?>
            </table>
            <br>
            <br>
            <br>
            <br>
            <span>
                <form action="php/createorder.php" method="post" id="createorder">
                    <h1 class="allprice"></h1>
                    <input type="submit" value="Заказать" class="subbtn">
                </form>
                
            </span>
            <?php
            }else{?>
            <h1>Корзина пуста</h1>
             <?php  
            }
            ?>
            
            
        </div>
    </div>
</main>
<?php require_once "blocks/footer.php";?>