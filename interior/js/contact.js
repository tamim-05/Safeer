/**
 * SAFEER INTERIOR WORK RIYADH — CONTACT JAVASCRIPT (js/contact.js)
 * Form validation, URL query parameter pre-selection, and simulated submission states.
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    initProjectTypeUrlPreselect();
    initContactForm();
  });

  /**
   * Pre-select dropdown from ?type= URL parameter
   */
  function initProjectTypeUrlPreselect() {
    const urlParams = new URLSearchParams(window.location.search);
    const typeParam = urlParams.get('type');
    const selectEl = document.getElementById('project-type');

    if (!typeParam || !selectEl) return;

    const map = {
      'villa': 'Villa Interior',
      'residential': 'Residential Interior',
      'office': 'Office Fit-Out',
      'commercial': 'Commercial Interior',
      'furniture': 'Custom Furniture',
      'concept': 'Other'
    };

    const targetVal = map[typeParam.toLowerCase()];
    if (targetVal) {
      selectEl.value = targetVal;
    }
  }

  /**
   * Contact Form Validation & Submission
   */
  function initContactForm() {
    const form = document.getElementById('project-enquiry-form');
    const statusBox = document.getElementById('form-status');
    const submitBtn = document.getElementById('submit-btn');
    if (!form || !statusBox || !submitBtn) return;

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      // Clear previous status
      statusBox.className = 'form-status-alert';
      statusBox.textContent = '';

      const name = form.querySelector('#full-name')?.value.trim();
      const phone = form.querySelector('#phone-number')?.value.trim();
      const email = form.querySelector('#email-address')?.value.trim();
      const details = form.querySelector('#project-details')?.value.trim();

      // Basic client-side validation
      if (!name || !phone || !email || !details) {
        statusBox.classList.add('is-error');
        statusBox.textContent = 'Something went wrong. Please complete all required fields or contact us directly by phone.';
        statusBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        return;
      }

      // Email format check
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        statusBox.classList.add('is-error');
        statusBox.textContent = 'Please enter a valid email address.';
        statusBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        return;
      }

      // Simulate loading state
      const originalBtnText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = `<span>Sending Enquiry...</span>`;

      setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;

        // Success State per PRD Section 12
        statusBox.classList.add('is-success');
        statusBox.innerHTML = `
          <strong>Thank you. Your enquiry has been received.</strong><br>
          We appreciate you reaching out to Safeer Interior Work Riyadh. A design partner will review your requirements and respond shortly.
        `;

        form.reset();
        statusBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }, 700);
    });
  }

})();
