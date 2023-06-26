const $btnSignIn = document.querySelector('.sing-in-btn'),
    $btnSignUp = document.querySelector('.sing-up-btn'),
    $signUp = document.querySelector('.sing-up'),
    $signIn = document.querySelector('.sing-in');

    document.addEventListener('click', e =>{

        //valida los if de cada clic 
        if(e.target === $btnSignIn || e.target === $btnSignUp){
            $signIn.classList.toggle('active');
            $signUp.classList.toggle('active')
        }
    }
    
    )