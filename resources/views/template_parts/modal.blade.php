<!-- Вход, регистрация -->

<div class="modal fade" id="exampleModalToggle" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-form">

            <div class="modal-header">
                <button type="button" class="modal_close" data-bs-dismiss="modal" aria-label="Close"><img
                        src="img/icons/modal-close.svg" alt="clofe-form"></button> 
            </div>

            <div class="modal-body">
                <div class="logo__modal--container">
                    <img class="logo__modal--img" src="img/icons/logo-modal.svg" alt="logo-modal">
                </div>
                <div class="buttons__group">
                    <button class="registry__submit" type="submit" data-bs-target="#enterAccount"
                            data-bs-toggle="modal">ВХОД
                    </button>
                    <button class="registry__submit registry__submit_disabled" type="submit" data-bs-target="#registryForm"
                            data-bs-toggle="modal">РЕГИСТРАЦИЯ 
                    </button>
                </div>
            </div>  

        </div>
    </div>
</div>

<!-- Форма входа -->

<div class="modal fade modal-form--enter" id="enterAccount" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-form modal-form_enter">
            <div class="modal-header">
                <button type="button" class="modal_close" data-bs-dismiss="modal" aria-label="Close"><img
                        src="img/icons/modal-close.svg" alt="clofe-form"></button>
            </div>
            <div class="modal-body">
                <div class="logo__modal--container">
                    <img class="logo__modal--img" src="img/icons/logo-modal.svg" alt="logo-modal">
                </div>

                <form class="reg__group needs-validation" action="/login" method="POST" id="signinForm" name="form-login">
                    @csrf
                    <div class="input__group">
                        <input class="registry__input--field form-control" type="text" name="email" id="email-auth"
                               >
                        <label for="promoCode" class="reg-label">Укажите почту, набранную при регистрации</label>
                        <div class="invalid-feedback">
                            Заполните пожалуйста данное поле
                        </div>
                    </div>

                    <div class="input__group">
                        <input class="registry__input--field form-control" type="password" name="password"
                               id="promoCode" >
                        <label for="promoCode" class="reg-label">Введите пожалуйста код из E-mail</label>
                        <div class="invalid-feedback">
                            Вы указали неверный код или вышло время ожидания
                        </div>
                    </div>
                        <p class="login-form_wrong-data"></p>   
                    <button class="registry__submit registry__submit--top" id="loginreport" type="submit">ВОЙТИ</button>
                    <button class="registry__submit" type="submit">ОТПРАВИТЬ КОД</button>
                </form>
            </div>
        </div>

    </div> 
</div>


<!-- Форма регистрации -->

