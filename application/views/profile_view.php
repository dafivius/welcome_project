<h1>ПРОФИЛЬ</h1>

<div class="login-form"> <!-- класс логин формы для выравнивания по центру -->

    <form action="" method="post" id="forphone">
        <input type="text" id="phone" name="phone" placeholder="Введите Ваш телефон">

            <div class="btn-group-vertical" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" name="option" id="option1" value="0" checked="checked">Мобильный
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="option" id="option2" value="1">Домашний
                </label>
            </div>

        <button type="submit" name="go" class="btn-lg btn-primary btn-block">Добавить телефон</button>
<!--        <button type="submit" name="go" class="btn btn-default">Добавить</button>-->
    </form>
    
    
<table class="table table-bordered">
    <thead>
    <tr><th>Телефон</th><th>Тип</th></tr>
    </thead>
    <tbody>
        <?php
        // var_dump($data);
        foreach($data as $row)
            {
                $row['phone_type'] == 0 ? $row['phone_type'] = "Мобильный" : $row['phone_type'] = "Домашний";

                echo '<tr><td>'.$row['phone_number'].'</td><td>'.$row['phone_type'].'</td></tr>';
            }
        ?>
    </tbody>
</table>
    <form action="" method="post">
        <button type="submit" name="logout" value="logout" class="btn-lg btn-primary btn-block">Log Out</button>
<!--        <button name="logout" value="logout" class="btn btn-lg">Logout</button>-->
    </form>
</div>