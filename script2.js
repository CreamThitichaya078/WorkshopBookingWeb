// สลับฟอร์มระหว่าง Login และ Register
const body = document.querySelector('body');
const registerLink = document.querySelector('.register-link');
const loginLink = document.querySelector('.login-link');
const wrapper = document.querySelector('.wrapper');
const iconClose = document.querySelector('.icon-close');
const btnPopup = document.querySelector('.btnLogin-popup');

registerLink.addEventListener('click', () => {
    wrapper.classList.add('active');
    body.classList.add('bg-active'); // เปลี่ยนสีพื้นหลัง
});

loginLink.addEventListener('click', () => {
    wrapper.classList.remove('active');
    body.classList.add('bg-active'); // เปลี่ยนสีพื้นหลัง
});

btnPopup.addEventListener('click', () => {
    wrapper.classList.add('active-popup');
    body.classList.add('bg-active'); // เปลี่ยนสีพื้นหลัง
});

iconClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup');
    body.classList.remove('bg-active'); // กลับเป็นปกติ
});