const registerButton = document.getElementById("register");
const loginButton = document.getElementById("login");
const container = document.getElementById("container");

registerButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

loginButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});
document.addEventListener('DOMContentLoaded', function() {
  const registerForm = document.getElementById('registerForm');
  const nameInput = document.getElementById('name');
  const phoneInput = document.getElementById('phone');
  const dobInput = document.getElementById('dob');
  const passwordInput = document.getElementById('password');
  const passwordError = document.getElementById('passwordError');

  // Name validation function
  function validateName(name) {
      const nameWords = name.trim().split(/\s+/);
      return nameWords.length >= 2 && 
             nameWords.every(word => 
                 word.length > 0 && 
                 word[0] === word[0].toUpperCase() && 
                 word.slice(1) === word.slice(1).toLowerCase()
             );
  }

  // Phone number validation function
  function validatePhone(phone) {
      // Chỉ kiểm tra đúng 10 số
      return /^\d{10}$/.test(phone.replace(/\s+/g, ''));
  }

  // Age validation function
  function validateAge(dobString) {
      const dob = new Date(dobString);
      const today = new Date();
      
      let age = today.getFullYear() - dob.getFullYear();
      const monthDiff = today.getMonth() - dob.getMonth();
      
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
          age--;
      }
      
      return age >= 18;
  }

  // Hàm tạo và hiển thị lỗi
  function showError(input, message) {
      // Xóa lỗi cũ nếu có
      const existingError = input.nextElementSibling;
      if (existingError && existingError.classList.contains('error-message')) {
          existingError.remove();
      }
      
      // Tạo và thêm thông báo lỗi mới
      const errorElement = document.createElement('div');
      errorElement.className = 'error-message';
      errorElement.style.color = 'red';
      errorElement.textContent = message;
      input.parentNode.insertBefore(errorElement, input.nextSibling);
  }

  // Hàm xóa lỗi
  function clearError(input) {
      const existingError = input.nextElementSibling;
      if (existingError && existingError.classList.contains('error-message')) {
          existingError.remove();
      }
  }

  // Validation cho từng trường ngay khi nhập
  nameInput.addEventListener('input', function() {
      if (validateName(this.value)) {
          clearError(this);
      } else {
          showError(this, 'Vui lòng nhập họ tên đúng định dạng (ít nhất 2 từ, viết hoa chữ cái đầu)');
      }
  });

  phoneInput.addEventListener('input', function() {
      if (validatePhone(this.value)) {
          clearError(this);
      } else {
          showError(this, 'Số điện thoại phải đúng 10 chữ số');
      }
  });

  dobInput.addEventListener('change', function() {
      if (validateAge(this.value)) {
          clearError(this);
      } else {
          showError(this, 'Bạn phải đủ 18 tuổi để đăng ký');
      }
  });

  passwordInput.addEventListener('input', function() {
      const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
      if (passwordRegex.test(this.value)) {
          passwordError.style.display = 'none';
      } else {
          passwordError.style.display = 'block';
      }
  });

  // Validation khi submit form
  registerForm.addEventListener('submit', function(event) {
      event.preventDefault();
      
      let isValid = true;

      // Kiểm tra tên
      if (!validateName(nameInput.value)) {
          showError(nameInput, 'Vui lòng nhập họ tên đúng định dạng (ít nhất 2 từ, viết hoa chữ cái đầu)');
          isValid = false;
      }

      // Kiểm tra số điện thoại
      if (!validatePhone(phoneInput.value)) {
          showError(phoneInput, 'Số điện thoại phải đúng 10 chữ số');
          isValid = false;
      }

      // Kiểm tra tuổi
      if (!validateAge(dobInput.value)) {
          showError(dobInput, 'Bạn phải đủ 18 tuổi để đăng ký');
          isValid = false;
      }

      // Kiểm tra mật khẩu
      const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
      if (!passwordRegex.test(passwordInput.value)) {
          passwordError.style.display = 'block';
          isValid = false;
      } else {
          passwordError.style.display = 'none';
      }

      // Nếu tất cả đều hợp lệ thì submit form
      if (isValid) {
          registerForm.submit();
      }
  });
});