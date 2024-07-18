function authorize() {
    const formSignIn = document.getElementById('signinForm');

    formSignIn.addEventListener('submit', SendAuth);

    async function SendAuth(event) { 
        event.preventDefault();
        const email = formSignIn.querySelector('[name="email"]') //получаем поле name
        const password = formSignIn.querySelector('[name="password"]') //получаем поле age
        const wrong_data = formSignIn.querySelector('.login-form_wrong-data') // поле для показа правильно ли введены данные

        let validateEmail = null;

        if(email.value) {
          validateEmail = /^\S+@\S+\.\S+$/g.test(email.value);
        }

        if(!email.value || !password.value || !validateEmail) {
          
          if(!email.value || !validateEmail) {
            email.classList.add('invalid');
            email.nextElementSibling.textContent = 'Вы указали некорректную почту';
            email.nextElementSibling.style = 'color: #FFC0C0;';
            email.style = 'border: 1px solid #FFC0C0;';
          } else if (email.value && email.matches('.invalid')) {
            email.classList.remove('invalid');
            email.nextElementSibling.textContent = 'Укажите почту, набранную при регистрации';
            email.nextElementSibling.style = 'color: #ffffff;';
            email.style = 'border: 0;';
          }


          if(!password.value) {
            email.classList.add('invalid');
            password.nextElementSibling.textContent = 'Вы указали неверный код или вышло время ожидания';
            password.nextElementSibling.style = 'color: #FFC0C0;';
            email.style = 'border: 1px solid #FFC0C0;';
          } else if (password.value && password.matches('.invalid')) {
            password.classList.remove('invalid');
            password.nextElementSibling.textContent = 'Введите, пожалуйста, код из E-mail';
            password.nextElementSibling.style = 'color: #ffffff;';
            password.style = 'border: 0;';
          }

          return;
        }

        try {
          const form_data = new FormData(event.target);
          controllLoader.show();
          const response = await fetch('/check-user', {
            method: "POST",
              headers: {
                  "X-CSRF-Token": form_data.get('_token'),
              },
              body: form_data,
          })
  
          // проверяем правильность данных, при правильно 
          // пускаем работу формы дальше
          const json = await response.json();
          controllLoader.hide();
          json.result ? event.target.submit() : wrong_data.textContent = 'Введён неверный логин или пароль';
        } catch(e) {
          console.log(e);
        }
        
    }
}


