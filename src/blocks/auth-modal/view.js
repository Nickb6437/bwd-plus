// Frontend js file

document.addEventListener('DOMContentLoaded', () => {
  const modalOpen = document.querySelectorAll('.open-modal');
  const modalClose = document.querySelectorAll(
    '.modal-btn-close, .modal-overlay'
  );
  const modal = document.querySelector('.wp-block-bwd-plus-auth-modal');
  const tabs = document.querySelectorAll('.tabs a');
  const signinForm = document.querySelector('#signin-tab');
  const signupForm = document.querySelector('#signup-tab');

  modalOpen.forEach(el => {
    el.addEventListener('click', e => {
      e.preventDefault();
      modal.classList.add('modal-show');
    });
  });

  modalClose.forEach(el => {
    el.addEventListener('click', e => {
      e.preventDefault();
      modal.classList.remove('modal-show');
    });
  });

  tabs.forEach(tab => {
    tab.addEventListener('click', e => {
      e.preventDefault();

      tabs.forEach(tab => tab.classList.remove('active-tab'));
      tab.classList.add('active-tab');

      const tabId = e.target.getAttribute('href');
      const tabContent = document.querySelector(tabId);    

      if (tabContent === signinForm) {
        signupForm.style.display = 'none';
        signinForm.style.display = 'block';
      } else {
        signinForm.style.display = 'none';
        signupForm.style.display = 'block';
      }
    });
  });

  // Signin form
  signupForm.addEventListener('submit', async e => {
    e.preventDefault();
    const signupFieldset = signupForm.querySelector('fieldset');
    signupFieldset.setAttribute('disabled', true);

    const signupStatus = signupForm.querySelector('#signup-status');
    signupStatus.innerHTML = `
      <div class="modal-status modal-status-info">
        Please wait we are signing you in...
      </div>
    `;

    const formData = {
      username: signupForm.querySelector('#su-name').value,
      email: signupForm.querySelector('#su-email').value,
      password: signupForm.querySelector('#su-password').value,
    }

    const response = await fetch(bwdAuthRest.signup, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formData),
    });

    const responseJson = await response.json();

    if ( responseJson.status === 1 ) {
      signupStatus.innerHTML = `
        <div class="modal-status modal-status-success">
          Success! Your account has been created. Please check your email to activate your account.
        </div>
      `;
      location.reload();
    } else {
      signupStatus.innerHTML = `
        <div class="modal-status modal-status-danger">
          Unable to create your account. Please check your details and try again.
        </div>
      `;
      signupFieldset.removeAttribute('disabled');
    }

  });

  // Signin form
  signinForm.addEventListener('submit', async e => {
    e.preventDefault();
    const signinFieldset = signinForm.querySelector('fieldset');
    signinFieldset.setAttribute('disabled', true);

    const signinStatus = signinForm.querySelector('#signin-status');
    signinStatus.innerHTML = `
      <div class="modal-status modal-status-info">
        Please wait we are signing you in...
      </div>
    `;

    const formData = {
      username: signinForm.querySelector('#si-email').value,
      password: signinForm.querySelector('#si-password').value,
    }
    console.log(formData);

    const response = await fetch(bwdAuthRest.login, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formData),
    });

    console.log(response);

    const responseJson = await response.json();

    if ( responseJson.status === 1 ) {
      signinStatus.innerHTML = `
        <div class="modal-status modal-status-success">
          ${responseJson.message}
        </div>
      `;
      location.reload();
    } else {
      signinStatus.innerHTML = `
        <div class="modal-status modal-status-danger">
          ${responseJson.message}
        </div>
      `;
      signinFieldset.removeAttribute('disabled');
    }
  });
});