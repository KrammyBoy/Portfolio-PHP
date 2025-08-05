<div class="contact">
    <div class="image-container wave curve">
        <h1>Contact</h1>
    </div>
  <!-- Main Content -->
  <div class="contact-content">
    <!-- Contact Information -->
    <div class="contact-info">
      <div class="info-card">
        <div class="info-header">
          <h2>Get In Touch</h2>
          <p>Ready to start your next project?</p>
        </div>

        <div class="contact-methods">
          <div class="contact-method">
            <i class="bx bx-envelope"></i>
            <div class="contact-details">
              <h3>Email</h3>
              <p>hello@yourname.com</p>
            </div>
          </div>

          <div class="contact-method">
            <i class="bx bx-phone"></i>
            <div class="contact-details">
              <h3>Phone</h3>
              <p>+63 123 456 7890</p>
            </div>
          </div>

          <div class="contact-method">
            <i class="bx bx-map"></i>
            <div class="contact-details">
              <h3>Location</h3>
              <p>Cebu City, Philippines</p>
            </div>
          </div>

          <div class="contact-method">
            <i class="bx bx-stopwatch"></i>
            <div class="contact-details">
              <h3>Response Time</h3>
              <p>Within 24 hours</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Form -->
    <div class="contact-form-section">
      <div class="form-container">
        <div class="form-header">
          <h2>Send Message</h2>
          <p>Tell me about your project</p>
        </div>

        <form class="contact-form" id="contactForm" action="/contact" method="POST">
          <div class="form-group">
            <label for="name">Full Name</label>
            <input
              type="text"
              id="name"
              name="name"
              class="form-control"
              placeholder="Enter your full name"
              required
            />
          </div>

          <div class="form-group">
            <label for="subject">Subject</label>
            <input
              type="text"
              id="subject"
              name="subject"
              class="form-control"
              placeholder="What's this about?"
              required
            />
          </div>

          <div class="form-group">
            <label for="message">Message</label>
            <textarea
              id="message"
              name="message"
              class="form-control"
              placeholder="Tell me about your project, goals, and timeline..."
              required
            ></textarea>
          </div>

          <button type="submit" class="submit-btn">
            <i class="bx bx-send-alt"></i>
            Send Message
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
