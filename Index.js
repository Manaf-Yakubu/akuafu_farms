document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('subscribeForm');

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const data = {};
    formData.forEach((value, key) => {
      data[key] = value.trim();
    });

    if (!data.name || !data.email) {
      alert('Please enter your name and email.');
      return;
    }

    fetch('backend/subscribe.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data),
    })
    .then(res => res.json())
    .then(response => {
      if (response.success) {
        alert('Thank you for subscribing!');
        form.reset();
      } else {
        alert('Error: ' + response.message);
      }
    })
    .catch(err => {
      alert('An error occurred. Please try again later.');
      console.error(err);
    });
  });
});
