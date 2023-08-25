// START GLOBLE JAVASCRIPT CODE






let mobileMenuIcon = document.querySelector('.mobile-nav-menu-icon i');
let mobileMenu      = document.querySelector('.mobile-nav-content');
let mobileMenuCloseBtn = document.querySelector('.mobile-nav-content .close-menu');


mobileMenuIcon.addEventListener('click',()=>{
    mobileMenu.style.right = '0%';
});
mobileMenuCloseBtn.addEventListener('click',()=>{
    mobileMenu.style.right = '-100%';
});



//Show login form container
function showLoginFormContainer(){
    document.querySelector('.login-form-container').style.display = 'block'
}

//Close login form container
document.querySelector('.close').onclick = function(){
    document.querySelector('.login-form-container').style.display = 'none'
}






// Close user login welcome message

function closeWelcomeMsg(){
    document.querySelector('.success-login-welcome-msg-container').style.display = 'none'
}

function closeMemberNotActiveErrorMsg(){
    document.querySelector('.member-not-active-container').style.display = 'none'
}


// if(document.querySelector('.success-login-welcome-msg-container').style.display == 'block'){
//     setTimeout(function (){
//         document.querySelector('.success-login-welcome-msg-container').style.display = 'none'
//     },5000);
// }
//
//






function JoinGetColor(){
    const colorInput = document.getElementById('signatures_text_color').value;
    const colorValue = document.getElementById('signatures_color_value').value = colorInput;
}
// END GLOBLE JAVASCRIPT CODE
