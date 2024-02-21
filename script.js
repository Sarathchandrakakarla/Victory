const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
const user_img = document.getElementById('user-img');
var file_upload = document.getElementById('getFile');
function img_set(evt){
  if(!confirm('Confirm To Update User Image?')){
    location.replace('admin_dashboard.php');
}
document.getElementById('user-img').src = window.URL.createObjectURL(this.files[0])
}