function registration() {
    // форма регистрации
    const formSignIn = document.getElementById('registerprovider');
    
    const name = formSignIn.querySelector('[name="name"]'), //получаем поле name
      second_name = formSignIn.querySelector('[name="second_name"]'), //получаем поле name
      patronymic = formSignIn.querySelector('[name="patronymic"]'), //получаем поле patronymic
      phone = formSignIn.querySelector('[name="phone"]'), //получаем поле phone
      email = formSignIn.querySelector('[name="email"]'), //получаем поле email
      settlement = formSignIn.querySelector('[name="settlement"]'), //получаем поле населенный пункт
      street = formSignIn.querySelector('[name="street"]'), //получаем поле улица
      house = formSignIn.querySelector('[name="house"]'), //получаем поле дом
      apartment = formSignIn.querySelector('[name="appartment"]'), //получаем поле квартира (офис)
      check = formSignIn.querySelector('.form-reg__file-input'), //получаем поле с файлами

      conditions = formSignIn.querySelector('.form-check-input');


    // валидация на корректность ввода, проверка на уникальность вводимого email
    let validateEmail = null;
    let checkEmail = null; // проверка на уже зарегистрированный email
    let tmId;
    email.addEventListener('input', handlerCheckEmail);
    function handlerCheckEmail(e) {
      if(tmId) clearTimeout(tmId);

      if(email.value) {
        validateEmail = /^\S+@\S+\.\S+$/g.test(email.value);
      }
        
      tmId = setTimeout(async () => {
        const value = e.target.value
        if(value && validateEmail) {
          try {
            const response  = await fetch('/check-email', {
              method : "POST",
              headers : {
                "X-CSRF-Token" : formSignIn._token.value,
                "Content-Type" : "application/json",
              },
              body : JSON.stringify({email : value})
            });
  
            const json = await response.json();
  
            if(json.result) {
              email.classList.add('invalid');
              email.nextElementSibling.textContent = 'Пользователь с такой электронной почтой уже зарегистрирован';
              email.nextElementSibling.style = 'color: #FFC0C0;';
              email.style = 'border: 1px solid #FFC0C0;';
              email.classList.add('modal-form-registry-no-valid');

              checkEmail = false;
            } else {
              email.classList.remove('invalid');
              email.nextElementSibling.textContent = 'почта';
              email.nextElementSibling.style = 'color: #ffffff;';
              email.style = 'border: 0;';
              email.classList.remove('modal-form-registry-no-valid');

              checkEmail = true;
            }
          } catch (error) {
            console.log(error)
          }
          
        }
      }, 700);
    }
   

    // событие на загрузку чека
    // для результатa валидации чека
    let validateVoucher = null;
    // label для вывода результата загрузки чека
    const el = formSignIn.querySelector('.file-upload__title');
    check.addEventListener('change', (e) => {

        const files = e.target.files;

        const isLength = files.length <= 6 && files.length !== 0;
        const isValid = [...files].every(item => {
            const fileType = item.type;
            const fileSize = item.size;
    
            return /^image\/.+$/.test(fileType) && fileSize <= 10485760;
        })

        validateVoucher = isLength && isValid;


        if(!isValid) {
          check.classList.add('invalid');
          el.textContent = 'Чек должен быть изображением и не превышать 10МБ';
          el.style.color = '#FFC0C0';
        } else if(!isLength) {
            el.textContent = 'За один раз Вы можете выбрать не более 6 файлов';
            el.style.color = '#FFC0C0';
        } else {
          check.classList.remove('invalid');
          el.textContent = 'Ваш чек успешно загружен';
          el.style.color = '#ffffff';
        }

    })


    // Валидация, показ ошибок и отправка
    formSignIn.addEventListener('submit', SendRegister);
    async function SendRegister(event) {

        // Проверяем все поля, если где то не заполненно или не соответствует условиям
        // показываем в этом поле ошибку
        if(!name.value || !second_name.value || !patronymic.value
          || !phone.value || !email.value || !settlement.value || !street.value || !house.value 
          || !validateVoucher || !conditions.checked || !validateEmail || !checkEmail) {
            event.preventDefault();
            // если все верно то страница перезагрузится и ничего менять не надо,
            // все само сбросится, иначе если хоть одно условие не верно,
            // а какие то верно то убираем ошибку на верных
            if(!name.value) {
              name.classList.add('invalid');
              name.nextElementSibling.textContent = 'Заполните, пожалуйста, имя';
              name.nextElementSibling.style = 'color: #FFC0C0;';
              name.style = 'border: 1px solid #FFC0C0;';
              name.classList.add('modal-form-registry-no-valid');
            } else if (name.value && name.matches('.invalid')) {
              name.classList.remove('invalid');
              name.nextElementSibling.textContent = 'имя';
              name.nextElementSibling.style = 'color: #ffffff;';
              name.style = 'border: 0;';
              name.classList.remove('modal-form-registry-no-valid');
            }

            if(!second_name.value) {
              second_name.classList.add('invalid');
              second_name.nextElementSibling.textContent = 'Заполните, пожалуйста, фамилию';
              second_name.nextElementSibling.style = 'color: #FFC0C0;';
              second_name.style = 'border: 1px solid #FFC0C0;';
              second_name.classList.add('modal-form-registry-no-valid');
            } else if (second_name.value && second_name.matches('.invalid')) {
              second_name.classList.remove('invalid');
              second_name.nextElementSibling.textContent = 'фамилия';
              second_name.nextElementSibling.style = 'color: #ffffff;';
              second_name.style = 'border: 0;';
              second_name.classList.remove('modal-form-registry-no-valid');
            }
 
            if(!patronymic.value) {
              patronymic.classList.add('invalid');
              patronymic.nextElementSibling.textContent = 'Заполните, пожалуйста, отчество';
              patronymic.nextElementSibling.style = 'color: #FFC0C0;';
              patronymic.style = 'border: 1px solid #FFC0C0;';
              patronymic.classList.add('modal-form-registry-no-valid');
            } else if (patronymic.value && patronymic.matches('.invalid')) {
              patronymic.classList.remove('invalid');
              patronymic.nextElementSibling.textContent = 'отчество';
              patronymic.nextElementSibling.style = 'color: #ffffff;';
              patronymic.style = 'border: 0;';
              patronymic.classList.remove('modal-form-registry-no-valid');
            }

            if(!phone.value) {
              phone.classList.add('invalid');
              phone.nextElementSibling.textContent = 'Некорректный номер телефона';
              phone.nextElementSibling.style = 'color: #FFC0C0;';
              phone.style = 'border: 1px solid #FFC0C0;';
              phone.classList.add('modal-form-registry-no-valid');
            } else if (phone.value && phone.matches('.invalid')) {
              phone.classList.remove('invalid');
              phone.nextElementSibling.textContent = 'Номер телефона';
              phone.nextElementSibling.style = 'color: #ffffff;';
              phone.style = 'border: 0;';
              phone.classList.remove('modal-form-registry-no-valid');
            }

            if(!email.value || (email.value && !validateEmail)) {
              email.classList.add('invalid');
              email.nextElementSibling.textContent = 'Некорректная электронная почта';
              email.nextElementSibling.style = 'color: #FFC0C0;';
              email.style = 'border: 1px solid #FFC0C0;';
              email.classList.add('modal-form-registry-no-valid');
            } else if(email.value && validateEmail && !checkEmail) { 
              // все норм, но не прошел проверку на наличие в базе
              email.classList.add('invalid');
              email.nextElementSibling.textContent = 'Пользователь с такой электронной почтой уже зарегистрирован';
              email.nextElementSibling.style = 'color: #FFC0C0;';
              email.style = 'border: 1px solid #FFC0C0;';
              email.classList.add('modal-form-registry-no-valid');
            } else if (email.value && validateEmail) {
              email.classList.remove('invalid');
              email.nextElementSibling.textContent = 'почта';
              email.nextElementSibling.style = 'color: #ffffff;';
              email.style = 'border: 0;';
              email.classList.remove('modal-form-registry-no-valid');
            }

            if(!settlement.value) {
              settlement.classList.add('invalid');
              settlement.style = 'border: 1px solid #FFC0C0;';
              settlement.classList.add('modal-form-registry-no-valid');

              const parent = settlement.parentElement;
              const elLabel = parent.previousElementSibling;
              elLabel.textContent = 'Заполните пожалуйста, город';
              elLabel.style = 'color: rgb(255, 192, 192); padding-left: 0.1vw;';
            } else if (settlement.value && settlement.matches('.invalid')) {
              settlement.classList.remove('invalid');
              settlement.style.border = '';
              settlement.classList.remove('modal-form-registry-no-valid');

              const parent = settlement.parentElement;
              const elLabel = parent.previousElementSibling;
              elLabel.textContent = 'город';
              elLabel.style = 'color: #ffffff;';
            }
            
            if(!street.value) {
              street.classList.add('invalid');
              street.style = 'border: 1px solid #FFC0C0;';
              street.classList.add('modal-form-registry-no-valid');

              const parent = street.parentElement;
              const elLabel = parent.previousElementSibling;
              elLabel.textContent = 'Заполните пожалуйста, улица';
              elLabel.style = 'color: rgb(255, 192, 192); padding-left: 0.1vw;';
            } else if (street.value && street.matches('.invalid')) {
              street.classList.remove('invalid');
              street.style.border = '';
              street.classList.remove('modal-form-registry-no-valid');

              const parent = street.parentElement;
              const elLabel = parent.previousElementSibling;
              elLabel.textContent = 'улица';
              elLabel.style = 'color: #ffffff;';
            }
            
            if(!house.value) {
              house.classList.add('invalid');
              house.style = 'border: 1px solid #FFC0C0;';
              house.classList.add('modal-form-registry-no-valid');

              const parent = house.parentElement;
              const elLabel = parent.previousElementSibling;
              elLabel.textContent = 'Заполните пожалуйста, дом';
              elLabel.style = 'color: rgb(255, 192, 192); padding-left: 0.1vw;';
            } else if (house.value && house.matches('.invalid')) {
              house.classList.remove('invalid');
              house.style.border = '';
              house.classList.remove('modal-form-registry-no-valid');

              const parent = house.parentElement;
              const elLabel = parent.previousElementSibling;
              elLabel.textContent = 'дом';
              elLabel.style = 'color: #ffffff;';
            }

            if(!validateVoucher) {
              check.classList.add('invalid');

              const el = formSignIn.querySelector('.file-upload__title');
              el.textContent = 'Извините, но без чека вы не можете принять участие в акции';
              el.style.color = '#FFC0C0';
            } else if (validateVoucher && check.matches('.invalid')) {
              apartment.classList.remove('invalid');

              const el = formSignIn.querySelector('.file-upload__title');
              el.textContent = 'Загрузите, пожалуйста, чек (внимание, чек должен быть читабельным)';
              el.style.color = '#ffffff';
            }

            if(!conditions.checked) {
              conditions.classList.add('invalid-conditions');
              conditions.style = `border: 2px solid #FFC0C0;`;
            } else if(conditions.checked && conditions.matches('.invalid-conditions')) {
              conditions.classList.remove('invalid-conditions');
              conditions.style = `border: 0;`;
            }

            return;
          }

          controllLoader.show();
    }
}



function controllMobileMenu() {
  // mobile menu работает от класса show 
  const navBar = document.querySelector('.navbar-collapse');

  document.addEventListener('click', (e) => {
    if(!e.target.matches('.navbar-navq')) {
      navBar.classList.remove('show');
    }
  })
}

function registerEvents() {
  authorize();
  registration();
  controllMobileMenu();
}

$( document ).ready(function() {
  registerEvents();
})