<div class="modal fade" id="registryForm" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-form new-user-form" data-variant="registry-user">
            <div class="modal-header">
                <button type="button" class="modal_close" data-bs-dismiss="modal" aria-label="Close"><img
                        src="img/icons/modal-close.svg" alt="clofe-form"></button>
            </div>
            <div class="modal-body modal-body__registration_desc modal-body__registration_mobile">
                <div class="logo__modal--container">
                    <img class="logo__modal--img" src="img/icons/logo-modal.svg" alt="Logo">
                </div>
                <form class="reg__group modal-form-registry needs-validation" action="/registration-user" method="POST" id="registerprovider" name="form-registration" enctype="multipart/form-data">
                    @csrf
                    <div class="input__group has-validation">
                        <input class="registry__input--field form-control modal-form-registry-required" type="text" name="name" id="firstName">
                        <label for="firstName" class="reg-label ">ИМЯ</label>
                        <div class="invalid-feedback">
                            Заполните, пожалуйста, имя
                        </div>
                    </div>
                    <div class="input__group has-validation">
                        <input class="registry__input--field form-control modal-form-registry-required" type="text" name="second_name" id="second_name">
                        <label for="secondName" class="reg-label">ФАМИЛИЯ</label>
                        <div class="invalid-feedback">
                            Заполните, пожалуйста, фамилию
                        </div>
                    </div>
                    <div class="input__group">
                        <input class="registry__input--field form-control modal-form-registry-required" type="text" name="patronymic" id="patronymic">
                        <label for="fathersName" class="reg-label">ОТЧЕСТВО</label>
                        <div class="invalid-feedback">
                            Заполните, пожалуйста, отчество
                        </div>
                    </div>
                    <div class="input__group">
                        <input class="registry__input--field form-control modal-form-registry-required" type="text" name="phone" data-phone-pattern id="phone">
                        <label for="fathersName" class="reg-label">НОМЕР ТЕЛЕФОНА</label>
                        <div class="invalid-feedback">
                            Некорректный номер телефона
                        </div>
                    </div>

                    <div class="input__group">
                        <input class="registry__input--field  modal-form-registry-email form-control modal-form-registry-required" type="text" name="email" id="email">
                        <label for="email" class="reg-label">ПОЧТА</label>
                        <div class="invalid-feedback">
                            Некорректная электронная почта
                        </div>
                    </div>
                    <label for="email" class="reg-label reg-label--post--layout">внимание!<br class="br-mob"> именно на
                        электронную почту придет<br class="br-mob"> подтверждение выигрыша!
                    </label>

                    <ul class="registry-form__list">
                        <li class="registry-form__item">
                            <div class="registry-form__wr-address">
                                <label for="registry-form__address-index">индекс</label>
                                <div class="registry-form__address-wr-input">
                                    <input type="text" name="index" id="registry-form__address-index">
                                </div>
                            </div>
                        </li>
                        <li class="registry-form__item">
                            <div class="registry-form__wr-address">
                                <label for="registry-form__address-area">область</label>
                                <div class="registry-form__address-wr-input">
                                    <input type="text" name="area" id="registry-form__address-area">
                                </div>
                            </div>
                            <div class="registry-form__wr-address">
                                <label for="registry-form__address-district">район</label>
                                <div class="registry-form__address-wr-input">
                                    <input type="text" name="district" id="registry-form__address-district">
                                </div>
                            </div>
                        </li>
                        <li class="registry-form__item">
                            <div class="registry-form__wr-address">
                                <label for="registry-form__address-settlement">город (населенный пункт)</label>
                                <div class="registry-form__address-wr-input">
                                    <input class="modal-form-registry-required" type="text" name="settlement" id="registry-form__address-settlement">
                                </div>
                            </div>
                            <div class="registry-form__wr-address">
                                <label for="registry-form__address-street">улица</label>
                                <div class="registry-form__address-wr-input">
                                    <input class="modal-form-registry-required" type="text" name="street" id="registry-form__address-street">
                                </div>
                            </div>
                        </li>
                        <li class="registry-form__item">
                            <div class="registry-form__wr-address">
                                <label for="registry-form__address-house">дом</label>
                                <div class="registry-form__address-wr-input">
                                    <input class="modal-form-registry-required" type="text" name="house" id="registry-form__address-house">
                                </div>
                            </div>
                            <div class="registry-form__wr-address">
                                <label for="">квартира (офис)</label>
                                <div class="registry-form__address-wr-input">
                                    <input type="text" name="appartment" id="registry-form__address-apartment">
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="file-upload__group file-upload__registry input__group">

                        <p class="reg-label reg-label--check file-upload__title">
                            Чтобы закончить регистрацию, обязательно загрузите чек, он должен быть читабельным
                        </p>
 
                        <div class="file-upload__back">
                            <label class="file-upload__label" for="checkLoadLabel">
                                загрузить чек
                                <input class="form-reg__file-input file__upload--input form-control" id="checkLoadLabel" type="file" name="file[]" aria-label="file example" accept="image/*" multiple>
                            </label>
                        </div>
                    
                        <div class="invalid-feedback invalid-feedback--check" id="file-info">Извините, но без чека вы не
                            можете принять<br class="br-mob"> участие в акции
                        </div>

                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck">
                        <label class="form-check-label" for="invalidCheck">
                <span>
                  Я прочитал и согласен с <a href="#">Правилами Акции и Пользовательским соглашением</a>,
                  согласен на обработку персональных данных
                </span>
                            <span>
                  Я согласен на получение e-mail рассылки
                </span>

                        </label>

                    </div>

                    <button class="registry__submit" type="submit">ЗАРЕГИСТРИРОВАТЬСЯ</button>

                </form>

            </div>
        </div>
    </div>
</div>
