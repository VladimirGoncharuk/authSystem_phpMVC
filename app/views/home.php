<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <form id="registration">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        aria-describedby="emailHelp"
                        placeholder="Введите email">
                        <input type="hidden" name="token" value="<?=$token=hash('gost-crypto', random_int(0,999999));$_SESSION["CSRF"] = $token;?>">    
                        <div class="form-control-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        aria-describedby="emailHelp"
                        placeholder="Введите имя">
                    <div class="form-control-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Пароль">
                    <div class="form-control-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="repeat-password">Повторение пароля</label>
                    <input
                        type="password"
                        class="form-control"
                        id="repeat-password"
                        name="repeat-password"
                        placeholder="Повторите пароль">
                    <div class="form-control-feedback"></div>
                </div>
                <button type="submit" id="registr" class=" btn btn-primary">Зарегистрироваться</button>
                <button type="submit" id="authorization" class=" btn btn-primary">Авторизоваться</button>
                <button type="submit" id="authVK" class="mx-5 btn btn-secondary">Авторизоваться чурез VK</button>
            </form>
        </div>
    </div>
</div>
