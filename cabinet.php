<?php 
require_once "php/connect.php";
require_once "blocks/header.php";
$user=$_SESSION['user'];
$sql="SELECT * FROM `categories`";
$categories=$mysql->query($sql);

?>
<main>
    <div class="container">
            <div class="tabs">
                <div class="tabs_header">
                    <ul>
                        <li class="active">Изменить профиля</li>
                        <li>Просмотреть свои заказы</li>
                        <?php
                        if($user['role']=='admin'){

                        
                        ?>
                        <li>Добавить продукт</li>
                        <li>Добавить категорию</li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="tabs_content">
                    <ul>
                    <li class="active">
                    <div class="cabinet">
                        <!-- <h1>Личный кабинет</h1> -->
                            <div class="user__info">
                                <form action="php/new_info.php" method="post" id="info_user">
                                    <div class="col">
                                        <p>
                                            <label for="">Имя:</label> <input type="text" name="name_user" value="<?= $user['name_user']?>">
                                        </p>
                                        <p>
                                            <label for="">Фамилия:</label> <input type="text" name="surname_user" value="<?= $user['surname_user']?>">
                                        </p>
                                        <p>
                                            <label for="">Отчество:</label> <input type="text" name="secondname_user" value="<?= $user['secondname_user']?>">
                                        </p>
                                        <p>
                                            <label for="">Логин:</label> <input type="text" name="user_login" id="new_login" value="<?= $user['login']?>">
                                        </p>
                                        <p>
                                            <label for="">Пароль:</label> <input type="text" name="user_pass" value="<?= $user['pass']?>">
                                        </p>
                                        <div class="errormsg"></div>
                                    </div>
                                <input type="submit" value="Изменить" class="subbtn">
                            </form>
                        </div>           
                    </div>
                    </li>
                    <li>
                        <div class="order__user">
                                <h1>Ваши заказы</h1>
                                <?php
                                if($order){

                                
                                while($order=$orders->fetch_assoc()){
                                    echo $order['order_date'];
                                    
                                ?>
                                <div class="order">
                                    <h1>Заказ:<?= $order['id_orders']?></h1>
                                    <h2>Дата заказа:<?=$order['date']?></h2>
                                    <h2>Сумма:<?= $order['sum_order']?></h2>
                                </div>
                                <?php

                                }
                            }else{
                                echo "Заказов нет";
                            }
                                ?>
                        </div>
                        </li>
                        <?php
                        if($user['role']=='admin'){

                        
                        ?>
                        <li>
                            <div class="add_product">
                                <h1 class="title">Добавить продукт</h1>
                                <form action="php/add_product.php" method="post" id="form-add-product" enctype="multipart/form-data">
                                    <div class="info_product">
                                        <span>
                                            <input type="file" name="img_product" id="img_product" accept="image/*" style="display: none;">
                                            <label for="img_product">
                                                <img src="img/download.png" alt="" id="new-img_product">

                                            </label><br><br>
                                        </span>
                                        <span>
                                            <p> 
                                                <h2>Название товара</h2>
                                                <input type="text" name="name_product">
                                            </p>
                                            <p>
                                                <h2>Описание товара</h2>
                                                <textarea name="about_product" cols="" rows="" ></textarea>
                                            </p>
                                            <p>
                                                <h2>Цена товара</h2>
                                                <input name="price_product" class="onlyinp" max=9>
                                            </p>
                                            <p><br><br>
                                            <select name="category" id="category">
                                                <option value="" style="display: none;">категория</option>
                                                <?php
                                                while($cateroy=$categories->fetch_assoc()){
                                                ?>
                                                <option value="<?=$cateroy['id_category']?>"><?=$cateroy['name']?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            </p>
                                    </span>  
                                    </div> 
                                    <input type="submit" class="subbtn" value="Загрузить">
                                </form>
                            </div>
                        </li>
                        <li>
                            <div class="add_category">
                                <h1 class="title">Добавить категорию</h1>
                                <form action="php/add_caregory.php" method="POST" id="form-add_category"> 
                                    <input type="text" name="name_category">
                                    <input type="submit" value="Добавить" class="subbtn">
                                   
                                </form>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                    
                    
                </div>
            </div>
        </div>

</main>
<?php require_once "blocks/footer.php";?>
